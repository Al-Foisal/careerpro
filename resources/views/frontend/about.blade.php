@extends('frontend.layouts.master')
@section('title', 'About us')
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
                    <li>About</li>
                </ul>
                <h2>About us</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start FAQ Area -->
    <section class="faq-area ptb-100">
        <div class="container">
            <h1 class="text-center mb-30">About {{ config('app.name') }}</h1>
            @foreach ($abouts as $key => $about)
                @if ($key % 2)
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="experience-content">
                                <h2>{{ $about->name }}</h2>
                                {!! $about->details !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="experience-image">
                                <img src="{{ asset($about->image) }}" alt="image">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="experience-image">
                                <img src="{{ asset($about->image) }}" alt="image">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="experience-content">
                                <h2>{{ $about->name }}</h2>
                                {!! $about->details !!}
                            </div>
                        </div>


                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <!-- End FAQ Area -->
@endsection
