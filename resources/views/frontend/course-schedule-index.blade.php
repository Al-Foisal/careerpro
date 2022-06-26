@extends('frontend.layouts.master')
@section('title', 'Dashboard')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Our Course Schedule</li>
                </ul>
                <h2>Our Course Schedule</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start My Account Area -->
    <section class="my-account-area ptb-100">
        <div class="container">
            <div class="myAccount-content">
                <h3>Course Schedule</h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Instructor Name</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->instructor_name }}</td>
                                    <td>{{ $course->time_length }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- End My Account Area -->
@endsection
