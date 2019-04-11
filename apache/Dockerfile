FROM php:7.2.16-apache
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git \
    zlib1g-dev \
    libzip-dev \
    vim \
    php7-sqlite3
RUN docker-php-ext-install mysqli mbstring zip pdo pdo_mysql
RUN a2enmod rewrite
RUN service apache2 restart
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer 
COPY / /var/www/html/
#COPY php.ini /etc/php/7.2/apache2/
COPY php.ini $PHP_INI_DIR/conf.d/
COPY apache2.conf /etc/apache2/
WORKDIR /var/www/html/game/app

