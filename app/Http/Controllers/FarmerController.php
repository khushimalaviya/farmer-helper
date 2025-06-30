<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

use Barryvdh\DomPDF\Facade as PDF;
use mPDF;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Weather;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\CropRecommendationMail;


class FarmerController extends Controller
{
    public function farmData()
    {
        return view('farmers.farm_data');
    }

    public function submitFarmData(Request $request)
    {
        $data = $request->all();
        \Log::info('Received Form Data:', $data);

        // Step 1: Validate
        $request->validate([
            'soil_type' => 'required|string|in:Sandy,Loamy,Clayey,Black,Red,Alluvial',
            'season' => 'required|string|in:Kharif,Rabi,Zaid,Spring,Autumn',
            'temperature' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
            'rainfall' => 'nullable|numeric'
        ]);

        // Step 2: Save or update farm details
        $farm = Farm::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'city' => $request->city,
                'soil_type' => $request->soil_type,
                'season' => $request->season,
                'temperature' => $request->temperature,
                'humidity' => $request->humidity,
            ]
        );

        // Step 3: Save weather data
        if ($request->has(['temperature', 'humidity', 'rainfall']) && $request->temperature !== null) {
            Weather::create([
                'farm_id' => $farm->id,
                'temperature' => $request->temperature,
                'humidity' => $request->humidity,
                'rainfall' => $request->rainfall,
                'forecast_date' => now(),
            ]);
        } else {
            \Log::error('Weather data missing or invalid.', [
                'Temperature' => $request->temperature,
                'Humidity' => $request->humidity,
                'Rainfall' => $request->rainfall,
            ]);
            return back()->withErrors('Weather data is missing or invalid. Please try again.');
        }

        // Step 4: Call ML crop recommendation API
        $recommendedCrops = null;
        try {
            $response = Http::post('http://127.0.0.1:5001/predict-crop', [
                'soil_type' => $request->soil_type,
                'season' => $request->season,
                'temperature' => (float) $request->temperature,
                'humidity' => (float) $request->humidity,
            ]);

            if ($response->successful()) {
                $recommendedCrops = $response->json()['recommended_crops'];
            } else {
                \Log::error('ML API returned an error:', $response->json());
            }
        } catch (\Exception $e) {
            \Log::error('Exception while calling ML API: ' . $e->getMessage());
        }


        // Step 5: Send Email
        if ($recommendedCrops) {
            $user = auth()->user();
            Mail::to($user->email)->send(new CropRecommendationMail($recommendedCrops, $farm, $user));
        }

        // Step 6: Show result on page
        return view('farmers.crop_recommendation', [
            'recommendedCrops' => $recommendedCrops,
            'farm' => $farm,
        ]);

    }

    public function downloadReport($farmId)
    {
        // Fetch farm data
        $farm = Farm::findOrFail($farmId);

        // Fetch latest weather data
        $weatherData = Weather::where('farm_id', $farmId)->latest()->first();

        // Dynamic crop recommendation via ML API
        $recommendedCrops = null;

        try {
            $response = Http::post('http://127.0.0.1:5001/predict-crop', [
                'soil_type' => $farm->soil_type,
                'season' => $farm->season,
                'temperature' => (float) $farm->temperature,
                'humidity' => (float) optional($weatherData)->humidity,
            ]);

            if ($response->successful()) {
                $recommendedCrops = $response->json()['recommended_crops'];
            } else {
                \Log::error('ML API error in PDF download:', $response->json());
            }
        } catch (\Exception $e) {
            \Log::error('ML API Exception in PDF download: ' . $e->getMessage());
        }

        // Initialize Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Load view and pass data
        $dompdf->loadHtml(view('farmers.download_report', [
            'farm' => $farm,
            'weatherData' => $weatherData,
            'recommendedCrops' => $recommendedCrops,
        ])->render());

        // Set paper size and render
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Return PDF download
        return $dompdf->stream('farm_report.pdf', ['Attachment' => 1]);
    }
}
