include Makefile.mk

IMAGE=build_container
NAME=coin_sdk_php
CI_JOB_ID ?=local

ifeq ("$(OS)", "Darwin")
	DOCKER0=0.0.0.0
else
	DOCKER0:=$(shell printf "import netifaces\nprint netifaces.gateways()['default'][netifaces.AF_INET][0]\n" | python)
endif

pre-build:

test: start-docker-compose integration-test

start-docker-compose:
	sed -e 's/- "*[0-9][0-9]*:\([0-9][0-9]*\)"*/- \1/g' docker-compose.yml > /tmp/docker-compose${CI_JOB_ID}.yml
	docker-compose --project-name coin-sdk-php-${CI_JOB_ID} --file /tmp/docker-compose${CI_JOB_ID}.yml --project-directory $(PWD) up -d

integration-test: build
	#docker run --rm -v $${PWD}/test/setup/:/build/test/setup -e CRDB_REST_BACKEND=http://kong:8000 --link coin-sdk-php-$(CI_JOB_ID)_kong_1:kong --network=coin-sdk-php-$(CI_JOB_ID)_coin-sdk-php $(IMAGE):$(VERSION) test

integration-test-clean:
	docker-compose --project-name coin-sdk-php-${CI_JOB_ID} --file /tmp/docker-compose${CI_JOB_ID}.yml --project-directory $(PWD) down
