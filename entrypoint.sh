#!/bin/sh
set -e

echo "Starting Laravel application..."

cd /var/www/html

# Build frontend assets
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

# Cache configuration
echo "Caching configuration..."
php artisan config:cache

# Cache routes
echo "Caching routes..."
php artisan route:cache

# Fix permissions
chmod -R 777 storage bootstrap/cache

echo "Starting services..."
php-fpm -D
nginx -g 'daemon off;'