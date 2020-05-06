#!/usr/bin/env bash

if [[ "$1" == "" ]]
then
  echo "Missing argument, must be one of 70, 71, 72, 73, 74 or latest (defaults to 74). Assuming 74"
  PHP_VERSION="74"
elif [[ "$1" == "latest" ]]
then
  PHP_VERSION="74"
else
  PHP_VERSION="$1"
fi

rm -rf tests/report/
docker-compose run "php${PHP_VERSION}" phpdbg -qrr vendor/bin/phpunit
