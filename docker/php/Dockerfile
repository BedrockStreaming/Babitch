FROM debian:jessie

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    php5-common \
    php5-cli \
    php5-fpm \
    php5-mcrypt \
    php5-mysql \
    php5-curl

COPY babitch.ini /etc/php5/fpm/conf.d/

COPY babitch.ini /etc/php5/cli/conf.d/

COPY babitch.pool.conf /etc/php5/fpm/pool.d/

RUN usermod -u 1000 www-data

ENTRYPOINT ["php5-fpm"]

CMD ["-F"]

EXPOSE 9000
