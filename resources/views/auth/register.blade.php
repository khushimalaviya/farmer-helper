@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
        <div class="container position-relative text-center">
            <h1 class="display-4 fw-bold text-white">Register</h1>
            <p class="lead text-white">Join Us and Start Managing Your Farm Today</p>
            <nav class="breadcrumbs">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Register</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <br><br>

    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">🚜 Farmer Registration</h2>
            
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <x-form-component 
                    :fields="[
                        ['label' => 'Username', 'name' => 'username', 'type' => 'text', 'placeholder' => 'Enter your username'],
                        ['label' => 'Email Address', 'name' => 'email', 'type' => 'email', 'placeholder' => 'Enter your email'],
                        ['label' => 'Contact Number', 'name' => 'contact_no', 'type' => 'text', 'placeholder' => 'Enter your contact number'],
                        ['label' => 'Password', 'name' => 'password', 'type' => 'password', 'placeholder' => 'Enter your password'],
                        ['label' => 'Confirm Password', 'name' => 'password_confirmation', 'type' => 'password', 'placeholder' => 'Confirm your password']
                    ]" 
                    action="{{ route('register') }}" 
                    button-text="Register" 
                />
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Name validation: Only alphabets and spaces
            $('input[name="username"]').on('keypress', function(e) {
                const charCode = e.which || e.keyCode;
                const charStr = String.fromCharCode(charCode);
                if (!/^[a-zA-Z\s]+$/.test(charStr)) {
                    e.preventDefault();
                }
            });

            // Phone validation: Only numbers starting with 6 to 9, max 10 digits
            $('input[name="contact_no"]').on('keypress', function(e) {
                const charCode = e.which || e.keyCode;
                const charStr = String.fromCharCode(charCode);
                const currentValue = $(this).val();

                // Ensure first digit is between 6 to 9 and rest are digits, max 10
                if ((currentValue.length === 0 && !/^[6-9]$/.test(charStr)) ||
                    (currentValue.length >= 10 || !/^[0-9]$/.test(charStr))) {
                    e.preventDefault();
                }
            });
        });
    </script>

@endsection