#!/usr/bin/env bash

rm -rf tests/report/
vagrant ssh -- -t 'cd telegram-api/; /usr/bin/phpdbg -qrr vendor/bin/phpunit'
