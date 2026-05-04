#!/bin/bash
set -e

echo "==> git pull..."
git pull origin main

echo "==> migrate..."
php8.3 artisan migrate --force

echo "==> cache clear..."
php8.3 artisan config:clear
php8.3 artisan view:clear

echo "==> Done!"
