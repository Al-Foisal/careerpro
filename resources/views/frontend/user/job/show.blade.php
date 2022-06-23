@extends('frontend.layouts.__user_master')
@section('title', $job->name)
@section('css')
    <script>
        function printContent(el) {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }
    </script>
@endsection
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>My Account</li>
                </ul>
                <h2>Job Details</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start My Account Area -->
    <section class="my-account-area ptb-100">
        <div class="container">
            <div class="myAccount-navigation" style="text-align: center;">
                @include('frontend.layouts.partials._user_dashboard_menu')
            </div>
            <div class="myAccount-content" id="print">
                <div class="myAccount-profile">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5">
                            <div class="profile-image">
                                <img src="{{ asset($job->image) }}" alt="image" style="height: 300px;width:300px;">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="profile-content">
                                <h3>{{ $job->name }}</h3>
                                <h6>{{ 'Dead Line: ' . $job->dead_line->format('l m Y') }}</h6>
                                <p>{!! $job->details !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Job Applications</h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>##</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>CV</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($job->jobApplications as $key => $app)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $app->name }}</td>
                                    <td>{{ $app->email }}</td>
                                    <td>{{ $app->phone }}</td>
                                    <td><a href="{{ asset($app->cv) }}" download>Download CV</a></td>
                                    <td>{{ $job->created_at->format('l m y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <button id="print" onclick="printContent('print');" class="btn btn-success btn-sm">Print Job</button>
        </div>
    </section>
    <!-- End My Account Area -->
@endsection
