<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Attribute;
use App\ProductAttribute;
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
use App\Customer;
use App\Order;
use App\Item;
use App\Tag_Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use DB;

use App\Frame;
use App\FrameImage;
use App\Configure_discounts;

class CustomerController extends Controller
{   
  //phong tim kiem khach hang
  public function Search(Request $req){
    $search =$req->cus;
    
    $customer = Customer::where('points','>',0)->where('phone','like',"%$search%")->paginate(10);
    return view('backend.customer.list-customer',['customer'=>$customer]);
  }
  public function listCustomer(){
    
    // $order = Order::select('phone', DB::raw('count(*) as total'))->selectRaw('sum(total) as sum1, phone')->selectRaw('sum(total_weight) as sum2, phone')->where('status',4)->groupby('phone')->orderby('id','asc')->get();
    // return view('backend.customer.list-customer',['order'=>$order]);
    $percent = Configure_discounts::min('targets');
    if(!$percent){
      $percent = 0;
    }
    $customer = Customer::where('points','>=',$percent)->paginate(10);
    return view('backend.customer.list-customer',['customer'=>$customer,'percent'=>$percent]);
  }

  public function ajaxCustomerOrder(Request $req){
    $phone = $req->phone;
    if($phone){
      $order = Order::where('phone',$phone)->where('status',4)->orderby('created_at','desc')->get();
      $html = view('backend.customer.ajax-customer-order',['order'=>$order]);
      return json_encode(array('status'=>true,'html'=>$html.""));
    }
  }

  //list
  public function AjaxListDiscounts(Request $req){
    $html = view('backend.customer.ajax-list-config');
    return json_encode(array('status'=>true,'html'=>$html.""));
  }

  public function ajaxConfigTichDiem(Request $req){
    $targets =  $req->chi_tieu;
    $percent =  $req->giam_gia;
    $id = $req->id;
    $t = Configure_discounts::max('targets');
    $p = Configure_discounts::max('percent');
    $false = 0;
    for ($i=0; $i <sizeof($id) ; $i++) { 
      if(($targets[$i] != null) && ($percent[$i] != null)){
        // điều kiên hàng i nhập không thiếu

      }else{
        $false ++;
        return json_encode(array('status'=>false,'not'=>1));
      }
      if($i > 0){
        if(($targets[$i] >$targets[$i-1]) && ($percent[$i] > $percent[$i-1] && $percent[$i] < 100)){

        }else{
          $false ++;
          return json_encode(array('status'=>false,'not'=>2));
        }
      }
    }
    if($false ==0){
         for ($i=0; $i <sizeof($id) ; $i++) { 
          $config = Configure_discounts::find($req->id[$i]);
          $config->targets = $req->chi_tieu[$i];
          $config->percent = $req->giam_gia[$i];
          $config->save();
        }

    }
    // tạo mới
    $targets1 =  $req->chi_tieu1;
    $percent1 =  (float)$req->giam_gia1;
    $id1 = $req->id1;
    //nếu khác null thì tạo mới
    if($req->chi_tieu1 && $req->giam_gia1){
      if($targets1 != null && $percent1 != null ){
        if(( $targets1 > $t) && ( $percent1 > $p)){
                $Configure_discounts = new Configure_discounts;
                $Configure_discounts->targets = $targets1;
                $Configure_discounts->percent = $percent1;
                $Configure_discounts->save();
        }else{
          return json_encode(array('status'=>false,'tp'=>1));
        }
      }else{
         return json_encode(array('status'=>false,'all'=>1));
      }
    }
    return json_encode(array('status'=>true));

  }

  public function DelConfigGiamGia(Request $req){
    $id = $req->id;
    $config_discounts = Configure_discounts::find($id);
    $config_discounts->delete();

    return json_encode(array('status'=>true));
  }
   
}
