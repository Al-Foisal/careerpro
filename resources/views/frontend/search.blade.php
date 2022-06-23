@extends('frontend.layouts.master')
@section('title', $search)

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-style-three item-bg2 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Search</li>
                </ul>
                <h2>{{ $search }}
                </h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start Courses Area -->
    <section class="courses-area ptb-100">
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
            </div>
            
            <div class="row">
                @foreach ($jobs as $job)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-courses-list-box mb-30">
                            <div class="box-item">
                                <div class="courses-image">
                                    <div class="image bg-1">
                                        <img src="{{ $job->image }}" alt="image">
                                    </div>
                                </div>

                                <div class="courses-desc">
                                    <div class="courses-content">
                                        @if ($job->admin_id !== null)
                                            <div class="course-author d-flex align-items-center">
                                                <img src="assets/img/user1.jpg" class="rounded-circle mr-2"
                                                    alt="image">
                                                <span>{{ getAdminById($job->admin_id)->name }}</span>
                                            </div>
                                        @else
                                            <div class="course-author d-flex align-items-center">
                                                <img src="{{ asset(getUserById($job->user_id)->image) }}"
                                                    class="rounded-circle mr-2" alt="image">
                                                <span>{{ getUserById($job->user_id)->name }}</span>
                                            </div>
                                        @endif

                                        <h3><a href="{{ route('jobDetails', $job->id) }}" class="d-inline-block">
                                                {{ $job->name }}
                                            </a></h3>

                                        <br>

                                        {{ Illuminate\Support\Str::words(strip_tags($job->details), 20, ' ...') }}
                                    </div>

                                    <div class="courses-box-footer">
                                        <a href="{{ route('jobDetails', $job->id) }}" class="apply">Apply
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-3 col-md-6">
                    <div class="single-blog-post mb-30">
                        <div class="post-image">
                            <a href="{{ route('blogDetails', $blog->slug) }}" class="d-block">
                                <img src="{{ asset($blog->image) }}" alt="image">
                            </a>
                        </div>
    
                        <div class="post-content">
                            <ul class="post-meta">
                                <li class="post-author">
                                    <img src="{{ asset($blog->instructor->image) }}" class="d-inline-block rounded-circle mr-2" alt="image">
                                    By: <a href="{{ route('instructorDetails', $blog->instructor->id) }}" class="d-inline-block">{{ $blog->instructor->name }}</a>
                                </li>
                                <li><a href="#">{{ $blog->created_at->format('l m, Y') }}</a></li>
                            </ul>
                            <h3><a href="{{ route('blogDetails', $blog->slug) }}" class="d-inline-block">{{ $blog->name }}</a></h3>
                            <a href="{{ route('blogDetails', $blog->slug) }}" class="read-more-btn">Read More <i class='bx bx-right-arrow-alt'></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>
    <!-- End Courses Area -->
@endsection
