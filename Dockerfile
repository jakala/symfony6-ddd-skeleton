FROM williarin/php:8.2
RUN apk update && apk upgrade
RUN apk add php8-pecl-xdebug
#RUN pecl channel-update pecl.php.net  && pecl install xdebug && docker-php-ext-enable xdebug
RUN echo "xdebug.mode=coverage" >> /etc/php82/conf.d/docker-php-ext-xdebug.ini