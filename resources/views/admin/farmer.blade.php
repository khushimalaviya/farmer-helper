@extends('layouts.adminlayout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">👨‍🌾 Farmers List</h2>
        
        <button class="btn btn-success shadow-sm">
            <i class="bi bi-person-plus-fill"></i> Add Farmer
        </button>
    </div>

    <!-- Search Box -->
    <div class="input-group my-3 w-50">
        <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control border-primary" placeholder="Search Farmers..." disabled>
    </div>

    <!-- Farmers Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1</td>
                    <td>Rahul Sharma</td>
                    <td>9876543210</td>
                    <td>Punjab</td>
                    <td>March 2024</td>
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
                    <td>Amit Kumar</td>
                    <td>8765432109</td>
                    <td>Haryana</td>
                    <td>Feb 2024</td>
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