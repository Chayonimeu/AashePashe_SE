<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\PropertyModel;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\BrowserModel;
use App\ActivityModel;
use App\BranchModel;
use App\HotelInfoModel;
use Image;
use Illuminate\Support\Facades\Storage;
use App\HotelImageModel;
use App\HotelWiseFacilityModel;
use App\HotelFacilityModel;
use App\ActivityFacilityModel;
use App\ActivityWiseFacilityModel;
use App\RoomModel;
use App\RoomTypeModel;
use App\BedTypeModel;

class HotelController extends Controller {

    // This function will redirect into hotel list page
    public function index() {
        try {
            $data_list = HotelInfoModel::get();
            return view('backend.system.panel.hotel.index', compact('data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // This funciton will redirecct into add hotel page
    public function add() {
        try {
            $property_list = PropertyModel::where('status', 'Active')->get();
            $branch_list = BranchModel::where('root_id', Auth::guard('merchant')->user()->merchant_id)->get();
            return view('backend.system.panel.hotel.add', compact('property_list', 'branch_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function store(Request $request) {
        // Validation rules
        $rules = [
            'branch_id' => 'required',
            'property_id' => 'required',
            'name' => 'required|max:255',
            'address' => 'required',
            'hotel_image' => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF',
            'certification_image' => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF',
            'opening_date' => 'required',
            'star_rating' => 'required',
            'total_room' => 'required',
            'details' => 'required'
        ];

        // Error messages
        $message = [
            'branch_id.required' => 'Branch required',
            'property_id.required' => 'Property category required',
            'name.required' => 'Hotel name required',
            'name.max' => 'Hotel name must be less than 255 characters',
            'address.required' => 'Hotel address required',
            'hotel_image.required' => 'Hotel image required',
            'hotel_image.mimes' => 'Image must be a file of type: jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF',
            'certification_image.required' => 'Certification image required',
            'certification_image.mimes' => 'Image must be a file of type: jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF',
            'opening_date.required' => 'Opening date required',
            'star_rating.required' => 'Rating required',
            'total_room.required' => 'Total room required',
            'details.required' => 'Details required',
        ];

        $this->validate($request, $rules, $message);

        try {
            $data_list = new HotelInfoModel();
            if ($data_list) {
                $data_list->root_id = $request->root_id;
                $data_list->branch_id = $request->branch_id;
                $data_list->property_id = $request->property_id;
                $data_list->name = $request->name;
                $data_list->address = $request->address;
                $data_list->latitude = $request->latitude;
                $data_list->longitude = $request->longitude;
                $data_list->opening_date = $request->opening_date;
                $data_list->renovation_date = $request->renovation_date;
                $data_list->star_rating = $request->star_rating;
                $data_list->total_room = $request->total_room;
                $data_list->details = $request->details;
                $data_list->website = $request->website;
                $data_list->contact_name = $request->contact_name;
                $data_list->contact_phone = $request->contact_phone;
                $data_list->contact_email = $request->contact_email;
                $data_list->status = 'Active';

                if ($_FILES['hotel_image']['name']) {

                    $image = $request->file('hotel_image');
                    $img = Image::make($image->getRealPath());
                    $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->hotel_image->getClientOriginalExtension();
                    // resize the image 600x600
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(('upload/hotel/') . $image_name); // Upload Path
                    $data_list->hotel_image = $image_name;
                }
                if ($_FILES['certification_image']['name']) {

                    $image1 = $request->file('certification_image');
                    $img1 = Image::make($image1->getRealPath());
                    $image_name1 = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->certification_image->getClientOriginalExtension();
                    // resize the image 600x600
                    $img1->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(('upload/hotel/') . $image_name1); // Upload Path
                    $data_list->certification_image = $image_name1;
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
                    $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                    $activity->user_type = 'Merchant';
                    $activity->details = 'Hotel added named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/merchant/hotel')->with('success', 'Hotel basic information added successfully');
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

    public function edit($id) {
        try {
            $property_list = PropertyModel::where('status', 'Active')->get();
            $branch_list = BranchModel::where('root_id', Auth::guard('merchant')->user()->merchant_id)->get();
            $data_list = HotelInfoModel::find($id);
            return view('backend.system.panel.hotel.edit', compact('property_list', 'branch_list', 'data_list'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function update(Request $request) {
        // Validation rules
        $rules = [
            'branch_id' => 'required',
            'property_id' => 'required',
            'name' => 'required|max:255',
            'address' => 'required',
            'opening_date' => 'required',
            'star_rating' => 'required',
            'total_room' => 'required',
            'details' => 'required'
        ];

        // Error messages
        $message = [
            'branch_id.required' => 'Branch required',
            'property_id.required' => 'Property category required',
            'name.required' => 'Hotel name required',
            'name.max' => 'Hotel name must be less than 255 characters',
            'address.required' => 'Hotel address required',
            'opening_date.required' => 'Opening date required',
            'star_rating.required' => 'Rating required',
            'total_room.required' => 'Total room required',
            'details.required' => 'Details required',
        ];

        $this->validate($request, $rules, $message);

        try {
            $data_list = HotelInfoModel::find($request->hotel_info_id);
            if ($data_list) {
                $data_list->root_id = $request->root_id;
                $data_list->branch_id = $request->branch_id;
                $data_list->property_id = $request->property_id;
                $data_list->name = $request->name;
                $data_list->address = $request->address;
                $data_list->latitude = $request->latitude;
                $data_list->longitude = $request->longitude;
                $data_list->opening_date = $request->opening_date;
                $data_list->renovation_date = $request->renovation_date;
                $data_list->star_rating = $request->star_rating;
                $data_list->total_room = $request->total_room;
                $data_list->details = $request->details;
                $data_list->website = $request->website;
                $data_list->contact_name = $request->contact_name;
                $data_list->contact_phone = $request->contact_phone;
                $data_list->contact_email = $request->contact_email;
                $data_list->status = 'Active';

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
                    $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                    $activity->user_type = 'Merchant';
                    $activity->details = 'Hotel information updated named ' . $request->name;
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/merchant/hotel')->with('success', 'Hotel basic information updated successfully');
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

    public function images($id) {
        $data_list = HotelInfoModel::where('hotel_info_id', $id)->select('hotel_info_id', 'name', 'hotel_image', 'certification_image')->first();
        $hotel_image = HotelImageModel::where('root_id', $id)->get();
        return view('backend.system.panel.hotel.images', compact('data_list', 'hotel_image'));
    }

    public function store_images(Request $request) {
        $total = count($_FILES['image']['name']);
        if ($total > 10) {
            return redirect()->back()->withInput()->with('error', 'Please chosse or select maximum 10 images at a time');
        } else {

            if ($request->hasfile('image')) {
                foreach ($request->file('image') as $image) {
                    $name = $image->getClientOriginalName();
                    $extension = pathinfo($name, PATHINFO_EXTENSION); // Get image extension
                    $rename_image = uniqid() . '.' . $extension;
                    $image->move(public_path() . '/upload/hotel/', $rename_image);

                    HotelImageModel::create([
                        'root_id' => $request->hotel_info_id,
                        'image' => $rename_image
                    ]);
                }
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
                $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                $activity->user_type = 'Merchant';
                $activity->details = 'Hotel images added successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/merchant/hotel/images/' . $request->hotel_info_id)->with('success', 'Hotel images added successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            }
        }
    }

    public function hotel_facilities($id) {
        try {
            $data_list = HotelInfoModel::where('hotel_info_id', $id)->select('hotel_info_id', 'name')->first();
            $hotel_facility = HotelFacilityModel::where('status', 'Active')->get();
            return view('backend.system.panel.hotel.hotel_facility', compact('data_list', 'hotel_facility'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function store_hotel_facilities(Request $request) {
        try {
            $hotel_id = $request->hotel_id;
            $facility_id = $request->facility_id;

            if (!empty($facility_id)) {

                $check = HotelWiseFacilityModel::where('hotel_id', $hotel_id)->count();
                if ($check == 0) {
                    // Create new
                    foreach ($facility_id as $facility) {
                        HotelWiseFacilityModel::create([
                            'hotel_id' => $hotel_id,
                            'facility_id' => $facility,
                            'created_at' => Carbon::now()
                        ]);
                    }
                } else {
                    // Update
                    $data_list = HotelWiseFacilityModel::where('hotel_id', $hotel_id)->delete();
                    foreach ($facility_id as $facility) {
                        HotelWiseFacilityModel::create([
                            'hotel_id' => $hotel_id,
                            'facility_id' => $facility,
                            'created_at' => Carbon::now()
                        ]);
                    }
                }

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
                $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                $activity->user_type = 'Merchant';
                $activity->details = 'Hotel wise facility added successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/merchant/hotel/facilities/' . $hotel_id)->with('success', 'Hotel wise facility added successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'Please choose the branch to assign the user');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function hotel_activity_facilities($id) {
        try {
            $data_list = HotelInfoModel::where('hotel_info_id', $id)->select('hotel_info_id', 'name')->first();
            $activity_facility = ActivityFacilityModel::where('status', 'Active')->get();
            return view('backend.system.panel.hotel.activity_facility', compact('data_list', 'activity_facility'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function store_hotel_activity_facilities(Request $request) {
        try {
            $hotel_id = $request->hotel_id;
            $facility_id = $request->facility_id;

            if (!empty($facility_id)) {

                $check = ActivityWiseFacilityModel::where('hotel_id', $hotel_id)->count();
                if ($check == 0) {
                    // Create new
                    foreach ($facility_id as $facility) {
                        ActivityWiseFacilityModel::create([
                            'hotel_id' => $hotel_id,
                            'facility_id' => $facility,
                            'created_at' => Carbon::now()
                        ]);
                    }
                } else {
                    // Update
                    $data_list = ActivityWiseFacilityModel::where('hotel_id', $hotel_id)->delete();
                    foreach ($facility_id as $facility) {
                        ActivityWiseFacilityModel::create([
                            'hotel_id' => $hotel_id,
                            'facility_id' => $facility,
                            'created_at' => Carbon::now()
                        ]);
                    }
                }

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
                $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                $activity->user_type = 'Merchant';
                $activity->details = 'Activity wise facility added successfully';
                $activity->created_at = Carbon::now();
                if ($activity->save()) {
                    return redirect('portal/merchant/hotel/activity/facilities/' . $hotel_id)->with('success', 'Activity wise facility added successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'Please choose the branch to assign the user');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function rooms($id) {
        $data_list = HotelInfoModel::where('hotel_info_id', $id)->select('hotel_info_id', 'name')->first();
        $room_list = RoomModel::where('hotel_id', $id)->get();
        return view('backend.system.panel.hotel.room', compact('data_list', 'room_list'));
    }

    public function add_rooms($id) {
        $data_list = HotelInfoModel::where('hotel_info_id', $id)->select('hotel_info_id', 'name')->first();
        $room_type = RoomTypeModel::where('status', 'Active')->get();
        $bed_type = BedTypeModel::where('status', 'Active')->get();
        return view('backend.system.panel.hotel.add_room', compact('data_list', 'room_type', 'bed_type'));
    }

    public function store_rooms(Request $request) {

        // Validation rules
        $rules = [
            'room_type_id' => 'required',
            'total_room' => 'required',
            'area' => 'required',
            'smoking' => 'required',
            'wifi' => 'required',
            'extra_bed' => 'required',
            'occupancy' => 'required',
            'bed_type_id' => 'required',
            'price' => 'required',
            'available_from' => 'required',
            'breakfast' => 'required',
            'cancellation_policy' => 'required',
        ];

        // Error messages
        $message = [
            'room_type_id.required' => 'Room type required',
            'total_room.required' => 'Total no of rooms required',
            'area.required' => 'Area required',
            'window.required' => 'Window required',
            'smoking.required' => 'Smoking required',
            'wifi.required' => 'WiFi required',
            'extra_bed.required' => 'Extra bed required',
            'occupancy.required' => 'Occupancy required',
            'bed_type_id.required' => 'Bed type required',
            'price.required' => 'Price required',
            'available_from.required' => 'Effective date required',
            'available_from.required' => 'Effective date required',
            'breakfast.required' => 'Breakfast required',
            'cancellation_policy.required' => 'Cancellation policy required',
        ];


        $this->validate($request, $rules, $message);
        $available_days = '';
        if (!empty($request->available_days)) {
            $available_days = implode(',', $request->available_days);
        } else {
            $available_days = '';
        }

        try {
            $data_list = new RoomModel();
            if ($data_list) {
                $data_list->hotel_id = $request->hotel_id;
                $data_list->room_type_id = $request->room_type_id;
                $data_list->total_room = $request->total_room;
                $data_list->area = $request->area;
                $data_list->floor = $request->floor;
                $data_list->window = $request->window;
                $data_list->smoking = $request->smoking;
                $data_list->wifi = $request->wifi;
                $data_list->extra_bed = $request->extra_bed;
                $data_list->occupancy = $request->occupancy;
                $data_list->bed_type_id = $request->bed_type_id;
                $data_list->price = $request->price;
                $data_list->available_from = $request->available_from;
                $data_list->available_days = $available_days;
                $data_list->breakfast = $request->breakfast;
                $data_list->cancellation_policy = $request->cancellation_policy;
                $data_list->status = 'Active';
                if ($request->file('image')) { // If image file posted
                    $image = $request->file('image');
                    $img = Image::make($image->getRealPath());
                    // Rename the posted image
                    $image_name = date('YmdHis') . uniqid() . rand(5, 10) . '.' . $request->image->getClientOriginalExtension();
                    // resize the image 300x300
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(('upload/hotel/room/') . $image_name); // Image upload path
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
                    $activity->user_id = Auth::guard('merchant')->user()->merchant_id;
                    $activity->user_type = 'Merchant';
                    $activity->details = 'Room added successfully';
                    $activity->created_at = Carbon::now();
                    if ($activity->save()) {
                        return redirect('portal/merchant/hotel/rooms/' . $request->hotel_id)->with('success', 'Room added successfully');
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
