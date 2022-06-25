@extends('frontend.layouts.__user_master')
@section('title', 'Order Details')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>My Account</li>
                </ul>
                <h2>My Order details</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start My Account Area -->
    <section class="my-account-area ptb-100">
        <div class="container">
            <div class="myAccount-navigation" style="text-align: center;">
                @include('frontend.layouts.partials._user_dashboard_menu')
            </div>

            <div class="container">
                <div class="pricing-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col-3">Order</th>
                                <th scope="col-9">Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <td>Notes</td>
                                <td>{{ $order->notes }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>৳{{ number_format($order->total, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Subtotal</td>
                                <td>৳{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            @if ($order->discount_price)
                                <tr>
                                    <td>Discount</td>
                                    <td>৳{{ number_format($order->discount_price, 2) }}</td>
                                </tr>
                            @endif
                            @if ($order->coupon)
                                <tr>
                                    <td>Coupon</td>
                                    <td>৳{{ number_format($order->coupon, 2) }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Paid Amount</td>
                                <td>৳{{ number_format($order->paid_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Paymeny Type</td>
                                <td>{{ $order->payment_type }}</td>
                            </tr>
                            <tr>
                                <td>Payment Number</td>
                                <td>{{ $order->payment_number }}</td>
                            </tr>
                            <tr>
                                <td>Transaction ID</td>
                                <td>{{ $order->trx_id }}</td>
                            </tr>
                            <tr>
                                <td>Enroll At</td>
                                <td>{{ $order->created_at->format('l m Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h3>Courses under this order</h3>
                    <div class="recent-orders-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Resource Person</th>
                                    <th>Course Name</th>
                                    <th>Unit Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->courses as $course)
                                    <tr>
                                        <td>{{ getInstructorById($course->singleCourse->instructor_id)->name }}</td>
                                        <td>{{ getCourseNameById($course->course_id) }}</td>
                                        <td>৳{{ number_format($course->unit_price, 2) }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End My Account Area -->
@endsection
