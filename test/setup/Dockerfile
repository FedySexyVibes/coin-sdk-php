FROM alpine
RUN apk update && apk add --no-cache bash curl openssl jq openssh-client
ADD ./setup_kong.sh /setup/setup_kong.sh
WORKDIR /setup
CMD ["/setup/setup_kong.sh"]
