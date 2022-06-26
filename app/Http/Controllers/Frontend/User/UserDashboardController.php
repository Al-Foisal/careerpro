<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\MemberShipPackage;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller {
    public function dashboard() {
        $data           = [];
        $data['member_ship_package']   = MemberShipPackage::find(Auth::user()->member_ship_package_id)??'NO MEMBERSHIP';
        $data['orders'] = Order::where('user_id', Auth::id())->get();

        return view('frontend.user.dashboard', $data);
    }

    public function orderDetails($id) {
        $order = Order::with('courses', 'courses.singleCourse')->where('id', $id)->first();

        return view('frontend.user.order-details', compact('order'));
    }
}
