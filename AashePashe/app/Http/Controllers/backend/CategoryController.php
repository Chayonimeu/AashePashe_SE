<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\CategoryModel;
use App\TypeModel;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;

class CategoryController extends Controller {

    // This function will redirect into category list page
    public function index() {
        try {
            // Getting category data
            $data_list = CategoryModel::get();
            return view('backend.system.category.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect into category add page
    public function add() {
        try {
            // Getting type model
            $type_list = TypeModel::get();
            return view('backend.system.category.add', compact('type_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will store category information
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|unique:category|max:100',
            'type_name' => 'required',
            'status' => 'required',
        ];

        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 100 characters long',
            'type_name.required' => 'Type required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);

        try {
            // Creating new object
            $data_list = new CategoryModel();
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->type_name = $request->type_name;
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
                    $activity->details = 'Category added successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/category')->with('success', 'Category added successfully');
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

    // This function will redirect into category edit page
    public function edit($id) {
        try {
            // Getting type data
            $type_list = TypeModel::get();
            $data_list = CategoryModel::find($id); // Getting category data by category id
            return view('backend.system.category.edit', compact('data_list', 'type_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function update the category information
    public function update(Request $request) {
        // Validation rules
        $rules = [
            'name' => ['required', Rule::unique('category')->ignore($request->category_id, 'category_id'), 'max:100'],
            'type_name' => 'required',
            'status' => 'required'
        ];
        // Error messages
        $message = [
            'name.required' => 'Name required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name must be less than 100 characters long',
            'type_name.required' => 'Type required',
            'status.required' => 'Status required',
        ];

        $this->validate($request, $rules, $message);
        try {
            // Getting category data by ategory id
            $data_list = CategoryModel::find($request->category_id);
            if ($data_list) {
                $data_list->name = $request->name;
                $data_list->type_name = $request->type_name;
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
                    $activity->details = 'Category updated successfully named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/category')->with('success', 'Category updated successfully');
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

}
