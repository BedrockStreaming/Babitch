FROM debian:jessie

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y nginx

COPY nginx.conf /etc/nginx/

COPY babitch.conf /etc/nginx/sites-available/default

RUN echo "upstream php-upstream { server m6web-babitch-php:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data

ENTRYPOINT ["nginx"]

CMD ["-g", "daemon off;"]

EXPOSE 80
