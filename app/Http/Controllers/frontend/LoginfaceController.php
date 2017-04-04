<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FL_uer;
use Session;
use Facebook\Facebook as Facebook;
use Redirect;
use App\Account;


class LoginfaceController extends Controller
{
	public function __construct(){
      session_start();
  }
  public function DangNhapFaceBook(Request $req){
        $cur_url = $req->cur_url;
        $fb_app = array(
          'app_id' => '144776109355034',
          'app_secret' => 'd7c5ac090674e3dd2fd6f5658152ca82',
          'default_graph_version' => 'v2.8',
        );
        $fb = new Facebook($fb_app);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl(url('/facebook/callback')."?cur_url=".$cur_url,$permissions);
        // dd($loginUrl);
        return Redirect::to($loginUrl);
  }
  public function DangNhapFaceBookCallBack(Request $req){
        $cur_url = $req->cur_url;
         $fb_app = array(
                'app_id' => '144776109355034',
                'app_secret' => 'd7c5ac090674e3dd2fd6f5658152ca82',
                'default_graph_version' => 'v2.8',
        );
        
        $fb = new Facebook($fb_app);
        $helper = $fb->getRedirectLoginHelper();

        try{
            $accessToken = $helper->getAccessToken();
            $response = $fb->get('/me?fields=id,name,gender,email,picture',$accessToken);

        }catch(Facebook\Exceptions\FacebookSDKException $e){
            // Nếu lỗi trả về tin nhắn. Dừng màn hình trắng.
            echo $e->getMessage();
            Redirect::to('/');
            // echo "Đăng nhập không thành công";
        }
        if (isset($accessToken)) {

            session()->put('facebook_access_token', $accessToken); // Tạo session token facebook.
           
            $graphNode = $response->getGraphNode(); // Lấy thông tin user facebook.
            
            // Get Info $graphNode->getField('id')
            $id_fb   = $graphNode->getField('id');
            // dd($graphNode->getField('picture')->getField('url'));
             $acc = Account::where('phone',$id_fb)->where('status',1)->first();
            if (!$acc ) {
              $ac = new Account;
              $ac->phone =  $graphNode->getField('id');
              $ac->name = $graphNode->getField('name');
              $ac->img =  $graphNode->getField('picture')->getField('url');
              $ac->save();
            }
            $acc = Account::where('phone',$id_fb)->where('status',1)->first();
            $user = Session::get('face');
            if ($user) {
               Session::set('face',$acc);
             }else{
              Session::put('face',$acc);
             }
            return redirect($cur_url);
        }else{
            return redirect($cur_url);
        }   
  }
}
