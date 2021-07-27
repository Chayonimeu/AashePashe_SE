<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubCategoryModel extends Model {

    use Notifiable;

    protected $table = "sub_category";
    protected $primaryKey = 'sub_category_id';
    protected $guarded = 'sub_category_id';
    protected $fillable = [
        'category_id',
        'name',
        'status'
    ];

}
