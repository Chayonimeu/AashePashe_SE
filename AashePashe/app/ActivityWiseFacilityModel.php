<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ActivityWiseFacilityModel extends Model {

    use Notifiable;

    protected $table = "activity_wise_facility";
    protected $primaryKey = 'activity_wise_facility_id';
    protected $guarded = 'activity_wise_facility_id';
    protected $fillable = [
        'hotel_id',
        'facility_id',
        'price'
    ];

}
