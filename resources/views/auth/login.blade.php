@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
        <div class="container position-relative text-center">
            <h1 class="display-4 fw-bold text-white">Login</h1>
            <p class="lead text-white">Access Your Account to Manage Your Farm</p>
            <nav class="breadcrumbs">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Login</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->
    
    <br><br>

    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">🚜 Farmer Login</h2>

            <div class="card-body">
                <x-form-component 
                    :fields="[
                        ['label' => 'Email Address', 'name' => 'email', 'type' => 'email', 'placeholder' => 'Enter your email'],
                        ['label' => 'Password', 'name' => 'password', 'type' => 'password', 'placeholder' => 'Enter your password']
                    ]" 
                    action="{{ route('login') }}" 
                    button-text="Login" 
                />

                <div class="text-center mt-4">
                    <div>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection