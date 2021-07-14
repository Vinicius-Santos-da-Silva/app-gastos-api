#!/bin/sh
chmod +x env
cp env .env
rm -rf composer.lock
composer self-update
composer update
composer install
composer require codeigniter4/framework --prefer-source
composer fund