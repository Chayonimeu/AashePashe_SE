<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoomWiseFacilityModel extends Model {

    use Notifiable;

    protected $table = "room_wise_facility";
    protected $primaryKey = 'room_wise_facility_id';
    protected $guarded = 'room_wise_facility_id';
    protected $fillable = [
        'name',
        'status'
    ];
}
