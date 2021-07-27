<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TypeModel;

class MerchantDashboardController extends Controller {

    public function __construct() {
        $this->middleware('merchant');
    }

    // This function will redirect in merchant dashboard
    public function dashboard() {
        try {
            $type = Auth::guard('merchant')->user()->get_business_type->type_name;
            $type_name = TypeModel::where('name', $type)->select('name')->first();
            // Redirect panel based on type name
            switch ($type_name->name) {
                case 'Hotel':
                    return view('backend.system.panel.dashboard.hotel');
                case 'Flight':
                    return 'Flight';
                case 'Restaurant':
                    return 'Restaurant';
                case 'Ticket':
                    return 'Ticket';
                case 'Ticket':
                    return 'Ticket';
                case 'Shopping':
                    return 'Shopping';
                case 'Service':
                    return 'Service';
                case 'Delivery':
                    return 'Delivery';
                default :
                    return view('merchant/login');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
