FROM php:7.0.30-apache
RUN docker-php-ext-install mysqli rewrite
COPY / /var/www/html/



