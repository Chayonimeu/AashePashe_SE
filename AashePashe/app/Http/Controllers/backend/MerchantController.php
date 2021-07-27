<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\MerchantModel;
use File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Image;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;
use App\BranchModel;
class MerchantController extends Controller {

    // This function will redirect merchant list page
    public function index() {
        try {
            // Getting merchant data
            $data_list = MerchantModel::where('is_branch_user', 'No')->get();
            return view('backend.system.merchant.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect to the merchant details page by passing merchant id
    public function details($id) {
        try {
            // Getting merchant data by passing merchant id
            $data_list = MerchantModel::where('merchant_id', $id)->first();
            // Getting branch list by passing merchant id
            $branch_list = BranchModel::where('root_id', $id)->get();
            return view('backend.system.merchant.details', compact('data_list', 'branch_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will activate or deactivate the merchant
    public function activate(Request $request) {
        try {
            // Getting merchant information
            $data_list = MerchantModel::where('merchant_id', $request->merchant_id)->first();
            $data_list->status = $request->action_value;

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
                $activity->details = 'Merchant account ' . $request->action_value. ' successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    // Send email confirmation and mobile sms
                    // Need to implement later
                    return redirect()->back()->withInput()->with('success', 'Merchant account updated successfully');
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
