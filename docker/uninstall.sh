#!/bin/sh

# delete babitch containers
docker rm -f m6web-babitch-webapp
docker rm -f m6web-babitch-php
docker rm -f m6web-babitch-server
docker rm -f m6web-babitch-db

# delete babitch images
docker rmi docker_m6web-babitch-webapp
docker rmi docker_m6web-babitch-php
docker rmi docker_m6web-babitch-server
docker rmi mysql

# delete copied sources from docker forlder
rm -rf webapp/sources
