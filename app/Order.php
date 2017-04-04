<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function getItem()
    {
    	return $this->hasMany('App\OrderItem');
    }
}
