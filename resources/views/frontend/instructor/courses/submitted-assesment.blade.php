@extends('frontend.instructor.layouts.master')
@section('title', 'Submitted Assesment')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Your Submitted Assesment List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Submitted Assesment</li>
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
                                        <th>User Name</th>
                                        <th>Assignment Name</th>
                                        <th>Course Name</th>
                                        <th>Assignment</th>
                                        <th>Assesment</th>
                                        <th>Remarks</th>
                                        <th>Assesment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assesment as $item)
                                        <tr>
                                            <td>{{ getUserById($item->user_id)->name }}</td>
                                            <td>{{ getAssignmentByCourseId($item->course_id)->assignment_name }}</td>
                                            <td>{{ getCourseNameById($item->course_id) }}</td>
                                            <td>
                                                <a href="{{ asset($item->assignment) }}">
                                                    Download Assignment
                                                </a>
                                            </td>


                                            <td>
                                                {{ $item->assesment }}
                                            </td>
                                            <td>
                                                {{ $item->remarks }}
                                            </td>
                                            <td>{{ $item->updated_at->format('l m Y') }}</td>
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
