#!/usr/bin/env bash

rm -rf tests/report/
/usr/local/bin/phpdbg -qrr vendor/bin/phpunit
