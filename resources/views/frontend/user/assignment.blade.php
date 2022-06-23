@extends('frontend.layouts.__user_master')
@section('title', 'Assignment')

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
                <h2>My Assignment</h2>
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
                <h3>My Courses Assignment Strategy</h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Assignment Name</th>
                                <th><i>Submit Assignment</i></th>
                                <th>Assesment</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @foreach ($order->courses as $course)
                                    @php
                                        $cdata = getCourseById($course->course_id);
                                        $data = getAssignmentByCourseId($course->course_id);
                                    @endphp
                                    <tr>
                                        <td>{{ $cdata->name }}</td>
                                        @if ($data)
                                            @php
                                                $assesment = checkAssesment($data->id, Auth::id(), $data->course_id);
                                            @endphp
                                            <td>
                                                <a href="{{ asset($data->assignment) }}" target="_blank">
                                                    <b>
                                                        {{ $data->assignment_name }}
                                                    </b>
                                                </a>
                                            </td>
                                            @if ($assesment)
                                                <td>
                                                    <b><i>Assignment Submitted</i></b>
                                                </td>

                                                <td>{{ $assesment->assesment }}%</td>

                                                <td>{{ $assesment->remarks }}</td>
                                            @else
                                                <td>
                                                    <form action="{{ route('user.courses.storeAssignment') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="course_assignment_id"
                                                            value="{{ $data->id }}">
                                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                        <input type="hidden" name="course_id" value="{{ $cdata->id }}">
                                                        <input type="file" name="assignment" class="form-contril"
                                                            required>
                                                        <button type="submit">submit</button>
                                                    </form>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        @else
                                            <td>No Assignment</td>
                                            <td>No Assignment</td>
                                            <td></td>
                                            <td></td>
                                        @endif
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
