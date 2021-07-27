<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use File;
use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Image;
use App\SystemSettingsModel;
use App\BrowserModel;
use App\ActivityModel;
use Carbon\Carbon;

class ProfileController extends Controller {

    // This function will redirect in profile page
    public function profile() {
        return view('backend.system.account.profile');
    }

    // Update Account Info
    public function update(Request $request) {
        $rules = [
            'name' => 'required|max:100',
            'phone' => ['required', 'numeric', Rule::unique('admin')->ignore($request->admin_id, 'admin_id')],
        ];

        $message = [
            'name.required' => 'Name required',
            'name.max' => 'Name must be less than 100 characters',
            'phone.required' => 'Phone number required',
            'phone.numeric' => 'Phone number must be numeric value',
            'phone.unique' => 'Phone number already exists',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting logged in user information
            $admin_info = Auth::guard('admin')->user();
            if ($admin_info) {
                $admin_info->name = $request->name;
                $admin_info->phone = $request->phone;

                // Checking if mobile verification is required or not
                try {
                    $is_required = SystemSettingsModel::select('is_phone_verification')->first();
                    if ($is_required->is_phone_verification == 'Yes') {
                        // Mobile verification required
                        // Need to implement
                    } else {
                        // No mobile verification
                        if ($admin_info->save()) {
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
                            $activity->details = 'Account information updated successfully';
                            $activity->created_at = Carbon::now();
                            if ($activity->save()) {
                                return redirect('portal/profile')->with('success', 'Account information updated successfully');
                            } else {
                                return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                            }
                        } else {
                            return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                        }
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
        return view('backend.system.account.password');
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
            $admin_info = Auth::guard('admin')->user();
            // Manual validation
            $errors = array();
            if (!empty($request->password)) {
                if (!Hash::check($request->password, $admin_info->password)) {
                    $errors['password'] = "Current password not matched";
                }
            }
            if (count($errors) > 0) {
                return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
            }

            if ($admin_info) {
                $admin_info->password = bcrypt($request->new_password);
                if ($admin_info->save()) {
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
                    $activity->details = 'Password updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/password')->with('success', 'Password changed successfully');
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

        $admin_id = $request->admin_id;
        $avatar = $request->avatar;
        $errors = array();
        try {
            $admin_info = Auth::guard('admin')->user();
            if ($_FILES['avatar']['name']) {
                $pre_image = $admin_info->avatar; // Getting previous image
                if ($pre_image != '') {
                    $unlink_image = public_path("upload/admin/avatar/" . $admin_info->avatar); // get previous image from folder
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
                })->save(('upload/admin/avatar/') . $image_name); // Upload Path
                $admin_info->avatar = $image_name;
            }

            if ($admin_info->save()) {
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
                $activity->details = 'Profile picture updated successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/profile')->with('success', 'Profile picture updated successfully');
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
