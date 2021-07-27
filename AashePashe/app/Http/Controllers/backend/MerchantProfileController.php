<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Hash;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Validation\Rule;
use App\SystemSettingsModel;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;
use App\CountryModel;

class MerchantProfileController extends Controller {

    public function __construct() {
        $this->middleware('merchant');
    }

    // This function will redirect in merchant profile
    public function profile() {
        $country_list = CountryModel::where('status', 'Active')->get();
        return view('backend.system.panel.account.profile', compact('country_list'));
    }

    // Update Account Info
    public function update(Request $request) {
        $rules = [
            'name' => 'required|max:100',
            'phone' => ['required', 'numeric', Rule::unique('merchant')->ignore($request->merchant_id, 'merchant_id')],
            'company_name' => 'required|max:100',
            'company_address' => 'required|max:255',
        ];

        $message = [
            'name.required' => 'Name required',
            'name.max' => 'Name must be less than 100 characters',
            'phone.required' => 'Phone number required',
            'phone.numeric' => 'Phone number must be numeric value',
            'phone.unique' => 'Phone number already exists',
            'company_name.required' => 'Company name required',
            'company_address.required' => 'Company address required',
            'company_address.max' => 'Company address must be less than 255 characters',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting logged in user information
            $data_list = Auth::guard('merchant')->user();
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->phone = $request->phone;
                $data_list->country_code = $request->country_code;
                if ($request->is_branch_user == 'No') {
                    $data_list->company_name = $request->company_name;
                    $data_list->company_address = $request->company_address;
                }

                try {
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
                        $activity->details = 'Account information updated successfully';
                        $activity->created_at = Carbon::now();
                        if ($activity->save()) {
                            return redirect('portal/merchant/profile')->with('success', 'Account information updated successfully');
                        } else {
                            return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                    }
                } catch (Exception $ex) {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                }
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again later');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect in password change page
    public function password() {
        return view('backend.system.panel.account.password');
    }

    // This funciton will change Password
    public function change(Request $request) {
        // Validaiton rules
        $rules = [
            'password' => 'required|min:6|max:255',
            'new_password' => 'required|min:6|max:255',
            'confirm_password' => 'required|min:6|max:255|required_with:new_password|same:new_password',
        ];

        // Error messages
        $message = [
            'password.required' => 'Current password required',
            'new_password.required' => 'New password required',
            'new_password.min' => 'New password must be at least 6 characters long',
            'new_password.max' => 'New password can be maximum 255 characters long',
            'confirm_password.confirmed' => 'New password does not match',
            'confirm_password.required' => 'Confirm password required',
            'confirm_password.min' => 'Confirm password must be at least 6 characters long',
            'confirm_password.max' => 'Confirm password can be maximum 255 characters long',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting logged in user data
            $data_list = Auth::guard('merchant')->user();
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
                    $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                    $activity->user_type = 'Merchant';
                    $activity->details = 'Password updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/merchant/password')->with('success', 'Password changed successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                    }
                } else {
                    return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will change avatar
    public function avatar(Request $request) {

        $merchant_id = $request->merchant_id;
        $avatar = $request->avatar;
        try {
            $data_list = Auth::guard('merchant')->user();
            if ($_FILES['avatar']['name']) {
                $pre_image = $data_list->avatar; // Getting previous image
                if ($pre_image != '') {
                    $unlink_image = public_path("upload/admin/avatar/" . $data_list->avatar); // get previous image from folder
                    if (File::exists($unlink_image)) { // unlink or remove previous image from folder
                        unlink($unlink_image);
                    }
                }
                $image = $request->file('avatar');
                $img = Image::make($image->getRealPath());
                $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->avatar->getClientOriginalExtension();
                // resize the image 300x300
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(('upload/merchant/avatar/') . $image_name); // upload path
                $data_list->avatar = $image_name;
            }

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
                $activity->details = 'Profile picture updated successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/merchant/profile')->with('success', 'Profile picture updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will change company logo
    public function logo(Request $request) {

        $merchant_id = $request->merchant_id;
        $company_logo = $request->company_logo;
        try {

            $data_list = Auth::guard('merchant')->user();
            if ($_FILES['company_logo']['name']) {
                $pre_image = $data_list->company_logo; // Getting previous image
                if ($pre_image != '') {
                    $unlink_image = public_path("upload/admin/logo/" . $data_list->company_logo); // get previous image from folder
                    if (File::exists($unlink_image)) { // unlink or remove previous image from folder
                        unlink($unlink_image);
                    }
                }
                $image = $request->file('avatar');
                $img = Image::make($image->getRealPath());
                $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->company_logo->getClientOriginalExtension();
                // resize the image 300x300
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(('upload/merchant/logo/') . $image_name); // upload path
                $data_list->company_logo = $image_name;
            }

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
                $activity->details = 'Company logo updated successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/merchant/profile')->with('success', 'Company logo updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
