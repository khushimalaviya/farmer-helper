@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">🚜 Farm Data Collection</h2>

            <div class="card-body">

                <form action="{{ route('farmdata.submit') }}" method="POST" onsubmit="return validateWeatherData(event)">
                    @csrf

                    <!-- Form Fields -->
                    <div class="mb-4">
                        <label for="soil_type" class="form-label">Soil Type</label>
                        <select class="form-select" id="soil_type" name="soil_type">
                            <option value="Sandy">Sandy (રેતાળ)</option>
                            <option value="Loamy">Loamy (ગોરાડુ)</option>
                            <option value="Clayey">Clayey (ચીકણી)</option>
                            <option value="Black">Black (કાળો)</option>
                            <option value="Red">Red (લાલો)</option>
                            <option value="Alluvial">Alluvial (કાંપવાળી)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="land_area" class="form-label">Land Area (in acres)</label>
                        <input type="number" class="form-control" id="land_area" name="land_area"
                            placeholder="Enter land area">
                    </div>

                    <div class="mb-3">
                        <label for="water_source" class="form-label">Water Source</label>
                        <select class="form-select" id="water_source" name="water_source">
                            <option value="Well">Well (કૂવો)</option>
                            <option value="Rainwater">Rainwater (વરસાદી પાણી)</option>
                            <option value="Canal">Canal (કેનાલ)</option>
                            <option value="Borewell">Borewell (બોરવેલ)</option>
                            <option value="River">River (નદી)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="season" class="form-label">Season</label>
                        <select class="form-select" id="season" name="season">
                            <option value="Kharif">Kharif (વરસાદી)</option>
                            <option value="Rabi">Rabi (શિયાળુ)</option>
                            <option value="Zaid">Zaid (ઉનાળુ)</option>
                            <option value="Spring">Spring (વસંત)</option>
                            <option value="Autumn">Autumn (પાનખર)</option>
                        </select>
                    </div>

                    <!-- Hidden Inputs for Weather Data -->
                    <input type="hidden" id="temperature" name="temperature" value="">
                    <input type="hidden" id="humidity" name="humidity" value="">
                    <input type="hidden" id="rainfall" name="rainfall" value="">

                    <!-- Use the custom button component -->
                    <x-button class="bg-green-500 hover:bg-green-700">Submit Farm Data</x-button>
                </form>
                </form>

                <div id="error-message" class="text-danger mt-2"></div>
            </div>
        </div>
    </div>

    <!-- Leaflet Map (Hidden) -->
    <div id="map" style="height: 400px; width: 100%; display: none;"></div>

    <!-- Include Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- JavaScript to Fetch Weather Data -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("DOM fully loaded and parsed");

            const map = L.map('map').setView([22.9734, 78.6569], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            map.locate({ setView: true, maxZoom: 16 });

            map.on('locationfound', function (e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;

                console.log("Latitude:", lat);
                console.log("Longitude:", lng);

                fetch("{{ route('weather.get') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ latitude: lat, longitude: lng })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Weather Data:", data);

                        const temperatureInput = document.getElementById('temperature');
                        const humidityInput = document.getElementById('humidity');
                        const rainfallInput = document.getElementById('rainfall');

                        if (!temperatureInput || !humidityInput || !rainfallInput) {
                            console.error('Hidden input fields not found');
                            return;
                        }

                        if (data?.current) {
                            temperatureInput.value = data.current.temperature;
                            humidityInput.value = data.current.humidity;

                            const humidity = data.current.humidity || 0;
                            const cloudcover = data.current.cloudcover || 0;
                            const rainProbability = Math.min(100, (humidity + cloudcover) / 2);
                            const rainfallInMM = Math.round(rainProbability * 0.5 * 10) / 10; // Keeps one decimal
                            rainfallInput.value = rainfallInMM;

                            console.log("Temperature:", temperatureInput.value);
                            console.log("Humidity:", humidityInput.value);
                            console.log("Rainfall:", rainfallInput.value);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching weather:", error);
                        document.getElementById('error-message').innerText = "Weather data unavailable. Please try again.";
                    });
            });
        });

        function validateWeatherData(event) {
            const temperature = document.getElementById('temperature').value;
            const humidity = document.getElementById('humidity').value;
            const rainfall = document.getElementById('rainfall').value;

            if (!temperature || !humidity || !rainfall) {
                event.preventDefault();
                alert('Weather data is missing or invalid. Please wait for it to load.');
                return false;
            }

            console.log("Weather Data Validated!");
            return true;
        }
    </script>
@endsection