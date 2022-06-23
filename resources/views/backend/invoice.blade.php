@extends('backend.layouts.master')
@section('title', 'Invoice')
@section('cssStyle')
    <script>
        function printContent(el) {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }
    </script>
@endsection

@section('backend')
    <div class="container">
        <div class="card" id="print">
            <div class="card-header">
                Order ID: #{{ $order->id }}, Invoice
                <strong>{{ $order->created_at->format('d/m/Y') }}</strong>
                <span style="float: right;"> <strong>Status:</strong>
                    @if ($order->status == 1)
                        Pending
                    @elseif($order->status == 2)
                        Confirmed
                    @endif
                </span>

            </div>
            <img src="{{ asset($company->logo) }}" height="120" width="350" alt="">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6" style="width: 50%;float:left;">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>{{ config('app.name') }}</strong>
                        </div>
                        <div>{{ $company->address }}</div>
                        <div>Email: {{ $company->email }}</div>
                        <div>Phone: {{ $company->phone_one }}</div>
                    </div>

                    <div class="col-sm-6" style="width: 50%;float:left;">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong>{{ $order->name }}</strong>
                        </div>
                        <div>{{ $order->address }}</div>
                        <div>Email: {{ $order->email }}</div>
                        <div>Phone: {{ $order->phone }}</div>
                    </div>



                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>

                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderProducts as $key => $product)
                                <tr>
                                    <td class="center">{{ ++$key }}</td>
                                    <td class="left strong">{{ $product->prod->name }}</td>

                                    <td class="right">৳{{ $product->unit_price }}</td>
                                    <td class="center">{{ $product->qty }}</td>
                                    <td class="right">
                                        ৳{{ number_format($product->unit_price * $product->qty, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-sm-7">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td>৳{{ number_format($order->total_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>৳{{ number_format($order->subtotal_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>৳{{ number_format($order->price_discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Additional Charge</td>
                                    <td>৳{{ number_format($order->additional_charge, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Coupon Code</td>
                                    <td>{{ $order->coupon_code }}</td>
                                </tr>
                                <tr>
                                    <td>Coupon Discount</td>
                                    <td>৳{{ number_format($order->coupon_discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>PAID AMOUNT</strong>
                                    </td>
                                    <td class="right">
                                        <strong>৳{{ number_format($order->paid_amount, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

                <hr>
                <div class="table-responsive-sm">
                    <h2>Transaction:</h2><br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Payment Type</th>

                                <th class="left">Payment Number</th>
                                <th class="center">Trx Id</th>
                                <th class="right">Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="left strong">{{ $order->payment_type }}</td>

                                <td class="left">{{ $order->payment_number }}</td>
                                <td class="center">{{ $order->trx_id }}</td>
                                <td class="right">
                                    {{ $order->payment_type == 'COD' ? 'Unpaid' : 'Paid' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <button id="print" onclick="printContent('print');" class="btn btn-success btn-sm">Print Invoice</button>
    </div>
@endsection

@section('js')
@endsection
