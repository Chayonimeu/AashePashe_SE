<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VerificationModel extends Model {

    use Notifiable;

    protected $table = "verification";
    protected $primaryKey = 'verification_id';
    protected $guarded = 'verification_id';
    protected $fillable = [
        'user_id',
        'user_type',
        'code',
        'valid_time',
        'random_code'
    ];

}
