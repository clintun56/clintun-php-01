#!/bin/sh
set -e

echo "Starting Laravel application..."

cd /var/www/html

# Cache configuration FIRST (ให้ npm build รู้ APP_URL)
echo "Caching configuration..."
php artisan config:cache

# Build frontend assets (ทีนี้ Vite รู้ APP_URL=https://...)
echo "Building assets..."
npm install
npm run build

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear

# Cache routes
echo "Caching routes..."
php artisan route:cache

# Fix permissions
chmod -R 777 storage bootstrap/cache

echo "Starting services..."
php-fpm -D
nginx -g 'daemon off;'