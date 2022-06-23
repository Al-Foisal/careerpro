@extends('frontend.instructor.layouts.master')
@section('title', 'Exam')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Your Exam List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Exams</li>
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
                            <a href="{{ route('instructor.exam.create') }}" class="btn btn-outline-primary">Add
                                Exam</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Course Name</th>
                                        <th>Exam Name</th>
                                        <th>Time Lmit (minute)</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('instructor.exam.edit', $exam->slug) }}">Edit
                                                            Exam</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('instructor.exam.show', $exam->slug) }}">Exam Details</a>

                                                        <form action="{{ route('instructor.exam.delete', $exam->id) }}"
                                                            method="delete">
                                                            @csrf
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Exam</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $exam->course->name }}</td>
                                            <td>{{ $exam->name }}</td>
                                            <td>{{ $exam->timer }}</td>
                                            <td>{{ $exam->created_at }}</td>
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
