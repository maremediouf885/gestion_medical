# ✅ CHECKLIST DÉPLOIEMENT MYSQL - 30 MINUTES

## 🕐 19h00 - PRÉPARATION (5 min)
- [ ] Créer archive: `zip -r deploy.zip . -x "node_modules/*" "vendor/*" ".git/*"`
- [ ] Vérifier que `.env.production.cpanel` est configuré
- [ ] Noter les identifiants cPanel

## 🕐 19h05 - CPANEL SETUP (5 min)
- [ ] Connexion cPanel
- [ ] **MySQL Databases** → Créer BDD: `username_medical`
- [ ] Créer utilisateur MySQL avec même nom
- [ ] Associer utilisateur à la BDD (tous privilèges)
- [ ] Noter: nom BDD, utilisateur, mot de passe

## 🕐 19h10 - UPLOAD & CONFIG (5 min)
- [ ] **File Manager** → `public_html`
- [ ] Upload `deploy.zip` et extraire
- [ ] Copier `.env.production.cpanel` vers `.env`
- [ ] Éditer `.env` avec vraies valeurs BDD:
  ```
  DB_DATABASE=username_medical
  DB_USERNAME=username_medical  
  DB_PASSWORD=mot_de_passe_fort
  APP_URL=https://votre-domaine.com
  ```

## 🕐 19h15 - INSTALLATION (5 min)
Terminal cPanel:
```bash
cd public_html
composer install --no-dev
php artisan key:generate
php artisan migrate
php artisan db:seed --class=DefaultAdminSeeder
chmod -R 755 storage bootstrap/cache
```

## 🕐 19h20 - TESTS (5 min)
- [ ] Tester: `php test-mysql.php`
- [ ] Accéder au site: `https://votre-domaine.com`
- [ ] Login admin: `admin@gestion-medical.com` / `admin123`
- [ ] Vérifier dashboard, patients, vaccinations

## 🕐 19h25 - FINALISATION (5 min)
- [ ] Changer mot de passe admin
- [ ] Tester création patient
- [ ] Tester rendez-vous
- [ ] Vérifier logs: `storage/logs/laravel.log`

## 🚨 DÉPANNAGE RAPIDE

### Erreur MySQL
```bash
php artisan config:clear
php artisan migrate:fresh --seed
```

### Site inaccessible
- Vérifier `.htaccess` dans `public/`
- Vérifier permissions: `chmod -R 755 storage`

### Erreur 500
- Vérifier `storage/logs/laravel.log`
- Vérifier `.env` (pas d'espaces, guillemets corrects)

## 📱 CONTACTS URGENCE
- Support hébergeur: [NUMÉRO]
- Admin système: [CONTACT]

---
**🎯 OBJECTIF: Site fonctionnel en 30 minutes maximum !**