#!/bin/bash

export PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin

echo "Starting supervisor"
supervisord
supervisorctl reread
supervisorctl update

echo "Starting php"
php-fpm
