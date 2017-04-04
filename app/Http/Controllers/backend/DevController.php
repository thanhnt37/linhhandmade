<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GroupLayout;
use App\Layout;
use App\Item;
use App\Category;
use App\CategoryProduct;
use DB;
use App\SlideType;
use App\Admins;
use App\System;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Permission;
use App\FormType;
use App\Product;
use App\Post;
use App\Attribute;
class DevController extends Controller
{
	// Chi tiết về layout group
	public function index($id = null){

		$layout_group = GroupLayout::Find($id);
		if($layout_group){
            $layout  = Layout::where('contribute_id',$layout_group->id)->orderby('id','desc')->get();
			return view('backend.dev.list',compact('layout_group','layout'));
		}
		else{
			return redirect()->route('layout.add-group');
		}
	}	
	// Chi tiết về layout trong layoutgroup
	public function config($id = null){
		$layout = Layout::Find($id);
		if($layout){
            
            if($layout->type == "Hỗn hợp"){
                return view('backend.dev.layout',compact('layout'));
            }
			return view('backend.dev.layout-list',compact('layout'));
		}
		else{
			return redirect()->route('layout.add-group');
		}
	}	
    public function slide(){
        $slide_types = DB::table('slide_types')->orderby('id', 'desc')->get();
        return view('backend.dev.add-slide', compact('slide_types'));
    }
    public function devadditem(Request $req){
        $new = $req->new;
        $layout_name = $req->layout_name;
        // tạo mới layout
        $text_id = array();
        $text_name = array();
        $text_value = array();
        $text_link = array();
        $text_id = $req->text_id;
        $text_name = $req->text_name;
        $text_value = $req->text_value;
        $text_link = $req->text_link;
       


        $img_id = array();
        $img_name = array();
        $img_value = array();
        $img_link = array();
        $img_id = $req->img_id;
        $img_name = $req->img_name;
        $img_value = $req->img_value;
        $img_link = $req->img_link;

        if($new == 1){
            $layout  = new Layout;
            $layout->key = $layout_name;
            $layout->name = $layout_name;
            $layout->type = "Hỗn hợp";
            $layout->contribute_id = $req->contribute_id;
            $layout->save();
            
            for($i = 0 ;$i< sizeof($text_id);$i++){
                $item = new Item;
                $item->key_layout = $layout_name;
                $item->key_item = $text_name[$i];
                $item->value = $text_value[$i];
                $item->type = "des";
                $item->pin = $text_link[$i];
                $item->save();
            }
            for($i = 0 ;$i< sizeof($img_id);$i++){
                $item = new Item;
                $item->key_layout = $layout_name;
                $item->key_item = $img_name[$i];
                if($img_value[$i]){
                        $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$img_value[$i]->getClientOriginalName(); 
                        $img_value[$i]->move(public_path().'/assets/slide/', $nameimg); 
                        $item->value  = '/assets/slide/'.$nameimg;
                }
                $item->type = "img";
                $item->pin = $img_link[$i];
                $item->save();
            }
        }else{
            for($i = 0 ;$i< sizeof($text_id);$i++){
                if($text_id[$i] == 0){
                    $item = new Item;
                    $item->key_layout = $layout_name;
                    $item->key_item = $text_name[$i];
                    $item->value = $text_value[$i];
                    $item->type = "des";
                    $item->pin = $text_link[$i];
                    $item->save();
                }else{
                    $item = Item::Find($text_id[$i]);
                    $item->value = $text_value[$i];
                    $item->pin = $text_link[$i];
                    $item->save();
                }
            }
            for($i = 0 ;$i< sizeof($img_id);$i++){
                if($img_id[$i] == 0){
                    $item = new Item;
                    $item->key_layout = $layout_name;
                    $item->key_item = $img_name[$i];
                    if($img_value[$i]){
                            $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$img_value[$i]->getClientOriginalName(); 
                            $img_value[$i]->move(public_path().'/assets/slide/', $nameimg); 
                            $item->value  = '/assets/slide/'.$nameimg;
                    }
                    $item->type = "img";
                    $item->pin = $img_link[$i];
                    $item->save();
                }else{
                    $item = Item::Find($img_id[$i]);
                    if($img_value[$i]){
                            $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$img_value[$i]->getClientOriginalName(); 
                            $img_value[$i]->move(public_path().'/assets/slide/', $nameimg); 
                            $item->value  = '/assets/slide/'.$nameimg;
                    }
                    $item->pin = $img_link[$i];
                    $item->save();
                }
            }
        }
       return redirect()->back();
    }
    public function addslide(Request $req){
        $name = $req->name;
        if(sizeof($name)){
           DB::table('slide_types')->insert(array(
                'name'=>$name,
                'img_1' => $req->img_1,
                'img_2' => $req->img_2,
                'img_3' => $req->img_3,
                'text_1' => $req->text_1,
                'text_2' => $req->text_2,
                'text_3' => $req->text_3,
                'text_4' => $req->text_4,
                'des_1' => $req->des_1,
                'des_2' => $req->des_2,
                'link_1' => $req->link_1,
                'link_2' => $req->link_2,
                )
            );
            return redirect()->route('dev.slide')->with('success',"Thêm thành công");
        }
        return redirect()->route('dev.slide')->with('errer',"Không được để trống");

    }
    public function delSlideType(Request $req){
        $id = $req->id;
        DB::table('slide_types')->where('id',$id)->delete();
        return json_encode(array('status'=>true));
    }

    public function editSlideType($id = null, Request $req){
        if($id == null) return redirect()->route('admin.home');
        $sl_type = SlideType::find($id);
        
        $sl_type->name = $req->name;
        $sl_type->img_1 = $req->img_1;
        $sl_type->img_2 = $req->img_2;
        $sl_type->img_3 = $req->img_3;

        $sl_type->text_1 = $req->text_1;
        $sl_type->text_2 = $req->text_2;
        $sl_type->text_3 = $req->text_3;
        $sl_type->text_4 = $req->text_4;
        $sl_type->des_1 = $req->des_1;
        $sl_type->des_2 = $req->des_2;
        $sl_type->link_1 = $req->link_1;
        $sl_type->link_2 = $req->link_2;
        $sl_type->save();
        return redirect()->route('dev.slide')->with('success',"Sửa thành công");
    }
    public function addGroup(){
    	return view('backend.dev.add');
    }
    public function createGroup(Request $req){
    	$GroupLayout = new GroupLayout;

    	$GroupLayout->key = $req->key;
    	$GroupLayout->name = $req->key;
    	$GroupLayout->save();

    	return redirect()->route('layout.view',['id'=>$GroupLayout->id])->with('success',"Thêm thành công");
    }
    public function createLayout(Request $req){
    	$layout  = new Layout;
    	$layout->key = $req->key;
    	$layout->name = $req->name;
    	$layout->contribute_id = $req->group_id;
    	$layout->type = $req->type;
    	$layout->save();
    	return redirect()->route('layout.view',['id'=>$req->group_id])->with('success',"Thêm thành công");
    }
    public function changelink(Request $req){
        $item = Item::find($req->id);
        if($req->pin == 'true'){
           $item->pin = 1;
        }
        else {
           $item->pin = 0;
        }  
        $item->save();
    }
    public function createPattern(Request $req){
        //dd($req->all());
        $x = $req->x;
    	$item = new Item;
    	$item->key_layout = $req->layout_key;
    	$item->key_item = $req->key;
    	$item->type = $req->type;
        if($x == 'list'){
            $item->num = 1;
        };
        if($req->check_link =='on'){
           $item->pin = 1; 
        }
        else{
           $item->pin = 0;  
        }
    	$item->save();
    	return redirect()->route('layout.config',['id'=>$req->id])->with('success',"Thêm thành công");
    }
    public function duplicate($id =null){
        $layout = Layout::Find($id);
        if($layout){
            $items  =  Item::where('key_layout',$layout->key)->where('num',1)->orderby('num','asc')->get();
            $t_num =  Item::where('key_layout',$layout->key)->orderby('num','desc')->first();
            $num  = $t_num->num + 1;
            foreach ($items as $key => $value) {
                // nhân đôi
                $it = new Item;
                $it->key_layout = $value->key_layout;
                $it->key_item = $value->key_item;
                $it->type = $value->type;
                $it->num = $num;
                $it->save();
            }
        }
        else{
            return redirect()->route('layout.add-group');
        }
    }
     public function list_category(){

        return view('backend.dev.list-category');
    }
     public function list_category_product(){

        return view('backend.dev.list-category-product');
    }
    public function editable(Request $req){
        $id = $req->id;
        $cate = Category::Find($id);
        if($cate){
            if($cate->editable ==0 ){
                $cate->editable = 1;
                $cate->save();
            }else{
                $cate->editable = 0;
                $cate->save();
            }
            return json_encode(array('status'=>true));
        
        }else{
             return json_encode(array('status'=>false));
        }
       
    }
     public function editableProduct(Request $req){
        $id = $req->id;
        $cate = CategoryProduct::Find($id);
        if($cate){
            if($cate->editable ==0 ){
                $cate->editable = 1;
                $cate->save();
            }else{
                $cate->editable = 0;
                $cate->save();
            }
            return json_encode(array('status'=>true));
        
        }else{
             return json_encode(array('status'=>false));
        }
       
    }
    public function config_system(){

        return view('backend.admins.config');
    }
     public function config_system_update(Request $req){
        if($req->has('password')){
           $admin = Admins::where('id', '=', 2)->first();
           if(!$admin){
                $admin = new Admins;
                 $admin->id = 2;
           }
           $admin->username = $req->username;
           $admin->password = MD5($req->password);
           $admin->level = 1;
           $admin->status = 1;
           $admin->save();
      }
       $system = System::first();
       if(!$system){
            $system = new System;
       }
        //dd($system);
       $system->domain = $req->domain;
       $system->full_name = $req->full_name;
       $system->email = $req->email;
       $system->phone = $req->phone;
       $system->address = $req->address;
       $system->status = $req->status;
       if($system->save()){
         return redirect()->route('admin.config')->with('success', 'Lưu thành công');
       }
       
    }
    public function config_fonts(){
        return view('backend.dev.fonts');
    }
    public function config_fonts_update(Request $req){
        if($req->has('post')){
           $font_default = Item::where('key_item', 'font_default')->first();
           if(!$font_default){
                $font_default = new Item;
                $font_default->key_item = 'font_default';
           }
           $font_default->value = implode(',', $req->post);
           $font_default->save();
       }
       if($req->has('post1')){
           $font_custom = Item::where('key_item', 'font_custom')->first();
           if(!$font_custom){
                $font_custom = new Item;
                $font_custom->key_item = 'font_custom';
           }
           $font_custom->value = implode(',', $req->post1);
          
           $font_custom->save();
      }
      return redirect()->route('admin.config.font')->with('success', 'Lưu thành công');
      
    }

    public function permission_list(){
        $permissions = Permission::orderby('created_at', 'desc')->get();
        return view('backend.permissions.permission', compact('permissions'));
    }

    public function add_permission(Request $req){
       $permission = new Permission;
       $permission->name = $req->name;
       $permission->key = str_slug($req->name, '_');
       if($permission->save()){
         return redirect()->route('admin.config.permission')->with('success', 'Lưu thành công');
       }
    }
    public function form()
    {   
        return view('backend.dev.add-form');
    }
    public function form_post(Request $req)
    {   
        $formtype =new FormType;
        $formtype->name = $req->name;
        $formtype->count = sizeof(array_filter($req->text));
        $formtype->note= implode(',', array_filter($req->text));
        if($formtype->save()){
            return redirect()->route('dev.form')->with('success', 'Thêm Form thành công');
        }
    
    }
    public function editFormType($id=null, Request $req)
    {
        if($id==null) return redirect()->route('admin.home');
        else{     
            $formtype = FormType::find($id);
            $formtype->name = $req->name;
            $formtype->count = sizeof(array_filter($req->text));
            $formtype->note= implode(',', array_filter($req->text));
            if($formtype->save()){
            return redirect()->route('dev.form')->with('success', 'Sửa Form thành công');
            }
        }
    } 
    public function DelFormType( Request $req)
    {
        $formtype = FormType::find($req->id);
        $formtype->delete();
        echo 'true';
    }    
    public function thumbnail(){
        return view('backend.dev.add-thumbnail');
    }
    public function refresh_thumb_all(){
       $config_img = array('width'=>250,'height'=>250);
       $config_img_detail = array('width'=>560,'height'=>320);
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

        $products = Product::paginate(4);
        $cur_page = $products->currentPage();
        $next_page = $cur_page + 1 ;
        if(sizeof($products)){
            // dd($product);
            foreach ($products as $key => $item_product) {
                $item_product->saveThumb($config_img);

                # code..
                echo "<img src='".asset($item_product->img)."' width=200 height=200>";
                echo "<br>";
                $images = $item_product->getImages;
                foreach ($images as $key2 => $item_image) {
                    # code...
                    $item_image->saveThumb($config_img_detail);
                }
            }
            echo '<meta http-equiv="refresh" content="2; URL='.route('create.thumbnail.auto').'?page='.$next_page.'">';
        }else{
            echo "het roi";
        }
         // echo '<meta http-equiv="refresh" content="2; URL=''">';
    }
    public function refresh_thumb_all_post(){
       $config_img = array('width'=>250,'height'=>250);
       $config_img_detail = array('width'=>400,'height'=>600);
       $post_config = Item::where('key_layout','config_thumb_post')->get();
       if($post_config){
          if(isset($post_config[0])){
            $w_h = explode('x',$post_config[0]->value);
            $w = 0;
            $h = 0;
            if(isset($w_h[0])) $w = (int) $w_h[0];
            if(isset($w_h[1])) $h = (int) $w_h[1];
            if($w >0 && $h> 0)  $config_img = array('width'=>$w,'height'=>$h);

          }
          if(isset($post_config[1])){
             $w_h = explode('x',$post_config[1]->value);
            $w = 0;
            $h = 0;
            if(isset($w_h[0])) $w = (int) $w_h[0];
            if(isset($w_h[1])) $h = (int) $w_h[1];
            if($w >0 && $h > 0)  $config_img_detail = array('width'=>$w,'height'=>$h);
          }
       }

        $post = Post::paginate(4);
        $cur_page = $post->currentPage();
        $next_page = $cur_page + 1 ;
        if(sizeof($post)){
            // dd($product);
            foreach ($post as $key => $item_post) {
                $item_post->saveThumb($config_img);

                # code..
                echo "<img src='".asset($item_post->img)."' width=200 height=200>";
                // echo "<br>";
                $images = $item_post->getImages;
                foreach ($images as $key2 => $item_image) {
                    # code...
                    $item_image->saveThumb($config_img_detail);
                }
            }
            echo '<meta http-equiv="refresh" content="2; URL='.route('create.thumbnail.auto.post').'?page='.$next_page.'">';
        }else{
            echo "het roi";
        }
         // echo '<meta http-equiv="refresh" content="2; URL=''">';
    }
    public function thumbnailPost(Request $req){
        // dd($req->all());
        if($req->a1){
            $a1 = Item::firstOrNew(['key_layout' => 'config_thumb_product','key_item'=>'config_thumb_product_preview']);
            $a1->value = trim($req->a1);
            $a1->save();
        }
        if($req->a2){
            $a2 = Item::firstOrNew(['key_layout' => 'config_thumb_product','key_item'=>'config_thumb_product_detail']);
            $a2->value = trim($req->a2);
            $a2->save();
        }
        if($req->a3){
            $a3 = Item::firstOrNew(['key_layout' => 'config_thumb_product','key_item'=>'config_thumb_product_category']);
            $a3->value = trim($req->a3);
            $a3->save();
        }
        if($req->b1){
            $b1 = Item::firstOrNew(['key_layout' => 'config_thumb_post','key_item'=>'config_thumb_post_preview']);
            $b1->value = trim($req->b1);
            $b1->save();
        }
        if($req->b2){
            $b2 = Item::firstOrNew(['key_layout' => 'config_thumb_post','key_item'=>'config_thumb_post_detail']);
            $b2->value = trim($req->b2);
            $b2->save();
        }
        if($req->b3){
            $b3 = Item::firstOrNew(['key_layout' => 'config_thumb_post','key_item'=>'config_thumb_post_category']);
            $b3->value = trim($req->b3);
            $b3->save();
        }

        return redirect()->route('dev.thumbnail')->with('success','Cập nhập thành công');
    }
    // Show config frame and update
    public function config_frame(){
        return view('backend.dev.frame');
    }
    public function config_frame_update(Request $req){
        $list_id = $req->attr;
        if($list_id == null){
            $list_id = array();
        }
        $attr = Attribute::where('type',1)->where('avaiable',0)->orwhere('avaiable',1)->get();
        foreach ($attr as $key => $value) {
            if(!in_array($value->id,$list_id)){
               $value->isDelete = 0;
               $value->save();
            }else{
                $value->isDelete = 1;
                $value->save();
            }
        } 
        return redirect()->route('admin.config.frame')->with('success', 'Lưu thành công');
    }
   // end Show config frame and update

    
}
