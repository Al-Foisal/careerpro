@extends('backend.layouts.master')
@section('title', 'Subcategory')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Main Subcategory List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Subcategory</li>
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
                            <a href="{{ route('admin.createSubcategory') }}" class="btn btn-outline-primary">Add Subcategory</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>On_Front</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $subcategory)
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
                                                        @if ($subcategory->status === 1)
                                                            <form
                                                                action="{{ route('admin.inactiveSubcategory', $subcategory) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Subategory</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.activeSubcategory', $subcategory) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Subategory</button>
                                                            </form>
                                                        @endif

                                                        {{-- on&remove front --}}
                                                        @if ($subcategory->on_front === 1)
                                                            <form
                                                                action="{{ route('admin.removeOnFrontSubcategory', $subcategory) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Remove Front
                                                                    Menu</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.onFrontSubcategory', $subcategory) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Show Front
                                                                    Menu</button>
                                                            </form>
                                                        @endif


                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.editSubcategory', $subcategory) }}">Edit
                                                            Subategory</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $subcategory->name }}</td>
                                            <td>{{ $subcategory->category->name }}</td>
                                            <td>{{ $subcategory->status === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $subcategory->on_front === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $subcategory->created_at }}</td>
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