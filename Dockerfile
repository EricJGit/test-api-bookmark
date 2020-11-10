FROM php:7.4-fpm as php

# Maj list paquet
RUN apt-get update \
    #XDdebug
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    ## Driver pgsql
    && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

ARG XdebugFile=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo "xdebug.remote_enable=on" >> $XdebugFile \
    && echo "xdebug.remote_autostart=on" >> $XdebugFile \
    && echo "xdebug.remote_connect_back=on" >> $XdebugFile \
    && echo "xdebug.idekey=PHPSTORM" >> $XdebugFile \
    && echo "xdebug.remote_port=9000" >> $XdebugFile \
    && echo "xdebug.remote_handler=dbgp" >> $XdebugFile \
    && echo "xdebug.profiler_enable=0" >> $XdebugFile

# clean
RUN rm -rf /var/lib/apt/lists/* \
    && apt-get clean
