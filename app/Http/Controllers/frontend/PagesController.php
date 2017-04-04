<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\CategoryProduct;
use App\ProductAttribute;
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
use App\Customer;
use App\Configure_discounts;
use App\Email_General;
use App\CommentFrame;
use App\Config_distric;
use App\GroupAttribute;
use App\Model\RelationFrame;
use App\Model\RelationProduct;
use App\Model\FolderAttribute;
use App\FrameAttribute;
use DB;

class PagesController extends Controller
{
    public function viewblog($id){
        $post = Post::find($id);
        $cate = Category::get();
        $post_cate = Post_category::get();
        if($post){
             return view('frontend.pages.Blog', compact('post','id','cate','post_cate','post1'));
        }
        return view('errors.404');
    }
    public function getSearch(Request $req){
        if($req->list){
            // dd($req->list);
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
            // return json_encode(array('status'=>true,'view'=>$html.'','product_view'=>$product_view.'','product_paginate'=>$product_paginate.''));
            $stag_box = view('frontend.ajax.stag-box',array('list_filter'=>$list_filter));
            return view('frontend.pages.tim-kiem',['products'=>$list_san_pham,'attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>array(),'group_name'=>$group_name,'search'=>$search,'a'=>$a,'stag_box'=>$stag_box.""]);

        }else{
            $search = $req['search'];
            $a = trim($search);
            $products = Frame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(id) ,',')  as frame_str") )->where(function ($query) use ($a) {
                    $query->where('name','like',"%$a%")->orwhere('code_frame','like',"%$a%");
            })->where('status',1)->groupby('product_id')->orderby('created_at','desc')->paginate(9);
            return view('frontend.pages.tim-kiem',compact('products','search', 'a'));
        }
        
    }
    public function viewpay(Request $req,$id){
        $link_session = Session::get('id');
        $id = $req->id;
        $order = Order::find($id);
        if(!$link_session) $link_session = array();
        if($order){
            if(in_array($order->id, $link_session)){
                return view('frontend.pages.Pay',['order'=>$order]);
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }
    }

    public function getCart(){
        return view('frontend.pages.Cart');
    }

    public function listVuaXem(){
        $list_pro_xem = Session::get('xem_product');
        $in = array();
        if(!$list_pro_xem) $list_pro_xem = array();
        foreach ($list_pro_xem as $key => $value) {
            # code...
            array_push($in,$value['xem_product']->id);
        }
        $products = Frame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(id) ,',')  as frame_str") )->whereIn('id',$in)->where('status',1)->groupby('product_id')->orderby('created_at','desc')->paginate(9);

        
        // $products = Product::wherein('id',$in_product)->where('status',1)->paginate(9);

        return view('frontend.pages.vua-xem',['products'=>$products,'list_pro_xem'=>$list_pro_xem,'in'=>$in]);
    }

    public function getProDetail($slug = null,$id){
        $str = $slug."-".$id;
        $arr = explode('-',$str);

        if( sizeof($arr) ){
            $id = $arr[sizeof($arr)-1];
            $slug =  substr($str,0,strlen($str) - strlen($id)-1);
            $product = Frame::where('id',$id)->where('slug',$slug)->where('status',1)->first();
            if($product){
                $xem_product = $product;
                if($xem_product == null){
                    return json_encode(['status'=>false]);
                }
                $arrxem = array('xem_product'=>$xem_product);
                $list_pro_xem = Session::get('xem_product');
                $c = 0 ;
                if($list_pro_xem != null){
                    foreach ($list_pro_xem as $key => $value) {
                        if($id == $value['xem_product']->id){
                            $c++;
                        
                        }            
                    }
                }
                if($c == 0 ){
                    Session::push('xem_product',$arrxem);
                }else{
                    Session::set('xem_product',$list_pro_xem);
                }
                $list_pro_xem = Session::get('xem_product');
                $in = array();
                foreach ($list_pro_xem as $key => $value) {
                    array_push($in, $value['xem_product']->id);
                }

                $product_root = Product::where('id',$product->product_id)->first();
                if($product_root){


                    $attribute = $product_root->getAttributes()->select('attributes.*','filters.img')->leftjoin('filters','filters.attribute_id','=','attributes.id')->orderby('name','asc')->get();

                    // $frame_fillter = Frame::select('frames.*','filters.img')->leftjoin('filters','filters.attribute_id','=','frames.attribute_id')->where('product_id',$product_root->id)->where('frames.status',1)->orderby('id','asc')->get();
                    $frame_fillter = Frame::select('frames.*')->where('product_id',$product_root->id)->where('status',1)->orderby('id','asc')->get();

                    return view('frontend.pages.Pro',['product'=>$product,'product_root'=>$product_root,'attribute'=>$attribute,'frame_fillter'=>$frame_fillter]);
                }else{
                    return redirect('/');
                }
            }else{
                return redirect('/');
            }

        }else{
            return redirect('/');
        }   
    }
    public function viewCategoryNew(Request $req,$slug,$id = null){
        // dd($req->list);
        if($req->list){
            // dd($req->list);
            $str = $slug."-".$id;
            $arr = explode('-',$str);
            if( sizeof($arr) ){
                $id = $arr[sizeof($arr)-1];
                $slug =  substr($str,0,strlen($str) - strlen($id)-1);
            }else{
                return redirect('/');
            }
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
            // $html = view('frontend.ajax.load-filter',[]);
            $product_paginate = view('frontend.ajax.load-filter-paginate',['products'=>$list_san_pham,'status'=>0]);
            // return json_encode(array('status'=>true,'view'=>$html.''));
            $group = GroupAttribute::find($id);   
            $stag_box = view('frontend.ajax.stag-box',array('route_attr'=>$route_attr,'list_filter'=>$list_filter));
            return view('frontend.pages.newcategory',['products'=>$list_san_pham,'group_attribute'=>$group,'product_paginate'=>$product_paginate.'','attr_frame'=>"Màu sắc",'filter'=>$filter,'filter_0'=>$filter_0,'filter_y'=>$filter_y,'list_filter'=>$list_filter,'frame_list'=>array(),'group_name'=>$group_name,'stag_box'=>$stag_box.""]);
        }else{
            $str = $slug."-".$id;
            $arr = explode('-',$str);
            if( sizeof($arr) ){
                $id = $arr[sizeof($arr)-1];
                $slug =  substr($str,0,strlen($str) - strlen($id)-1);
                $group_attribute = GroupAttribute::where('id',$id)->first();
                if($group_attribute){
                        if(!str_slug($group_attribute->name) == $slug){
                             return redirect('/');
                        }
                        $products = RelationFrame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(frame_id) ,',')  as frame_str") )->where('relation_frame.group_id',$group_attribute->id)->where('status',1)->groupby('product_id')->orderby('frame_id','desc')->paginate(9);

                        $attribute_count = FolderAttribute::where('folder_attributes.group_id',$group_attribute->id)->leftjoin('attributes','attributes.id','=','folder_attributes.attribute_id')->where('folder_attributes.status',1)->orderby('name','asc')->get();
                        $c = 0;
                        $arr = array();
                        $arr_filter = array();
                        $group_name = array();
                        $parent = $group_attribute->id;
                        $route_attr = array();
                        while ($c < 10) {
                          $parent_obj = GroupAttribute::find($parent);
                          if($parent_obj){
                            array_push($arr,$parent_obj->filter_id);
                            $filter = Filter::find($parent_obj->filter_id);
                            if($filter){
                              array_push($arr_filter, $filter->name);
                              array_push($route_attr,$parent_obj);
                            }
                            array_push($group_name,$parent_obj->name);
                            $parent = $parent_obj->group_id;
                          }else{
                            break;
                          }
                        }
                        $not_filter = Filter::whereIn('id',$arr)->get();
                        $arr_name = array();
                        foreach ($not_filter as $key => $value) {
                          array_push($arr_name, $value->name);
                        }
                         $stag_box = view('frontend.ajax.stag-box',array('route_attr'=>$route_attr))."";
                        // dd($products);
                       return view('frontend.pages.newcategory',compact('products','group_attribute','stag_box'));
                }else{
                       return redirect()->route('view.category');
                }

            }
        }
    }

    public function views(){
           $products = Product::select()->paginate(9);      
           return view('frontend.pages.index',compact('products'));
    }
    public function ajaxFrameCategory(Request $req){
        $id = $req->id;
        $id_product = $req->id_product;
        $frame = Frame::find($id);
        $product = Product::find($id_product);
        // $frame_filter = Frame::select('frames.*','filters.img')->where('frames.status',1)->leftjoin('filters','filters.attribute_id','=','frames.attribute_id')->where('frames.product_id',$product->id)->orderby('id','asc')->get();
        $frame_filter = Frame::select('frames.*','filters.img as imgfilter')->leftjoin('filters','frames.attribute_id','=','filters.attribute_id')->where('product_id',$product->id)->where('frames.status',1)->get();

        $html = view('frontend.ajax.ajax-frame-category',['frame'=>$frame,'product'=>$product,'frame_filter'=>$frame_filter]);
        return json_encode(array('status'=>true,'html'=>$html.""));
    }  

    public function viewproducts($id = null){
          
           $category = CategoryProduct::find($id);
           if($category){
                if( $category->parent_id ==0 ){
                    // lay ra cac product cua category
                    $sub_child = $category->subcategory;
                    if(sizeof($sub_child)){
                        $in_cate = array(); 
                        array_push($in_cate, $category->id);
                        foreach ($sub_child as $key => $value) {
                            array_push($in_cate, $value->id);    
                        }
                        $products = Product::leftjoin('product_category','products.id','=','product_category.product_id')->select('products.*')->whereIn('product_category.cate_pro_id',$in_cate)->where('products.status',1)->groupby('products.id')->paginate(9);
                        // dd($products);
                    }else{
                        $products = $category->products_public()->paginate(9);
                    }
                }else{
                   $products = $category->products_public()->paginate(9);
                }
                
               return view('frontend.pages.category',compact('products','category'));
           }else{
               return redirect()->route('view.category');
           }
    }



   
    public function dangkyUudai(Request $req){
        if(!empty($req->email )){
        $form =  new Form;
        $form->text_1 = $req->email;
        $form->type = "Ưu đãi";
        $form->status = 1;
        $form->save();
            return json_encode(array('status'=>true));
        }else{
            return json_encode(array('status'=>false));
        }
    }
    // tìm kiếm sản phẩm 
    public function productSearch(Request $req){
        $key= $req->key;
        $product = Frame::Where('status',1)->where(function($query) use ($key){
            $query->where('id',$key)->orWhere('name','like',"%$key%")->orWhere('code_frame','like',"%$key%");
        })->orderBy('id','desc')->limit(3)->get();
        if(sizeof($product)){
             $html_search = view('frontend.ajax.search',['product'=>$product]);
             $view = view('frontend.ajax.search-enter',['product'=>$product]);
             return json_encode(array('status'=>true,'html_search'=>$html_search.'','product'=>$product,'view'=>$view.""));
         }else{
            return json_encode(array('status'=>false,'product'=>$product));
         }  
    }

    // total Product
    //add cart
    public function addCart(Request $req){
        $num = $req->num;
        $frame_id = $req->frame_id;
        $frame = Frame::find($frame_id);
        if($frame == null){
            return json_encode(array('status'=>true,'frame'=>null));
        }
        $add = array(
            'num'=>$num,'frame'=>$frame
        );
        $list_pro = Session::get('product');

        $c = 0;
        if($list_pro != null){
            foreach ($list_pro as $key => $value) {
                if($frame_id == $value['frame']->id ){
                    $c++;
                    $list_pro[$key]['num'] = $num;
                }
            }
        }
        if($c == 0 ){
            Session::push('product',$add);
        }else{
            Session::set('product',$list_pro);
        }

        $list_pro = Session::get('product');
        if(sizeof($frame)){
            $total = 0;
            $total_weight = 0;
            foreach ($list_pro as $key => $item) {
                if($item['frame']->price_sale){
                    $price_frame = $item['frame']->price_sale;
                }else{
                    $price_frame = $item['frame']->price;
                }
            $price_frame = $price_frame;
            $total += $price_frame * $item['num'];
            $weight_frame = $item['frame']->weight;
            $total_weight += $weight_frame * $item['num'];
                
            }
            $text = number_format((int)$total,0,'','.')."đ";
            $view = view('frontend.ajax.addCart',['num'=>$num,'list_pro'=>$list_pro]);

            return json_encode(array('status'=>true,'frame'=>$frame,'session'=>$list_pro,'total'=>$text,'total_weight'=>$total_weight,'html'=>$view.""));
        }
        return json_encode(array('status'=>true));
    }

     public function totalProduct(Request $req){
        $id_frame = $req->id_frame;
        $num = $req->num;
        $district_ = $req->transpost;

        $list_pro = Session::get('product'); 
        if($list_pro != null){
            foreach ($list_pro as $key => $value){
                if($id_frame == $value['frame']->id){
                    $list_pro[$key]['num'] = $num;
                }
            }
        }
        Session::set('product',$list_pro);
            $total = 0;
            $total_weight = 0;
            foreach ($list_pro as $key => $item) {
                if($item['frame']->price_sale){
                    $price_frame = $item['frame']->price_sale;
                }else{
                    $price_frame = $item['frame']->price;
                }
                $price_frame = $price_frame;
                $total += $price_frame * $item['num'];
                $weight_frame = $item['frame']->weight;
                $total_weight += $weight_frame * $item['num'];
            }
            $text = $total;
            $total_weight = $total_weight;
            // đặt phí
            $district = District::where('id',$district_)->first();
            $some = 0;
            if(sizeof($district)){
                $list_phi = Config_distric::where('district_id',$district->id)->get();
                if(sizeof($list_phi)){
                    foreach ($list_phi as $key => $value2) {
                        if((float)$total_weight > (float)$value2->min_weigh && (float)$total_weight <= (float)$value2->max_weigh ){
                            $some = $value2->price;
                        }
                        if((float)$total_weight > (float)$value2->max_weigh){
                            $max = Config_distric::where('district_id',$district->id)->max('price');
                            $max_w = Config_distric::where('district_id',$district->id)->max('max_weigh');
                            $c = (float)$total_weight - (float)$max_w;
                            $d = ((float)$c*(float)$value2->init_price)/$value2->init_weigh; 
                            $some = (float)$max + (float)$d;
                        }
                    }
                }else{
                    $some = 0;
                }
            }
            return json_encode(array('status'=>true,'text'=>$text,'total_weight'=>$total_weight,'some'=>$some,'district'=>$district));   
    }

    public function removeCart(Request $req){
        $id_frame = $req->id_frame;
        $district_ = $req->transpost;
        $list_pro = Session::get('product');
        if($list_pro !=null){
            foreach ($list_pro as $key => $value){
                if($id_frame == $value['frame']->id){
                    unset($list_pro[$key]);
                }
            }
        }
        Session::set('product',$list_pro);
        $total = 0;
        $total_weight = 0;
        foreach ($list_pro as $key => $item)
        {
            if($item['frame']->price_sale)
            {
                $price_frame = $item['frame']->price_sale;
            }else{
                $price_frame = $item['frame']->price;
            }
            $price_frame = $price_frame;
            $total += $price_frame * $item['num'];
            $weight_frame = $item['frame']->weight;
            $total_weight += $weight_frame * $item['num'];
        }

         $text = $total;
         $text_weight = $total_weight;
         $district = District::where('id',$district_)->first();
            $some = 0;
            if(sizeof($district)){
                $list_phi = Config_distric::where('district_id',$district->id)->get();
                if(sizeof($list_phi)){
                    foreach ($list_phi as $key => $value2) {
                        if((float)$text_weight > (float)$value2->min_weigh && (float)$text_weight <= (float)$value2->max_weigh ){
                            $some = $value2->price;
                        }
                        if((float)$text_weight > (float)$value2->max_weigh){
                            $max = Config_distric::where('district_id',$district->id)->max('price');
                            $max_w = Config_distric::where('district_id',$district->id)->max('max_weigh');
                            $c = (float)$text_weight - (float)$max_w;
                            $d = ((float)$c*(float)$value2->init_price)/$value2->init_weigh; 
                            $some = (float)$max + (float)$d;
                        }
                    }
                }else{
                    $some = 0;
                }
            }
        return json_encode(array('status'=>true,'text'=>$text,'text_weight'=>$total_weight,'some'=>$some,'district'=>$district));
    }

    public function removeShopingCart(Request $req){
        $id_frame = $req->id_frame;
        $list_pro = Session::get('product');
        $district_ = $req->transpost;
        if($list_pro != null){
            foreach ($list_pro as $key => $value) {
                if($id_frame == $value['frame']->id){
                    unset($list_pro[$key]);
                }
            }
        }
        Session::set('product',$list_pro);
        $total = 0;
        $total_weight = 0;
        foreach ($list_pro as $key => $item) {
            if($item['frame']->price_sale){
                $price_frame = $item['frame']->price_sale;
            }else{
               $price_frame = $item['frame']->price; 
            }
            $price_frame = $price_frame;
            $total += $price_frame * $item['num'];
            $weight_frame = $item['frame']->weight;
            $total_weight += $weight_frame * $item['num'];
            
        }
        $text = $total;
        $text_weight = $total_weight;
        // đặt phí
        $district = District::where('id',$district_)->first();
        $some = 0;
        if(sizeof($district)){
            $list_phi = Config_distric::where('district_id',$district->id)->get();
            if(sizeof($list_phi)){
                foreach ($list_phi as $key => $value2) {
                    if((float)$text_weight > (float)$value2->min_weigh && (float)$text_weight <= (float)$value2->max_weigh ){
                        $some = $value2->price;
                    }
                    if((float)$text_weight > (float)$value2->max_weigh){
                        $max = Config_distric::where('district_id',$district->id)->max('price');
                        $max_w = Config_distric::where('district_id',$district->id)->max('max_weigh');
                        $c = (float)$text_weight - (float)$max_w;
                        $d = ((float)$c*(float)$value2->init_price)/$value2->init_weigh; 
                        $some = (float)$max + (float)$d;
                    }
                }
            }else{
                $some = 0;
            }
        }
        return json_encode(array('status'=>true,'text'=>$text,'text_weight'=>$text_weight,'some'=>$some,'district'=>$district));
    }

    public function ajaxProvinceFrontend(Request $req){
        $id = $req->id;
        $weight = $req->weigh;
        $province = Province::find($id);
        $district = District::where('provinceid',$id)->orderBy('name','asc')->get();
        $html = view('frontend.ajax.ajax-province-fronted',['district'=>$district,'province'=>$province,'weight'=>$weight]);
        return json_encode(array('status'=>true,'html'=>$html."",'id'=>$id,'district'=>$district));
    }

    // get order
    public function getOrderFrontend(Request $req){
        $id = $req->district;
        $district = District::find($id);
        if($district){
            $province = Province::where('id',$district->provinceid)->first();
            return view('frontend.pages.Oder',['district'=>$district,'province'=>$province]);
        }
        return view('errors.404'); 
    }
    // 
    public function ajaxOrderFrontend(Request $req){
        $id = $req->id_district;
        $district = District::find($id);
        $province = Province::where('id',$district->provinceid)->first();
        $list_pro = Session::get('product');
        if($list_pro == null){
            return json_encode(array('status'=>false));
        }else{
            $total=0;
            $total_weight = 0;
            $total_non_sale = 0;
            foreach($list_pro as $item){ 
                if($item['frame']->price_sale){
                    $price_frame = $item['frame']->price_sale;
                }else{
                   $price_frame = $item['frame']->price; 
                   $total_non_sale += $price_frame * $item['num'];
                }
                $price_frame = $price_frame;
                $total += $price_frame * $item['num']; 
                $weight_frame = $item['frame']->weight;
                $total_weight += $weight_frame * $item['num'];
            }
            $order = new Order;
            $order->fullname = $req->name;
            $phone = preg_replace('/[^\dxX]/', '', $req->phone);
            $x84 = substr($phone,0,2);
            if($x84 == 84){
                $phone = substr($phone,2);
            }
            $x0 = substr($phone,0,1);
            if($x0 != 0){
                $phone = "0".$phone;
            } 

            $phone = $phone;
            $order->phone = $phone;
            $order->email = $req->email;
            $order->address = $req->address;
            $order->note = $req->note;
            $order->status = 1;
            $order->total = $total;
            $order->price_district = $district->price;
            // tính phí vận chuyển
            $list_phi = Config_distric::where('district_id',$district->id)->get();
            $some = 0;
            if(sizeof($list_phi)){
                foreach ($list_phi as $key => $value2) {
                    if((float)$total_weight > (float)$value2->min_weigh && (float)$total_weight <= (float)$value2->max_weigh ){
                        $some = $value2->price;
                    }
                    if((float)$total_weight > (float)$value2->max_weigh){
                        $max = Config_distric::where('district_id',$district->id)->max('price');
                        $max_w = Config_distric::where('district_id',$district->id)->max('max_weigh');
                        $c = (float)$total_weight - (float)$max_w;
                        $d = ((float)$c*(float)$value2->init_price)/$value2->init_weigh; 
                        $some = (float)$max + (float)$d;
                    }
                }
            }else{
                $some = 0;
            }
            $order->total_weight = (float)$some;
            $order->district_id = $district->id;

            $cus = Customer::where('phone',$phone)->first();
            if($cus){
                $config_y = Configure_discounts::get();
                if(sizeof($config_y)){
                     $percent_y = 0;
                        foreach ($config_y as $key => $value) {
                            if($value->targets <= $cus->points){
                                $percent_y = $value->percent;
                            }else{
                                break;
                            }
                        }
                    $order->percent = $percent_y;
                }
            }else{
                $order->percent = 0;
            }

            if($order->save()){
                foreach ($list_pro as $key => $item) {
                    $order_item = new OrderItem;
                    $order_item->quantity = $item['num'];
                    $order_item->order_id = $order->id;
                    $order_item->product_id = $item['frame']->product_id;
                    $order_item->frame_id = $item['frame']->id;
                    $order_item->price = (int) $item['frame']->price;
                    $order_item->price_sale = (int) $item['frame']->price_sale;
                    $order_item->weight = $item['frame']->weight;
                    $order_item->transpost = $order->price_district;
                    $order_item->save();
                }
                Session::forget('product');  
                $total_order = $total + $total_weight;
                $total_weight1 = $order->total_weight;
                $percent = Configure_discounts::get();
                $p = Configure_discounts::min('targets');
                $custome = Customer::where('phone',$order->phone)->where('points','>=',$p)->first();
                $link = route('view.pay',['id'=>$order->id]);
                // $arr_link = array('id'=>$order);
                $link_session = Session::get('id');
                if(sizeof($link_session)){
                    if(!in_array($order->id,$link_session)){
                        array_push($link_session,$order->id );
                        Session::set('id',$link_session);
                    }
                }else{
                    $link_session = array();
                    array_push($link_session,$order->id);
                    Session::set('id',$link_session);
                }
                if($custome){
                    $percen = 0;
                    foreach ($percent as $key => $value) {
                        if($value->targets <= $custome->points){
                            $percen = $value->percent;
                        }else{
                            break;
                        }
                    }
                    $view = view('frontend.ajax.ajax-Order-New',['order'=>$order,'total_order'=>$total_order,'total_non_sale'=>$total_non_sale,'percen'=>$percen,'total'=>$total,'total_weight1'=>$total_weight1]);
                    // ignore_user_abort(true);
                    // set_time_limit(3000);
                    // ob_start();
                    echo json_encode(array('status'=>true,'view'=>$view."",'order'=>$order,'link'=>$link,'link_session'=>$link_session));
                    // $size = ob_get_length();
                    // header('Connection: close');
                    // header('Content-Length: '.$size);
                    // header("Content-Range: 0-".($size-1)."/".$size);
                    // ob_flush();
                    // flush();
                    $email_rev = Email_General::where('name','Email Nhận đơn hàng')->first();
                    $mail = System::select('email_send','email_password')->first();
                     if (  $email_rev ) {
                        config(['mail.username' => $mail->email_send]);
                        config(['mail.password' => $mail->email_password]);
                        config(['mail.port' => "587"]);
                        config(['mail.host' => "smtp.gmail.com"]);
                        config(['mail.encryption' => "tls"]);
                        $orderItem = OrderItem::where('order_id',$order->id)->leftjoin('frames','order_items.frame_id','=','frames.id')->get(); 
                        $data = array('order'=>$order,'orderItem'=>$orderItem);
                        if($email_rev->email){
                                $data['status'] = "Admin";
                                Mail::send('backend.email.email-new-order',$data, function($message) use ($mail,$email_rev,$order){
                                    $message->from($mail->email_send);
                                    
                                    $message->to($email_rev->email, 'Quản trị')->subject("[".url('')."] Có đơn hàng mới "."#".$order->id);
                                    
                                });
                            }
                            if($order->email){
                                $data['status'] = "Khách hàng";
                                Mail::send('backend.email.email-new-order',$data, function($message) use ($mail,$email_rev,$order){
                                    $message->from($mail->email_send);
                                    $message->to($order->email, 'Hệ thống ')->subject("[".url('')."] Xác nhận đơn hàng "."#".$order->id);
                                    
                                });     
                            }
                    }  
                }else{
                    
                    echo json_encode(array('status'=>false,'order'=>$order,'link'=>$link,'link_session'=>$link_session));
                    $email_rev = Email_General::where('name','Email Nhận đơn hàng')->first();
                    $mail = System::select('email_send','email_password')->first();
                     if (  $email_rev ) {
                        config(['mail.username' => $mail->email_send]);
                        config(['mail.password' => $mail->email_password]);
                        config(['mail.port' => "587"]);
                        config(['mail.host' => "smtp.gmail.com"]);
                        config(['mail.encryption' => "tls"]);
                        $orderItem = OrderItem::where('order_id',$order->id)->leftjoin('frames','order_items.frame_id','=','frames.id')->get();
                        $data = array('order'=>$order,'orderItem'=>$orderItem);
                        if($email_rev->email){
                                $data['status'] = "Admin";
                                Mail::send('backend.email.email-new-order',$data, function($message) use ($mail,$email_rev,$order){
                                    $message->from($mail->email_send);
                                    
                                    $message->to($email_rev->email, 'Quản trị')->subject("[".url('')."] Có đơn hàng mới "."#".$order->id);
                                    
                                });
                        }
                        if($order->email){
                            $data['status'] = "Khách hàng";
                            Mail::send('backend.email.email-new-order',$data, function($message) use ($mail,$email_rev,$order){
                                $message->from($mail->email_send);
                                $message->to($order->email, 'Hệ thống ')->subject("[".url('')."] Xác nhận đơn hàng "."#".$order->id);
                                
                            });     
                        }
                        
                    }
                }
              
            }    
        }
    }
    // ajax comment
    public function proComment(Request $req){
        $id = $req->hidden;
        $face = Session::get('face');
        if($face){  
            $commentP = new CommentFrame;
            $commentP->comment = $req->comment;
            $commentP->frame_id = $id;
            $commentP->account_id = $face->id;
            $commentP->status = 1;
            $commentP->save();
            return json_encode(['status'=>true,'name'=>$face->name,'comment'=>$req->comment]);
        }else{
            return json_encode(['status'=>false]);
        }
    }

   public function proCommentDequy(Request $req){
        $c_id = $req->id_comment;
        $comment = CommentFrame::find($c_id);
        $face = Session::get('face');
        if($face){   
            $commentP = new CommentFrame;
            $commentP->comment = $req->comment;
            $commentP->frame_id = $comment->frame_id;
            $commentP->account_id = $face->id;
            $commentP->parent_id = $comment->id;
            $commentP->status = 1;
            $commentP->save();
            return json_encode(['status'=>true]);
        }else{
            return json_encode(['status'=>false]);
        }
    }
    // phẩn trang
    public function PaginationComment(Request $req){
        $id = $req->id_frame;
        $page = $req->page;
        $product = Frame::find($id);
        if($product){
            $comments = CommentFrame::select('comment_frames.*','accounts.name')->leftJoin('accounts','comment_frames.account_id','=','accounts.id')->where('comment_frames.status',1)->where('comment_frames.frame_id',$product->id)->where('comment_frames.parent_id','=',0)->orderby('created_at','desc')->paginate(3);
            $html = view('frontend.ajax.ajax-phan-trang',['comments'=>$comments,'product'=>$product]);  
            $ul = view('frontend.ajax.ajax-phan-trang-ul',['comments'=>$comments,'product'=>$product]);
            return json_encode(array('status'=>true,'$comments'=>$comments,'html'=>$html."",'ul'=>$ul.""));
        }else{
            return json_encode(array('status'=>false));
        }
    }
    // frame chi tiết
    public function AjaxFrameChiTiet(Request $req){
        $id = $req->id;
        $frame = Frame::find($id);
        if(!$frame) return json_encode(array('status'=>false)); 
        $content = ContentFrame::where('frame_id',$frame->id)->first();
        $product = Product::where('id',$frame->product_id)->first();
        $comments = CommentFrame::select('comment_frames.*','accounts.name','accounts.img')->leftJoin('accounts','comment_frames.account_id','=','accounts.id')->where('comment_frames.status',1)->where('comment_frames.frame_id',$frame->id)->where('comment_frames.parent_id','=',0)->orderby('created_at','desc')->paginate(3);
        $feature  = $frame->getFeatures()->orderby('name')->get();
       
        if($frame){
            $html = view('frontend.ajax.ajax-frame-detail',['frame'=>$frame,'product'=>$product]);
            $content = view('frontend.ajax.ajax-content-detail',['frame'=>$frame,'content'=>$content,'feature'=>$feature]);
            $relate = view('frontend.ajax.ajax-content-detail-relate',['product'=>$frame]);
            $ul_frame = view('frontend.ajax.ajax-phan-trang-frame',['comments'=>$comments,'product'=>$frame]);
            $comments = view('frontend.ajax.ajax-cm',['comments'=>$comments,'frame'=>$frame]);
            $str_link = $frame->slug."-".$frame->id;
            return json_encode(array('status'=>true,'html'=>$html."",'content'=>$content."",'frame'=>$frame,'comments'=>$comments."",'ul_frame'=>$ul_frame."",'str_link'=>$str_link,'relate'=>$relate.""));

        }else{
            return json_encode(array('status'=>false)); 
        } 
    }
  public function AjaxFormHetHang(Request $req){
        $id_product = $req->id_product;
        $id_frame = $req->id_frame;
        $product = Product::find($id_product);
        $frame = Frame::find($id_frame);
        $e_mail = $req->email;
        $phone = $req->phone;
        $name = $req->name;
        if($e_mail){
            $email = Email_out_of_stocks::where('email',$req->email)->first();
            if($email){
                return json_encode(array('status'=>false,'message'=>"Email này đã được đăng kí"));
            }else{
                $email = new Email_out_of_stocks;
                $email->username = $name;
                $email->email = $e_mail;
                $email->phone = $phone;
                $email->name_product = $product->name;
                if(isset($frame)){
                    $email->code_product = $frame->code_frame;
                    $email->add_1 = $frame->id;
                }else{
                    $email->code_product = $product->code_product;
                    $email->add_1 = $product->id;
                }
                $email->status = 0;
                $email->save();
                return json_encode(array('status'=>true,'message'=>"Đăng kí thành công"));
            }
        }
    }

public function AjaxTraCuu(Request $req){
        $value = trim($req->value);
        $phone="";
        if(strlen($value) > 5){
            $phone = preg_replace('/[^\dxX]/', '', $value);
            $x84 = substr($phone,0,2);
            if($x84 == 84){
                $phone = substr($phone,2);
            }
            $x0 = substr($phone,0,1);
            if($x0 != 0){
                $phone = "0".$phone;
            } 

            $phone = $phone;
        }
        $id = substr($value,1);       
        $order = Order::where('phone',$phone)->orwhere('id',$id)->orderby('id','desc')->get();
        if(sizeof($order)){
            $view = view('frontend.ajax.ajax-tra-cuu',['order'=>$order]);
            return json_encode(array('status'=>true,'html'=>$view.""));
        }else{
            return json_encode(array('status'=>false,'message'=>'Không đúng mã hoặc số điện thoại đơn hàng'));
        }
    }
    public function AjaxTraCuuGiamGia(Request $req){
        $value = $req->phone;
        $custom = Customer::where('phone',$value)->first();
        if($custom){
            $html = view('frontend.ajax.ajax-tra-cuu-giam-gia',['custom'=>$custom]);
            return json_encode(array('status'=>true,'html'=>$html.""));
        }else{
            return json_encode(array('status'=>false,'message'=>"Nhập số điện thoại không đúng vui lòng kiểm tra lại"));
        }
    }
    
    public function AjaxHomeColl(Request $req){
        $status = $req->status;
        $product = Frame::where('label',2)->where('status',1)->orderby('created_at','desc')->limit(8)->get();
        $html = view('frontend.ajax.home_col',['product'=>$product]);
        return json_encode(array('status'=>true,'html'=>$html.""));
    }

    public function AjaxHomeNew(Request $req){
        $status = $req->status;
        $product = Frame::where('label',1)->where('status',1)->orderby('created_at','desc')->limit(8)->get();

        $html = view('frontend.ajax.home_col',['product'=>$product]);
        
        return json_encode(array('status'=>true,'html'=>$html.""));
    }

    public function AjaxHomeSale(Request $req){
        $status = $req->status;
        $product = Frame::where('label',3)->where('status',1)->orderby('created_at','desc')->limit(8)->get();
        $html = view('frontend.ajax.home_col',['product'=>$product]);
        return json_encode(array('status'=>true,'html'=>$html.""));
    }
    public function testEmail(){
        $mail = System::select('email_send','email_password')->first();
        // dd($mail);
        config(['mail.username' => $mail->email_send]);
        config(['mail.password' => $mail->email_password]);
        config(['mail.port' => "587"]);
        config(['mail.host' => "smtp.gmail.com"]);
        config(['mail.encryption' => "tls"]);
        $data = array();
    
        Mail::send('backend.email.email',$data, function($message) use ($mail){
                $message->from($mail->email_send);
                $message->to("nguyentruongson93@gmail.com", 'Quản trị')->subject("Test Email Template");
        });
    }
}
