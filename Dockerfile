# ใช้ PHP 8.5 FPM บน Alpine Linux
FROM php:8.5-fpm-alpine

# 1. ติดตั้ง System Dependencies สำหรับ Alpine
# build-base: สำหรับ compile extensions, libpng-dev/libjpeg-turbo-dev: สำหรับ GD
RUN apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    icu-dev \
    zip \
    unzip \
    git \
    curl \
    nginx

# 2. ติดตั้ง PHP Extensions สำหรับ Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# 3. ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 4. ติดตั้ง Laravel Dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 5. ตั้งค่า Permissions สำหรับ Alpine (User 82 คือ www-data)
RUN chown -R 82:82 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# 6. รัน Migration และเริ่มระบบ
CMD ["sh", "-c", "php artisan migrate --force && php-fpm -D && nginx -g 'daemon off;'"]
