@extends('layouts.adminlayout')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Farmers</h5>
                    <p class="card-text">100+ Registered Farmers</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Crop Recommendations</h5>
                    <p class="card-text">Suggested Crops Updated</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Weather Alerts</h5>
                    <p class="card-text">Latest Weather Data Available</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection