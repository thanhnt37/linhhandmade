<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabAttribute extends Model
{
    //
    protected $table= "tab_attributes";

   protected $fillable = array('content_products_id', 'attribute_id');
}
