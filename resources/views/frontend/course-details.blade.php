@extends('frontend.layouts.master')
@section('title', $course->name)

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a
                            href="{{ route('categoryCourses', [$course->category->slug, $course->subcategory->slug ?? null]) }}">
                            @if ($course->subcategory_id === null)
                                {{ $course->category->name }}
                            @else
                                {{ $course->category->name . ' & ' . $course->subcategory->name ?? null }}
                            @endif
                        </a>
                    </li>
                    <li>{{ $course->name }}</li>
                </ul>
                <h2>{{ $course->name }}</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start Courses Details Area -->
    <section class="courses-details-area pt-100 pb-70">
        <div class="container">
            <div class="courses-details-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="courses-title">
                            <h2>{{ $course->name }}</h2>
                        </div>
                        <div class="courses-meta">
                            <ul>
                                <li>
                                    <i class="bx bx-folder-open"></i>
                                    <span>Category</span>
                                    <a
                                        href="{{ route('categoryCourses', $course->category->slug) }}">{{ $course->category->name }}</a>
                                </li>
                                <li>
                                    <i class="bx bx-group"></i>
                                    <span>Students Enrolled</span>
                                    <a href="#">{{ getStudentByCourseId($course->id) }}</a>
                                </li>
                                <li>
                                    <i class="bx bx-calendar"></i>
                                    <span>Last Updated</span>
                                    <a href="#">
                                        {{ $course->updated_at->diffForHumans() }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="courses-price">
                            {{-- <div class="courses-review">
                                <div class="review-stars">
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                </div>
                                <span class="reviews-total d-inline-block">(2 reviews)</span>
                            </div> --}}
                            {{-- <div class="price">$250</div> --}}
                            @if ($course->discount_price)
                                <div class="price">
                                    <span><del>৳{{ $course->price }}</del></span>
                                    ৳{{ $course->discount_price }}
                                </div>
                            @else
                                <div class="price">
                                    ৳{{ $course->price }}
                                </div>
                            @endif
                            <a href="javascript:;" onclick="add_to_cart({{ $course->id }})" class="default-btn">
                                <i class="bx bx-paper-plane icon-arrow before"></i>
                                <span class="label">Enrol Now</span>
                                <i class="bx bx-paper-plane icon-arrow after"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="courses-details-image text-center">
                        @if ($course->sample_video_link)
                            {{-- <iframe width="736" height="400" src="{{ $course->sample_video_link }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe> --}}
                            <video style="height: 400px;width:736px;" controls preload="auto" autoplay loop muted>
                                <source src="{{ asset($course->sample_video_link) }}" type='video/mp4'>
                            </video>
                        @else
                            <img src="{{ asset($course->thumbnil_image) }}" alt="image">
                        @endif
                    </div>
                    <div class="courses-details-desc">

                        @if ($course->details !== null)
                            <h3>Description</h3>
                            {!! $course->details !!}
                        @endif

                        @if ($course->audience !== null)
                            <h3>Audience</h3>
                            {!! $course->audience !!}
                        @endif

                        @if ($course->prerequisite !== null)
                            <h3>Prerequisite</h3>
                            {!! $course->prerequisite !!}
                        @endif

                        @if ($course->why_this_course !== null)
                            <h3>Why this course</h3>
                            {!! $course->why_this_course !!}
                        @endif

                        @if ($course->learning_outcomes !== null)
                            <h3>Learning Outcomes</h3>
                            {!! $course->learning_outcomes !!}
                        @endif
                        <hr>

                        <h3>Meet your Resource Person</h3>
                        <div class="courses-author">
                            <div class="author-profile-header"></div>
                            <div class="author-profile">
                                <div class="author-profile-title">
                                    <img src="{{ asset($course->instructor->image) }}" class="shadow-sm rounded-circle"
                                        alt="image">
                                    <div class="author-profile-title-details d-flex justify-content-between">
                                        <div class="author-profile-details">
                                            <h4>{{ $course->instructor->name }}</h4>
                                            <span class="d-block">
                                                {{ $course->instructor->designation }}
                                            </span>
                                        </div>
                                        <div class="author-profile-raque-profile">
                                            <a href="{{ route('instructorDetails', $course->instructor->id) }}"
                                                class="d-inline-block">View Profile on {{ config('app.name') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <p>{{ $course->instructor->message }}</p>
                            </div>
                        </div>
                        {{-- <div class="courses-review-comments">
                            <h3>3 Reviews</h3>
                            <div class="user-review">
                                <img src="assets/img/user1.jpg" alt="image">
                                <div class="review-rating">
                                    <div class="review-stars">
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                    </div>
                                    <span class="d-inline-block">James Anderson</span>
                                </div>
                                <span class="d-block sub-comment">Excellent</span>
                                <p>Very well built theme, couldn't be happier with it. Can't wait for future updates to see
                                    what else they add in.</p>
                            </div>
                            <div class="user-review">
                                <img src="assets/img/user2.jpg" alt="image">
                                <div class="review-rating">
                                    <div class="review-stars">
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                    </div>
                                    <span class="d-inline-block">Sarah Taylor</span>
                                </div>
                                <span class="d-block sub-comment">Video Quality!</span>
                                <p>Was really easy to implement and they quickly answer my additional questions!</p>
                            </div>
                            <div class="user-review">
                                <img src="assets/img/user3.jpg" alt="image">
                                <div class="review-rating">
                                    <div class="review-stars">
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                    </div>
                                    <span class="d-inline-block">David Warner</span>
                                </div>
                                <span class="d-block sub-comment">Perfect Coding!</span>
                                <p>Stunning design, very dedicated crew who welcome new ideas suggested by customers, nice
                                    support.</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="courses-sidebar-information">
                        <ul>
                            <li>
                                <span>
                                    <i class="bx bx-group"></i>
                                    Students:
                                </span>
                                {{ getStudentByCourseId($course->id) }}
                            </li>
                            <li>
                                <span>
                                    <i class="bx bxs-institution"></i>
                                    Institution:
                                </span>
                                <a href="#" class="d-inline-block">{{ $course->provider_name }}</a>
                            </li>
                            <li>
                                <span>
                                    <i class="bx bx-timer"></i>
                                    Deration:
                                </span>
                                {{ $course->duration }} Hours
                            </li>
                            <li>
                                <span>
                                    <i class="bx bx-atom"></i>
                                    Lessons:
                                </span>
                                {{ $course->lesson }}
                            </li>
                            <li>
                                <span>
                                    <i class="bx bx-food-menu"></i>
                                    Quizzes:
                                </span>
                                {{ checkQuizByCourseId($course->id) ? 'Yes' : 'No' }}
                            </li>
                            <li>
                                <span>
                                    <i class="bx bx-notepad"></i>
                                    Assignment:
                                </span>
                                {{ checkAssignmentByCourseId($course->id) ? 'Yes' : 'No' }}
                            </li>
                            <li>
                                <span>
                                    <i class="bx bx-support"></i>
                                    Language:
                                </span>
                                {{ $course->language }}
                            </li>
                            <li>
                                <span>
                                    <i class="bx bx-certification"></i>
                                    Certificate:
                                </span>
                                Yes
                            </li>
                        </ul>
                    </div>
                    <div class="related-courses">
                        <h3>Related Courses</h3>
                        @foreach ($related_courses as $related)
                            <div class="single-courses-box mb-30">
                                <div class="courses-image">
                                    <a href="single-courses.html" class="d-block">
                                        <img src="{{ asset($related->thumbnil_image) }}" alt="image">
                                    </a>
                                </div>
                                <div class="courses-content">
                                    <div class="course-author d-flex align-items-center">
                                        <img src="{{ asset($related->instructor->image) }}" class="rounded-circle mr-2"
                                            alt="image">
                                        <span>{{ $related->instructor->name }}</span>
                                    </div>
                                    <h3>
                                        <a href="single-courses.html" class="d-inline-block">{{ $course->name }}</a>
                                    </h3>
                                    {{-- <div class="courses-rating">
                                        <div class="review-stars-rated">
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star-half"></i>
                                        </div>
                                        <div class="rating-total">
                                            4.5 (2 rating)
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="courses-box-footer">
                                    <ul class="d-flex justify-content-between">
                                        <li class="courses-lesson d-flex justify-content-between">
                                            <i class="bx bx-book-open" style="margin-right: 5px;"></i>
                                            {{ $course->lesson }} lessons
                                        </li>
                                        @if ($related->discount_price)
                                            <li class="courses-price">
                                                <span>৳{{ $related->price }}</span>
                                                ৳{{ $related->discount_price }}
                                            </li>
                                        @else
                                            <li class="courses-price">
                                                ৳{{ $related->price }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Courses Details Area -->
@endsection

@section('js')
    <script>
        function add_to_cart(course_id) {

            $(document).ready(function(e) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',

                    url: "{{ asset('/') }}add-to-cart",
                    data: {
                        id: course_id,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Product added to cart successfully'
                            })


                            $('.total_cart_items').html(response.cart_count);

                        }

                    },
                    async: false,
                    error: function(error) {

                    }
                })
            })

        }

        function wishlist(product_id) {


            $(document).ready(function(e) {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',

                    url: "{{ asset('/') }}add-to-wishlist",
                    data: {
                        id: product_id,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status == 1) {


                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'Product already added to wishlist!!'
                            })


                        } else if (response.status == 2) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Product added to wishlist!!'
                            })
                            $('.total_wishlist_items').html(response.wishlist_count);
                        } else if (response.status == 3) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'Please login first!!'
                            })
                        }

                    },
                    async: false,
                    error: function(error) {

                    }
                })
            })

        }
    </script>
@endsection
