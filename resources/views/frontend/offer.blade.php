@extends('frontend.layouts.master')
@section('title', 'Offer Courses')
@section('css')
@endsection
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-style-three item-bg2 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Courses</li>
                </ul>
                <h2>Offer Courses
                </h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start Courses Area -->
    @php
    $start = $courses->currentPage();
    $end = $courses->lastPage();
    $total = $courses->total();
    $per = $courses->perPage();

    if ($end - $start != 0) {
        $start = $start * $per - $per + 1;
        $end = $start + $per - 1;
    } else {
        $start = $start * $per - $per + 1;
        $end = $start + ($total - $start);
    }
    @endphp
    <section class="courses-area ptb-100">
        @if ($courses->total() > $courses->perPage())
            <div class="container">
                <div class="courses-topbar">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-4">
                            <div class="topbar-result-count">
                                <p>Showing {{ $start }} – {{ $end }} of {{ $courses->total() }}</p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="topbar-ordering-and-search">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-5 offset-lg-4 offset-md-1 col-sm-6">
                                        
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-6">
                                        <div class="topbar-search">
                                            <form action="{{ route('search') }}">
                                                <label>
                                                    <i class="bx bx-search"></i>
                                                </label>
                                                <input type="text" name="search" class="input-search"
                                                    placeholder="Search here...">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="single-courses-box mb-30">
                            <div class="courses-image">
                                <a href="{{ route('courseDetails', $course->slug) }}" class="d-block">
                                    <img src="{{ asset($course->thumbnil_image) }}" alt="image"
                                        style="width: 365px;height: 288px;">
                                </a>
                            </div>
                            <div class="courses-content">
                                <div class="course-author d-flex align-items-center">
                                    <img src="{{ asset($course->instructor->image) }}" class="rounded-circle mr-2" alt="image">
                                    <span>{{ $course->instructor->name }}</span>
                                </div>
                                <h5>
                                    <a href="{{ route('courseDetails', $course->slug) }}" class="d-inline-block">
                                        {{ $course->name }}
                                    </a>
                                    </h3>
                                    {{-- <div class="courses-rating">
                                        <div class="review-stars-rated">
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                        </div>
                                        <div class="rating-total">
                                            5.0 (1 rating)
                                        </div>
                                    </div> --}}
                            </div>
                            <div class="courses-box-footer">
                                <ul class="d-flex justify-content-between">
                                    <li class="courses-lesson d-flex justify-content-start">
                                        <i class="bx bx-book-open" style="margin-right: 5px;"></i>
                                        {{ $course->lesson }} lessons
                                    </li>
                                    @if ($course->discount_price)
                                        <li class="courses-price">
                                            <span>৳{{ $course->price }}</span>
                                            ৳{{ $course->discount_price }}
                                        </li>
                                    @else
                                        <li class="courses-price">
                                            ৳{{ $course->price }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <div class="pagination-area ">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Courses Area -->
@endsection