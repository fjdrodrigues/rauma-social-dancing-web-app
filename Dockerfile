FROM php:7.2-apache
COPY .htaccess /var/www/html/
COPY frontend/ /var/www/html/