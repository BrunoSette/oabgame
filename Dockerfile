FROM php:7.2.16-apache
RUN docker-php-ext-install mysqli 
RUN a2enmod rewrite
RUN service apache2 restart
COPY / /var/www/html/
COPY php.ini /etc/php/7.2/apache2/




