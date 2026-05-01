FROM php:8.2-fpm-alpine

WORKDIR /var/www/html
COPY . .

RUN apk add --no-cache \
    nginx \
    curl \
    git && \
    docker-php-ext-install pdo pdo_mysql && \
    composer install --no-dev --optimize-autoloader

ENV WEBROOT=/var/www/html/public

EXPOSE 80
CMD ["sh", "-c", "php artisan migrate --force; php-fpm -D && nginx -g 'daemon off;'"]
