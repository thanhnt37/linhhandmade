<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent(){
    	return $this->belongsTo('App\Category', 'parent_id');
    }
    public function subcategory(){
    	return $this->hasMany('App\Category', 'parent_id');
    }
    public function getsubcate(){
    	return $this->hasMany('App\Post_category', 'category_id');
    }
   	public function post_public(){
        return $this->belongsToMany('App\Post', 'post_category', 'category_id', 'post_id');
    }
}
