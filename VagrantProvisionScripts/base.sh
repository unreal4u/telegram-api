#!/usr/bin/env bash

# disable selinux for current boot
setenforce 0
# disable selinux permanently
sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/sysconfig/selinux
sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config

yum install -q -y epel-release
# Enable installation after epel is installed
yum -q -y install lynx ntp vim-enhanced wget unzip git nginx

# Enable services
systemctl enable ntpd
systemctl start ntpd
systemctl enable firewalld
systemctl start firewalld

# Set the correct time
ntpdate -u pool.ntp.org

PHP_VERSION="71"
# PHP 7.0.x install:
yum install -q -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
yum install -q -y \
  php${PHP_VERSION}-php \
  php${PHP_VERSION}-php-fpm \
  php${PHP_VERSION}-php-mysqlnd \
  php${PHP_VERSION}-php-intl \
  php${PHP_VERSION}-php-opcache \
  php${PHP_VERSION}-php-gd \
  php${PHP_VERSION}-php-mbstring \
  php${PHP_VERSION}-php-pecl-memcache \
  php${PHP_VERSION}-php-imap \
  php${PHP_VERSION}-php-bcmath \
  php${PHP_VERSION}-php-xml \
  php${PHP_VERSION}-php-process \
  php${PHP_VERSION}-php-pecl-xdebug \
  php${PHP_VERSION}-php-pecl-zip \
  php${PHP_VERSION}-php-dbg
ln -s /usr/bin/php${PHP_VERSION} /usr/bin/php
ln -s /usr/bin/php${PHP_VERSION}-phpdbg /usr/bin/phpdbg

curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/bin/

firewall-cmd --zone=public --add-service http
firewall-cmd --zone=public --add-service http --permanent
