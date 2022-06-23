<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Assesment;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Instructor;
use App\Models\Job;
use App\Models\Order;
use App\Models\User;
use App\Models\Contact;

class DashboardController extends Controller {
    public function dashboard() {
        $data                = [];
        $data['ainatructor'] = Instructor::where('is_approved', 1)->count();
        $data['iinatructor'] = Instructor::where('is_approved', 0)->count();

        $data['active_course']   = Course::where('status', 1)->count();
        $data['inactive_course'] = course::where('status', 0)->count();

        $data['user']  = User::count();
        $data['admin'] = Admin::count();

        $data['order'] = Order::count();

        $data['checked_assesment']   = Assesment::where('submitted', 1)->count();
        $data['unchecked_assesment'] = Assesment::where('submitted', 0)->count();

        $data['exam'] = Exam::count();

        $data['job']          = Job::count();
        $data['active_job']   = Job::where('dead_line', '<=', today())->count();
        $data['inactive_job'] = Job::where('dead_line', '>=', today())->count();
        $data['job_by_admin'] = Job::where('admin_id', '!==', null)->count();
        $data['job_by_user']  = Job::where('user_id', '!==', null)->count();

        $yesterday                     = date("Y-m-d", strtotime('-1 days'));
        $data['yesterday_application'] = Job::whereDate('created_at', $yesterday)->count();

        return view('backend.dashboard', $data);
    }
    
    public function contact(){
        $contact = Contact::orderBy('id','desc')->get();
        
        return view('backend.contact',compact('contact'));
    }
    
    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->back()->withToastSuccess('Contact deleted successfully!!');
    }
}
