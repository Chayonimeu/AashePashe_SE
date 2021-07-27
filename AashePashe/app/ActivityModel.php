<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ActivityModel extends Model {

    use Notifiable;

    protected $table = "activity";
    // table primary key
    protected $primaryKey = 'activity_id';
    // table fields
    protected $fillable = [
        'user_id', // Admin, Merchant, User Id
        'user_type', // Admin, Merchant, User
        'browser_name', // Browser Name
        'browser_version', // Browser Version
        'ip_address', // IP Address
        'details' // Activity Details
    ];
    // guarded primary key
    protected $guarded = ['activity_id'];

}
