<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Mail\InstructorResetPasswordLink;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InstructorForgotPasswordController extends Controller {
    public function forgotPassword() {
        return view('frontend.instructor.auth.forgot-password');
    }

    public function storeForgotPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $instructor = Instructor::where('email', $request->email)->first();

        if (!$instructor) {
            return redirect()->back()->withToastError('This email is no longer with our records!!');
        }

        $url = route('instructor.resetPassword', [$request->_token, 'email' => $request->email]);

        Mail::to($request->email)->send(new InstructorResetPasswordLink($url));

        DB::table('password_resets')->insert([
            'token'      => $request->_token,
            'email'      => $request->email,
            'created_at' => now(),
        ]);

        return redirect()->back()->withToastSuccess('We have sent a fresh reset password link!!');
    }

}
