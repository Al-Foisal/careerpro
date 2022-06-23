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
                                        <th>Image</th>
                                        <th>status</th>
                                        <th>Name</th>
                                        <th>Dead Line</th>
                                        <th>Post Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.job.edit', $job) }}" class="btn btn-info btn-xs">
                                                    <i class="fas fa-edit"></i> </a>
                                                    <a href="{{ route('admin.job.show', $job) }}" class="btn btn-info btn-xs">
                                                        <i class="fas fa-eye"></i> </a>
                                                @if ($job->status === 1)
                                                    <form action="{{ route('admin.job.inactive', $job) }}" method="post">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return(confirm('Are you sure want to INACTIVE this item?'))"
                                                            class="btn btn-danger btn-xs"> <i
                                                                class="far fa-thumbs-down"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.job.active', $job) }}" method="post">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return(confirm('Are you sure want to Active this item?'))"
                                                            class="btn btn-info btn-xs"> <i class="far fa-thumbs-up"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.job.delete', $job) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td><img src="{{ asset($job->image) }}" style="height:100px;width:150px"></td>
                                            <td>{{ $job->status === 1 ? 'Y' : 'N' }}</td>
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
