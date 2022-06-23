@extends('frontend.layouts.__user_master')
@section('title', 'Create Job')

@section('content')
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>My Account</li>
                </ul>
                <h2>Create Job</h2>
            </div>
        </div>
    </div>
    <!-- Start Login Area -->
    <section class="login-area">
        <div class="row m-0">
            <div class="myAccount-navigation pt-100" style="text-align: center;">
                @include('frontend.layouts.partials._user_dashboard_menu')
            </div>
            <div class="col-lg-12 col-md-12 pb-100 pt-100">
                <h3 class="text-center">Hello, <b style="color: red">{{ auth()->user()->name }}</b>! Lets try to find
                    your best qualified employee.</h3>
                <div class="login-content">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="login-form" style="max-width:70%;">
                                <form action="{{ route('user.job.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" placeholder="Your job name"
                                                    class="form-control" required value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="date" name="dead_line" id="dead_line" placeholder="Your job dead line"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="file" name="image" id="image" placeholder="Your image"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <textarea type="text" name="details" id="bio" placeholder="Your job details" rows="4" class="form-control"></textarea>
                                    </div>

                                    <button type="submit">Post Job</button>
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
