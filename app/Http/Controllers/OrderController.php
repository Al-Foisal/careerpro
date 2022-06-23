<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCourse;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller {
    public function placeOrder(Request $request) {
        $carts = Cart::content();

        if ($request->payment_number_bkash !== null && $request->trx_id_bkash !== null) {
            $payment_type   = $request->payment_type;
            $payment_number = $request->payment_number_bkash;
            $trx_id         = $request->trx_id_bkash;
        } elseif ($request->payment_number_rocket !== null && $request->trx_id_rocket !== null) {
            $payment_type   = $request->payment_type;
            $payment_number = $request->payment_number_rocket;
            $trx_id         = $request->trx_id_rocket;
        } elseif ($request->payment_number_nagad !== null && $request->trx_id_nagad !== null) {
            $payment_type   = $request->payment_type;
            $payment_number = $request->payment_number_nagad;
            $trx_id         = $request->trx_id_nagad;
        }

        $order = Order::create([
            'user_id'        => Auth::id(),
            'total'          => $request->total,
            'subtotal'       => $request->subtotal,
            'discount'       => $request->discount,
            'coupon'         => $request->coupon,
            'paid_amount'    => $request->paid_amount,

            'payment_type'   => $payment_type??'',
            'payment_number' => $payment_number??'',
            'trx_id'         => $trx_id??'',

            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'notes'          => $request->notes,
        ]);

        foreach ($carts as $cart) {
            OrderCourse::create([
                'order_id'   => $order->id,
                'course_id'  => $cart->id,
                'unit_price' => $cart->price,
            ]);

        }

        Cart::destroy();
        Session::forget('coupon');
        Session::forget('paid_amount');

        return redirect()->route('home')->withToastSuccess('Your order has been placed successfully!!');
    }

}
