@extends('frontend.layouts.__user_master')
@section('title', 'Exam')

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
                <h2>My Exam</h2>
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
            <div class="myAccount-content">
                <h3>Your Exam List</h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Time Limit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ $exam->timer }}</td>
                                    <td>
                                        <a href="{{ route('user.courses.examFlow', $exam->slug) }}"
                                            class="view-button">Start Exam</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End My Account Area -->
@endsection
