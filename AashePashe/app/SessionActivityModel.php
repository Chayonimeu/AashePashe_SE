<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SessionActivityModel extends Model {

    use Notifiable;

    protected $table = "session_activity";
    protected $primaryKey = 'session_activity_id';
    protected $guarded = 'session_activity_id';
    protected $fillable = [
        'user_id',
        'first_login',
        'last_login',
        'last_logout',
        'user_type' // User, Merchant, Admin
    ];

}
