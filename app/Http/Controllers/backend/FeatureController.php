<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Attribute;
use App\GroupAttribute;
use App\ProductAttribute;
use App\FrameAttribute;
use App\Filter;
use App\FilterPrice;
use Redirect;
use App\CategoryProduct;
use App\TabAttribute;
use App\Product;
use App\ContentProduct;
use App\ProductImage;
use App\ProductInCategory;
use App\TagP;
use App\District;
use App\Transpost;
use App\Province;
use App\Item;
use App\Tag_Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use DB;
use Mail;
use App\Frame;
use App\Config_distric;
use App\FrameImage;
use App\Feature;
use App\ContentFrame;
use App\Email_out_of_stocks;
use App\System;
use App\Email_General;
use App\Related_product;
use App\Model\RelationProduct as RelationProduct;
use App\Model\RelationFrame as RelationFrame;
use App\Model\FolderAttribute as FolderAttribute;

class FeatureController extends Controller
{
    //
    public function createFeature(Request $req){
      $name =  $req->name;
      $choose =  $req->type;
      $init = $req->init;
      $obj = Feature::check($name,1);
      if($obj){
        return json_encode(array('status'=>false,'message'=>"Đặc tính này đã tồn tại"));
      }else{
        $attr = new Feature;
        $attr->name = $name;
        $attr->type = 1;
        $attr->status = 1;
        $attr->init = $init;
        $attr->save();
        return json_encode(array('status'=>true,'message'=>"Đã tạo mới đặc tính"));
      }
      
    }

    public function postAddFeatureFilter (Request $req){
	    $id = $req->id;
	    $value = trim($req->value);
	    $att = Feature::where('value',$value)->where('type',0)->first();
	    if(sizeof($att)){
	      return json_encode(array('status'=>false,'message'=>"Giá trị Đặc tính này đã tồn tại"));
	    }else{
	      $attr = Feature::find($id);
	      $a = new Feature;
	      $a->name = $attr->name;
	      $a->value = $value;
	      $a->type = 0;
	      $a->status = 0;
	      if($req->hasFile('img_add')){
	          $file = array('image' => Input::file('img_add'));
	          $rules = array('image' => 'mimes:jpeg,bmp,png');
	          $validator = Validator::make($file, $rules);
	          if($validator->fails()){

	          }else{
	            $file = Input::file('img_add');
	            $name = uniqid().'-'.date('d-m-Y').str_slug($a->value, '-').'.'.$file->getClientOriginalExtension();
	            $file->move(public_path().'/assets/product/filter/', $name);
	            $a->img = '/assets/product/filter/'.$name;
	          }
	        }
	       $a->save();
	      
	      return json_encode(array('status'=>true,'feature'=>$a));
	    }
    }
   public function delFeature(Request $req){
      $name = $req->name;
      $check = Feature::where('name',$name)->where('type',1)->first();
      if($check){
          $feature = Feature::where('name',$name)->delete();
          return json_encode(array('status'=>true,'message'=>"Xóa thành công"));
      }
      return json_encode(array('status'=>false,'message'=>"Không tìm thấy đặc tính"));
    }
    // xóa filter
    public function delFeatureAjax(Request $req){
      	$id = $req->id;

	    $attr = Feature::find($id);
	    if($attr){
	    	$attr->delete();
	        return json_encode(array('status'=>true,'message'=>"Xóa thành công"));
        }else{
        	return json_encode(array('status'=>false,'message'=>"Không tìm thấy đặc tính"));
      	} 
    }
    public function getFeatureAjax(Request $req){
      $id = $req->id;
      $attr = Feature::find($id);
      if(sizeof($attr)){
        return json_encode(array('status'=>true,'attr'=>$attr));
      }else{
        return json_encode(array('status'=>false,'item'=>null));
      }
    }
    public function saveFeatureAjax(Request $req){
        $id = $req->id_feature;
        $value = trim($req->value);
        $img = $req->img;
        $feature = Feature::find($id);
        if(sizeof($feature)){
            $feature->value = $value;
            if($req->hasFile('img')){
                $file = array('image' => Input::file('img'));
                $rules = array('image' => 'mimes:jpeg,bmp,png');
                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    
                }else{
                    $file = Input::file('img');
                    $name = uniqid().'-'.date('d-m-Y').str_slug($value, '-').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/assets/product/filter/', $name);
                    $feature->img = '/assets/product/filter/'.$name;
                }
            }
            $feature->save();
            return json_encode(array('status'=>true,'item'=>$feature));
        }else return json_encode(array('status'=>false,'item'=>null));
    }
    public function checkKey(Request $req){
      $key = $req->key;
      $list = Feature::where('name',$key)->where('type',0)->get();
      return json_encode(array('list'=>$list));
    }
}
