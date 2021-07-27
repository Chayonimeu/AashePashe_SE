<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BedTypeModel extends Model {

    use Notifiable;

    protected $table = "bed_type";
    protected $primaryKey = 'bed_type_id';
    protected $guarded = 'bed_type_id';
    protected $fillable = [
        'name',
        'size',
        'status'
    ];
}
