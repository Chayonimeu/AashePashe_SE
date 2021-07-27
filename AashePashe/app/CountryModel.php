<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CountryModel extends Authenticatable {

    use Notifiable;

    protected $table = "country";
    protected $primaryKey = 'country_id';
    protected $guarded = 'country_id';
    protected $fillable = [
        'name',
        'short_name',
        'code',
        'currency_symbol',
        'currency_name',
        'status'
    ];

}
