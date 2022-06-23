@extends('frontend.layouts.master')
@section('title', 'Cart')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-style-three item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Shop</li>
                </ul>
                <h2>Cart</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start Cart Area -->
    <section class="cart-area ptb-100">
        <div class="container">
            <div class="cart-table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="{{ route('courseDetails', $cart->options->slug) }}">
                                        <img src="{{ $cart->options->image }}" alt="item">
                                    </a>
                                </td>
                                <td class="product-name">
                                    <a href="{{ route('courseDetails', $cart->options->slug) }}">{{ $cart->name }}</a>
                                </td>
                                <td class="product-price">
                                    <span class="unit-amount">৳{{ number_format($cart->price, 2) }}</span>
                                </td>
                                <td class="product-price">
                                    <span class="unit-amount">1</span>
                                </td>
                                <td class="product-subtotal">
                                    <span class="subtotal-amount">৳{{ number_format($cart->price, 2) }}</span>
                                    <a href="{{ route('removeFromCart', $cart->rowId) }}" class="remove">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="cart-buttons">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-sm-7 col-md-7">
                        @if (session()->has('coupon'))
                        @else
                            <form action="{{ route('applyCoupon') }}" method="post">
                                @csrf
                                <div class="shopping-coupon-code">
                                    <input type="text" class="form-control" placeholder="Coupon code" name="coupon_code">
                                    <button type="submit">Apply Coupon</button>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="col-lg-5 col-sm-5 col-md-5 text-right">
                        <a href="{{ route('destroyCart') }}" class="default-btn">
                            <i class="bx bx-cart icon-arrow before"></i>
                            <span class="label">Destroy Cart</span>
                            <i class="bx bx-cart icon-arrow after"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cart-totals">
                <h3>Cart Totals</h3>
                <ul>
                    <li>Total
                        <span>৳{{ number_format($total, 2) }}</span>
                    </li>
                    <li>Subtotal
                        <span>৳{{ number_format($subtotal) }}</span>
                    </li>
                    <li>Discount
                        <span>৳{{ number_format($discount, 2) }}</span>
                    </li>
                    @if (session()->has('coupon'))
                        <li>
                            Coupon<a title="remove this coupon" href="{{ route('removeCoupon') }}"
                                class="text-danger">X</a>
                            <span>৳{{ number_format(Session::get('coupon')['discount'], 2) }}</span>
                        </li>
                    @endif
                    <li>Amount to Paid
                        <span>৳{{ number_format($paid_amount, 2) }}</span>
                    </li>

                </ul>
                <a href="{{ route('user.checkout') }}" class="default-btn">
                    <i class="bx bx-shopping-bag icon-arrow before"></i>
                    <span class="label">Proceed to Checkout</span>
                    <i class="bx bx-shopping-bag icon-arrow after"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- End Cart Area -->
@endsection
