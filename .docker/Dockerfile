FROM php:8.1.2-fpm



RUN apt-get update \
    && apt-get install -y \
        apt-utils \
    && apt-get install -y \
        libpq-dev \
        libzip-dev \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) zip 

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

