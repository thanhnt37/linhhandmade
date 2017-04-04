<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\CategoryProduct;
use App\ProductAttribute;
use App\FrameAttribute;
use App\Form;
use App\System;
use App\Product;
use App\Category;
use App\District;
use App\Filter;
use App\Attribute;
use App\Item;
use App\Province;
use App\Order;
use App\Frame;
use App\OrderItem;
use App\Account;
use App\CommentProduct;
use App\ContentFrame;
use App\Post;
use App\Post_category;
use App\Email_out_of_stocks;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Mail;
use App\GroupAttribute;
use App\Model\RelationFrame;
use App\Model\RelationProduct;
use App\Model\FolderAttribute;
use DB;

class FilterController extends Controller
{   
    public function LoadFilterGroupAttribute(Request $req){
        $id = $req->id;
        $cate = GroupAttribute::find($id);
        $group = GroupAttribute::find($id);
        if( !$cate ){
            return redirect('/');
        }
        //_________________ GET FILTER IN GROUP ATTRIBUTE __________________
        $c = 0;
        $arr = array();
        $group_name = array();
        if($group){
          if(!in_array($group->filter_id,$arr)) array_push($arr, $group->filter_id);
        }
        while ($group) {
          $filter = Filter::find($group->filter_id);
          if($filter){
              array_push($group_name, $filter->name);
          }
          $group = $group->parent;
          $c++; if( $c > 20 ) break;
        }
         //_________________ END FILTER IN GROUP ATTRIBUTE __________________
        $frame_list = array();
        $arr_id_frame = array();
        $list_attribute = FolderAttribute::where('folder_attributes.group_id',$cate->id)->leftjoin('attributes','attributes.id','=','folder_attributes.attribute_id')->orderby('name','asc')->get();
        $danh_sach_dinh_tinh = array(); //danh sách định tính
        $danh_sach_dinh_luong = array(); // danh sách định lượng
        foreach ($list_attribute as $key => $value) {
            $root_attr = Attribute::where('name',$value->name)->where('type',1)->first();
            if($root_attr){
                if($root_attr->status == 1){
                    if($value->avaiable==0){
                        array_push($danh_sach_dinh_tinh,$value->id);
                    }else{
                        array_push($danh_sach_dinh_luong,$value);
                    }
                }
            }
        }
        $filter_0 = Filter::wherein('attribute_id',$danh_sach_dinh_tinh)->where('type',0)->orderby('name','desc')->get();
        $filter_1 = Filter::where('type',1)->orderby('name','desc')->get();
        $filter_y = array();
        $in_filter = array();
        foreach ($danh_sach_dinh_luong as $key1 => $value1) {
            foreach ($filter_1 as $key3 => $value3) {
                if($value1->name == $value3->name && $value1->value <= $value3->max && $value1->value >= $value3->min){
                    array_push($in_filter,$value3->id);
                    unset($filter_1[$key3]);
                }
            }
        }
        $filter_y = Filter::where('type',1)->whereIn('id',$in_filter)->orderby('name','desc')->orderby('min','asc')->get();
        $list_filter = array();
        $filter = array();
        $html = view('frontend.ajax.load-filter',['attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>$frame_list,'group_name'=>$group_name]);
        return json_encode(array('status'=>true,'html'=>$html.""));
    }
    public function ClickFilterGroupAttribute(Request $req){
        $id = $req->id;
        $list_filter = $req->list;
        if(!$list_filter) $list_filter = array();
        $group = GroupAttribute::find($id);           
        if(!$group) return json_encode(array('status'=>false));
        //_________________ GET FILTER IN GROUP ATTRIBUTE __________________
        $c = 0;
        $arr = array();
        $group_name = array();
        foreach ($list_filter as $key => $value) {
            if(!in_array($value,$arr)) array_push($arr, $value);
        }
        if($group){
          if(!in_array($group->filter_id,$arr)) array_push($arr, $group->filter_id);
        }
        $route_attr = array();
        while ($group) {
          $filter = Filter::find($group->filter_id);
          if($filter){
              array_push($group_name, $filter->name);
              array_push($route_attr,$group);
          }
          $group = $group->parent;
          if($group){
              if(!in_array($group->filter_id,$arr)) array_push($arr, $group->filter_id);
          }
          $c++; if( $c > 20 ) break;
        }
         //_________________ END FILTER IN GROUP ATTRIBUTE __________________
        $filter_0 = Filter::whereIn('id',$arr)->where('type',0)->get();
        $filter_1 = Filter::whereIn('id',$arr)->where('type',1)->get();
        $ATTR_IN = array();

        foreach ($filter_0  as $key => $value) {
          if(!in_array($value->attribute_id, $ATTR_IN))array_push($ATTR_IN, $value->attribute_id);
        }
        $query_1 = "";
        foreach ($ATTR_IN as $key => $value) {
            if( $key == sizeof($ATTR_IN) - 1){
              $query_1 .= " ( string_attr LIKE '%,".$value.",%' ) ";
            }else{
              $query_1 .= " ( string_attr LIKE '%,".$value.",%') AND ";
            }
        }
        $query_2 = "";
        $c_a = 0;
        foreach ($filter_1  as $key => $value) {
          $str  = "";
          $attr = Attribute::where('name',$value->name)->where('type',0)->get();
          $c = 0;
          foreach ($attr as $k => $v) {
            if(ctype_digit((string) $v->value)){
                if((int)$v->value >= (int)$value->min && (int)$v->value <= (int)$value->max){
                  if($c==0){
                    $str .="( string_attr LIKE '%,".$v->id.",%' ) ";
                  }else{
                    $str .=" or ( string_attr LIKE '%,".$v->id.",%' ) ";
                  }
                  $c++;
                }
            }else{
                if((float)$v->value >= (float)$value->min && (float)$v->value <= (float)$value->max){
                  if($c==0){
                    $str .="( string_attr LIKE '%,".$v->id.",%' ) ";
                  }else{
                    $str .=" or ( string_attr LIKE '%,".$v->id.",%' ) ";
                  }
                  $c++;
                }
            }
          }
          if($c){
            if($c_a==0){
              $query_2 .= " ( ".$str." ) ";
            }else{
              $query_2 .= " AND ( ".$str." ) ";
            }
            $c_a++;
          } 
        }
        // dd($query_2);
        if($query_1){
          if($query_2){
            $xyz = DB::select(DB::raw("select frame_id, product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM frame_attributes  where status_frame = 1  GROUP BY frame_id HAVING ".$query_1." and ".$query_2));
          }else{
            $xyz = DB::select(DB::raw("select frame_id, product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM frame_attributes where status_frame = 1  GROUP BY frame_id HAVING ".$query_1));
          }
        }else{
          if($query_2){
            $xyz = DB::select(DB::raw("select frame_id, product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM frame_attributes  where status_frame = 1 GROUP BY frame_id HAVING ".$query_2));
          }else{
            $xyz = DB::select(DB::raw("select frame_id, product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM frame_attributes  where status_frame = 1 GROUP BY frame_id "));
          }
        }
        // return json_encode($xyz);
        $arr = array();
        foreach ($xyz as $key => $value) {
          array_push($arr, $value->frame_id);
        }
        $list_san_pham = Frame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(id) ,',')  as frame_str") )->whereIn('id',$arr)->where('status',1)->groupby('product_id')->orderby('id','desc')->paginate(9);
        $attribute_count = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name','attributes.avaiable','attributes.id',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$arr)->where('status_frame',1)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();
        $danh_sach_dinh_tinh = array(); //danh sách định tính
        $danh_sach_dinh_luong = array(); // danh sách định lượng
        foreach ($attribute_count as $key => $value) {
            $root_attr = Attribute::where('name',$value->name)->where('type',1)->first();
            if($root_attr){
                if($root_attr->status == 1){
                    if($value->avaiable==0){
                        array_push($danh_sach_dinh_tinh,$value->id);
                    }else{
                        array_push($danh_sach_dinh_luong,$value);
                    }
                }
            }
        }
        
        $filter_0 = Filter::wherein('attribute_id',$danh_sach_dinh_tinh)->where('type',0)->orderby('name','desc')->get();
        $filter_1 = Filter::where('type',1)->orderby('name','desc')->get();
        $filter_y = array();
        $in_filter = array();
        foreach ($danh_sach_dinh_luong as $key1 => $value1) {
            foreach ($filter_1 as $key3 => $value3) {
                if(ctype_digit((string) $value1->value)){
                  if($value1->name == $value3->name && ((int)$value1->value) <= ((int)$value3->max) && ((int)$value1->value) >= ((int)$value3->min) ){
                        array_push($in_filter,$value3->id);
                        unset($filter_1[$key3]);
                  }
                }else{
                 
                  if($value1->name == $value3->name && ((float)$value1->value) <= ((float)$value3->max) && ((float)$value1->value) >= ((float)$value3->min) ){
                        array_push($in_filter,$value3->id);
                        unset($filter_1[$key3]);
                  }
                }
                
            }
        }
        $filter_y = Filter::where('type',1)->whereIn('id',$in_filter)->orderby('name','desc')->orderby('min','asc')->get();

        $filter = array();
        $html = view('frontend.ajax.load-filter',['attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>array(),'group_name'=>$group_name]);
        $product_view = view('frontend.ajax.load-filter-list-product',array('products'=>$list_san_pham));
        $product_paginate = view('frontend.ajax.load-filter-paginate',['products'=>$list_san_pham,'status'=>0]);
        $stag_box = view('frontend.ajax.stag-box',array('route_attr'=>$route_attr,'list_filter'=>$list_filter));
        return json_encode(array('status'=>true,'view'=>$html.'','product_view'=>$product_view.'','product_paginate'=>$product_paginate.'','stag_box'=>$stag_box.""));
    } 
    // Tìm kiếm sản phẩm
    public function LoadFilterSearch(Request $req){
        $id = $req->id; 
        $search = $req['search'];
        $a = trim($search);
        $id = $req->id;
        // $cate = CategoryProduct::find($id);
        $frame_list = array();
        $arr_id_frame = array();
        // $config_frame = Item::where('key_item','config_frame_attribute')->first();
        
        
        $attribute_count =  Frame::where(function ($query) use ($search) {
                                    $query->where('frames.name','like',"%$search%")->orwhere('frames.code_frame','like',"%$search%");
        })->where('frames.status',1)->select(DB::raw('count(frame_attributes.attribute_id) as num'),"frame_attributes.attribute_id",'frame_attributes.id as xyz','frame_attributes.product_id','frame_attributes.frame_id','frame_attributes.status_frame','attributes.*')->rightjoin('frame_attributes','frames.id','=','frame_attributes.frame_id')->groupby('frame_attributes.attribute_id','frame_attributes.status_frame')->leftjoin('attributes','attributes.id','=','frame_attributes.attribute_id')->orderby('attributes.name')->get();
        $danh_sach_dinh_tinh = array(); //danh sách định tính
        $danh_sach_dinh_luong = array(); // danh sách định lượng
        foreach ($attribute_count as $key => $value) {
            $root_attr = Attribute::where('name',$value->name)->where('type',1)->first();
            if($root_attr){
                if($root_attr->status == 1){
                    if($value->avaiable==0){
                        array_push($danh_sach_dinh_tinh,$value->id);
                    }else{
                        array_push($danh_sach_dinh_luong,$value);
                    }
                }
            }
        }
        $filter_0 = Filter::wherein('attribute_id',$danh_sach_dinh_tinh)->where('type',0)->orderby('name','desc')->get();
        $filter_1 = Filter::where('type',1)->orderby('name','desc')->get();
        $filter_y = array();
        $in_filter = array();
        foreach ($danh_sach_dinh_luong as $key1 => $value1) {
            foreach ($filter_1 as $key3 => $value3) {
                if($value1->name == $value3->name && $value1->value <= $value3->max && $value1->value >= $value3->min){
                    array_push($in_filter,$value3->id);
                    unset($filter_1[$key3]);
                }
            }
        }
        $filter_y = Filter::where('type',1)->whereIn('id',$in_filter)->orderby('name','desc')->orderby('min','asc')->get();
        $filter = array();
        $list_filter = array();
        $html = view('frontend.ajax.load-filter',['attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>$frame_list]);
        return json_encode(array('status'=>true,'html'=>$html.""));
    }
    // load_filter_click
    public function load_filter_click(Request $req){
        $id = $req->id;
        $search = $req['search'];
        $a = trim($search);
        $list_filter = $req->list;
        if(!$list_filter) $list_filter = array();
        $arr = array();
        $group_name = array();
        foreach ($list_filter as $key => $value) {
            if(!in_array($value,$arr)) array_push($arr, $value);
        }
        $filter_0 = Filter::whereIn('id',$arr)->where('type',0)->get();
        $filter_1 = Filter::whereIn('id',$arr)->where('type',1)->get();
        $ATTR_IN = array();
        foreach ($filter_0  as $key => $value) {
          if(!in_array($value->attribute_id, $ATTR_IN))array_push($ATTR_IN, $value->attribute_id);
        }
        $query_1 = "";
        foreach ($ATTR_IN as $key => $value) {
            if( $key == sizeof($ATTR_IN) - 1){
              $query_1 .= " ( string_attr LIKE '%,".$value.",%' ) ";
            }else{
              $query_1 .= " ( string_attr LIKE '%,".$value.",%') AND ";
            }
        }
        $query_2 = "";
        $c_a = 0;
        foreach ($filter_1  as $key => $value) {
          $str  = "";
          $attr = Attribute::where('name',$value->name)->where('type',0)->get();
          $c = 0;
          foreach ($attr as $k => $v) {
            if($v->value >= $value->min && $v->value <= $value->max){
              if($c==0){
                $str .="( string_attr LIKE '%,".$v->id.",%' ) ";
              }else{
                $str .=" or ( string_attr LIKE '%,".$v->id.",%' ) ";
              }
                $c++;
            }
          }
          if($c){
            if($c_a==0){
              $query_2 .= " ( ".$str." ) ";
            }else{
              $query_2 .= " AND ( ".$str." ) ";
            }
            $c_a++;
          } 
        }
        if($query_1){
          if($query_2){
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where (frames.name LIKE '%".$search."%' or frames.code_frame LIKE '%".$search."%' ) and frame_attributes.status_frame = 1  GROUP BY frame_attributes.frame_id HAVING ".$query_1." and ".$query_2." "));
          }else{
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where (frames.name LIKE '%".$search."%' or frames.code_frame LIKE '%".$search."%' ) and frame_attributes.status_frame = 1  GROUP BY frame_attributes.frame_id HAVING ".$query_1." "));
          }
        }else{
          if($query_2){
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where (frames.name LIKE '%".$search."%' or frames.code_frame LIKE '%".$search."%' ) and frame_attributes.status_frame = 1 GROUP BY frame_attributes.frame_id HAVING ".$query_2."  "));
          }else{
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where (frames.name LIKE '%".$search."%' or frames.code_frame LIKE '%".$search."%' ) and frame_attributes.status_frame = 1 GROUP BY frame_attributes.frame_id "));
          }
        }
        $arr = array();
        foreach ($xyz as $key => $value) {
          array_push($arr, $value->frame_id);
        }
        $list_san_pham = Frame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(id) ,',')  as frame_str") )->whereIn('id',$arr)->where('status',1)->groupby('product_id')->orderby('id','desc')->paginate(9);
        $attribute_count = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name','attributes.avaiable','attributes.id',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$arr)->where('status_frame',1)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();
        $danh_sach_dinh_tinh = array(); //danh sách định tính
        $danh_sach_dinh_luong = array(); // danh sách định lượng
        foreach ($attribute_count as $key => $value) {
            $root_attr = Attribute::where('name',$value->name)->where('type',1)->first();
            if($root_attr){
                if($root_attr->status == 1){
                    if($value->avaiable==0){
                        array_push($danh_sach_dinh_tinh,$value->id);
                    }else{
                        array_push($danh_sach_dinh_luong,$value);
                    }
                }
            }
        }
        $filter_0 = Filter::wherein('attribute_id',$danh_sach_dinh_tinh)->where('type',0)->orderby('name','desc')->get();
        $filter_1 = Filter::where('type',1)->orderby('name','desc')->get();
        $filter_y = array();
        $in_filter = array();
        foreach ($danh_sach_dinh_luong as $key1 => $value1) {
            foreach ($filter_1 as $key3 => $value3) {
                if(ctype_digit((string) $value1->value)){
                  if($value1->name == $value3->name && (int)$value1->value <= (int)$value3->max && (int)$value1->value >= (int)$value3->min){
                        array_push($in_filter,$value3->id);
                        unset($filter_1[$key3]);
                  }
                }else{
                  if($value1->name == $value3->name && (float)$value1->value <= (float)$value3->max && (float)$value1->value >= (float)$value3->min){
                        array_push($in_filter,$value3->id);
                        unset($filter_1[$key3]);
                  }
                }
            }
        }
        $filter_y = Filter::where('type',1)->whereIn('id',$in_filter)->orderby('name','desc')->orderby('min','asc')->get();
        $filter = array();
        $html = view('frontend.ajax.load-filter',['attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>array()]);

        $product_view = view('frontend.ajax.load-filter-list-product',['products'=>$list_san_pham]);
        $product_paginate = view('frontend.ajax.load-filter-paginate',['products'=>$list_san_pham,'status'=>1,'a'=>$a]);
        $stag_box = view('frontend.ajax.stag-box',array('list_filter'=>$list_filter));
        return json_encode(array('status'=>true,'view'=>$html.'','product_view'=>$product_view.'','product_paginate'=>$product_paginate.'','stag_box'=>$stag_box.""));
    } 
    // Load bộ lọc danh sách vừa xem
    public function load_filter_view(Request $req){
        $id = $req->id;
        $frame_list = array();
        $arr_id_frame = array();
        $list_pro_xem = Session::get('xem_product');
        $in = array();
        if(!$list_pro_xem) $list_pro_xem = array();
        foreach ($list_pro_xem as $key => $value) {
            # code...
            array_push($in,$value['xem_product']->id);
        }
        $attribute_count =  Frame::whereIn('frames.id',$in)->where('frames.status',1)->select(DB::raw('count(frame_attributes.attribute_id) as num'),"frame_attributes.attribute_id",'frame_attributes.id as xyz','frame_attributes.product_id','frame_attributes.frame_id','frame_attributes.status_frame','attributes.*')->rightjoin('frame_attributes','frames.id','=','frame_attributes.frame_id')->groupby('frame_attributes.attribute_id','frame_attributes.status_frame')->leftjoin('attributes','attributes.id','=','frame_attributes.attribute_id')->orderby('attributes.name')->get();
        $danh_sach_dinh_tinh = array(); //danh sách định tính
        $danh_sach_dinh_luong = array(); // danh sách định lượng
        foreach ($attribute_count as $key => $value) {
            $root_attr = Attribute::where('name',$value->name)->where('type',1)->first();
            if($root_attr){
                if($root_attr->status == 1){
                    if($value->avaiable==0){
                        array_push($danh_sach_dinh_tinh,$value->id);
                    }else{
                        array_push($danh_sach_dinh_luong,$value);
                    }
                }
            }
        }
        $filter_0 = Filter::wherein('attribute_id',$danh_sach_dinh_tinh)->where('type',0)->orderby('name','desc')->get();
        $filter_1 = Filter::where('type',1)->orderby('name','desc')->get();
        $filter_y = array();
        $in_filter = array();
        foreach ($danh_sach_dinh_luong as $key1 => $value1) {
            foreach ($filter_1 as $key3 => $value3) {
                if($value1->name == $value3->name && $value1->value <= $value3->max && $value1->value >= $value3->min){
                    array_push($in_filter,$value3->id);
                    unset($filter_1[$key3]);
                }
            }
        }
        $filter_y = Filter::where('type',1)->whereIn('id',$in_filter)->orderby('name','desc')->orderby('min','asc')->get();
        $filter = array();
        $list_filter = array();
        $html = view('frontend.ajax.load-filter',['attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>$frame_list]);
        return json_encode(array('status'=>true,'html'=>$html.""));
    }

    // Filter trong danh sách vừa xem
    public function load_filter_click_view(Request $req){
        $id = $req->id;
        $list_filter = $req->list;
        if(!$list_filter) $list_filter = array();
        $arr = array();
        $group_name = array();
        foreach ($list_filter as $key => $value) {
            if(!in_array($value,$arr)) array_push($arr, $value);
        }
        $filter_0 = Filter::whereIn('id',$arr)->where('type',0)->get();
        $filter_1 = Filter::whereIn('id',$arr)->where('type',1)->get();
        $ATTR_IN = array();
        foreach ($filter_0  as $key => $value) {
          if(!in_array($value->attribute_id, $ATTR_IN))array_push($ATTR_IN, $value->attribute_id);
        }
        $query_1 = "";
        foreach ($ATTR_IN as $key => $value) {
            if( $key == sizeof($ATTR_IN) - 1){
              $query_1 .= " ( string_attr LIKE '%,".$value.",%' ) ";
            }else{
              $query_1 .= " ( string_attr LIKE '%,".$value.",%') AND ";
            }
        }
        $query_2 = "";
        $c_a = 0;
        foreach ($filter_1  as $key => $value) {
          $str  = "";
          $attr = Attribute::where('name',$value->name)->where('type',0)->get();
          $c = 0;
          foreach ($attr as $k => $v) {
            if($v->value >= $value->min && $v->value <= $value->max){
              if($c==0){
                $str .="( string_attr LIKE '%,".$v->id.",%' ) ";
              }else{
                $str .=" or ( string_attr LIKE '%,".$v->id.",%' ) ";
              }
                $c++;
            }
          }
          if($c){
            if($c_a==0){
              $query_2 .= " ( ".$str." ) ";
            }else{
              $query_2 .= " AND ( ".$str." ) ";
            }
            $c_a++;
          } 
        }
        $list_pro_xem = Session::get('xem_product');
        $in = array();
        if(!$list_pro_xem) $list_pro_xem = array();
        foreach ($list_pro_xem as $key => $value) {
            # code...
            array_push($in,$value['xem_product']->id);
        }
        $str_in = json_encode($in);
        $str_in = str_replace('[','(',$str_in);
        $str_in = str_replace(']',')',$str_in);
        if($query_1){
          if($query_2){
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where frames.id in ".$str_in." and frame_attributes.status_frame = 1  GROUP BY frame_attributes.frame_id HAVING ".$query_1." and ".$query_2." "));


          }else{
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where frames.id in ".$str_in." and frame_attributes.status_frame = 1  GROUP BY frame_attributes.frame_id HAVING ".$query_1." "));
          }
        }else{
          if($query_2){
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where frames.id in ".$str_in." and frame_attributes.status_frame = 1 GROUP BY frame_attributes.frame_id HAVING ".$query_2."  "));
          }else{
            $xyz = DB::select(DB::raw("select frame_attributes.frame_id, frame_attributes.product_id , CONCAT(',', GROUP_CONCAT(frame_attributes.attribute_id) ,',')  as string_attr FROM frame_attributes left join frames on frames.id = frame_attributes.frame_id where frames.id in ".$str_in." and frame_attributes.status_frame = 1 GROUP BY frame_attributes.frame_id "));
          }
        }
       $arr = array();
        foreach ($xyz as $key => $value) {
          array_push($arr, $value->frame_id);
        }
        $list_san_pham = Frame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(id) ,',')  as frame_str") )->whereIn('id',$arr)->where('status',1)->groupby('product_id')->orderby('id','desc')->paginate(9);
        $attribute_count = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name','attributes.avaiable','attributes.id',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$arr)->where('status_frame',1)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();
        $danh_sach_dinh_tinh = array(); //danh sách định tính
        $danh_sach_dinh_luong = array(); // danh sách định lượng
        foreach ($attribute_count as $key => $value) {
            $root_attr = Attribute::where('name',$value->name)->where('type',1)->first();
            if($root_attr){
                if($root_attr->status == 1){
                    if($value->avaiable==0){
                        array_push($danh_sach_dinh_tinh,$value->id);
                    }else{
                        array_push($danh_sach_dinh_luong,$value);
                    }
                }
            }
        }
        $filter_0 = Filter::wherein('attribute_id',$danh_sach_dinh_tinh)->where('type',0)->orderby('name','desc')->get();
        $filter_1 = Filter::where('type',1)->orderby('name','desc')->get();
        $filter_y = array();
        $in_filter = array();
        foreach ($danh_sach_dinh_luong as $key1 => $value1) {
            foreach ($filter_1 as $key3 => $value3) {
                if(ctype_digit((string) $value1->value)){
                  if($value1->name == $value3->name && (int)$value1->value <= (int)$value3->max && (int)$value1->value >= (int)$value3->min){
                        array_push($in_filter,$value3->id);
                        unset($filter_1[$key3]);
                  }
                }else{
                  if($value1->name == $value3->name && (float)$value1->value <= (float)$value3->max && (float)$value1->value >= (float)$value3->min){
                        array_push($in_filter,$value3->id);
                        unset($filter_1[$key3]);
                  }
                }
            }
        }
        $filter_y = Filter::where('type',1)->whereIn('id',$in_filter)->orderby('name','desc')->orderby('min','asc')->get();
        $filter = array();
        $html = view('frontend.ajax.load-filter',['attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>array()]);

        $product_view = view('frontend.ajax.load-filter-list-product',['products'=>$list_san_pham]);
        $product_paginate = view('frontend.ajax.load-filter-paginate',['products'=>$list_san_pham,'status'=>2]);
        $stag_box = view('frontend.ajax.stag-box',array('list_filter'=>$list_filter));
        
        return json_encode(array('status'=>true,'view'=>$html.'','product_view'=>$product_view.'','product_paginate'=>$product_paginate.'','stag_box'=>$stag_box.""));
    } 

}
