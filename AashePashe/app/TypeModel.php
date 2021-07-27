<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TypeModel extends Model {

    use Notifiable;

    protected $table = "type";
    protected $primaryKey = 'type_id';
    protected $guarded = 'type_id';
    protected $fillable = [
        'name'
    ];

}
