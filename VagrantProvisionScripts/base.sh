#!/usr/bin/env bash

# Define latest PHP version as the current one
MAIN_PHP_VERSION="72"

yum install -q -y epel-release
# Enable installation after epel is installed
yum -q -y install lynx ntp vim-enhanced wget unzip git nginx
yum install -q -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm

# Enable services
systemctl enable ntpd
systemctl start ntpd
systemctl enable firewalld
systemctl start firewalld

# Set the correct time
ntpdate -u pool.ntp.org

declare -a PHP_VERSIONS=("70" "71" "72")
for php_version in "${PHP_VERSIONS[@]}"
do
    :
    yum install -q -y \
  php${php_version}-php \
  php${php_version}-php-opcache \
  php${php_version}-php-mbstring \
  php${php_version}-php-xml \
  php${php_version}-php-pecl-xdebug \
  php${php_version}-php-dbg
done

# Enable direct php and phpdbg commands to the latest PHP version
ln -s /usr/bin/php${MAIN_PHP_VERSION} /usr/bin/php
ln -s /usr/bin/php${MAIN_PHP_VERSION}-phpdbg /usr/bin/phpdbg

curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/bin/
# Add symlink to composer (because why not?)
ln -s /usr/bin/composer.phar /usr/bin/composer

firewall-cmd --zone=public --add-service http
firewall-cmd --zone=public --add-service http --permanent
