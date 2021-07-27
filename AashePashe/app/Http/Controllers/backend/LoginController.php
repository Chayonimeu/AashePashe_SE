<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;
use App\SessionActivityModel;
use App\MerchantModel;
use App\TypeModel;

class LoginController extends Controller {

    use AuthenticatesUsers;

    // This function will redirect to login page
    public function index() {
        return view('backend.index');
    }

    // Authenticate login by using email address and password for admin users
    public function authenticate(Request $request) {

        // Validation rules
        $rules = [
            'email' => 'required|email|exists:admin,email',
            'password' => 'required',
        ];

        // Error messages
        $message = [
            'email.required' => 'Email address required',
            'email.email' => 'Email address must be a valid email address',
            'email.exists' => 'Email address not registered into this system',
            'password.required' => 'Password required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Attempt for login using provided email address and password
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // Check if account is active or not
                // If active proceed to login
                if (Auth::guard('admin')->user()->status == "Active") {
                    $admin_info = Auth::guard('admin')->user();
                    $admin_info->is_logged = 'Yes';
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
                        $activity->details = 'Login into the system';
                        $activity->created_at = Carbon::now();
                        if ($activity->save()) {
                            // Store session activity
                            // Check if session information exists or not for logged in users
                            // If information exists then update the session information
                            // Otherwise create new session information
                            $session_info = SessionActivityModel::where('user_id', Auth::guard('admin')->user()->admin_id)->where('user_type', 'Admin')->count();
                            if ($session_info > 0) {
                                // Update the session activity
                                $session = SessionActivityModel::where('user_id', Auth::guard('admin')->user()->admin_id)->where('user_type', 'Admin')->first();
                                $session->user_id = Auth::guard('admin')->user()->admin_id;
                                $session->user_type = 'Admin';
                                $session->last_login = $session->first_login; // Swap the first login into last login
                                $session->first_login = Carbon::now();
                                if ($session->save()) {
                                    return redirect('portal/dashboard');
                                } else {
                                    Auth::guard('admin')->logout();
                                    return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                                }
                            } else {
                                // Create new session activity
                                $session = new SessionActivityModel();
                                $session->user_id = Auth::guard('admin')->user()->admin_id;
                                $session->user_type = 'Admin';
                                $session->first_login = Carbon::now();
                                $session->last_login = Carbon::now();
                                if ($session->save()) {
                                    return redirect('portal/dashboard');
                                } else {
                                    Auth::guard('admin')->logout();
                                    return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                                }
                            }
                        } else {
                            Auth::guard('admin')->logout();
                            return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                        }
                    } else {
                        Auth::guard('admin')->logout();
                        return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                    }
                } else {
                    Auth::guard('admin')->logout();
                    return redirect()->back()->withInput()->with('error', "Your account not activated yet. Please contact with system admin.");
                }
            } else {
                return redirect()->back()->withInput()->with('error', "Invalid credentials. Check email address or password and try again.");
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into merchant login page
    public function merchant_login() {
        return view('backend.merchant');
    }

    public function merchant_authenticate(Request $request) {
        // Validation rules
        $rules = [
            'email' => 'required|email|exists:merchant,email',
            'password' => 'required',
        ];

        // Error messages
        $message = [
            'email.required' => 'Email address required',
            'email.email' => 'Email address must be a valid email address',
            'email.exists' => 'Email address not registered into this system',
            'password.required' => 'Password required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Attempt for login using provided email address and password
            if (Auth::guard('merchant')->attempt(['email' => $request->email, 'password' => $request->password])) {

                // Check if account is active or not
                // If active proceed to login
                if (Auth::guard('merchant')->user()->status == "Active") {

                    $data_list = Auth::guard('merchant')->user();
                    $data_list->is_logged = 'Yes';
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
                        $activity->details = 'Login into the system';
                        $activity->created_at = Carbon::now();
                        if ($activity->save()) {
                            // Store session activity
                            // Check if session information exists or not for logged in users
                            // If information exists then update the session information
                            // Otherwise create new session information
                            $session_info = SessionActivityModel::where('user_id', Auth::guard('merchant')->user()->merchant_id)->where('user_type', 'Merchant')->count();
                            if ($session_info > 0) {
                                // Update the session activity
                                $session = SessionActivityModel::where('user_id', Auth::guard('merchant')->user()->merchant_id)->where('user_type', 'Merchant')->first();
                                $session->user_id = Auth::guard('merchant')->user()->merchant_id;
                                $session->user_type = 'Merchant';
                                $session->last_login = $session->first_login; // Swap the first login into last login
                                $session->first_login = Carbon::now();
                                if ($session->save()) {
                                    return redirect('portal/merchant/dashboard');
                                }
                            } else {
                                // Create new session activity
                                $session = new SessionActivityModel();
                                $session->user_id = Auth::guard('merchant')->user()->merchant_id;
                                $session->user_type = 'Merchant';
                                $session->first_login = Carbon::now();
                                $session->last_login = Carbon::now();
                                if ($session->save()) {
                                    return redirect('portal/merchant/dashboard');
                                }
                            }
                        }
                    } else {
                        return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                    }
                } else {
                    Auth::guard('merchant')->logout();
                    return redirect()->back()->withInput()->with('error', "Your account not activated yet. Please contact with system admin.");
                }
            } else {
                return redirect()->back()->withInput()->with('error', "Invalid credentials. Check email address or password again.");
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
