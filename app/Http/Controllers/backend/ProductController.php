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
use App\ContentFrame;
use App\Email_out_of_stocks;
use App\System;
use App\Email_General;
use App\Related_product;
use App\Feature;
use App\FrameFeature;
use App\Model\RelationProduct as RelationProduct;
use App\Model\RelationFrame as RelationFrame;
use App\Model\FolderAttribute as FolderAttribute;

class ProductController extends Controller
{   

    public function transpost(){
      $province = Province::orderBy('type','asc')->orderBy('name','asc')->get();
       return view('backend.transpost.transpost',['province'=>$province]);
    }
    public function create_post(){
        return view('backend.products.add');
    }
    public function createProduct(){
        return view('backend.products.add-product');
    }
    public function createFilter(){
        return view('backend.products.add-filter');
    }
    public function createFeature(){
        return view('backend.products.add-feature');
    }
    public function getFolder(){
        return view('backend.products.detailfolder');
    }
    //Danh sách sản phẩm
    public function listProduct(){
        $attribute_count = FrameAttribute::select(DB::raw('count(frame_attributes.attribute_id) as num'),"frame_attributes.attribute_id",'frame_attributes.id as xyz','frame_attributes.product_id','frame_attributes.frame_id','frame_attributes.status_frame','attributes.*')->groupby('frame_attributes.attribute_id','frame_attributes.status_frame')->leftjoin('attributes','attributes.id','=','frame_attributes.attribute_id')->orderby('attributes.name')->get();
       $attribute_count_temp = $attribute_count;
         
        foreach ($attribute_count as $key => $value) {
           $attribute_count[$key]['num_hide'] = 0;
           $attribute_count[$key]['show'] = 1;
           // neu frame an thi hoan doi
          if($value->status_frame == 0){
            $c = 0;
            foreach ($attribute_count_temp as $key_temp => $value_temp) {
                if($value->name == $value_temp->name && $value->value == $value_temp->value  && $value->xyz != $value_temp->xyz && $value_temp->status_frame == 1){
                  $c++;
                  $attribute_count[$key]->num_hide = $value_temp->num;
                  $attribute_count[$key]->num = 0;
                }
            }  
            if($c == 0 ){
              $attribute_count[$key]->num_hide = $value->num;
              $attribute_count[$key]->num = 0;
            }
          }
        }
        // dd($attribute_count->toArray());
        $attribute_count_temp = $attribute_count;
        foreach ($attribute_count as $key => $value) {
          foreach ($attribute_count_temp as $key_temp => $value_temp) {
              if($value->name == $value_temp->name && $value->value == $value_temp->value  && $value->xyz != $value_temp->xyz && $value_temp->status_frame == 0){
                $attribute_count[$key]['num_hide'] = $value_temp->num;
                $attribute_count[$key_temp]['show'] = 0;
              }
          }
        }
        // dd($attribute_count->toArray());
        return view('backend.products.list',['attribute_count'=>$attribute_count]);
    }
   
     // Tìm kiếm product
    public function getSearchProductList(Request $req,$id_cate = null){
      $search = trim($req->name);
      $frame = Frame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(id) ,',')  as frame_str") )->where('name','like',"%$search%")->orwhere('code_frame','like',"%$search%")->groupby('product_id')->orderby('created_at','desc')->paginate(5);
      // dd($frame->toArray());
       $attribute_count =  Frame::where('frames.name','like',"%$search%")->orwhere('frames.code_frame','like',"%$search%")->select(DB::raw('count(frame_attributes.attribute_id) as num'),"frame_attributes.attribute_id",'frame_attributes.id as xyz','frame_attributes.product_id','frame_attributes.frame_id','frame_attributes.status_frame','attributes.*')->rightjoin('frame_attributes','frames.id','=','frame_attributes.frame_id')->groupby('frame_attributes.attribute_id','frame_attributes.status_frame')->leftjoin('attributes','attributes.id','=','frame_attributes.attribute_id')->orderby('attributes.name')->get();
        $attribute_count_temp = $attribute_count;
        foreach ($attribute_count as $key => $value) {
           $attribute_count[$key]['num_hide'] = 0;
           $attribute_count[$key]['show'] = 1;
          if($value->status_frame==0){
            $c = 0;
            foreach ($attribute_count_temp as $key_temp => $value_temp) {
                if($value->name == $value_temp->name && $value->value == $value_temp->value  && $value->xyz != $value_temp->xyz && $value_temp->status_frame == 1){
                  $c++;
                }
            }  
            if($c == 0 ){
              $attribute_count[$key]->num_hide = $value_temp->num;
              $attribute_count[$key]->num = 0;
            }
          }
        }
        $attribute_count_temp = $attribute_count;
        foreach ($attribute_count as $key => $value) {
          foreach ($attribute_count_temp as $key_temp => $value_temp) {
              if($value->name == $value_temp->name && $value->value == $value_temp->value  && $value->xyz != $value_temp->xyz && $value_temp->status_frame == 0){
                $attribute_count[$key]['num_hide'] = $value_temp->num;
                $attribute_count[$key_temp]['show'] = 0;
              }
          }
        }
       // dd($attribute_count->toArray());
        return view('backend.products.tim-kiem-product',['frame'=>$frame,'id_cate'=>$id_cate,'search'=>$search,'attribute_count'=>$attribute_count]);

    }
    // Xem thư mục
    public function getViewFolder($id){
        $group = GroupAttribute::where('id',$id)->first();
        if(!$group) return redirect("/");
        $list_san_pham = RelationProduct::where('relation_product.group_id',$group->id)->leftjoin('products','relation_product.product_id',"=",'products.id')->paginate(5);
        // $frames = RelationFrame::where('relation_frame.group_id',$group->id)->leftjoin('frames','relation_frame.frame_id',"=",'frames.id')->leftJoin('admins', 'frames.create_by', '=', 'admins.id')->leftJoin('admins as tbl_edit', 'frames.last_edit_by', '=', 'tbl_edit.id')->select('frames.*','admins.username as create_by_u','tbl_edit.username as last_edit_by_u')->paginate(10);
        $frames = RelationFrame::select("product_id",DB::raw("CONCAT(',', GROUP_CONCAT(frame_id) ,',')  as frame_str") )->where('relation_frame.group_id',$group->id)->groupby('product_id')->orderby('frame_id','desc')->paginate(10);

        $attribute_count = FolderAttribute::where('folder_attributes.group_id',$group->id)->leftjoin('attributes','attributes.id','=','folder_attributes.attribute_id')->orderby('name','asc')->get();
        // dd($list_san_pham);
        $c = 0;
        $arr = array();
        $arr_filter = array();
        $group_name = array();
        $parent = $group->id;
        while ($c < 10) {
          $parent_obj = GroupAttribute::find($parent);
          if($parent_obj){
            array_push($arr,$parent_obj->filter_id);
            $filter = Filter::find($parent_obj->filter_id);
            if($filter){
              array_push($arr_filter, $filter->name);
            }
            array_push($group_name,$parent_obj->name);
            $parent = $parent_obj->group_id;
          }else{
            break;
          }
        }
        // dd($group_name);
        $not_filter = Filter::whereIn('id',$arr)->get();
        $arr_name = array();
        foreach ($not_filter as $key => $value) {
          array_push($arr_name, $value->name);
        }
        return view('backend.products.folder',compact('group','frames','list_san_pham','attribute_count','group_name','arr_filter'));
    }

    public function getViewFolder1($id){
        $group = GroupAttribute::where('id',$id)->first();
        $c = 0;
        $arr = array();
        if($group){
          if(!in_array($group->filter_id,$arr)){
            array_push($arr, $group->filter_id);
          }
        }
        while ($group) {
          $group = $group->parent;
          if($group){
              if(!in_array($group->filter_id,$arr)){
                array_push($arr, $group->filter_id);
              }
          }
          $c++;
          if( $c > 20 ) break;
        }
        $filter_0 = Filter::whereIn('id',$arr)->where('type',0)->get();
        $filter_1 = Filter::whereIn('id',$arr)->where('type',1)->get();
        $ATTR_IN = array();
        foreach ($filter_0  as $key => $value) {
          if(!in_array($value->attribute_id, $ATTR_IN)){
            array_push($ATTR_IN, $value->attribute_id);
          }
        }
        $query_1 = "";
        foreach ($ATTR_IN as $key => $value) {
            if( $key == sizeof($ATTR_IN) - 1){
              $query_1 .= " ( string_attr LIKE '%,".$value.",%' ) ";
            }else{
              $query_1 .= " ( string_attr LIKE '%,".$value.",%') AND ";
            }
        }
        // dd($query_1);

        $query_2 = "";
        $c_a = 0;
        foreach ($filter_1  as $key => $value) {
         
          $str  = "";
          $attr = Attribute::where('name',$value->name)->where('type',0)->get();
          $c = 0;
          foreach ($attr as $k => $v) {
            if($v->value >= $value->min && $v->value <= $value->max){
                // $v->id;
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
        // echo "select * , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM product_attribute   GROUP BY product_id HAVING ".$query_1." and ".$query_2;
        // dd();
        if($query_1){
          if($query_2){
            $xyz = DB::select(DB::raw("select product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM product_attribute   GROUP BY product_id HAVING ".$query_1." and ".$query_2));
          }else{
            $xyz = DB::select(DB::raw("select product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM product_attribute   GROUP BY product_id HAVING ".$query_1));
          }
        }else{
          if($query_2){
            $xyz = DB::select(DB::raw("select product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM product_attribute   GROUP BY product_id HAVING ".$query_2));
          }else{
            $xyz = DB::select(DB::raw("select product_id , CONCAT(',', GROUP_CONCAT(attribute_id) ,',')  as string_attr FROM product_attribute   GROUP BY product_id "));
          }
        }
        $arr = array();
        foreach ($xyz as $key => $value) {
          array_push($arr, $value->product_id);
        }
        // dd($arr);
        $list_san_pham = Product::whereIn('id',$arr)->paginate(5);
        // dd($list_san_pham);
        $attribute_count = ProductAttribute::select('product_attribute.attribute_id','attributes.value','attributes.name',DB::raw('count(*) as num'))->whereIn('product_attribute.product_id',$arr)->groupby('product_attribute.attribute_id')->leftjoin('attributes',"product_attribute.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();

        // dd($attribute_count);
        return view('backend.products.folder',compact('arr','attribute_count'));
    }
   
    // danh sách phí vận chuyển
    public function listTranspost(){
      return view('backend.transpost.list');
    }
    // edit giá province
    public function postProvince(Request $req){
      $id = $req->id;
      $price = $req->price;
      $value = $req->value;
      $province = Province::find($id);
      if($province){
        $province->price = (int)$price;
        if($province->save()){
          $district = District::where('provinceid',$province->id)->get();
          foreach ($district as $key => $value) {
            $value->price = $province->price;
            $value->save();          
          }
        }
         return json_encode(['status'=>true,'price'=>$price]);
      }else{
         return json_encode(['status'=>false]);
      }
    }

    //edit giá district
    public function postDistrict(Request $req){
      $id = $req->id;
      $price = $req->price;
      $district = District::find($id);
      if($district){
        $district->price = (int)$price;
        $district->save();
         return json_encode(['status'=>true,'price'=>$price]);
      }else{
         return json_encode(['status'=>false]);
      }
    }

     // đặt giá provinve
    public function formdatgiaProvince(Request $req){
      $id = $req->id;
      $province = Province::find($id);
      $view = view('backend.transpost.ajax-gia-province',['province'=>$province]);

      return json_encode(['status'=>true,'view'=>$view.'']);
    }

    // dặt giá đíteict
    public function formdatgiaDistrict(Request $req){
      $id = $req->id;
      $district = District::find($id);
      $view = view('backend.transpost.ajax-gia-district',['district'=>$district]);

      return json_encode(['status'=>true,'view'=>$view.'']);
    }
    // Hiển thị trang sửa 
    public function editProduct($id =null ){
      
      $product = Product::find($id);
      if($product){
          $content  = ContentProduct::where('product_id',$product->id)->get();

          $cate = ProductInCategory::where('product_id',$product->id)->get();
          $catIds = array();
          foreach ($cate as $cat) {
              $catIds[] = $cat->cate_pro_id;
          }
          $attr = $product->getAttributes_2;
          $size = sizeof($attr);
          for($i = 0 ; $i< $size ; $i++){
            if($i == $size - 1){
            }else{
              if( $attr[$i]->name ==  $attr[$i+1]->name){
                $attr[$i+1]->value = $attr[$i]->value.', '.$attr[$i+1]->value;
                unset($attr[$i]);
              }
            }
          }
          $tags= array();
          if($product->getPostTag !=null){
               foreach ($product->getPostTag as  $tag) {
                   $tags[]= $tag->tag;
                };
               $product_tags= implode(',', $tags);
          }
          else  $product_tags='';

          $images = ProductImage::where('product_id',$product->id)->get();

         return view('backend.products.edit-product',compact('product','content','catIds','images','attr','product_tags'));
      }else{
         return redirect()->back();
      }

      
    }
    // TẠO MỚI SẢN PHẨM
    public function formProduct(Request $req){
      // dd($req->all());
      // START Lấy ra config ảnh thumb
      $config_img = array('width'=>223,'height'=>181);
      $config_img_detail = array('width'=>101,'height'=>84);
      $product_config = Item::where('key_layout','config_thumb_product')->get();
      if($product_config){
          if(isset($product_config[0])){
            $w_h = explode('x',$product_config[0]->value);
            $w = 0;
            $h = 0;
            if(isset($w_h[0])) $w = (int) $w_h[0];
            if(isset($w_h[1])) $h = (int) $w_h[1];
            if($w >0 && $h> 0)  $config_img = array('width'=>$w,'height'=>$h);

          }
          if(isset($product_config[1])){
             $w_h = explode('x',$product_config[1]->value);
            $w = 0;
            $h = 0;
            if(isset($w_h[0])) $w = (int) $w_h[0];
            if(isset($w_h[1])) $h = (int) $w_h[1];
            if($w >0 && $h > 0)  $config_img_detail = array('width'=>$w,'height'=>$h);
          }
      }
      // END Lấy ra config ảnh thumb

      // START Lấy các thông tin từ POST
      $submit = $req->submit;     
      $product_name = $req->product_name;
      $product_des = $req->product_des;
      $price = $req->price;
      $price_sale = $req->price_sale;
      $price =  (int) $price;
      $price_sale =  (int) $price_sale;
      $product_code = $req->product_code;
      $sku = (int) $req->sku;
      $weight = (float) $req->weight;
      $label = $req->label;
      $img_product = $req->img_product;
      $choose_cate = $req->choose_cate;
      $post_name = $req->post_name;
      $post_content = $req->post_content;
      $tab_list = $req->tab_list;
      $attrbute_k = $req->attrbute_k;
      $attrbute_v = $req->attrbute_v;
      $feature_k = $req->feature_k;
      $feature_v = $req->feature_v;
      $link_youtube = $req->youtube;
      if(!$link_youtube) $link_youtube = array();
      $arr_youtube = array();
      foreach ($link_youtube as $key => $value) {
          if(trim($value)) array_push($arr_youtube, $value);
      }
      if(!$attrbute_v )  $attrbute_v = array();
      if(!$attrbute_k )  $attrbute_k = array();
      if(!$feature_k )  $feature_k = array();
      if(!$feature_v )  $feature_v = array();
      $str_special = "***";
      // END khởi tạo thông tin


      // START Tạo sản phẩm gốc
      $product = new Product();
      // $product->name  = $req->product_seri;
      $product->price  = $str_special.$price.$str_special;
      $product->price_sale  = $str_special.$price_sale.$str_special;
      // if($submit == "post"){
      //     $product->status  = 1;
      // }else{
      $product->status  = 0;
      // } 
      
      $code_frame_fails = Frame::where('code_frame',$product_code)->first();
      if(!$code_frame_fails){
       
      }else{
        return redirect()->back()->with('error',"Mã sản phẩm này đã tồn tại")->withInput(Input::flash());
      }

      if($product->save()){
              // gắn product vào cateogory
              if($choose_cate){
                $product->getCategory()->attach($choose_cate); 
              }
              // Thêm Tag vào
              if($req->has('seo_tags')){
                      $tags = explode(',', $req->seo_tags);
                      foreach ($tags as  $tag) {
                          $tagsname = TagP::where('tag','=', trim($tag))->first();
                          if($tagsname == null){
                                $tags_column = new TagP;
                                $tags_column->tag = trim($tag);
                                $tags_column->save();
                                $product->getPostTag()->attach($tags_column);
                          }
                          else {
                                $product->getPostTag()->attach($tagsname);
                          }
                      }
              }
              // Gắn thuộc tính vào product
              if($attrbute_k){
                foreach($attrbute_v as $key => $attr_item){
                    $str_va =  explode(",", $attrbute_v[$key]);
                    foreach($str_va as $str_item){
                      // duyệt các item trong key
                      $filter_group = Attribute::where('name',$attrbute_k[$key])->where(
                            'type',1)->first();
                      if(!$filter_group) break;
                      $avaiable = $filter_group->avaiable;
                      $str_item  = trim($str_item);
                      if(strlen($str_item)){
                      // nếu giá trị tồn tại không thì tạo mới
                            if($filter_group->avaiable == 0){
                                $skjau  = Attribute::where('name',$attrbute_k[$key])->where('value',$str_item)->first();
                                $product->getAttributes()->attach($skjau);
                            }else{
                                if(ctype_digit((string) $str_item)){
                                  $str_item =  (int)$str_item;
                                }else{
                                  $str_item = (float)($str_item);
                                }
                                $skjau = Attribute::firstOrNew(['name' => $attrbute_k[$key],
                                'value' => $str_item]);
                                $skjau->type = 0;
                                $skjau->avaiable  = $avaiable;
                                $skjau->init = $filter_group->init;
                                $skjau->save();
                                $product->getAttributes()->attach($skjau);
                            }                          
                      }
                      if($avaiable == 1){
                          break;
                      }
                    }
                }
                // Tao filter
              }
              // START ADD FRAME
              $frame = new Frame;
              $frame->name = $req->product_name;
              $frame->sku = $sku;
              $frame->weight = $weight;
              $frame->product_id = $product->id;
              $frame->slug = str_slug($req->product_name);
              if($req->hasFile('prod_img')){
                  $file = array('image' => Input::file('prod_img'));
                  $rules = array('image' => 'mimes:jpeg,bmp,png');
                  $validator = Validator::make($file, $rules);
                  if ($validator->fails()) {
                      
                  }else{

                      $file = Input::file('prod_img');
                      $nameimg  =  uniqid().'-'.date('d-m-Y').".".$file->getClientOriginalExtension();            
                      $file->move(public_path().'/assets/product/', $nameimg);
                      $frame->img = '/assets/product/'.$nameimg;
                      $frame->saveThumb($config_img);
                  }
              }
              $frame->description = $product_des;
              $frame->price = $price;
              $frame->price_sale = $price_sale;
              if($submit == "post"){
                  $frame->status  = 1;
              }else{
                  $frame->status  = 0;
              }   
              $frame->label  = $label;
              $code_frame_fails = Frame::where('code_frame',$product_code)->first();
              if(!$code_frame_fails){
                $frame->code_frame = $product_code;
              }else{
                return redirect()->back()->with('error',"Mã sản phẩm này đã tồn tại")->withInput(Input::flash());
              }
              
              $frame->youtube_link = json_encode($arr_youtube);
              
              $frame->attribute_id = 0;
              
              
              $frame->create_by = session('admin')->id;
              // Gắn category vào Frame
              if($frame->save()){
                // sản phẩm liên quan
                $list = sizeof($req->productId);
                $list_p = $req->productId;
                if($list > 0){
                  for ($i=0; $i <$list ; $i++) { 
                    $id_fr = $list_p[$i];
                    $frame_related = Frame::find($id_fr);
                    if(sizeof($frame_related)){
                      $related_frame = new Related_product;
                      $related_frame->frame_id = $frame->id;
                      $related_frame->frame_related = $frame_related->id;
                      $related_frame->save();
                    }
                  }
                }
                if($choose_cate){
                  // gắn product vào cateogory
                  $frame->getCategory()->attach($choose_cate); 
                }
                $count = 0;
                for($i= sizeof($post_name)-1 ;$i>=0; $i--){
                    $count ++;
                    $c = new ContentFrame;
                    $c->frame_id = $frame->id;;
                    $c->name = $post_name[$i];
                    $c->content = $post_content[$i];
                    $c->description = $post_name[$i];
                    $c->rank = $count;
                    if($tab_list[$i]){
                      $c->json = $tab_list[$i];
                    }
                    $c->save();
                }
              }
              if($img_product){
                  $list_images =  explode(",,,", $img_product);
                  foreach ($list_images as $key => $value) {
                        $FrameImage = new FrameImage;
                        $FrameImage->frame_id =$frame->id ;
                        $FrameImage->img =$value;
                        $FrameImage->group_name ='' ;
                        $FrameImage->type ='' ;
                        $FrameImage->saveThumb($config_img_detail); 
                        $FrameImage->save(); 
                  }
              }
              // Gắn thuộc tính vào Frame
              if($attrbute_k){
                foreach($attrbute_v as $key => $attr_item){
                    if( $attrbute_k[$key] =="Giá"){
                      continue;
                    }
                    $str_va =  explode(",", $attrbute_v[$key]);
                    foreach($str_va as $str_item){
                      // duyệt các item trong key
                      $filter_group = Attribute::where('name',$attrbute_k[$key])->where(
                            'type',1)->first();
                      if(!$filter_group) break;
                      $avaiable = $filter_group->avaiable;
                      $str_item  = trim($str_item);
                      if(strlen($str_item)){
                          if($filter_group->avaiable == 0){
                                $skjau  = Attribute::where('name',$attrbute_k[$key])->where('value',$str_item)->first();
                                $frame->getAttributes()->attach($skjau);
                          }else{
                                if(ctype_digit((string) $str_item)){
                                  $str_item =  (int)$str_item;
                                }else{
                                  $str_item = (float)($str_item);
                                }
                                $skjau = Attribute::firstOrNew(['name' => $attrbute_k[$key],
                                'value' => $str_item]);
                                $skjau->type = 0;
                                $skjau->avaiable  = $avaiable;
                                $skjau->init = $filter_group->init;
                                $skjau->save();
                                $frame->getAttributes()->attach($skjau);
                          }       
                      }
                      if($avaiable == 1){
                          break;
                      }
                    }
                }
                // Tao filter
              }
              // Giá
              $attr_price = $price;
              if($price_sale) $attr_price = $price_sale;
              if(ctype_digit((string) $attr_price)){
                $attr_price =  (int)$attr_price;
              }else{
                $attr_price = (float)($attr_price);
              }
              $filter_group_sale = Attribute::where('name',"Giá")->where(
                            'type',1)->first();
              if(!$filter_group_sale){
                $filter_group_sale = new Attribute;
                $filter_group_sale->name = "Giá";
                $filter_group_sale->type = 1;
                $filter_group_sale->avaiable = 1;
                $filter_group_sale->init = "vnđ";
                $filter_group_sale->save();
              }
              $skjau = Attribute::firstOrNew(['name' => "Giá",
              'value' => $attr_price]);
              $skjau->type = 0;
              $skjau->avaiable  = 1;
              $skjau->init = $filter_group_sale->init;
              $skjau->save();
              $frame->getAttributes()->attach($skjau);
              // Gắn đặc tính vào Frame
              if($feature_k){
                foreach($feature_v as $key => $attr_item){
                    $str_va =  explode(",", $feature_v[$key]);
                    foreach($str_va as $str_item){
                      // duyệt các item trong key
                      $feature_root = Feature::where('name',$feature_k[$key])->where(
                            'type',1)->first();
                      if(!$feature_root) break;
                      $str_item  = trim($str_item);
                      if(strlen($str_item)){
                          $feature = Feature::firstOrNew(['name' => $feature_k[$key],
                          'value' => $str_item]);
                          $feature->type = 0;
                          $feature->init = $feature_root->init;
                          $feature->save();
                          $frame->getFeatures()->attach($feature);
                      }
                    }
                }
              }
              // Thêm Tag vào Frame
              if($req->has('seo_tags')){
                      $tags = explode(',', $req->seo_tags);
                      foreach ($tags as  $tag) {
                          $tagsname = TagP::where('tag','=', trim($tag))->first();
                          if($tagsname == null){
                                $tags_column = new TagP;
                                $tags_column->tag = trim($tag);
                                $tags_column->save();
                                $frame->getPostTag()->attach($tags_column);
                          }
                          else {
                                $frame->getPostTag()->attach($tagsname);
                          }
                      }
              }

              // END ADD FRAME
            $ALL_FRAME_PUBLIC = Frame::where('product_id',$product->id)->where('status',1)->get();
            $name = "";
            $price_arr = array();
            $price_sale_arr = array();
            foreach ($ALL_FRAME_PUBLIC as $key => $value) {
              $name .= $value->name."***";
              $price_item = $value->price;
              $price_sale_item = $value->price_sale;
              array_push($price_arr, $price_item); 
              array_push($price_sale_arr, $price_sale_item); 
            }
            $product->name = $product_name;
            $product->description = $product_des;
            $product->price = json_encode($price_arr);
            $product->price_sale = json_encode($price_sale_arr);
            $product->save();   
            $this->OptimalOneProduct($product->id); 
            $this->updateFrame($frame->id);
            return redirect()->route('product.list.product')->with('success','Thêm Sản Phẩm Thành Công');
        }
        else{
          return redirect()->back()->with('error','Có lỗi trong việc thêm sản phẩm');
        }
        
    }
     // Sửa sản phẩm
    public function formProductEdit(Request $req){
       return redirect("/");
    }
    public function del_product_post(Request $req)
    {
      $product = Product::find($req->id);
      if($product->getImages()->count()){
      foreach ($product->getImages() as  $value) {
         File::delete($value->img);
      }
      $product->getImages()->delete();
    }
      File::delete($product->images);
      $product->getCategory()->sync([]);
      $product->delete();
      echo 'true';
    }
   
    
    
    public function del_post(Request $req){
        $post= Post::findOrFail($req->id);
        if($post->getPostCategory->count()){

            $post->getPostCategory()->delete();
        }
        $post->delete();
        echo 'true';
    }
    
    public function attribute_list(){
    	$attribute = Attribute::all();
    	return view('backend.products.attribute' ,compact('attribute'));
    }

    public function attribute_list_post(Request $req){
    	 $attribute = new Attribute;
    	 $attribute->name = $req->name;
    	 if($req->has('min_price') && $req->has('max_price')){
            $attribute->min = $req->min_price;
            $attribute->max = $req->max_price;
    	 }
         if($req->has('min_price') &&  !$req->has('max_price') || !$req->has('min_price') && $req->has('max_price')){
             return redirect()->route('product.attribute.list')->with('error', 'Bạn nhập khoảng giá trị cho bộ lọc chưa đúng');
         }
         if($req->has('value')){
            $check = Attribute::where('value', $req->value)->where('name', $req->name)->get();

            if(count($check) >0){

                return redirect()->route('product.attribute.list')->with('error', 'Thuộc tính đã đã tồn tại');
            }
            $attribute->value = $req->value;
         }
         $attribute->type = $req->type;
         if($attribute->save()){
            
         return redirect()->route('product.attribute.list')->with('success', 'Thêm thuộc tính thành công');
        }
    }
    public function edit_attribute(Request $req){

      $attribute = Attribute::find($req->id); 
      $view = view('backend.ajax.ajax-attribute',compact('attribute'));
      return $view;
    }
    public function update_edit_post(Request $req){
        $attribute = Attribute::find($req->id);
        $attribute->name = $req->name;
        $attribute->type = $req->type;
        if($req->type !=2){
           $attribute->min = ''; 
           $attribute->max = '';
           $attribute->value = $req->value; 
        }
        else{
           $attribute->value = ''; 
           $attribute->min = $req->min_price; 
           $attribute->max = $req->max_price;
        }
         if($attribute->save()){
            
         return redirect()->route('product.attribute.list')->with('success', 'Chỉnh sửa thuộc tính thành công');
        }
    }
    public function del_attribute(Request $req){
        $attribute = Attribute::find($req->id);
        $attribute->delete();
        echo 'true';
        
    }
    // Danh muc san pham
    public function listCategoryProduct(){
        return view('backend.products.list_category_pro');
    }
    public function listGroupProduct(){
        return view('backend.products.list_category_pro_admin');
    }
    public function createCategoryProduct(){
        return view('backend.products.create_category');
    }
    public function post_create_category_product(Request $req){
         $cate = new CategoryProduct;
        if($req->hasFile('cate_img')){
            $file = array('image' => Input::file('cate_img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('category.product.add')->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
            }else{
                $file = Input::file('cate_img');
                $file->move(public_path().'/assets/product/category/', $file->getClientOriginalName());
                $cate->img = '/assets/product/category/'.$file->getClientOriginalName();
              
            }
        }
        if($req->cate_des ){
            $cate->description = $req->cate_des;
        }
        if($req->cate_parent ){
            $cate->parent_id = $req->cate_parent;
            // get parent 
        }
        if($req->cate_name ){
            $cate->name = $req->cate_name;
            $cate->prefix = str_slug($req->cate_name,'-');
            $cate->save();
              return Redirect::to(route('category.product.add'))->with(['success'=>'Thêm danh mục thành công']);
        }
        return Redirect::to(route('category.product.add'))->with(['error'=>'Lỗi không xác định']);
    }

    public function edit_product_category($id){
        if($id ==null){
            return Redirect::to('admin.home');
        }else{
            $catId = CategoryProduct::find($id);
            if($catId)  return view('backend.products.edit_category_pro',compact('catId'));
        }
        return Redirect::to('admin.home');
    }

    public function save_edit_category(Request $req){
        $id = $req->id;
         $cate = CategoryProduct::Find($id);
         if(!$cate)  return Redirect::to('admin.home'); 


         if($req->hasFile('cate_img')){
            $file = array('image' => Input::file('cate_img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('cate.products.edit')->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
            }else{
                $file = Input::file('cate_img');
                $file->move(public_path().'/assets/product/category/', $file->getClientOriginalName());
                $cate->img = '/assets/product/category/'.$file->getClientOriginalName();
            }
        }
        if($req->cate_des ){
            $cate->description = $req->cate_des;
        }
        if(session('admin')->id == 1){
          if($req->cate_parent !=0 ){
              $cate->parent_id = $req->cate_parent;
              // get parent 
          }
          else{
              $cate->parent_id = 0;
          }
        
        }
        
        if($req->cate_name ){
            $cate->name = $req->cate_name;
            $cate->prefix = str_slug($req->cate_name,'-');
            $cate->save();
              
        }
        return Redirect::to(route('cate.products.edit',['id'=>$id]))->with(['success'=>'Chỉnh sửa thành công']);
    }
    public function del_product_category(Request $req){

         $category =CategoryProduct::find($req->id);
          if($category->editable == 1){
            echo 'false';
            return ;
          } 
        if($category->subcategory->count()){
                    foreach ($category->subcategory as $value) {
                         if($value->getsubcate->count()){
                          
                            $value->getsubcate()->delete();
                         }
                    }
                $category->subcategory()->delete();
             }
         if($category->getsubcate->count()){

            $category->getsubcate()->delete();
         }
         $category->delete();

         echo 'true';
    }

    public function products_in_cate($id_cate = null)
    {
         $cate = CategoryProduct::where('id',$id_cate)->first();
         if($cate){
            return view('backend.products.list_in_cate',compact('cate'));
         }
         return redirect()->back();
    }
    public function createAttribute(Request $req){
      $name =  $req->name;
      $choose =  $req->type;
      $init = $req->init;
      $obj = Attribute::check($name,1);
      if($obj){
        return json_encode(array('status'=>false,'message'=>"Thuộc tính này đã tồn tại"));
      }else{
        $attr = new Attribute;
        $attr->name = $name;
        $attr->prefix = str_slug($name);
        $attr->type = 1;
        $attr->avaiable = $choose;
        $attr->status = 1;
        $attr->init = $init;
        $attr->save();
        return json_encode(array('status'=>true,'message'=>"Đã tạo mới thuộc tính"));
      }
      
    }
    
    public function checkKey(Request $req){
      $key = $req->key;

      $list = Attribute::where('name',$key)->where('type',0)->get();
      return json_encode(array('list'=>$list));
    }
    public function addFilterPrice(Request $req){
      $min = $req->min;
      $max = $req->max;
      $name = $req->name;
      $avaiable = $req->avaiable;
      if($name == "price"){
        $filter  = new FilterPrice;
        $filter->name = "price";
        $filter->min = $min;
        if($min <= 0 ){
          $filter->config_name = "Nhỏ hơn ".$max;
        }else{
          $filter->config_name = "Từ ".$min." đến ".$max;
        }
        $filter->max = $max;
        $filter->type = 1;
        $filter->save();
        return json_encode(array('status'=>true,'item'=>$filter,'price'=>1));
      }else{
        $attr_filter = Attribute::where('name',$name)->where('type',1)->first();
        if(sizeof($attr_filter)){
            $filter  = new Filter;
            $filter->name = $name;
            $filter->min = $min;
            $filter->max = $max;
            $filter->type = 1;
            $filter->attribute_id = $attr_filter->id;
            $filter->config_name = $min.$attr_filter->init." - ".$max.$attr_filter->init;
            $filter->save();
            return json_encode(array('status'=>true,'item'=>$filter,'price'=>0));
        }
      }
      return json_encode(array('status'=>false));
    }

    public function getFilterAjaxDT(Request $req){
      $id = $req->id;
      $filter = Filter::find($id);
      $attr = Attribute::where('id',$filter->attribute_id)->first();
      if(sizeof($filter)){
        return json_encode(array('status'=>true,'item'=>$filter,'attr'=>$attr));
      }else{
        return json_encode(array('status'=>false,'item'=>null));
      }
    }

    public function getFilterAjaxDL(Request $req){
      $id = $req->id;
      $filter = Filter::find($id);
      $attr = Attribute::where('id',$filter->attribute_id)->first();
      if(sizeof($filter)){
        return json_encode(array('status'=>true,'item'=>$filter,'attr'=>$attr));
      }else{
        return json_encode(array('status'=>false,'item'=>null));
      }
    }
    public function saveFilterAjax(Request $req){
        $id = $req->id_dt;
        $value = trim($req->value);
        $img = $req->img;
        $filter = Filter::find($id);
        $attribute = Attribute::find($filter->attribute_id);
        if(sizeof($filter) && sizeof($attribute)){
            $attribute->value = $value;
            $attribute->save();
            $filter->value = $value;
            if($req->hasFile('img')){
                $file = array('image' => Input::file('img'));
                $rules = array('image' => 'mimes:jpeg,bmp,png');
                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    
                }else{
                    $file = Input::file('img');
                    $name = uniqid().'-'.date('d-m-Y').str_slug($value, '-').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/assets/product/filter/', $name);
                    $filter->img = '/assets/product/filter/'.$name;
                  
                }
            }
            $filter->save();
            return json_encode(array('status'=>true,'item'=>$filter));
        }else return json_encode(array('status'=>false,'item'=>null));
    }

    public function saveFilterAjaxDL(Request $req){
        $id = $req->id_dl;
        $name_config = trim($req->config_name);
        $img = $req->img;
        $filter = Filter::find($id);
        if(sizeof($filter)){
            $filter->config_name = $name_config;
            if($req->hasFile('img-dl')){
                $file = array('image' => Input::file('img-dl'));
                $rules = array('image' => 'mimes:jpeg,bmp,png');
                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    
                }else{
                    $file = Input::file('img-dl');
                    $name = uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/assets/product/filter/', $name);
                    $filter->img = '/assets/product/filter/'.$name;
                  
                }
            }
            $filter->save();
            return json_encode(array('status'=>true,'item'=>$filter));
        }else return json_encode(array('status'=>false,'item'=>null));
    }
    // Xóa toàn bộ thuộc tính
    public function delAttribute(Request $req){
      $name = $req->name;
      if($name == "Giá"){
         return json_encode(array('status'=>false,'message'=>"Không thể xóa thuộc tính này"));
      }
      $check = Attribute::where('name',$name)->where('type',1)->first();
      if($check){
        if($check->isDelete == 1 ){
          return json_encode(array('status'=>false,'message'=>"Không thể xóa thuộc tính này"));
        }else{
          $group  = GroupAttribute::get();
          $in = array();
          foreach ($group as $key => $value) {
            array_push($in, $value->filter_id);
          }
          $filter = Filter::whereIn('id',$in)->get();
          $name_filter = array();
          foreach ($filter as $key => $value) {
              array_push($name_filter, $value->name);
          }
          if(in_array($name, $name_filter)){
            return json_encode(array('status'=>false,'message'=>"Thuộc tính đã có trong danh mục"));
          }
          $attr = Attribute::where('name',$name)->delete();
          $filter = Filter::where('name',$name)->delete();
          return json_encode(array('status'=>true,'message'=>"Xóa thành công"));
        } 
      } 
       return json_encode(array('status'=>false,'message'=>"Không thể xóa thuộc tính này"));
    }

    // xóa filter
    public function delFilterAjax(Request $req){
      $id = $req->id;
      $price = $req->price;
      $can_delete = 1;
      if($price ){
        $filter = FilterPrice::find($id);

      }else{
        $filter = Filter::find($id);
        if($filter){
          $groupAttribute = GroupAttribute::where('filter_id',$filter->id)->first();
          if($groupAttribute){
            $can_delete = 0;
          }
        }
      }
      if(sizeof($filter)){
        if($filter->type == 1){
          if($can_delete){
              $filter->delete();
              return json_encode(array('status'=>true,'message'=>"Xóa thành công"));
          }else{
            return json_encode(array('status'=>false,'message'=>"Thuộc tính đã có trong danh mục"));
          }
          
        }else{
          if($can_delete){
            $attribute_id  = $filter->attribute_id;
            $attr = Attribute::find($attribute_id);
            $attr->delete();
            $filter->delete();
            return json_encode(array('status'=>true,'message'=>"Xóa thành công"));
          }else{
            return json_encode(array('status'=>false,'message'=>"Thuộc tính đã có trong danh mục"));
          }
        }
      }else{
        return json_encode(array('status'=>false,'message'=>"Lỗi không xác định"));
      } 
    }

    public function changeFilterStatus(Request $req){
      $id=  $req->id;
      $attr = Attribute::find($id);
      if(sizeof($attr)){
        if($attr->status == 0){
          $attr->status = 1;
        }else{
          $attr->status = 0;
        }
        $attr->save();
        return json_encode(array('status'=>true));
      }else{
        return json_encode(array('status'=>false));
      }
    }
    public function getAttrAjax(Request $req){
      $name = $req->name;
      $attr = Attribute::where('name',$name)->where('type',1)->first();
      if(sizeof($attr)){
         return json_encode(array('status'=>true,'attr'=>$attr));
      }else{
        return json_encode(array('status'=>false));
      }
    }
    public function saveAttrAjax(Request $req){
      $id= $req->id;
      $name= $req->name;
      $init= $req->init;
      $attr = Attribute::where('id',$id)->where('type',1)->first();

      if(sizeof($attr)){
          $li_attr = Attribute::where('name',$name)->get();
           $li_filter = Filter::where('name',$name)->get();
           $cur_name = $attr->name;
        DB::beginTransaction();
        try {
            DB::table('attributes')->where('name',$cur_name)->update(array('name'=>$name,'init'=>$init));
            DB::table('filters')->where('name',$cur_name)->update(array('name'=>$name));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        $attr = Attribute::where('id',$id)->where('type',1)->first();
        return json_encode(array('status'=>true,'attr'=>$attr));
      }else{
        return json_encode(array('status'=>false));
      }
    }

    //Nhập Kho
    public function getNhapKho(Request $req){
      $id = $req->id;
      $frame = Frame::find($id);
      if($frame){
        $email_out_of_stocks = Email_out_of_stocks::where('add_1',$frame->id)->where('status',0)->paginate(5);
        $html = view('backend.products.ajax-edit-sku',['frame'=>$frame,'email_out_of_stocks'=>$email_out_of_stocks]);
        return json_encode(array('status'=>true,'html'=>$html.""));
      }else{
       return json_encode(array('status'=>false)); 
      }
    }

    // submit form

    public function postSubmitNhapKho(Request $req){
      $id = $req->frame_id;
      $sku = $req->sku;
      $description = $req->description;
      $content = $req->content;
      $frame = Frame::find($id);
      if($frame){
          if($frame->sku <= 0){
            $frame->sku = $frame->sku + $req->sku;
            if($frame->save()){
              if($frame->sku > 0){
                $email_het_hang = Email_out_of_stocks::where('add_1',$frame->id)->where('status',0)->get();
                $in = array();
                foreach ($email_het_hang as $key => $value) {
                  $value->status = 1;
                  $value->save();
                  array_push($in,$value->email);
                }
                 ignore_user_abort(true);
                 set_time_limit(3000);
                 ob_start();
                 echo "true";
                 $size = ob_get_length();
                 header('Connection: close');
                 header('Content-Length: '.$size);
                 header("Content-Range: 0-".($size-1)."/".$size);
                 ob_flush();
                 flush();
                 try {
                     $mail = System::select('email_send','email_password')->first();
                     if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
                         config(['mail.username' => $mail->email_send]);
                         config(['mail.password' => $mail->email_password]);
                         config(['mail.port' => "587"]);
                         config(['mail.host' => "smtp.gmail.com"]);
                         config(['mail.encryption' => "tls"]);
                         $link = route('getProDetail',['id'=>$frame->id,'slug'=>$frame->slug]);
                         $data = ['frame'=>$frame,'link'=>$link];
                         if(isset($in)){
                                 Mail::send('backend.email.so-luong',$data, function($message) use ($mail,$in,$frame){
                                 $message->from($mail->email_send);
                                 $message->to($in,'Admin')->subject(url('')." Đã có sản phẩm mới bạn mong chờ ".$frame->name);
                             });
                         }
                     }
                 }catch (Exception $e) {

                 }
                 $delete = Email_out_of_stocks::where('add_1',$frame->id)->where('status',1)->get();
                 foreach($delete as $value0){
                  $value0->delete();
                 }
              }
            }
          }else{
            $frame->sku = $frame->sku + $req->sku;
            $frame->save();
            echo "true";
          }
      }else{

      }
    }


    //phân trang nhập kho
    public function getPhanTrangNhapKho(Request $req){
      $id = $req->id;
      $page = $req->page;
      $frame = Frame::find($id);
      if($frame){
        $email_out_of_stocks = Email_out_of_stocks::where('add_1',$frame->id)->paginate(1);
        $view = view('backend.products.ajax-html-email',['frame'=>$frame,'email_out_of_stocks'=>$email_out_of_stocks]);
        return json_encode(array('status'=>true,'view'=>$view.""));
      }else{
        return json_encode(array('status'=>false));
      }
    }

  // config-hethang-emails
   public function ConfigEmailHetHang(){
     $email = Email_General::where('name','Config Hết Hàng')->first();
     $html = view('backend.products.ajax-config-hethang',['email'=>$email]);
     return json_encode(array('status'=>true,'html'=>$html.""));
   }

   public function SubmitConfigEmailHetHang(Request $req){
     $email = trim($req->email);
     $config = (int)$req->config;
     $description = $req->description;
     $content = $req->content;
     
     $email_hethang = Email_General::where('name','Config Hết Hàng')->first();
     if(!$email_hethang){
       $email = new Email_General;
       $email->name = 'Config Hết Hàng';
       $email->email = $email;
       $email->config_sku = $config;
       $email->description = "des";
       $email->content = "content";
       $email->save();
        return json_encode(array('status'=>true));
     }else{
       $email_hethang = Email_General::where('name','Config Hết Hàng')->first();
       $email_hethang->email = $email;
       $email_hethang->config_sku = $config;
       $email->description = "des";
       $email->content = "content";
       $email_hethang->save();
        return json_encode(array('status'=>true));
     }

    
   }
   public function getFilterPriceAjax(Request $req){
      $id = $req->id;
      $filter = FilterPrice::find($id);
      if(sizeof($filter)){
        return json_encode(array('status'=>true,'filter'=>$filter));
      }else{
         return json_encode(array('status'=>false,'filter'=>null));
      }
    }

    public function saveFilterPriceAjax(Request $req){
      $id = $req->id1;
      $config_name = $req->config_name1;
      $img = $req->img1;
      $filter1 = FilterPrice::find($id);
      if(sizeof($filter1)){
        $filter1->config_name = $config_name;
        if($req->hasFile('img1')){
          $file = array('image' => Input::file('img1'));
          $rules = array('image' => 'mimes:jpeg,bmp,png');
          $validator = Validator::make($file, $rules);
          if($validator->fails()){

          }else{
            $file = Input::file('img1');
            $name = uniqid().'-'.date('d-m-Y').str_slug($config_name, '-').'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/assets/product/filter/', $name);
            $filter1->img = '/assets/product/filter/'.$name;
          }
        }
        $filter1->save();
        return json_encode(array('status'=>true,'filter'=>$filter1));
      }else return json_encode(array('status'=>false,'item'=>null));
    }

    public function EditAjaxStatusList (Request $req){
      $id = $req->id;
      $status = $req->status;
      $frame = Frame::find($id);

      if($frame){
        if( $frame->status == 1 ){
          $frame->status = 0;
          $frame->save();
          $product = Product::find($frame->product_id);
          if($product){
              $frame_public = Frame::where('product_id', $product->id)->where('status', 1)->get(); 
              if( sizeof($frame_public) ){
                $product->status = 1;
                $product->save();
              }else{
                $product->status = 0;
                $product->save();
              }  
          }
          $this->OptimalOneProduct($product->id);
          $this->updateFrame($frame->id);
          return json_encode(array('status'=>true,'frame'=>$frame,'sta'=>0));
        }else{
          $frame->status = 1;
          $frame->save();
          $product = Product::find($frame->product_id);
          if($product){
              $frame_public = Frame::where('product_id', $product->id)->where('status', 1)->get(); 
              if( sizeof($frame_public) ){
                $product->status = 1;
                $product->save();
              }else{
                $product->status = 0;
                $product->save();
              }  
          }
          $this->OptimalOneProduct($product->id);
          $this->updateFrame($frame->id);
          return json_encode(array('status'=>true,'frame'=>$frame,'sta'=>1));
        }

      }else{
        return json_encode(array('status'=>false));
      }
    }
    public function getAjaxLabelList(Request $req){
      $id = $req->id;
      $frame = Frame::find($id);
      if($frame){
        $html = view('backend.products.ajax-edit-label',['frame'=>$frame]);
        return json_encode(array('status'=>true,'html'=>$html.""));
      }

    }

    public function EditAjaxLabelList(Request $req){
      $id = $req->id;
      $label = $req->label;
      $frame = Frame::find($id);
      if($frame){
        $frame->label = $label;
        $frame->save();
        return json_encode(array('status'=>true,'frame'=>$frame));
      }
    }
   

   public function postAddAttrFilter (Request $req){
    $id = $req->id;
    $value = trim($req->value);
    $att = Attribute::where('value',$value)->where('type',0)->first();
    if(sizeof($att)){
      return json_encode(array('status'=>false,'message'=>"Giá trị thuộc tính này đã tồn tại"));
    }else{
      $attr = Attribute::find($id);
      $a = new Attribute;
      $a->name = $attr->name;
      $a->value = $value;
      $a->type = 0;
      $a->status = 0;
      $a->avaiable = 0;
      $a->isDelete = 0;
      if($a->save()){
        $filter = new Filter;
        $filter->value = $a->value;
        $filter->status = 0;
        $filter->name = $attr->name;
        if($req->hasFile('img_add')){
          $file = array('image' => Input::file('img_add'));
          $rules = array('image' => 'mimes:jpeg,bmp,png');
          $validator = Validator::make($file, $rules);
          if($validator->fails()){

          }else{
            $file = Input::file('img_add');
            $name = uniqid().'-'.date('d-m-Y').str_slug($a->value, '-').'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/assets/product/filter/', $name);
            $filter->img = '/assets/product/filter/'.$name;
          }
        }
        $filter->attribute_id = $a->id;
        $filter->type = 0;
        $filter->save();
      }
      return json_encode(array('status'=>true,'filter'=>$filter));
    }
   }

   public function postAddRelatedProduct(Request $req){
        $id = $req->id;
        $frame = Frame::find($id);
        $name = trim($req->key);
        // find product like $name = nsme
        $products  = Frame::orWhere('name','like',"%$name%")->orWhere('code_frame','like',"%$name%")->limit(15)->get();
        if(sizeof($products)){
          $pro = Frame::where('name',$name)->orwhere('code_frame',$name)->first();
          $html_search = view('backend.products.ajax_related_product',['product'=>$products,'frame'=>$frame]);
          return json_encode(array('status'=>true,'product'=>$products,'html_search'=>$html_search.'','pro'=>$pro));
        }else{
          return json_encode(array('status'=>false));
        }
   }

   public function postCheckRelated (Request $req){
      $id = $req->id;
      $product = Frame::find($id);
          if(sizeof($product)){
            $html_check = view('backend.products.ajax_related_product_checkbox',['product'=>$product]);  
            return json_encode(array('status'=>true,'product'=>$product,'html_check'=>$html_check.''));
          }else{
            return json_encode(array('status'=>false));
          }
   }
  
    // Gửi về Modal thuộc tính
   public function getModalAttribute(Request $req){
      $item = GroupAttribute::where('id',$req->id)->where('name','<>','Giá')->first();
      if($item){
         // Kiểm tra anh em, cha có thuộc tính đó chưa?
        $c = 0;
        $arr = array();
        $group_name = array();
        $current_parent = 0;
        $parent = $item->id;
        while ($c < 10) {
          $parent_obj = GroupAttribute::find($parent);
          if($parent_obj){
            array_push($arr,$parent_obj->filter_id);
            array_push($group_name,$parent_obj->name);
            $parent = $parent_obj->group_id;
          }else{
            break;
          }
        }
        // dd($group_name);
        $not_filter = Filter::whereIn('id',$arr)->get();
        $arr_name = array();
        foreach ($not_filter as $key => $value) {
          array_push($arr_name, $value->name);
        }
        $view  = view('backend.products.folder.ajax-get-select-attribute-popup',compact('item','arr_name','group_name'));
        return json_encode(array('status'=>true,'html'=>$view.""));
      } 
      return json_encode(array('status'=>false,'html'=>""));  
   }
    
   // Lấy ra thuộc giá trị của thuộc tính
   public function getSelectAttribute(Request $req){
      $id = $req->attr_id;
      $id_click = $req->id_click;
      $attr= Attribute::where('id',$id)->where('name','<>','Giá')->where('type',1)->first();
      if($attr){
          $list_child = GroupAttribute::where('group_id',$id_click)->get();
          $not_in = array();
          foreach ($list_child as $key => $value) {
            array_push($not_in, $value->filter_id);
          }
          // dd($not_in);
          $filter = Filter::where('name',$attr->name)->get();
          $view  = view('backend.products.folder.ajax-get-select-attribute-value',compact('filter','not_in'));
          return json_encode(array('status'=>true,'html'=>$view.""));
      }
      $not_in = array();
      $filter = array();
      $view  = view('backend.products.folder.ajax-get-select-attribute-value',compact('filter','not_in'));
      return json_encode(array('status'=>true,'html'=>$view.""));
   }
  


  //Xem chi tiet van chuyen
  public function LoadXem(Request $req){
    $id = $req->id;
    $district = District::find($id);
    $conf = Config_distric::where('district_id',$id)->get();
    
    if(sizeof($conf)){
      $max = 0;
      foreach ($conf as $key => $value) {
        if( (float)$value->max_weigh > (float)$max){
          $max = $value->max_weigh;
        }
      }
      // $max = Config_distric::where('district_id',$id)->max('max_weigh');
      $html = view('backend.transpost.load-ajax',['conf'=>$conf,'max'=>$max,'district'=>$district]);
      return json_encode(array('status'=>true,'html'=>$html.""));
    }else{
      echo "0";
    }
  }

 // phí vận chuyển
  public function ajaxSmProvince (Request $req){
      $list = $req->province;
      $max = preg_replace('/[^\dxX]/', '', $req->max);
      $price = preg_replace('/[^\dxX]/', '', $req->price);
      $init_price = preg_replace('/[^\dxX]/', '', $req->init_price);
      $init_weigh = preg_replace('/[^\dxX]/', '', $req->init_weigh);
      $id = $req->id;
      $province = explode(',',$list);
      $o_prov =  Province::wherein('id',$province)->get();
      // foreach tung tinh thanh
      // dd($max);
      for ($k=0; $k < sizeof($max) ; $k++){
          if(preg_replace('/[^\dxX]/', '', $req->max[$k]) != "" && preg_replace('/[^\dxX]/', '', $req->price[$k]) != "" && preg_replace('/[^\dxX]/', '', $req->init_price) != "" && preg_replace('/[^\dxX]/', '', $req->init_weigh) != ""){

            }else{
              return json_encode(array('status'=>false,'not'=>3,'message'=>'Lỗi khi nhập dữ liệu không phải dạng số'));
            }
          if($req->max[$k] != null && $req->price[$k] != null && $req->init_price != null && $req->init_weigh != null){

            }else{
              return json_encode(array('status'=>false,'not'=>1,'message'=>'Không được để trống dữ liệu nhập'));
            }
          if($k > 0){
            if((float)$max[$k] > (float)$max[$k-1]){

            }else{
              return json_encode(array('status'=>false,'not'=>2,'message'=>'Khối lượng sau phải lớn hơn khối lượng trước'));
            }
          }
          if( ($k) < (sizeof($max) - 1 )){
              if($k > 0){
                if((float)$max[$k] > (float)$max[$k-1]){

                }else{
                  return json_encode(array('status'=>false,'not'=>2,'message'=>'Khối lượng sau phải lớn hơn khối lượng trước'));
                }
              }
              if( (int)$max[$k] > (int)$max[$k+1]){
                return json_encode(array('status'=>false,'not'=>2,'message'=>'Khối lượng sau phải lớn hơn khối lượng trước'));
              }
          }else{
              
          }
      }

      foreach ($o_prov as $key => $value2) {
        $c = Config_distric::where('province_id',$value2->id)->delete();
        if($value2){
          $district = District::where('provinceid',$value2->id)->get();
          foreach ($district as $key => $value) {
                  for ($k=0; $k <sizeof($max) ; $k++){ 
                    if($k  < sizeof($max) - 1 ){
                        $con_f = new Config_distric;
                        $con_f->province_id = $value2->id;
                        $con_f->district_id = $value->id;
                        if($k < 1){
                          $con_f->min_weigh = 0;
                        }else{
                          $con_f->min_weigh = $max[$k - 1];
                        }
                        $con_f->max_weigh = $max[$k];
                        $con_f->price = $price[$k];
                        $con_f->init_weigh = $init_weigh;
                        $con_f->init_price = $init_price;
                        $con_f->status = 0;
                        $con_f->save();
                    }else{
                        $con_f = new Config_distric;
                        $con_f->province_id = $value2->id;
                        $con_f->district_id = $value->id;
                        if($k < 1){
                          $con_f->min_weigh = 0;
                        }else{
                          $con_f->min_weigh = $max[$k - 1];
                        }
                        $con_f->max_weigh = $max[$k];
                        $con_f->price = $price[$k];
                        $con_f->init_weigh = $init_weigh;
                        $con_f->init_price = $init_price;
                        $con_f->status = 0;
                        $con_f->save();
                    }
                }
            $value->price = 1;
            $value->save();
          }
        }
        $value2->price = 1;
        $value2->save();
      }
       return json_encode(array('status'=>true));
    }

    public function ajaxSmDistric(Request $req){
      $list2 = $req->district;
      $max2 = preg_replace('/[^\dxX]/', '', $req->max2);
      $init_price2 = preg_replace('/[^\dxX]/', '', $req->init_price2);
      $init_weigh2 = preg_replace('/[^\dxX]/', '', $req->init_weigh2);
      $price2 = $req->price2;
      $district = explode(',',$list2);
      $o_dist =  District::wherein('id',$district)->get();
      for ($k=0; $k < sizeof($max2) ; $k++){ 

          if(preg_replace('/[^\dxX]/', '', $req->max2[$k]) != "" && preg_replace('/[^\dxX]/', '', $req->price2[$k]) != "" && preg_replace('/[^\dxX]/', '', $req->init_price2) != "" && preg_replace('/[^\dxX]/', '', $req->init_weigh2) != ""){

            }else{
              return json_encode(array('status'=>false,'not'=>3,'message'=>'Lỗi khi nhập dữ liệu không phải dạng số'));
            }

          if($req->max2[$k] != null && $req->price2[$k] != null && $req->init_price2 != null && $req->init_weigh2 != null){

              }else{
                return json_encode(array('status'=>false,'not'=>1,'message'=>'Không được để trống dữ liệu nhập'));
              }
           if($k > 0){
                if(((float)$max2[$k]) > ((float)$max2[$k-1])){

                }else{
                  return json_encode(array('status'=>false,'not'=>2,'message'=>'Khối lượng sau phải lớn hơn khối lượng trước'));
                }
              }    
          if( ($k) < (sizeof($max2) - 1 )){
              
              if($k > 0){
                if(((float)$max2[$k]) > ((float)$max2[$k-1])){

                }else{
                  return json_encode(array('status'=>false,'not'=>2,'message'=>'Khối lượng sau phải lớn hơn khối lượng trước'));
                }
              }
              if( (int)$max2[$k] > (int)$max2[$k+1]){
                return json_encode(array('status'=>false,'not'=>2,'message'=>'Khối lượng sau phải lớn hơn khối lượng trước'));
              }
          }else{
              
          }
      }
      // foreach tung tinh thanh
      foreach ($o_dist as $key => $value2) {
          
        $c = Config_distric::where('district_id',$value2->id)->delete();
        if($value2){
            for ($k=0; $k <sizeof($max2) ; $k++){ 
              if($k < sizeof($max2) - 1){
                $con_f = new Config_distric;
                $con_f->province_id = $value2->provinceid;
                $con_f->district_id = $value2->id;
                if($k < 1){
                  $con_f->min_weigh = 0;
                }else{
                  $con_f->min_weigh = $max2[$k - 1];
                }
                $con_f->max_weigh = $max2[$k];
                $con_f->price = $price2[$k];
                $con_f->init_weigh = $init_weigh2;
                $con_f->init_price = $init_price2;
                $con_f->status = 0;
                $con_f->save();
              }else{
                $con_f = new Config_distric;
                $con_f->province_id = $value2->provinceid;
                $con_f->district_id = $value2->id;
                if($k < 1){
                  $con_f->min_weigh = 0;
                }else{
                  $con_f->min_weigh = $max2[$k - 1];
                }
                $con_f->max_weigh = $max2[$k];
                $con_f->price = $price2[$k];
                $con_f->init_weigh = $init_weigh2;
                $con_f->init_price = $init_price2;
                $con_f->status = 0;
                $con_f->save();
              }
          }
        }
        $value2->price = 1;
        $value2->save();
      }
       return json_encode(array('status'=>true));
    }

  public function FolderSubmit1(Request $req){
      $name = $req->name;
      $value = $req->value;
      $key = $req->key;
      $attr_item = Attribute::where('id',$key)->first();
      if( strlen( trim($name) ) == 0){
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Tên không được để trống",'class'=>"danger"]);
        return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
      }
      if(!$attr_item){
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Không tìm thấy thuộc tính",'class'=>"danger"]);
        return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
      }
      $filter_item = Filter::where('name',$attr_item->name)->where('id',$value)->first();
      if($filter_item){
        $check  = GroupAttribute::where('group_id',0)->where('filter_id',$filter_item->id)->first();
        if($check){
            $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
            $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Giá trị này đã chọn",'class'=>"danger"]);
            return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
        }
        $group_attr = new GroupAttribute;
        $group_attr->name = $name;
        $group_attr->group_id = 0;
        $group_attr->number_product = 0;
        $group_attr->filter_id = $filter_item->id;
        $group_attr->save();
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $this->OptimalOneFolder($group_attr->id);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Thêm thành công",'class'=>"success"]);
        return json_encode(array('status'=>true,'html'=>$view."",'message'=>$error.''));
      }else{
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Không tìm thấy bộ lọc",'class'=>"danger"]);
        return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
       
      }
      
   }
   public function FolderSubmit2(Request $req){
      $name = $req->name;
      $value = $req->value;
      $key = $req->key;
      $group_id = $req->group_id;
     
      $attr_item = Attribute::where('id',$key)->first();
      if( strlen( trim($name) ) == 0){
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Tên không được để trống",'class'=>"danger"]);
        return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
      }
      if(!$attr_item){
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Không tìm thấy thuộc tính",'class'=>"danger"]);
        return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
      }
      $filter_item = Filter::where('name',$attr_item->name)->where('id',$value)->first();
      if($filter_item){
        
        $parent = GroupAttribute::where('id',$group_id)->first();
        if(!$parent){
            $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
            $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Folder không tồn tại",'class'=>"danger"]);
            return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
        }
        $check  = GroupAttribute::where('group_id',$parent->id)->where('filter_id',$filter_item->id)->first();
        if($check){
            $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
            $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Giá trị này đã chọn",'class'=>"danger"]);
            return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
        }
        $group_attr = new GroupAttribute;
        $group_attr->name = $name;
        $group_attr->group_id = $parent->id;
        $group_attr->number_product = 0;
        $group_attr->filter_id = $filter_item->id;
        $group_attr->save();
        $this->OptimalOneFolder($group_attr->id);
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Thêm thành công",'class'=>"success"]);
        return json_encode(array('status'=>true,'html'=>$view."",'message'=>$error.''));
      }else{
        $view  = view('backend.products.folder.ajax-get-select-attribute-value',['filter'=>array()]);
        $error  = view('backend.products.folder.ajax-get-select-attribute-error',['message'=>"Không tìm thấy bộ lọc",'class'=>"danger"]);
        return json_encode(array('status'=>false,'html'=>$view."",'message'=>$error.''));
       
      }
      
   }
  private function DeleteFolderLoop($id){
      $group = GroupAttribute::find($id);
      if($group){
        $list_child = $group->subcategory;
        if(sizeof($list_child) ==0 ){
          $group->delete();
        }else{
          foreach ($list_child as $key => $item) {
            $this->DeleteFolderLoop($item->id);
          }
          $group->delete();
        }
      }
   }
  public function FolderDelete(Request $req){
      $id = $req->id;
      $group = GroupAttribute::find($id);
      if($group){
        $this->DeleteFolderLoop($group->id);
        return json_encode(array('status'=>true));
      }else{
        return json_encode(array('status'=>false));
      }
  }
  private function OptimalOneProduct($id){
      $folder = GroupAttribute::get();
      $folder2 = GroupAttribute::get();
      $arr_all = array();
      $all = array();
      $all_filter = array();
      $c =  0;
      foreach ($folder as $key => $value) {
                // nếu value có group_id = 0
                if($value->group_id == 0){
                  array_push($all, array( $value->id) );
                  array_push($all_filter, array ( $value->id , array( $value->filter_id) ) );
                }else{
                    $c = 0;
                    $arr = array();
                    $arr_f = array();
                    array_push($arr, $value->id);
                    array_push($arr_f, $value->filter_id);
                    $current = $value->id;
                    $current_parent = $value->group_id;
                    $check1  = 0 ;
                    while ( $c <= 10) {
                        // kiểm tra nếu thằng nào là cha của $value->id thêm v
                        $check2 = 0 ;
                        foreach ($folder2 as $key2 => $value2) {
                            if($current_parent == $value2->id){
                               $check2++;
                               $current_parent = $value2->group_id;
                               array_push($arr, $value2->id);
                               array_push($arr_f, $value2->filter_id);
                            }
                        }
                        $c++;
                        if($check2 == 0) $check1++;
                    }
                    if($check1){
                        array_push($all, $arr );
                        array_push($all_filter, array($value->id , $arr_f) );
                    }
                }
                
      }
      // danh sách các thư mục
      foreach ($all_filter as $key => $value) {
          $filter_0 = Filter::whereIn('id',$value[1])->where('type',0)->get();
          $filter_1 = Filter::whereIn('id',$value[1])->where('type',1)->get();
          $ATTR_IN = array();
          foreach ($filter_0  as  $x) {
            if(!in_array($x->attribute_id, $ATTR_IN)){
              array_push($ATTR_IN, $x->attribute_id);
            }
          }
          $whatthehell = array();
          foreach ($filter_1  as $x) {
            $ATTR_IN_2 = array();
            $attr = Attribute::where('name',$x->name)->where('type',0)->get();
            foreach ($attr as $k => $v) {
              if( $v->value >= $x->min && $v->value <= $x->max){
                array_push($ATTR_IN_2, $v->id);
              }
            }
            array_push($whatthehell, $ATTR_IN_2);
          }
          $all_filter[$key]['dinhtinh'] = $ATTR_IN;
          $all_filter[$key]['dinhluong'] = $whatthehell;
      }
      $product = Product::find($id);
      if($product){
        $attr_product = $product->getAttributes;
        $frames = Frame::where('product_id',$product->id)->get();
        $has_frame = 0;
        $ARR_GROUP_PRODUCT = array();
        $ARR_GROUP_PRODUCT_STATUS = array();
        foreach ($frames as $k2 => $frame) {
          $ARR_GROUP = array();
          $ARR_GROUP_STATUS = array();
          $attr_frame = $frame->getAttributes;
          $attr_in_frame = array();
          foreach ($attr_frame as $arr_item) {
              array_push($attr_in_frame, $arr_item->id);
          }
          foreach ($all_filter as $k2 => $value){
              $id_folder = $value[0];
              $dinhtinhs = $value['dinhtinh']; // arrar id
              $dinhluongss = $value['dinhluong']; // arrar  (arrar : id)
              // nếu định tính bằng 0:
              if(sizeof($dinhtinhs) ==0){
                // chỉ có thuộc tính định tính
                $c = 0;
                foreach ($dinhluongss as  $dinhluongs) {
                  if(sizeof($dinhluongs) ==0 ){
                    $c = 1;
                    break;
                  }else{
                    $c_temp = 0; 
                    foreach ($dinhluongs as $dinhluong) {
                       if(in_array($dinhluong, $attr_in_frame)){
                            $c_temp = 1;
                            break;
                        }
                    }
                    if($c_temp ==0 ) {
                      $c = 1;
                      break;
                    }
                  }
                }
                if($c ==0 ){
                  array_push($ARR_GROUP , $id_folder);
                  $ARR_GROUP_STATUS[$id_folder] = array('status'=>$frame->status,'product_id'=>$frame->product_id);
                  if(!in_array($id_folder, $ARR_GROUP_PRODUCT)){
                    array_push($ARR_GROUP_PRODUCT , $id_folder);
                    $ARR_GROUP_PRODUCT_STATUS[$id_folder] = array('status'=>$product->status);
                      
                  };
                }
              }else{
                // có thuộc tính định tính
                $c = 0;
                foreach ($dinhtinhs as  $dinhtinh) {
                   if(!in_array($dinhtinh, $attr_in_frame)){
                      $c = 1;
                      break;
                   }
                }
                if($c ==0 ){
                  foreach ($dinhluongss as  $dinhluongs) {
                    if(sizeof($dinhluongs) ==0 ){
                      $c = 1;
                      break;
                    }else{
                      $c_temp = 0; 
                      foreach ($dinhluongs as $dinhluong) {
                         if(in_array($dinhluong, $attr_in_frame)){
                              $c_temp = 1;
                              break;
                          }
                      }
                      if($c_temp ==0 ) {
                        $c = 1;
                        break;
                      }
                    }
                  }
                  if($c ==0 ){
                    array_push($ARR_GROUP , $id_folder);
                    $ARR_GROUP_STATUS[$id_folder] = array('status'=>$frame->status,'product_id'=>$frame->product_id);
                    if(!in_array($id_folder, $ARR_GROUP_PRODUCT)){
                      array_push($ARR_GROUP_PRODUCT , $id_folder);
                      $ARR_GROUP_PRODUCT_STATUS[$id_folder] = array('status'=>$product->status);
                      
                    };
                  }
                }
              }
          }// End Foreach Folder
          $frame->getFolder()->sync($ARR_GROUP_STATUS);
        }// END FOREACH FRAME
        $product->getFolder()->sync($ARR_GROUP_PRODUCT_STATUS);
      }
      foreach ($folder as $key => $value) {
            $frame_list_hidden = RelationFrame::where('group_id',$value->id)->where('status',0)->get();
            $frame_list_public = RelationFrame::where('group_id',$value->id)->where('status',1)->get();
            if(sizeof($frame_list_hidden) == 0 && sizeof($frame_list_public) ==0 ) continue;
            $arr = array();
            $frame_arr_public = array();
            foreach($frame_list_public  as $k => $x) {
                array_push($frame_arr_public, $x->frame_id);
            }
            $attribute_count_public = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$frame_arr_public)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();

            $frame_arr_hidden = array();
            foreach($frame_list_hidden  as $k => $x) {
                array_push($frame_arr_hidden, $x->frame_id);
            }
            $attribute_count_hidden = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$frame_arr_hidden)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();
            foreach ($attribute_count_hidden as $k => $v) {
              $arr[$v->attribute_id] = array('number_item'=>0,'number_item_hidden'=>$v->num,'status'=>0);
            }
            foreach ($attribute_count_public as $k => $v) {
              if(isset($arr[$v->attribute_id])){
                $arr[$v->attribute_id] = array('number_item'=>$v->num,'number_item_hidden'=>$arr[$v->attribute_id]['number_item_hidden'],'status'=>1);
              }else{
                $arr[$v->attribute_id] = array('number_item'=>$v->num,'number_item_hidden'=>0,'status'=>1);
              }
            }
            $x = $value->getAttributes()->sync($arr);
      }
  } 
  private function OptimalOneFolder($id){
      $folder = GroupAttribute::get();
      $folder2 = GroupAttribute::get();
      if(!$folder) return null;
      $arr_all = array();
      $all = array();
      $all_filter = array();
      $c =  0;
      foreach ($folder as $key => $value) {
                // nếu value có group_id = 0
                if($value->group_id == 0){
                  array_push($all, array( $value->id) );
                  array_push($all_filter, array ( $value->id , array( $value->filter_id) ) );
                }else{
                    $c = 0;
                    $arr = array();
                    $arr_f = array();
                    array_push($arr, $value->id);
                    array_push($arr_f, $value->filter_id);
                    $current = $value->id;
                    $current_parent = $value->group_id;
                    $check1  = 0 ;
                    while ( $c <= 10) {
                        // kiểm tra nếu thằng nào là cha của $value->id thêm v
                        $check2 = 0 ;
                        foreach ($folder2 as $key2 => $value2) {
                            if($current_parent == $value2->id){
                               $check2++;
                               $current_parent = $value2->group_id;
                               array_push($arr, $value2->id);
                               array_push($arr_f, $value2->filter_id);
                            }
                        }
                        $c++;
                        if($check2 == 0) $check1++;
                    }
                    if($check1){
                        array_push($all, $arr );
                        array_push($all_filter, array($value->id , $arr_f) );
                    }
                }
                
      }
      // danh sách các thư mục
      foreach ($all_filter as $key => $value) {
          $filter_0 = Filter::whereIn('id',$value[1])->where('type',0)->get();
          $filter_1 = Filter::whereIn('id',$value[1])->where('type',1)->get();
          $ATTR_IN = array();
          foreach ($filter_0  as  $x) {
            if(!in_array($x->attribute_id, $ATTR_IN)){
              array_push($ATTR_IN, $x->attribute_id);
            }
          }
          $whatthehell = array();
          foreach ($filter_1  as $x) {
            $ATTR_IN_2 = array();
            $attr = Attribute::where('name',$x->name)->where('type',0)->get();
            foreach ($attr as $k => $v) {
              if( $v->value >= $x->min && $v->value <= $x->max){
                array_push($ATTR_IN_2, $v->id);
              }
            }
            array_push($whatthehell, $ATTR_IN_2);
          }
          $all_filter[$key]['dinhtinh'] = $ATTR_IN;
          $all_filter[$key]['dinhluong'] = $whatthehell;
      }
      foreach ($all_filter as $key => $value) {
        # code...
        if($value[0] != $id){
          unset($all_filter[$key]);
        }
      }
      $products =  Product::all();
      foreach ($products as $key => $product) {
        $attr_product = $product->getAttributes;
        $frames = Frame::where('product_id',$product->id)->get();
        $has_frame = 0;
        $ARR_GROUP_PRODUCT = array();
        $ARR_GROUP_PRODUCT_STATUS = array();
        foreach ($frames as $k2 => $frame) {
          $ARR_GROUP = array();
          $ARR_GROUP_STATUS = array();
          $attr_frame = $frame->getAttributes;
          $attr_in_frame = array();
          foreach ($attr_frame as $arr_item) {
              array_push($attr_in_frame, $arr_item->id);
          }
          foreach ($all_filter as $k2 => $value){
              $id_folder = $value[0];
              $dinhtinhs = $value['dinhtinh']; // arrar id
              $dinhluongss = $value['dinhluong']; // arrar  (arrar : id)
              // nếu định tính bằng 0:
              if(sizeof($dinhtinhs) ==0){
                // chỉ có thuộc tính định tính
                $c = 0;
                foreach ($dinhluongss as  $dinhluongs) {
                  if(sizeof($dinhluongs) ==0 ){
                    $c = 1;
                    break;
                  }else{
                    $c_temp = 0; 
                    foreach ($dinhluongs as $dinhluong) {
                       if(in_array($dinhluong, $attr_in_frame)){
                            $c_temp = 1;
                            break;
                        }
                    }
                    if($c_temp ==0 ) {
                      $c = 1;
                      break;
                    }
                  }
                }
                if($c ==0 ){
                  array_push($ARR_GROUP , $id_folder);
                  $ARR_GROUP_STATUS[$id_folder] = array('status'=>$frame->status,'product_id'=>$frame->product_id);
                  if(!in_array($id_folder, $ARR_GROUP_PRODUCT)){
                    array_push($ARR_GROUP_PRODUCT , $id_folder);
                    $ARR_GROUP_PRODUCT_STATUS[$id_folder] = array('status'=>$product->status);
                      
                  };
                }
              }else{
                // có thuộc tính định tính
                $c = 0;
                foreach ($dinhtinhs as  $dinhtinh) {
                   if(!in_array($dinhtinh, $attr_in_frame)){
                      $c = 1;
                      break;
                   }
                }
                if($c ==0 ){
                  foreach ($dinhluongss as  $dinhluongs) {
                    if(sizeof($dinhluongs) ==0 ){
                      $c = 1;
                      break;
                    }else{
                      $c_temp = 0; 
                      foreach ($dinhluongs as $dinhluong) {
                         if(in_array($dinhluong, $attr_in_frame)){
                              $c_temp = 1;
                              break;
                          }
                      }
                      if($c_temp ==0 ) {
                        $c = 1;
                        break;
                      }
                    }
                  }
                  if($c ==0 ){
                    array_push($ARR_GROUP , $id_folder);
                    $ARR_GROUP_STATUS[$id_folder] = array('status'=>$frame->status,'product_id'=>$frame->product_id);
                    
                    if(!in_array($id_folder, $ARR_GROUP_PRODUCT)){
                      array_push($ARR_GROUP_PRODUCT , $id_folder);
                      $ARR_GROUP_PRODUCT_STATUS[$id_folder] = array('status'=>$product->status);
                      
                    };
                  }
                }

              }

          }// End Foreach Folder
          $frame->getFolder()->attach($ARR_GROUP_STATUS);
          // $frame->getFolder()->sync($ARR_GROUP);
        }// END FOREACH FRAME
        $product->getFolder()->attach($ARR_GROUP_PRODUCT_STATUS);
        // $product->getFolder()->sync($ARR_GROUP_PRODUCT);
      }
      foreach ($folder as $key => $value) {
          $frame_list_hidden = RelationFrame::where('group_id',$value->id)->where('status',0)->get();
          $frame_list_public = RelationFrame::where('group_id',$value->id)->where('status',1)->get();
          // dd($frame_list);
          $arr = array();
          $frame_arr_public = array();
          foreach($frame_list_public  as $k => $x) {
              array_push($frame_arr_public, $x->frame_id);
          }
          $attribute_count_public = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$frame_arr_public)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();

          $frame_arr_hidden = array();
          foreach($frame_list_hidden  as $k => $x) {
              array_push($frame_arr_hidden, $x->frame_id);
          }
          $attribute_count_hidden = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$frame_arr_hidden)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();
          foreach ($attribute_count_hidden as $k => $v) {
            $arr[$v->attribute_id] = array('number_item'=>0,'number_item_hidden'=>$v->num,'status'=>0);
          }
          foreach ($attribute_count_public as $k => $v) {
            if(isset($arr[$v->attribute_id])){
              $arr[$v->attribute_id] = array('number_item'=>$v->num,'number_item_hidden'=>$arr[$v->attribute_id]['number_item_hidden'],'status'=>1);
            }else{
              $arr[$v->attribute_id] = array('number_item'=>$v->num,'number_item_hidden'=>0,'status'=>1);
            }
          }
          $x = $value->getAttributes()->sync($arr);
      }
  } 
  public function Optimal(Request $req){
      $page = $req->page;
      if(!$req->page){
        $page = 1;;
      }
      $folder = GroupAttribute::get();
      $folder2 = GroupAttribute::get();
      $arr_all = array();
      $all = array();
      $all_filter = array();
      $c =  0;
      foreach ($folder as $key => $value) {
                // nếu value có group_id = 0
                if($value->group_id == 0){
                  array_push($all, array( $value->id) );
                  array_push($all_filter, array ( $value->id , array( $value->filter_id) ) );
                }else{
                    $c = 0;
                    $arr = array();
                    $arr_f = array();
                    array_push($arr, $value->id);
                    array_push($arr_f, $value->filter_id);
                    $current = $value->id;
                    $current_parent = $value->group_id;
                    $check1  = 0 ;
                    while ( $c <= 10) {
                        // kiểm tra nếu thằng nào là cha của $value->id thêm v
                        $check2 = 0 ;
                        foreach ($folder2 as $key2 => $value2) {
                            if($current_parent == $value2->id){
                               $check2++;
                               $current_parent = $value2->group_id;
                               array_push($arr, $value2->id);
                               array_push($arr_f, $value2->filter_id);
                            }
                        }
                        $c++;
                        if($check2 == 0) $check1++;
                    }
                    if($check1){
                        array_push($all, $arr );
                        array_push($all_filter, array($value->id , $arr_f) );
                    }
                }
                
      }
      // danh sách các thư mục
      foreach ($all_filter as $key => $value) {
          $filter_0 = Filter::whereIn('id',$value[1])->where('type',0)->get();
          $filter_1 = Filter::whereIn('id',$value[1])->where('type',1)->get();
          $ATTR_IN = array();
          foreach ($filter_0  as  $x) {
            if(!in_array($x->attribute_id, $ATTR_IN)){
              array_push($ATTR_IN, $x->attribute_id);
            }
          }
          $whatthehell = array();
          foreach ($filter_1  as $x) {
            $ATTR_IN_2 = array();
            $attr = Attribute::where('name',$x->name)->where('type',0)->get();
            foreach ($attr as $k => $v) {
              if( $v->value >= $x->min && $v->value <= $x->max){
                array_push($ATTR_IN_2, $v->id);
              }
            }
            array_push($whatthehell, $ATTR_IN_2);
          }
          $all_filter[$key]['dinhtinh'] = $ATTR_IN;
          $all_filter[$key]['dinhluong'] = $whatthehell;
      }
      $products =  Product::all();
      foreach ($products as $key => $product) {
        $attr_product = $product->getAttributes;
        $frames = Frame::where('product_id',$product->id)->get();
        $has_frame = 0;
        $ARR_GROUP_PRODUCT = array();
        $ARR_GROUP_PRODUCT_STATUS = array();
        foreach ($frames as $k2 => $frame) {
          $ARR_GROUP = array();
          $ARR_GROUP_STATUS = array();
          $attr_frame = $frame->getAttributes;
          $attr_in_frame = array();
          foreach ($attr_frame as $arr_item) {
              array_push($attr_in_frame, $arr_item->id);
          }
          foreach ($all_filter as $k2 => $value){
              $id_folder = $value[0];
              $dinhtinhs = $value['dinhtinh']; // arrar id
              $dinhluongss = $value['dinhluong']; // arrar  (arrar : id)
              // nếu định tính bằng 0:
              if(sizeof($dinhtinhs) ==0){
                // chỉ có thuộc tính định tính
                $c = 0;
                foreach ($dinhluongss as  $dinhluongs) {
                  if(sizeof($dinhluongs) ==0 ){
                    $c = 1;
                    break;
                  }else{
                    $c_temp = 0; 
                    foreach ($dinhluongs as $dinhluong) {
                       if(in_array($dinhluong, $attr_in_frame)){
                            $c_temp = 1;
                            break;
                        }
                    }
                    if($c_temp ==0 ) {
                      $c = 1;
                      break;
                    }
                  }
                }
                if($c ==0 ){
                  array_push($ARR_GROUP , $id_folder);
                  $ARR_GROUP_STATUS[$id_folder] = array('status'=>$frame->status,'product_id'=>$frame->product_id);
                  if(!in_array($id_folder, $ARR_GROUP_PRODUCT)){
                    array_push($ARR_GROUP_PRODUCT , $id_folder);
                    $ARR_GROUP_PRODUCT_STATUS[$id_folder] = array('status'=>$product->status);
                      
                  };
                }
              }else{
                // có thuộc tính định tính
                $c = 0;
                foreach ($dinhtinhs as  $dinhtinh) {
                   if(!in_array($dinhtinh, $attr_in_frame)){
                      $c = 1;
                      break;
                   }
                }
                if($c ==0 ){
                  foreach ($dinhluongss as  $dinhluongs) {
                    if(sizeof($dinhluongs) ==0 ){
                      $c = 1;
                      break;
                    }else{
                      $c_temp = 0; 
                      foreach ($dinhluongs as $dinhluong) {
                         if(in_array($dinhluong, $attr_in_frame)){
                              $c_temp = 1;
                              break;
                          }
                      }
                      if($c_temp ==0 ) {
                        $c = 1;
                        break;
                      }
                    }
                  }
                  if($c ==0 ){
                    array_push($ARR_GROUP , $id_folder);
                    $ARR_GROUP_STATUS[$id_folder] = array('status'=>$frame->status,'product_id'=>$frame->product_id);
                    
                    if(!in_array($id_folder, $ARR_GROUP_PRODUCT)){
                      array_push($ARR_GROUP_PRODUCT , $id_folder);
                      $ARR_GROUP_PRODUCT_STATUS[$id_folder] = array('status'=>$product->status);
                      
                    };
                  }
                }

              }

          }// End Foreach Folder
          $frame->getFolder()->sync($ARR_GROUP_STATUS);
          // $frame->getFolder()->sync($ARR_GROUP);
        }// END FOREACH FRAME
        $product->getFolder()->sync($ARR_GROUP_PRODUCT_STATUS);
        // $product->getFolder()->sync($ARR_GROUP_PRODUCT);
      }
      foreach ($folder as $key => $value) {
          $frame_list_hidden = RelationFrame::where('group_id',$value->id)->where('status',0)->get();
          $frame_list_public = RelationFrame::where('group_id',$value->id)->where('status',1)->get();
          // dd($frame_list);
          $arr = array();
          $frame_arr_public = array();
          foreach($frame_list_public  as $k => $x) {
              array_push($frame_arr_public, $x->frame_id);
          }
          $attribute_count_public = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$frame_arr_public)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();

          $frame_arr_hidden = array();
          foreach($frame_list_hidden  as $k => $x) {
              array_push($frame_arr_hidden, $x->frame_id);
          }
          $attribute_count_hidden = FrameAttribute::select('frame_attributes.attribute_id','attributes.value','attributes.name',DB::raw('count(*) as num'))->whereIn('frame_attributes.frame_id',$frame_arr_hidden)->groupby('frame_attributes.attribute_id')->leftjoin('attributes',"frame_attributes.attribute_id",'=','attributes.id')->orderby('attributes.name','asc')->get();
          foreach ($attribute_count_hidden as $k => $v) {
            $arr[$v->attribute_id] = array('number_item'=>0,'number_item_hidden'=>$v->num,'status'=>0);
          }
          foreach ($attribute_count_public as $k => $v) {
            if(isset($arr[$v->attribute_id])){
              $arr[$v->attribute_id] = array('number_item'=>$v->num,'number_item_hidden'=>$arr[$v->attribute_id]['number_item_hidden'],'status'=>1);
            }else{
              $arr[$v->attribute_id] = array('number_item'=>$v->num,'number_item_hidden'=>0,'status'=>1);
            }
          }
          $x = $value->getAttributes()->sync($arr);
      }

      $frame = Frame::get();
      foreach ($frame as $key => $value) {
        FrameAttribute::where('frame_id',$value->id)->update(array('status_frame'=>$value->status,'product_id'=>$value->product_id));  
      }
  }
  private function updateFrame($id){
     $frame = Frame::find($id);
     if($frame){
         FrameAttribute::where('frame_id',$frame->id)->update(array('status_frame'=>$frame->status,'product_id'=>$frame->product_id));  
     }
  }
  public function EditContentFolder(Request $req,$id){
      $group = GroupAttribute::find($id);
      if($group){
        return view('backend.products.folder-edit-contents',compact("group"));
      }
      return redirect()->back();
  }
  public function EditSeriProduct(Request $req,$id){
      $product = Product::find($id);
      if($product){
        return view('backend.products.seri',compact("product"));
      }
      return redirect()->back();
  }
  public function FormEditSeriProduct(Request $req){
      $product = Product::find($req->seri_id);
      if($product){
        if($req->hasFile('prod_img')){
            $file = array('image' => Input::file('prod_img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                
            }else{

                $file = Input::file('prod_img');
                $nameimg  =  uniqid().'-'.date('d-m-Y').".".$file->getClientOriginalExtension();
                $file->move(public_path().'/assets/product/', $nameimg);
                $product->img = '/assets/product/'.$nameimg;
                // $product->saveThumb($config_img);
            }
        }
        if($req->youtube)  $youtube = $req->youtube;
        else $youtube = array();
        $product->youtube_link = json_encode($youtube);
        $product->name = $req->seri_name;
        $product->description = $req->seri_des;
        $product->save();
        return redirect()->back()->with('success','Chỉnh sửa thành công');
      }
      return redirect()->back();
  }
  public function submitContentCategory(Request $req){
    // dd($req->all()); 
    $group = GroupAttribute::find($req->group_id);
    if($group){
      // prod_img
      // img_product
      $group->name = $req->group_name;
      $group->slug = str_slug($req->group_name);
      // $group->img = 
      $img_product = $req->img_product;
      if($req->youtube)  $youtube = $req->youtube;else $youtube = array();
      $group->youtube_links = json_encode($youtube);
      $group->contents = $req->post_content;
      if($img_product){
          $arr_image = array();
          $list_images =  explode(",,,", $img_product);
          foreach ($list_images as $key => $value) {
              array_push($arr_image, $value);
          }
          $group->image_links = json_encode($arr_image);
      }
      if($req->hasFile('prod_img')){
          $file = array('image' => Input::file('prod_img'));
          $rules = array('image' => 'mimes:jpeg,bmp,png');
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
              
          }else{
              $file = Input::file('prod_img');
              $nameimg  =  uniqid().'-'.date('d-m-Y').".".$file->getClientOriginalExtension();            
              $file->move(public_path().'/assets/upload/', $nameimg); 
              $group->img = '/assets/upload/'.$nameimg;
          }
      }
      // $group->image_links = 
      $group->description = $req->group_des;
      $group->save();
      // $this->OptimalOneFolder($group->id);
      return redirect()->back()->with('success','Lưu lại thành công');
    }else{
      return redirect()->back();
    }
    
  }
}
