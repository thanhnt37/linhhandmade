<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    //
     protected $table = "features";
      public $fillable =['name', 'value'];
    public static function check($name,$type){
    	$data = Feature::where('name',$name)->where('type',$type)->get();
    	if(sizeof($data)) return $data;
    	return null;
    }
    public static function check_attr($name,$value){
    	$data = Feature::where('name',$name)->where('value',$value)->first();
    	if(sizeof($data)) return $data;
    	return null;
    }
}
