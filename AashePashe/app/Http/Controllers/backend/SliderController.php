<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\SliderModel;
use Illuminate\Support\Facades\Storage;
use File;
use Image;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class SliderController extends Controller {

    // This function will redirect into slider list page
    public function index() {
        try {
            $data_list = SliderModel::paginate(9);
            return view('backend.system.slider.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into slider add page
    public function add() {
        return view('backend.system.slider.add');
    }

    // This function will redirect into slider edit page
    public function edit($id) {
        try {
            // Getting slider information by passing slider id
            $data_list = SliderModel::find($id);
            return view('backend.system.slider.edit', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store slider informaiton
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'image' => 'bail|required|nullable|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF|max:2048',
            'details' => 'max:255',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'image.required' => 'Image required',
            'image.mimes' => 'Image must be a file of type: jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF',
            'image.max' => 'Image may not be greater than 2 MB',
            'details.max' => 'Text must be less than 255 characters',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Creating slider object
            $data_list = new SliderModel();
            if ($data_list) {
                $data_list->details = $request->details;
                $data_list->status = $request->status;
                if ($request->file('image')) { // If image file posted
                    $image = $request->file('image');
                    $img = Image::make($image->getRealPath());
                    // Rename the posted image
                    $imageName = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->image->getClientOriginalExtension();
                    // resize the image 300x300
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(('upload/slider/') . $imageName); // Image upload path
                    $data_list->image = $imageName;
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
                    $activity->details = 'Slider added successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/slider')->with('success', 'Slider added successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
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

    // This function will update slider information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'image' => 'bail|nullable|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF|max:2048',
            'details' => 'max:255',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'image.mimes' => 'Image must be a file of type: jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF',
            'image.max' => 'Image may not be greater than 2 MB',
            'details.max' => 'Text must be less than 255 characters',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting slider information by passing slider id
            $data_list = SliderModel::find($request->slider_id);
            if ($data_list) {
                $data_list->details = $request->details;
                $data_list->status = $request->status;

                $pre_image = $data_list->image; // Getting pervious image
                if ($_FILES['image']['name']) { // if image posted
                    if ($pre_image != '') {
                        $slider_image = public_path("upload/slider/" . $data_list->image); // get previous image from folder
                        if (File::exists($slider_image)) { // unlink or remove previous image from folder
                            unlink($slider_image);
                        }
                    }
                    $image = $request->file('image');
                    $img = Image::make($image->getRealPath());
                    $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->image->getClientOriginalExtension();
                    // Resize image
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(('upload/slider/') . $image_name); // Upload path
                    $data_list->image = $image_name;
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
                    $activity->details = 'Slider updated successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/slider')->with('success', 'Slider updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
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

    // This function will permanently delete slider information
    public function delete(Request $request) {
        try {
            $slider_id = $request->slider_id;
            $data_list = SliderModel::find($slider_id);
            // Unlink previous image if exists
            if ($data_list->image != NULL) {
                $Image = public_path("upload/slider/" . $data_list->image); // get previous image from folder
                if (File::exists($Image)) { // unlink or remove previous image from folder
                    unlink($Image);
                }
            }

            SliderModel::where('slider_id', $slider_id)->delete();
            return redirect('portal/slider')->with('success', 'Slider deleted successfully');
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
