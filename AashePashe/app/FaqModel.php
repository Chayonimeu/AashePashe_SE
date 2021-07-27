<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FaqModel extends Model {

    use Notifiable;

    protected $table = "faq";
    protected $primaryKey = 'faq_id';
    protected $guarded = 'faq_id';
    protected $fillable = [
        'question',
        'answer',
        'status'
    ];

}
