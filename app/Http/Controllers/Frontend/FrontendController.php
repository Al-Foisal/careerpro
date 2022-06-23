<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Help;
use App\Models\FAQ;
use App\Models\Job;
use App\Models\Page;
use App\Models\Slider;
use App\Models\JobApplication;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller {
    public function index() {
        $data                     = [];
        $data['slider']           = Slider::all();
        $data['activeCategories'] = DB::table('categories')
            ->where('categories.status', 1)
            ->where('categories.on_front_page', 1)
            ->get();

        return view('frontend.index', $data);
    }

    public function categoryCourses($category, $sub = null) {
        $data             = [];
        $data['category'] = $category = Category::where('slug', $category)->where('status', 1)->first();
        $courses          = Course::where('category_id', $category->id);

        if ($sub != null) {
            $data['subcategory'] = $subcategory = Subcategory::where('slug', $sub)->where('status', 1)->first();
            $courses             = $courses->where('subcategory_id', $subcategory->id);
        }

        $order = request()->order;

        if ($order) {

            if ($order === 'default') {
                $courses = $courses;
            } else

            if ($order === 'alpha') {
                $courses = $courses->OrderBy('name', 'asc');
            }

        }

        $data['courses'] = $courses->where('status', 1)->where('is_approved', 1)->select(['id', 'name', 'slug', 'discount_price', 'price', 'lesson', 'thumbnil_image', 'instructor_id'])->with('instructor')->paginate(20);

        $data['sub'] = $sub;

        return view('frontend.category-courses', $data);
    }

    public function courseDetails($slug) {
        $data           = [];
        $data['course'] = $course = Course::where('slug', $slug)->first();

        if ($course->subcategory_id !== null) {
            $data['related_courses'] = Course::where('category_id', $course->category_id)->where('subcategory_id', $course->subcategory_id)->where('status', 1)->where('is_approved', 1)->orderBy('id', 'desc')->limit(3)->get();
        } else {
            $data['related_courses'] = Course::where('category_id', $course->category_id)->where('status', 1)->where('is_approved', 1)->orderBy('id', 'desc')->limit(3)->get();
        }

        return view('frontend.course-details', $data);
    }

    public function search(Request $request) {

        $data            = [];
        $data['search']  = $search  = $request->input('search');
        $data['courses'] = Course::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->get();
        $data['jobs'] = Job::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->get();
        $data['blogs'] = Blog::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->get();

        return view('frontend.search', $data);
    }

    public function job() {
        $jobs = DB::table('jobs')
            ->where('dead_line', '>', today())
            ->where('status', 1)
            ->paginate(10);
        $latest_courses = Course::where('status', 1)->where('is_approved', 1)->orderBy('id', 'desc')->limit(7)->get();

        return view('frontend.job', compact('jobs', 'latest_courses'));
    }

    public function jobDetails($id) {
        $job = Job::findOrFail($id);

        return view('frontend.job-details', compact('job'));
    }

    public function storeApplication(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cv' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $job = Job::findOrFail($id);

        if ($request->hasFile('cv')) {

            $image_file = $request->file('cv');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/cv/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_iamge = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        JobApplication::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'cv'     => $final_iamge,
            'job_id' => $job->id,
        ]);

        return redirect()->back()->withToastSuccess('Application Submitted!!');



    }

    public function instructor()
    {
        $instructors = Instructor::where('is_approved',1)->get();

        return view('frontend.instructor',compact('instructors'));
    }

    public function instructorDetails($id)
    {
        $instructor = Instructor::findOrFail($id);

        return view('frontend.instructor-details',compact('instructor'));
    }
    
    public function blog(){
        $blogs = Blog::with('instructor')->orderBy('id', 'DESC')->paginate(20);
        
        return view('frontend.blog',compact('blogs'));
    }
    
    public function blogDetails($slug){
        $blog=Blog::where('slug',$slug)->with('instructor')->first();
        
        return view('frontend.blog-details',compact('blog'));
    }

    public function faq(){
        $faqs = FAQ::all();
        return view('frontend.faq',compact('faqs'));
    }

    public function help(){
        $helps = Help::all();
        return view('frontend.help',compact('helps'));
    }

    public function offer(){
        $courses = Course::where([
            'status'=>1,
            'is_approved'=>1,
            ])->whereNotNull('discount_price')->paginate(20);
            
        return view('frontend.offer',compact('courses'));
    }
    
    public function contact(){
        return view('frontend.contact');
    }
    
    public function storeContact(Request $request){
        Contact::create($request->all());
        return redirect()->back()->withToastSuccess('Contact store successfully!!');
    }
    
    public function page($slug) {
        $page = Page::where('slug', $slug)->first();

        return view('frontend.page', compact('page'));
    }



}
