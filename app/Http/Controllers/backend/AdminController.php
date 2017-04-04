<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admins;
use App\System;
use App\Http\Requests\EditorRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use DB;
class AdminController extends Controller
{
    public function index(){
        $temp = session('admin');
        $admin = Admins::find($temp->id);
    	return view('backend.admins.index', compact('admin'));

    }
    public function indexsystem(){
        $temp = session('admin');
        $admin = Admins::find($temp->id);
        return view('backend.admins.system-index', compact('admin'));
    }

    public function updatecanhan(Request $req){
        // Lưu thong tin he thong
         $id = session('admin')['id'];
         $admin = Admins::find($id);
         if($req->password){
            $admin->password= MD5($req->password);
         }
         
         $admin->phone= $req->phone;
         $admin->address= $req->address;
         $admin->email=$req->email;
         if ($req->hasFile('fimg')) {
             $file = Input::file('fimg');
             $namefimg = time()."-".$file->getClientOriginalName();
             $file->move(public_path().'/assets/product/',$namefimg);
             $admin->image = '/assets/product/'.$namefimg;
         }
          if($admin->save()){
            return redirect()->route('admin.edit')->with('success', 'Thông tin bạn thay đổi thành công');
        }
    }

    public function update(Request $req){
        $id = session('admin')['id'];
         $admin = Admins::find($id);
         if ($admin->id == 1 || $admin->id == 2) {
            $system = System::first();
            if(!$system){
                $system = new System;
            }  
            
          
            $system->full_name = $req->full_name;   
            $system->domain = $req->domain;   
            
            $system->email = $req->s_email;   
            
            
            $system->phone = $req->s_phone;  
            
            
            $system->address = $req->s_address; 
            
            
            $system->email_send = $req->email_send;
            
            
            $system->email_password = $req->EMpassword;
           
            $system->email_form = $req->email_form; 
           
            $system->email_order = $req->email_order;
            
            $system->email_hethang = $req->email_hethang;
            
             
            
             
             
             if ($req->hasFile('img')) {
                 $file = Input::file('img');
                 $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
                 $file->move(public_path().'/assets/product/', $nameimg); 
                 $system->img_logo = '/assets/product/'. $nameimg;
             }
             $system->save();
         }
         if($admin->save()){
         	return redirect()->route('admin.system.edit')->with('success', 'Thông tin bạn thay đổi thành công');
         }
    }

    
    public function editor(){
        return view('backend.editors.add');
    }

    public function addEditor(EditorRequest $req){
        $editor = new Admins;
       // dd($req->all());
        $editor->username = $req->username;
        $editor->password = MD5($req->password);
        $editor->phone    = $req->phone;
        $editor->address  = $req->address;
        $editor->email    = $req->email;
        $editor->level = 2;
        $editor->status = 1;
        $editor->save();
        return redirect()->route('editor.user.add',['id'=>$editor->id])->with('success', 'Phân quyền cho thành viên mới');
    }

    public function get_edit_editor($id){ 
        $admin = Admins::find($id);
        return view('backend.editors.edit',['admin'=>$admin]);
    }

    public function post_edit_editor(Request $req,$id){

        $admin = Admins::find($id);
        if($req->has('password')){
            $this->validate($req, [
                 'password' =>'same:confirm_pass'
                ], [
                  'password.same' =>'Mật khẩu bạn nhập không khớp',
                ]);

                if($req->password){
                    $admin->password = MD5($req->password);
                    $admin->save();
                    return redirect()->route('editor.list')->with('success', 'Đổi Mật Khẩu thành công cho thành viên '.$admin['username']);
                }      
         }
        return redirect()->route('editor.list');
         
    }

    public function add_permission_user($id){
        // dev
        //> 2 || =2 id ss = dev
        if( $id==1 || session('admin')->id==$id){
         return redirect()->route('admin.home');
        }
        $editor= Admins::find($id);
        if (sizeof($editor)) {
            if ( $id > 2 ) {
                return view('backend.editors.add-permission-editor',compact('editor'));
            }
            return view('backend.editors.add-permission-admin', compact('editor'));
        }
        return redirect()->route('admin.home');
    }
     public function add_permission_admin(){
        // dev
        //> 2 || =2 id ss = dev
        $idadmin= Admins::where('id','>', 1)->first();
        if(!$idadmin){
            return redirect()->route('admin.home');
        }
        $id = $idadmin->id;
        if( $id==1 || session('admin')->id==$id){
         return redirect()->route('admin.home');
        }
        $editor= Admins::find($id);
        if (sizeof($editor)) {
            if ( $id > 2 ) {
                return view('backend.editors.add-permission-editor',compact('editor'));
            }
            return view('backend.editors.add-permission-admin', compact('editor'));
        }
        return redirect()->route('admin.home');
    }
    public function add_permission_user_post(Request $req){
        $editor = Admins::find($req->id);
        if ($editor->id == 2) {
            $list_id = $req['post']['id'];
            if($list_id == null) {
                $list_id = array();
            }
            $delete_arr = array();
            $danh_sach_per = DB::table('permissions')->get();
            foreach ($danh_sach_per as $key => $per) {
               if(!in_array($per->id, $list_id )){
                    array_push($delete_arr, $per->id);
               }
            }
            $check = DB::table('permission_admin')->wherein('permission_id',$delete_arr)->delete();
            $editor->savePermission($req->post);
            return redirect()->back()->with('success', ' Phân quyền thành công cho thanh viên'.$editor->name);
        }
        if ($editor->id > 2) {
            $editor->savePermission($req->post);
         return redirect()->route('editor.list')->with('success', ' Phân quyền thành công cho thanh viên'.$editor->name);
        }
       
    }

    public function listEditor(){
        $editors = Admins::where('level',  2)->get();
       // dd($editors);
        return view('backend.editors.list', compact('editors'));
    }   
    public function delEditor(Request $req){
        $editor= Admins::findOrFail($req->id);
        $editor->delete();
        echo 'true';
    }


    public function permission_list(){
        return view('backend.admins.permission');
    }
}
