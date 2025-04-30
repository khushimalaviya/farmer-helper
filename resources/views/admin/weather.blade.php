@extends('layouts.adminlayout')

@section('content')
<div class="container mt-4">
    
    <!-- Weather Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">🌤 Weather Dashboard</h2>
        <button class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle-fill"></i> Add Weather Data
        </button>
    </div>

    <!-- Search Box -->
    <div class="input-group my-3 w-50 mx-auto">
        <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control border-primary" placeholder="Search City...">
    </div>

    <!-- Weather Cards -->
    <div class="row">
        
        <!-- Card 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-0 weather-card">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary fw-bold">Mumbai</h5>
                    <h2 class="text-dark fw-bold">29°C ☀</h2>
                    <p class="text-muted">Humidity: 60% | Wind: 10 km/h</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-0 weather-card">
                <div class="card-body text-center">
                    <h5 class="card-title text-success fw-bold">Delhi</h5>
                    <h2 class="text-dark fw-bold">33°C 🌤</h2>
                    <p class="text-muted">Humidity: 50% | Wind: 12 km/h</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-0 weather-card">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning fw-bold">Bangalore</h5>
                    <h2 class="text-dark fw-bold">24°C 🌧</h2>
                    <p class="text-muted">Humidity: 70% | Wind: 8 km/h</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
<style>
    .weather-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: linear-gradient(135deg, #f0f0f0, #ffffff);
}

.weather-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.btn-success:hover {
    background-color: #28a745;
    color: white;
    transform: scale(1.05);
}
</style>