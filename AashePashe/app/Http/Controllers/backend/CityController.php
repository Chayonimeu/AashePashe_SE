<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\CityModel;
use App\CountryModel;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class CityController extends Controller {

    // This function will redirect into city list page by passing country id
    public function index($id) {
        try {
            $country_info = CountryModel::where('country_id', $id)->first();
            // Getting city data
            $data_list = CityModel::where('country_id', $id)->get();
            return view('backend.system.city.index', compact('data_list', 'country_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into city add page by passing country id
    public function add($id) {
        // Getting country information
        try {
            $country_info = CountryModel::where('country_id', $id)->first();
            return view('backend.system.city.add', compact('country_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store city information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:city|max:100',
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
            $data_list = new CityModel();
            if ($data_list) {
                $data_list->country_id = $request->country_id;
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
                    $activity->details = 'City added successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/city/' . $request->country_id)->with('success', 'City added successfully');
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

    // This function will redirect into city edit page
    public function edit($id, $city_id) {
        try {
            // Getting country information
            $country_info = CountryModel::where('country_id', $id)->first();
            $data_list = CityModel::find($city_id);
            return view('backend.system.city.edit', compact('data_list', 'country_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update city information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('city')->ignore($request->city_id, 'city_id'), 'max:100'],
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
            // Getting city informaiton by city id and creating object
            $data_list = CityModel::find($request->city_id);
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
                    $activity->details = 'City updated successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/city/' . $request->country_id)->with('success', 'City updated successfully');
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
