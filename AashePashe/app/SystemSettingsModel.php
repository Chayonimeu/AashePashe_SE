<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SystemSettingsModel extends Model {

    use Notifiable;

    protected $table = "system_settings";
    protected $primaryKey = 'system_settings_id';
    protected $guarded = 'system_settings_id';
    protected $fillable = [
        'name',
        'short_name',
        'logo',
        'facebook',
        'google',
        'twitter',
        'youtube',
        'linkedin',
        'sales_email',
        'sales_phone',
        'support_email',
        'support_phone',
        'billing_email',
        'billing_phone',
        'address',
        'about_us',
        'terms',
        'privacy',
        'is_phone_verification',
        'is_email_verification'
    ];

}
