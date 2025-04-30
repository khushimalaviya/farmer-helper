<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Weather;

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

        // Validation
        $request->validate([
            'soil_type' => 'required|string|in:Sandy,Loamy,Clayey,Black,Red,Alluvial',
            'land_area' => 'required|numeric|min:0.1',
            'water_source' => 'required|string|in:Well,Rainwater,Canal,Borewell,River',
            'season' => 'required|string|in:Kharif,Rabi,Zaid,Spring,Autumn',
            'temperature' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
            'rainfall' => 'nullable|numeric'
        ]);

        // Insert or update farm data
        $farm = Farm::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'city' => $request->city,
                'soil_type' => $request->soil_type,
                'land_area' => $request->land_area,
                'water_source' => $request->water_source,
                'season' => $request->season,
            ]
        );

        // Insert Weather Data
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

        return back()->with('success', 'Farm data saved successfully!');
    }
}
