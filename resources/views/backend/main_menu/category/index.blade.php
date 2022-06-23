@extends('backend.layouts.master')
@section('title', 'Category')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Main Category List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
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
                            <a href="{{ route('admin.createCategory') }}" class="btn btn-outline-primary">Add Category</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Banner</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>On_Front</th>
                                        <th>On_Front_Page</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- active&inactive --}}
                                                        @if ($category->status === 1)
                                                            <form
                                                                action="{{ route('admin.inactiveCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Category</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.activeCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Category</button>
                                                            </form>
                                                        @endif

                                                        {{-- on&remove front --}}
                                                        @if ($category->on_front === 1)
                                                            <form
                                                                action="{{ route('admin.removeOnFrontCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Remove Front
                                                                    Menu</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.onFrontCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Show Front
                                                                    Menu</button>
                                                            </form>
                                                        @endif

                                                        {{-- on&remove front page --}}
                                                        @if ($category->on_front_page === 1)
                                                            <form
                                                                action="{{ route('admin.removeOnFrontPageCourseCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Remove Front
                                                                    Page Courses Category</button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('admin.onFrontPageCourseCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Show Front
                                                                    Page Courses Category</button>
                                                            </form>
                                                        @endif


                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.editCategory', $category) }}">Edit
                                                            Category</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><img src="{{ asset($category->image) }}"
                                                    style="height:100px;width:150px;"></td>
                                            <td>{{ $category->name }} <br> Sub={{ $category->subcategories_count }}
                                            </td>
                                            <td>{{ $category->status === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $category->on_front === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $category->on_front_page === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $category->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
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
