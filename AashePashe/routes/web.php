<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
// Frontend namespace
Route::group(['namespace' => 'frontend'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('login', 'HomeController@login');
    Route::get('register', 'HomeController@register');

    // User Registration
    Route::post('save', 'RegistrationController@save');
    Route::get('success/{id}', 'RegistrationController@success');
    Route::post('verification', 'RegistrationController@verification');

    // Merchant Registration
    Route::get('merchant/register', 'MerchantController@register');
    Route::post('merchant/save', 'MerchantController@save');
    Route::get('merchant/success/{id}', 'MerchantController@success');
    Route::post('merchant/verification', 'MerchantController@verification');

    // User Login
    Route::post('authenticate', 'LoginController@authenticate');

    // User Dashboard
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/logout', function () {
            Auth::logout();
            return redirect('/');
        });
        Route::get('dashboard', 'DashboardController@dashboard');
        // Change Password
        Route::get('change/password', 'DashboardController@change_password');
        Route::post('update/password', 'DashboardController@update_password');
        Route::get('update/profile', 'DashboardController@profile');
        Route::post('update/information', 'DashboardController@update_profile');
    });
});

// Backend namespace
Route::group(['namespace' => 'backend'], function() {

    // Admin, Employee Login
    Route::get('/portal', 'LoginController@index');
    // Authentication Check
    Route::post('portal/authenticate', 'LoginController@authenticate');

    // Admin Logout
    Route::get('portal/logout', 'LogoutController@logout');
    // Merchant Logout
    Route::get('portal/merchant/logout', 'LogoutController@merchant_logout');

    // Merchant Login
    Route::get('merchant/login', 'LoginController@merchant_login');
    // Merchant Authentication
    Route::post('portal/merchant/authenticate', 'LoginController@merchant_authenticate');

    // Country Wise City Ajax
    Route::POST('get_city', 'AjaxController@get_city');
    // City Wise Sub Area Ajax
    Route::POST('get_sub_area', 'AjaxController@get_sub_area');

    // Admin Middleware
    Route::group(['middleware' => ['admin']], function () {
        // Dashboard
        Route::get('portal/dashboard', 'DashboardController@dashboard');

        // Profile
        Route::get('portal/profile', 'ProfileController@profile');
        Route::post('portal/profile/update', 'ProfileController@update');
        Route::get('portal/password', 'ProfileController@password');
        Route::post('portal/password/update', 'ProfileController@change');
        Route::post('portal/profile/avatar', 'ProfileController@avatar');

        // User Settings
        Route::get('portal/admin', 'AdminController@index');
        Route::get('portal/admin/add', 'AdminController@add');
        Route::post('portal/admin/store', 'AdminController@store');
        Route::get('portal/admin/edit/{id}', 'AdminController@edit');
        Route::post('portal/admin/update', 'AdminController@update');

        // Merchant List
        Route::get('portal/merchant', 'MerchantController@index');
        Route::get('portal/merchant/details/{id}', 'MerchantController@details');
        Route::post('portal/merchant/activate', 'MerchantController@activate');

        // System User List
        Route::get('portal/user', 'UserController@index');
        Route::get('portal/user/details/{id}', 'UserController@details');

        // Country 
        Route::get('portal/country', 'CountryController@index');
        Route::get('portal/country/edit/{id}', 'CountryController@edit');
        Route::post('portal/country/update', 'CountryController@update');

        // City
        Route::get('portal/city/{id}', 'CityController@index');
        Route::get('portal/city/add/{id}', 'CityController@add');
        Route::post('portal/city/store', 'CityController@store');
        Route::get('portal/city/edit/{id}/{city_id}', 'CityController@edit');
        Route::post('portal/city/update', 'CityController@update');

        // Sub Area
        Route::get('portal/subarea/{id}', 'SubareaController@index');
        Route::get('portal/subarea/add/{id}', 'SubareaController@add');
        Route::post('portal/subarea/store', 'SubareaController@store');
        Route::get('portal/subarea/edit/{id}/{city_id}', 'SubareaController@edit');
        Route::post('portal/subarea/update', 'SubareaController@update');

        // Business Type or Category
        Route::get('portal/category', 'CategoryController@index');
        Route::get('portal/category/add', 'CategoryController@add');
        Route::post('portal/category/store', 'CategoryController@store');
        Route::get('portal/category/edit/{id}', 'CategoryController@edit');
        Route::post('portal/category/update', 'CategoryController@update');

        // Sub Category
        Route::get('portal/subcategory/{id}', 'SubCategoryController@index');
        Route::get('portal/subcategory/add/{id}', 'SubCategoryController@add');
        Route::post('portal/subcategory/store', 'SubCategoryController@store');
        Route::get('portal/subcategory/edit/{id}', 'SubCategoryController@edit');
        Route::post('portal/subcategory/update', 'SubCategoryController@update');
        Route::post('portal/subcategory/delete/', 'SubCategoryController@delete');

        // Slider
        Route::get('portal/slider', 'SliderController@index');
        Route::get('portal/slider/add', 'SliderController@add');
        Route::post('portal/slider/store', 'SliderController@store');
        Route::get('portal/slider/edit/{id}', 'SliderController@edit');
        Route::post('portal/slider/update', 'SliderController@update');
        Route::post('portal/slider/delete', 'SliderController@delete');

        // Faq
        Route::get('portal/faq', 'FaqController@index');
        Route::get('portal/faq/add', 'FaqController@add');
        Route::post('portal/faq/store', 'FaqController@store');
        Route::get('portal/faq/edit/{id}', 'FaqController@edit');
        Route::post('portal/faq/update', 'FaqController@update');
        Route::post('portal/faq/delete', 'FaqController@delete');

        // System Settings
        Route::get('portal/system', 'SystemSettingsController@index');
        Route::post('portal/system/update', 'SystemSettingsController@update');
        Route::get('portal/about', 'SystemSettingsController@about');
        Route::post('portal/about/update', 'SystemSettingsController@update_about');
        Route::get('portal/privacy', 'SystemSettingsController@privacy');
        Route::post('portal/privacy/update', 'SystemSettingsController@update_privacy');
        Route::get('portal/terms', 'SystemSettingsController@terms');
        Route::post('portal/terms/update', 'SystemSettingsController@update_terms');

        // Property Category
        Route::get('portal/property', 'PropertyController@index');
        Route::get('portal/property/add', 'PropertyController@add');
        Route::post('portal/property/store', 'PropertyController@store');
        Route::get('portal/property/edit/{id}', 'PropertyController@edit');
        Route::post('portal/property/update', 'PropertyController@update');

        // Bed Type
        Route::get('portal/bedtype', 'BedTypeController@index');
        Route::get('portal/bedtype/add', 'BedTypeController@add');
        Route::post('portal/bedtype/store', 'BedTypeController@store');
        Route::get('portal/bedtype/edit/{id}', 'BedTypeController@edit');
        Route::post('portal/bedtype/update', 'BedTypeController@update');

        // Room Type
        Route::get('portal/roomtype', 'RoomTypeController@index');
        Route::get('portal/roomtype/add', 'RoomTypeController@add');
        Route::post('portal/roomtype/store', 'RoomTypeController@store');
        Route::get('portal/roomtype/edit/{id}', 'RoomTypeController@edit');
        Route::post('portal/roomtype/update', 'RoomTypeController@update');

        // Hotel Facility
        Route::get('portal/hotel/facility', 'HotelFacilityController@index');
        Route::get('portal/hotel/facility/add', 'HotelFacilityController@add');
        Route::post('portal/hotel/facility/store', 'HotelFacilityController@store');
        Route::get('portal/hotel/facility/edit/{id}', 'HotelFacilityController@edit');
        Route::post('portal/hotel/facility/update', 'HotelFacilityController@update');

        // Activity Facility
        Route::get('portal/activity/facility', 'ActivityFacilityController@index');
        Route::get('portal/activity/facility/add', 'ActivityFacilityController@add');
        Route::post('portal/activity/facility/store', 'ActivityFacilityController@store');
        Route::get('portal/activity/facility/edit/{id}', 'ActivityFacilityController@edit');
        Route::post('portal/activity/facility/update', 'ActivityFacilityController@update');

        // Room Facility
        Route::get('portal/room/facility', 'RoomFacilityController@index');
        Route::get('portal/room/facility/add', 'RoomFacilityController@add');
        Route::post('portal/room/facility/store', 'RoomFacilityController@store');
        Route::get('portal/room/facility/edit/{id}', 'RoomFacilityController@edit');
        Route::post('portal/room/facility/update', 'RoomFacilityController@update');
    });

    // Merchant middleware setup
    Route::group(['middleware' => ['merchant']], function () {
        // Dashboard
        Route::get('portal/merchant/dashboard', 'MerchantDashboardController@dashboard');
        // Profile
        Route::get('portal/merchant/profile', 'MerchantProfileController@profile');
        Route::post('portal/merchant/profile/update', 'MerchantProfileController@update');
        Route::get('portal/merchant/password', 'MerchantProfileController@password');
        Route::post('portal/merchant/password/update', 'MerchantProfileController@change');
        Route::post('portal/merchant/profile/avatar', 'MerchantProfileController@avatar');
        Route::post('portal/merchant/logo', 'MerchantProfileController@logo');

        // Branch
        Route::get('portal/merchant/branch', 'BranchController@index');
        Route::get('portal/merchant/branch/add', 'BranchController@add');
        Route::post('portal/merchant/branch/store', 'BranchController@store');

        // Merchant user
        Route::get('portal/merchant/user', 'MerchantUserController@index');
        Route::get('portal/merchant/user/add', 'MerchantUserController@add');
        Route::post('portal/merchant/user/store', 'MerchantUserController@store');
        Route::post('portal/merchant/assign', 'MerchantUserController@assign');

        // Hotel Merchant Routing
        Route::get('portal/merchant/hotel', 'HotelController@index');
        Route::get('portal/merchant/hotel/add', 'HotelController@add');
        Route::post('portal/merchant/hotel/store', 'HotelController@store');
        Route::get('portal/merchant/hotel/edit/{id}', 'HotelController@edit');
        Route::post('portal/merchant/hotel/update', 'HotelController@update');
        Route::get('portal/merchant/hotel/images/{id}', 'HotelController@images');
        Route::post('portal/merchant/hotel/images/store', 'HotelController@store_images');

        // Hotel Rooms
        Route::get('portal/merchant/hotel/rooms/{id}', 'HotelController@rooms');
        Route::get('portal/merchant/hotel/rooms/add/{id}', 'HotelController@add_rooms');
        Route::post('portal/merchant/hotel/rooms/store_rooms', 'HotelController@store_rooms');

        // Hotel Wise Facility
        Route::get('portal/merchant/hotel/facilities/{id}', 'HotelController@hotel_facilities');
        Route::post('portal/merchant/hotel/facilities/store', 'HotelController@store_hotel_facilities');

        // Hotel Activity Wise Facility
        Route::get('portal/merchant/hotel/activity/facilities/{id}', 'HotelController@hotel_activity_facilities');
        Route::post('portal/merchant/hotel/activity/facilities/store', 'HotelController@store_hotel_activity_facilities');
    });
});
