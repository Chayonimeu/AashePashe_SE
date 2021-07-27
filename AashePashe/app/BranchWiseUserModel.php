<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BranchWiseUserModel extends Model {

    use Notifiable;

    protected $table = "branch_wise_user";
    protected $primaryKey = 'bwu_id';
    protected $guarded = 'bwu_id';
    protected $fillable = [
        'branch_id',
        'merchant_id'
    ];

}
