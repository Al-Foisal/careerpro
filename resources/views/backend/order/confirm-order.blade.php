@extends('backend.layouts.master')
@section('title', 'Confirmed Order List')
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
                    <h1>Confirmed Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Confirmed Order</li>
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
                                @if ($order->status == 2)
                                    <div class="d-flex justify-content-start>">
                                        <form action="{{ route('admin.orderShippedForCustomer', $order->id) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit"
                                                onclick="return(confirm('Are you sure want to Shipped this item?'))"
                                                class="btn btn-success btn-sm"> Shiped Order
                                            </button>
                                        </form>

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
                                                <td>Confirmed</td>
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
