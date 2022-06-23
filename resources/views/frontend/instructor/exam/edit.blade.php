@extends('frontend.instructor.layouts.master')
@section('title', 'Exam update area')
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endsection

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Exam</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Exam</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('instructor.exam.update',$exam->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Courses<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="course_id"
                                                required>
                                                <option value="" selected>--select courses--</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}" @if($course->id === $exam->course_id) selected @endif>{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time Limit</label>
                                            <input type="number" class="form-control" name="timer" value="{{ $exam->timer }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="course_name">Exam name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="course_name"
                                        placeholder="Enter course name" value="{{ $exam->name }}">
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

