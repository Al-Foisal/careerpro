@extends('frontend.layouts.__user_master')
@section('title', 'My Courses')

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
                <h2>My Courses</h2>
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
                <div class="myAccount-profile">

                </div>
                <h3>My Courses Strategy</h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Lesson</th>
                                <th>Source Link</th>
                                <th>Status</th>
                                <th>Get Cirtificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @foreach ($order->courses as $course)
                                    @php
                                        $data = getCourseById($course->course_id);
                                    @endphp
                                    <tr>

                                        <td><a href="{{ route('courseDetails', $data->slug) }}">{{ $data->name }}</a>
                                        </td>
                                        <td>{{ $data->lesson }}</td>
                                        <td><a href="{{ $data->source_link }}" target="_blank">Source Link</a></td>
                                        <td>{{ $course->status }}</td>
                                        <td>
                                            <form action="{{ route('user.courses.certificate') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                                                <button type="submit" onclick="return(confirm('Are you sure want to get certificate??'))" class="btn btn-success btn-sm">Course Completed</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End My Account Area -->
@endsection
