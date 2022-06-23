@extends('frontend.layouts.master')
@section('title', 'Our Services')
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
                    <li>Service</li>
                </ul>
                <h2>Our Services</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start FAQ Area -->
    <section class="faq-area ptb-100">
        <div class="container">
            <h1 class="text-center mb-30">All Services of {{ config('app.name') }}</h1>
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-product-box mb-30">
                            <div class="product-image">
                                <a href="{{ route('serviceDetails', $service) }}">
                                    <img src="{{ asset($service->image) }}" alt="image">
                                </a>
                            </div>

                            <div class="product-content">
                                <h3><a href="{{ route('serviceDetails', $service) }}">
                                        {{ $service->name }}
                                    </a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End FAQ Area -->
@endsection
