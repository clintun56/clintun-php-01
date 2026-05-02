FROM php:8.5-fpm-alpine

WORKDIR /var/www/html

# 1. ติดตั้ง build dependencies + curl
RUN apk add --no-cache curl build-base \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    libzip-dev oniguruma-dev

# 2. ติดตั้ง PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring \
    exif pcntl bcmath zip

# 3. ลบ build dependencies
RUN apk del --no-cache build-base \
    libpng-dev libjpeg-turbo-dev freetype-dev

# ✅ เพิ่ม Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy files
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 777 storage bootstrap/cache

# Copy nginx config
COPY nginx.conf /etc/nginx/nginx.conf

ENV WEBROOT=/var/www/html/public
EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
