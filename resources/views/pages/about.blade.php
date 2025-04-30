@extends('layouts.app')

@section('content')
 <!-- Page Title -->
 <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
  <div class="container position-relative text-center">
    <h1 class="display-4 fw-bold text-white">About Farmer Helper</h1>
    <p class="lead text-white">Empowering Farmers with Smart Solutions for a Sustainable Future</p>
    <nav class="breadcrumbs">
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active text-white" aria-current="page">About</li>
        
      </ol>
    </nav>
  </div>
</div>

<!-- About Section -->
<section id="about-farmer-helper" class="about section py-5">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6" data-aos="zoom-out">
        <img src="assets/img/img_sq_1.jpg" alt="Farmers Working" class="img-fluid rounded shadow-lg">
      </div>
      <div class="col-lg-6" data-aos="fade-up">
        <h2 class="fw-bold mb-4">Bridging Tradition and Technology</h2>
        <p>Farmer Helper is committed to helping farmers embrace technology to make better decisions. From precision farming to sustainable agriculture, we offer tailored solutions for every need.</p>
        <ul class="list-group list-group-flush mb-4">
          <li class="list-group-item">🌿 AI-Powered Crop Recommendations</li>
          <li class="list-group-item">🌦️ Real-Time Weather Forecasts</li>
          <li class="list-group-item">🚜 Efficient Farm Management Tools</li>
          <li class="list-group-item">📊 Data-Driven Insights</li>
        </ul>
        <a href="{{ url('/contact') }}" class="btn btn-success btn-lg">Contact Us</a>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
{{-- <section class="team section py-5 bg-light" id="team">
  <div class="container text-center mb-5" data-aos="fade-up">
    <h2 class="fw-bold">Meet Our Dedicated Team</h2>
    <p>Experts in Agriculture, Technology, and Sustainability</p>
  </div>
  <div class="container">
    <div class="row">
      @foreach ($teamMembers as $member)
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="card border-0 shadow-lg">
            <img src="{{ asset('assets/img/team/' . $member->image) }}" alt="{{ $member->name }}" class="card-img-top">
            <div class="card-body text-center">
              <h5 class="card-title">{{ $member->name }}</h5>
              <p class="text-muted">{{ $member->role }}</p>
              <div class="social-links">
                <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i></a>
                <a href="#" class="btn btn-outline-info btn-sm"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="btn btn-outline-dark btn-sm"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section> --}}

<!-- Call To Action Section -->
<section id="call-to-action" class="call-to-action section py-5 text-white" style="background-image: url('assets/img/call-to-action-bg.jpg'); background-size: cover;">
  <div class="container text-center">
    <h3 class="fw-bold">Join the Farmer Helper Community</h3>
    <p>Unlock the power of data and smart farming solutions. Let's cultivate a greener, more productive future together.</p>
    <a href="{{ route('register') }}" class="btn btn-light btn-lg">Get Started Now</a>
  </div>
</section>
@endsection
