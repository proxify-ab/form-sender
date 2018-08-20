#!/bin/bash

export PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin

echo "Copy env file..."
cp .env.prod .env

echo "Running composer..."
composer install --no-dev --optimize-autoloader

echo "Running database migrations..."
php artisan d:m:m --force

echo "Running npm..."
#npm i --global cross-env
npm i --save-prod

#echo "Rebuild node-sass..."
#npm rebuild node-sass

echo "Compile frontend scripts..."
npm run prod

echo "Copy env file to container..."
cp .env.container .env

echo "Up docker containers..."
docker-compose up -d

echo "Set permissions for php container..."
docker-compose exec php chown -R www-data:www-data /opt

echo "!!!DONE!!!"
