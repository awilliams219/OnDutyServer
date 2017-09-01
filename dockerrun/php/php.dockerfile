FROM php:fpm-alpine

RUN set -ex \
    && apk --no-cache add \
        postgresql-dev icu-dev libmcrypt libmcrypt-dev autoconf g++ make

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini


RUN docker-php-ext-install pdo pdo_pgsql intl mbstring mcrypt

COPY ./ /var/www
