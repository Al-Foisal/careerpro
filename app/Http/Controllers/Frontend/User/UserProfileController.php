<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\MemberShipPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller {
    public function edit() {
        $user    = User::find(Auth::id());
        $package = MemberShipPackage::all();

        return view('frontend.user.profile-edit', compact('user', 'package'));
    }

    public function update(Request $request, $id) {
        // dd($request->member_ship_package_id);
        $user = User::find($id);

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $user->update([
                    'image' => $final_name1,
                ]
                );
            }

        }

        $user->name                   = $request->name;
        $user->phone                  = $request->phone;
        $user->member_ship_package_id = $request->member_ship_package_id;
        $user->bio                    = $request->bio;
        $user->save();

        return redirect()->back()->withToastSuccess('Profile Updated Successfully!!');
    }

}
