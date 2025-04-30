@extends('layouts.app')

@section('title', 'Weather Information')

@section('content')
    <p id="error-message" style="color: red;"></p>

    <!-- Display Weather Data -->
    <div id="weather-data" class="container p-4 shadow-lg bg-white rounded" style="display: none;">
        <h3 class="mb-3">Weather Information for <span id="city-name"></span>, <span id="country-name"></span></h3>
        <p><strong>Region:</strong> <span id="region-name"></span></p>
        <p><strong>Local Time:</strong> <span id="local-time"></span></p>

        <!-- Current Weather Details -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>🌦 Current Weather</h4>
                <p><strong>Observation Time:</strong> <span id="observation-time"></span></p>
                <p><strong>Temperature:</strong> <span id="temperature"></span> °C</p>
                <p><strong>Feels Like:</strong> <span id="feelslike"></span> °C</p>
                <p><strong>Condition:</strong> <span id="condition"></span></p>
                <p><strong>Estimated Rainfall:</strong> <span id="rainfall-mm"></span>mm</p>
                <img id="weather-icon" alt="Weather Icon" class="my-2" style="height: 80px;">
            </div>

            <!-- Astronomical Data -->
            <div class="col-md-6">
                <h4>🌙 Astronomical Data</h4>
                <p><strong>Sunrise:</strong> <span id="sunrise"></span></p>
                <p><strong>Sunset:</strong> <span id="sunset"></span></p>
                <p><strong>Moonrise:</strong> <span id="moonrise"></span></p>
                <p><strong>Moonset:</strong> <span id="moonset"></span></p>
                <p><strong>Moon Phase:</strong> <span id="moon-phase"></span></p>
                <p><strong>Moon Illumination:</strong> <span id="moon-illumination"></span>%</p>
            </div>
        </div>

        <!-- Air Quality Details -->
        <h4>🌿 Air Quality</h4>
        <div class="row">
            <div class="col-md-6">
                <p><strong>CO:</strong> <span id="co"></span> µg/m³</p>
                <p><strong>NO2:</strong> <span id="no2"></span> µg/m³</p>
                <p><strong>O3:</strong> <span id="o3"></span> µg/m³</p>
            </div>
            <div class="col-md-6">
                <p><strong>SO2:</strong> <span id="so2"></span> µg/m³</p>
                <p><strong>PM2.5:</strong> <span id="pm2_5"></span> µg/m³</p>
                <p><strong>PM10:</strong> <span id="pm10"></span> µg/m³</p>
            </div>
        </div>
        <p><strong>US EPA Index:</strong> <span id="us-epa-index"></span></p>
        <p><strong>GB DEFRA Index:</strong> <span id="gb-defra-index"></span></p>

        <!-- Wind and Additional Conditions -->
        <h4>🌬 Additional Details</h4>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Humidity:</strong> <span id="humidity"></span>%</p>
                <p><strong>Wind Speed:</strong> <span id="wind-speed"></span> km/h</p>
                <p><strong>Wind Direction:</strong> <span id="wind-dir"></span> (<span id="wind-degree"></span>°)</p>
            </div>
            <div class="col-md-6">
                <p><strong>Pressure:</strong> <span id="pressure"></span> mb</p>
                <p><strong>Visibility:</strong> <span id="visibility"></span> km</p>
                <p><strong>Cloud Cover:</strong> <span id="cloudcover"></span>%</p>
                <p><strong>UV Index:</strong> <span id="uv-index"></span></p>
                <p><strong>Is Daytime:</strong> <span id="is-day"></span></p>
            </div>
        </div>
    </div>

    <!-- Leaflet Map -->
    <div id="map" style="height: 400px; width: 100%; display: none;"></div>

    <!-- Leaflet Map Script -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([22.9734, 78.6569], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Locate User Using Leaflet
        map.locate({ setView: true, maxZoom: 16 });

        map.on('locationfound', function (e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            console.log("Latitude:", lat);
            console.log("Longitude:", lng);

            // Send to Backend
            fetch("{{ route('weather.get') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ latitude: lat, longitude: lng })
            })
                .then(async (response) => {
                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error("API Error Response:", errorText);
                        throw new Error(`HTTP Error ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        document.getElementById('error-message').innerText = data.error;
                    } else {
                        console.log("Weather Data:", data);
                        document.getElementById('weather-data').style.display = 'block';

                        // Set basic data
                        document.getElementById('city-name').innerText = data?.location?.name || 'N/A';
                        document.getElementById('country-name').innerText = data?.location?.country || 'N/A';
                        document.getElementById('region-name').innerText = data?.location?.region || 'N/A';
                        document.getElementById('local-time').innerText = data?.location?.localtime || 'N/A';

                        // Set current weather details
                        document.getElementById('observation-time').innerText = data?.current?.observation_time || 'N/A';
                        document.getElementById('temperature').innerText = data?.current?.temperature || 'N/A';
                        document.getElementById('feelslike').innerText = data?.current?.feelslike || 'N/A';
                        document.getElementById('condition').innerText = data?.current?.weather_descriptions?.[0] || 'N/A';

                        const humidity = data?.current?.humidity || 0;
                        const cloudcover = data?.current?.cloudcover || 0;
                        const rainProbability = Math.min(100, (humidity + cloudcover) / 2);
                        const rainfallInMM = Math.round(rainProbability * 0.5);

                        // document.getElementById('rainfall').innerText = rainProbability.toFixed(2);
                        document.getElementById('rainfall-mm').innerText = rainfallInMM;


                        if (data?.current?.weather_icons?.[0]) {
                            document.getElementById('weather-icon').src = data.current.weather_icons[0];
                        } else {
                            document.getElementById('weather-icon').style.display = 'none';
                        }

                        // Set astronomical data
                        const astro = data?.current?.astro || {};
                        document.getElementById('sunrise').innerText = astro.sunrise || 'N/A';
                        document.getElementById('sunset').innerText = astro.sunset || 'N/A';
                        document.getElementById('moonrise').innerText = astro.moonrise || 'N/A';
                        document.getElementById('moonset').innerText = astro.moonset || 'N/A';
                        document.getElementById('moon-phase').innerText = astro.moon_phase || 'N/A';
                        document.getElementById('moon-illumination').innerText = astro.moon_illumination || 'N/A';

                        // Set air quality data
                        const airQuality = data?.current?.air_quality || {};
                        document.getElementById('co').innerText = airQuality.co || 'N/A';
                        document.getElementById('no2').innerText = airQuality.no2 || 'N/A';
                        document.getElementById('o3').innerText = airQuality.o3 || 'N/A';
                        document.getElementById('so2').innerText = airQuality.so2 || 'N/A';
                        document.getElementById('pm2_5').innerText = airQuality.pm2_5 || 'N/A';
                        document.getElementById('pm10').innerText = airQuality.pm10 || 'N/A';
                        document.getElementById('us-epa-index').innerText = airQuality["us-epa-index"] || 'N/A';
                        document.getElementById('gb-defra-index').innerText = airQuality["gb-defra-index"] || 'N/A';

                        // Additional weather data
                        document.getElementById('humidity').innerText = data?.current?.humidity || 'N/A';
                        document.getElementById('wind-speed').innerText = data?.current?.wind_speed || 'N/A';
                        document.getElementById('wind-dir').innerText = data?.current?.wind_dir || 'N/A';
                        document.getElementById('wind-degree').innerText = data?.current?.wind_degree || 'N/A';
                        document.getElementById('pressure').innerText = data?.current?.pressure || 'N/A';
                        document.getElementById('visibility').innerText = data?.current?.visibility || 'N/A';
                        document.getElementById('cloudcover').innerText = data?.current?.cloudcover || 'N/A';
                        document.getElementById('uv-index').innerText = data?.current?.uv_index || 'N/A';
                        document.getElementById('is-day').innerText = data?.current?.is_day === "yes" ? "Yes" : "No";
                    }
                })
                .catch(error => {
                    console.error("Error fetching weather:", error);
                    document.getElementById('error-message').innerText = "Failed to fetch weather data.";
                });
        });


        map.on('locationerror', function (e) {
            console.error("Location Error:", e.message);
            document.getElementById('error-message').innerText = "Location access denied. Please allow location access.";
        });
    </script>
@endsection