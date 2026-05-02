FROM php:8.5-fpm-alpine

WORKDIR /var/www/html

# ติดตั้ง dependencies (รวม git สำหรับ composer)
RUN apk add --no-cache curl git build-base \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    libzip-dev oniguruma-dev

# ติดตั้ง PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring \
    exif pcntl bcmath zip

# ลบ build dependencies ทันที
RUN apk del --no-cache build-base \
    libpng-dev libjpeg-turbo-dev freetype-dev

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# ✅ เพิ่ม flags เพื่อให้เร็ว
RUN composer install --no-dev --optimize-autoloader \
    --no-interaction --no-progress --ignore-platform-reqs

# Permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 777 storage bootstrap/cache

COPY nginx.conf /etc/nginx/nginx.conf

ENV WEBROOT=/var/www/html/public
EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
