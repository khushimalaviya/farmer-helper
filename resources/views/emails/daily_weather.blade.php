<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Weather Report</title>
</head>
<body>
    <h1>Weather Report</h1>
    <p>Temperature: {{ $weather['temperature'] }}°C</p>
    <p>Description: {{ $weather['weather_description'] }}</p>
    <p>Humidity: {{ $weather['humidity'] }}%</p>
    <p>Wind Speed: {{ $weather['wind_speed'] }} km/h</p>
</body>
</html>
