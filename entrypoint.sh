#!/bin/sh
chmod +x env
cp env .env
composer self-update
composer update
composer fund