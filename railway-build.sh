#!/bin/bash

# Script de build pour Railway
echo "🚀 Build Railway - Gestion Médicale"

# Installation des dépendances
composer install --no-dev --optimize-autoloader

# Configuration Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations
php artisan migrate --force
php artisan db:seed --class=DefaultAdminSeeder --force

echo "✅ Build terminé"