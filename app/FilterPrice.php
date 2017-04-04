<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterPrice extends Model
{
    //

    protected $fillable = array('name', 'min', 'max');
}
