# ✅ CHECKLIST DÉPLOIEMENT

## AVANT UPLOAD
- [ ] Cache nettoyé (php artisan cache:clear)
- [ ] Composer optimisé (--no-dev --optimize-autoloader)
- [ ] Assets compilés (npm run build)
- [ ] .env.production préparé
- [ ] ZIP créé (sans node_modules, .git)

## SUR SERVEUR
- [ ] Fichiers uploadés dans public_html
- [ ] .env configuré avec bon domaine
- [ ] Clé générée (php artisan key:generate)
- [ ] Migrations exécutées
- [ ] Admin créé (DefaultAdminSeeder)
- [ ] Permissions définies (755 storage)
- [ ] Cache production activé

## TEST FINAL
- [ ] Site accessible via domaine
- [ ] Connexion admin fonctionne
- [ ] Création personnel fonctionne
- [ ] Connexion personnel fonctionne
- [ ] Toutes les pages se chargent
- [ ] Base de données opérationnelle

## IDENTIFIANTS ADMIN
Email: admin@gestion-medical.com
Username: admin
Password: admin123