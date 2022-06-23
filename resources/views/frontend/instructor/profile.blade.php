@extends('frontend.instructor.layouts.master')
@section('title', 'Profile')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Instructor Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Instructor</li>
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
                        <form action="{{ route('instructor.profileUpdate',$profile->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter Name" name="name" value="{{ $profile->name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter phone " name="phone" value="{{ $profile->phone ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Designation</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter designation" name="designation" value="{{ $profile->designation ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Message</label>
                                    <textarea name="message" class="form-control" rows="2" placeholder="Enter message">{{ $profile->message ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Details</label>
                                    <textarea name="details" id="summernote"
                                        placeholder="Enter address">{{ $profile->details ?? '' }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($profile->image))
                                                <img src="{{ asset($profile->image) }}" height="200" width="200" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
