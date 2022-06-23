@extends('backend.layouts.master')
@section('title', 'Edit Blog')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Blog</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Blog Image (600 x 485)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" name="image" id="exampleInputFile">
                                        </div>
                                    </div>
                                    <img src="{{ asset($blog->image) }}" height="100px" width="100px" alt="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Blog Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter blog name" name="name" value="{{ $blog->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Select Instructor<span class="text-danger">*</span></label>
                                    <select class="form-control  select2bs4" style="width: 100%;"
                                        name="instructor_id" required>
                                        <option value="" selected>--select instructor--</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}" @if ($instructor->id == $blog->instructor_id) {{ 'selected' }} @endif>{{ $instructor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    Blog Details
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <textarea id="summernote" name="details">{!! $blog->details !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection