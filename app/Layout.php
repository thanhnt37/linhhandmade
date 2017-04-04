<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    //
    //protected  $table = "layout";

    public function getItems(){

    	return $this->hasMany('App\Item','key_layout','key');
    }
}
