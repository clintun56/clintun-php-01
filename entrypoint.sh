#!/bin/sh
set -e

echo "Starting Laravel application..."

cd /var/www/html

# Run migrations
echo "Running database migrations..."
php artisan migrate --force 2>&1 || true

# Cache configuration
echo "Caching configuration..."
php artisan config:cache 2>&1 || true

# Cache routes  
echo "Caching routes..."
php artisan route:cache 2>&1 || true

# Fix permissions
chmod -R 777 storage bootstrap/cache

echo "Starting services..."
php-fpm -D
nginx -g 'daemon off;'