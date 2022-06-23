<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {
    public function cart() {

        // if (Cart::count() == 0) {
        //     return redirect()->back();
        // }

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
        
        // dd(gettype($total),$data['total'],$discount);
        // dd($carts);

        return view('frontend.cart', $data);
    }

    public function addToCart(Request $request) {
        $data         = [];
        $course       = Course::where('id', $request->id)->first();
        $data['id']   = $course->id;
        $data['name'] = $course->name;
        $data['qty']  = 1;

        if ($course->discount_price == null) {
            $data['price'] = $course->price;
        } else {
            $data['price'] = $course->discount_price;
        }

        $data['weight']                    = 1;
        $data['options']['slug']           = $course->slug;
        $data['options']['image']          = $course->thumbnil_image;
        $data['options']['oreginal_price'] = $course->price;

        Cart::add($data);

        return response()->json([
            'status'       => 'success',
            'cart_count'   => Cart::count(),
            'cart_content' => Cart::content(),
        ]);
    }

    public function updateCart(Request $request) {
        $row = [];

        foreach ($request->row_id as $key => $row) {
            $rowId = $row;
            $qty   = $request->quantity[$key];
            Cart::update($rowId, $qty);
        }

        return redirect()->back()->withToastSuccess('Cart updated successfully!!');
    }

    public function removeFromCart($rowId) {
        Cart::remove($rowId);

        return redirect()->route('cart')->withToastSuccess('product remove from cart successfully!!');
    }

    public function destroyCart() {
        Cart::destroy();

        return redirect()->back()->withToastSuccess('Cart destroyed successfully!!');
    }

//coupon

    public function applyCoupon(Request $request) {
        $coupon_code = $request->coupon_code;

        $check = Coupon::where('coupon_code', $coupon_code)->first();

        if (!$check) {
            return redirect()->back()->withToastInfo('No coupon find for this code!!');
        }

        if ($check->coupon_date <= today()) {

            return redirect()->back()->withToastError('Coupon Date Has Been Expaired!!');

        }

        if ($check->coupon_type == 1) {

            Session::put('coupon', [

                'code'     => $check->coupon_code,

                'discount' => ceil((Cart::subtotal() * $check->coupon_discount) / 100),

            ]);

        } else

        if ($check->coupon_type == 2) {

            Session::put('coupon', [

                'code'     => $check->coupon_code,

                'discount' => $check->coupon_discount,

            ]);

        }

        return redirect()->back()->withToastSuccess('Coupon Applied Successfully!!');

    }

    public function removeCoupon() {

        Session::forget('coupon');

        return redirect()->back()->withToastSuccess('Coupon Removed Successfully!!');
    }

}
