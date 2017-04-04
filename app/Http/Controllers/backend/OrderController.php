<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Customer;
use App\Product;
use App\Frame;
use App\Item;
use App\System;
use App\Email_General;
use App\OrderLogs;
use Mail;
use App\District;
use App\Province;
use App\Configure_discounts;
use App\Config_distric;

class OrderController extends Controller
{
    public function search(Request $req){
        $s = trim($req->od);
        $id = substr($s,1);
        $list_orders = Order::where('id','like',"%$id%")->orwhere('phone','like',"%$s%")->orwhere('fullname','like',"%$s%")->orderby('created_at','desc')->paginate(5);
          if(session('admin')->can('xem_don_hang') || session('admin')->can('them_don_hang')  || session('admin')->can('xoa_don_hang') ||  session('admin')->can('xu_li_don_hang') ){
            $id=null;
            $a=1;
            return view('backend.orders.index',compact('id','list_orders','a','s'));
        }else{
             return redirect()->route('admin.home');
        }
    }

    public function index(Request $req)
    {   
        if(session('admin')->can('xem_don_hang') || session('admin')->can('them_don_hang')  || session('admin')->can('xoa_don_hang') ||  session('admin')->can('xu_li_don_hang') ){
            $s = trim($req->od);
            $id=null;
            return view('backend.orders.index',compact('id','s'));
        }else{
             return redirect()->route('admin.home');
        }
    }
    public function show($id=null)
    {
        if( session('admin')->can('xem_don_hang') || session('admin')->can('them_don_hang') ){
            $order = Order::find($id);
            if($order){
                return view('backend.orders.show', compact('order'));  
            }
            return redirect()->back();
        }
        else{
             return redirect()->route('admin.home');
        }
      
    }
    public function list_type($id=null){
        if(  session('admin')->can('xem_don_hang') || session('admin')->can('them_don_hang')  || session('admin')->can('xoa_don_hang') ||  session('admin')->can('xu_li_don_hang') ){
            return view('backend.orders.index', compact('id')); 
        }
        else{
             return redirect()->route('admin.home');
        }

        
    }

    public function status(Request $req)
    {
        $order = Order::find($req->id);
        $order->status = 0;
        $order->save();
        return json_encode(array('status'=>true));

    }
    public function getOrderadd(){
        return view('backend.orders.add');
    }
    // Thêm đơn hàng mới
    public function postOrderadd(Request $req){
        $l_p = $req->productId;
        if($l_p == null){
            echo json_encode(array('status'=>false,'errors'=>0));
        }else{
            $id = $req->province;
            $id_d = $req->district;
            $province = Province::find($id);
            $district = District::find($id_d);
            
            if($id <= 0){
                echo json_encode(array('status'=>false,'errors'=>1,'message'=>'Vui lòng chọn Tỉnh Thành'));
            }else{
                if($id_d <= 0){
                    echo json_encode(array('status'=>false,'errors'=>2,'message'=>'Vui lòng chọn Quận Huyện'));
                }else{
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
                    $order = new Order();
                    $order->fullname = $req->full_name;
                    $order->email = $req->email;
                    $order->phone = $phone;
                    $order->address = $req->address;
                    $order->note = $req->note;
                    $order->status = 1;
                    $order->district_id = $district->id;
                    $order->price_district = $district->price;
                    if($order->save()){
                        $size =  sizeof($req->productId);
                        $l_p = $req->productId;
                        $l_n = $req->productNum;
                        $l_w = $req->weight;
                        if($size > 0){
                            $sum = 0; 
                            $weight = 0; 
                            for($i=0 ;$i<$size;$i++){
                                $id_p = $l_p[$i];
                                $num = $l_n[$i];
                                if((int)$num > 0){
                                    $product = Frame::find($id_p); 
                                    if (sizeof($product)) {
                                        $OrderItem = new OrderItem;
                                        $OrderItem->product_id = $product->product_id;
                                        $OrderItem->frame_id = $product->id;
                                        $OrderItem->price = (int)$product->price;
                                        $OrderItem->price_sale = (int)$product->price_sale;
                                        $OrderItem->order_id = $order->id;
                                        $OrderItem->weight =  (float)$product->weight;
                                        $OrderItem->quantity = $num;
                                        $OrderItem->transpost = $district->price;
                                        if( (int)$product->price_sale ){
                                          $sum += $num*( (int)$product->price_sale ) ;
                                        }else{
                                        $sum += $num*( (int)$product->price) ;
                                        }

                                        $weight += $num * $product->weight;

                                        /// tinh phí vận chuyển
                                        $list_phi = Config_distric::where('district_id',$district->id)->get();
                                        $some = 0;
                                        if(sizeof($list_phi)){
                                            $max_w = $list_phi[count($list_phi) - 1];
                                            foreach ($list_phi as $key => $value2) {
                                                
                                                if((float)$weight > (float)$value2->min_weigh && (float)$weight <= (float)$value2->max_weigh ){
                                                    $some = $value2->price;
                                                }
                                                if((float)$weight > (float)$max_w->max_weigh){
                                                    $c = (float)$weight - (float)$max_w->max_weigh;
                                                    $d = ((float)$c*(float)$value2->init_price)/$value2->init_weigh; 
                                                    $some = (float)$max_w->price + (float)$d;
                                                }
                                            }
                                        }else{
                                            $some = 0;
                                        }
                                        $OrderItem->save();
                                    }
                                }    
                            }
                            $percen = 0;
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
                                    $order->percent = (float)$percent_y;
                                }
                            }else{
                                $order->percent = 0;
                            }
                            $order->total_weight = $some;
                            $order->total = $sum;
                            $order->save();
                        }
                        ignore_user_abort(true);
                        set_time_limit(3000);
                        ob_start();
                        $link = route('order.show',['id'=>$order->id]);
                        echo json_encode(array('status'=>true,'link'=>$link,'message'=>'Thêm Đơn Hàng Thành Công'));
                        $size = ob_get_length();
                        header('Connection: close');
                        header('Content-Length: '.$size);
                        // header("Content-Range: 0-".($size-1)."/".$size);
                        ob_flush();
                        flush();
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
                        $link = route('order.show',['id'=>$order->id]);
                        echo json_encode(array('status'=>true,'link'=>$link,'message'=>'Thêm Đơn Hàng Thành Công'));
                        // return redirect()->route('order.show',['id'=>$order->id])->with('success','Thêm Đơn Hàng Thành Công');  
                    }
                }
            
            }
        } 
    }
    public function infoOrder(Request $req){
        $id = $req->id;
        $order = Order::find($id);
        if(sizeof($order)){
            $view =  view('backend.orders.ajax-info-order',compact('order'));
            return json_encode(array('status'=>true,'order'=>$order,'innertext'=>$view.''));
        }
        return json_encode(array('status'=>false,'order'=>null));
    }
    // lưu đơn hàng thay đổi trạng thái đơn hàng
    public function saveOrder(Request $req){
        $id = $req->id;
        $status = $req->status;
        $note_stick = $req->note_stick;
        $order = Order::find($id);
        if(sizeof($order)){
            $last_status =    $order->status; 
            $log = new OrderLogs;
            $log->status = $req->status;
            $log->note_stick = $req->note_stick;
            $log->order_id = $order->id;
            $log->user_id = session('admin')->id;
            $log->save();
            $order->status = $status;    
            $order->note_stick = $note_stick;
            // Nếu còn số lượng thì mới đc save
            $order_item = OrderItem::where('order_id',$order->id)->get();
            $check_sku = 0;
            foreach ($order_item as $key => $value2) {
                $frame = Frame::find($value2->frame_id);
                if($frame){
                    if($frame->sku < $value2->quantity){
                        $check_sku++;
                    }
                }
            }
            if($check_sku){
                // Thông báo số lượng sản phẩm không đủ để thanh toán
                if($status == 5){ echo "404";return;}
            }
            if($order->save()){
                $phone="";
                if(strlen($order->phone) > 5){
                    $phone = preg_replace('/[^\dxX]/', '', $order->phone);
                    $x84 = substr($phone,0,2);
                    if($x84 == 84){ $phone = substr($phone,2);  }
                    $x0 = substr($phone,0,1);
                    if($x0 != 0){ $phone = "0".$phone;  } 
                    $phone = $phone;
                }
                //
                ignore_user_abort(true);
                set_time_limit(3000);
                ob_start();
                echo $order->status;
                $size = ob_get_length();
                header('Connection: close');
                header('Content-Length: '.$size);
                // header("Content-Range: 0-".($size-1)."/".$size);
                ob_flush();
                flush();
                // Thay đổi từ thanh toán về hủy => tăng số lượng,trừ tích điểm...
                if($last_status == 5){
                      if($order->status == 2){
                        // kiem tra order neu su dung tich diem thi tru tich diem trong custommer
                            // cong lai tich diem cho no.
                        // Giam so lan mua
                        $customer = Customer::where('phone',$phone)->first();
                        if($customer){
                            $customer->points = $customer->points - $order->total;
                            $customer->some_purchases = $customer->some_purchases - 1;
                            $customer->save();
                        }
                        $order_item = OrderItem::where('order_id',$order->id)->get();
                            foreach ($order_item as $key => $value2) {
                                $frame = Frame::find($value2->frame_id);
                                $frame->sku = $frame->sku + $value2->quantity;
                                if($frame->save()){
                                    try {
                                        $mail = System::select('email_send','email_password')->first();
                                        if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
                                            config(['mail.username' => $mail->email_send]);
                                            config(['mail.password' => $mail->email_password]);
                                            config(['mail.port' => "587"]);
                                            config(['mail.host' => "smtp.gmail.com"]);
                                            config(['mail.encryption' => "tls"]);
                                            $data = ['order'=>$order];
                                            if($order->email){
                                                    Mail::send('backend.email.email-bi-huy',$data, function($message) use ($mail,$order){
                                                    $message->from($mail->email_send);
                                                    $message->to($order->email, 'Quản trị')->subject("[".url('')."] Thông báo đơn hàng bị hủy"." #".$order->id);
                                                });
                                            }
                                        }  
                                    }catch (Exception $e) { 
                                        
                                    }
                                }
                            }
                    }
                }
                // Từ bất kì sang đang xử lý
                if($order->status == 3 ){
                    try {
                        $mail = System::select('email_send','email_password')->first();
                        if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
                            config(['mail.username' => $mail->email_send]);
                            config(['mail.password' => $mail->email_password]);
                            config(['mail.port' => "587"]);
                            config(['mail.host' => "smtp.gmail.com"]);
                            config(['mail.encryption' => "tls"]);
                            $data = ['order'=>$order];
                            if($order->email){
                                    Mail::send('backend.email.email-bi-huy',$data, function($message) use ($mail,$order){
                                    $message->from($mail->email_send);
                                    $message->to($order->email, 'Quản trị')->subject("[".url('')."] Thông báo đơn hàng đang xử lý"." #".$order->id);
                                });
                            }
                        }  
                    }catch (Exception $e) { 
                        
                    }
                }
                // Đang giao hàng
                if($order->status == 4 ){
                    try {
                        $mail = System::select('email_send','email_password')->first();
                        if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
                            config(['mail.username' => $mail->email_send]);
                            config(['mail.password' => $mail->email_password]);
                            config(['mail.port' => "587"]);
                            config(['mail.host' => "smtp.gmail.com"]);
                            config(['mail.encryption' => "tls"]);
                            $data = ['order'=>$order];
                            if($order->email){
                                    Mail::send('backend.email.email-bi-huy',$data, function($message) use ($mail,$order){
                                    $message->from($mail->email_send);
                                    $message->to($order->email, 'QTV')->subject("[".url('')."] Thông báo đang giao hàng"." #".$order->id);
                                });
                            }
                        }  
                    }catch (Exception $e) { 
                        
                    }
                }
                // end đang giao hàng
                // đã nhận hàng
                if($order->status == 6 ){
                    try {
                        $mail = System::select('email_send','email_password')->first();
                        if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
                            config(['mail.username' => $mail->email_send]);
                            config(['mail.password' => $mail->email_password]);
                            config(['mail.port' => "587"]);
                            config(['mail.host' => "smtp.gmail.com"]);
                            config(['mail.encryption' => "tls"]);
                            $data = ['order'=>$order];
                            if($order->email){
                                    Mail::send('backend.email.email-bi-huy',$data, function($message) use ($mail,$order){
                                    $message->from($mail->email_send);
                                    $message->to($order->email, 'QTV')->subject("[".url('')."] Thông báo đã nhận hàng"." #".$order->id);
                                });
                            }
                        }  
                    }catch (Exception $e) { 
                        
                    }
                }
                // end đã nhận hàng
                // neu thanh toan
                if($order->status == 5 && $last_status != 5){
                    // tao custommer neu chua co
                    // kiem tra order neu su dung tich diem thi tru tich diem trong custommer
                        // Trong order them truong co su dung tich diem hay khong
                        // % giam gia tich diem tai thoi diem hien tai
                    // Cong tich diem vao custommer
                    if($phone){
                         $customer = Customer::where('phone',$phone)->first();
                        if(!$customer){
                            $c = new Customer;
                            $c->phone = $phone;
                            $c->points = $order->total;
                            $c->some_purchases = 1;
                            $c->save();  

                        }else{
                            $customer->points = $customer->points + $order->total;
                            $customer->some_purchases = $customer->some_purchases + 1;
                            $customer->save();
                        }
                    }
                    $order_item = OrderItem::where('order_id',$order->id)->get();
                        foreach ($order_item as $key => $value) {
                            $frame = Frame::find($value->frame_id);
                            $product = Product::find($value->product_id);
                            $email_hethang = Email_General::where('name','Config Hết Hàng')->first();
                            if($value->frame_id > 0){
                                $frame = Frame::find($value->frame_id);
                                $frame->sku = $frame->sku - $value->quantity;
                                if($frame->save()){
                                    if($frame->sku <= $email_hethang->config_sku){
                                        
                                       try {
                                            $mail = System::select('email_send','email_password')->first();
                                            if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
                                                config(['mail.username' => $mail->email_send]);
                                                config(['mail.password' => $mail->email_password]);
                                                config(['mail.port' => "587"]);
                                                config(['mail.host' => "smtp.gmail.com"]);
                                                config(['mail.encryption' => "tls"]);
                                                $data = ['frame' => $frame,'product'=>$product,'email_hethang'=>$email_hethang];
                                                if($email_hethang){
                                                        Mail::send('backend.email.het-hang',$data, function($message) use ($mail,$email_hethang,$frame){
                                                        $message->from($mail->email_send);
                                                        $message->to($email_hethang->email, 'Admin')->subject("[".url('')."] Sắp hết sản phẩm ".$frame->name." ".$frame->code_frame);
                                                    });
                                                }
                                            }  
                                        }catch (Exception $e) { 
                                        }
                                    }
                                }
                            }
                    }
                    try {
                        $mail = System::select('email_send','email_password')->first();
                        if ( !empty($mail->email_send) && !empty($mail->email_password) ) {
                            config(['mail.username' => $mail->email_send]);
                            config(['mail.password' => $mail->email_password]);
                            config(['mail.port' => "587"]);
                            config(['mail.host' => "smtp.gmail.com"]);
                            config(['mail.encryption' => "tls"]);
                            $data = ['order'=>$order];
                            if($order->email){
                                    Mail::send('backend.email.email-bi-huy',$data, function($message) use ($mail,$order){
                                    $message->from($mail->email_send);
                                    $message->to($order->email, 'QTV')->subject("[".url('')."] Xác nhận thanh toán đơn hàng"." #".$order->id);
                                });
                            }
                        }  
                    }catch (Exception $e) {

                    }
                }
            }
        }   
    }

    public function postOrderSearchadd(Request $req){
        $name = $req->key;
        // find product like $name = nsme
        $products  = Frame::where('id',$name)->orWhere('name','like',"%$name%")->orWhere('code_frame','like',"%$name%")->limit(15)->get();
        $html_search = view('backend.orders.ajax-list-search',['product'=>$products]);
        return json_encode(array('status'=>true,'product'=>$products,'html_search'=>$html_search.''));
    }
    public function postOrderSearchCustommer(Request $req){
        $phone = $req->phone;
        // find product like $name = nsme
        if($phone){
            $order = Order::where('phone',"like","%$phone%")->groupby('fullname')->where('status',">",1)->get();
            $html_customer = view('backend.orders.ajax-list-customer',['order'=>$order]);
            return json_encode(array('status'=>true,'html_customer'=>$html_customer.''));
        }else{
            $html_customer = view('backend.orders.ajax-list-customer',['order'=>array()]);
            return json_encode(array('status'=>false,'html_customer'=>$html_customer.''));
        }
        
    }
    
   public function postOrderCheckadd(Request $req){
        $id = $req->id;
        $product = Frame::find($id);
            if(sizeof($product)){
              $html_check = view('backend.orders.ajax-list-chon',['product'=>$product]);  
               return json_encode(array('status'=>true,'product'=>$product,'html_check'=>$html_check.''));
            }else{
                    return json_encode(array('status'=>false));
            } 
    }
    public function getHistory(Request $req){
        $id = $req->id;
        $order = Order::find($id);
        if($order){
            $logs = OrderLogs::leftjoin('admins','admins.id','=','order_logs.user_id')->select('order_logs.*','admins.username')->where('order_logs.order_id',$order->id)->orderby('order_logs.created_at','desc')->get();
            $view = View('backend.orders.ajax-logs',compact('logs'));
            return json_encode(array('status'=>true,'html'=>$view.'','orderID'=>$order->id));
            
        } 
        return json_encode(array('status'=>false));
    }

  public function FormEmailThanhToan(Request $req){
        $mail_thanhtoan = $req->email_thanhtoan;
        $mail_bihuy = $req->email_bihuy;
        $des_thanhtoan = $req->description_thanhtoan;
        $des_bihuy = $req->description_bihuy;
        $cont_thanhtoan = $req->content_thanhtoan;
        $cont_bihuy = $req->content_bihuy;
        $config_thanhtoan = Email_General::where('name','Config Email Thanh Toán')->first();
        $config_bihuy = Email_General::where('name','Config Email Bị Hủy')->first();
        if(!$config_thanhtoan){
            $e_thanhtoan = new Email_General;
            $e_thanhtoan->name = 'Config Email Thanh Toán';
            $e_thanhtoan->description = $des_thanhtoan;
            $e_thanhtoan->content = $cont_thanhtoan;
            $e_thanhtoan->save();
            
        }else{
            $config_thanhtoan->description = $des_thanhtoan;
            $config_thanhtoan->content = $cont_thanhtoan;
            $config_thanhtoan->save();
            
        }
        if(!$config_bihuy){
            $e_bihuy = new Email_General;
            $e_bihuy->name = 'Config Email Bị Hủy';
            $e_bihuy->description = $des_bihuy;
            $e_bihuy->content = $cont_bihuy;
            $e_bihuy->save();
            
        }else{
            $config_bihuy->description = $des_bihuy;
            $config_bihuy->content = $cont_bihuy;
            $config_bihuy->save();
            
        }
        echo "true";
    }
    public function configTask(Request $req){
        $config_time = (int)$req->config_time;
        $email_order_recv = $req->email_order_recv;
        if($email_order_recv){
            $email_rev = Email_General::where('name','Email Nhận đơn hàng')->first();
            if($email_rev){
                // cập nhập
                $email_rev->email = $email_order_recv;
                $email_rev->save();
            }else{
                // Tạo mới
                $email_rev = new Email_General;
                $email_rev->email = $email_order_recv;
                $email_rev->name = 'Email Nhận đơn hàng';
                $email_rev->save();
            }
        }
        if($config_time > 0 ){
            $item = Item::where('key_item','config_time_order_destroy')->first();
            if($item){
                $item->value = $config_time;
                $item->save();
                return json_encode(array('status'=>true,'time'=>$config_time,'message'=>"Sau $config_time giờ đơn hàng sẽ tự động hủy nếu không thanh toán"));
            }else{
                $item = new Item;
                $item->key_item = 'config_time_order_destroy';
                $item->value = $config_time;
                $item->save();
                return json_encode(array('status'=>true,'time'=>$config_time,'message'=>"Sau $config_time giờ đơn hàng sẽ tự động hủy nếu không thanh toán"));
            }
        }else{
            $item = Item::where('key_item','config_time_order_destroy')->delete();
            return json_encode(array('status'=>true,'time'=>$config_time,'message'=>"Không sử dụng chức năng tự động cập nhập tình trạng đơn hạng"));
        }
        
    }
    public function ajaxProvince(Request $req){
        $id = $req->id;
        $province = Province::find($id);
        if($province){
            $district = District::where('provinceid',$province->id)->orderby('name','asc')->get();
            $html = view('backend.orders.ajax-province',['district'=>$district]);
            return json_encode(array('status'=>true,'html'=>$html.""));
        } 
    }

}
