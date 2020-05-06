FROM php:7.3-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update
RUN apt-get install -y \
        libzip-dev \
        zip
RUN docker-php-ext-install zip
