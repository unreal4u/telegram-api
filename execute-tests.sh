#!/usr/bin/env bash

rm -rf tests/report/
/usr/bin/phpdbg -qrr vendor/bin/phpunit
