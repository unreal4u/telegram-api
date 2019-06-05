# Use a stock Docksal image as the base
FROM docksal/cli:2.6-php7.0

# Install phpdbg extension for PHP
RUN set -xe; \
	apt-get update >/dev/null; \
	apt-get install php7.0-phpdbg >/dev/null </dev/null \
	; \
