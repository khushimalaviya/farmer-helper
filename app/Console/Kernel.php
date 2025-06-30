<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendDailyWeatherUpdate;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        // Optionally include routes/console.php
        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule the daily weather update command at 8 AM
        // Schedule::command(command: SendDailyWeatherUpdate::class)->dailyAt('19:57');
        Schedule::command(command: SendDailyWeatherUpdate::class)->everyMinute();


    }

    /**
     * Register the Artisan commands for the application.
     */
    protected $commands = [
        SendDailyUpdates::class,
    ];
}
