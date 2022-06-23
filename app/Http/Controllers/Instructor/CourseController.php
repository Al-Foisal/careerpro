<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller {
    public function courses() {
        $courses = Course::where('instructor_id', auth()->guard('instructor')->user()->id)->get();

        return view('frontend.instructor.courses.index', compact('courses'));
    }

    public function create() {
        return view('frontend.instructor.courses.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|unique:courses',
            'details'            => 'required',
            'price'              => 'required',
            'duration'           => 'required',
            'source_link'        => 'required',
            'provider_name'      => 'required',
            'lesson'             => 'required',
            'language'           => 'required',
            'provider_signature' => 'required|image|mimes:jpeg,png,jpg,gif',
            'thumbnil_image'     => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'provider_logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('thumbnil_image')) {

            $image_file = $request->file('thumbnil_image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('provider_logo')) {

            $image_file = $request->file('provider_logo');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name      = $img_gen . '.' . $image_ext;
                $provider_logo = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('provider_signature')) {

            $image_file = $request->file('provider_signature');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name           = $img_gen . '.' . $image_ext;
                $provider_signature = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Course::create([
            'instructor_id'      => auth()->guard('instructor')->user()->id,
            'admin_id'           => 0,
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id,
            'name'               => $request->name,
            'details'            => $request->details,
            'audience'           => $request->audience,
            'prerequisite'       => $request->prerequisite,
            'why_this_course'    => $request->why_this_course,
            'learning_outcomes'  => $request->learning_outcomes,
            'duration'           => $request->duration,
            'source_link'        => $request->source_link,
            'sample_video_link'  => $request->sample_video_link,
            'thumbnil_image'     => $thumbnil_image,
            'price'              => $request->price,
            'lesson'             => $request->lesson,
            'discount_price'     => $request->discount_price,
            'language'           => $request->language,
            'provider_logo'      => $provider_logo,
            'provider_name'      => $request->provider_name,
            'provider_signature' => $provider_signature,
            'provider_signature' => $provider_signature,
            'status'             => 1,
        ]);

        return redirect()->route('instructor.courses')->withToastSuccess('Your courses submitted successfully wait for approve!!');
    }

    public function edit(Request $request, $slug) {
        $categories = Category::where('status', 1)->get();
        $course     = Course::where('slug', $slug)->first();

        return view('frontend.instructor.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $slug) {
        $course    = Course::where('slug', $slug)->first();
        $validator = Validator::make($request->all(), [
            'name'               => 'required|unique:courses,name,' . $course->id,

            'details'            => 'required',
            'price'              => 'required',
            'duration'           => 'required',
            'source_link'        => 'required',
            'provider_name'      => 'required',
            'lesson'             => 'required',
            'language'           => 'required',
            'provider_signature' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'thumbnil_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'provider_logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('thumbnil_image')) {

            $image_file = $request->file('thumbnil_image');

            if ($image_file) {

                if ($course->thumbnil_image) {
                    $thumbnil_image_image_path = public_path($course->thumbnil_image);

                    if (File::exists($thumbnil_image_image_path)) {
                        File::delete($thumbnil_image_image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $course->update(['thumbnil_image' => $thumbnil_image]);
            }

        }

        if ($request->hasFile('provider_logo')) {

            $image_file = $request->file('provider_logo');

            if ($image_file) {

                if ($course->provider_logo) {
                    $provider_logo_image_path = public_path($course->provider_logo);

                    if (File::exists($provider_logo_image_path)) {
                        File::delete($provider_logo_image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name      = $img_gen . '.' . $image_ext;
                $provider_logo = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $course->update(['provider_logo' => $provider_logo]);
            }

        }

        if ($request->hasFile('provider_signature')) {

            $image_file = $request->file('provider_signature');

            if ($image_file) {

                if ($course->provider_signature) {
                    $provider_signature_image_path = public_path($course->provider_signature);

                    if (File::exists($provider_signature_image_path)) {
                        File::delete($provider_signature_image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name           = $img_gen . '.' . $image_ext;
                $provider_signature = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $course->update(['provider_signature' => $provider_signature]);
            }

        }

        $course->update([
            'instructor_id'     => auth()->guard('instructor')->user()->id,
            'admin_id'          => 0,
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'name'              => $request->name,
            'details'           => $request->details,
            'audience'          => $request->audience,
            'prerequisite'      => $request->prerequisite,
            'why_this_course'   => $request->why_this_course,
            'learning_outcomes' => $request->learning_outcomes,
            'duration'          => $request->duration,
            'source_link'       => $request->source_link,
            'sample_video_link' => $request->sample_video_link,
            'price'             => $request->price,
            'lesson'            => $request->lesson,
            'discount_price'    => $request->discount_price,
            'provider_name'     => $request->provider_name,
            'language'          => $request->language,
            'status'            => 1,
        ]);

        return redirect()->back()->withToastSuccess('Your courses updated successfully!!');
    }

    public function active(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 1;
        $course->save();

        return redirect()->route('instructor.courses')->withToastSuccess('Course activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 0;
        $course->save();

        return redirect()->route('instructor.courses')->withToastSuccess('Course inactivated successfully!!');
    }

    public function delete(Request $request, $id) {
        $course = Course::find($id);

        if ($course->thumbnil_image) {
            $thumbnil_image_image_path = public_path($course->thumbnil_image);

            if (File::exists($thumbnil_image_image_path)) {
                File::delete($thumbnil_image_image_path);
            }

        }

        if ($course->provider_logo) {
            $provider_logo_image_path = public_path($course->provider_logo);

            if (File::exists($provider_logo_image_path)) {
                File::delete($provider_logo_image_path);
            }

        }

        if ($course->provider_signature) {
            $provider_signature_image_path = public_path($course->provider_signature);

            if (File::exists($provider_signature_image_path)) {
                File::delete($provider_signature_image_path);
            }

        }

        $course->delete();

        return redirect()->back()->withToastSuccess('Course deleted successfully!!');
    }

    public function assignment($slug) {
        $course = Course::where('slug', $slug)->first();

        return view('frontend.instructor.courses.assignment', compact('course'));
    }

    public function assignmentStore(Request $request, $slug) {
        $course    = Course::where('slug', $slug)->first();
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
                $image_url = 'images/assignment/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name          = $img_gen . '.' . $image_ext;
                $course_assignment = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        // dd($course_assignment);
        CourseAssignment::updateOrCreate(
            ['course_id' => $course->id],
            [
                'assignment_name' => $request->assignment_name,
                'assignment'      => $course_assignment,
                'course_id'       => $course->id,
            ]);

        return redirect()->back()->withToastSuccess('Your courses assignment submitted successfully!!');
    }

    public function submittedAssesment() {
        $assesment = Assesment::where('submitted', 1)->get();

        return view('frontend.instructor.courses.submitted-assesment', compact('assesment'));
    }

    public function unsubmittedAssesment() {
        $assesment = Assesment::where('submitted', 0)->get();

        return view('frontend.instructor.courses.unsubmitted-assesment', compact('assesment'));
    }

    public function submitAssesment(Request $request, $id) {
        $assesment = Assesment::findOrFail($id);

        $assesment->update([
            'assesment' => $request->assesment,
            'remarks'   => $request->remarks,
            'submitted' => 1,
        ]);

        return redirect()->back()->withToastSuccess('Assignment assest successfully!!');

    }

}
