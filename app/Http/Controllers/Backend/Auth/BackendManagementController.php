<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Exports\CourseScheduleExport;
use App\Http\Controllers\Controller;
use App\Imports\CourseScheduleImport;
use App\Models\CourseSchedule;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BackendManagementController extends Controller {

    public function customerList() {
        $customers = User::orderBy('id', 'desc')->paginate(50);

        return view('backend.auth.customer-list', compact('customers'));
    }

    public function instructorList() {
        $instructors = Instructor::orderBy('is_approved', 'asc')->paginate(50);

        return view('backend.auth.instructor-list', compact('instructors'));
    }

    public function activeInstructor(Request $request, Instructor $instructor) {
        $instructor->is_approved = 1;
        $instructor->save();

        $user                = User::find($instructor->user_id);
        $user->is_instructor = 1;
        $user->save();

        return redirect()->back()->withToastSuccess('The instructor activated successfully!!');
    }

    public function inactiveinstructor(Request $request, Instructor $instructor) {
        $instructor->is_approved = 0;
        $instructor->save();

        return redirect()->back()->withToastSuccess('The instructor inactivated successfully!!');
    }

    public function courseScheduleCreate()
    {
        return view('backend.course-schedule-create');
    }

    public function courseScheduleImport() {
        Excel::import(new CourseScheduleImport, request()->file('file'));

        return back()->withToastSuccess('Course schedule uploaded successfully!!');
    }

    public function courseScheduleExport() {
        return Excel::download(new CourseScheduleExport, 'course_schedule.xlsx');
    }
}
