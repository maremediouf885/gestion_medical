#!/bin/bash

echo "🚀 PRÉPARATION POUR DÉPLOIEMENT"

# Nettoyer le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimiser pour production
composer install --optimize-autoloader --no-dev
npm run build

# Vérifier la base de données
php artisan migrate:status

echo "✅ PRÊT POUR DÉPLOIEMENT !"
echo "📁 Créer un ZIP avec tous les fichiers"
echo "🌐 Uploader sur votre hébergeur"