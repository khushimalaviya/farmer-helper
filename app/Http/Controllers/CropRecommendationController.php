<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropRecommendationController extends Controller
{
    public function step1()
    {
        return view('crop-form.step1');
    }

    public function step2(Request $request)
    {
        $request->validate([
            'soil_type' => 'required',
            'land_area' => 'required|numeric|min:0.1',
            'area_unit' => 'required',
            'nitrogen' => 'required|numeric|min:0',
            'phosphorus' => 'required|numeric|min:0',
            'potassium' => 'required|numeric|min:0',
            'ph' => 'required|numeric|between:0,14',
        ]);

        session(['step1_data' => $request->all()]);
        return view('crop-form.step2');
    }

    public function result(Request $request)
    {
        $request->validate([
            'water_source' => 'required',
            'season' => 'required',
        ]);

        $data = array_merge(session('step1_data'), $request->all());
        return view('crop-form.result', compact('data'));
    }
}
