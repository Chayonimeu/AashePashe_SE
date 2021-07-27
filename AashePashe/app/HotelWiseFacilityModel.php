<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HotelWiseFacilityModel extends Model {

    use Notifiable;

    protected $table = "hotel_wise_facility";
    protected $primaryKey = 'hotel_wise_facility_id';
    protected $guarded = 'hotel_wise_facility_id';
    protected $fillable = [
        'hotel_id',
        'facility_id',
        'price'
    ];
}
