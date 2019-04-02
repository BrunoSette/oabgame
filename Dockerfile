FROM ubuntu:16.04
RUN apt-get update && apt-get upgrade -y
RUN apt-get install php-curl
RUN apt-get clean
RUN service apache2 restart

FROM php:7.2.16-apache
RUN docker-php-ext-install mysqli 
RUN a2enmod rewrite
RUN service apache2 restart

COPY / /var/www/html/



