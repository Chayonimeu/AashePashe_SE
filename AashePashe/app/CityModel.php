<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CityModel extends Model {

    use Notifiable;

    protected $table = "city";
    protected $primaryKey = 'city_id';
    protected $guarded = 'city_id';
    protected $fillable = [
        'country_id',
        'name',
        'latitude',
        'longitude',
        'status'
    ];
}
