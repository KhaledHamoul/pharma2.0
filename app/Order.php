<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    public $timestamps = true;
    protected $fillable = ["description","status","client_id","pharmacy_id"];

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function pharmacy() {
        return $this->belongsTo('App\Pharmacy');
    }
    
}
