@extends('backend.layouts.master')
@section('title', 'Blog List')
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
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
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-outline-primary">Create New Blog</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Blog Image</th>
                                        <th>Blog Name</th>
                                        <th>Blog Author</th>
                                        <th>Blog Details</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td class="d-flex justify-content-between">
                                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> </a>
                                            <form action="{{ route('admin.blogs.destroy',$blog) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return(confirm('Are you sure want to delete this item?'))" class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i> </button>
                                            </form>
                                        </td>
                                        <td>
                                            <img src="{{ asset($blog->image) }}" height="100" width="150">
                                        </td>
                                        <td>{{ $blog->name }}</td>
                                        <td>{{ $blog->instructor->name }}</td>
                                        <td>{{ \Illuminate\Support\Str::words(strip_tags($blog->details), 20, '...') }}</td>
                                        <td>{{ $blog->created_at }}</td>
                                        
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
