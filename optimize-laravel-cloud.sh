#!/bin/bash

# 🚀 OPTIMISATION LARAVEL CLOUD
echo "🏥 Optimisation pour Laravel Cloud"
echo "=================================="

# 1. Configuration production
echo "🔧 Configuration production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 2. Optimisation Composer
echo "📦 Optimisation Composer..."
composer install --no-dev --optimize-autoloader

# 3. Migrations et seeders
echo "🗄️ Base de données..."
php artisan migrate --force
php artisan db:seed --class=DefaultAdminSeeder --force

# 4. Cache applicatif
echo "⚡ Configuration cache..."
php artisan cache:clear
php artisan config:clear

# 5. Permissions
echo "🔐 Permissions..."
chmod -R 755 storage bootstrap/cache

echo "✅ Optimisation terminée pour Laravel Cloud !"