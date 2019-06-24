FROM composer:1.8.6 AS composer

FROM php:7.2
RUN apt-get update && apt-get install -y git zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json ./
COPY composer.lock ./
COPY common-sdk/ ./common-sdk/
COPY phpunit.xml.dist ./
COPY number-portability-sdk/ ./number-portability-sdk/
COPY keys/ ./keys

RUN composer install
CMD ./vendor/bin/phpunit number-portability-sdk/test
