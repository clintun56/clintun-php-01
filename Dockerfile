FROM richarvey/php-fpm-with-nginx:latest

COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader

ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
>>>>>>> 46f8a2f (refactor: Replace PHP 8.5 Alpine with richarvey/php-fpm-with-nginx)
