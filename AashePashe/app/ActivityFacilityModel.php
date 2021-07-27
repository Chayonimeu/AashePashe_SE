<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ActivityFacilityModel extends Model {

    use Notifiable;

    protected $table = "activity_facility";
    protected $primaryKey = 'activity_facility_id';
    protected $guarded = 'activity_facility_id';
    protected $fillable = [
        'name',
        'status'
    ];
}
