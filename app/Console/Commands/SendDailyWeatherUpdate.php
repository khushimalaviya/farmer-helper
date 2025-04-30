<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\DailyWeatherReportMail;
use App\Jobs\SendWeatherReport;

class SendDailyWeatherUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-weather-update';
    // protected $description = 'Send daily weather reports to all registered farmers';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily weather report to all registered farmers';
    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        info("Cron Job running at " . now());
        // $farmers = User::whereNotNull('latitude')->whereNotNull('longitude')->get();

        // foreach ($farmers as $farmer) {
        //     SendWeatherReport::dispatch($farmer);  // Dispatch the job for each farmer
        //     logger("Dispatched weather report job for user: " . $farmer->id);
        // }

        // $this->info('Daily weather reports sent!');
        // logger()->info('All jobs dispatched for sending weather reports.');
    }


}
