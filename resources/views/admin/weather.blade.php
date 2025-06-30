@extends('layouts.adminlayout') {{-- Adjust this if your layout file is named differently --}}

@section('content')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Weather Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css" rel="stylesheet">
    <style>
        /* General Weather Card Styling */
        .weather-card {
            width: 100%;
            max-width: 350px;
            margin: 50px auto;
            padding: 30px;
            background: linear-gradient(to bottom, #ff7e5f, #feb47b);
            color: white;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-out;
        }

        .weather-card .city-name {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .weather-icon i {
            font-size: 80px;
            margin-bottom: 20px;
            color: white;
        }

        /* Weather Details */
        .weather-details {
            font-size: 18px;
        }

        .weather-details .temperature {
            font-size: 40px;
            font-weight: 700;
            margin-top: 10px;
        }

        .weather-description {
            font-style: italic;
        }

        /* Additional Information */
        .additional-info {
            margin-top: 30px;
            font-size: 16px;
        }

        .additional-info p {
            margin: 5px 0;
        }

        .additional-info strong {
            font-weight: 600;
        }

        /* Error Message */
        .error-message {
            text-align: center;
            font-size: 18px;
            color: #e74c3c;
            margin-top: 50px;
        }

        /* Animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container">
        <h1 class="mb-4 text-center text-primary">Weather Data</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        <form action="{{ route('weather.get.detail') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="text" name="city" class="form-control border-primary" placeholder="Search City..." required>
            </div>
            <button type="submit" class="btn btn-primary">Get Weather</button>
        </form>



        <div class="row">
            @if(!empty($weatherData))
                <div class="card mt-4">
                    <div class="card-body">
                        @if(isset($weatherData['location']))
                            <div class="weather-card animated fadeIn">
                                <h2 class="city-name">{{ $weatherData['location']['name'] }}</h2>

                                @php
                                    $weatherDescription = $weatherData['current']['weather_descriptions'][0];
                                    $iconClass = 'wi wi-day-sunny'; // Default sunny icon

                                    // Determine the icon based on weather description
                                    if (strpos(strtolower($weatherDescription), 'cloud') !== false) {
                                        $iconClass = 'wi wi-cloudy';
                                    } elseif (strpos(strtolower($weatherDescription), 'rain') !== false) {
                                        $iconClass = 'wi wi-rain';
                                    } elseif (strpos(strtolower($weatherDescription), 'clear') !== false) {
                                        $iconClass = 'wi wi-day-sunny';
                                    } elseif (strpos(strtolower($weatherDescription), 'snow') !== false) {
                                        $iconClass = 'wi wi-snow';
                                    }
                                @endphp

                                <div class="weather-icon">
                                    <i class="{{ $iconClass }}"></i>
                                </div>


                                <!-- Temperature -->
                                <div class="weather-details">
                                    <p class="temperature">{{ $weatherData['current']['temperature'] }}°C</p>
                                    <p class="weather-description">{{ $weatherData['current']['weather_descriptions'][0] }}</p>
                                </div>

                                <!-- Additional Information -->
                                <div class="additional-info">
                                    <p><strong>Humidity:</strong> {{ $weatherData['current']['humidity'] }}%</p>
                                    <p><strong>Wind Speed:</strong> {{ $weatherData['current']['wind_speed'] }} km/h</p>
                                    <p><strong>Pressure:</strong> {{ $weatherData['current']['pressure'] }} hPa</p>
                                    <p><strong>Visibility:</strong> {{ $weatherData['current']['visibility'] }} meters</p>
                                    <p><strong>Feels Like:</strong> {{ $weatherData['current']['feelslike'] }}°C</p>
                                    <p><strong>Wind Direction:</strong> {{ $weatherData['current']['wind_degree'] }}°
                                        ({{ $weatherData['current']['wind_dir'] }})</p>
                                    <p><strong>UV Index:</strong> {{ $weatherData['current']['uv_index'] }}</p>
                                </div>
                            </div>
                        @else
                            <p class="error-message">Weather data not available.</p>
                        @endif




                    </div>
                </div>
            @endif

            {{-- @forelse ($weatherData as $weather)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-lg border-0 weather-card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary fw-bold">{{ $weather->city }}</h5>
                        <h2 class="text-dark fw-bold">{{ $weather->temperature }}°C</h2>
                        <p class="text-muted">{{ $weather->description }}</p>
                        <p class="text-muted">Humidity: {{ $weather->humidity }}% | Wind: {{ $weather->wind_speed }}</p>
                        @if($weather->icon)
                        <img src="{{ $weather->icon }}" alt="icon" class="mt-2" style="width: 50px;">
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center">No weather data found.</p>
            @endforelse --}}

        </div>
    </div>
@endsection