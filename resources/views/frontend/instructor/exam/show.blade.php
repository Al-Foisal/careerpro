@extends('frontend.instructor.layouts.master')
@section('title', 'Quiz')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Your Quiz List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Quizzes</li>
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
                            <a href="{{ route('instructor.exam.createQuiz', $exam->id) }}"
                                class="btn btn-outline-primary">Add
                                Quiz</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Quiz Details</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $exam->name }}</td>
                                        @if ($exam->quizzes->count() > 1)
                                            <td>
                                                @foreach ($exam->quizzes as $quiz)
                                                    {{ $quiz->name }}
                                                    <form action="{{ route('instructor.exam.deleteQuiz', $quiz->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button title="delete"
                                                            onclick="return (confirm('Are you sure want to delete this item??'))"
                                                            type="submit" class="btn btn-danger btn-sm">X</button>
                                                    </form>
                                                    @foreach ($quiz->quizItems as $item)
                                                        <p>{{ $item->item . ' - ' . $item->solution }}</p>
                                                    @endforeach
                                                    <hr>
                                                @endforeach
                                            </td>
                                        @else
                                            <td>No Quiz</td>
                                        @endif
                                        <td>{{ $exam->created_at }}</td>
                                    </tr>
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
