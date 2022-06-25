@extends('frontend.layouts.__user_master')
@section('title', 'Update your profile')

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
                <h2>Update Profile</h2>
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
                <h3>Your Posted Job || <a href="{{ route('user.job.create') }}" class="btn btn-danger btn-sm">Post Job</a>
                </h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>##</th>
                                <th>Status</th>
                                <th>Walk <br>In <br>Interview</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Dead Line</th>
                                <th>Created_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $key => $job)
                                <tr>

                                    <td>{{ ++$key }}</td>
                                    <td>{{ $job->status === 1 ? 'Y' : 'N' }}</td>
                                    <td>{{ $job->walk_in_interview === 1 ? 'Y' : 'N' }}</td>
                                    <td><img src="{{ asset($job->image) }}" style="height:100px;width:100px"></td>
                                    <td>{{ $job->name }}</td>
                                    <td>{{ $job->dead_line->format('l m Y') }}</td>
                                    <td>{{ $job->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu1">
                                                <a class="dropdown-item"
                                                    href="{{ route('user.job.show', $job) }}">View Details</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('user.job.edit', $job) }}">Edit</a>
                                                @if ($job->status == 0)
                                                    <form action="{{ route('user.job.active', $job) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">Active
                                                            Job</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('user.job.inactive', $job) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">Inactive
                                                            Job</button>
                                                    </form>
                                                @endif

                                                @if ($job->walk_in_interview == 0)
                                                    <form action="{{ route('user.job.activeWalkInInterview', $job) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">Active
                                                            for walk-in-interview</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('user.job.inactiveWalkInInterview', $job) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">Inactive
                                                            for walk-in-interview</button>
                                                    </form>
                                                @endif
                                                
                                                <form action="{{ route('user.job.delete', $job) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End Login Area -->
@endsection
