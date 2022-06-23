@extends('frontend.instructor.layouts.master')
@section('title', 'New course creation area')
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
                    <h1>New Course</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Course</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Add new course goes here</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('instructor.courses.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Main Category<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="category_id"
                                                required>
                                                <option value="" selected>--select category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Subcategory</label>
                                            <select class="form-control  select2bs4" data-placeholder="Select subcategory"
                                                style="width: 100%" name="subcategory_id">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Language<span class="text-danger">*</span></label>
                                        <select class="form-control  select2bs4" style="width: 100%;" name="language"
                                            required>
                                            <option value="" selected>--select language--</option>
                                            <option value="Bangla" >Bangla</option>
                                            <option value="English" >English</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="course_name">Course name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="course_name"
                                        placeholder="Enter course name" value="{{ old('name') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="selling">Selling price<span class="text-danger">*</span></label>
                                            <input type="number" name="price" class="form-control" id="selling"
                                                placeholder="Selling price" value="{{ old('price') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="discount">Discount price</label>
                                            <input type="number" name="discount_price" class="form-control"
                                                id="discount_price" placeholder="Discount price"
                                                value="{{ old('discount_price') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="duration">Course duration<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="duration" class="form-control" id="duration"
                                                placeholder="Course duration" value="{{ old('duration') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="lesson">Course lessons<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="lesson" class="form-control" id="lesson"
                                                placeholder="Course lessons" value="{{ old('lesson') }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Course details<span class="text-danger">*</span></label>
                                    <textarea type="text" name="details" class="form-control" id="summernote" rows="10">{{ old('details') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Course audience</label>
                                    <textarea type="text" name="audience" class="form-control" id="summernote1"
                                        rows="10">{{ old('audience') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Prerequisite of this course</label>
                                    <textarea type="text" name="prerequisite" class="form-control" id="summernote2"
                                        rows="10">{{ old('prerequisite') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Why this course</label>
                                    <textarea type="text" name="why_this_course" class="form-control" id="summernote3"
                                        rows="10">{{ old('why_this_course') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Learning outcomes</label>
                                    <textarea type="text" name="learning_outcomes" class="form-control" id="summernote4"
                                        rows="10">{{ old('learning_outcomes') }}</textarea>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label for="product_source_link">Course source link<span
                                            class="text-danger">*</span></label>
                                    <textarea rows="2" type="text" name="source_link" class="form-control" id="product_source_link"
                                        placeholder="Enter cource link">{{ old('source_link') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="sample_video_link">Course sample video link</label>
                                    <textarea rows="2" type="text" name="sample_video_link" class="form-control" id="sample_video_link"
                                        placeholder="Course sample video link">{{ old('sample_video_link') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="provider_name">Provider name<span
                                        class="text-danger">*</span></label>
                                    <input type="text" name="provider_name" class="form-control" id="provider_name"
                                        placeholder="Provider name" value="{{ old('provider_name') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="thumbnil_image">Course thumbnil image<span
                                                class="text-danger">*</span></label>
                                            <input type="file" name="thumbnil_image" class="form-control"
                                                id="thumbnil_image" placeholder="Course thumbnil image"
                                                value="{{ old('thumbnil_image') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provider_logo">Provider company logo/logo</label>
                                            <input type="file" name="provider_logo" class="form-control"
                                                id="provider_logo" placeholder="Provider company logo/logo"
                                                value="{{ old('provider_logo') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provider_signature">Provider signature<span
                                                class="text-danger">*</span></label>
                                            <input type="file" name="provider_signature" class="form-control"
                                                id="provider_signature" placeholder="Provider signature"
                                                value="{{ old('provider_signature') }}">
                                        </div>
                                    </div>
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