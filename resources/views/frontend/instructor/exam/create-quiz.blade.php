@extends('frontend.instructor.layouts.master')
@section('title', 'Quiz area')
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
                    <h1>New Quiz</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Quiz</li>
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
                        <form action="{{ route('instructor.exam.storeQuiz') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                </div>

                                <div class="form-group">
                                    <label for="course_name">Quiz name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="course_name"
                                        placeholder="Enter Quiz name" value="{{ old('name') }}" required>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Quiz Items<span class="text-danger">*</span>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="input-group hdtuto control-group lst increment">
                                                <input type="text" name="item[]" class="myfrm form-control"
                                                    placeholder="Item name" required value="{{ old('item') }}">
                                                <input type="number" name="solution[]" class="myfrm form-control"
                                                    placeholder="0 or 1" required value="{{ old('solution') }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success" type="button"><i
                                                            class="far fa-plus-square"></i> Add</button>
                                                </div>
                                            </div>

                                            <div class="clone hide">
                                                <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                                    <input type="text" name="item[]" class="myfrm form-control"
                                                        placeholder="Item name" required value="{{ old('item') }}">
                                                    <input type="number" name="solution[]" class="myfrm form-control"
                                                        placeholder="0 or 1" required value="{{ old('solution') }}">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-danger" type="button"> <i
                                                                class="far fa-minus-square"></i> Remove </button>

                                                    </div>
                                                </div>
                                            </div>
                                            @error('images[]')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
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
    {{-- for multiple file insertion --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();
            });
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
@endsection
