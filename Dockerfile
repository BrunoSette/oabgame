FROM php:7.2.16-apache
RUN docker-php-ext-install mysqli 
RUN a2enmod rewrite
RUN apt-get install php-curl

COPY / /var/www/html/



