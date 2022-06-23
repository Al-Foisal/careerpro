@extends('backend.layouts.master')
@section('title', 'Rating and Review List')
@section('cssLink')
@endsection
@section('cssStyle')
@endsection

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rating and Review</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Rating and Review</li>
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
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>User Name</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ratings as $rating)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                @if($rating->status === 0)
                                                <a href="{{ route('admin.activeRatingReview', $rating) }}" class="btn btn-info btn-xs">Active</a>
                                                @endif
                                                <form action="{{ route('admin.deleteRatingReview', $rating) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> Delete
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $rating->rating }}</td>
                                            <td>{{ $rating->review }}</td>
                                            <td>{{ $rating->product->name }}</td>
                                            <td>
                                                <img src="{{ asset($rating->product->images->first()->image) }}" height="70" width="70" alt="PI">
                                            </td>
                                            <td>{{ $rating->user->name }}</td>
                                            <td>{{ $rating->created_at }}</td>
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
