<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use App\Category;
use App\Post;
use App\Content;
use App\Post_category;
use App\Item;
use App\Tag;
use App\Tag_post;
use App\PostImage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    public function create_post(){

    	return view('backend.posts.add');
    }
    public function post_create_post(Request $req){
       $config_img = array('width'=>250,'height'=>250);
       $config_img_detail = array('width'=>560,'height'=>320);
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


        $post_title = $req->post_title;
        $post_des = $req->post_des;
          
        $seo_title = $req->seo_title;
        $seo_des = $req->seo_des;
        $seo_struct = $req->seo_struct;
        $choose_cate = $req->choose_cate; // array
        $post_name = $req->post_name; // array danh sách post name tab từ cao -> thấp
        $post_content = $req->post_content; // array danh sách post content từ cao -> thấp
        $img_post = $req->img_post;
        $p = new Post;
        if($req->hasFile('post_img')){
            $file = array('image' => Input::file('post_img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return redirect()->route('posts.add')->with('error','Ảnh tải lên chưa đúng định dạng');
            }else{

                $file = Input::file('post_img');
                $nameimg  =  uniqid().'-'.date('d-m-Y').'-'.str_slug($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
                $file->move(public_path().'/assets/post/', $nameimg);
                $p->img = '/assets/post/'.$nameimg;
                $p->saveThumb($config_img);
            }
        }
       
        
        $p->title = $post_title;
        $p->description = $post_des;
       /// $p->img = "";
        $p->slug = str_slug($post_title,'-');

        if($_REQUEST['submit']  == "post"){
              $p->status = 1;
        }else{
              $p->status = 0;
        }
      

        $p->SEO_title = $seo_title;
        $p->SEO_des = $seo_des;
        //$p->SEO_img = "";
        $p->struct_data = $seo_struct;
        $p->create_by = session('admin')['id'];
        $p->last_edit_by = session('admin')['id'];
        try {
            if($p->save()){
                $count = 0;
                for($i= sizeof($post_name)-1 ;$i>=0; $i--){
                    $count ++;
                    $c = new Content;
                    $c->post_id = $p->id;
                    $c->name = $post_name[$i];
                    $c->content = $post_content[$i];
                    $c->description = $post_name[$i];
                    $c->rank = $count;
                    $c->save();
                }
                 if($req->has('choose_cate')){
                     foreach ($choose_cate as $value) {
                           $p_c = new Post_category;
                            $p_c->post_id= $p->id;
                            $p_c->category_id= $value;
                            $p_c->save();
                    
                        }
                }
                 if($img_post){
                  $list_images =  explode(",,,", $img_post);
                  foreach ($list_images as $key => $value) {
                      $PostImage  = new PostImage;
                      $PostImage->post_id  = $p->id;
                      $PostImage->img  = $value;
                      $PostImage->group_name  = "Mặc định";
                      $PostImage->type  = "Nhóm";
                      $PostImage->save();
                      $PostImage->saveThumb($config_img_detail);
                  }
                }
                if($req->has('seo_tags')){
                     $tags = explode(',', $req->seo_tags);

                        foreach ($tags as  $tag) {
                          // echo $tag.'<br>';
                            $tagsname = Tag::where('tag','=', trim($tag))->first();
                            //dd($tagsname->count());
                            
                            if($tagsname == null){

                                  $tags_column = new Tag;
                                  $tags_column->tag= trim($tag);
                                  $tags_column->save();
                                  $p->getPostTag()->attach($tags_column);
                            }
                            else {
                                  $p->getPostTag()->attach($tagsname);
                            }
                        }
                }
                return redirect()->route('posts.add')->with('success','Tạo bài viết thành công');
            }else{
                 return redirect()->route('posts.add')->with('error','Đã có lỗi sảy ra');
            }
        } catch (Exception $e) {
            return redirect()->route('posts.add')->with('error','Đã có lỗi sảy ra');
        }
     

       
      
    }
    public function edit_post($id){
        $post = Post::findOrFail($id);
        $tags= array();
        if($post->getPostTag !=null){
             foreach ($post->getPostTag as  $tag) {
                 $tags[]= $tag->tag;
              };
             $post_tags= implode(',', $tags);
        }
        else 
            $post_tags='';
        $content = Content::where('post_id', $id)->orderBy('rank', 'ASC')->get();
        $catIds = array();
        foreach ($post->getCategory as $cat) {
            $catIds[] = $cat->id;
        }
        $images = PostImage::where('post_id',$post->id)->get();
        return view('backend.posts.edit-post',compact('post','catIds','content', 'post_tags','images'));
    }
    public function xoa_tab(Request $req){
       // dd($req->id);
        $content = Content::find($req->id);
        dd($content);
        $content->delete($req->id);
        echo 'true';
    }
    public function update_post(Request $req){
       $config_img = array('width'=>250,'height'=>250);
       $config_img_detail = array('width'=>500,'height'=>500);
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

        $post_title = $req->post_title;
        $post_des = $req->post_des;   
        $seo_title = $req->seo_title;
        $seo_des = $req->seo_des;
        $seo_struct = $req->seo_struct;
        $choose_cate = $req->choose_cate; 
        $img_post = $req->img_post;
         // array
        // $post_name = $req->post_name; // array danh sách post name tab từ cao -> thấp
        // $post_content = $req->post_content; // array danh sách post content từ cao -> thấp  
        
        $p = Post::findOrFail($req->id);
        
        if($req->hasFile('post_img')){
            $file = array('image' => Input::file('post_img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('post.add')->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
            }else{
                $file = Input::file('post_img');
                $nameimg  =  uniqid().'-'.date('d-m-Y').'-'.str_slug($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
                $file->move(public_path().'/assets/post/', $nameimg);
                $p->img = '/assets/post/'.$nameimg;
                $p->saveThumb($config_img);
            }
        }else{
            $p->saveThumb($config_img);
        }
        $p->title = $post_title;
        $p->description = $post_des;
        //$p->img = "";
        $p->slug = str_slug($post_title,'-');
       
        if($_REQUEST['submit']  == "post"){
              $p->status = 1;
        }else{
              $p->status = 0;
        }
      

        $p->SEO_title = $seo_title;
        $p->SEO_des = $seo_des;
        $p->struct_data = $seo_struct;
        $p->last_edit_by = session('admin')['id'];
        
        $content_id = array();
        $count = 0; 
                for($i=0; $i<=sizeof($req->content['id'])-1 ; $i++){
                    $count ++;
                    if($req->content['id'][$i]==0){
                        $c = new Content;
                        $c->name = $req->content['name'][$i];
                        $c->post_id = $p->id;
                        $c->content = $req->content['content'][$i];
                        $c->rank = $count;
                        $c->save(); 
                        array_push($content_id, $c->id);
                    }
                    else{
                        $c = Content::find($req->content['id'][$i]);
                        $c->name = $req->content['name'][$i];
                        $c->post_id = $p->id;
                        $c->content = $req->content['content'][$i];
                        $c->rank = $count;
                        $c->save(); 
                        array_push($content_id, $c->id);
                    }
                   
                }
             $p->contents()->whereNotIn('id',$content_id)->delete(); 
             $p->savePostCategory($req->choose_cate);
        try {
            if($p->save()){
                $images_current = PostImage::where('post_id',$p->id)->get();
                $img_array =array();
               
                $list_images =  explode(",,,", $img_post);
                
                foreach ($list_images as $key => $value) {
                    if($value){
                         $PostImage = PostImage::where('img','=', $value)->first();
                        if(!$PostImage){
                            $PostImage = new PostImage; 
                            $PostImage->post_id  = $p->id;
                            $PostImage->img  = $value;
                            $PostImage->group_name  = "Mặc định";
                            $PostImage->type  = "Nhóm";
                            $PostImage->save();
                            $PostImage->saveThumb($config_img_detail);
                        }else{
                            $PostImage->saveThumb($config_img_detail);
                        }
                        array_push($img_array, $PostImage->id);
                    }
                   
                }
               
                $imgs_delete = $p->getImages()->whereNotIn('id', $img_array)->get();
                foreach ($imgs_delete as  $value) {
                    $value->delete();
                }

                 
                $list_id= array();
                if($req->has('seo_tags')){
                 $tags = explode(',', $req->seo_tags);
               
                    foreach ($tags as  $tag) {
                        $tagsname = Tag::where('tag','=', trim($tag))->first();
                        
                        if($tagsname ==null){
                          $tags_column = new Tag;
                          $tags_column->tag = trim($tag);
                          $tags_column->save();
                           array_push($list_id, $tags_column->id);
                        
                        }
                        else {
                          array_push($list_id, $tagsname->id);
                        }
                        
                    } 
                    
                    $p->getPostTag()->sync($list_id);  
                }
                if(!$req->seo_tags){
                      Tag_post::where('post_id',$p->id)->delete();
                }
                return redirect()->route('posts.edit',['id'=>$p->id])->with('success','Sửa bài viết thành công');
                
            }else{
                 return redirect()->route('posts.edit',['id'=>$p->id])->with('error','Đã có lỗi sảy ra');
            }
        } catch (Exception $e) {
            return redirect()->route('posts.edit',['id'=>$p->id])->with('error','Đã có lỗi sảy ra');
        }

    }
    public function del_post(Request $req){
        $post= Post::findOrFail($req->id);
        if($post->getPostCategory->count()){

            $post->getPostCategory()->delete();
        }
        $post->delete();
        echo 'true';
    }
    public function index_post()
    {
    	return view('backend.posts.list');
    }
    public function post_in_cate($id_cate = null)
    {
        return view('backend.posts.list',compact('id_cate'));
    }

    public function create_category()
    {
    	return view('backend.posts.create_category');
    }
    public function post_create_category(Request $req)
    {
        $cate = new Category;
        if($req->hasFile('cate_img')){
            $file = array('image' => Input::file('cate_img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('category.add')->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
            }else{
                $file = Input::file('cate_img');
                $file->move(public_path().'/assets/category/', $file->getClientOriginalName());
                $cate->img = '/assets/category/'.$file->getClientOriginalName();
              
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
              return Redirect::to(route('category.add'))->with(['success'=>'Thêm danh mục thành công']);
        }
        return Redirect::to(route('category.add'))->with(['error'=>'Lỗi không xác định']);
      
    }
    public function formsavecate(Request $req){
        $id = $req->id;
         $cate = Category::Find($id);
         if(!$cate)  return Redirect::to('admin.home'); 


         if($req->hasFile('cate_img')){
            $file = array('image' => Input::file('cate_img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('category.edit')->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
            }else{
                $file = Input::file('cate_img');
                $file->move(public_path().'/assets/category/', $file->getClientOriginalName());
                $cate->img = '/assets/category/'.$file->getClientOriginalName();
            }
        }
        if($req->cate_des ){
            $cate->description = $req->cate_des;
        }
        if($req->cate_parent !=0 ){
            $cate->parent_id = $req->cate_parent;
            // get parent 
        }
        else{
            $cate->parent_id = 0;
        }
    
        if($req->cate_name ){
            $cate->name = $req->cate_name;
            $cate->prefix = str_slug($req->cate_name,'-');
            $cate->save();
              
        }
        return Redirect::to(route('category.edit',['id'=>$id]))->with(['success'=>'Chỉnh sửa thành công']);
    }
    public function list_category(){

    	return view('backend.posts.list-category');
    }
    public function uploadImg( Request $req){
       // dd($req->all());
        $file = array('image' => Input::file('image'));
        $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return false;
            }else{
                $file = Input::file('image');
                $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
                $data =array();
                $data['url'] =  asset('/assets/post/'.$nameimg); 
                $file->move(public_path().'/assets/post/', $nameimg);  
                $data['name'] = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());
               
                return $data;        
            }

        //return  "vvv.com/backend/assets/images/a0.jpg";
    }
    public function edit_category($id){
        if($id ==null){
            return Redirect::to('admin.home');
        }else{
            $catId = Category::find($id);
            if($catId)  return view('backend.posts.edit_category',compact('catId'));
        }
        return Redirect::to('admin.home');
    }
    public function del_category(Request $req){

         $category =Category::find($req->id);
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

    public function post_search_tag(Request $req)
    {
        $tags = Tag::where('tag', 'like', '%'.$req->name.'%')->get();
        if(!$tags){
            return;
        }
        else{
           return view('backend.ajax.search_tag_post', compact('tags'));
        }
    }
}
