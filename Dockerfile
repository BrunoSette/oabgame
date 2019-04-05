FROM php:7.2.16-apache
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install mysqli mbstring zip
RUN a2enmod rewrite
RUN service apache2 restart
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer 
COPY / /var/www/html/
COPY php.ini /etc/php/7.2/apache2/
RUN mkdir docker-entrypoint-initdb.d
COPY *.sql /docker-entrypoint-initdb.d/
RUN mkdir -p /docker-entrypoint-initdb.d && mv aprovagame.sql /docker-entrypoint-initdb.d/aprovagame.sql
COPY apache2.conf /etc/apache2/
WORKDIR /var/www/html/game/app
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer

