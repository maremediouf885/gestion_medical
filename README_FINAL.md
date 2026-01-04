# 🏥 Système de Gestion Médicale

Application Laravel complète pour la gestion médicale des patients et pèlerins.

## ✨ Fonctionnalités

### 🔐 Authentification
- Connexion sécurisée avec Laravel Breeze
- Protection de toutes les routes
- Gestion des sessions

### 👥 Gestion des Patients
- Création et modification des patients/pèlerins
- Recherche avancée (nom, prénom, téléphone, numéro)
- Filtre par type (patient/pèlerin)
- Désactivation (soft delete)
- Historique des vaccinations

### 💉 Vaccinations
- Enregistrement des vaccinations
- Gestion transactionnelle avec le stock
- Traçabilité complète (qui, quand, quoi)
- Prévention des erreurs de stock

### 📦 Stock des Vaccins
- Référentiel des vaccins (obligatoires, recommandés, optionnels)
- Suivi des stocks (reçu/utilisé/disponible)
- Gestion FIFO (premier entré, premier sorti)
- Alertes stock faible

### 📅 Rendez-vous
- Agenda par jour avec navigation
- Prévention des conflits de créneaux
- Statuts (programmé, confirmé, annulé, terminé)
- Interface intuitive

### 📊 Dashboard
- Indicateurs clés en temps réel
- Vaccinations du jour
- Alertes stock faible
- Rendez-vous à venir

## 🚀 Installation

### Prérequis
- PHP 8.1+
- PostgreSQL
- Composer
- Node.js & NPM

### Étapes
1. Cloner le projet
2. Copier `.env.example` vers `.env`
3. Configurer la base de données PostgreSQL
4. Installer les dépendances :
   ```bash
   composer install
   npm install
   ```
5. Générer la clé d'application :
   ```bash
   php artisan key:generate
   ```
6. Exécuter les migrations :
   ```bash
   php artisan migrate
   ```
7. Compiler les assets :
   ```bash
   npm run build
   ```

## 👤 Compte Admin par Défaut
- **Email :** admin@gestion-medical.com
- **Mot de passe :** admin123

## 🔧 Configuration Production

### Optimisations
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer dump-autoload --optimize
```

### Variables d'environnement importantes
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=pgsql
CACHE_STORE=database
SESSION_DRIVER=database
```

## 📁 Structure du Projet

```
app/
├── Models/
│   ├── Patient.php          # Gestion patients/pèlerins
│   ├── Vaccin.php           # Référentiel vaccins
│   ├── StockVaccin.php      # Gestion stocks
│   ├── Vaccination.php      # Enregistrement vaccinations
│   ├── RendezVous.php       # Gestion agenda
│   └── Consultation.php     # Consultations médicales
├── Http/Controllers/
│   ├── PatientController.php
│   ├── VaccinationController.php
│   └── RendezVousController.php
└── Http/Middleware/
    └── CheckPatientAccess.php

resources/views/
├── patients/               # Vues patients
├── vaccinations/          # Vues vaccinations
├── rendez-vous/          # Vues agenda
└── dashboard.blade.php   # Tableau de bord
```

## 🛡️ Sécurité

- ✅ Protection CSRF sur tous les formulaires
- ✅ Validation des données d'entrée
- ✅ Authentification obligatoire
- ✅ Vérification des permissions
- ✅ Transactions atomiques
- ✅ Prévention des conflits

## 📈 Performance

- Cache des configurations, routes et vues
- Autoloader optimisé
- Index sur les colonnes critiques
- Pagination des listes
- Requêtes optimisées avec relations

## 🔍 Tests Fonctionnels

### Scénarios de test
1. **Créer un patient**
   - Aller sur Patients → Nouveau Patient
   - Remplir le formulaire
   - Vérifier la création

2. **Enregistrer une vaccination**
   - Aller sur Vaccinations → Nouvelle Vaccination
   - Sélectionner patient et vaccin
   - Vérifier la déduction du stock

3. **Prendre un rendez-vous**
   - Aller sur Agenda → Nouveau RDV
   - Choisir un créneau libre
   - Vérifier l'absence de conflit

4. **Consulter le dashboard**
   - Vérifier les indicateurs
   - Tester la navigation

## 📞 Support

Pour toute question ou problème :
- Vérifier les logs : `storage/logs/laravel.log`
- Vider le cache : `php artisan cache:clear`
- Recréer les caches : `php artisan optimize`

## 📄 Licence

Ce projet est sous licence MIT.