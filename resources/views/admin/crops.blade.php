@extends('layouts.adminlayout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">🌾 Crops List</h2>
        
        <button class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle-fill"></i> Add Crop
        </button>
    </div>

    <!-- Search Box -->
    <div class="input-group my-3 w-50">
        <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control border-primary" placeholder="Search Crops..." disabled>
    </div>

    <!-- Crops Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Crop Name</th>
                    <th>Season</th>
                    <th>Region</th>
                    <th>Harvest Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1</td>
                    <td>Wheat</td>
                    <td>Rabi</td>
                    <td>Punjab</td>
                    <td>April 2024</td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm shadow-sm" disabled>
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button class="btn btn-outline-danger btn-sm shadow-sm" disabled>
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#2</td>
                    <td>Rice</td>
                    <td>Kharif</td>
                    <td>West Bengal</td>
                    <td>September 2024</td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm shadow-sm" disabled>
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button class="btn btn-outline-danger btn-sm shadow-sm" disabled>
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#3</td>
                    <td>Sugarcane</td>
                    <td>Annual</td>
                    <td>Maharashtra</td>
                    <td>December 2024</td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm shadow-sm" disabled>
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button class="btn btn-outline-danger btn-sm shadow-sm" disabled>
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection