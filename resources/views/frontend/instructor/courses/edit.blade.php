@extends('frontend.instructor.layouts.master')
@section('title', 'Existing course update area')
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
                    <h1>Update Course</h1>
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
                        <form action="{{ route('instructor.courses.update', $course->slug) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Main Category<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="category_id"
                                                required>
                                                <option value="" selected>--select category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $course->category_id) {{ 'selected' }} @endif>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Subcategory</label>
                                            <select class="form-control  select2bs4" data-placeholder="Select subcategory"
                                                style="width: 100%" name="subcategory_id">
                                                @if ($course->subcategory_id)
                                                    <option value="{{ $course->subcategory_id }}" selected>
                                                        {{ $course->subcategory->name }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Language<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="language"
                                                required>
                                                <option value="" selected>--select language--</option>
                                                <option value="Bangla"
                                                    @if ($course->language === 'Bangla') {{ 'selected' }} @endif>Bangla
                                                </option>
                                                <option value="English"
                                                    @if ($course->language === 'English') {{ 'selected' }} @endif>English
                                                </option>

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
                                            <option value="Bangla"
                                                @if ($course->language === 'Bangla') {{ 'selected' }} @endif>Bangla</option>
                                            <option value="English"
                                                @if ($course->language === 'English') {{ 'selected' }} @endif>English
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="course_name">Course name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="course_name"
                                        placeholder="Enter course name" value="{{ $course->name }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="selling">Selling price<span class="text-danger">*</span></label>
                                            <input type="number" name="price" class="form-control" id="selling"
                                                placeholder="Selling price" value="{{ $course->price }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="discount">Discount price</label>
                                            <input type="number" name="discount_price" class="form-control"
                                                id="discount_price" placeholder="Discount price"
                                                value="{{ $course->discount_price }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="duration">Course duration<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="duration" class="form-control" id="duration"
                                                placeholder="Discount price" value="{{ $course->duration }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="lesson">Course lessons<span class="text-danger">*</span></label>
                                            <input type="text" name="lesson" class="form-control" id="lesson"
                                                placeholder="Course lessons" value="{{ $course->lesson }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Course details<span class="text-danger">*</span></label>
                                    <textarea type="text" name="details" class="form-control" id="summernote"
                                        rows="10">{{ $course->details }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Course audience</label>
                                    <textarea type="text" name="audience" class="form-control" id="summernote1"
                                        rows="10">{{ $course->audience }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Prerequisite of this course</label>
                                    <textarea type="text" name="prerequisite" class="form-control" id="summernote2"
                                        rows="10">{{ $course->prerequisite }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Why this course</label>
                                    <textarea type="text" name="why_this_course" class="form-control" id="summernote3"
                                        rows="10">{{ $course->why_this_course }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Learning outcomes</label>
                                    <textarea type="text" name="learning_outcomes" class="form-control" id="summernote4"
                                        rows="10">{{ $course->learning_outcomes }}</textarea>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label for="product_source_link">Course source link<span
                                            class="text-danger">*</span></label>
                                    <textarea rows="2" type="text" name="source_link" class="form-control" id="product_source_link"
                                        placeholder="Enter cource link">{{ $course->source_link }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="provider_name">Provider name<span class="text-danger">*</span></label>
                                    <input type="text" name="provider_name" class="form-control" id="provider_name"
                                        placeholder="Provider name" value="{{ $course->provider_name }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sample_video_link">Course sample video</label>
                                            <input type="file" name="sample_video_link" class="form-control"
                                                id="sample_video_link" placeholder="Course sample video"
                                                value="{{ old('sample_video_link') }}">
                                            <video style="height: 100px;width:200px;" controls preload="auto" autoplay
                                                loop muted>
                                                <source src="{{ asset($course->sample_video_link) }}" type='video/mp4'>
                                            </video>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="thumbnil_image">Course thumbnil image<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="thumbnil_image" class="form-control"
                                                id="thumbnil_image" placeholder="Course thumbnil image">
                                            <img src="{{ asset($course->thumbnil_image) }}"
                                                style="height:100px;width:150px;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="provider_logo">Provider company logo/logo</label>
                                            <input type="file" name="provider_logo" class="form-control"
                                                id="provider_logo" placeholder="Provider company logo/logo">
                                            <img src="{{ asset($course->provider_logo) }}"
                                                style="height:100px;width:150px;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="provider_signature">Provider signature<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="provider_signature" class="form-control"
                                                id="provider_signature" placeholder="Provider signature">
                                            <img src="{{ asset($course->provider_signature) }}"
                                                style="height:50px;width:100px;">
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
