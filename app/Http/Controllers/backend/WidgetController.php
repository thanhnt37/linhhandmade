<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GroupLayout;
use App\Layout;
use App\Item;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WidgetController extends Controller
{
	// Chi tiết về layout group
	public function index($id = null){
		$layout_group = GroupLayout::Find($id);
		if($layout_group){
			return view('backend.widget.list',compact('layout_group'));
		}
		else{
			return redirect()->route('admin.home');
		}
	}
    public function update(Request $req){
         $inputs = $req->all();
        // dd($req->post_des);
         $rules = array('image' => 'mimes:jpeg,bmp,png');
         $validator = Validator::make($inputs, $rules);
         if($validator->fails()){
                    return;
        }
        else{
            if($req->has('post_des')){
                  foreach ($req->post_des as $key => $value) {
                       $item = Item::find($value['id']);
                       $item->value= trim($value['value']);
                       $item->link = $value['link'];
                       $item->save();       
                  
                  }  
            }
            if($req->has('layout_img')){
                foreach ($req->layout_img as $key => $value) {
                  $item = Item::find($value['id']);
                  if($value['value'] ==null){
                      $item->link = $value['link'];      
                  }
                  else{
                     //dd($value['value']);
                      $item->value = '/assets/post/'.$value['value']->getClientOriginalName();
                      $value['value']->move(public_path().'/assets/post/', $value['value']->getClientOriginalName());
                      $item->link = $value['link'];
                      
                  }
                  $item->save();
               }
            }
          echo 'true';
        }
        
       
      
        //
       // 

    }	
    public function deletelayoutItem(Request $req){
      $id  =  $req->id;
      $item_layout = Item::find($id);
      if($item_layout){
        $list  = Item::where('key_layout',$item_layout->key_layout)->get();
        if(sizeof($list) == 1){
          Layout::where('key',$item_layout->key_layout)->delete();
          $item_layout->delete();
        }else{
          $item_layout->delete();
        }
        return json_encode(array('status'=>true,'id'=>$id));
      }
      return json_encode(array('status'=>false,'id'=>$id));
    }
	// Chi tiết về layout trong layoutgroup
    public function config($id = null){
        $layout = Layout::Find($id);
        if($layout){
            if($layout->type == "Hỗn hợp"){
                return view('backend.widget.layout',compact('layout'));
            }
            return view('backend.widget.layout-list',compact('layout'));     
        }
        else{
            return redirect()->route('admin.home');
        }
    }   
    public function edit($id =null){
        $item = Item::Find($id);
        if($item){
            return view('backend.widget.edit',compact('item'));
        }
        else{
            return redirect()->route('admin.home');
        }
    }
    public function formedit(Request $req){
        $item = Item::Find($req->id);
        if($item){
             if($item->type == 'img'){
                if($req->hasFile('img')){
                    $file = array('image' => Input::file('img'));
                    $rules = array('image' => 'mimes:jpeg,bmp,png');
                    $validator = Validator::make($file, $rules);
                    if ($validator->fails()) {
                        
                    }else{
                        $file = Input::file('img');
                        $file->move(public_path().'/assets/post/', $file->getClientOriginalName());
                        $item->value = '/assets/post/'.$file->getClientOriginalName();
                    }
                }
                $item->link = $req->link;
                $item->save();
             }
             if($item->type != 'img'){
                $item->value = $req->value;
                $item->link = $req->link;
                $item->save();
             }
             return  redirect()->route('layout.edit.partern',['id'=>$req->id]);
        }
        else{
            return redirect()->route('admin.home');
        }
    }
}
