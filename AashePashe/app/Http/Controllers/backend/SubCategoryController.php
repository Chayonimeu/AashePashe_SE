<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\SubCategoryModel;
use App\CategoryModel;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class SubCategoryController extends Controller {

    // This function will redirect into subcategory page by passing category id
    public function index($id) {
        try {
            // Getting category data by category id
            $category_info = CategoryModel::where('category_id', $id)->first();
            // Getting sub category data by passing category id
            $data_list = SubCategoryModel::where('category_id', $id)->get();
            return view('backend.system.subcategory.index', compact('data_list', 'category_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect to subcategory add page
    public function add($id) {
        try {
            // Getting category data by passing category id
            $category_info = CategoryModel::where('category_id', $id)->first();
            return view('backend.system.subcategory.add', compact('category_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store sub category information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:sub_category|max:100',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 100 characters long',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Creating subcategory object
            $data_list = new SubCategoryModel();
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->category_id = $request->category_id;
                $data_list->status = $request->status;

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
                    $activity->details = 'Sub category added successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/subcategory/' . $request->category_id)->with('success', 'Sub category added successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
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

    // This function will redirect to subcategory edit page by passing subcategory id
    public function edit($id) {
        try {
            // Getting sub category data by passing sub category id
            $data_list = SubCategoryModel::find($id);
            // Getting category data by passing category root id
            $category_info = CategoryModel::where('category_id', $data_list->category_id)->first();
            return view('backend.system.subcategory.edit', compact('data_list', 'category_info'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will update subcategory data
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('sub_category')->ignore($request->sub_category_id, 'sub_category_id'), 'max:100'],
            'status' => 'required'
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 100 characters long',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Getting subcategory data by passing subcategory id and creating object
            $data_list = SubCategoryModel::find($request->sub_category_id);
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->status = $request->status;

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
                    $activity->details = 'Sub category updated successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/subcategory/' . $request->sub_category_id)->with('success', 'Sub category updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
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

    // This function will permanently delete subcategory data
    public function delete(Request $request) {
        try {
            // Delete subcategory data by passing subcategory od
            SubCategoryModel::where('sub_category_id', $request->sub_category_id)->delete();
            return redirect()->back()->with('success', 'Sub category deleted successfully');
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
