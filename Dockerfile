FROM composer:2.5.1 AS composer

FROM php:8.2
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
