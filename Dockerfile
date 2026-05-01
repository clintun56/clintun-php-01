FROM php:8.5-fpm-alpine

WORKDIR /var/www/html

# ติดตั้ง system dependencies
RUN apk add --no-cache \
    build-base \
    git \
    curl \
    zip \
    unzip \
    sqlite \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    postgresql-client

# ติดตั้ง PHP extensions ที่จำเป็น
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    curl

# ล้าง build dependencies เพื่อลดขนาด image
RUN apk del --no-cache build-base oniguruma-dev libpng-dev libjpeg-turbo-dev freetype-dev

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# ติดตั้ง PHP dependencies
RUN composer install --no-dev --optimize-autoloader && \
    composer dump-autoload

# ตั้งค่า permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 9000

# Run PHP-FPM
CMD ["php-fpm"]
