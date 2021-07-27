<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HotelFacilityModel extends Model {

    use Notifiable;

    protected $table = "hotel_facility";
    protected $primaryKey = 'hotel_facility_id';
    protected $guarded = 'hotel_facility_id';
    protected $fillable = [
        'name',
        'is_charged',
        'status'
    ];
}
