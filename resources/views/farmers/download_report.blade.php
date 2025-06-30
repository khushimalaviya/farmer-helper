<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Farm Report</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
        }
        .section {
            margin-bottom: 25px;
        }
        h1, h2 {
            color: #2e7d32;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Farm Report</h1>

    <div class="section">
        <h2>Farm Details</h2>
        <p><strong>City:</strong> {{ $farm->city }}</p>
        <p><strong>Soil Type:</strong> {{ $farm->soil_type }}</p>
        <p><strong>Season:</strong> {{ $farm->season }}</p>
    </div>

    <div class="section">
        <h2>Weather Data</h2>
        @if($weatherData)
            <p><strong>Temperature:</strong> {{ $weatherData->temperature }} °C</p>
            <p><strong>Humidity:</strong> {{ $weatherData->humidity }} %</p>
            <p><strong>Rainfall:</strong> {{ $weatherData->rainfall }} mm</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($weatherData->forecast_date)->toFormattedDateString() }}</p>
        @else
            <p>No weather data available.</p>
        @endif
    </div>

    <div class="section">
        <h2>Recommended Crops</h2>
        @if($recommendedCrops)
            <ul>
                @foreach($recommendedCrops as $crop)
                    <li><strong>{{ $crop['crop'] }}</strong> – Confidence: {{ $crop['confidence'] }}</li>
                @endforeach
            </ul>
        @else
            <p>No crop recommendation available.</p>
        @endif
    </div>

    <p style="margin-top: 40px; font-size: 0.9em; color: #555;">
        Generated on {{ now()->toDayDateTimeString() }}
    </p>
</body>
</html>
