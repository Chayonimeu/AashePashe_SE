<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\SystemSettingsModel;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Image;
use App\BrowserModel;
use App\ActivityModel;
use Carbon\Carbon;

class SystemSettingsController extends Controller {

    // This function will redirect into system setting general information page
    public function index() {
        try {
            // Getting system settings information
            $system_info = SystemSettingsModel::first();
            return view('backend.system.general.index', compact('system_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update general information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|max:100',
            'short_name' => 'required|max:15',
            'logo' => 'bail|nullable|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF|max:2048',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.max' => 'Name must be less than 100 characters long',
            'short_name.required' => 'Short name required',
            'short_name.max' => 'Short name must be less than 15 characters long',
            'logo.mimes' => 'Logo must be a file of type: jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF',
            'logo.max' => 'Logo may not be greater than 2 MB',
        ];

        $this->validate($request, $rules, $message);

        try {
            $system_settings = SystemSettingsModel::first();
            if ($system_settings) {
                $system_settings->name = $request->name;
                $system_settings->short_name = $request->short_name;
                $system_settings->facebook = $request->facebook;
                $system_settings->google = $request->google;
                $system_settings->youtube = $request->youtube;
                $system_settings->linkedin = $request->linkedin;
                $system_settings->twitter = $request->twitter;
                $system_settings->sales_email = $request->sales_email;
                $system_settings->sales_phone = $request->sales_phone;
                $system_settings->support_email = $request->support_email;
                $system_settings->support_phone = $request->support_phone;
                $system_settings->billing_email = $request->billing_email;
                $system_settings->billing_phone = $request->billing_phone;
                $system_settings->address = $request->address;
                $system_settings->is_phone_verification = $request->is_phone_verification;
                $system_settings->is_email_verification = $request->is_email_verification;

                if ($request->file('logo')) {
                    // Unlink previous image if exists
                    if ($system_settings->logo != NULL) {
                        $Image = public_path("upload/" . $system_settings->logo); // get previous image from folder
                        if (File::exists($Image)) { // unlink or remove previous image from folder
                            unlink($Image);
                        }
                    }
                    // Store image to folder
                    $image = $request->file('logo');
                    $img = Image::make($image->getRealPath());
                    $imageName = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->sliderImage->getClientOriginalExtension();
                    // Resize image
                    $img->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(('upload/') . $imageName); // Upload path
                    $system_settings->logo = $imageName;
                }
                if ($system_settings->save()) {
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
                    $activity->details = 'System settings general information updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/system')->with('success', 'General information updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                    }
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later');
                }
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again later');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into about us page
    public function about() {
        try {
            $system_info = SystemSettingsModel::first();
            return view('backend.system.about.index', compact('system_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update about us information
    public function update_about(Request $request) {

        // Validation rules
        $rules = [
            'about_us' => 'required',
        ];

        // Error messages
        $message = [
            'about_us.required' => 'About Us required',
        ];

        $this->validate($request, $rules, $message);
        try {
            $system_settings = SystemSettingsModel::first();
            if ($system_settings) {
                $system_settings->about_us = $request->about_us;

                if ($system_settings->save()) {
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
                    $activity->details = 'System settings about us information updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/about')->with('success', 'About Us updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later');
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

    // This function will redirect into privacy policy page
    public function privacy() {
        try {
            $system_info = SystemSettingsModel::first();
            return view('backend.system.privacy.index', compact('system_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update privacy policy
    public function update_privacy(Request $request) {

        // Validation rules
        $rules = [
            'privacy' => 'required',
        ];
        // Error messages
        $message = [
            'privacy.required' => 'Privacy & Policy required',
        ];

        $this->validate($request, $rules, $message);

        try {
            $system_settings = SystemSettingsModel::first();
            if ($system_settings) {
                $system_settings->privacy = $request->privacy;

                if ($system_settings->save()) {
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
                    $activity->details = 'System settings privacy information updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/privacy')->with('success', 'Privacy and policy updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later');
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

    // This function will redirect into terms and conditions page
    public function terms() {
        try {
            $system_info = SystemSettingsModel::first();
            return view('backend.system.terms.index', compact('system_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update terms and conditions
    public function update_terms(Request $request) {

        // Validation rules
        $rules = [
            'terms' => 'required',
        ];

        // Error messages
        $message = [
            'terms.required' => 'Terms and Conditions required',
        ];

        $this->validate($request, $rules, $message);

        try {
            $system_settings = SystemSettingsModel::first();
            if ($system_settings) {
                $system_settings->terms = $request->terms;

                if ($system_settings->save()) {
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
                    $activity->details = 'System settings terms and conditions updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/terms')->with('success', 'Terms and Conditions updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later');
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
