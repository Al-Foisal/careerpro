@extends('frontend.layouts.master')
@section('title', 'Raise up yourself by education')

@section('content')
    <div class="slider_area">
        <div id="rev_slider_1078_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classic4export"
            data-source="gallery"
            style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
            <div id="rev_slider_1078_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
                <ul>
                    @foreach ($slider as $slid)
                        <li>
                            <!-- MAIN IMAGE -->
                            <img src="{{ asset($slid->image) }}" style="width:1920px;height:1080px">
                        </li>
                    @endforeach
                </ul>
                <div class="tp-bannertimer" style="height: 7px; background-color: rgba(255, 255, 255, 0.25);"></div>
            </div>
        </div>
        <!-- END REVOLUTION SLIDER -->
    </div>
    <!-- End Slider Area -->

    @foreach ($activeCategories as $activeCategory)
        <section class="courses-area ptb-100" style="margin-left:60px;margin-right:60px;">
            <div class="container-fluide">
                <div class="section-title text-left">
                    <h2>{{ $activeCategory->name }}</h2>
                    <a href="{{ route('categoryCourses', $activeCategory->slug) }}" class="default-btn">
                        <i class="bx bx-show-alt icon-arrow before"></i>
                        <span class="label">All Courses</span>
                        <i class="bx bx-show-alt icon-arrow after"></i>
                    </a>
                </div>
                @php
                    $courses = DB::table('courses')
                        ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
                        ->where('courses.is_approved', 1)
                        ->where('courses.category_id', $activeCategory->id)
                        ->select(['courses.thumbnil_image', 'courses.name', 'courses.slug', 'courses.lesson', 'courses.price', 'courses.discount_price', 'instructors.name as instructorName', 'instructors.image as instructorImage'])
                        ->limit(10)
                        ->get();
                @endphp
                <div class="courses-slides owl-carousel owl-theme">
                    @foreach ($courses as $course)
                        <div class="single-courses-box mb-30">
                            <div class="courses-image">
                                <a href="{{ route('courseDetails', $course->slug) }}" class="d-block">
                                    <img src="{{ asset($course->thumbnil_image) }}" style="width:300px;height:242px;">
                                </a>
                            </div>
                            <div class="courses-content">
                                <div class="course-author d-flex align-items-center">
                                    <img src="{{ asset($course->instructorImage) }}" class="rounded-circle mr-2"
                                        alt="image">
                                    <span>{{ $course->instructorName }}</span>
                                </div>
                                <h3>
                                    <a href="{{ route('courseDetails', $course->slug) }}" class="d-inline-block">
                                        {{ $course->name }}
                                    </a>
                                </h3>

                            </div>
                            <div class="courses-box-footer">
                                <ul class="d-flex justify-content-between">
                                    <li class="courses-lesson d-flex justify-content-start">
                                        <i class="bx bx-book-open" style="margin-right: 5px;"></i>
                                        {{ $course->lesson }} lessons
                                    </li>
                                    @if ($course->discount_price === null)
                                        <li class="courses-price">
                                            ৳ {{ $course->price }}
                                        </li>
                                    @else
                                        <li class="courses-price">
                                            <span>৳ {{ $course->price }}</span>
                                            ৳ {{ $course->discount_price }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <!-- Start Feedback Area -->
    <section class="feedback-area ptb-100">
        <div class="container">
            <div class="feedback-slides owl-carousel owl-theme">
                @foreach ($testimonials as $test)
                    <div class="single-feedback-item">
                        <p>“{{ $test->details }}”</p>

                        <div class="info">
                            <h3>{{ $test->name }}</h3>
                            <span>{{ $test->designation }}</span>
                            <img src="{{ asset($test->image) }}" class="shadow rounded-circle" style="height:94px;width:94px">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Feedback Area -->
@endsection
