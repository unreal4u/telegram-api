#!/usr/bin/env bash

vagrant ssh -- -t 'cd telegram-api/; /usr/bin/composer.phar update -o --prefer-dist'
