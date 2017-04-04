<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
  {
    return view('backend.menus.list');
  }
  public function create()
  {
    return view('backend.menus.add');
  }
  public function store(Request $req){
         $menu = new Menu;
         //dd($req->all());
     if($req->hasFile('img')){
            $file = array('image' => Input::file('img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
              if ($validator->fails()) {
                  // send back to the page with the input data and errors
                  return Redirect::to('menu.add')->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
              }else{
                 
                   $file = Input::file('img');
                   $file->move(public_path('/assets/menu/'), $file->getClientOriginalName());
                   $menu->img = '/assets/menu/'.$file->getClientOriginalName();
               }   
           }
          $menu->name = $req->name;
          if($req->link !=''){
              $menu->link = $req->link;
          }
          if($req->has('link_danh_muc')){
            $menu->link = $req->link_danh_muc;
          }
          if($req->has('link_san_pham')){
            $menu->link = $req->link_san_pham;
          }
          $menu->parent_id = $req->parent;
          $menu->order = 0;
          $menu->status= 1;
          if($menu->save()){
             return redirect()->route('menu.add')->with('success','Tạo menu thành công');
          }
          
      
  }
  public function edit_menu($id){
        $menu = Menu::find($id);
        
       return view('backend.menus.edit-menu',compact('menu'));
  }
  public function post_edit_menu(Request $req){
    $menu = Menu::find($req->id);
    if($req->hasFile('img')){
            $file = array('image' => Input::file('img'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
              if ($validator->fails()) {
                  // send back to the page with the input data and errors
                  return Redirect::to('menu.add')->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
              }else{
                 
                   $file = Input::file('img');
                   $file->move(public_path('/assets/menu/'), $file->getClientOriginalName());
                   $menu->img = '/assets/menu/'.$file->getClientOriginalName();
               }   
           }
          $menu->name = $req->name;

          if($req->order){
            $menu->order = $req->order;
          }
          if($req->link !=''){
            $menu->link = $req->link;
          }
          if($req->has('link_danh_muc')){
            $menu->link = $req->link_danh_muc;
          }
          if($req->has('link_san_pham')){
            $menu->link = $req->link_san_pham;
          }
          $menu->parent_id = $req->parent;
          if($menu->save()){
             return redirect()->route('menu.edit',['id'=>$menu->id])->with('success','Sửa menu thành công');
          }

  }
  public function del_menu(Request $req){
         
         $menu = Menu::find($req->id);
         
         if($menu->subcategory->count()){
          $menu->subcategory()->delete();
         }
         $menu->delete();
         echo 'true';

       
  }
  public function ordermenu(Request $req){
      $arr =  $req->arr;
      foreach($arr as $key => $value) {
        # code...
          $menu = Menu::find($value);
          if( sizeof($menu) ){
            $menu->order = $key + 1;
            $menu->save();
          }
      }
     
       return json_encode(array('status'=>true));
  } 
  // public function Sapxep(Request $req){
    
  //    $relation=Input::get('datastring');
  //    dd(json_decode($relation));
  // }
}
