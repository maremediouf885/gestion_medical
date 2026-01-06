<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Créer le compte administrateur par défaut';

    public function handle()
    {
        $admin = User::firstOrCreate([
            'email' => 'admin@gestion-medical.com'
        ], [
            'name' => 'Administrateur',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        if ($admin->wasRecentlyCreated) {
            $this->info('✅ Compte admin créé avec succès !');
        } else {
            $this->info('ℹ️ Compte admin existe déjà.');
        }

        $this->info('📧 Email: admin@gestion-medical.com');
        $this->info('🔑 Mot de passe: admin123');
        
        return 0;
    }
}