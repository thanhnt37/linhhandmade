<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use App\TagP;
use App\Tag_post;
use App\Tag_Product;
use App\ProductInCategory;
use App\Post_category;


class TagController extends Controller
{   
    
    public function index(){

    	$tags =  Tag::all();
    	return view('backend.tags.list',compact('tags'));
    }

    public function edit(Request $req, $id){
        $idTag = $req->id;
        $tag = Tag::findOrFail($idTag);
        return view('backend.ajax.ajax-edit-tag-post', compact('tag'));
    }
    public function update(Request $req){
        $tag = Tag::findOrFail($req->id);
        $tag->tag = $req->tagname;
        $tag->save();
        return redirect()->route('tags.list')->with('success', 'Sửa tag thành công');
    }
    public function deltag(Request $req){
        $tag_id = $req->id;
        $id_cate = $req->id_cate;
        if($id_cate == 0){
            $tag = Tag::findOrFail($tag_id);
            $tag->delete();
            $tag_cate  = Tag_post::where('tag_id', '=', $tag_id)->delete();
        } else {
            $cate_post = Post_category::where('category_id',$id_cate)->get();
              $in = array();
              foreach($cate_post as $item){
                array_push($in,$item->post_id);
              }

            $tag_cate  = Tag_post::where('tag_id', $tag_id)->wherein('post_id',$in)->delete();
        }
        echo 'true';
    }

    public function tag_in_cate($id_cate = null)
    {
        return view('backend.tags.list',compact('id_cate'));
    }

    public function TagsProduct(){
        $id_cate = null;
      return view('backend.tags.list-product',compact('id_cate'));
    }

    public function productedit(Request $req){
        $idTag = $req->id;
        $tagp = TagP::findOrFail($idTag);
        return view('backend.ajax.ajax-edit-tags', compact('tagp'));
    }
    public function tag_in_product($id_cate = null){

        return view('backend.tags.list-product',compact('id_cate'));

    }
    public function productupdate(Request $req){
        $tagp = TagP::findOrFail($req->id);
        $tagp->tag = $req->tagname;
        $tagp->save();
        return redirect()->route('tags.product.list')->with('success', 'Sửa tag thành công');
    }
    public function productdeltag(Request $req){
        $tag_product_id = $req->id;
        $id_cate = $req->id_cate;

        if($id_cate == 0){
            $tagp = TagP::findOrFail($tag_product_id);
            $tagp->delete();
            $tagp_product  = Tag_Product::where('tag_id', '=', $tag_product_id)
                        ->get();
            foreach($tagp_product as $tagp){
                $tagp->delete();
            }
        } else {
             
            $cate_products = ProductInCategory::where('cate_pro_id',$id_cate)->get();
                $in = array();
                foreach ($cate_products as $key => $value) {
                  array_push( $in,$value->product_id);
                }

             $tag_cate  = Tag_Product::where('tag_id', $tag_product_id)->wherein('product_id',$in)->delete();
        }
        echo 'true';
    }


    public function getTag_Ajax(Request $req){
        $key = $req->key;
        $tag = $req->name_tag;
        if($key == "product"){
            $l_tag = TagP::where('tag','like',"%$tag%")->take(50)->get();
            return json_encode(array('status'=>true,'list'=>$l_tag)); 
        }else{
            $l_tag = Tag::where('tag','like',"%$tag%")->take(50)->get();
            return json_encode(array('status'=>true,'list'=>$l_tag));
        }
    }
}
