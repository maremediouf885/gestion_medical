<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\BackupMedicalDatabase::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Sauvegarde quotidienne à 2h du matin
        $schedule->command('medical:backup')
                 ->dailyAt('02:00')
                 ->withoutOverlapping()
                 ->runInBackground();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}