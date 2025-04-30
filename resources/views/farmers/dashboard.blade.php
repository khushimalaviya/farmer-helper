@extends('layouts.app')

@section('content')

  <!-- Hero Section with Carousel -->
  <section id="hero" class="hero section dark-background">
    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
      @foreach ([
        ['img' => 'hero_1.jpg', 'title' => 'Farming is the best solution to world hunger', 'desc' => 'Join the revolution of sustainable farming.'],
        ['img' => 'hero_2.jpg', 'title' => 'Organic Vegetables for a Healthy Life', 'desc' => 'Embrace organic farming for a healthier future.'],
        ['img' => 'hero_3.jpg', 'title' => 'Fresh Produce Every Day', 'desc' => 'Delivering farm-fresh produce to your doorstep.'],
        ['img' => 'hero_4.jpg', 'title' => 'Farming as a Passion', 'desc' => 'Connect with nature and grow with us.'],
        ['img' => 'hero_5.jpg', 'title' => 'Good Food for All', 'desc' => 'Support sustainable food production.']
      ] as $index => $slide)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
          <img src="{{ asset('assets/img/' . $slide['img']) }}" alt="{{ $slide['title'] }}">
          <div class="carousel-container">
            <h2>{{ $slide['title'] }}</h2>
            <p>{{ $slide['desc'] }}</p>
          </div>
        </div>
      @endforeach

      <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators"></ol>
    </div>
  </section>

  <!-- Features Section with Cards -->
  <section id="features" class="features section" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-4">Why Choose Farmer Helper?</h2>
      <p class="text-center mb-5">Unlock the full potential of your farm with personalized insights and expert guidance.</p>
      <div class="row">
        @foreach ([
          ['icon' => '🧑‍🌾', 'title' => 'Farmer Registration & Management', 'desc' => 'Register easily, manage your profile, and access personalized farming recommendations.'],
          ['icon' => '🌿', 'title' => 'Smart Farm Data Collection', 'desc' => 'Provide soil type, land size, water source, and season for tailored recommendations.'],
          ['icon' => '☁️', 'title' => 'Real-Time Weather Updates', 'desc' => 'Plan effectively with accurate weather forecasts for your region.'],
          ['icon' => '🌾', 'title' => 'Crop Recommendation System', 'desc' => 'Receive suggestions for the best crops based on soil and climate data.'],
          ['icon' => '🛡️', 'title' => 'Disease Diagnosis & Management', 'desc' => 'Diagnose crop diseases using our symptom-based tool and get instant treatment advice.'],
          ['icon' => '📥', 'title' => 'Downloadable Reports', 'desc' => 'Generate detailed reports with crop suggestions and disease management plans in PDF format.']
        ] as $feature)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card feature-card text-center">
              <div class="card-body">
                <h3 class="card-title">{{ $feature['icon'] }} {{ $feature['title'] }}</h3>
                <p class="card-text">{{ $feature['desc'] }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section id="cta" class="cta section text-white">
    <div class="container text-center">
      <h2>Start Your Sustainable Farming Journey Today</h2>
      <p>Join thousands of farmers who have optimized their farming practices with Farmer Helper.</p>
      {{-- <a href="{{ route('register') }}" class="btn-cta">Sign Up Now</a> --}}
    </div>
  </section>

@endsection
