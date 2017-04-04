<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Frame;
use App\Item;
use App\Attribute;
use App\GroupAttribute;
use App\Product;
use App\Form;
use App\System;
use App\Tag_Product;
use App\TagP;
use App\TagF;
use App\Filter;
use App\ContentProduct;
use App\ContentFrame;
use App\ProductInCategory;
use App\ProductImage;
use App\ProductAttribute;
use App\FrameAttribute;
use App\FrameImage;
use App\Related_product;
use Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use DB;
use App\Feature;
use App\FrameFeature;
use App\Model\RelationProduct as RelationProduct;
use App\Model\RelationFrame as RelationFrame;
use App\Model\FolderAttribute as FolderAttribute;

class FrameController extends Controller
{
    // View tạo mới Frame 
    public function createFrame($id){
        // Frame được tạo copy sang
        $frame = Frame::find($id);
        if($frame){
          $product_id = Product::where('id',$frame->product_id)->first();
          // content 
          $content  = ContentFrame::where('frame_id',$frame->id)->get();
          // attr 
          $attr = $frame->getAttributes_2;
          //danh mục
          // $cate = ProductInCategory::where('product_id',$product_id->id)->get();
          $cate = DB::table('frame_categorys')->where('frame_id',$frame->id)->get();
          
          $catIds = array();
          foreach ($cate as $cat) {
              $catIds[] = $cat->cate_pro_id;
          }
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

          $featu = $frame->getFeatures_2;
          $size = sizeof($featu);
          for($i = 0 ; $i< $size ; $i++){
            if($i == $size - 1){
            }else{
              if( $featu[$i]->name ==  $featu[$i+1]->name){
                $featu[$i+1]->value = $featu[$i]->value.', '.$featu[$i+1]->value;
                unset($featu[$i]);
              }
            }
          }
          // TagF
          $tags= array();
          if($frame->getPostTag !=null){
               foreach ($frame->getPostTag as  $tag) {
                   $tags[]= $tag->tag;
                };
               $products_tags = implode(',', $tags);
          }
          else  {$products_tags = '';}
            return view('backend.frame.frame',['catIds'=>$catIds,'frame'=>$frame,'product_id'=>$product_id,'products_tags'=>$products_tags,'content'=>$content,'attr'=>$attr,'featu'=>$featu]);
        }else{
            return redirect()->back();
        }
      
    }

    public function editFrame($id=null){
        $frame = Frame::find($id);
        if($frame){
        $attr_frame1 = Attribute::where('id',$frame->attribute_id)->first();
        $product_id = Product::where('id',$frame->product_id)->first();
        // content 
        $content  = ContentFrame::where('frame_id',$frame->id)->get();
        // attr 
       
        //danh mục
        // $cate = ProductInCategory::where('product_id',$product_id->id)->get();
        $cate = DB::table('frame_categorys')->where('frame_id',$frame->id)->get();

        $catIds = array();
        foreach ($cate as $cat) {
            $catIds[] = $cat->cate_pro_id;
        }
        $attr = $frame->getAttributes_2;
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

        $featu = $frame->getFeatures_2;
        $size = sizeof($featu);
        for($i = 0 ; $i< $size ; $i++){
          if($i == $size - 1){
          }else{
            if( $featu[$i]->name ==  $featu[$i+1]->name){
              $featu[$i+1]->value = $featu[$i]->value.', '.$featu[$i+1]->value;
              unset($featu[$i]);
            }
          }
        }

        // TagF
         $tags= array();
        if($frame->getPostTag !=null){
             foreach ($frame->getPostTag as  $tag) {
                 $tags[]= $tag->tag;
              };
             $products_tags = implode(',', $tags);
        }
        else  {$products_tags = '';}
        // ảnh dropzone
         $images = FrameImage::where('frame_id',$frame->id)->get();
          return view('backend.frame.edit-frame',['catIds'=>$catIds,'frame'=>$frame,'attr_frame1'=>$attr_frame1,'product_id'=>$product_id,'products_tags'=>$products_tags,'images'=>$images,'content'=>$content,'attr'=>$attr,'featu'=>$featu]);
        }else{
            return redirect()->back();
        }
    }
    // Copy một sản phẩm
    public function postFrame(Request $req){
      // get ID product
      $id = $req->product_id;
      $product = Product::find($id);
     
      if(!$product){
        return redirect()->back()->with('error','Có lỗi xảy ra , vui long thử lại');
      }
      // get du lieu product 
      // lấy dữ liệu cần thiết add -=> frame
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
      
      // Start CREATE Frame
      $code_frame_fails = Frame::where('code_frame',$req->code_frame)->first();
      $frame = new Frame;
      $frame->name = $req->product_name;
      $frame->slug = str_slug($req->product_name);
      $frame->description = $req->frame_des;
      if(!$code_frame_fails){
        $frame->code_frame = $req->code_frame;
      }else{
        return redirect()->back()->with('error',"Mã sản phẩm này đã tồn tại");
      }
      $frame->product_id = $id;
      $frame->price = (int)$req->price;
      $frame->price_sale = (int)$req->price_sale;
      $frame->sku = $req->sku;
      $frame->label = $req->label;
      $frame->weight = (float)$req->weight;
      $frame->create_by = session('admin')->id;

      $feature_k = $req->feature_k;
      $feature_v = $req->feature_v;
      if(!$feature_k )  $feature_k = array();
      if(!$feature_v )  $feature_v = array();
      // if( $req->submit == "post"){
      //     $frame->status  = 1;
      // }else{
          $frame->status  = 0;
      // } 
      
      // Dữ liệu liên quan
      
      $link_youtube = $req->youtube;
      if(!$link_youtube) $link_youtube = array();
       $arr_youtube = array();
       foreach ($link_youtube as $key => $value) {
          if(trim($value)) array_push($arr_youtube, $value);
      }
      $frame->youtube_link = json_encode($arr_youtube);

      // Content của sản phẩm
      $post_content = $req->post_content;
      $post_name = $req->post_name;
      $tab_list = $req->tab_list;
      // End Content
      $choose_cate = $req->choose_cate;
      if( !$choose_cate ) $choose_cate = array();  
      // Thuộc tính
      $attrbute_k = $req->attrbute_k;
      $attrbute_v = $req->attrbute_v;
      // End thuộc tính

      if(!$attrbute_k) $attrbute_k =  array();
      if(!$attrbute_k) $attrbute_v =  array();

      
      // kiểm tra ảnh frame
      if($req->hasFile('frame_img')){
            $file = array('image'=>Input::file('frame_img'));
            $rules = array('image'=>'mimes:png,jpeg,bmp');
            $validator = Validator::make($file,$rules);
            if($validator->fails()){
                // return redirect()->route('frame.create.frame')->with('error','Tên Ảnh chưa đúng định dạng');
            }else{
                $file = Input::file('frame_img');
                $nameimg  =  uniqid().'-'.date('d-m-Y').".".$file->getClientOriginalExtension(); 
                $file->move(public_path().'/assets/frame/', $nameimg);
                $frame->img = '/assets/frame/'.$nameimg;
                $frame->saveThumb($config_img);
            }
      }

      // Kiểm tra thuộc tính đã tồn tại trong frame chưa
      
      // Bắt đầu lưu
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

          $img_text = $req->img_product;
          $list_img = explode(',,,',$img_text);
          foreach($list_img as $item){
            if($item){
              $img_frame = new FrameImage;
              $img_frame->frame_id = $frame->id;
              $img_frame->img = $item;
              $img_frame->group_name  = "";
              $img_frame->type  = "";
              $img_frame->saveThumb($config_img_detail);
              $img_frame->save();
            }
          }
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
                          // THEM TAG VAO PRODUCT
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
                  // nếu giá trị tồn tại không thì tạo mới
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
          // Thêm giá vào thuộc tính
          $attr_price = $req->price;
          if($req->price_sale) $attr_price = $req->price_sale;
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
          // Kết thúc thêm giá vào thuộc tính

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
          if($choose_cate){
                  $frame->getCategory()->attach($choose_cate); 
                  // THEM CATEGORY VAO PRODUCT
          }
          // Gắn với bảng frame
          $count = 0;
          for($i=0;$i<=sizeof($req->content['id'])-1;$i++){
                $count ++;
                $content = new ContentFrame;
                $content->frame_id = $frame->id;
                $content->description = $req->content['name'][$i];
                $content->name = $req->content['name'][$i];
                $content->rank = $count;
                $content->content = $req->content['content'][$i];
                if($tab_list[$i]){
                  $content->json = $tab_list[$i];
                }
                $content->save();
          } 
          
      }

      // Cập nhập lại Frame vào Sản phẩm gốc
      $frame_public = Frame::where('product_id', $product->id)->where('status', 1)->get(); 
      if( sizeof($frame_public) ){
        $product->status = 1;
        $product->save();
      }else{
        $product->status = 0;
        $product->save();
      } 
      $ALL_FRAME_PUBLIC = Frame::where('product_id',$product->id)->where('status',1)->get();
      $name = "";
      $price_arr = array();
      $price_sale_arr = array();
      $in = array();
      foreach ($ALL_FRAME_PUBLIC as $key => $value) {
        array_push($in, $value->id);
        $name .= $value->name."***";
        $price_item = $value->price;
        $price_sale_item = $value->price_sale;
        array_push($price_arr, $price_item); 
        array_push($price_sale_arr, $price_sale_item); 
      }
      // $product->name = $name;
      // $product->name  = $req->product_seri;
      $product->price = json_encode($price_arr);
      $product->price_sale = json_encode($price_sale_arr);
      $product->save();
      // Cập nhập category
      $frame_categorys = DB::table('frame_categorys')->whereIn('frame_id',$in)->get();
      $frame_attr = FrameAttribute::whereIn('frame_id',$in)->get();
    
      $in_cate =  array();// danh sach cate nam trong frame;
      foreach ($frame_categorys as $key => $value) {
        if( !in_array($value->cate_pro_id, $in_cate) ){
          array_push($in_cate, $value->cate_pro_id);
        }
      }
      $product->getCategory()->sync($in_cate);

      $in_attr =  array();// danh sach cate nam trong frame;
      foreach ($frame_attr as $key => $value) {
        if( !in_array($value->attribute_id, $in_cate) ){
          array_push($in_attr, $value->attribute_id);
        }
      }
      $product->getAttributes()->sync($in_attr);  
      $this->OptimalOneProduct($product->id);
      $this->updateFrame($frame->id);
      return redirect()->route('product.list.product')->with('success','Thêm Sản Phẩm Thành Công');
    }
    public function editFramepost(Request $req){
        // get ID product
        $id = $req->product_id;
        $product = Product::find($id);
        if(!$product){
          return redirect()->back()->with('error','Có lỗi xảy ra , vui long thử lại');
        }
      
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
        $code_frame_fails = Frame::where('code_frame',$req->code_frame)->first();
        $frame = Frame::find($req->id_frame);
        // sửa image
        if($frame){
          if(!$code_frame_fails){
              $frame->code_frame = $req->code_frame;
            }else{
              if($code_frame_fails->id != $frame->id){
                return redirect()->back()->with('error',"Mã sản phẩm này đã tồn tại");
              }else{
                $frame->code_frame = $req->code_frame;
              }
          }

          // Kiểm tra : nếu Frame 
          if($req->hasFile('frame_img')){
              $file = array('image' => Input::file('frame_img'));
              $rules = array('image' => 'mimes:jpeg,bmp,png');
              $validator = Validator::make($file, $rules);
              if ($validator->fails()) {
                  
              }else{
                  if(File::exists($frame->img)){
                      File::delete($frame->img);
                  }
                  $file = Input::file('frame_img');
                  $nameimg  =  uniqid().'-'.date('d-m-Y').".".$file->getClientOriginalExtension(); 
                  $file->move(public_path().'/assets/frame/', $nameimg);
                  $frame->img = '/assets/frame/'.$nameimg;
                  $frame->saveThumb($config_img);
              }
          }else{
              //$frame->saveThumb($config_img);
          }
          $frame->description = $req->frame_des;
          $frame->name = $req->product_name;
          $frame->slug =str_slug($req->product_name);
          
          $frame->product_id = $product->id;
          $frame->price = (int)$req->price;
          $frame->price_sale = (int)$req->price_sale;
          $frame->sku = (int)$req->sku;
          $frame->label = $req->label;
          $frame->weight = (float)$req->weight;
          $frame->last_edit_by = session('admin')->id;
          

          // Các thuộc tính Thêm của sản phẩm
          $submit = $req->submit;
          $frame_attr = $req->attr;
          $post_content = $req->post_content;
          $post_name = $req->post_name;
          $tab_list = $req->tab_list;
          $choose_cate = $req->choose_cate;
          if(!$choose_cate) $choose_cate =array();
          $attrbute_k = $req->attrbute_k;
          $attrbute_v = $req->attrbute_v;
          if(!$attrbute_k) $attrbute_k =  array();
          if(!$attrbute_k) $attrbute_v =  array();
          $feature_k = $req->feature_k;
          $feature_v = $req->feature_v;
          if(!$feature_k )  $feature_k = array();
          if(!$feature_v )  $feature_v = array();
          // Link youtube
          $link_youtube = $req->youtube;
          if(!$link_youtube) $link_youtube = array();
          $arr_youtube = array();
          foreach ($link_youtube as $key => $value) {
            if(trim($value)) array_push($arr_youtube, $value);
          }
          $frame->youtube_link = json_encode($arr_youtube);
          // End Youtube

          // if($submit == 'post'){
          //      $frame->status = 1;

          // }else{
          //      $frame->status = 0;
          // }
          // sửa ảnh dropxzone
          $img_array = array();
          $img_text = $req->img_product;
          $list_images =  explode(",,,", $img_text);
          foreach ($list_images as $key => $value) {
                if($value){
                    $frameimages =  FrameImage::where('img','=', $value)->first();
                    if(!$frameimages){
                      $frameimages = new FrameImage;
                      $frameimages->frame_id = $frame->id;
                      $frameimages->img = $value;
                      $frameimages->group_name  = "";
                      $frameimages->type  = "";
                      $frameimages->saveThumb($config_img_detail);
                      $frameimages->save();
                    }else{
                        $frameimages->saveThumb($config_img_detail);
                    }
                    array_push($img_array, $frameimages->id);
                }               
          }
          $imgs_delete = $frame->getImages()->whereNotIn('id', $img_array)->get();
          foreach ($imgs_delete as  $value) {
            File::delete($value);
            $value->delete();
          }
          if($frame->save()){
            $list = sizeof($req->productId);
            $list_p = $req->productId;
            if(!$list_p) $list_p = array();
            Related_product::where('frame_id',$frame->id)->whereNotIn('frame_related',$list_p)->delete();
            Related_product::where('frame_related',$frame->id)->whereNotIn('frame_id',$list_p)->delete();
            if(sizeof($list_p)){
              for ($i=0; $i < $list; $i++) { 
                $l_rela = $list_p[$i];
                $r = Related_product::where(function($query) use ($frame,$l_rela) {
                  $query->where('frame_id',$frame->id)->Where('frame_related',$l_rela);
                })->orWhere(function($query1) use ($frame,$l_rela){
                  $query1->where('frame_related',$frame->id)->Where('frame_id',$l_rela);
                })->first();
                if($r){

                }else{
                  $rela_fr = new Related_product;
                  $rela_fr->frame_id = $frame->id;
                  $rela_fr->frame_related = $l_rela;
                  $rela_fr->save();
                }
              }
            }

           


            $list_id= array();
            if($req->has('seo_tags')){
                $tags = explode(',', $req->seo_tags);
                foreach ($tags as  $tag) {
                    $tagsname = TagP::where('tag','=', trim($tag))->first();
                    if($tagsname ==null){
                      $tags_column = new TagP;
                      $tags_column->tag = trim($tag);
                      $tags_column->save();
                      array_push($list_id, $tags_column->id);
                    }
                    else {
                      array_push($list_id, $tagsname->id);
                    }
                } 
                $frame->getPostTag()->sync($list_id);  
            }
            if(!$req->seo_tags){
              // Xóa liên kết tag
              Tag_Product::where('product_id',$product->id)->delete();
            }
            $frame->getCategory()->sync($choose_cate); 
            
            $content_id = array();
            $count = 0;
            for($i=0;$i<=sizeof($req->content['id'])-1;$i++){
              $count ++;
              if($req->content['id'][$i] == 0){
                $content = new ContentFrame;
                $content->frame_id = $frame->id;
                $content->description = $req->content['name'][$i];
                $content->name = $req->content['name'][$i];
                $content->rank = $count;
                $content->content = $req->content['content'][$i];
                if($tab_list[$i]){
                  $content->json = $tab_list[$i];
                }
                $content->save();
                array_push($content_id,$content->id);
              }else{
                $content = ContentFrame::find($req->content['id'][$i]);
                $content->frame_id = $frame->id;
                $content->description = $req->content['name'][$i];
                $content->name = $req->content['name'][$i];
                $content->content = $req->content['content'][$i];
                $content->rank = $count;
                if($tab_list[$i]){
                  $content->json = $tab_list[$i];
                }
                $content->save();
                array_push($content_id,$content->id);
              }
            }  
            $frame->contents()->whereNotIn('id',$content_id)->delete();   
          
            // Cập nhập giá trị của thuộc tính vào sản phẩm
            if($attrbute_k){
                      $connect_attr_pro = FrameAttribute::where('frame_id',$frame->id)->get();
                      $arr_attrID = array();
                      // Lấy ra các id attribute trước
                      foreach($connect_attr_pro as $key =>$value){
                            array_push($arr_attrID, $value->attribute_id);
                      }
                      // Remove các thuộc tính
                      foreach($arr_attrID as $key => $id_attr){
                         // Lấy ra thuộc tính cũ.
                         $attr_obj = Attribute::find($id_attr); //Color: vàng , Color: Cam, Hình:tròn 
                         if(sizeof($attr_obj)){
                            $name = $attr_obj->name;
                            // Nếu thuộc tính là giá thì cập nhập
                            if($name =="Giá") {
                              $attr_price = $req->price;
                              if($req->price_sale) $attr_price = $req->price_sale;
                              if(ctype_digit((string) $attr_price)){
                                $attr_price =  (int)$attr_price;
                              }else{
                                $attr_price = (float)($attr_price);
                              }
                              $skjau = Attribute::where('name',"Giá")->where('value' , $attr_price)->first();


                              $filter_group_sale = Attribute::where('name',"Giá")->where('type',1)->first();
                              if(!$filter_group_sale){
                                $filter_group_sale = new Attribute;
                                $filter_group_sale->name = "Giá";
                                $filter_group_sale->type = 1;
                                $filter_group_sale->avaiable = 1;
                                $filter_group_sale->init = "vnđ";
                                $filter_group_sale->save();
                              }
                              
                              // nếu không có thuộc tính nào bằng giá thì tạo mới
                              if(!$skjau){
                                $skjau = new Attribute;
                                $skjau->name = "Giá";
                                $skjau->value = $attr_price;
                                $skjau->type = 0;
                                $skjau->avaiable  = 1;
                                $skjau->init = $filter_group_sale->init;
                                $skjau->save(); 
                                $frame->getAttributes()->attach($skjau);

                                FrameAttribute::where('frame_id',$frame->id)->where('attribute_id',$id_attr)->delete();
                              }
                              if($skjau->id != $id_attr){
                                FrameAttribute::where('frame_id',$frame->id)->where('attribute_id',$id_attr)->delete();
                              }
                              continue;
                            }
                            $value = $attr_obj->value;
                            $c = 0;
                            $c_name = 0;
                            foreach($attrbute_v as $key => $attr_item){
                              // nếu Key = Key
                              if( $attrbute_k[$key] == $name){
                                $c_name ++;
                                $str_va =  explode(",", $attrbute_v[$key]);
                                foreach ($str_va as $str_item) {
                                  // duyệt dừng item trong value : màu sắc vàng,cam,đỏ
                                  $str_item  = trim($str_item);
                                  if(strlen($str_item)){
                                    if( $str_item != $value){
                                        $c++;
                                    }
                                  }
                                }
                              }
                            }
                            if($c_name==0){
                              FrameAttribute::where('frame_id',$frame->id)->where('attribute_id',$id_attr)->delete();
                            }
                            if($c>0){
                              FrameAttribute::where('frame_id',$frame->id)->where('attribute_id',$id_attr)->delete();
                            }
                         }
                      }
                      // Add thuộc tính
                      foreach($attrbute_v as $key => $attr_item){
                          if( $attrbute_k[$key] =="Giá"){
                            continue;
                          }
                          $str_va =  explode(",", $attrbute_v[$key]);
                          foreach ($str_va as $str_item) {
                              // duyệt dừng item trong value : màu sắc vàng,cam,đỏ
                              $filter_group = Attribute::where('name',$attrbute_k[$key])->where(
                                      'type',1)->first();
                              if(!$filter_group) break;
                              $str_item  = trim($str_item);
                              if(strlen($str_item)){
                                
                                  $skjau = Attribute::where('name',$attrbute_k[$key])
                                        ->where('value',$str_item)->first();
                                  if(sizeof($skjau)) {
                                    // nếu tồn tại thuộc tính này rồi
                                    // kiểm tra nếu bảng liên kết có thì thôi
                                    // chưa thì thêm vào
                                    $check = FrameAttribute::where('frame_id',$frame->id)->where('attribute_id',$skjau->id)->first();
                                    if(sizeof($check)==0){
                                      $frame->getAttributes()->attach($skjau);
                                    }
                                  }else{
                                    // nếu chưa tồn tại thì thêm mới
                                   
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
                                          $skjau->avaiable  = $filter_group->avaiable;
                                          $skjau->init = $filter_group->init;
                                          $skjau->save();
                                          $frame->getAttributes()->attach($skjau);
                                    }     
                                  }
                              }
                              if( $filter_group->avaiable ==1 ){
                                break;
                              }
                          }
                          // Tao filter
                      }

            }else{
                $attr_price = $req->price;
                if( $req->price_sale) $attr_price = $req->price_sale;
                if(ctype_digit((string) $attr_price)){
                  $attr_price =  (int)$attr_price;
                }else{
                  $attr_price = (float)($attr_price);
                }

                $skjau = Attribute::where('name',"Giá")->where('value',$attr_price)->first();
                if($skjau){
                  FrameAttribute::where('frame_id',$frame->id)->where('attribute_id',"<>",$skjau->id)->delete();
                }else{
                  FrameAttribute::where('frame_id',$frame->id)->delete();
                }
            }
            $attr_price = $req->price;
            if($req->price_sale) $attr_price = $req->price_sale;
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
            $temp_connent = FrameAttribute::where('frame_id',$frame->id)->where('attribute_id',$skjau->id)->first();
            if(!$temp_connent){
              $frame->getAttributes()->attach($skjau);
            }
            if($feature_k){
                      $connect_attr_pro = FrameFeature::where('frame_id',$frame->id)->get();
                      $arr_attrID = array();
                      // Lấy ra các id attribute trước
                      foreach($connect_attr_pro as $key =>$value){
                            array_push($arr_attrID, $value->feature_id);
                      }
                      // dd($arr_attrID);
                      // Remove các thuộc tính
                      foreach($arr_attrID as $key => $id_attr){
                         // Lấy ra thuộc tính cũ.
                         $attr_obj = Feature::find($id_attr); //Color: vàng , Color: Cam, Hình:tròn ...
                         if(sizeof($attr_obj)){
                            $name = $attr_obj->name;
                            $value = $attr_obj->value;
                            $c = 0;
                            $c_name = 0;
                            foreach($feature_v as $key => $attr_item){
                              // nếu Key = Key
                              if( $feature_k[$key] == $name){
                                $c_name ++;
                                $str_va =  explode(",", $feature_v[$key]);
                                foreach ($str_va as $str_item) {
                                  // duyệt dừng item trong value : màu sắc vàng,cam,đỏ
                                  $str_item  = trim($str_item);
                                  if(strlen($str_item)){
                                    if( $str_item != $value){
                                        $c++;
                                    }
                                  }
                                }
                              }
                            }
                            if($c_name==0){
                              FrameFeature::where('frame_id',$frame->id)->where('feature_id',$id_attr)->delete();
                            }
                            if($c>0){
                              FrameFeature::where('frame_id',$frame->id)->where('feature_id',$id_attr)->delete();
                            }
                         }
                      }
                      // Add thuộc tính
                      foreach($feature_v as $key => $attr_item){
                          $str_va =  explode(",", $feature_v[$key]);
                          foreach ($str_va as $str_item) {
                              // duyệt dừng item trong value : màu sắc vàng,cam,đỏ
                              $feature_root = Feature::where('name',$feature_k[$key])->where(
                                      'type',1)->first();
                              if(!$feature_root) break;
                              $str_item  = trim($str_item);
                              if(strlen($str_item)){
                                  $skjau = Feature::where('name',$feature_k[$key])
                                        ->where('value',$str_item)->first();
                                  if(sizeof($skjau)) {
                                    // nếu tồn tại thuộc tính này rồi
                                    // kiểm tra nếu bảng liên kết có thì thôi
                                    // chưa thì thêm vào
                                    $check = FrameFeature::where('frame_id',$frame->id)->where('feature_id',$skjau->id)->first();
                                    if(sizeof($check)==0){
                                      $frame->getFeatures()->attach($skjau);
                                    }
                                  }else{
                                    // nếu chưa tồn tại thì thêm mới
                                    $feature = Feature::firstOrNew(['name' => $feature_k[$key],'value' => $str_item]);
                                      $feature->type = 0;
                                      $feature->init = $feature_root->init;
                                      $feature->save();
                                      $frame->getFeatures()->attach($feature);   
                                  }
                              }
                          }
                          // Tao filter
                      }
            }else{
                FrameFeature::where('frame_id',$frame->id)->delete();
            }
          }
          $frame_public = Frame::where('product_id', $product->id)->where('status', 1)->get(); 
          if( sizeof($frame_public) ){
            $product->status = 1;
            $product->save();
          }else{
            $product->status = 0;
            $product->save();
          } 
          $ALL_FRAME_PUBLIC = Frame::where('product_id',$product->id)->where('status',1)->get();
          $name = "";
          $price_arr = array();
          $price_sale_arr = array();
          $in = array();
          foreach ($ALL_FRAME_PUBLIC as $key => $value) {
            array_push($in, $value->id);
            $name .= $value->name."***";
            $price_item = $value->price;
            $price_sale_item = $value->price_sale;
            array_push($price_arr, $price_item); 
            array_push($price_sale_arr, $price_sale_item); 
          }
          // $product->name = $name;
          // $product->name  = $req->product_seri;
          $product->price = json_encode($price_arr);
          $product->price_sale = json_encode($price_sale_arr);
          $product->save();
          // Cập nhập category
          $frame_categorys = DB::table('frame_categorys')->whereIn('frame_id',$in)->get();
          $frame_attr = FrameAttribute::whereIn('frame_id',$in)->get();
        
          $in_cate =  array();// danh sach cate nam trong frame;
          foreach ($frame_categorys as $key => $value) {
            if( !in_array($value->cate_pro_id, $in_cate) ){
              array_push($in_cate, $value->cate_pro_id);
            }
          }
          $product->getCategory()->sync($in_cate);

          $in_attr =  array();// danh sach cate nam trong frame;
          foreach ($frame_attr as $key => $value) {
            if( !in_array($value->attribute_id, $in_cate) ){
              array_push($in_attr, $value->attribute_id);
            }
          }
          $product->getAttributes()->sync($in_attr);  
          $this->OptimalOneProduct($product->id);
          $this->updateFrame($frame->id);
          return redirect()->route('product.list.product')->with('success','Sửa Sản Phẩm Thành Công');    
        }else{
            return redirect()->back();
        }


    }
    public function del_frame_post(Request $req){
        $frame = Frame::find($req->id);
        if($frame){
            $product =  Product::find($frame->product_id);
            if($product){
              $arr_frame = Frame::where('product_id',$product->id)->get();

              // kiểm tra nếu còn một frame thì xóa luôn sản phmr
              if(sizeof($arr_frame) == 1){
                $frame->delete();
                $product->delete();
              }else{
                $frame->delete();
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
                // $product->name = $name;
                $product->price = json_encode($price_arr);
                $product->price_sale = json_encode($price_sale_arr);
                $product->save();
              }
            }
            echo "true";
            return;
        }
        echo "false";
       
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
    private function updateFrame($id){
       $frame = Frame::find($id);
       if($frame){
           FrameAttribute::where('frame_id',$frame->id)->update(array('status_frame'=>$frame->status,'product_id'=>$frame->product_id));  
       }
    }
}