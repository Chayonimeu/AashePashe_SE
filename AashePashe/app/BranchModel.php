<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BranchModel extends Model {

    use Notifiable;

    protected $table = "branch";
    protected $primaryKey = 'branch_id';
    protected $guarded = 'branch_id';
    protected $fillable = [
        'name',
        'country_id',
        'city_id',
        'sub_area_id',
        'address',
        'contact_name',
        'contact_email',
        'contact_phone',
        'root_id',
        'status'
    ];

    // This function will get the branch wise country data
    public function get_branch_country() {
        return $this->belongsTo(CountryModel::class, 'country_id', 'country_id');
    }

    // This function will get the branch wise city data
    public function get_branch_city() {
        return $this->belongsTo(CityModel::class, 'city_id', 'city_id');
    }
    
    // This function will get the branch wise sub area data
    public function get_branch_sub_area() {
        return $this->belongsTo(SubAreaModel::class, 'sub_area_id', 'sub_area_id');
    }

}
