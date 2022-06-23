@extends('frontend.layouts.master')
@section('title', 'Checkout')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-style-three item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Shop</li>
                </ul>
                <h2>Checkout</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Checkout Area -->
    <section class="checkout-area ptb-100">
        <div class="container">
            <div class="user-actions">
                <i class='bx bx-log-in'></i>
                <span>Have any coupon? <a href="{{ route('cart') }}">Click here to apply coupn.</a></span>
            </div>

            <form action="{{ route('user.placeOrder') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="billing-details">
                            <h3 class="title">Billing Details</h3>

                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Fullname<span class="text-danger">*</span></label>
                                        <input type="text" name="name" required value="{{ $user->name }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Phone<span class="text-danger">*</span></label>
                                        <input type="text" name="phone" required value="{{ $user->phone }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <input type="text" name="email" required value="{{ $user->email }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Order Notes</label>
                                        <textarea name="notes" id="notes" cols="30" rows="5" placeholder="Order Notes" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="order-details">
                            <h3 class="title">Your Order</h3>

                            <div class="order-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td class="product-name">
                                                    <a
                                                        href="{{ route('courseDetails', $cart->options->slug) }}">{{ $cart->name }}</a>
                                                </td>

                                                <td class="product-total">
                                                    <span
                                                        class="subtotal-amount">৳{{ number_format($cart->price, 2) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach


                                        <input type="hidden" name="total" value="{{ $total }}">
                                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                        <input type="hidden" name="discount" value="{{ $discount }}">
                                        <input type="hidden" name="coupon"
                                            value="{{ Session::get('coupon')['discount'] ?? 0 }}">
                                        <input type="hidden" name="paid_amount" value="{{ $paid_amount }}">


                                        <tr>
                                            <td class="order-subtotal">
                                                <span>Cart Total</span>
                                            </td>

                                            <td class="order-subtotal-price">
                                                <span
                                                    class="order-subtotal-amount">৳{{ number_format($total, 2) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="order-subtotal">
                                                <span>Cart Subtotal</span>
                                            </td>

                                            <td class="order-subtotal-price">
                                                <span
                                                    class="order-subtotal-amount">৳{{ number_format($subtotal, 2) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="order-subtotal">
                                                <span>Cart Discount</span>
                                            </td>

                                            <td class="order-subtotal-price">
                                                <span
                                                    class="order-subtotal-amount">৳{{ number_format($discount, 2) }}</span>
                                            </td>
                                        </tr>
                                        @if (session()->has('coupon'))
                                            <tr>
                                                <td class="order-subtotal">
                                                    <span>Cart Coupon<a title="remove this coupon"
                                                            href="{{ route('removeCoupon') }}"
                                                            class="text-danger">X</a></span>
                                                </td>

                                                <td class="order-subtotal-price">
                                                    <span
                                                        class="order-subtotal-amount">৳{{ number_format(Session::get('coupon')['discount'], 2) }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="order-subtotal">
                                                <span>Amount to Paid</span>
                                            </td>

                                            <td class="order-subtotal-price">
                                                <span
                                                    class="order-subtotal-amount">৳{{ number_format($paid_amount, 2) }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="payment-box">
                                <div class="payment-methods">
                                    <h4 class="">Payment methods</h4>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary mx-2" onclick="bkash()">
                                            <input type="radio" name="payment_type" id="option2" value="Bkash">
                                            <div>
                                                <img src="{{ asset('images/pay_icon/bkash.png') }}">
                                            </div>
                                            Bkash
                                        </label>
                                        <label class="btn btn-secondary mx-2" onclick="rocket()">
                                            <input type="radio" name="payment_type" id="option2" value="Rocket">
                                            <div>
                                                <img src="{{ asset('images/pay_icon/rocket.png') }}">
                                            </div>
                                            Rocket
                                        </label>
                                        <label class="btn btn-secondary" onclick="nagad()">
                                            <input type="radio" name="payment_type" id="option3" value="Nagad">
                                            <div>
                                                <img src="{{ asset('images/pay_icon/nagad.png') }}">
                                            </div>
                                            Nagad
                                        </label>
                                    </div>
                                    <!-- {{-- Bkash Payment --}} -->
                                    <div class="card mt-3 bkash_payment_body ">
                                        <div class="card-body">
                                            <div class="bkash_details ">
                                                <p class="text-center">Follow these steps for bKash payment</p>
                                                <div class="card mb-3">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            01. Go to your bKash Mobile Menu by dialing *247#
                                                        </li>
                                                        <li class="list-group-item">02. Choose “Send Money”</li>
                                                        <li class="list-group-item">03. Enter The bKash Account Number
                                                            01309313258
                                                        </li>
                                                        <li class="list-group-item">04. Enter Your amount Tk</li>
                                                        <li class="list-group-item">05. Enter a reference 1234</li>
                                                        <li class="list-group-item">
                                                            06. Now enter your bKash Mobile Menu PIN to confirm
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Enter Mobile Number</label>
                                                <input type="text" name="payment_number_bkash" class="form-control"
                                                    id="exampleFormControlInput1" placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Transection Id</label>
                                                <input type="text" name="trx_id_bkash" class="form-control"
                                                    id="exampleFormControlInput2" placeholder="Transection Id">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- {{-- Nagad mayment --}} -->
                                    <div class="card mt-3 nagad_payment_body">
                                        <div class="card-body">
                                            <div class="nagad_details ">
                                                <p class="text-center">Follow these steps for Nagad payment</p>
                                                <div class="card mb-3">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            01. Go to your Nagad Mobile Menu by dialing *167#
                                                        </li>
                                                        <li class="list-group-item">02. Choose “Send Money”</li>
                                                        <li class="list-group-item">03. Enter The Nagad Account Number
                                                            0172402994
                                                        </li>
                                                        <li class="list-group-item">04. Enter your amount</li>
                                                        <li class="list-group-item">05. Enter a reference 1234</li>
                                                        <li class="list-group-item">
                                                            06. Now enter your Nagad Mobile Menu PIN to confirm
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Enter Mobile Number</label>
                                                <input type="text" name="payment_number_nagad" class="form-control"
                                                    id="exampleFormControlInput1" placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Transection Id</label>
                                                <input type="text" name="trx_id_nagad" class="form-control"
                                                    id="exampleFormControlInput2" placeholder="Transection Id">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- {{-- Rocket mayment --}} -->
                                    <div class="card mt-3 rocket_payment_body">
                                        <div class="card-body">
                                            <div class="nagad_details ">
                                                <p class="text-center">Follow these steps for Rocket payment</p>
                                                <div class="card mb-3">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            01. Go to your Rocket Mobile Menu by dialing *322#
                                                        </li>
                                                        <li class="list-group-item">02. Choose “Send Money”</li>
                                                        <li class="list-group-item">
                                                            03. Enter The Rocket Account Number 019199712196
                                                        </li>
                                                        <li class="list-group-item">04. Enter your amount</li>
                                                        <li class="list-group-item">05. Enter a reference 1234</li>
                                                        <li class="list-group-item">
                                                            06. Now enter your Rocket Mobile Menu PIN to
                                                            confirm
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Enter Mobile Number</label>
                                                <input type="text" name="payment_number_rocket" class="form-control"
                                                    id="exampleFormControlInput1" placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Transection Id</label>
                                                <input type="text" name="trx_id_rocket" class="form-control"
                                                    id="exampleFormControlInput2" placeholder="Transection Id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="payment-method">
                                    <p>
                                        <input type="radio" id="direct-bank-transfer" name="radio-group" checked>
                                        <label for="direct-bank-transfer">Direct Bank Transfer</label>

                                        Make your payment directly into our bank account. Please use your Order ID as the
                                        payment reference. Your order will not be shipped until the funds have cleared in
                                        our account.
                                    </p>
                                </div>

                                <button type="submit" class="default-btn"><i
                                        class='bx bx-paper-plane icon-arrow before'></i><span class="label">Place
                                        Order</span><i class="bx bx-paper-plane icon-arrow after"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Checkout Area -->
@endsection

@section('js')
    <script>
        $('.bkash_payment_body').hide();
        $('.nagad_payment_body').hide();
        $('.rocket_payment_body').hide();

        function bkash() {
            $('.bkash_payment_body').show();

            $('.nagad_payment_body').hide();
            $('.rocket_payment_body').hide();
        }

        function nagad() {
            $('.nagad_payment_body').show();


            $('.bkash_payment_body').hide();
            $('.rocket_payment_body').hide();
        }

        function cash() {
            $('.nagad_payment_body').hide();
            $('.bkash_payment_body').hide();
            $('.rocket_payment_body').hide();
        }

        function rocket() {

            $('.rocket_payment_body').show();

            $('.nagad_payment_body').hide();
            $('.bkash_payment_body').hide();
        }
    </script>
@endsection
