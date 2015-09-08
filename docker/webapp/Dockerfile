FROM debian:jessie

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    git \
    php5-cli \
    curl \
    php5-mysql

RUN mkdir -p /var/www/html/Babitch

COPY sources/ /var/www/html/Babitch/

WORKDIR /var/www/html/Babitch

COPY parameters.yml app/config/parameters.yml

RUN curl -s http://getcomposer.org/installer | php
RUN php composer.phar update symfony/icu
RUN php composer.phar install
RUN php app/console doctrine:schema:create

RUN chown -R www-data:www-data . \
    && chmod -R 755 . \
    && chmod -R 777 app/cache \
    && chmod -R 777 app/logs

VOLUME /var/www/html/Babitch
