@extends('frontend.layouts.master')
@section('title', 'Courses')
@section('css')
@endsection
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-style-two item-bg2 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Resource Person</li>
                </ul>
                <h2>Team of Resource Person</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Team Area -->
    <section class="team-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                @foreach ($instructors as $instructor)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-instructor-box mb-30">
                            <div class="image">
                                <a href="{{ route('instructorDetails', $instructor->id) }}">
                                    <img src="{{ asset($instructor->image) }}" alt="image">
                                </a>
                            </div>

                            <div class="content">
                                <h3><a
                                        href="{{ route('instructorDetails', $instructor->id) }}">{{ $instructor->name }}</a>
                                </h3>
                                <span>{{ $instructor->designation }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="particles-js-circle-bubble-3"></div>
    </section>
    <!-- End Team Area -->
@endsection
