FROM alpine:3.7

WORKDIR /build

RUN apk add bash
ADD docker/entrypoint.sh /build/entrypoint.sh

ARG NAME

ADD coin_sdk /build/coin_sdk
ADD test /build/test

RUN pipenv run python setup.py check && \
  pipenv run python setup.py build

ARG VERSION

ENTRYPOINT ["/build/entrypoint.sh"]

CMD ["test"]
