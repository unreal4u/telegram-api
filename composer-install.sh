#!/usr/bin/env bash

apt-get -y update
makephp 7
newphp 7
/usr/local/bin/composer self-update
cd /var/www/default/
/usr/local/bin/composer update -o --prefer-dist
