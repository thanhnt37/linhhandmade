<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Slide extends Model
{
    //
    protected $table = "slides";
    public static function getListSlide(){
    	return DB::table('slide_types')->get();
    }
}
