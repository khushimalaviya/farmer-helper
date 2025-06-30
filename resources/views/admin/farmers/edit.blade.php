@extends('layouts.adminlayout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Farmer</h2>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        {{-- @dd($farmer); --}}
    <!-- Update Farmer Form -->
    <form action="{{ route('admin.farmers.update', $farmer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input 
                type="text" 
                name="username" 
                id="username" 
                class="form-control" 
                value="{{ old('username', $farmer->username) }}" 
                required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control" 
                value="{{ old('email', $farmer->email) }}" 
                required>
        </div>

        <!-- Contact -->
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input 
                type="text" 
                name="contact" 
                id="contact" 
                class="form-control" 
                value="{{ old('contact', $farmer->contact_no) }}" 
                required>
        </div>

        <!-- Action Buttons -->
        <button type="submit" class="btn btn-success">Update Farmer</button>
        <a href="{{ route('admin.farmers') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection