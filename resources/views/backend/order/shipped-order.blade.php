@extends('backend.layouts.master')
@section('title', 'Shipped Order List')
@section('cssLink')
@endsection
@section('cssStyle')
@endsection

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipped Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shipped Order</li>
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

                            @foreach ($orders as $order)
                                <h4>Order: #{{ $order->id }} || Total Price: ৳{{ $order->total_price }} || Date:
                                    {{ $order->created_at }}</h4>
                                @if ($order->status === 3)
                                    <div class="d-flex justify-content-start>">
                                        <a href="{{ route('admin.invoice', $order->id) }}" class="btn btn-info btn-sm">
                                            Invoice </a>
                                    </div>
                                @endif
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Product Name</th>
                                            <th>Product Quantity</th>
                                            <th>Product Unit Price</th>
                                            <th>Status</th>
                                            <th>Created_at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderProducts as $key => $product)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $product->prod->name }}</td>
                                                <td>{{ $product->qty }}</td>
                                                <td>{{ $product->unit_price }}</td>
                                                <td>Pending</td>
                                                <td>{{ $product->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <hr>
                                <br>
                            @endforeach
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

@section('jsLink')
@endsection
@section('jsScript')
@endsection
