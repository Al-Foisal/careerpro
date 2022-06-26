@extends('frontend.layouts.__user_master')
@section('title', 'Dashboard')

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
                <h2>My Account</h2>
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
            <div class="myAccount-content">
                <div class="myAccount-profile">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5">
                            <div class="profile-image">
                                <img src="{{ asset(auth()->user()->image) }}" alt="image"
                                    style="height: 300px;width:300px;">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="profile-content">
                                <h3>{{ auth()->user()->name }}</h3>
                                <p><b>Your Membership Package: </b>{{ $member_ship_package->name }}</p>
                                <p>{{ auth()->user()->bio }}</p>
                                <ul class="contact-info">
                                    <li>
                                        <i class="bx bx-envelope"></i>
                                        <a href="mailto:{{ auth()->user()->email }}">
                                            <span class="__cf_email__">{{ auth()->user()->email }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <i class="bx bx-phone"></i>
                                        <a href="tel:{{ auth()->user()->phone }}">{{ auth()->user()->phone }}</a>
                                    </li>
                                </ul>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" style="border:none;"
                                    class="myAccount-logout">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Your Orders</h3>
                <div class="recent-orders-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Order Name</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->created_at->format('l m y') }}</td>
                                    <td>৳{{ number_format($order->subtotal, 2) }} for 1 item</td>
                                    <td>
                                        <a href="{{ route('user.orderDetails', $order->id) }}"
                                            class="view-button">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End My Account Area -->
@endsection
