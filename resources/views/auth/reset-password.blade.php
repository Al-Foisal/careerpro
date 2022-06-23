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
                                        <img src="{{ asset($company->logo) }}" class="black-logo" alt="image"
                                            style="height: 100px;">
                                    </a>

                                </div>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="form-group">
                                        <input type="email" placeholder="Your email address" name="email"
                                            value="{{ old('email', $request->email) }}" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" placeholder="Your password" required name="password"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            placeholder="Re-enter password" class="form-control" required>
                                    </div>

                                    <button type="submit">Reset Password</button>
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
