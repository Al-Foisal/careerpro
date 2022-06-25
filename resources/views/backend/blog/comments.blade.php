@extends('layouts.master')
@section('title', 'Article Comments List')
@section('cssLink')
@endsection
@section('cssStyle')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Article Comments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Article</li>
                        <li class="breadcrumb-item active">Article Comments</li>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Is Approved?</th>
                                        <th>Article Name</th>
                                        <th>Commenter Comment</th>
                                        <th>Commenter Name</th>
                                        <th>Commenter Email</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>
                                                <form action="{{ route('admin.comments.approve', $comment) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to approve this item?'))"
                                                        class="btn btn-success btn-xs"> <i class="fas fa-thumbs-up"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $comment->is_approved == 0 ? 'N' : 'Y' }}</td>
                                            <td>{{ $comment->blog->name }}</td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>{{ $comment->name }}</td>
                                            <td>{{ $comment->email }}</td>
                                            <td>{{ $comment->created_at }}</td>

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
