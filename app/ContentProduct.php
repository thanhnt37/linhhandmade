<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentProduct extends Model
{
    
	protected $table = 'content_products';
    protected $guarded = [];

    public function getAttributes(){
        return $this->belongsToMany('App\Attribute', 'tab_attributes', 'content_products_id', 'attribute_id');
    }
    public function getAttributes_group(){
        return $this->belongsToMany('App\Attribute', 'tab_attributes', 'content_products_id', 'attribute_id')->groupby('name');
    }
}

