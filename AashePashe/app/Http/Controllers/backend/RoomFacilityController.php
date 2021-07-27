<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\RoomFacilityModel;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class RoomFacilityController extends Controller {

    // This function will redirect into room facility list page
    public function index() {
        try {
            $data_list = RoomFacilityModel::get();
            return view('backend.system.room_facility.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into room facility add page
    public function add() {
        try {
            return view('backend.system.room_facility.add');
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store room facility information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:room_facility|max:255',
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
            $data_list = new RoomFacilityModel();
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
                    // Creating room object to store admin room
                    $room = new ActivityModel();
                    $room->browser_name = $browser_name;
                    $room->browser_version = $browser_version;
                    $room->ip_address = $ip_address;
                    $room->user_id = Auth::guard('admin')->user()->admin_id;
                    $room->user_type = 'Admin';
                    $room->details = 'Room facility added successfully named ' . $request->name;
                    $room->created_at = Carbon::now();
                    if ($room->save()) {
                        return redirect('portal/room/facility')->with('success', 'Room facility added successfully');
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

    // This function will redirect into room facility edit page
    public function edit($id) {
        try {
            $data_list = RoomFacilityModel::find($id);
            return view('backend.system.room_facility.edit', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function update the room facility information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('room_facility')->ignore($request->room_facility_id, 'room_facility_id'), 'max:255'],
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
            $data_list = RoomFacilityModel::find($request->room_facility_id);
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
                    // Creating room object to store admin room
                    $room = new ActivityModel();
                    $room->browser_name = $browser_name;
                    $room->browser_version = $browser_version;
                    $room->ip_address = $ip_address;
                    $room->user_id = Auth::guard('admin')->user()->admin_id;
                    $room->user_type = 'Admin';
                    $room->details = 'Room facility updated successfully named ' . $request->name;
                    $room->created_at = Carbon::now();
                    if ($room->save()) {
                        return redirect('portal/room/facility')->with('success', 'Room facility updated successfully');
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
