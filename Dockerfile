FROM composer:2.3.8 AS composer

FROM php:7.3
RUN apt-get update && apt-get install -y git zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json ./
COPY composer.lock ./
COPY common-sdk/ ./common-sdk/
COPY number-portability-sdk/ ./number-portability-sdk/
COPY bundle-switching-sdk/ ./bundle-switching-sdk/
COPY keys/ ./keys/

RUN composer install
CMD composer run-script test
