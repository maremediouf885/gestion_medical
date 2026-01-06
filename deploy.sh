#!/bin/bash

echo "🚀 DÉPLOIEMENT GESTION MÉDICALE"

# Mise à jour du code
git pull origin main

# Installation des dépendances
composer install --no-dev --optimize-autoloader

# Optimisations Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations
php artisan migrate --force

# Création de l'admin par défaut
php artisan db:seed --class=DefaultAdminSeeder --force

# Permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "✅ DÉPLOIEMENT TERMINÉ !"