<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller {
    public function edit() {
        $user = User::find(Auth::id());

        return view('frontend.user.profile-edit', compact('user'));
    }

    public function update(Request $request, $id) {
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

        $user->update([
            'name'  => $request->name,
            'phone' => $request->phone,
            'bio'   => $request->bio,
        ]);

        return redirect()->back()->withToastSuccess('Profile Updated Successfully!!');
    }

}
