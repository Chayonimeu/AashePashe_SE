<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\AdminModel;
use File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Image;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class AdminController extends Controller {

    // This function will redirect into admin list page
    public function index() {
        try {
            // Getting admin list
            $data_list = AdminModel::get();
            return view('backend.system.admin.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into new admin add page
    public function add() {
        return view('backend.system.admin.add');
    }

    // This function will store admin information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:admin|max:100',
            'phone' => 'required|numeric|unique:admin',
            'password' => 'required|min:6|max:255',
            'type' => 'required',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.max' => 'Name must be less than 100 characters',
            'email.required' => 'Email required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email address already exists',
            'email.max' => 'Email address must be less than 100 characters',
            'phone.required' => 'Phone number required',
            'phone.numeric' => 'Phone number must be numeric value',
            'phone.unique' => 'Phone number already exists',
            'password.required' => 'Password required',
            'password.min' => 'Password must be 6 characters long',
            'password.max' => 'Password may not be greater than 255 characters',
            'type.required' => 'Type required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Creating new admin object
            $data_list = new AdminModel();
            $data_list->name = $request->name;
            $data_list->email = $request->email;
            $data_list->phone = $request->phone;
            $data_list->type = $request->type;
            $data_list->status = $request->status;
            $data_list->password = bcrypt($request->password); // Encrypt password
            $data_list->created_at = Carbon::now(); // Carbon::now will generate the creation date time

            if ($request->file('avatar')) { // If image file posted
                $image = $request->file('avatar');
                $img = Image::make($image->getRealPath());
                // Rename the posted image
                $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->avatar->getClientOriginalExtension();
                // resize the image 300x300
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(('upload/admin/avatar/') . $image_name); // Image upload path
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
                $activity->user_id = Auth::guard('admin')->user()->admin_id;
                $activity->user_type = 'Admin';
                $activity->details = 'Portal user account created named ' . $request->name;
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/admin')->with('success', 'Portal user account created successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong. Please try again');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect admin edit page
    public function edit($id) {
        try {
            // Getting admin data by passing admin id
            $data_list = AdminModel::where('admin_id', $id)->first();
            return view('backend.system.admin.edit', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update admin information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|max:100',
            'email' => ['required', 'email', Rule::unique('admin')->ignore($request->admin_id, 'admin_id'), 'max:100'],
            'phone' => ['required', 'numeric', Rule::unique('admin')->ignore($request->admin_id, 'admin_id')],
            'type' => 'required',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.max' => 'Name must be less than 100 characters',
            'email.required' => 'Email required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email address already exists',
            'email.max' => 'Email address must be less than 100 characters',
            'phone.required' => 'Phone number required',
            'phone.numeric' => 'Phone number must be numeric value',
            'phone.unique' => 'Phone number already exists',
            'type.required' => 'Type required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting admin data by passing admin id
            $data_list = AdminModel::where('admin_id', $request->admin_id)->first();
            $data_list->name = $request->name;
            $data_list->email = $request->email;
            $data_list->phone = $request->phone;
            $data_list->type = $request->type;
            $data_list->status = $request->status;

            $pre_image = $data_list->avatar; // Getting pervious image
            if ($_FILES['avatar']['name']) { // if image posted
                if ($pre_image != '') {
                    $admin_image = public_path("upload/admin/avatar/" . $data_list->avatar); // get previous image from folder

                    if (File::exists($admin_image)) { // unlink or remove previous image from folder
                        unlink($admin_image);
                    }
                }
                $image = $request->file('avatar');
                $img = Image::make($image->getRealPath());
                $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->avatar->getClientOriginalExtension();
                // Resize image
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(('upload/admin/avatar/') . $image_name); // Upload path
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
                $activity->user_id = Auth::guard('admin')->user()->admin_id;
                $activity->user_type = 'Admin';
                $activity->details = 'Portal user account updated named ' . $request->name;
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/admin')->with('success', 'Portal user account updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong, please try again');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
