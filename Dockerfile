FROM php:7.2.16-apache
RUN docker-php-ext-install mysqli 
COPY / /var/www/html/



