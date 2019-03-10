FROM php:5.6-apache
RUN docker-php-ext-install mysqli a2enmod rewrite
COPY / /var/www/html/



