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

class UploadController extends Controller
{
	 public function uploadImage(){
      if (!empty($_FILES)) {
     
          // $tempFile = $_FILES['file']['name'];          //3             
          // return $tempFile;
          $file = Input::file('file');
          $nameimg  =  uniqid().'-'.date('d-m-Y').'-'.str_slug($file->getClientOriginalName()).".".$file->getClientOriginalExtension(); 
          $file->move(public_path().'/assets/upload/', $nameimg); 
          return '/assets/upload/'.$nameimg;
           
      }
      return '';
   }
}
