#!/bin/bash

echo "=== DÉPLOIEMENT SÉCURISÉ GESTION MÉDICALE ==="

# 1. Mise à jour du code
git pull origin main

# 2. Installation des dépendances
composer install --no-dev --optimize-autoloader

# 3. Configuration de production
cp .env.production .env

# 4. Génération de clé d'application
php artisan key:generate --force

# 5. Migration et optimisation base de données
php artisan migrate --force
php artisan db:seed --class=AdminSeeder

# 6. Optimisation Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Permissions sécurisées
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 8. Configuration SSL/HTTPS
echo "Vérifiez que SSL est configuré sur votre serveur"

# 9. Première sauvegarde
php artisan medical:backup

# 10. Configuration du cron pour sauvegardes
echo "0 2 * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1" | crontab -

echo "=== DÉPLOIEMENT TERMINÉ ==="
echo "IMPORTANT: Changez tous les mots de passe par défaut"
echo "IMPORTANT: Configurez le firewall et SSL"