<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoomTypeModel extends Model {

    use Notifiable;

    protected $table = "room_type";
    protected $primaryKey = 'room_type_id';
    protected $guarded = 'room_type_id';
    protected $fillable = [
        'name',
        'status'
    ];
}
