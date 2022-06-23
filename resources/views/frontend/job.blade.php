@extends('frontend.layouts.master')
@section('title', 'Job Post')
@section('css')
    <style>
        .single-courses-list-box .box-item .courses-desc .courses-box-footer {
            border-top: 1px solid #e2f4ff;
            padding: 20px 0px;
        }

        .apply {
            background: red;
            color: white;
            padding: 21px 35%;
            letter-spacing: 2px;
            font-weight: 500;
        }

    </style>
@endsection
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Jobs</li>
                </ul>
                <h2>Job List</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Courses Area -->
    @php
    $start = $jobs->currentPage();
    $end = $jobs->lastPage();
    $total = $jobs->total();
    $per = $jobs->perPage();

    if ($end - $start != 0) {
        $start = $start * $per - $per + 1;
        $end = $start + $per - 1;
    } else {
        $start = $start * $per - $per + 1;
        $end = $start + ($total - $start);
    }
    @endphp
    <section class="courses-area ptb-100">
        <div class="container">
            <div class="courses-topbar">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4">
                        <div class="topbar-result-count">
                            <p>Showing {{ $start }} – {{ $end }} of {{ $jobs->total() }}</p>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @foreach ($jobs as $job)
                            <div class="col-lg-12 col-md-12">
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
                                                        <img src="{{ asset(getAdminById($job->admin_id)->image) }}" class="rounded-circle mr-2"
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

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="pagination-area text-center">
                                {{ $jobs->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">
                        <section class="widget widget_raque_posts_thumb">
                            <h3 class="widget-title">Latest Courses</h3>

                            @foreach ($latest_courses as $course)
                                <article class="item">
                                    <a href="{{ route('courseDetails', $course->slug) }}" class="thumb">
                                        <span class="fullimage cover bg1" role="img"></span>
                                    </a>
                                    <div class="info">
                                        <time datetime="2022-06-30">
                                            @if ($course->discount_price)
                                                ৳{{ number_format($course->discount_price, 2) }}
                                            @else
                                                ৳{{ number_format($course->discount_price, 2) }}
                                            @endif
                                        </time>
                                        <h4 class="title usmall"><a
                                                href="{{ route('courseDetails', $course->slug) }}">{{ $course->name }}</a>
                                        </h4>
                                    </div>

                                    <div class="clear"></div>
                                </article>
                            @endforeach
                        </section>

                        <section class="widget widget_categories">
                            <h3 class="widget-title">Categories</h3>

                            <ul>
                                @foreach ($categories->take(2) as $category)
                                    <li><a href="{{ route('categoryCourses', $category->slug) }}">{{ $category->name }}
                                            <span class="post-count">({{ $category->courses->count() }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End Courses Area -->
@endsection
