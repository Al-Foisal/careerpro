@extends('frontend.layouts.__user_master')
@section('title', 'Result')

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
                <h2>My Result</h2>
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
                <h3>Your Exam Result</h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Exam Taken</th>
                                <th>Exam Name</th>
                                <th>Point</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->created_at->format('l m Y') }}</td>
                                    <td>{{ $result->exam->name }}</td>
                                    <td>{{ $result->point }}%</td>
                                    <td>
                                        @if ($result->status === 'Pass')
                                            <span style="color: green">{{ $result->status }}</span>
                                        @else
                                            <span style="color: red">{{ $result->status }}</span>
                                        @endif
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
