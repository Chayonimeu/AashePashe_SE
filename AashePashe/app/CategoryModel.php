<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryModel extends Model {

    use Notifiable;

    protected $table = "category";
    protected $primaryKey = 'category_id';
    protected $guarded = 'category_id';
    protected $fillable = [
        'name',
        'type_name',
        'status'
    ];

}
