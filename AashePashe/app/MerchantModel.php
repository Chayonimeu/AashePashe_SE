<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MerchantModel extends Authenticatable {

    use Notifiable;

    protected $table = "merchant";
    protected $primaryKey = 'merchant_id';
    protected $guarded = 'merchant_id';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country_code',
        'avatar',
        'category_id',
        'company_name',
        'company_logo',
        'company_address',
        'status',
        'is_verified',
        'root_id',
        'is_branch_user',
        'is_logged',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function get_business_type() {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }
}
