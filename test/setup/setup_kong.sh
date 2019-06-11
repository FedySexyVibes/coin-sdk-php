#!/bin/bash -xv

kong=${KONG_HOST:-http://localhost:8001}
secret=secret123
username1=loadtest-loada
username2=loadtest-loadb
keys=${KEYS_LOCATION:-.}

service_id=$(curl -s -X POST ${kong}/services/ \
	--data 'name=test' \
	--data 'host=api-stub' \
	--data 'port=8443' \
	--data 'protocol=https' | jq -r '.id')

route_id=$(curl -s -X POST ${kong}/routes/ \
	--data 'methods[]=GET' \
	--data 'methods[]=PUT' \
	--data 'methods[]=POST' \
	--data 'paths[]=/number-portability/v1' \
	--data 'strip_path=false' \
	--data "service.id=$service_id" | jq -r '.id')

jwt_plugin='{
      "name": "jwt",
      "config": {
	"claims_to_verify": [
	  "exp",
	  "nbf"
	],
	"key_claim_name": "iss",
	"cookie_names": [
	  "jwt"
	],
	"maximum_expiration": 0,
	"secret_is_base64": false
      },
      "protocols": ["http", "https"],
      "run_on": "first"
    }'


curl -o /dev/null -sS -X POST ${kong}/services/${service_id}/plugins -H 'Content-Type: application/json' -d "${jwt_plugin}"
curl -o /dev/null -sS -X POST ${kong}/services/${service_id}/plugins/ --data "name=hmac-auth"

rm -f "${KEYS_LOCATION}"/{private-key.pem,private-key.pem.pub,public-key.pem,sharedkey.encrypted}
ssh-keygen -m PEM -t rsa -b 4096 -f "${KEYS_LOCATION}/private-key.pem" -N ''
ssh-keygen -e -m PKCS8 -f "${KEYS_LOCATION}/private-key.pem" > "${KEYS_LOCATION}/public-key.pem"
echo -n ${secret} | openssl rsautl -encrypt -inkey ${KEYS_LOCATION}/public-key.pem -pubin -pkcs | base64 | tr -d \\n > "${KEYS_LOCATION}/sharedkey.encrypted"
chmod 0644 "${KEYS_LOCATION}/private-key.pem"

add_consumer() {
	local user="$1"
	curl -o /dev/null -sS -X POST ${kong}/consumers/ --data "username=${user}"
	curl -o /dev/null -sS -X POST ${kong}/consumers/${user}/hmac-auth/ \
		--data "username=${user}" \
		--data "secret=${secret}"

	curl -o /dev/null -sS -X POST ${kong}/consumers/${user}/jwt/ \
		--data-urlencode "key=${user}" \
		--data-urlencode "rsa_public_key=$(<"${KEYS_LOCATION}/public-key.pem")" \
		--data-urlencode 'algorithm=RS256'
}

add_consumer "$username1"
add_consumer "$username2"
