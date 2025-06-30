@extends('layouts.adminlayout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">👨‍🌾 Farmers List</h2>
        <a href="{{ route('admin.farmers.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-person-plus-fill"></i> Add Farmer
        </a>
    </div>

   

    <!-- Farmers Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($farmers as $farmer)
                <tr>
                    <td>{{ $farmer->id }}</td>
                    <td>{{ $farmer->username }}</td>
                    <td>{{ $farmer->email }}</td>
                    <td>{{ $farmer->contact }}</td>
                    <td>
                        <a href="{{ route('admin.farmers.edit', $farmer->id) }}" class="btn btn-warning btn-sm me-2">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.farmers.destroy', $farmer->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
