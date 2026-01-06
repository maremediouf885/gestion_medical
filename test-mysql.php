<?php

/**
 * 🧪 SCRIPT DE TEST MYSQL - GESTION MÉDICALE
 * Utilisation: php test-mysql.php
 */

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

echo "🧪 TEST DE CONNEXION MYSQL\n";
echo "==========================\n\n";

// Charger les variables d'environnement
if (file_exists('.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    echo "✅ Fichier .env chargé\n";
} else {
    echo "❌ Fichier .env introuvable\n";
    exit(1);
}

// Configuration de la base de données
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => $_ENV['DB_CONNECTION'] ?? 'mysql',
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'port' => $_ENV['DB_PORT'] ?? '3306',
    'database' => $_ENV['DB_DATABASE'] ?? '',
    'username' => $_ENV['DB_USERNAME'] ?? '',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

echo "🔧 Configuration MySQL:\n";
echo "   Host: " . ($_ENV['DB_HOST'] ?? 'localhost') . "\n";
echo "   Port: " . ($_ENV['DB_PORT'] ?? '3306') . "\n";
echo "   Database: " . ($_ENV['DB_DATABASE'] ?? 'N/A') . "\n";
echo "   Username: " . ($_ENV['DB_USERNAME'] ?? 'N/A') . "\n\n";

// Test de connexion
try {
    $pdo = $capsule->getConnection()->getPdo();
    echo "✅ Connexion MySQL réussie !\n";
    
    // Test de version MySQL
    $version = $capsule->select('SELECT VERSION() as version')[0]->version;
    echo "📊 Version MySQL: $version\n";
    
    // Test des tables existantes
    $tables = $capsule->select('SHOW TABLES');
    echo "📋 Tables existantes: " . count($tables) . "\n";
    
    if (count($tables) > 0) {
        echo "   Tables trouvées:\n";
        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            echo "   - $tableName\n";
        }
    }
    
    // Test de la table users si elle existe
    try {
        $userCount = $capsule->table('users')->count();
        echo "👥 Utilisateurs dans la base: $userCount\n";
        
        if ($userCount > 0) {
            $admin = $capsule->table('users')
                ->where('email', 'admin@gestion-medical.com')
                ->first();
            
            if ($admin) {
                echo "🔑 Compte admin trouvé: " . $admin->email . "\n";
            } else {
                echo "⚠️  Compte admin non trouvé\n";
            }
        }
    } catch (Exception $e) {
        echo "⚠️  Table users non trouvée (migrations non exécutées)\n";
    }
    
    echo "\n🎉 Test MySQL terminé avec succès !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur de connexion MySQL:\n";
    echo "   " . $e->getMessage() . "\n\n";
    
    echo "🔧 Vérifications à effectuer:\n";
    echo "   1. MySQL est-il installé et démarré ?\n";
    echo "   2. Les identifiants dans .env sont-ils corrects ?\n";
    echo "   3. La base de données existe-t-elle ?\n";
    echo "   4. L'utilisateur a-t-il les bonnes permissions ?\n";
    
    exit(1);
}