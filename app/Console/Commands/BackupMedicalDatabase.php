<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupMedicalDatabase extends Command
{
    protected $signature = 'medical:backup';
    protected $description = 'Sauvegarde sécurisée de la base de données médicale';

    public function handle()
    {
        $filename = 'backup_medical_' . date('Y-m-d_H-i-s') . '.sql';
        $path = storage_path('app/backups/' . $filename);
        
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.host'),
            config('database.connections.mysql.database'),
            $path
        );

        exec($command);
        
        $encrypted = encrypt(file_get_contents($path));
        file_put_contents($path . '.encrypted', $encrypted);
        unlink($path);

        $this->info('Sauvegarde créée: ' . $filename . '.encrypted');
    }
}