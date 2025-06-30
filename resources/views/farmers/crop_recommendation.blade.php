@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-6">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h1 class="text-2xl font-bold text-green-700 mb-6 text-center">
                🌾 Recommended Crop Based on Your Farm Data
            </h1>

            @if($recommendedCrops)
                <div class="bg-green-100 border-l-4 border-green-500 text-green-900 p-4 rounded mb-6">
                    <p class="text-lg font-semibold">Top recommended crops for your farm:</p>
                    <ul class="mt-2 list-disc list-inside space-y-1">
                        @foreach($recommendedCrops as $crop)
                            <li class="text-lg font-bold">{{ $crop['crop'] }} 
                                {{-- <span class="text-sm text-gray-600">({{ $crop['confidence'] }})</span></li> --}}
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="bg-red-100 border-l-4 border-red-500 text-red-900 p-4 rounded mb-6">
                    <p class="text-lg font-semibold">Sorry, we couldn't determine a suitable crop at this moment.</p>
                </div>
            @endif


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                <div class="bg-gray-50 p-4 rounded shadow">
                    <p class="font-medium text-gray-700">Soil Type</p>
                    <p class="text-lg">{{ $farm->soil_type }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded shadow">
                    <p class="font-medium text-gray-700">Season</p>
                    <p class="text-lg">{{ $farm->season }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded shadow">
                    <p class="font-medium text-gray-700">Temperature (°C)</p>
                    <p class="text-lg">{{ $farm->temperature ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded shadow">
                    <p class="font-medium text-gray-700">Humidity (%)</p>
                    <p class="text-lg">{{ $farm->humidity ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('farmdata.submit') }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                    🌱 Submit New Farm Data
                </a>
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('farmers.downloadReport', $farm->id) }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    📥 Download Report
                </a>
            </div>

        </div>
    </div>
@endsection