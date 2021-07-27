<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\ActivityFacilityModel;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class ActivityFacilityController extends Controller {

    // This function will redirect into activity facility list page
    public function index() {
        try {
            $data_list = ActivityFacilityModel::get();
            return view('backend.system.activity_facility.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into activity facility add page
    public function add() {
        try {
            return view('backend.system.activity_facility.add');
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store activity facility information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:activity_facility|max:255',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 255 characters long',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            $data_list = new ActivityFacilityModel();
            if ($data_list) {
                $data_list->name = $request->name;
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
                    $activity->details = 'Activity facility added successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/activity/facility')->with('success', 'Activity facility added successfully');
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

    // This function will redirect into activity facility edit page
    public function edit($id) {
        try {
            $data_list = ActivityFacilityModel::find($id);
            return view('backend.system.activity_facility.edit', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function update the activity facility information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('activity_facility')->ignore($request->activity_facility_id, 'activity_facility_id'), 'max:255'],
            'status' => 'required'
        ];
        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 255 characters long',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);
        try {
            $data_list = ActivityFacilityModel::find($request->activity_facility_id);
            if ($data_list) {
                $data_list->name = $request->name;
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
                    $activity->details = 'Activity facility updated successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/activity/facility')->with('success', 'Activity facility updated successfully');
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

}
