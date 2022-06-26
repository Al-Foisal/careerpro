@extends('frontend.layouts.master')
@section('title', 'Login')

@section('content')
    <!-- Start Login Area -->
    <section class="login-area">
        <div class="row m-0">
            <div class="col-lg-12 col-md-12 p-0">
                <div class="login-content">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="login-form">
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset($company->logo) }}" class="black-logo" alt="image" style="height: 100px;">
                                    </a>

                                </div>
                                <h3>Welcome back</h3>
                                <p>New to {{ config('app.name') }}?
                                    <a href="{{ route('register') }}">Sign up</a>
                                </p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" placeholder="Your email address" name="email" value="{{ old('email') }}" required class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" placeholder="Your password" required name="password" class="form-control">
                                    </div>

                                    <button type="submit">Login</button>

                                    <div class="forgot-password">
                                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>

                                    <!--<div class="connect-with-social">-->
                                    <!--    <button type="submit" class="facebook">-->
                                    <!--        <i class="bx bxl-facebook"></i> Connect with Facebook-->
                                    <!--    </button>-->
                                    <!--    <button type="submit" class="twitter">-->
                                    <!--        <i class="bx bxl-twitter"></i> Connect with Twitter-->
                                    <!--    </button>-->
                                    <!--</div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Login Area -->
@endsection
