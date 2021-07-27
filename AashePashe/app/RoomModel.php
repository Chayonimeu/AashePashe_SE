<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoomModel extends Model {

    use Notifiable;

    protected $table = "room";
    protected $primaryKey = 'room_id';
    protected $guarded = 'room_id';
    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'total_room',
        'area',
        'floor',
        'window',
        'smoking',
        'wifi',
        'extra_bed',
        'occupancy',
        'bed_type_id',
        'price',
        'breakfast',
        'available_from',
        'available_days',
        'cancellation_policy',
        'image',
        'status',
    ];
    
     public function get_room_type() {
        return $this->belongsTo(RoomTypeModel::class, 'room_type_id', 'room_type_id');
    }

}
