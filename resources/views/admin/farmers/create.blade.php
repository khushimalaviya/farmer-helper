@extends('layouts.adminlayout')

@section('content')
<div class="container">
    <h1>Create Farmer</h1>

    <!-- Error Display -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Farmer Form -->
    <form action="{{ route('admin.farmers.store') }}" method="POST">
        @csrf
        
        <!-- Username Input -->
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required placeholder="Enter the username">
        </div>

        <!-- Email Input -->
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="Enter the email address">
        </div>

        <!-- Contact Input -->
        <div class="mb-3">
            <label for="contact">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact') }}" required placeholder="Enter contact number">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create</button>

        <!-- Back Button -->
        <a href="{{ route('admin.farmers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection