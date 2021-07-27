<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable {

    use Notifiable;

    protected $table = "admin";
    protected $primaryKey = 'admin_id';
    protected $guarded = 'admin_id';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'type', // Admin, Employee
        'status',
        'avatar',
        'password',
        'is_logged'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
