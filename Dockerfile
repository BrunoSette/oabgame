FROM php:7.2.16-apache
RUN apt-get update && apt-get upgrade -y
#RUN apt-get install php7.0-curl
RUN apt-get clean
RUN service apache2 restart

RUN docker-php-ext-install mysqli 
RUN a2enmod rewrite
RUN service apache2 restart

COPY / /var/www/html/



