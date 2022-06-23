<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Quiz;
use App\Models\QuizItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller {

    public function index() {
        $exams = Exam::with('course')->where('instructor_id', auth()->guard('instructor')->user()->id)->get();

        return view('frontend.instructor.exam.index', compact('exams'));
    }

    public function create() {
        $courses = Course::where('instructor_id', auth()->guard('instructor')->user()->id)->get();

        return view('frontend.instructor.exam.create', compact('courses'));
    }

    public function store(Request $request) {
        Exam::create([
            'course_id'     => $request->course_id,
            'instructor_id' => auth()->guard('instructor')->user()->id,
            'name'          => $request->name,
            'timer'         => $request->timer,
        ]);

        return redirect()->route('instructor.exam.index')->withToastSuccess('Exam added successfully!!');
    }

    public function show($slug) {
        $exam = Exam::where('slug', $slug)->with('quizzes', 'quizzes.quizItems')->first();

        return view('frontend.instructor.exam.show', compact('exam'));
    }

    public function edit($slug) {
        $exam    = Exam::where('slug', $slug)->first();
        $courses = Course::where('instructor_id', auth()->guard('instructor')->user()->id)->get();

        return view('frontend.instructor.exam.edit', compact('courses', 'exam'));
    }

    public function update(Request $request, $id) {
        $exam = Exam::findOrFail($id);
        $exam->update([
            'course_id' => $request->course_id,
            'name'      => $request->name,
            'timer'     => $request->timer,
        ]);

        return redirect()->route('instructor.exam.index')->withToastSuccess('Exam updated successfully!!');
    }

    public function delete($id) {
        $exam = Exam::findOrFail($id)->delete();

        return redirect()->route('instructor.exam.index')->withToastSuccess('Exam updated successfully!!');
    }

    //quiz
    public function createQuiz($id) {

        $exam = Exam::where('instructor_id', auth()->guard('instructor')->user()->id)->where('id', $id)->first();

        if (!$exam) {
            return redirect()->back()->withToastSuccess('Undefined credentisial');
        }

        return view('frontend.instructor.exam.create-quiz', compact('exam'));
    }

    public function storeQuiz(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'item'       => 'required',
            'item.*'     => 'required',
            'solution'   => 'required',
            'solution.*' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $count = 0;

        foreach ($request->item as $key => $f) {

            if ($request->solution[$key] == 1) {
                ++$count;
            }

        }

        if ($count > 1) {
            return redirect()->back()->withToastError('More than one currect answer given!');
        } else

        if ($count == 0) {
            return redirect()->back()->withToastError('No currect answer given!');
        }

        $quiz = Quiz::create([
            'exam_id' => $request->exam_id,
            'name'    => $request->name,
        ]);

        foreach ($request->item as $key => $f) {
            QuizItem::create(['quiz_id' => $quiz->id, 'item' => $f, 'solution' => $request->solution[$key]]);
        }

        $exam=Exam::find($quiz->exam_id);
        return redirect()->route('instructor.exam.show', $exam->slug)->withToastSuccess('Quiz item added successfully!!');
    }

    public function deleteQuiz($id) {
        Quiz::findOrFail($id)->delete();

        return redirect()->back()->withToastSuccess('Quiz with quiz items deleted successfully!!');
    }

}
