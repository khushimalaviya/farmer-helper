@extends('layouts.app')

@section('content')
   <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
            <div class="container position-relative text-center">
            <h1 class="display-4 fw-bold text-white">Contact</h1>
            <p class="lead text-white">Get in Touch with Us for Any Queries or Support</p>
            <nav class="breadcrumbs">
                <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
            </div>
        </div>
  <!-- End Page Title -->
    <br><br>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        
        <div class="container" data-aos="fade">
            <h3 class="text-center mb-4">Contact Us</h3>
            <div class="row gy-5 gx-lg-5">
                <div class="col-lg-4">
                    <div class="info">
                        <h3>Get in touch</h3>
                        <p>We’re here to help! Reach out to us for any inquiries, support, or collaborations.</p>
                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Location:</h4>
                                <p>Maliba Campus, Gopal Vidyanagar, Bardoli-Mahuva Road, Tarsadi - 394 350, Surat, Gujarat, India</p>
                            </div>
                        </div>
                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>info@gmail.com</p>
                            </div>
                        </div>
                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Call:</h4>
                                <p><a href="tel:+912625255389" style="color: inherit; text-decoration: none;">+91 2625 255 389</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="form-container shadow-sm p-4 rounded bg-white">
                        
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="form-group mb-3">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter subject" required>
                            </div> --}}
                            <div class="form-group mb-3">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" id="message" placeholder="Enter your message" rows="1" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-100">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection