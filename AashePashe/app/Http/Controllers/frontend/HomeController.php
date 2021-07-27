<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CountryModel;
class HomeController extends Controller {

    public function index() {
        return view('frontend/index');
    }

    public function login() {
        return view('frontend/login');
    }

    public function register() {
        $country_list = CountryModel::where('status', 'Active')->get();
        return view('frontend/register', compact('country_list'));
    }

    public function verify(Request $request) {
        return view('frontend/verify');
    }

}
