<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstructorLoginController extends Controller {
    public function login() {
        return view('frontend.instructor.auth.login');
    }

    public function storeLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if (Auth::guard('instructor')->attempt(['email' => $request->email, 'password' => $request->password, 'is_approved' => 1])) {
            return redirect()->route('instructor.dashboard');
        }

        return redirect()->route('instructor.login')->withToastError('Invalid Credentitials!!');
    }

    public function logout(Request $request) {
        Auth::guard('instructor')->logout();

        return redirect()
            ->route('instructor.login')
            ->withToastSuccess('Logout Successful!!');
    }

}
