@extends('backend.layouts.master')
@section('title', 'FAQ List')
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FAQ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
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
                            <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-primary">Create New FAQ</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>FAQ Name</th>
                                        <th>FAQ Details</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqs as $faq)
                                    <tr>
                                        <td class="d-flex justify-content-between">
                                            <form action="{{ route('admin.faqs.destroy',$faq) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return(confirm('Are you sure want to delete this item?'))" class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i> </button>
                                            </form>
                                        </td>
                                        <td>{{ $faq->name }}</td>
                                        <td>{{ $faq->details }}</td>
                                        <td>{{ $faq->created_at }}</td>
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
