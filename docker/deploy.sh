#!/bin/sh

# create sources folder for docker webapp volume
mkdir webapp/sources

# copy Babitch's sources from project root directory into webapp sub directory
# to allow docker to build a volume from them
cp -R ../app ../src ../web ../composer.json webapp/sources/

# build and run containers in daemon mode
docker-compose up -d
