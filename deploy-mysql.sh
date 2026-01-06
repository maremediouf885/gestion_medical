#!/bin/bash

# 🚀 SCRIPT DE DÉPLOIEMENT MYSQL - GESTION MÉDICALE
# Utilisation: ./deploy-mysql.sh

echo "🏥 DÉPLOIEMENT SYSTÈME GESTION MÉDICALE - MYSQL"
echo "================================================"

# 1. Vérifier les prérequis
echo "✅ Vérification des prérequis..."
if ! command -v php &> /dev/null; then
    echo "❌ PHP n'est pas installé"
    exit 1
fi

if ! command -v composer &> /dev/null; then
    echo "❌ Composer n'est pas installé"
    exit 1
fi

# 2. Configuration de l'environnement
echo "🔧 Configuration de l'environnement..."
if [ -f ".env.production.cpanel" ]; then
    cp .env.production.cpanel .env
    echo "✅ Fichier .env configuré pour MySQL"
else
    echo "❌ Fichier .env.production.cpanel introuvable"
    exit 1
fi

# 3. Installation des dépendances
echo "📦 Installation des dépendances..."
composer install --no-dev --optimize-autoloader

# 4. Configuration Laravel
echo "🔑 Configuration Laravel..."
php artisan key:generate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Configuration de la base de données
echo "🗄️ Configuration de la base de données..."
echo "⚠️  ATTENTION: Assurez-vous que la base MySQL est créée dans cPanel"
read -p "Appuyez sur Entrée pour continuer avec les migrations..."

php artisan migrate --force
php artisan db:seed --class=DefaultAdminSeeder --force

# 6. Permissions
echo "🔐 Configuration des permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs

# 7. Assets
echo "🎨 Compilation des assets..."
if command -v npm &> /dev/null; then
    npm install
    npm run build
else
    echo "⚠️  NPM non trouvé, assets non compilés"
fi

echo ""
echo "🎉 DÉPLOIEMENT TERMINÉ !"
echo "========================"
echo "🔑 Compte admin par défaut:"
echo "   Email: admin@gestion-medical.com"
echo "   Username: admin"
echo "   Mot de passe: admin123"
echo ""
echo "⚠️  N'oubliez pas de:"
echo "   1. Modifier les identifiants admin"
echo "   2. Configurer les variables .env"
echo "   3. Tester toutes les fonctionnalités"