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

use App\Account;
use App\CommentPost;
use App\CommentProduct;

class ApiController extends Controller
{
  	public function sendCommentPost(Request $req){


      $comment = new CommentPost;
      if( $req->account_id ) { $comment->account_id = $req->account_id; $comment->is_guest = 0;}
      else {$comment->account_id = 0; $comment->is_guest = 1;}; 
      $req->post_id ? $comment->post_id = $req->post_id :  $comment->post_id = 0;
      $req->comment ? $comment->comment = $req->comment :  $comment->comment = "No comment";
      $req->rating ? $comment->rating = $req->rating :  $comment->rating = 1;
      $req->parent_id ? $comment->parent_id = $req->parent_id :  $comment->parent_id = 0;
      $comment->comment_admin = "";
      $comment->status = 1 ;
      $comment->save();
      return json_encode(array('status'=>'ok','data'=>$comment));


    }
    public function sendCommentProduct(Request $req){

      $name = $req->name;
      $phone = $req->phone;
      $email = $req->email;

      $acc_id = 0;
      if($req->phone){
        $acc = Account::firstOrNew(['phone'=>$req->phone]);
        if($req->email && $acc->email){
          $acc->email = $req->email; 
        }
        if($req->name && $acc->name){
          $acc->name = $req->name; 
        }
        $acc->save();
        $acc_id = $acc->id;
      }
    

      $comment = new CommentProduct;
      if( $acc_id ) { $comment->account_id = $acc_id; $comment->is_guest = 0;}
      else {$comment->account_id = 0; $comment->is_guest = 1;}; 
      
      $req->product_id ? $comment->product_id = $req->product_id :  $comment->product_id = 0;
      $req->comment ? $comment->comment = $req->comment :  $comment->comment = "No comment";
      $req->rating ? $comment->rating = $req->rating :  $comment->rating = 1;
      $req->parent_id ? $comment->parent_id = $req->parent_id :  $comment->parent_id = 0;
      
      $comment->comment_admin = "";
      $comment->status = 1 ;
      $comment->save();
      return json_encode(array('status'=>true,'data'=>$comment));
    }
    public function sendCommentProduct2(Request $req){

      

      $comment = new CommentProduct;
      if( $req->account_id ) { $comment->account_id = $req->account_id; $comment->is_guest = 0;}
      else {$comment->account_id = 0; $comment->is_guest = 1;}; 
      
      $req->product_id ? $comment->product_id = $req->product_id :  $comment->product_id = 0;
      $req->comment ? $comment->comment = $req->comment :  $comment->comment = "No comment";
      $req->rating ? $comment->rating = $req->rating :  $comment->rating = 1;
      $req->parent_id ? $comment->parent_id = $req->parent_id :  $comment->parent_id = 0;
      $comment->comment_admin = "";
      $comment->status = 1 ;
      $comment->save();
      return json_encode(array('status'=>true,'data'=>$comment));
    }
    public function addUser(){

    }
}
