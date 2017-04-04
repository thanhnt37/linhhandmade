<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormType extends Model
{
    public function getform()
    {
    	return $this->hasMany('App\Form', 'type', 'name');
    }
    public function getform_limit($limit)
    {
    	return $this->hasMany('App\Form', 'type', 'name')->orderby('created_at','desc')->take($limit)->get();
    }

}
