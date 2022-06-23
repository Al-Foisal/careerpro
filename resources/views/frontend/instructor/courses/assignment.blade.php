@extends('frontend.instructor.layouts.master')
@section('title', 'Assignment for ' . $course->name)
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
                    <h1>Course Assignment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Course Assignment</li>
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
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('instructor.courses.assignment', $course->slug) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex justify-content-start">
                                    <label for="thumbnil_image">Assignment<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <input type="file" name="assignment_name" class="form-control" id="thumbnil_image"
                                            placeholder="Assignment name" value="{{ old('assignment_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="assignment" class="form-control" id="thumbnil_image"
                                            placeholder="Course thumbnil image" value="{{ old('assignment') }}">
                                    </div>

                                    <!-- /.card-body -->
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        style="height: fit-content;">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    @if (getAssignmentByCourseId($course->id))
                        <iframe src="{{ asset(getAssignmentByCourseId($course->id)->assignment) }}" width="100%"
                            height="500px">
                        </iframe>
                    @endif
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsScript')


    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/get-subcategory/') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' +
                                    value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
