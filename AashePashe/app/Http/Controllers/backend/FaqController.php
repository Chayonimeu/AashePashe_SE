<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\FaqModel;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class FaqController extends Controller {

    // This funciton will redirect into faq list page
    public function index() {
        try {
            // Getting faq list data with pagination 10
            $data_list = FaqModel::paginate(10);
            return view('backend.system.faq.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into faq add page
    public function add() {
        return view('backend.system.faq.add');
    }

    // This function will redirect into faq edit page by passing faq id
    public function edit($id) {
        try {
            // Getting faq data by passing faq id
            $data_list = FaqModel::find($id);
            return view('backend.system.faq.edit', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store faq information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'question' => 'required',
            'answer' => 'required'
        ];

        // Error messages
        $message = [
            'question.required' => 'Question required',
            'answer.required' => 'Answer required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Creating new faq object
            $data_list = new FaqModel();
            if ($data_list) {
                $data_list->question = $request->question;
                $data_list->answer = $request->answer;
                $data_list->status = 'Active';

                if ($data_list->save()) {
                    // Getting IP address
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    // Getting browser information
                    $browser = new BrowserModel();
                    $browser_info = $browser->get_browser_information();
                    $browser_name = $browser_info['name']; // Browser Name
                    $browser_version = $browser_info['version']; // Browser Version
                    // Creating activity object to store admin activity
                    $activity = new ActivityModel();
                    $activity->browser_name = $browser_name;
                    $activity->browser_version = $browser_version;
                    $activity->ip_address = $ip_address;
                    $activity->user_id = Auth::guard('admin')->user()->admin_id;
                    $activity->user_type = 'Admin';
                    $activity->details = 'Faq added successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/faq')->with('success', 'Faq added successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update faq information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required'
        ];

        // Error messages
        $message = [
            'question.required' => 'Question required',
            'answer.required' => 'Answer required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting faq information by passing faq id
            $data_list = FaqModel::find($request->faq_id);
            if ($data_list) {
                $data_list->question = $request->question;
                $data_list->answer = $request->answer;
                $data_list->status = $request->status;

                if ($data_list->save()) {
                    // Getting IP address
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    // Getting browser information
                    $browser = new BrowserModel();
                    $browser_info = $browser->get_browser_information();
                    $browser_name = $browser_info['name']; // Browser Name
                    $browser_version = $browser_info['version']; // Browser Version
                    // Creating activity object to store admin activity
                    $activity = new ActivityModel();
                    $activity->browser_name = $browser_name;
                    $activity->browser_version = $browser_version;
                    $activity->ip_address = $ip_address;
                    $activity->user_id = Auth::guard('admin')->user()->admin_id;
                    $activity->user_type = 'Admin';
                    $activity->details = 'Faq updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/faq')->with('success', 'Faq updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will permanently delete faq information
    public function delete(Request $request) {
        try {
            $faq_id = Input::get('faq_id');
            FaqModel::where('faq_id', $faq_id)->delete();
            return redirect('portal/faq')->with('success', 'Faq deleted successfully');
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
