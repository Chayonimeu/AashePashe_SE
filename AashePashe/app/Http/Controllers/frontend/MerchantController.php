<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Hash;
use Illuminate\Support\Facades\Storage;
use Image;
use App\CategoryModel;
use App\MerchantModel;
use Carbon\Carbon;
use App\VerificationModel;
use App\RandomNumberModel;
use App\SystemSettingsModel;
use App\CountryModel;

class MerchantController extends Controller {

    // This function will redirect into merchant registration page
    public function register() {
        try {
            // Getting country
            $country_list = CountryModel::where('status', 'Active')->get();
            // Getting business category
            $category_list = CategoryModel::where('status', 'Active')->get();
            return view('frontend/merchant/register', compact('category_list', 'country_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will save merchant information
    public function save(Request $request) {

        try {
            $random_number = new RandomNumberModel; // Creating random number object
            $mobile_code = $random_number->mobile_verification(6, 6); // Generating  mobile verification random number code
            $random_code = $random_number->random_number(5, 15) . date('YmdHis'); // Generating random number
            // Validation rules
            $rules = [
                'name' => 'required|max:100',
                'email' => 'required|email|unique:merchant|max:100',
                'phone' => 'required|numeric|unique:merchant',
                'company_name' => 'required|max:100',
                'category_id' => 'required',
                'company_logo' => 'bail|mimes:jpg,JPG,jpeg,JPEG,png,PNG',
                'company_address' => 'required|max:255',
                'password' => 'required|min:6|max:255',
                're_password' => 'required|min:6|max:255|required_with:password|same:password',
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
                'category_id.required' => 'Business type required',
                'company_name.required' => 'Company name required',
                'company_logo.mimes' => 'Logo must be a file of type: jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF',
                'company_address.required' => 'Company address required',
                'company_address.max' => 'Company address must be less than 255 characters',
                'password.required' => 'Password required',
                'password.min' => 'Password must be at least 6 characters long',
                'password.max' => 'Password can be maximum 255 characters long',
                're_password.required' => 'Confirm password required',
                're_password.min' => 'Confirm password must be at least 6 characters long',
                're_password.max' => 'Confirm password can be maximum 255 characters long',
            ];

            $this->validate($request, $rules, $message);

            $data_list = new MerchantModel();
            $data_list->name = $request->name;
            $data_list->email = $request->email;
            $data_list->phone = $request->phone;
            $data_list->country_code = $request->country_code;
            $data_list->company_name = $request->company_name;
            $data_list->company_address = $request->company_address;
            $data_list->category_id = $request->category_id;
            $data_list->password = bcrypt($request->password);
            $data_list->is_branch_user = 'No';

            if ($_FILES['company_logo']['name']) {
                $image = $request->file('company_logo');
                $img = Image::make($image->getRealPath());
                $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->company_logo->getClientOriginalExtension();
                // resize the image 600x600
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(('upload/merchant/logo/') . $image_name);
                $data_list->company_logo = $image_name;
            }
            if ($data_list->save()) {
                // Mobile verification or email address confirmation code send
                // Need to implement later :)

                $is_required = SystemSettingsModel::select('is_phone_verification')->first();
                if ($is_required->is_phone_verification == 'Yes') {
                    // Mobile verification required
                    $verification = new VerificationModel();
                    $verification->user_id = $data_list->merchant_id;
                    $verification->user_type = 'Merchant';
                    $verification->code = $mobile_code;
                    $verification->valid_time = Carbon::now()->addMinutes(15);
                    $verification->random_code = $random_code;

                    if ($verification->save()) {
                        $msg = 'A verification code ' . $mobile_code . ' send to your phone number and valid till 15 minutes ';
                        return redirect('merchant/success/' . $random_code)->with('success', $msg);
                    } else {
                        return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
                    }
                } else {
                    return redirect('merchant/register/')->with('success', 'Registration completed successfully. Please wait for system admin approval. You will get the notification after approval.');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect mobile verification page after registration
    // If mobile verification required
    public function success($id) {
        try {
            $random_code = $id;
            return view('frontend/merchant/success', compact('random_code'));
        } catch (Exception $ex) {
            return $id;
        }
    }

    // This function will validate the mobile number
    public function verification(Request $request) {
        // Validation rules
        $rules = [
            'code' => 'required|numeric|exists:verification',
        ];
        // Error messages
        $message = [
            'code.required' => 'Verification code required',
            'code.numeric' => 'Verification code must be numeric value',
            'code.exists' => 'Verification code not matched with input value',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Checking the validation code is matched or not
           return $data_list = VerificationModel::where('random_code', $request->random_code)->first();
            if ($data_list) {
                // Checking verification code
                if ($data_list->code == $request->code) {
                    // Checking validation time
                    if (Carbon::now() > $data_list->valid_time) {
                        return redirect()->back()->withInput()->with('error', 'Verification code expires already');
                    } else {
                        // Process the data
                        $merchant_info = MerchantModel::where('merchant_id', $data_list->user_id)->first();
                        $merchant_info->is_verified = "Yes";
                        if ($merchant_info->save()) {
                            return redirect('merchant/register/')->with('success', 'Registration completed successfully. Please wait for system admin approval. You will get notification after approval.');
                        } else {
                            return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
                        }
                    }
                } else {
                    return redirect()->back()->with('error', 'Verification code not matched with input value');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
