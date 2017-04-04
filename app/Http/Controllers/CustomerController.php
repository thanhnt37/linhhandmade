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
  public function listCustomer(){
    $order = Order::select('phone', DB::raw('count(*) as total'))->selectRaw('sum(total) as sum1, phone')->selectRaw('sum(total_weight) as sum2, phone')->where('status',4)->groupby('phone')->orderby('id','asc')->get();
    return view('backend.customer.list-customer',['order'=>$order]);
  }

  public function ajaxCustomerOrder(Request $req){
    $phone = $req->id;
    if($phone){
      $order = Order::where('phone',$phone)->where('status',4)->get();
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
    $t1 = Configure_discounts::min('targets');
    $p = Configure_discounts::max('percent');
    $p1 = Configure_discounts::min('percent');
    $config = Configure_discounts::get();
    foreach ($config as $key => $value) {
      if($id == $value->id  ){
        $config_discounts = Configure_discounts::find($id);
        $config_discounts->targets = $targets;
        $config_discounts->percent = $percent;
        $config_discounts->save();
      }

    }
    // tạo mới
    $targets1 =  $req->chi_tieu1;
    $percent1 =  $req->giam_gia1;
    $id1 = $req->id1;
    //nếu khác null thì tạo mới
    if($targets1 != null && $percent1 != null ){
      if(($targets1 < $t1 || $targets1 > $t) && ($percent1 < $p1 || $percent1 > $p)){
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
    return json_encode(array('status'=>true));

  }

  public function DelConfigGiamGia(Request $req){
    $id = $req->id;
    $config_discounts = Configure_discounts::find($id);
    $config_discounts->delete();

    return json_encode(array('status'=>true));
  }
   
}
