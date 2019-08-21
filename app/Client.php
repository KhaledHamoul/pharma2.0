<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    public $timestamps = true;
    protected $fillable = ["social_num","first_name","last_name","address","town","tel","password","confirmed"];

    public function orders() {
        return $this->hasMany('App\Order');
    }
    
}
