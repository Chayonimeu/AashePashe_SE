<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\HotelFacilityModel;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class HotelFacilityController extends Controller {

    // This function will redirect into hotel facility list page
    public function index() {
        try {
            $data_list = HotelFacilityModel::get();
            return view('backend.system.hotel_facility.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into hotel facility add page
    public function add() {
        try {
            return view('backend.system.hotel_facility.add');
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store hotel facility information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:hotel_facility|max:255',
            'is_charged' => 'required',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 255 characters long',
            'is_charged.required' => 'Is charged required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            $data_list = new HotelFacilityModel();
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->is_charged = $request->is_charged;
                $data_list->status = $request->status;

                if ($data_list->save()) {
                    // Getting IP address
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    // Getting browser information
                    $browser = new BrowserModel();
                    $browser_info = $browser->get_browser_information();
                    $browser_name = $browser_info['name']; // Browser Name
                    $browser_version = $browser_info['version']; // Browser Version
                    // Creating hotel object to store admin hotel
                    $hotel = new ActivityModel();
                    $hotel->browser_name = $browser_name;
                    $hotel->browser_version = $browser_version;
                    $hotel->ip_address = $ip_address;
                    $hotel->user_id = Auth::guard('admin')->user()->admin_id;
                    $hotel->user_type = 'Admin';
                    $hotel->details = 'Hotel facility added successfully named ' . $request->name;
                    $hotel->created_at = Carbon::now();
                    if ($hotel->save()) {
                        return redirect('portal/hotel/facility')->with('success', 'Hotel facility added successfully');
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

    // This function will redirect into hotel facility edit page
    public function edit($id) {
        try {
            $data_list = HotelFacilityModel::find($id);
            return view('backend.system.hotel_facility.edit', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function update the hotel facility information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('hotel_facility')->ignore($request->hotel_facility_id, 'hotel_facility_id'), 'max:255'],
            'is_charged' => 'required',
            'status' => 'required'
        ];
        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 255 characters long',
            'is_charged.required' => 'Is charged required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);
        try {
            $data_list = HotelFacilityModel::find($request->hotel_facility_id);
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->is_charged = $request->is_charged;
                $data_list->status = $request->status;

                if ($data_list->save()) {
                    // Getting IP address
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    // Getting browser information
                    $browser = new BrowserModel();
                    $browser_info = $browser->get_browser_information();
                    $browser_name = $browser_info['name']; // Browser Name
                    $browser_version = $browser_info['version']; // Browser Version
                    // Creating hotel object to store admin hotel
                    $hotel = new ActivityModel();
                    $hotel->browser_name = $browser_name;
                    $hotel->browser_version = $browser_version;
                    $hotel->ip_address = $ip_address;
                    $hotel->user_id = Auth::guard('admin')->user()->admin_id;
                    $hotel->user_type = 'Admin';
                    $hotel->details = 'Hotel facility updated successfully named ' . $request->name;
                    $hotel->created_at = Carbon::now();
                    if ($hotel->save()) {
                        return redirect('portal/hotel/facility')->with('success', 'Hotel facility updated successfully');
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
