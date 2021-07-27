<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubAreaModel extends Model {

    use Notifiable;

    protected $table = "sub_area";
    protected $primaryKey = 'sub_area_id';
    protected $guarded = 'sub_area_id';
    protected $fillable = [
        'name',
        'city_id',
        'latitude',
        'longitude',
        'status'
    ];

}
