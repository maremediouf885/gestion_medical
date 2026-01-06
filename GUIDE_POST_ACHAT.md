# 🚀 GUIDE POST-ACHAT DOMAINE - ÉTAPES EXACTES

## ⏰ TIMELINE APRÈS ACHAT (2-3 HEURES MAX)

### 🕐 ÉTAPE 1: RÉCEPTION EMAILS (5 min)
Après achat Hostinger, vous recevrez:
- ✅ **Email de confirmation** avec détails compte
- ✅ **Accès cPanel** (username/password)
- ✅ **Détails serveur** (nameservers, IP)
- ✅ **Certificat SSL** (activation automatique)

### 🕐 ÉTAPE 2: ACCÈS CPANEL (10 min)
1. **Connexion cPanel**:
   - URL: `https://cpanel.votre-domaine.com:2083`
   - Ou via Hostinger panel → "Manage"

2. **Vérifications initiales**:
   - [ ] Domaine actif
   - [ ] SSL installé (cadenas vert)
   - [ ] PHP 8.2+ activé
   - [ ] MySQL disponible

### 🕐 ÉTAPE 3: CONFIGURATION BASE DE DONNÉES (15 min)
Dans cPanel → **MySQL Databases**:

```sql
-- 1. Créer base de données
Nom: username_medical

-- 2. Créer utilisateur
Username: username_medical
Password: [GÉNÉRER MOT DE PASSE FORT]

-- 3. Associer utilisateur à BDD
Privilèges: ALL PRIVILEGES
```

### 🕐 ÉTAPE 4: UPLOAD PROJET (20 min)
1. **Préparer archive**:
```bash
# Sur votre PC
cd d:\gestion_medical\gestion_medical
zip -r deploy.zip . -x "node_modules/*" "vendor/*" ".git/*"
```

2. **Upload via File Manager**:
   - cPanel → File Manager
   - Aller dans `public_html`
   - Upload `deploy.zip`
   - Extraire l'archive
   - Déplacer tous les fichiers vers `public_html`

### 🕐 ÉTAPE 5: CONFIGURATION .ENV (10 min)
Éditer `.env` avec vos vraies valeurs:

```env
APP_NAME="Gestion Médicale"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_medical
DB_USERNAME=username_medical
DB_PASSWORD=votre_mot_de_passe_bdd

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
```

### 🕐 ÉTAPE 6: INSTALLATION LARAVEL (15 min)
Via Terminal cPanel ou SSH:

```bash
cd public_html

# Installation
composer install --no-dev --optimize-autoloader

# Configuration Laravel
php artisan key:generate
php artisan config:cache
php artisan route:cache

# Base de données
php artisan migrate
php artisan db:seed --class=DefaultAdminSeeder

# Permissions
chmod -R 755 storage bootstrap/cache
```

### 🕐 ÉTAPE 7: TEST FINAL (10 min)
1. **Accéder au site**: `https://votre-domaine.com`
2. **Login admin**:
   - Email: `admin@gestion-medical.com`
   - Password: `admin123`
3. **Tester fonctionnalités**:
   - Dashboard
   - Créer un patient
   - Ajouter vaccination
   - Planifier rendez-vous

## 📧 EMAILS QUE VOUS RECEVREZ

### 1. **Email Hostinger - Confirmation**
```
Sujet: Bienvenue chez Hostinger
- Détails de votre compte
- Lien vers hPanel
- Informations de facturation
```

### 2. **Email cPanel - Accès**
```
Sujet: Détails de votre compte d'hébergement
- URL cPanel: https://cpanel.votre-domaine.com:2083
- Username: [votre_username]
- Password: [votre_password]
- Serveur: [server_name]
```

### 3. **Email SSL - Activation**
```
Sujet: Certificat SSL activé
- Votre site est maintenant sécurisé
- Accès HTTPS disponible
```

## 🚨 PROBLÈMES POSSIBLES & SOLUTIONS

### ❌ **Site inaccessible après 24h**
```bash
# Vérifier DNS
nslookup votre-domaine.com
# Si pas de réponse, contacter support Hostinger
```

### ❌ **Erreur 500**
```bash
# Vérifier logs
tail -f storage/logs/laravel.log
# Vérifier permissions
chmod -R 755 storage
```

### ❌ **Base de données inaccessible**
```bash
# Tester connexion
php artisan tinker
DB::connection()->getPdo();
```

## 📞 SUPPORT HOSTINGER
- **Chat 24/7**: Via hPanel
- **Email**: support@hostinger.com
- **Téléphone**: Disponible dans votre compte

## ✅ CHECKLIST FINAL
- [ ] Site accessible via HTTPS
- [ ] Login admin fonctionne
- [ ] Base de données connectée
- [ ] Toutes les pages se chargent
- [ ] Formulaires fonctionnels
- [ ] Pas d'erreurs dans les logs
- [ ] Mot de passe admin changé

## 🎯 RÉSULTAT ATTENDU
**Après 2-3 heures maximum**: Site complètement fonctionnel sur votre domaine avec HTTPS et toutes les fonctionnalités opérationnelles.

## 📱 CONTACT URGENCE
Si problème: maremediouf885@gmail.com