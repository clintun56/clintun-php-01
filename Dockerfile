FROM php:8.2-fpm

# ติดตั้ง System Dependencies ที่จำเป็น
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# ติดตั้ง Dependencies ของ Laravel
RUN composer install --no-dev --optimize-autoloader

# ตั้งค่าสิทธิ์การเข้าถึงไฟล์
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# พอร์ตที่ Render ใช้
EXPOSE 80

# สั่งรัน Migration และเริ่มระบบ
CMD ["sh", "-c", "php artisan migrate --force && php-fpm -D && nginx -g 'daemon off;'"]
