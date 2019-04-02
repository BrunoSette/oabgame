FROM php:7.2.16-apache
RUN sudo apt-get update && sudo apt-get upgrade -y
RUN docker-php-ext-install mysqli 
RUN a2enmod rewrite
RUN apt-get install php-curl
RUN service apache2 restart

COPY / /var/www/html/



