<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SliderModel extends Model {

    use Notifiable;

    protected $table = "slider";
    protected $primaryKey = 'slider_id';
    protected $guarded = 'slider_id';
    protected $fillable = [
        'details',
        'image',
        'status'
    ];

}
