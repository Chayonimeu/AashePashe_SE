<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HotelInfoModel extends Model {

    use Notifiable;

    protected $table = "hotel_info";
    protected $primaryKey = 'hotel_info_id';
    protected $guarded = 'hotel_info_id';
    protected $fillable = [
        'name',
        'root_id',
        'branch_id',
        'property_id',
        'address',
        'latitude',
        'longitude',
        'star_rating',
        'total_room',
        'opening_date',
        'renovation_date',
        'details',
        'website',
        'contact_name',
        'contact_phone',
        'contact_email',
        'certification_image',
        'hotel_image',
        'status'
    ];

    public function get_hotel_branch() {
        return $this->belongsTo(BranchModel::class, 'branch_id', 'branch_id');
    }

    public function get_hotel_property() {
        return $this->belongsTo(PropertyModel::class, 'property_id', 'property_id');
    }

}
