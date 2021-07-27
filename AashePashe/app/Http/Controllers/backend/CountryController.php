<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\CountryModel;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class CountryController extends Controller {

    public function index() {
        try {
            $country_list = CountryModel::get();
            return view('backend.system.country.index', compact('country_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into country edit page
    public function edit($id) {
        try {
            // Getting country data by country id
            $country_list = CountryModel::find($id);
            return view('backend.system.country.edit', compact('country_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update country information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('country')->ignore($request->country_id, 'country_id'), 'max:100'],
            'short_name' => 'required|max:50',
            'code' => 'required|max:15',
            'currency_symbol' => 'required|max:15',
            'currency_name' => 'required|max:15',
            'status' => 'required'
        ];
        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 100 characters long',
            'short_name.required' => 'Short name required',
            'short_name.max' => 'Short name must be less than 50 characters long',
            'code.required' => 'Calling code required',
            'code.max' => 'Calling code must be less than 15 characters long',
            'currency_symbol.required' => 'Currency symbol required',
            'currency_symbol.max' => 'Currency symbol must be less than 15 characters long',
            'currency_name.required' => 'Currency name required',
            'currency_name.max' => 'Currency name must be less than 15 characters long',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting country informaiton by country id and creating object
            $country_list = CountryModel::find($request->country_id);
            if ($country_list) {
                $country_list->name = $request->name;
                $country_list->short_name = $request->short_name;
                $country_list->code = $request->code;
                $country_list->currency_symbol = $request->currency_symbol;
                $country_list->currency_name = $request->currency_name;
                $country_list->status = $request->status;

                if ($country_list->save()) {
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
                    $activity->details = 'Country updated successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/country')->with('success', 'Country updated successfully');
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
