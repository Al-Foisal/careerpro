<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller {
    public function checkout() {
        $data          = [];
        $data['user']  = Auth::user();
        $data['carts'] = $carts = Cart::content();

        $total = 0;

        //calculating total price without discount and additional charge
        foreach ($carts as $charge) {
            $total += $charge->options->oreginal_price;
        }

        $data['total']       = $total;
        $data['subtotal']    = $subtotal    = Cart::subtotal();
        $data['discount']    = $discount    = $total - $subtotal;
        $data['paid_amount'] = ($subtotal);
        Session::put(['paid_amount' => $data['paid_amount']]);

        if (session()->has('coupon')) {

            // $data['subtotal'] = $subtotal - Session::get('coupon')['discount'];

            $data['paid_amount'] = ($subtotal) - (Session::get('coupon')['discount']);

            Session::put(['paid_amount' => $data['paid_amount']]);

        }

        return view('frontend.checkout', $data);
    }

}
