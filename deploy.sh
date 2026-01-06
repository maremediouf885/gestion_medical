#!/bin/bash

# Script de déploiement Laravel Cloud
echo "🚀 Déploiement Laravel Cloud - Gestion Médicale"

# Migrations
php artisan migrate --force

# Seeders (forcer en production)
php artisan db:seed --class=DefaultAdminSeeder --force

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage link
php artisan storage:link

echo "✅ Déploiement terminé"