<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;

class InstructorDashboardController extends Controller {
    public function dashboard() {
        $id              = auth()->guard('instructor')->user()->id;
        $data            = [];
        $data['courses'] = Course::where('instructor_id', $id)->get();

        return view('frontend.instructor.dashboard', $data);
    }
}
