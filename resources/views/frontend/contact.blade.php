@extends('frontend.layouts.master')
@section('title', 'Contact us')
@section('css')
@endsection
@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area page-title-style-three item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>Contact</li>
            </ul>
            <h2>Contact</h2>
        </div>
    </div>
</div>
<!-- End Page Title Area -->
<!-- Start Contact Info Area -->
<section class="contact-info-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="contact-info-box mb-30">
                    <div class="icon">
                        <i class='bx bx-envelope'></i>
                    </div>

                    <h3>Email Here</h3>
                    <p><a href="mailto:{{ $company->email }}"><span class="__cf_email__" data-cfemail="bcceddcdc9d9fcd4d9d0d0d392dfd3d1">{{ $company->email }}</span></a></p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="contact-info-box mb-30">
                    <div class="icon">
                        <i class='bx bx-map'></i>
                    </div>

                    <h3>Location Here</h3>
                    <p><a href="#">
                        {{ $company->address }}
                    </a></p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                <div class="contact-info-box mb-30">
                    <div class="icon">
                        <i class='bx bx-phone-call'></i>
                    </div>

                    <h3>Call Here</h3>
                    <p><a href="tel:{{ $company->phone_one }}">{{ $company->phone_one }}</a></p>
                    <p><a href="tel:{{ $company->phone_two }}">{{ $company->phone_two }}</a></p>
                    <p><a href="tel:{{ $company->phone_three }}">{{ $company->phone_three }}</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="particles-js-circle-bubble-2"></div>
</section>
<!-- End Contact Info Area -->

<!-- Start Contact Area -->
<section class="contact-area pb-100">
    <div class="container">
        <div class="section-title">
            <h2>Drop us Message for any Query</h2>
        </div>

        <div class="contact-form">
            <form  id="contactForm" action="{{ route('storeContact') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" required placeholder="Your Name">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input type="text" name="phone" required class="form-control" placeholder="Your Phone">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input type="text" name="subject"  class="form-control" placeholder="Your Subject">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <textarea name="message" class="form-control" cols="30" rows="5" placeholder="Your Message"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn"><i class='bx bx-paper-plane icon-arrow before'></i><span class="label">Send Message</span><i class="bx bx-paper-plane icon-arrow after"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="particles-js-circle-bubble-3"></div>
    <div class="contact-bg-image"><img src="assets/img/map.png" alt="image"></div>
</section>
<!-- End Contact Area -->
@endsection