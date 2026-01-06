#!/bin/bash

# 🧪 SCRIPT DE VÉRIFICATION POST-DÉPLOIEMENT
echo "🏥 VÉRIFICATION SYSTÈME GESTION MÉDICALE"
echo "========================================"

# Variables à modifier
DOMAIN="votre-domaine.com"
ADMIN_EMAIL="admin@gestion-medical.com"
ADMIN_PASSWORD="admin123"

echo "🌐 Domaine testé: $DOMAIN"
echo ""

# 1. Test accessibilité site
echo "1️⃣ Test accessibilité HTTPS..."
if curl -s -o /dev/null -w "%{http_code}" "https://$DOMAIN" | grep -q "200"; then
    echo "✅ Site accessible en HTTPS"
else
    echo "❌ Site inaccessible"
fi

# 2. Test SSL
echo ""
echo "2️⃣ Test certificat SSL..."
if curl -s -I "https://$DOMAIN" | grep -q "200 OK"; then
    echo "✅ SSL fonctionnel"
else
    echo "❌ Problème SSL"
fi

# 3. Test base de données (via artisan)
echo ""
echo "3️⃣ Test base de données..."
if php artisan migrate:status > /dev/null 2>&1; then
    echo "✅ Base de données connectée"
    
    # Compter les migrations
    MIGRATIONS=$(php artisan migrate:status | grep -c "Ran")
    echo "   📊 Migrations exécutées: $MIGRATIONS"
    
    # Vérifier utilisateur admin
    if php artisan tinker --execute="echo App\Models\User::where('email', '$ADMIN_EMAIL')->exists() ? 'EXISTS' : 'NOT_FOUND';" | grep -q "EXISTS"; then
        echo "✅ Compte admin trouvé"
    else
        echo "❌ Compte admin manquant"
    fi
else
    echo "❌ Problème base de données"
fi

# 4. Test permissions
echo ""
echo "4️⃣ Test permissions..."
if [ -w "storage/logs" ]; then
    echo "✅ Permissions storage OK"
else
    echo "❌ Problème permissions storage"
fi

# 5. Test configuration Laravel
echo ""
echo "5️⃣ Test configuration Laravel..."
if php artisan config:show app.env | grep -q "production"; then
    echo "✅ Mode production activé"
else
    echo "⚠️  Mode développement (à changer)"
fi

# 6. Test des routes principales
echo ""
echo "6️⃣ Test routes principales..."
ROUTES=("/" "/login" "/dashboard")

for route in "${ROUTES[@]}"; do
    if curl -s -o /dev/null -w "%{http_code}" "https://$DOMAIN$route" | grep -q "200\|302"; then
        echo "✅ Route $route accessible"
    else
        echo "❌ Route $route inaccessible"
    fi
done

# 7. Test logs d'erreur
echo ""
echo "7️⃣ Vérification logs..."
if [ -f "storage/logs/laravel.log" ]; then
    ERROR_COUNT=$(grep -c "ERROR" storage/logs/laravel.log 2>/dev/null || echo "0")
    if [ "$ERROR_COUNT" -eq 0 ]; then
        echo "✅ Aucune erreur dans les logs"
    else
        echo "⚠️  $ERROR_COUNT erreurs trouvées dans les logs"
    fi
else
    echo "✅ Pas de fichier de log (normal si nouveau)"
fi

echo ""
echo "🎯 RÉSUMÉ DU TEST"
echo "=================="
echo "Site: https://$DOMAIN"
echo "Admin: $ADMIN_EMAIL"
echo "Password: $ADMIN_PASSWORD"
echo ""
echo "🔧 Si des erreurs persistent:"
echo "1. Vérifier le fichier .env"
echo "2. Contrôler les logs: storage/logs/laravel.log"
echo "3. Tester les permissions: chmod -R 755 storage"
echo "4. Contacter le support Hostinger si nécessaire"