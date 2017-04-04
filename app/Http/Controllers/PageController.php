<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;
use App\Post;
use DB;
use App\Contact;
use Mail;
use App\Order;
use App\OrderItem;

use App\CategoryProduct;
use App\Category;
use App\Filter;
use App\FilterPrice;
use App\Attribute;
use App\ProductAttribute;
use App\Product;
use App\ContentProduct;
use App\ProductInCategory;
use App\ProductImage;
use App\Form;
use App\System;

use App\Account;
use App\CommentPost;
use App\CommentProduct;

class PageController extends Controller {

   public function index(){
   	  return view('frontend.pages.trangchu');
   }
   public function getDanhmuc(){
   	  $product =array();
   	  $category =null;

   	  return view('frontend.pages.danhmuc',compact('product','category'));
   }

   public function getBaiViet($id = null, $slug =null){
   		if($id ==null) return redirect('/');

   		$post = Post::find($id);
   		$categories = Category::where('id',">","1")->get();
   		if(sizeof($post)){
   			if($slug == $post->slug){
   				return view('frontend.pages.blog',compact('post','categories'));
   			}
   			return redirect('/');
   		}else{
   			if($id ==null) return redirect('/');
   		}
   		
   }

   public function getSearch(Request $req){
   	 $search =  $req->search;
   	 if($search){
   	 	$filter_price = FilterPrice::get();
   	 	
   	 	$product  = Product::where('name', 'like', "%$search%")
   	 					->orWhere('slug','like', "%$search%")->get();
   	 	$list_attr = array();
		$obj_attr = array();
		foreach($product as $key => $item){
			$x = $item->getAttributes_2;
			foreach($x as $k){
				if( !in_array($k->id, $list_attr)){
					array_push($list_attr, $k->id);				
					array_push($obj_attr, $k);				
				}
			}
			
		}

		$filter = Filter::orderby('name','asc')->get();
		$name = "";
		$filter_target = array();
		foreach($filter as $key => $filter_item){
				$attr_public = Attribute::where('name',$filter_item->name)->where('type',1)->first();
				if($attr_public->status == 1){
					if($filter_item->type ==1 ){
						$attr_f = Attribute::where('name',$filter_item->name)->where('type',0)->get();
						foreach($attr_f as $attr_i){
							if(in_array($attr_i->id, $list_attr)){
								if( $attr_i->value <= $filter_item->max && $attr_i->value >= $filter_item->min){
									array_push($filter_target , $filter_item->id);
									break;
								}	
							}
						}
					}else{
						if(in_array($filter_item->attribute_id, $list_attr)){
							array_push($filter_target , $filter_item->id);
						}
					}
				}
				
			$name = $filter_item->name;
		}
		$filter = Filter::wherein('id',$filter_target)->orderby('name','asc')->get();
		$filter_price = FilterPrice::get();
		$id_filter_price_arr = array();
		$in = array();
		foreach ($product as $key => $value) {
			array_push($in, $value->id);
			$f_p =  (int)$value->price;
			if((int)$value->price_sale){
				$f_p = (int)$value->price_sale;
			}
			foreach ($filter_price as $key2 => $value2) {
				if($f_p <= ((int)$value2->max ) &&  ((int)$value2->min) <= $f_p){
					if(!in_array($value2->id, $id_filter_price_arr)){
						array_push($id_filter_price_arr, $value2->id);
					}
				}
			}
		}
		$filter_price = FilterPrice::wherein('id',$id_filter_price_arr)->get();
		$product =  Product::wherein('id',$in)->paginate(30);
		return view('frontend.pages.timkiem',compact('product','search','filter','filter_price'));
   	 }else{

   	 }
   }
   public function FilterSearch(Request $req){
   		$i_check = $req->i_check;
   		$search =  $req->search;
   		$i_check_price = $req->i_check_price;
   		$filter_search  = Filter::wherein('id',$i_check)->orderby('name','asc')->get();
   		$filter_price_search  = FilterPrice::wherein('id',$i_check_price)->get();
   		$attr_list_id_search = array();
   		foreach($filter_search as $f){
   			if($f->type == 1){
   				$min = $f->min;
   				$max = $f->max;
   				$name = $f->name;
   				$attr_temp  = Attribute::where('name',$name)->get();
   				foreach($attr_temp as $a_temp){
   					if($a_temp->value >= $min && $a_temp->value <= $max){
   						if(!in_array($a_temp->id, $attr_list_id_search)){
	   						array_push($attr_list_id_search, $a_temp->id);
	   					}
   					}
   				}
   			}else{
   				array_push($attr_list_id_search, $f->attribute_id);
   			}
		}
		// attr_list_id_search các thuộc tính bắt buộc phải có
   		
   	 	if($search){
   			$list_attr =  array();
			$obj_attr = array();
			$product  = Product::where('name', 'like', "%$search%")
   	 					->orWhere('slug','like', "%$search%")->get();
			$num_product = sizeof($product);
			$arr_product = array();
			if($attr_list_id_search){
				$list_product_found = 
				ProductAttribute::wherein('attribute_id',$attr_list_id_search)
					->orderby('product_id')->get();
				$list_product_found_group = 
				ProductAttribute::wherein('attribute_id',$attr_list_id_search)
					->groupby('product_id')->get();
				foreach ($list_product_found_group as $key => $value) {
					$check = 0;
					foreach ($list_product_found as $key2 => $value2) {
						if($value2->product_id == $value->product_id){
							if( in_array($value2->attribute_id, $attr_list_id_search) ){
								$check++;
							}
						}
					}
					if($check == sizeof($i_check)){
						array_push($arr_product, $value->product_id);
					}
				}
				for($i = 0 ; $i<$num_product ; $i++){
					if( !in_array($product[$i]->id, $arr_product)){
						unset($product[$i]);
					}
				}
			}else{
				$product  = Product::where('name', 'like', "%$search%")
   	 					->orWhere('slug','like', "%$search%")->get();
			}
			$arr_key = array();

			foreach($product as $key => $item){
				$check = 0 ;
				$price = $item->price;
				if($item->price_sale){
					$price = $item->price_sale;
				}
				if(!$price) $price=0;
				foreach ($filter_price_search as $key2 => $value2) {
					if( (int)$price < (int)$value2->min || (int)$price > (int)$value2->max){
						$check ++;
						
					};
				}
				if($check == 0){
					$x = $item->getAttributes_2;
					foreach($x as $k){
						if( !in_array($k->id, $list_attr)){
							array_push($list_attr, $k->id);				
							array_push($obj_attr, $k);				
						}
					}
					array_push($arr_key, $item->id);
				}else{

				}
			}
			$product =  Product::wherein('id',$arr_key)->get();
		
			$filter = Filter::orderby('name','asc')->get();
			$name = "";
			$filter_target = array();
			foreach($filter as $key => $filter_item){
					$attr_public = Attribute::where('name',$filter_item->name)->where('type',1)->first();
					if($attr_public->status == 1){

						if($filter_item->type ==1 ){
							$attr_f = Attribute::where('name',$filter_item->name)->where('type',0)->get();
							foreach($attr_f as $attr_i){ // 300 700 1000 
								if(in_array($attr_i->id, $list_attr)){
									if( $attr_i->value <= $filter_item->max && $attr_i->value >= $filter_item->min){
										array_push($filter_target , $filter_item->id);
										break;
									}	
								}
							}
						}else{
							if(in_array($filter_item->attribute_id, $list_attr)){
								array_push($filter_target , $filter_item->id);
							}
						}

					}
				$name = $filter_item->name;
			}
			$filter = Filter::wherein('id',$filter_target)->orderby('name','asc')->get();
			$filter_price = FilterPrice::get();
			if(!$i_check) $i_check = array();
			if(!$i_check_price) $i_check_price = array();
			// $product
			$in = array();
			$id_filter_price_arr = array();
			foreach ($product as $key => $value) {
				array_push($in, $value->id);
				$f_p =  (int)$value->price;
				if((int)$value->price_sale){
					$f_p = (int)$value->price_sale;
				}
				foreach ($filter_price as $key2 => $value2) {
					if($f_p <= ((int)$value2->max ) &&  ((int)$value2->min) <= $f_p){
						if(!in_array($value2->id, $id_filter_price_arr)){
							array_push($id_filter_price_arr, $value2->id);
						}
					}
				}
			}
			$filter_price = FilterPrice::wherein('id',$id_filter_price_arr)->get();
			$product =  Product::wherein('id',$in)->paginate(30);

			$filter_html = view('frontend.ajax.filter',compact('i_check','i_check_price','filter','filter_price'));
			$product_html = view('frontend.ajax.product',compact('product'));
		
			return json_encode( array(
					'stauts'=>true,
					'filter_container'=>$filter_html."",
					'product_container'=>$product_html."")
			);
		}
   		return json_encode($req->all());
   }
   public function getDanhmucSanpham($slug =null){
		if($slug !=null){
			$category = CategoryProduct::where('prefix',$slug)->first();
			$filter_price = FilterPrice::get();

			if(sizeof($category)){
				$list_attr = array();
				$obj_attr = array();
				$product = $category->products_public;
				foreach($product as $key => $item){
					$x = $item->getAttributes_2;
					foreach($x as $k){
						if( !in_array($k->id, $list_attr)){
							array_push($list_attr, $k->id);				
							array_push($obj_attr, $k);				
						}
					}
				}
				$filter = Filter::orderby('name','asc')->get();
				$name = "";
				$filter_target = array();
				foreach($filter as $key => $filter_item){
						$attr_public = Attribute::where('name',$filter_item->name)->where('type',1)->first();
						if($attr_public->status == 1){
							if($filter_item->type ==1 ){
								$attr_f = Attribute::where('name',$filter_item->name)->where('type',0)->get();
								foreach($attr_f as $attr_i){
									if(in_array($attr_i->id, $list_attr)){
										if( $attr_i->value <= $filter_item->max && $attr_i->value >= $filter_item->min){
											array_push($filter_target , $filter_item->id);
											break;
										}	
									}
								}
								
							}else{
								if(in_array($filter_item->attribute_id, $list_attr)){
									array_push($filter_target , $filter_item->id);
								}
							}
						}
						
					$name = $filter_item->name;
				}
				$filter = Filter::wherein('id',$filter_target)->orderby('name','asc')->get();
				$filter_price = FilterPrice::get();
				$id_filter_price_arr = array();
				$in = array();
				foreach ($product as $key => $value) {
					array_push($in, $value->id);
					$f_p =  (int)$value->price;
					if((int)$value->price_sale){
						$f_p = (int)$value->price_sale;
					}

					foreach ($filter_price as $key2 => $value2) {
						if($f_p <= ((int)$value2->max ) &&  ((int)$value2->min) <= $f_p){
							if(!in_array($value2->id, $id_filter_price_arr)){
								array_push($id_filter_price_arr, $value2->id);
							}
						}
					}
				}
				$filter_price = FilterPrice::wherein('id',$id_filter_price_arr)->get();
				$product =  Product::wherein('id',$in)->paginate(30);
				return view('frontend.pages.danhmuc',compact('product','category','filter','filter_price'));
			}
		}
   }
   public function Filter(Request $req){
   		// danh sach filter
   		$i_check = $req->i_check;
   		$i_check_price = $req->i_check_price;
   		$filter_search  = Filter::wherein('id',$i_check)->orderby('name','asc')->get();
   		$filter_price_search  = FilterPrice::wherein('id',$i_check_price)->get();
   		$attr_list_id_search = array();
   		foreach($filter_search as $f){
   			if($f->type == 1){
   				$min = $f->min;
   				$max = $f->max;
   				$name = $f->name;
   				$attr_temp  = Attribute::where('name',$name)->get();
   				foreach($attr_temp as $a_temp){
   					if($a_temp->value >= $min && $a_temp->value <= $max){
   						if(!in_array($a_temp->id, $attr_list_id_search)){
	   						array_push($attr_list_id_search, $a_temp->id);
	   					}
   					}
   				}
   			}else{
   				array_push($attr_list_id_search, $f->attribute_id);
   			}
		}
		// attr_list_id_search các thuộc tính bắt buộc phải có
   		$category_id = $req->category;
   		$category = CategoryProduct::find($category_id);
   		if(sizeof($category)){
			$list_attr =  array();
			$obj_attr = array();
			$product = $category->products_public;
			$num_product = sizeof($product);
			$arr_product = array();
			if($attr_list_id_search){
				// Danh sách các sản phẩm
				// $list_product_found = 
				// ProductAttribute::wherein('attribute_id',$attr_list_id_search)
				// 	->groupby('product_id')->get();
				$list_product_found = 
				ProductAttribute::wherein('attribute_id',$attr_list_id_search)
					->orderby('product_id')->get();
				$list_product_found_group = 
				ProductAttribute::wherein('attribute_id',$attr_list_id_search)
					->groupby('product_id')->get();
				foreach ($list_product_found_group as $key => $value) {
					$check = 0;
					foreach ($list_product_found as $key2 => $value2) {
						if($value2->product_id == $value->product_id){
							if( in_array($value2->attribute_id, $attr_list_id_search) ){
								$check++;
							}
						}
					}
					if($check == sizeof($i_check)){
						array_push($arr_product, $value->product_id);
					}
				}

				for($i = 0 ; $i<$num_product ; $i++){
					if( !in_array($product[$i]->id, $arr_product)){
						unset($product[$i]);
					}
				}
			}else{
				$product = $category->products_public;
			}
			$arr_key = array();

			foreach($product as $key => $item){
				$check = 0 ;
				$price = $item->price;
				if($item->price_sale){
					$price = $item->price_sale;
				}
				if(!$price) $price=0;
				foreach ($filter_price_search as $key2 => $value2) {
					if( (int)$price < (int)$value2->min || (int)$price > (int)$value2->max){
						$check ++;
						
					};

				}
				if($check == 0){
					$x = $item->getAttributes_2;
					foreach($x as $k){
						if( !in_array($k->id, $list_attr)){
							array_push($list_attr, $k->id);				
							array_push($obj_attr, $k);				
						}
					}
					array_push($arr_key, $item->id);
				}else{

				}
			}
			$product =  Product::wherein('id',$arr_key)->get();
		
			$filter = Filter::orderby('name','asc')->get();
			$name = "";
			$filter_target = array();
			foreach($filter as $key => $filter_item){
					$attr_public = Attribute::where('name',$filter_item->name)->where('type',1)->first();
					if($attr_public->status == 1){

						if($filter_item->type ==1 ){
							$attr_f = Attribute::where('name',$filter_item->name)->where('type',0)->get();
							foreach($attr_f as $attr_i){ // 300 700 1000 
								if(in_array($attr_i->id, $list_attr)){
									if( $attr_i->value <= $filter_item->max && $attr_i->value >= $filter_item->min){
										array_push($filter_target , $filter_item->id);
										break;
									}	
								}
							}
						}else{
							if(in_array($filter_item->attribute_id, $list_attr)){
								array_push($filter_target , $filter_item->id);
							}
						}

					}
				$name = $filter_item->name;
			}
			$filter = Filter::wherein('id',$filter_target)->orderby('name','asc')->get();
			$filter_price = FilterPrice::get();
			if(!$i_check) $i_check = array();
			if(!$i_check_price) $i_check_price = array();
			// $product
			$in = array();
			$id_filter_price_arr = array();
			foreach ($product as $key => $value) {
				array_push($in, $value->id);
				$f_p =  (int)$value->price;
				if((int)$value->price_sale){
					$f_p = (int)$value->price_sale;
				}
				foreach ($filter_price as $key2 => $value2) {
					if($f_p <= ((int)$value2->max ) &&  ((int)$value2->min) <= $f_p){
						if(!in_array($value2->id, $id_filter_price_arr)){
							array_push($id_filter_price_arr, $value2->id);
						}
					}
				}
			}
			$product =  Product::wherein('id',$in)->paginate(30);
			$filter_price = FilterPrice::wherein('id',$id_filter_price_arr)->get();
			$filter_html = view('frontend.ajax.filter',compact('i_check','i_check_price','filter','filter_price'));
			$product_html = view('frontend.ajax.product',compact('product'));
		
			return json_encode( array(
					'stauts'=>true,
					'filter_container'=>$filter_html."",
					'product_container'=>$product_html."")
			);
		}
   		return json_encode($req->all());
   }


   public function getChitietSanpham($id = null){
   	  return view('frontend.pages.chitiet');
   }
   public function getChitietSanphamSlug($id = null, $slug =null){
    	$product = Product::where('id',$id)->where('status',1)->first();
    	if( sizeof($product) ){
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
	        return view('frontend.pages.chitiet',compact('product','content','attr','catIds'));
    	}
    	return redirect('/');
   		
   }
   public function getGiohang(){
   	  return view('frontend.pages.giohang');
   }
	public function getProductAjax(Request $req){
		$id =  $req->id;
		$product = Product::where('id',$id)->where('status',1)->first();
		if( sizeof($product) ){
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
	        $product_html = view('frontend.ajax.product-detail',compact('product','content','attr','catIds'));
			return json_encode(array(
					'status'=>true,
					'html'=>$product_html.""
			));
		}
		return json_encode(array('status'=>false,'product'=>null));
	}
	public function addCart(Request $req){
		$id =  $req->id;
		$num =  $req->num;
		$product = Product::find($id);
		// $list_pro = Session::get('product');
		// $list_pro[$id] = $product;
		$add = array(
			'num'=>$num,'product'=>$product
		);
		$list_pro = Session::get('product');
		$c = 0;
		if($list_pro != null){
			foreach($list_pro as $key =>$value){
				if( $id == $value['product']->id){
					$c++;
					$list_pro[$key]['num'] = $num;
				}
			}
		}
		if($c==0){
			Session::push('product',$add);
		}else{
			Session::set('product', $list_pro);
		}
		$list_pro = Session::get('product');
		if( sizeof($product) ){
			$all = 0;
			foreach($list_pro as $key => $item)
			{
				$price = $item['product']->price;
	            if($item['product']->price_sale) 
	            {
	                $price = $item['product']->price_sale;
	            }
	            $price = $price ;
	            $all +=  $price * $item['num'];
			}
			$text = number_format( (int)$all,0,'','.')."đ";
			$views  =  view('frontend.ajax.cart',compact('product','num','list_pro'));
			return json_encode(array('status'=>true,'product'=>$product,'session'=>$list_pro,'all'=>$text,'li'=>$views." "));
		}
		return json_encode(array('status'=>false,'product'=>null));
	}
	public function removeCart(Request $req){
		$id =  $req->id;
		$list_pro = Session::get('product');

		if($list_pro != null){
			foreach($list_pro as $key =>$value){
				if( $id == $value['product']->id){
					unset($list_pro[$key]);
				}
			}
		}
		Session::set('product', $list_pro);
		$all = 0;
		foreach($list_pro as $key => $item)
		{
			$price = $item['product']->price;
            if($item['product']->price_sale) 
            {
                $price = $item['product']->price_sale;
            }
            $price = $price ;
            $all +=  $price * $item['num'];
		}
		$text = number_format( (int)$all,0,'','.')."đ";
		return $text;
	}
	public function orderProduct(Request $req){
		$list_pro = Session::get('product');
		if($list_pro == null){
			echo "false";
			// return json_encode(array('status'=>false,'data'=>$req->all()));
		}else{
			$all = 0;
			foreach($list_pro as $key => $item)
			{
				$price = $item['product']->price;
	            if($item['product']->price_sale) 
	            {
	                $price = $item['product']->price_sale;
	            }
	            $price = $price ;
	            $all +=  $price * $item['num'];
			}

			$order = new Order;
			$order->fullname = $req->name;
			$order->email = $req->email;
			$order->phone = $req->phone;
			$order->note = $req->comment;
			$order->address = $req->address;
			$order->status = 1;
			$order->total = $all;
			if($order->save()){
				foreach($list_pro as $key => $item)
				{
					$order_item = new OrderItem;
					$order_item->quantity = $item['num'];
					$order_item->order_id = $order->id;
					$order_item->product_id = $item['product']->id;
					$order_item->price = (int) $item['product']->price;
					$order_item->price_sale =  (int) $item['product']->price_sale;
					$order_item->save();
				}	
				Session::forget('product');
				ignore_user_abort(true);
				set_time_limit(30);
				ob_start();
				echo "true";
				header('Connection: close');
				header('Content-Length: '.ob_get_length());
				ob_flush();
				flush();

				try {
					$mail = System::select('email_send','email_order','email_password')->first();
					if( !empty($mail->email_send) && !empty($mail->email_password) ){
						config(['mail.username' => $mail->email_send]);
						config(['mail.password' => $mail->email_password]);
						config(['mail.port' => "587"]);
						config(['mail.host' => "smtp.gmail.com"]);
						config(['mail.encryption' => "tls"]);
						$data = ['hoten'=>$order->fullname,'email'=>$order->email,'phone'=>$order->phone,'note'=>$order->note,'idorder'=>$order->id,'address'=>$order->address];

						if($mail->email_order){
							Mail::send('frontend.emails.order',$data,function($message) use ($mail){
								$message->from($mail->email_send);
								$message->to($mail->email_order,'Admin')->subject('Đơn Đặt Hàng');
							});
						}
					}
				} catch (Exception $e) {
					
				}

				// return json_encode(array('status'=>true,'data'=>$req->all()));
			}
			// return json_encode(array('status'=>true,'data'=>$req->all()));
			echo "true";
		}
		
	}
	public function tuvanSanpham(Request $req){
		$ten = $req->name;
		$sdt = $req->email;
		$cauhoi = $req->comment;
		$form =  new Form;
		$form->text_1 = $ten;
		$form->text_2 = $sdt;
		$form->text_3 = $cauhoi;
		$form->type = "Tư vấn";
		if($form->save()){
			ignore_user_abort(true);
			set_time_limit(30);
			ob_start();
			echo "true";
			header('Connection: close');
			header('Content-Length: '.ob_get_length());
			ob_flush();
			flush();
			try {
				$mail = System::select('email_send','email_form','email_password')->first();
				if( !empty($mail->email_send) && !empty($mail->email_password)  ){
					$data = ['ten'=>$ten,'sdt'=>$sdt,'cauhoi'=>$cauhoi];
					if($mail->email_form){
						config(['mail.username' => $mail->email_send]);
						config(['mail.password' => $mail->email_password]);
						config(['mail.port' => "587"]);
						config(['mail.host' => "smtp.gmail.com"]);
						config(['mail.encryption' => "tls"]);
					    Mail::send('frontend.emails.tuvan',$data,function($message) use ($mail){
						$message->from($mail->email_send);
						$message->to($mail->email_form,'Admin')->subject('Thông tin tư vấn');
					});
					}
				}
			}catch (Exception $e) {	
			
			}
		}else{
			echo "false";
		}
	}
	public function dangkyuudai(Request $req){

		$email = $req->email;
		$form =  new Form;
		$form->text_1 = $email;
		$form->type = "Ưu đãi";
		if($form->save()){
			ignore_user_abort(true);
			set_time_limit(30);
			ob_start();
			echo "true";
			header('Connection: close');
			header('Content-Length: '.ob_get_length());
			ob_flush();
			flush();


			try {
				$mail = System::select('email_send','email_form','email_password')->first();
				if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
					config(['mail.username' => $mail->email_send]);
					config(['mail.password' => $mail->email_password]);
					config(['mail.port' => "587"]);
					config(['mail.host' => "smtp.gmail.com"]);
					config(['mail.encryption' => "tls"]);
					$data =  ['testVar' => $email];

					if($mail->email_form){
							Mail::send('frontend.emails.contact',$data, function($message) use ($mail){
					        $message->from($mail->email_send);
					        $message->to($mail->email_form, 'Admin')->subject('Có Email đăng kí nhận Ưu đãi');
				    	});
					}
				}
			}catch (Exception $e) {
				
			}
			
		}else{
			echo "false";
		}
	}
	public function addCommentToPost(Request $req){
		if( $req->product_id ){
	      	// setup rating to product
	      	$product = Product::find($req->product_id);
	      	if($product){
      			$acc_id = 0;
			    if($req->username){
			        $acc = Account::firstOrNew(['username'=>$req->username]);
			        
			        if($req->name && !$acc->name){
			          $acc->name = $req->name; 
			        }
			        $acc->save();
			        $acc_id = $acc->id;
			        $comment = new CommentProduct;
				    if( $acc_id ) {
				    	$comment->account_id = $acc_id; $comment->is_guest = 0;
				    	$comment->product_id = $req->product_id;
					    $req->comment ? $comment->comment = $req->comment :  $comment->comment = "Comment mặc định";
					    $req->parent_id ? $comment->parent_id = $req->parent_id :  $comment->parent_id = 0;
					    $comment->comment_admin = "";
					    $comment->status = 0;
					    if($req->rating){
					     	$rating  = floatval($req->rating);
					     	if($rating > 5 ) $rating = 5;
					     	if($rating < 0 ) $rating = 0;
					     	$comment->rating = $rating;
					     	$comment->save();
					     	$all_rating = $product->rating;
					     	$number_rate = $product->number_rate;

					     	$new_rating = ( $all_rating * $number_rate + $rating )/ ( $number_rate + 1 );
					     	$product->rating = $new_rating;
					     	$product->number_rate = $number_rate + 1;
					     	// $product->save();
					     	return json_encode(array('status'=>true,'data'=>$comment));
					    }else{
					    	return json_encode(array('status'=>false,'data'=>"null"));
					    }
				 	}
			    }		
	      	}
	    }
	    return json_encode(array('status'=>false,'data'=>"null"));
	      
	}
	public function getAjaxCommentProduct(Request $req){
		$product = Product::find($req->product);
		if($product){
			$view = view('frontend.ajax.comment-ajax',compact('product'));

			return json_encode(array('status'=>false,'html'=>$view.''));
		}
		return json_encode(array('status'=>false));
	}
}