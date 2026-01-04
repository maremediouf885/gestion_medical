# GUIDE DE DÉPLOIEMENT - GESTION MÉDICALE

## PRÉREQUIS SERVEUR
- Ubuntu 22.04 LTS
- PHP 8.2+
- MySQL 8.0+
- Nginx
- SSL Certificate
- Minimum 2GB RAM, 20GB SSD

## ÉTAPES DE DÉPLOIEMENT

### 1. Configuration serveur
```bash
# Mise à jour système
sudo apt update && sudo apt upgrade -y

# Installation PHP 8.2
sudo apt install php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl php8.2-zip php8.2-mbstring

# Installation MySQL
sudo apt install mysql-server

# Installation Nginx
sudo apt install nginx

# Installation Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 2. Configuration base de données
```sql
CREATE DATABASE gestion_medical_prod;
CREATE USER 'medical_user'@'localhost' IDENTIFIED BY 'MOT_DE_PASSE_FORT_123!';
GRANT ALL PRIVILEGES ON gestion_medical_prod.* TO 'medical_user'@'localhost';
FLUSH PRIVILEGES;
```

### 3. Déploiement application
```bash
# Clone du projet
cd /var/www/
sudo git clone https://github.com/maremediouf885/gestion_medical.git
cd gestion_medical

# Installation dépendances
sudo composer install --no-dev --optimize-autoloader

# Configuration environnement
sudo cp .env.production .env
sudo php artisan key:generate

# Permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Migration base de données
php artisan migrate --force
php artisan db:seed --class=AdminSeeder

# Optimisation Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4. Configuration Nginx
```nginx
server {
    listen 80;
    server_name votre-domaine.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name votre-domaine.com;
    root /var/www/gestion_medical/public;
    index index.php;

    ssl_certificate /etc/letsencrypt/live/votre-domaine.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/votre-domaine.com/privkey.pem;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 5. SSL avec Let's Encrypt
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d votre-domaine.com
```

### 6. Sauvegarde automatique
```bash
# Ajouter au crontab
0 2 * * * cd /var/www/gestion_medical && php artisan medical:backup
0 3 * * * mysqldump -u medical_user -p gestion_medical_prod > /backup/db_$(date +\%Y\%m\%d).sql
```

## SÉCURITÉ OBLIGATOIRE

### Firewall
```bash
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable
```

### Monitoring
```bash
# Installation fail2ban
sudo apt install fail2ban

# Configuration pour SSH et Nginx
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

## TESTS AVANT MISE EN PRODUCTION

1. ✅ Connexion HTTPS fonctionne
2. ✅ Base de données accessible
3. ✅ Sauvegarde automatique testée
4. ✅ Tous les formulaires fonctionnent
5. ✅ Permissions utilisateurs correctes
6. ✅ Logs d'audit activés

## MAINTENANCE

### Quotidienne
- Vérifier les logs d'erreur
- Contrôler l'espace disque
- Vérifier les sauvegardes

### Hebdomadaire  
- Mise à jour sécurité système
- Test de restauration backup
- Analyse des logs d'accès

### Mensuelle
- Mise à jour Laravel/PHP
- Optimisation base de données
- Test de performance