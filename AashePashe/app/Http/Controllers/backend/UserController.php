<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller {

    // This function will redirect user list page
    public function index() {
        try {
            // Getting user data
            $data_list = User::get();
            return view('backend.system.user.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This function will redirect to the user details page by passing user id
    public function details($id) {
        try {
            // Getting user data by passing user id
            $data_list = User::where('user_id', $id)->first();
            return view('backend.system.user.details', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
