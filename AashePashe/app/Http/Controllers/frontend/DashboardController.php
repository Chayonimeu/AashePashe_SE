<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BrowserModel;
use App\ActivityModel;
use App\User;
use Hash;
use Carbon\Carbon;
use App\CityModel;
use App\CountryModel;
use Illuminate\Validation\Rule;

class DashboardController extends Controller {

    public function dashboard() {
        return view('frontend/user/index');
    }

    public function change_password() {
        return view('frontend/user/password');
    }

    public function update_password(Request $request) {
        $rules = [
            'password' => 'required|min:6|max:255',
            'new_password' => 'required|min:6|max:255',
            're_password' => 'required|min:6|max:255|required_with:new_password|same:new_password',
        ];

        $message = [
            'password.required' => 'Current password required',
            'new_password.required' => 'New password required',
            'new_password.min' => 'New password must be at least 6 characters long',
            'new_password.max' => 'New password can be maximum 255 characters long',
            're_password.confirmed' => 'New password does not match',
            're_password.required' => 'Confirm password required',
            're_password.min' => 'Confirm password must be at least 6 characters long',
            're_password.max' => 'Confirm password can be maximum 255 characters long',
        ];

        $this->validate($request, $rules, $message);

        $data_list = Auth::user();
        // Manual validation
        $errors = array();
        if (!empty($request->password)) {
            if (!Hash::check($request->password, $data_list->password)) {
                $errors['password'] = "Current password not matched";
            }
        }
        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        }

        if ($data_list) {
            $data_list->password = bcrypt($request->new_password);
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
                $activity->user_id = Auth::user()->user_id;
                $activity->user_type = 'User';
                $activity->details = 'Password changed successfully';
                $activity->created_at = Carbon::now();

                if ($activity->save()) {
                    return redirect('change/password')->with('success', 'Password changed successfully');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
        }
    }

    public function profile() {
        try {
            return view('frontend/user/profile');
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function updates the profile information
    public function update_profile(Request $request) {
        $rules = [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => ['required', 'email', Rule::unique('user')->ignore($request->user_id, 'user_id'), 'max:100'],
        ];

        $message = [
            'first_name.required' => 'First name required',
            'first_name.max' => 'First name can be maximum 100 characters long',
            'last_name.required' => 'Last name required',
            'last_name.max' => 'Last name can be maximum 100 characters long',
            'email.required' => 'Email required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email address already exists',
            'email.max' => 'Email address can be maximum 100 characters long',
        ];

        $this->validate($request, $rules, $message);

        try {
            $data_list = Auth::user();
            $data_list->first_name = $request->first_name;
            $data_list->last_name = $request->last_name;
            $data_list->email = $request->email;
            $data_list->gender = $request->gender;
            $data_list->dob = $request->dob;
            $data_list->address = $request->address;

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
                $activity->user_id = Auth::user()->user_id;
                $activity->user_type = 'User';
                $activity->details = 'Account information changed successfully';
                $activity->created_at = Carbon::now();

                if ($activity->save()) {
                    return redirect('dashboard')->with('success', 'Information updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
