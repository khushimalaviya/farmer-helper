@extends('layouts.app')

@section('content')

    <!-- Page Title with Background Image -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/page-title-bg.webp') }}');">
        <div class="container position-relative text-center">
            <h1 class="display-4 fw-bold text-white">Forgot Password</h1>
            <p class="lead text-white">Reset Your Password and Get Back to Your Account</p>
        </div>
    </div><!-- End Page Title -->

    <br><br>

    <!-- Reset Password Form Section with Background -->
    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg" 
             style="background-image: url('{{ asset('assets/img/background-pattern.jpg') }}'); background-size: cover; background-position: center;">
            
            <h2 class="text-2xl font-semibold mb-4">🔐 Forgot Password?</h2>
            
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Send Reset Link</button>
            </form>

            <p class="mt-3 text-center">
                Remembered your password? <a href="/login">Login here</a>
            </p>

        </div>
    </div>

@endsection