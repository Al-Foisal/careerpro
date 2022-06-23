@extends('frontend.layouts.master')
@section('title', $job->name)

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Job</li>
                </ul>
                <h2>{{ $job->name }}</h2>
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
                            <img src="{{ asset($job->image) }}" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8">
                        <div class="instructor-details">
                            <h3>{{ $job->name }}</h3>
                            <span class="sub-title">Application Dead Line: {{ $job->dead_line->format('l m Y') }}</span>
                            {!! $job->details !!}
                        </div>
                    </div>
                </div>
            </div>
            @if ($job->walk_in_interview === 0)
                <div class="section-title text-left">
                    <h2>Apply For This Position</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="single-courses-box mb-30">
                            <div class="courses-content">
                                <section class="login-area">
                                    <div class="row m-0">
                                        <div class="col-lg-12 col-md-12 p-0">
                                            <div class="login-content">
                                                <div class="d-table">
                                                    <div class="d-table-cell">
                                                        <div class="login-form">
                                                            <form action="{{ route('storeApplication', $job->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="form-group">
                                                                    <input type="text" name="name" id="name"
                                                                        placeholder="Your name" class="form-control"
                                                                        value="{{ old('name') }}" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="email" name="email" id="email"
                                                                        placeholder="Your email address"
                                                                        value="{{ old('email') }}" class="form-control"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="text" name="phone" id="phone"
                                                                        placeholder="Your phone" class="form-control"
                                                                        value="{{ old('phone') }}" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="text" name="nid" id="nid"
                                                                        placeholder="Your nid" value="{{ old('nid') }}"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="text" name="experience" id="experience"
                                                                        placeholder="Your experience (optional)"
                                                                        value="{{ old('experience') }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="file" style="float: left;">Place Your
                                                                        CV</label>
                                                                    <input type="file" name="cv" id="file"
                                                                        placeholder="Your CV" accept="application/pdf"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="image" style="float: left;">Your
                                                                        Image</label>
                                                                    <input type="file" name="image" id="image"
                                                                        placeholder="Your image" class="form-control"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="certificate"
                                                                        style="float: left;">Educational Certificate</label>
                                                                    <input type="file" name="certificate"
                                                                        id="certificate" placeholder="Your CV"
                                                                        accept="application/pdf" class="form-control"
                                                                        required>
                                                                </div>

                                                                <button type="submit">Apply</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- End Instructor Details Area -->
@endsection
