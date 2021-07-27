<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PropertyModel extends Model {

    use Notifiable;

    protected $table = "property";
    protected $primaryKey = 'property_id';
    protected $guarded = 'property_id';
    protected $fillable = [
        'name',
        'details',
        'status'
    ];

}
