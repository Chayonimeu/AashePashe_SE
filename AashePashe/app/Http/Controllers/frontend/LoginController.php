<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\BrowserModel;
use App\ActivityModel;
use Carbon\Carbon;
use App\SessionActivityModel;

class LoginController extends Controller {

    public function authenticate(Request $request) {
        $rules = [
            'phone' => 'required|numeric|exists:user,phone',
            'password' => 'required',
        ];

        $message = [
            'phone.required' => 'Phone number required',
            'phone.numeric' => 'Phone number must be numeric value',
            'phone.exists' => 'Phone number not registered into system',
            'password.required' => 'Password required',
        ];

        $this->validate($request, $rules, $message);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'status' => 'Active'])) {

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
            $activity->details = 'Login into the system';
            $activity->created_at = Carbon::now();

            if ($activity->save()) {
                $session_info = SessionActivityModel::where('user_id', Auth::user()->user_id)->where('user_type', 'User')->count();
                if ($session_info > 0) {
                    // Update the session activity
                    $session = SessionActivityModel::where('user_id', Auth::user()->user_id)->where('user_type', 'User')->first();
                    $session->user_id = Auth::user()->user_id;
                    $session->user_type = 'User';
                    $session->last_login = $session->first_login; // Swap the first login into last login
                    $session->first_login = Carbon::now();
                    if ($session->save()) {
                        return redirect('dashboard');
                    } else {
                        Auth::logout();
                        return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                    }
                } else {
                    // Create new session activity
                    $session = new SessionActivityModel();
                    $session->user_id = Auth::user()->user_id;
                    $session->user_type = 'User';
                    $session->first_login = Carbon::now();
                    $session->last_login = Carbon::now();
                    if ($session->save()) {
                        return redirect('dashboard');
                    } else {
                        Auth::logout();
                        return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                    }
                }
            } else {
                return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
            }
        } else {
            Auth::logout();
            return redirect()->back()->withInput()->with('error', "Invalid credentials. Check phone number or password again.");
        }
    }

}
