<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendWeatherReport;
use Illuminate\Support\Facades\Log;

class SendDailyWeatherEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:weather-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily weather email reports to all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            Log::info('No users found for weather report job.');
            return;
        }

        foreach ($users as $user) {
            if (!$user->latitude || !$user->longitude) {
                Log::warning("User {$user->id} skipped due to missing lat/lon.");
                continue;
            }

            SendWeatherReport::dispatch($user);
        }

        Log::info('Weather report jobs dispatched for ' . $users->count() . ' users at ' . now());
        $this->info('Weather email jobs dispatched successfully.');

    }
}
