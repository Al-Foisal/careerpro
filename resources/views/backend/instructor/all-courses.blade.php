@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resource Person Courses List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Courses</li>
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
                                        <th></th>
                                        <th>Action</th>
                                        <th>Thumbnil Image</th>
                                        <th>Provider Logo</th>
                                        <th>Approved?</th>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Duration</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Provider Name</th>
                                        <th>Provider Signature</th>
                                        <th>Source Link</th>
                                        <th>Sample Video Link</th>
                                        <th>Language</th>
                                        <th>Details</th>
                                        <th>Audience</th>
                                        <th>Prerequisite</th>
                                        <th>Why This Course</th>
                                        <th>Learning Outcomes</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td></td>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- active&inactive --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.instructor.editCourses', $course->slug) }}">Edit
                                                            Course</a>
                                                        @if ($course->is_approved === 1)
                                                            <form
                                                                action="{{ route('admin.instructor.denyCourse', $course) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Deny The
                                                                    Course</button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('admin.instructor.approveCourse', $course) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Approve The
                                                                    Course</button>
                                                            </form>
                                                        @endif

                                                        <form action="{{ route('admin.instructor.delete', $course) }}"
                                                            method="delete">
                                                            @csrf
                                                            <button class="dropdown-item" onclick="return confirm('Are you sure want to delete this item?')" type="submit">Delete
                                                                Course</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset($course->thumbnil_image) }}"
                                                    style="height: 100px;width:100px;">
                                            </td>
                                            <td>
                                                <img src="{{ asset($course->provider_logo) }}"
                                                    style="height: 100px;width:100px;">
                                            </td>
                                            <td>{{ $course->is_approved === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $course->status === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->category->name }}, <br>
                                                Sub={{ $course->subcategory->name??'' }}
                                            </td>
                                            <td>{{ $course->duration }}</td>
                                            <td>{{ $course->price }}</td>
                                            <td>{{ $course->discount_price }}</td>
                                            <td>{{ $course->provider_name }}</td>
                                            <td>
                                                <img src="{{ asset($course->provider_signature) }}"
                                                    style="height: 50px;width:70px;">
                                            </td>
                                            <td>{{ $course->source_link }}</td>
                                            <td>{{ $course->sample_video_link }}</td>
                                            <td>{{ $course->language }}</td>
                                            <td>{!! $course->details !!}</td>
                                            <td>{!! $course->audience !!}</td>
                                            <td>{!! $course->prerequisite !!}</td>
                                            <td>{!! $course->why_this_course !!}</td>
                                            <td>{!! $course->learning_outcomes !!}</td>
                                            <td>{{ $course->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $courses->links() }}
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
