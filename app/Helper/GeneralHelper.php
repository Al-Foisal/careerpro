<?php

use App\Models\Admin;
use App\Models\Assesment;
use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\Exam;
use App\Models\Instructor;
use App\Models\Order;
use App\Models\OrderCourse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function getCourseNameById($id) {
    $name = Course::find($id)->name;

    return $name;
}

function getInstructorById($id) {
    $instructor = Instructor::findOrFail($id);

    return $instructor;
}

function getUserById($id) {
    $user = User::findOrFail($id);

    return $user;
}

function getAdminById($id) {
    $admin = Admin::findOrFail($id);

    return $admin;
}

function getCourseById($id) {
    $course = Course::findOrFail($id);

    return $course;
}

function getAssignmentByCourseId($id) {
    $assignment = CourseAssignment::where('course_id', $id)->first();

    if ($assignment) {
        return $assignment;
    } else {
        return $assignment = null;
    }

}

function checkAssesment($assignment, $user, $course) {
    $assesment = Assesment::where([
        'course_assignment_id' => $assignment,
        'user_id'              => $user,
        'course_id'            => $course,
    ])->first();

    return $assesment;
}

function getExamByUserId($user_id) {
    $order   = Order::where('user_id', $user_id)->pluck('id')->toArray();
    $courses = OrderCourse::whereIn('order_id', $order)->pluck('course_id');
    $exams   = Exam::whereIn('course_id', $courses)->with('quizzes', 'quizzes.quizItems')->get();

    return $exams;
}

function getStudentByCourseId($course_id) {
    $student = OrderCourse::where('course_id', $course_id)->count();

    return $student;
}

function checkQuizByCourseId($course_id) {
    $course = Exam::where('course_id', $course_id)->first();

    return $course;
}

function checkAssignmentByCourseId($course_id) {
    $course = Exam::where('course_id', $course_id)->first();

    return $course;
}

function getActiveCourseByInstructorId($instructor_id) {
    $course = Course::where('instructor_id', $instructor_id)->where('is_approved', 1)->count();

    return $course;
}

function getInactiveCourseByInstructorId($instructor_id) {
    $course = Course::where('instructor_id', $instructor_id)->where('is_approved', 0)->count();

    return $course;
}

// function CheckCourseEnrolledByCourseId($course_id) {

//     if (Auth::id()) {

//         $orders = Order::where('user_id', Auth::id())->get();

//         foreach ($orders as $order) {

//             $course = OrderCourse::where('order_id', $order->id)->where('course_id', $course_id)->first();

//             if ($course) {

//                 return true;

//             }

//         }

//     } else {

//         return false;

//     }

// }
