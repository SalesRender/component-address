FROM composer/composer:2-bin AS composer

FROM php:7.4-cli-alpine3.16 AS php

WORKDIR /app

COPY --from=composer --link /composer /usr/bin/composer
ENV COMPOSER_HOME="/tmp/composer"
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

ARG XDEBUG_VERSION="3.1.0"

RUN set -eux; \
        apk add --no-cache --virtual .build-deps \
                --update linux-headers \
                autoconf \
                openssl \
                make \
                g++ \
    	&& pecl install xdebug-${XDEBUG_VERSION} \
        && docker-php-ext-enable xdebug \
        && apk del .build-deps