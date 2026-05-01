FROM richarvey/php-fpm-with-nginx:latest

COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader

ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
