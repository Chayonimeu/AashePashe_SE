<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Hash;
use App\MerchantModel;
use App\BrowserModel;
use App\ActivityModel;
use Carbon\Carbon;
use App\CountryModel;
use App\BranchModel;
use App\BranchWiseUserModel;

class MerchantUserController extends Controller {

    // This function will redirect into merchant user list page
    public function index() {
        try {
            $branch_list = BranchModel::where('root_id', Auth::guard('merchant')->user()->merchant_id)->get();
            $data_list = MerchantModel::where('is_branch_user', 'Yes')->where('root_id', Auth::guard('merchant')->user()->merchant_id)->get();
            return view('backend.system.panel.user.index', compact('data_list', 'branch_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into merchant user add page
    public function add() {
        try {
            $country_list = CountryModel::where('status', 'Active')->get();
            return view('backend.system.panel.user.add', compact("country_list"));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store the user information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:merchant|max:100',
            'phone' => 'required|numeric|unique:merchant',
            'password' => 'required|min:6|max:255',
            're_password' => 'required|min:6|max:255|required_with:password|same:password',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.max' => 'Name must be less than 100 characters',
            'email.required' => 'Email address required',
            'email.email' => 'Email address must be a valid email address',
            'email.unique' => 'Email address already exists',
            'email.max' => 'Email address must be less than 100 characters',
            'phone.required' => 'Phone number required',
            'phone.numeric' => 'Phone number must be numeric value',
            'phone.unique' => 'Phone number already exists',
            'password.required' => 'Password required',
            'password.min' => 'Password must be at least 6 characters long',
            'password.max' => 'Password can be maximum 255 characters long',
            're_password.required' => 'Confirm password required',
            're_password.min' => 'Confirm password must be at least 6 characters long',
            're_password.max' => 'Confirm password can be maximum 255 characters long',
            'status.required' => 'Status required',
        ];


        $this->validate($request, $rules, $message);

        try {
            $data_list = new MerchantModel();
            $data_list->name = $request->name;
            $data_list->email = $request->email;
            $data_list->phone = $request->phone;
            $data_list->country_code = $request->country_code;
            $data_list->password = bcrypt($request->password);
            $data_list->status = $request->status;
            $data_list->is_verified = 'Yes';
            $data_list->is_branch_user = 'Yes';
            $data_list->root_id = Auth::guard('merchant')->user()->merchant_id;

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
                $activity->details = 'User added successfully named ' . $request->name;
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/merchant/user')->with('success', 'User added successfully');
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

    // Branch wise merchant assign
    public function assign(Request $request) {
        try {
            $branch_id = $request->branch_id;
            $merchant_id = $request->merchant_id;

            if (!empty($branch_id)) {
                // Checking if merchant branch is assigned or not
                // if not assign then create
                // else update the new branch
                $check = BranchWiseUserModel::where('merchant_id', $merchant_id)->count();
                if ($check == 0) {
                    // Create new
                    foreach ($branch_id as $branch) {
                        BranchWiseUserModel::create([
                            'branch_id' => $branch,
                            'merchant_id' => $merchant_id
                        ]);
                    }
                } else {
                    // Update
                    $data_list = BranchWiseUserModel::where('merchant_id', $merchant_id)->delete();
                    foreach ($branch_id as $branch) {
                        BranchWiseUserModel::create([
                            'branch_id' => $branch,
                            'merchant_id' => $merchant_id
                        ]);
                    }
                }

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
                $activity->details = 'Branch wise user added successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/merchant/user')->with('success', 'Branch wise user added successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'Please choose the branch to assign the user');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
