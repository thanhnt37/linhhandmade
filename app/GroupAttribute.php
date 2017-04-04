<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupAttribute extends Model
{
    //
    protected $table= "group_attributes";
    public function parent(){
    	return $this->belongsTo('App\GroupAttribute', 'group_id');
    }
    public function subcategory(){
    	return $this->hasMany('App\GroupAttribute', 'group_id');
    }
    public function getAttributes()
    {
        return $this->belongsToMany('App\Attribute', 'folder_attributes', 'group_id', 'attribute_id');
    }
}
