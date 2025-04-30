<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\DailyWeatherReportMail;

class SendWeatherReport implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new job instance.
     * 
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $latitude = $this->user->latitude;
        $longitude = $this->user->longitude;
        $apiKey = env('WEATHERSTACK_API_KEY');  // Replace with your weather API key

        try {
            // Fetch weather data using latitude and longitude
            $response = Http::get("http://api.weatherstack.com/current", [
                'access_key' => $apiKey,
                'query' => "{$latitude},{$longitude}"
            ]);

            // Handle API failure
            if ($response->failed()) {
                Log::error('Weather API request failed for user: ' . $this->user->id);
                return; // Optionally you could retry or log failure
            }

            $weatherData = $response->json();

            // Handle the case where the weather data is invalid or missing
            if (isset($weatherData['error'])) {
                Log::error('Weather API error for user: ' . $this->user->id . ' - ' . $weatherData['error']['info']);
                return;
            }

            // Prepare the weather details
            $weatherDetails = [
                'temperature' => $weatherData['current']['temperature'],
                'weather_description' => $weatherData['current']['weather_descriptions'][0],
                'humidity' => $weatherData['current']['humidity'],
                'wind_speed' => $weatherData['current']['wind_speed'],
            ];

            Log::info("Sending email to: " . $this->user->email);
            Mail::to($this->user->email)->send(new DailyWeatherReportMail($this->user, $weatherDetails));
            Log::info("Email sent to: " . $this->user->email);
            
        } catch (\Exception $e) {
            Log::error('Error fetching weather data for user: ' . $this->user->id . ' - ' . $e->getMessage());
        }
    }
}
