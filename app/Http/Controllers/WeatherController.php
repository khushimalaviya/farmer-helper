<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Jobs\FetchWeatherData;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    public function index()
    {
        return view('pages.weather');
    }

    public function getWeather(Request $request)
    {
        $apiKey = env('WEATHERSTACK_API_KEY');
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $query = "{$latitude},{$longitude}";

        try {
            $response = Http::get("http://api.weatherstack.com/current", [
                'access_key' => $apiKey,
                'query' => $query
            ]);

            if ($response->failed()) {
                Log::error('API Request Failed: ' . $response->body());
                return response()->json(['error' => 'Weather data request failed.']);
            }

            $weatherData = $response->json();
            if (isset($weatherData['error'])) {
                return response()->json(['error' => $weatherData['error']['info']], 400);
            }


            // ✅ Save latitude and longitude to the currently authenticated user
            $user = Auth::user();
            if ($user) {
                $user->latitude = $latitude;
                $user->longitude = $longitude;
                $user->save();
            }


            return response()->json($weatherData);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching weather data.']);
        }
    }

    public function fetchWeatherData(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Validate latitude and longitude
        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            return response()->json(['error' => 'Invalid coordinates'], 400);
        }

        // Dispatch the job with coordinates
        FetchWeatherData::dispatch($latitude, $longitude);

        return response()->json(['message' => 'Weather data fetching started']);
    }

}
