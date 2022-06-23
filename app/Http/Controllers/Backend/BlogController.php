<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(20);

        return view('backend.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data                = [];
        $data['instructors'] = Instructor::where('is_approved', 1)->get();

        return view('backend.blog.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'name'    => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/blog/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);

            }

        }

        $blog = Blog::create([
            'image'         => $final_name1,
            'name'          => $request->name,
            'instructor_id' => $request->instructor_id,
            'details'       => $request->details,
        ]);

        return redirect()->back()->withToastSuccess('New Blog Added Successfully!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog) {
        $instructors = Instructor::where('is_approved', 1)->get();

        return view('backend.blog.edit', compact('blog', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog) {
        $validator = Validator::make($request->all(), [
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'name'    => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {
                if ($blog->image) {
                    $image_path = public_path($blog->image);

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/blog/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $blog->update([
                    'image' => $final_name1,
                ]);

            }

        }

        $blog->update([
            'name'          => $request->name,
            'instructor_id' => $request->instructor_id,
            'details'       => $request->details,
        ]);

        return redirect()->route('admin.blogs.index')->withToastSuccess('Blog Updated Successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog) {

        $image_path = public_path($blog->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->withToastSuccess('Blog deleted Successfully!!');
    }

}
