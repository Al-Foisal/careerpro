@extends('frontend.layouts.master')
@section('title', 'Register for a Resource Person')
@section('css')
@endsection

@section('content')
    <!-- Start Register Area -->
    <section class="register-area">
        <div class="row m-0">
            <div class="col-lg-6 col-md-12 p-0">
                <div class="register-image">
                    <img src="{{ asset('frontend/img/register-bg.jpg') }}" alt="image">
                </div>
            </div>

            <div class="col-lg-6 col-md-12 pt-100 pb-100">
                <div class="register-content">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="register-form">
                                <div class="logo">
                                    <!-- <a href="index.html"><img src="assets/img/black-logo.png" class="black-logo" alt="image"></a> -->
                                    <a href="{{ route('home') }}">
                                        <h6>Become A Teacher!</h6>
                                    </a>
                                </div>

                                <h3>Open up your {{ config('app.name') }} Account now</h3>
                                @if (!auth()->check())
                                    <p>Please <a href="{{ route('login') }}" style="color: red;">login</a> to be a
                                        Resource Person.</p>
                                @elseif($is_instructor === 0)
                                    <p>Your application is under review.</p>
                                @elseif($is_instructor === 1)
                                    <p>Welcome to be a Resource Person, <a href="">Login now.</a></p>
                                @else
                                    <form action="{{ route('instructor.register') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" id="email" placeholder="Your Fullname"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" id="email" placeholder="Your email address"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" placeholder="Your phone number"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="message" id="email" placeholder="Your message"
                                                class="form-control">
                                        </div>

                                        <button type="submit">Register as Resource Person</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Register Area -->
@endsection

@section('js')
@endsection
