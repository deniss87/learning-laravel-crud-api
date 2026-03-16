#!/bin/sh

set -e

# Сompletely delete the old cache
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/views/*.php

# Grant permissions BEFORE executing Laravel commands
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "=== Syncing static assets ==="
mkdir -p /var/www/public_shared
cp -rp /var/www/public/. /var/www/public_shared/

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Seeding ==="
php artisan db:seed --force

echo "=== Clearing cache ==="
php artisan config:clear
php artisan cache:clear

echo "=== Starting PHP-FPM ==="
exec php-fpm