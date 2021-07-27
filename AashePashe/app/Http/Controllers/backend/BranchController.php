<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\CountryModel;
use App\CityModel;
use App\SubAreaModel;
use App\BranchModel;
use App\BrowserModel;
use App\ActivityModel;
use Carbon\Carbon;

class BranchController extends Controller {

    // This function will redirect into branch list page
    public function index() {
        try {
            $data_list = BranchModel::where('root_id', Auth::guard('merchant')->user()->merchant_id)->get();
            return view('backend.system.panel.branch.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into branch add page
    public function add() {
        try {
            // Getting country data
            $country_list = CountryModel::where('status', 'Active')->get();
            return view('backend.system.panel.branch.add', compact('country_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store the district information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|max:100',
            'country_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'status' => 'required'
        ];

        // Error messages
        $message = [
            'name.required' => 'Branch name required',
            'name.max' => 'Name must be less than 100 characters',
            'country_id.required' => 'Country required',
            'city_id.required' => 'City required',
            'address.required' => 'Address required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Creating branch object
            $data_list = new BranchModel();
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->country_id = $request->country_id;
                $data_list->city_id = $request->city_id;
                $data_list->sub_area_id = $request->sub_area_id;
                $data_list->address = $request->address;
                $data_list->contact_name = $request->contact_name;
                $data_list->contact_email = $request->contact_email;
                $data_list->contact_phone = $request->contact_phone;
                $data_list->root_id = Auth::guard('merchant')->user()->merchant_id;
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
                    $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                    $activity->user_type = 'Merchant';
                    $activity->details = 'Branch added named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/merchant/branch')->with('success', 'Branch added successfully');
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
