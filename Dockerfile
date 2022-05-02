FROM php:7.2-apache

RUN a2enmod rewrite

COPY .htaccess /var/www/html/
COPY frontend/ /var/www/html/