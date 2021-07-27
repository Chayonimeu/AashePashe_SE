<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }

    // This function will redirect in admin dashboard
    public function dashboard() {
        return view('backend.dashboard');
    }

}
