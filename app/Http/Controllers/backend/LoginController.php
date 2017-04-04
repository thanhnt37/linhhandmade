<?php namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Redirect;

use App\Admins;


class LoginController extends Controller {

   
    public function getLogin()
    {
        if(session('admin')){
            return Redirect::to('/quan-tri');
        }else{
            return view('backend.login');
        }
    }
    public function postLogin( Request $req)
    {
        if(session('admin')){
            return Redirect::to('/quan-tri');
        }else{
            $username = $req->username;
            $password = $req->password;
            $admin = Admins::where('username',$username)->where('password',md5($password))->where('status',1)->first();
            if($admin){
                Session::put('admin', $admin);
                return Redirect::to(route('admin.home'));
            }
            return Redirect::to(route('quan-tri/dang-nhap'))->with(['error'=>'Đăng nhập thất bại']);
        }
    }
    public function getLogout()
    {
        Session::flush();
        return Redirect::to(route('quan-tri/dang-nhap'))->with(['info'=>'Bạn vừa đăng xuất, để sử dụng lại hệ thống vui lòng đăng nhập lại']);
    }

}