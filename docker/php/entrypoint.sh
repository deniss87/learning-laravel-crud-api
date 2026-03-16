#!/bin/sh

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Seeding ==="
php artisan db:seed --force

echo "=== Clearing cache ==="
php artisan config:clear
php artisan cache:clear

echo "=== Starting PHP-FPM ==="
exec php-fpm