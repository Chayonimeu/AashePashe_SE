<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\PropertyModel;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class PropertyController extends Controller {

    // This function will redirect into property list page
    public function index() {
        try {
            // Getting property data
            $data_list = PropertyModel::get();
            return view('backend.system.property.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into property add page
    public function add() {
        try {
            return view('backend.system.property.add');
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store property information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:property|max:255',
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
            $data_list = new PropertyModel();
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->details = $request->details;
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
                    $activity->details = 'Property category added successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/property/')->with('success', 'Property category added successfully');
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

    // This function will redirect into property edit page
    public function edit($id) {
        try {
            $data_list = PropertyModel::find($id);
            return view('backend.system.property.edit', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update property information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('property')->ignore($request->property_id, 'property_id'), 'max:255'],
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
            // Getting city informaiton by city id and creating object
            $data_list = PropertyModel::find($request->property_id);
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->details = $request->details;
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
                    $activity->details = 'Property category updated successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/property/')->with('success', 'Property category updated successfully');
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
