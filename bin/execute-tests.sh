#!/usr/bin/env bash

rm -rf tests/report/
vagrant ssh -- -t 'cd /home/vagrant/; /usr/bin/phpdbg -qrr vendor/bin/phpunit'
