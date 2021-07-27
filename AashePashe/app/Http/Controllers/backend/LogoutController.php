<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\SessionActivityModel;
use Carbon\Carbon;

class LogoutController extends Controller {

    use AuthenticatesUsers;

    // This function will logout the user
    public function logout() {
        try {
            $admin_info = Auth::guard('admin')->user();
            $admin_info->is_logged = 'No';
            if ($admin_info->save()) {
                // Update the session activity
                $session = SessionActivityModel::where('user_id', Auth::guard('admin')->user()->admin_id)->where('user_type', 'Admin')->first();
                $session->user_id = Auth::guard('admin')->user()->admin_id;
                $session->user_type = 'Admin';
                $session->last_logout = Carbon::now();
                if ($session->save()) {
                    Auth::guard('admin')->logout();
                    return redirect('/portal');
                } else {
                    return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                }
            } else {
                return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will logout the merchant user
    public function merchant_logout() {
        try {
            $data_list = Auth::guard('merchant')->user();
            $data_list->is_logged = 'No';
            if ($data_list->save()) {
                // update the session activity
                $session = SessionActivityModel::where('user_id', Auth::guard('merchant')->user()->merchant_id)->where('user_type', 'Merchant')->first();
                $session->user_id = Auth::guard('merchant')->user()->merchant_id;
                $session->user_type = 'Merchant';
                $session->last_logout = Carbon::now();
                if ($session->save()) {
                    Auth::guard('merchant')->logout();
                    return redirect('/merchant/login');
                } else {
                    return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
                }
            } else {
                return redirect()->back()->withInput()->with('error', "Something went wrong. Please try again.");
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
