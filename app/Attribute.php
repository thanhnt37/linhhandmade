<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $table = "attributes";
    public $fillable =['name', 'value'];
    public static function check($name,$type){
    	$data = Attribute::where('name',$name)->where('type',$type)->get();
    	if(sizeof($data)) return $data;
    	return null;
    }
    public static function check_attr($name,$value){
    	$data = Attribute::where('name',$name)->where('value',$value)->first();
    	if(sizeof($data)) return $data;
    	return null;
    }
}
