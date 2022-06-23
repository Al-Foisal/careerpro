{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@extends('frontend.layouts.master')
@section('title', 'Register')

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
                                <p>Already signed up? <a href="{{ route('login') }}">Log in</a></p>

                                <form>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" placeholder="Your name"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" id="email" placeholder="Your email address"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="password" placeholder="Create a password"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-enter password"
                                            class="form-control" required>
                                    </div>

                                    <button type="submit">Sign Up</button>

                                    <div class="connect-with-social">
                                        <span>Or</span>
                                        <button type="submit" class="facebook"><i class='bx bxl-facebook'></i> Connect
                                            with Facebook</button>
                                        <button type="submit" class="twitter"><i class='bx bxl-twitter'></i> Connect
                                            with Twitter</button>
                                    </div>
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
