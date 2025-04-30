<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AgriCulture')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <style>
        .footer-link, .social-icon {
            color: white;
        }
    </style>
</head>

<body class="index-page">
    {{-- @php
    $user = Auth::user();
    dd($user->roles);
@endphp --}}

    <!-- Header -->
    <header id="header" class="header d-flex align-items-center position-relative">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="AgriCulture Logo">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @guest
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @endif
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @endif
                    @else
                        @php
                            $user = \App\Models\User::with('roles')->find(Auth::id());
                            $userRole = $user?->roles?->first()?->u_role ?? 'null';
                            // echo $userRole;
                        @endphp

                        @if($userRole === 'farmer')
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('farmdata') }}">Crop Recommendation</a></li>
                            <li><a href="{{ route('weather.index') }}">Weather Info</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        @elseif($userRole === 'admin')
                            <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                            <li><a href="{{ route('admin.farmers') }}">Manage Farmers</a></li>
                            <li><a href="{{ route('admin.crops') }}">Manage Crops</a></li>
                            <li><a href="{{ route('admin.weather') }}">Weather Reports</a></li>
                        @endif

                        <!-- Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                {{ $user->username ?? 'No Username Found' }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('farmers.profile') }}">{{ __('My Account') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        
                    @endguest
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer py-5 shadow-sm" style="background-color: #000;">
        <div class="container text-center">
            <h4 class="mb-3 fw-bold text-uppercase text-light">Farmer Helper</h4>
            <p class="mb-3 text-light opacity-75">Innovative and sustainable agricultural solutions.</p>

            <div class="footer-links mb-4">
                <a href="{{ url('/') }}" class="footer-link">Home</a>
                <a href="{{ url('/about') }}" class="footer-link">About</a>
                <a href="{{ url('/services') }}" class="footer-link">Services</a>
                <a href="{{ url('/contact') }}" class="footer-link">Contact</a>
            </div>

            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="https://twitter.com" target="_blank" class="social-icon"><i class="bi bi-twitter"></i></a>
                <a href="https://facebook.com" target="_blank" class="social-icon"><i class="bi bi-facebook"></i></a>
                <a href="https://instagram.com" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
                <a href="https://linkedin.com" target="_blank" class="social-icon"><i class="bi bi-linkedin"></i></a>
            </div>

            <div class="copyright text-light small">
                &copy; 2025 <strong>AgriCulture</strong>. All Rights Reserved.
            </div>
        </div>
    </footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
