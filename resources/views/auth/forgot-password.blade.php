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
                                <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                                </p>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" placeholder="Your email address" name="email" value="{{ old('email') }}" required class="form-control">
                                    </div>

                                    <button type="submit">Email Password Reset Link</button>
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

