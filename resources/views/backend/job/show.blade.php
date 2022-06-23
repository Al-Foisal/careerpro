@extends('backend.layouts.master')
@section('title', $job->name)

@section('backend')
    <!-- Content Header (Job header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Job Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Job Details</h1>
                        <hr>
                        Job Name: {{ $job->name }} <br>
                        Job Dead Line: {{ $job->dead_line }} <br><br>
                        Job Details: {!! $job->details !!}
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>##</th>
                                        <th>Provider</th>
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
                                            <td>{{ getUserById($app->user_id ?? $app->admin_id) }}</td>
                                            <td>{{ $app->name }}</td>
                                            <td>{{ $app->email }}</td>
                                            <td>{{ $app->phone }}</td>
                                            <td><a href="{{ asset($app->cv) }}" download>Download CV</a></td>
                                            <td>{{ $app->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsLink')
@endsection
@section('jsScript')
@endsection
