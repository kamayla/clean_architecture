FROM php:7.2-fpm
COPY ./docker/php/php.ini /usr/local/etc/php/
COPY ./laravel /var/www/

RUN apt-get update \
  && apt-get install -y \
  zlib1g-dev mariadb-client \
  vim \
  && docker-php-ext-install zip pdo_mysql

#Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin


WORKDIR /var/www

RUN composer global require "laravel/installer"
