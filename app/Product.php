<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model 
{
    protected $table = 'products';
    protected $guarded = [];
    
    public function getImages(){

    	return $this->hasMany('App\ProductImage');
    }
    
    public function getFrames(){
        return $this->hasMany('App\Frame');
    }
    public function getRatings(){

    	return $this->hasMany('App\ProductRating');
    }
    public function getAttributes_2(){

        return $this->belongsToMany('App\Attribute', 'product_attribute', 'product_id', 'attribute_id' )->orderBy('name', 'desc');;
    }
    public function getFolder()
    {
        return $this->belongsToMany('App\GroupAttribute', 'relation_product', 'product_id', 'group_id');
    }
    public function getAttributes(){

    	return $this->belongsToMany('App\Attribute', 'product_attribute');
    }
    public function contents(){

        return $this->hasMany('App\ContentProduct');
    }

    public function getCategory()
    {
        return $this->belongsToMany('App\CategoryProduct', 'product_category', 'product_id', 'cate_pro_id');
    }
    public function getProductCategory(){
        return $this->hasMany('App\ProductInCategory');
    }

    public function getPostTag(){
        return $this->belongsToMany('App\TagP', 'tag_products', 'product_id', 'tag_id');
    }
    public function savePostTag($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->getPostTag()->sync($inputPermissions);
        } else {
            $this->getPostTag()->detach(); 
        }
    }
    public function getTagsid(){
        return $this->hasMany('App\Tag_Product');
    }
    public function getComments(){
        return $this->hasMany('App\CommentProduct');
    }
    public function getComments_public(){
        return $this->hasMany('App\CommentProduct')->select('comment_products.*','accounts.name','accounts.email','accounts.phone','accounts.phone')->where('comment_products.status',1)->leftJoin('accounts', 'accounts.id', '=', 'comment_products.account_id');
    }
    public function saveThumb($size=null) {
        try {
             $w = 150;
            $h = 150;
            if(!empty($size) && is_array($size)) {
                $w = isset($size['width']) ? $size['width'] : $w;
                $h = isset($size['height']) ? $size['height'] : $h;
            }
            if(empty($this->img)) {
                return false;
            }
            $folder = public_path().'/assets/product_thumb/';


            $imagePath = public_path($this->img);
            if(!is_file($imagePath)){
                return false;
            }
            $arr = explode('/',$this->img);
            if( sizeof($arr) ){
                $img_name =  $arr[sizeof($arr)-1];

            }else{
                return false;
            }

            $thumpPath = public_path().'/assets/product_thumb/'.$w.'_'.$h.'_'.$img_name;
            // dd($imagePath);
            if(is_file($imagePath)/* && !is_file($thumpPath)*/){
                $max_width =  $w;
                $max_height  = $h;
                $source_file = $imagePath;
                $dst_dir = $thumpPath;
                $quality = 9;

                $imgsize = getimagesize($source_file);
                $width = $imgsize[0];
                $height = $imgsize[1];
                $mime = $imgsize['mime'];
             
                switch($mime){
                    case 'image/png':
                        $image_create = "imagecreatefrompng";
                        $image = "imagepng";
                        $quality = 9;
                        break;
                    case 'image/jpeg':
                        $image_create = "imagecreatefromjpeg";
                        $image = "imagejpeg";
                        $quality = 9;
                        break;
                    default:
                        return false;
                        break;
                }
                 
                $dst_img = imagecreatetruecolor($max_width, $max_height);
                $white = imagecolorallocate($dst_img, 255, 255, 255);
                imagefill($dst_img, 0, 0, $white);
                
                $src_img = $image_create($source_file);
                 
                $width_new = $height * $max_width / $max_height;
                $height_new = $width * $max_height / $max_width;
                //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
                if($width_new > $width){
                    //cut point by height
                    $h_point = (($height - $height_new) / 2);
                    //copy image
                    imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
                }else{
                    //cut point by width
                    $w_point = (($width - $width_new) / 2);
                    imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
                }
                if($image == 'imagepng'){
                    $image($dst_img, $dst_dir, 9);
                }else{
                    $image($dst_img, $dst_dir, 99);     
                }
                $this->thumb_images = '/assets/product_thumb/'.$w.'_'.$h.'_'.$img_name;
                $this->save();
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}
