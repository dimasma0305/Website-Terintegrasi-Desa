FROM php:7.4-apache
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
RUN usermod -u 1000 www-data