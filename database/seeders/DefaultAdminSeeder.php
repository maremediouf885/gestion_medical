<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate([
            'email' => 'admin@gestion-medical.com'
        ], [
            'name' => 'Administrateur',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Admin créé: admin@gestion-medical.com / admin123');
    }
}