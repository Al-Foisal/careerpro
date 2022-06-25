<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserJobController extends Controller {
    public function index() {
        $jobs = Job::orderBy('id', 'desc')->where('user_id', Auth::id())->get();

        return view('frontend.user.job.index', compact('jobs'));
    }

    public function create() {
        return view('frontend.user.job.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'details'   => 'required',
            'dead_line' => 'required|after_or_equal:today',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/job/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_iamge = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Job::create([
            'user_id'   => Auth::id(),
            'name'      => $request->name,
            'dead_line' => $request->dead_line,
            'details'   => $request->details,
            'image'     => $final_iamge,
            'status'    => 1,
        ]);

        return redirect()->route('user.job.index')->withToastSuccess('Job created successfully!!');

    }

    public function show($id) {
        $job = Job::with('jobApplications')->where('id', $id)->where('user_id', Auth::id())->first();

        if (!$job) {
            return redirect()->back()->withToastError('Access denide!');
        }

        return view('frontend.user.job.show', compact('job'));
    }

    public function selected($id) {
        $job = Job::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$job) {
            return redirect()->back()->withToastError('Access denide!');
        }

        $job->selected = 1;
        $job->save();

        return redirect()->back()->withToastSuccess('The applicatiant selected successfully!!');
    }

    public function nonSelected($id) {
        $job = Job::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$job) {
            return redirect()->back()->withToastError('Access denide!');
        }

        $job->selected = 0;
        $job->save();

        return redirect()->back()->withToastSuccess('The applicatiant rejected successfully!!');
    }

    public function edit($id) {
        $job = Job::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$job) {
            return redirect()->back()->withToastError('Access denide!');
        }

        return view('frontend.user.job.edit', compact('job'));
    }

    public function update(Request $request, $id) {
        $job = Job::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$job) {
            return redirect()->back()->withToastError('Access denide!');
        }

        $validator = Validator::make($request->all(), [
            'name'      => 'required',

            'details'   => 'required',
            'dead_line' => 'required|after_or_equal:today',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                if ($job->image) {
                    $image_path = public_path($job->image);

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/job/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $job->update(['image' => $final_image]);
            }

        }

        $job->update([
            'user_id'   => Auth::id(),
            'name'      => $request->name,
            'dead_line' => $request->dead_line,
            'details'   => $request->details,
        ]);

        return redirect()->back()->withToastSuccess('Job updated successfully!!');
    }

    public function active(Request $request, $id) {
        $job = Job::findOrFail($id);

        $job->status = 1;
        $job->save();

        return redirect()->back()->withToastSuccess('Job activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $job = Job::findOrFail($id);

        $job->status = 0;
        $job->save();

        return redirect()->back()->withToastSuccess('Job inactivated successfully!!');
    }

    public function activeWalkInInterview(Request $request, $id) {
        $job = Job::findOrFail($id);

        $job->walk_in_interview = 1;
        $job->save();

        return redirect()->route('user.job.index')->withToastSuccess('Job activated for walk-in-interview!!');
    }

    public function inactiveWalkInInterview(Request $request, $id) {
        $job = Job::findOrFail($id);

        $job->walk_in_interview = 0;
        $job->save();

        return redirect()->route('user.job.index')->withToastSuccess('Job inactivated for walk-in-interview!!');
    }

    public function delete(Request $request, $id) {
        $job = Job::find($id);

        if ($job->image) {
            $image_path = public_path($job->image);

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

        }

        $job->delete();

        return redirect()->back()->withToastSuccess('Job deleted successfully!!');
    }

}
