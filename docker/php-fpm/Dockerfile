FROM php:7.4-fpm
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get install -y zip \
    && apt-get -y --no-install-recommends install  php7.4-mysql php-redis php7.4-sqlite3 php-xdebug php7.4-bcmath php7.4-dba php7.4-gd php-imagick php-yaml php7.4-mbstring php7.4-zip git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Add composer
RUN curl -sSL https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer
