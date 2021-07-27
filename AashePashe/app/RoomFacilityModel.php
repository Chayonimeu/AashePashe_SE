<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoomFacilityModel extends Model {

    use Notifiable;

    protected $table = "room_facility";
    protected $primaryKey = 'room_facility_id';
    protected $guarded = 'room_facility_id';
    protected $fillable = [
        'name',
        'status'
    ];
}
