FROM php:fpm-alpine

RUN set -ex \
    && apk --no-cache add \
        postgresql-dev icu-dev libmcrypt libmcrypt-dev

RUN docker-php-ext-install pdo pdo_pgsql intl mbstring mcrypt

COPY ./ /var/www
