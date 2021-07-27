<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HotelImageModel extends Model {

    use Notifiable;

    protected $table = "hotel_image";
    protected $primaryKey = 'hotel_image_id';
    protected $guarded = 'hotel_image_id';
    protected $fillable = [
        'image',
        'root_id'
    ];

}
