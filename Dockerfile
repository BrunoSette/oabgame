FROM php:7.2.16-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install curl
RUN docker-php-ext-install mysqli 
RUN a2enmod rewrite
RUN service apache2 restart
RUN apt-get clean
COPY / /var/www/html/
COPY php.ini /etc/php/7.2/apache2/




