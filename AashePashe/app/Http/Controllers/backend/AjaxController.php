<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\CountryModel;
use App\CityModel;
use App\SubAreaModel;

class AjaxController extends Controller {

    public function get_city(Request $request) {
        try {
            $country_id = $_POST['country_id'];

            $data_list = CityModel::all()->where('country_id', $country_id);
            $response = array('output' => 'success', 'msg' => 'data found', 'data_list' => $data_list);
            return response()->json($response);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function get_sub_area(Request $request) {
        try {
            $city_id = $_POST['city_id'];

            $data_list = SubAreaModel::all()->where('city_id', $city_id);
            $response = array('output' => 'success', 'msg' => 'data found', 'data_list' => $data_list);
            return response()->json($response);
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
