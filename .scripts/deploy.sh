#!/bin/bash

# Exit the script on any command with non-zero exit status
set -e

# Print each command before executing it (for debugging purposes)
set -x

# Navigate to the project directory
cd /var/www/sanctuary-forge

# Pull the latest changes from the main branch
git pull origin main

# Install PHP dependencies using Composer
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm install

# Build assets using npm
npm run build

# Clear and cache Laravel configurations, routes, and views
php artisan config:cache
php artisan route:cache
php artisan view:cache
