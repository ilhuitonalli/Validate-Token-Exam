#!/bin/sh

if [ ! -f .env ]; then
    cp .env.example .env
fi

php artisan key:generate --force
php artisan jwt:secret --force
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear


chown -R www-data:www-data storage bootstrap/cache