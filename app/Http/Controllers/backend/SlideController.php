<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Slide;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use DB;
use Redirect;
use App\SlideType;

class SlideController extends Controller
{
    public function index( $id = null)
	{
		if($id == null) return redirect()->route('/admin.home');
		$slide = DB::table('slide_types')->where('id',$id)->first();
		if($slide){
			$img_slide = DB::table('slides')->where('type',$slide->name)->orderby('updated_at','desc')->get();
			$data['slide'] = $slide;
			$data['slide_list'] = $img_slide;
			
			return view('backend.slides.list',$data);
		}else{
			 return redirect()->route('admin.home');
		}
		
	}
	public function addImg($id = null){
		if($id == null) return redirect()->route('admin.home');
		$slide = DB::table('slide_types')->where('id',$id)->first();
		
		if($slide){
			$data['slide'] = $slide;
			return view('backend.slides.add',$data);
		}else{
			 return redirect()->route('admin.home');
		}	
	}
	public function formAdd(Request $req){
		$s_id = $req->s_id;
		$slide_type = $req->slide_type;

		$text_1 = "";
		$text_2 = "";
		$text_3 = "";
		$text_4 = "";
		$des_1 = "";
		$des_2 = "";
		$link_1 = "";
		$link_2 = "";

		if( $req->text_1 ){
			$text_1 = $req->text_1;
		}
		if( $req->text_2 ){
			$text_2 = $req->text_2;
		}
		if( $req->text_3 ){
			$text_3 = $req->text_3;
		}
		if( $req->text_4 ){
			$text_4 = $req->text_4;
		}
		
		if( $req->des_1 ){
			$des_1 = $req->des_1;
		}
		if( $req->des_2 ){
			$des_2 = $req->des_2;
		}
		
		if( $req->link_1 ){
			$link_1 = $req->link_1;
		}
		if( $req->link_2 ){
			$link_2 = $req->link_2;
		}
		$slide_status = 0;
		$s = new Slide;
		$s->type = $slide_type;
		$s->text_1 = $text_1;
		$s->text_2 = $text_2;
		$s->text_3 = $text_3;
		$s->text_4 = $text_4;
		$s->des_1 = $des_1;
		$s->des_2 = $des_2;
		$s->link_1 = $link_1;
		$s->link_2 = $link_2;
		if($req->hasFile('img_1')){
            $file = array('image' => Input::file('img_1'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                // return Redirect::to(route('slide.add',['id'=>$s_id]))->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
                return Redirect::to(route('slide.manage',['id'=>$s_id]));
            }else{
                $file = Input::file('img_1');
                $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
				$file->move(public_path().'/assets/slide/', $nameimg); 
                $s->img_1  = '/assets/slide/'.$nameimg;
            }
        }
        if($req->hasFile('img_2')){
            $file = array('image' => Input::file('img_2'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                // return Redirect::to(route('slide.add',['id'=>$s_id]))->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
                return Redirect::to(route('slide.manage',['id'=>$s_id]));
            }else{
                $file = Input::file('img_2');
                $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
				$file->move(public_path().'/assets/slide/', $nameimg); 
                $s->img_2  = '/assets/slide/'.$nameimg;
            }
        }
        if($req->hasFile('img_3')){
            $file = array('image' => Input::file('img_3'));
            $rules = array('image' => 'mimes:jpeg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                // return Redirect::to(route('slide.add',['id'=>$s_id]))->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
                return Redirect::to(route('slide.manage',['id'=>$s_id]));
            }else{
                $file = Input::file('img_3');
                $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
				$file->move(public_path().'/assets/slide/', $nameimg); 
                $s->img_3  = '/assets/slide/'.$nameimg;
            }
        }
		$s->status = $slide_status;
		$s->save();
		 return Redirect::to(route('slide.manage',['id'=>$s_id]));

		// return Redirect::to(route('slide.add',['id'=>$s_id]))->with('success','Thêm ảnh thành công <a style="color:blue" href="'.route('slide.manage',['id'=>$s_id]).'">Quay lại danh sách</a>');
	}
	public function editSlide($type_slide_id = null,$id_slide =null){
		if($type_slide_id == null) return redirect()->route('/admin.home');

		$slide = DB::table('slide_types')->where('id',$type_slide_id)->first();
		if($slide){
			$data['slide'] = $slide;
			$img = DB::table('slides')->where('id',$id_slide)->first();
			if($img == null) return redirect()->route('admin.home');
			$data['img'] = $img;
			return view('backend.slides.edit',$data);
		}else{
			 return redirect()->route('admin.home');
		}	
	}
	public function delSlide(Request $req){
		$id = $req->id;
		DB::table('slides')->where('id',$id)->delete();
		return json_encode(array('status'=>true));
	}
	public function SlideCheck(Request $req){
		$id = $req->id;
		$slide = Slide::Find($id);
		if($slide){
			if($req->pin== true){
					$slide->status  = 1;
			}else{
					$slide->status = 0;
			}
			$slide->save();
		}
		return json_encode(array('status'=>true));
	}
	public function formSave(Request $req){
		$from = $req->from;
		$s_id = $req->s_id;
		$img_id = $req->img_id;
		$text_1 = "";
		$text_2 = "";
		$text_3 = "";
		$text_4 = "";
		$des_1 = "";
		$des_2 = "";
		$link_1 = "";
		$link_2 = "";

		if( $req->text_1 ){
			$text_1 = $req->text_1;
		}
		if( $req->text_2 ){
			$text_2 = $req->text_2;
		}
		if( $req->text_3 ){
			$text_3 = $req->text_3;
		}
		if( $req->text_4 ){
			$text_4 = $req->text_4;
		}
		
		if( $req->des_1 ){
			$des_1 = $req->des_1;
		}
		if( $req->des_2 ){
			$des_2 = $req->des_2;
		}
		
		if( $req->link_1 ){
			$link_1 = $req->link_1;
		}
		if( $req->link_2 ){
			$link_2 = $req->link_2;
		}
		
		$s = Slide::Find($img_id);
		if($s){
			$s->text_1 = $text_1;
			$s->text_2 = $text_2;
			$s->text_3 = $text_3;
			$s->text_4 = $text_4;
			$s->des_1 = $des_1;
			$s->des_2 = $des_2;
			$s->link_1 = $link_1;
			$s->link_2 = $link_2;
			
			
			
			if($req->hasFile('img_1')){
	            $file = array('image' => Input::file('img_1'));
	            $rules = array('image' => 'mimes:jpeg,bmp,png');
	            $validator = Validator::make($file, $rules);
	            if ($validator->fails()) {
	                // send back to the page with the input data and errors
	                // return Redirect::to(route('slide.add',['id'=>$s_id]))->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
	                return Redirect::to(route('slide.manage',['id'=>$s_id]));
	            }else{
	                $file = Input::file('img_1');
	                $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
					$file->move(public_path().'/assets/slide/', $nameimg); 
	                $s->img_1  = '/assets/slide/'.$nameimg;
	            }
	        }
	        if($req->hasFile('img_2')){
	            $file = array('image' => Input::file('img_2'));
	            $rules = array('image' => 'mimes:jpeg,bmp,png');
	            $validator = Validator::make($file, $rules);
	            if ($validator->fails()) {
	                // send back to the page with the input data and errors
	                // return Redirect::to(route('slide.add',['id'=>$s_id]))->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
	                return Redirect::to(route('slide.manage',['id'=>$s_id]));
	            }else{
	                $file = Input::file('img_2');
	                $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
					$file->move(public_path().'/assets/slide/', $nameimg); 
	                $s->img_2  = '/assets/slide/'.$nameimg;
	            }
	        }
	        if($req->hasFile('img_3')){
	            $file = array('image' => Input::file('img_3'));
	            $rules = array('image' => 'mimes:jpeg,bmp,png');
	            $validator = Validator::make($file, $rules);
	            if ($validator->fails()) {
	                // send back to the page with the input data and errors
	                // return Redirect::to(route('slide.add',['id'=>$s_id]))->with(['error'=>'Ảnh tải lên chưa đúng định dạng']);
	                return Redirect::to(route('slide.manage',['id'=>$s_id]));
	            }else{
	                $file = Input::file('img_3');
	                $nameimg  =  uniqid().'-'.date('d-m-Y').'.'.$file->getClientOriginalName(); 
					$file->move(public_path().'/assets/slide/', $nameimg); 
	                $s->img_3  = '/assets/slide/'.$nameimg;
	            }
	        } 
	        $s->save();
	        return Redirect::to(route('slide.manage',['id'=>$s_id]));


			// return Redirect::to(route('slide.edit',['slide_type_id'=>$s_id,'slide_id'=>$img_id]))->with('success','Chỉnh sửa thành công <a style="color:blue" href="'.route('slide.manage',['id'=>$s_id]).'">Quay lại danh sách</a>');
		}

		 return redirect()->route('admin.home');
		
	}
	
	
}
