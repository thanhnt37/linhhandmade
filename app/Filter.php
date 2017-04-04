<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    //

    protected $fillable = array('name', 'min', 'max');
}
