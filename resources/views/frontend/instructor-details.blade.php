@extends('frontend.layouts.master')
@section('title', $instructor->name)
@section('css')
@endsection
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-style-two item-bg2 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Instructors</li>
                </ul>
                <h2>{{ $instructor->name }}</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Instructor Details Area -->
    <section class="instructor-details-area pt-100 pb-70">
        <div class="container">
            <div class="instructor-details-desc">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="instructor-details-sidebar">
                            <img src="{{ asset($instructor->image) }}" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8">
                        <div class="instructor-details">
                            <h3>{{ $instructor->name }}</h3>
                            <span class="sub-title">{{ $instructor->designation }}</span>
                            
                            <blockquote class="wp-block-quote">
                                <p>
                                    {{ $instructor->message }}
                                </p>
                            </blockquote>

                            {!! $instructor->details !!}

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Instructor Details Area -->
@endsection
