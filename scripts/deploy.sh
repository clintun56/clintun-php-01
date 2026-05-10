#!/bin/bash
set -e

echo "=== Starting deployment process ==="

echo "Step 1: Running migrations..."
php artisan migrate --force

echo "Step 2: Caching configuration..."
php artisan config:cache

echo "Step 3: Caching routes..."
php artisan route:cache

echo "Step 4: Clearing caches..."
php artisan cache:clear

echo "Step 5: Setting storage permissions..."
chmod -R 777 storage bootstrap/cache

echo "=== Deployment completed successfully! ==="
