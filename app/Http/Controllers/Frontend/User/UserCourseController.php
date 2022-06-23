<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use App\Models\Exam;
use App\Models\Order;
use App\Models\OrderCourse;
use App\Models\Quiz;
use App\Models\QuizItem;
use App\Models\Result;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserCourseController extends Controller {
    public function courses() {
        $orders = Order::where('user_id', Auth::id())->with('courses')->get();

        return view('frontend.user.courses', compact('orders'));
    }

    public function assignment() {
        $orders = Order::where('user_id', Auth::id())->with('courses')->get();

        return view('frontend.user.assignment', compact('orders'));
    }

    public function storeAssignment(Request $request) {
        $validator = Validator::make($request->all(), [
            'assignment' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('assignment')) {

            $image_file = $request->file('assignment');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/submit_assignment/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name          = $img_gen . '.' . $image_ext;
                $submit_assignment = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Assesment::create([
            'course_assignment_id' => $request->course_assignment_id,
            'user_id'              => $request->user_id,
            'course_id'            => $request->course_id,
            'assignment'           => $submit_assignment,
        ]);

        return redirect()->back()->withToastSuccess('Your assignment submitted successfully!!');
    }

    public function exam() {
        $exams = getExamByUserId(Auth::id());

        return view('frontend.user.exam', compact('exams'));
    }

    public function examFlow($slug) {
        $exam = Exam::where('slug', $slug)->with('quizzes', 'quizzes.quizItems')->first();

        return view('frontend.user.exam-flow', compact('exam'));
    }

    public function storeExamFlow(Request $request) {

        $exam     = Exam::where('id', $request->exam_id)->with('quizzes', 'quizzes.quizItems')->first();
        $question = Quiz::where('exam_id', $request->exam_id)->pluck('id')->toArray();
        $answer   = QuizItem::whereIn('quiz_id', $question)->where('solution', 1)->pluck('id')->toArray();

        $given_answer = [];

        foreach ($exam->quizzes as $key => $quiz) {

            $given_answer[] = $request->answer[$key];
        }

        $countCorrect        = count($answer);
        $count_given_correct = count(array_intersect($given_answer, $answer));

        $point = (101 / $countCorrect) * $count_given_correct;

        if ($point > 100) {
            $point = 100;
        } else {
            $point = (int) floor($point);
        }

        if ($point > 50) {
            $status = 'Pass';
        } else {
            $status = 'Failed';
        }

        $result          = new Result();
        $result->user_id = Auth::id();
        $result->exam_id = $exam->id;
        $result->point   = $point;
        $result->status  = $status;
        $result->save();

        return redirect()->route('user.courses.result')->withToastSuccess('Your result');
    }

    public function result() {
        $results = Result::where('user_id', Auth::id())->get();

        return view('frontend.user.result', compact('results'));
    }

    public function certificate(Request $request) {
        $order           = Order::where('user_id', Auth::id())->pluck('id')->toArray();
        $courses         = OrderCourse::whereIn('order_id', $order)->pluck('course_id')->toArray();
        $given_answer    = [];
        $given_answer[0] = $request->course_id;
        $check           = array_intersect($given_answer, $courses);

        if (!$check) {
            return redirect()->back()->withToastError('Something went wrong!!');
        }

        $data=[];
        $data['course']=$course = getCourseById($request->course_id);
        $pdf    = PDf::loadView('frontend.user.cirtificate', $data);

        return $pdf->download('certificate.pdf');

        return view('frontend.user.cirtificate', compact('course'));
    }

}
