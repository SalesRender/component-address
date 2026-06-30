FROM composer/composer:2-bin AS composer

FROM php:8.4-cli-alpine AS php

WORKDIR /app

COPY --from=composer --link /composer /usr/bin/composer
ENV COMPOSER_HOME="/tmp/composer"
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

ARG XDEBUG_VERSION="3.4.2"

RUN set -eux; \
        apk add --no-cache icu-libs \
        && apk add --no-cache --virtual .build-deps \
                --update linux-headers \
                autoconf \
                openssl \
                make \
                g++ \
                icu-dev \
    	&& pecl install xdebug-${XDEBUG_VERSION} \
        && docker-php-ext-enable xdebug \
        && docker-php-ext-install intl \
        && apk del .build-deps