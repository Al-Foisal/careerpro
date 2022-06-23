<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstructorRegisterController extends Controller {
    public function register() {
        $is_instructor = auth()->user()->is_instructor ?? null;

        return view('frontend.instructor.auth.register', compact('is_instructor'));
    }

    public function storeRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'phone'   => 'required',
            'email'   => 'required|email|unique:instructors,email',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        Instructor::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'message'     => $request->message,
            'is_approved' => 0,
            'user_id'     => Auth::id() ?? 1,
        ]);

        $user                = User::find(1);
        $user->is_instructor = 0;
        $user->save();

        return redirect()->back()->withToastSuccess('Your request submitted successfully!!');
    }

    public function profile() {
        $profile = Instructor::findOrFail(auth()->guard('instructor')->user()->id);

        return view('frontend.instructor.profile', compact('profile'));
    }

    public function profileUpdate(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'phone'   => 'required',
            'message' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $profile = Instructor::find($id);

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/instructor/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $profile->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $profile->update([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'message'     => $request->message,
            'details'     => $request->details,
            'designation' => $request->designation,
        ]);

        return redirect()->back()->withToastSuccess('Profile Updated successfully!!');

    }

}
