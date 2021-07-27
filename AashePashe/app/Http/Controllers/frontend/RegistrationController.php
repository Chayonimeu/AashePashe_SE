<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
use Carbon\Carbon;
use App\VerificationModel;
use App\RandomNumberModel;
use App\SystemSettingsModel;

class RegistrationController extends Controller {

    public function save(Request $request) {
        $random_number = new RandomNumberModel;
        $mobile_code = $random_number->mobile_verification(6, 6);
        $random_code = $random_number->random_number(5, 15) . date('YmdHis');

        $rules = [
            'phone' => 'required|numeric|unique:user',
            'password' => 'required|min:6|max:255',
            're_password' => 'required|min:6|max:255|required_with:password|same:password',
        ];

        $message = [
            'phone.required' => 'Phone number required',
            'phone.numeric' => 'Phone number must be numeric value',
            'phone.unique' => 'Phone number already exists',
            'password.required' => 'Password required',
            'password.min' => 'Password must be at least 6 characters long',
            'password.max' => 'Password can be maximum 255 characters long',
            're_password.required' => 'Confirm password required',
            're_password.min' => 'Confirm password must be at least 6 characters long',
            're_password.max' => 'Confirm password can be maximum 255 characters long',
            're_password.same' => 'Password and confirm password must be same',
        ];

        $this->validate($request, $rules, $message);

        $data_list = new User();
        $data_list->phone = $request->phone;
        $data_list->country_code = $request->country_code;
        $data_list->password = bcrypt($request->password);
        $data_list->status = 'Active';

        if ($data_list->save()) {
            $is_required = SystemSettingsModel::select('is_phone_verification')->first();
            if ($is_required->is_phone_verification == 'Yes') {
                // Mobile verification required
                $verification = new VerificationModel();
                $verification->user_id = $data_list->user_id;
                $verification->user_type = 'User';
                $verification->code = $mobile_code;
                $verification->valid_time = Carbon::now()->addMinutes(15);
                $verification->random_code = $random_code;

                if ($verification->save()) {
                    $msg = 'A verification code ' . $mobile_code . ' send to your phone number and valid till 15 minutes ';
                    return redirect('success/' . $random_code)->with('success', $msg);
                } else {
                    return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
                }
            } else {
                return redirect('register/')->with('success', 'Registration completed successfully. Please secret your credentials.');
            }
        } else {
            return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again.');
        }
    }

    public function success($id) {
        $random_code = $id;
        return view('frontend/success', compact('random_code'));
    }

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
            $data_list = VerificationModel::where('random_code', $request->random_code)->first();
            if ($data_list) {
                // Checking verification code
                if ($data_list->code == $request->code) {
                    // Checking validation time
                    if (Carbon::now() > $data_list->valid_time) {
                        return redirect()->back()->withInput()->with('error', 'Verification code expires already');
                    } else {
                        // Process the data
                        $user_info = User::where('user_id', $data_list->user_id)->first();
                        $user_info->is_verified = "Yes";
                        if ($user_info->save()) {
                            return redirect('register/')->with('success', 'Registration completed successfully. Please secret your credentials.');
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
