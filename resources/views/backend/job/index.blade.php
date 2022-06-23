@extends('backend.layouts.master')
@section('title', 'Job List')

@section('backend')
    <!-- Content Header (Job header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Job</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.job.create') }}" class="btn btn-outline-primary">Add New Job</a>
                            <br>
                            <br>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>status</th>
                                        <th>Walk In Interview</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Dead Line</th>
                                        <th>Post Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.job.show', $job) }}">View Details</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.job.edit', $job) }}">Edit</a>
                                                        @if ($job->status == 0)
                                                            <form action="{{ route('admin.job.active', $job) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Job</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.job.inactive', $job) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Job</button>
                                                            </form>
                                                        @endif

                                                        @if ($job->walk_in_interview == 0)
                                                            <form action="{{ route('admin.job.activeWalkInInterview', $job) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    for walk-in-interview</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.job.inactiveWalkInInterview', $job) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    for walk-in-interview</button>
                                                            </form>
                                                        @endif
                                                        
                                                        <form action="{{ route('admin.job.delete', $job) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="dropdown-item" type="submit"
                                                                onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $job->status === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $job->walk_in_interview === 1 ? 'Y' : 'N' }}</td>
                                            <td><img src="{{ asset($job->image) }}" style="height:100px;width:150px">
                                            </td>
                                            <td>{{ $job->name }}</td>
                                            <td>{{ $job->dead_line }}</td>
                                            <td>{{ $job->updated_at }}</td>
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
