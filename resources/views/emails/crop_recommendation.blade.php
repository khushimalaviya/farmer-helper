<!DOCTYPE html>
<html>

<head>
    <title>Crop Recommendation</title>
</head>

<body>
    <h2>Dear {{ $user->name }},</h2>

    <p>Based on the farm data you provided:</p>

    <ul>
        {{-- <li><strong>City:</strong> {{ $farm->city }}</li> --}}
        <li><strong>Soil Type:</strong> {{ $farm->soil_type }}</li>
        <li><strong>Season:</strong> {{ $farm->season }}</li>
        <li><strong>Temperature:</strong> {{ $farm->temperature }} °C</li>
        <li><strong>Humidity:</strong> {{ $farm->humidity }} %</li>
    </ul>

    <p>🌾 <strong>Our recommended crops for your farm is:</strong>
    <ul>
        @foreach ($recommendedCrops as $crop)
            <li>
                <strong>{{ $crop['crop'] }}</strong>
            </li>
        @endforeach
    </ul>
    </p>

    <p>Happy farming! <br> The Farmer Helper Team</p>
</body>

</html>