# 🏥 GUIDE DÉPLOIEMENT CPANEL - MYSQL

## ⏰ PLANNING DE DÉPLOIEMENT
- **19h00 - 19h05**: Upload des fichiers
- **19h05 - 19h10**: Configuration base de données
- **19h10 - 19h15**: Configuration .env
- **19h15 - 19h20**: Migrations et seeders
- **19h20 - 19h25**: Tests et vérifications
- **19h25 - 19h30**: Test final

## 📋 ÉTAPES DÉTAILLÉES

### 1. PRÉPARATION (19h00 - 19h05)
```bash
# Créer l'archive de déploiement
zip -r gestion_medical_deploy.zip . -x "node_modules/*" "vendor/*" ".git/*" "*.log"
```

### 2. CPANEL - UPLOAD FICHIERS (19h05)
1. Connectez-vous à cPanel
2. Ouvrir **File Manager**
3. Aller dans `public_html`
4. Uploader `gestion_medical_deploy.zip`
5. Extraire l'archive
6. Déplacer le contenu du dossier vers `public_html`

### 3. CRÉATION BASE DE DONNÉES MYSQL (19h05 - 19h10)
1. Dans cPanel, aller à **MySQL Databases**
2. Créer une nouvelle base de données:
   - Nom: `cpanel_username_medical`
3. Créer un utilisateur MySQL:
   - Username: `cpanel_username_medical`
   - Mot de passe: `[GÉNÉRER UN MOT DE PASSE FORT]`
4. Associer l'utilisateur à la base avec tous les privilèges

### 4. CONFIGURATION .ENV (19h10 - 19h15)
1. Dans File Manager, éditer le fichier `.env`
2. Remplacer les valeurs suivantes:

```env
APP_NAME="Gestion Médicale"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

# MYSQL - REMPLACER PAR VOS VRAIES VALEURS
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpanel_username_medical
DB_USERNAME=cpanel_username_medical
DB_PASSWORD=VOTRE_MOT_DE_PASSE_BDD

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
```

### 5. INSTALLATION ET MIGRATIONS (19h15 - 19h20)
Via Terminal cPanel ou SSH:

```bash
# Aller dans le répertoire
cd public_html

# Installation des dépendances
composer install --no-dev --optimize-autoloader

# Configuration Laravel
php artisan key:generate
php artisan config:cache
php artisan route:cache

# Migrations et données initiales
php artisan migrate
php artisan db:seed --class=DefaultAdminSeeder

# Permissions
chmod -R 755 storage bootstrap/cache
```

### 6. VÉRIFICATIONS (19h20 - 19h25)
1. **Test de connexion base de données:**
```bash
php artisan tinker
# Dans tinker:
DB::connection()->getPdo();
# Doit retourner un objet PDO sans erreur
```

2. **Test des migrations:**
```bash
php artisan migrate:status
# Toutes les migrations doivent être "Ran"
```

3. **Test du seeder admin:**
```bash
php artisan tinker
# Dans tinker:
App\Models\User::where('email', 'admin@gestion-medical.com')->first();
# Doit retourner l'utilisateur admin
```

### 7. TEST FINAL (19h25 - 19h30)
1. Accéder à votre site: `https://votre-domaine.com`
2. Tester la connexion admin:
   - **Email:** admin@gestion-medical.com
   - **Username:** admin
   - **Mot de passe:** admin123
3. Vérifier les fonctionnalités principales:
   - Dashboard
   - Gestion des patients
   - Système de vaccination
   - Rendez-vous

## 🚨 DÉPANNAGE MYSQL

### Erreur "Connection refused"
```bash
# Vérifier la configuration
php artisan config:clear
php artisan config:cache
```

### Erreur "Access denied"
- Vérifier les identifiants dans .env
- Vérifier les privilèges de l'utilisateur MySQL

### Erreur "Database does not exist"
- Vérifier le nom de la base dans cPanel
- Vérifier DB_DATABASE dans .env

### Erreur de migration
```bash
# Réinitialiser les migrations
php artisan migrate:fresh --seed
```

## ✅ CHECKLIST POST-DÉPLOIEMENT
- [ ] Site accessible
- [ ] Connexion admin fonctionnelle
- [ ] Base de données MySQL connectée
- [ ] Toutes les pages se chargent
- [ ] Formulaires fonctionnels
- [ ] Pas d'erreurs dans les logs
- [ ] Changer le mot de passe admin par défaut

## 📞 SUPPORT
En cas de problème, vérifier:
1. Les logs Laravel: `storage/logs/laravel.log`
2. Les logs d'erreur cPanel
3. La configuration .env
4. Les permissions des dossiers