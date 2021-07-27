<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    protected $table = "user";
    protected $primaryKey = 'user_id';
    protected $guarded = 'user_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country_code',
        'gender',
        'dob',
        'address',
        'country_id',
        'city_id',
        'avatar',
        'status',
        'is_verified',
        'password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

}
