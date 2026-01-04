#!/bin/bash

echo "🚀 DÉPLOIEMENT RAPIDE - GESTION MÉDICALE"
echo "========================================"

# Variables
DOMAIN="votre-domaine.com"
DB_PASSWORD="CHANGEZ_MOI_123!"

# 1. Mise à jour système
echo "📦 Mise à jour du système..."
sudo apt update && sudo apt upgrade -y

# 2. Installation LAMP Stack
echo "🔧 Installation PHP, MySQL, Nginx..."
sudo apt install -y nginx mysql-server php8.1-fpm php8.1-mysql php8.1-xml php8.1-curl php8.1-zip php8.1-mbstring php8.1-gd unzip

# 3. Installation Composer
echo "📥 Installation Composer..."
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 4. Configuration MySQL
echo "🗄️ Configuration base de données..."
sudo mysql -e "CREATE DATABASE gestion_medical;"
sudo mysql -e "CREATE USER 'medical_user'@'localhost' IDENTIFIED BY '$DB_PASSWORD';"
sudo mysql -e "GRANT ALL PRIVILEGES ON gestion_medical.* TO 'medical_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 5. Clone et installation du projet
echo "📂 Déploiement de l'application..."
cd /var/www/
sudo git clone https://github.com/maremediouf885/gestion_medical.git
cd gestion_medical

# 6. Installation des dépendances
sudo composer install --no-dev --optimize-autoloader

# 7. Configuration environnement
sudo cp .env.production.urgent .env
sudo sed -i "s/votre-domaine.com/$DOMAIN/g" .env
sudo sed -i "s/CHANGEZ_MOI_123!/$DB_PASSWORD/g" .env
sudo php artisan key:generate --force

# 8. Permissions
sudo chown -R www-data:www-data /var/www/gestion_medical
sudo chmod -R 755 /var/www/gestion_medical
sudo chmod -R 775 /var/www/gestion_medical/storage
sudo chmod -R 775 /var/www/gestion_medical/bootstrap/cache

# 9. Migration base de données
php artisan migrate --force
php artisan db:seed --force

# 10. Optimisation Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 11. Configuration Nginx
sudo tee /etc/nginx/sites-available/gestion_medical > /dev/null <<EOF
server {
    listen 80;
    server_name $DOMAIN www.$DOMAIN;
    root /var/www/gestion_medical/public;
    index index.php index.html;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
EOF

# 12. Activation du site
sudo ln -sf /etc/nginx/sites-available/gestion_medical /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm

# 13. Installation SSL (Let's Encrypt)
echo "🔒 Installation SSL..."
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d $DOMAIN --non-interactive --agree-tos --email admin@$DOMAIN

# 14. Firewall
echo "🛡️ Configuration firewall..."
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw --force enable

echo "✅ DÉPLOIEMENT TERMINÉ !"
echo "🌐 Votre site : https://$DOMAIN"
echo "👤 Admin par défaut : admin@admin.com / password"
echo "⚠️  CHANGEZ LE MOT DE PASSE ADMIN IMMÉDIATEMENT !"