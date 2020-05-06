FROM php:7.0-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Needed for composer
RUN apt-get update
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip