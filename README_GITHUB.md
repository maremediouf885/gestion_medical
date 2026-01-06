# 🏥 Système de Gestion Médicale

[![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)

## 🚀 Installation Rapide

```bash
git clone https://github.com/maremediouf885/gestion_medical.git
cd gestion_medical
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=DefaultAdminSeeder
php artisan serve
```

## 🔑 Compte Admin
- **Email:** admin@gestion-medical.com
- **Username:** admin
- **Mot de passe:** admin123

## 📋 Fonctionnalités
- ✅ Gestion patients/pèlerins
- ✅ Système vaccination
- ✅ Rendez-vous médicaux
- ✅ Stock vaccins
- ✅ Personnel médical
- ✅ Interface responsive

## 🛠️ Technologies
- Laravel 11
- PHP 8.2+
- MySQL/SQLite
- Tailwind CSS
- Font Awesome

## 📦 Déploiement
Voir `GUIDE_DEPLOY_CPANEL_MYSQL.md` pour le déploiement complet.

## 📞 Contact
Email: maremediouf885@gmail.com