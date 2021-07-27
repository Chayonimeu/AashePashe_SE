<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\CityModel;
use App\SubAreaModel;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class SubareaController extends Controller {

    // This function will redirect into sub area list page by passing city id
    public function index($id) {
        try {
            $city_info = CityModel::where('city_id', $id)->first();
            // Getting sub area data
            $data_list = SubAreaModel::where('city_id', $id)->get();
            return view('backend.system.subarea.index', compact('data_list', 'city_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into sub area add page by passing city id
    public function add($id) {
        // Getting city information
        try {
            $city_info = CityModel::where('city_id', $id)->first();
            return view('backend.system.subarea.add', compact('city_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store sub area information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:sub_area|max:100',
            'status' => 'required'
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 100 characters long',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Create city object
            $data_list = new SubAreaModel();
            if ($data_list) {
                $data_list->city_id = $request->city_id;
                $data_list->name = $request->name;
                $data_list->latitude = $request->latitude;
                $data_list->longitude = $request->longitude;
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
                    $activity->details = 'Sub area added successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/subarea/' . $request->city_id)->with('success', 'Sub area added successfully');
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

    // This function will redirect into sub area edit page
    public function edit($id, $city_id) {
        try {
            $city_info = CityModel::where('city_id', $city_id)->first();
            $data_list = SubAreaModel::where('sub_area_id', $id)->first();
            return view('backend.system.subarea.edit', compact('data_list', 'city_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update sub area information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('sub_area')->ignore($request->sub_area_id, 'sub_area_id'), 'max:100'],
            'status' => 'required'
        ];
        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 100 characters long',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            $data_list = SubAreaModel::find($request->sub_area_id);
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->latitude = $request->latitude;
                $data_list->longitude = $request->longitude;
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
                    $activity->details = 'Sub area updated successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/subarea/' . $request->city_id)->with('success', 'Sub area updated successfully');
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
