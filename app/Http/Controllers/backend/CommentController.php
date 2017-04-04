<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use App\TagP;
use App\Tag_post;
use App\Tag_Product;
use App\ProductInCategory;
use App\Post_category;
use App\CommentProduct;
use App\CommentFrame;
use App\CommentPost;
use App\Product;
use App\Frame;
use App\Post;


class CommentController extends Controller
{   
    
    public function listCommentProduct(){
        $stt =1;
        return view('backend.comment.list-product',compact('stt'));
    }

    public function searchCommentProduct(Request $req){
        $c = $req->cm;
        $comments = CommentFrame::select('comment_frames.*','accounts.username','frames.name')->leftJoin('accounts', 'comment_frames.account_id', '=', 'accounts.id')->where(function($query) use ($c){
         $query->where('accounts.username','like',"%$c%")->orwhere('frames.name','like',"%$c%");   
        })
        ->where('comment_frames.status',0)->leftJoin('frames', 'frames.id', '=', 'comment_frames.frame_id')->orderby('created_at','asc')->paginate(10); 
        $stt=0;
        return view('backend.comment.list-product',compact('comments','stt'));
    }

    public function listCommentProductDone(){
        $stt=1;
        return view('backend.comment.list-product-done',compact('stt'));
    }

    public function searchCommentProductdone(Request $req){
        $c = $req->cm;
        $comments = CommentFrame::select('comment_frames.*','accounts.username','frames.name')->leftJoin('accounts', 'comment_frames.account_id', '=', 'accounts.id')->where(function($query) use ($c){
         $query->where('accounts.username','like',"%$c%")->orwhere('frames.name','like',"%$c%");   
        })
        ->where('comment_frames.status',1)->leftJoin('frames', 'frames.id', '=', 'comment_frames.frame_id')->orderby('created_at','asc')->paginate(10); 
        $stt=0;
        return view('backend.comment.list-product-done',compact('comments','stt'));
    }
    public function deleteCommentProduct(Request $req){
        $comment = CommentFrame::find($req->id);
        if($comment){
            $product = Frame::find($comment->frame_id);
            if($product){
                if($comment->status ==1){
                    $rating  = floatval($comment->rating); // $rating of comment
                    if($rating > 5 ) $rating = 5;
                    if($rating < 0 ) $rating = 0;

                    $all_rating = $product->rating;
                    $number_rate = $product->number_rate;
                    
                    

                    if( $number_rate - 1 <= 0) {
                        $product->number_rate = 0;
                        $product->rating = 0;
                    }else{
                        $new_rating = ( $all_rating * $number_rate - $rating )/ ( $number_rate - 1 );
                        if($new_rating < 0) $new_rating = 0;
                        if($new_rating > 5) $new_rating = 5;
                        $product->rating = $new_rating;
                        $product->number_rate = $number_rate - 1;
                    }
                    $product->save();
                }   
            }

            $comment->delete();
            return json_encode(array('status'=>true,'message'=>"Xóa thành công"));
        }else{
            return json_encode(array('status'=>false,'message'=>"Bình luận không tồn tại"));
        }
    }
    public function acceptCommentProduct(Request $req){
        $comment = CommentFrame::find($req->id);
        if($comment){
            $product = Frame::find($comment->frame_id);
            if($product){
                if($comment->status ==0){
                    $comment->status = 1;
                    $comment->save();
                    $rating  = floatval($comment->rating);
                    if($rating > 5 ) $rating = 5;
                    if($rating < 0 ) $rating = 0;

                    $all_rating = $product->rating;
                    $number_rate = $product->number_rate;
                    
                    $new_rating = ( $all_rating * $number_rate + $rating )/ ( $number_rate + 1 );
                    $product->rating = $new_rating;
                    $product->number_rate = $number_rate + 1;
                    $product->save();
                    return json_encode(array('status'=>true,'message'=>"Lưu thành công"));   
                }
                return json_encode(array('status'=>false,'message'=>"Đã lưu rồi"));   
            }else{
                $comment->delete();
                return json_encode(array('status'=>false,'message'=>"Không tồn tại sản phẩm"));
            }
        }else{
            return json_encode(array('status'=>false,'message'=>"Bình luận không tồn tại"));
        }
    }


    public function listCommentPost(){
        return view('backend.comment.list-post');
    }
    public function listCommentPostDone(){
        return view('backend.comment.list-post-done');
    }
    public function deleteCommentPost(Request $req){
        $comment = CommentPost::find($req->id);
        if($comment){
            $post = Post::find($comment->post_id);
            if($post){
                if($comment->status == 1){
                    
                    $rating  = floatval($comment->rating);
                    if($rating > 5 ) $rating = 5;
                    if($rating < 0 ) $rating = 0;

                    $all_rating = $post->rating;
                    $number_rate = $post->number_rate;
                    
                    if( $number_rate - 1 <= 0) {
                        $post->number_rate = 0;
                        $post->rating = 0;
                    }else{
                        // nếu số lượng comment > 0
                        // chia lại
                        $new_rating = ( $all_rating * $number_rate - $rating )/ ( $number_rate - 1 );
                        if($new_rating < 0) $new_rating = 0;
                        if($new_rating > 5) $new_rating = 5;
                        $post->rating = $new_rating;
                        $post->number_rate = $number_rate - 1;
                    }
                    $post->save();
                } 
            }
            $comment->delete();
            return json_encode(array('status'=>true,'message'=>"Xóa thành công"));
        }else{
            return json_encode(array('status'=>false,'message'=>"Bình luận không tồn tại"));
        }
    }
    public function acceptCommentPost(Request $req){
        $comment = CommentPost::find($req->id);
        if($comment){
            $post = Post::find($comment->post_id);
            if($post){
                if($comment->status ==0){
                    $comment->status = 1;
                    $comment->save();
                    $rating  = floatval($comment->rating);
                    if($rating > 5 ) $rating = 5;
                    if($rating < 0 ) $rating = 0;

                    $all_rating = $post->rating;
                    $number_rate = $post->number_rate;
                    
                    $new_rating = ( $all_rating * $number_rate + $rating )/ ( $number_rate + 1 );
                    $post->rating = $new_rating;
                    $post->number_rate = $number_rate + 1;
                    $post->save();
                    return json_encode(array('status'=>true,'message'=>"Lưu thành công"));   
                }
                return json_encode(array('status'=>false,'message'=>"Đã lưu rồi"));   
            }else{
                $comment->delete();
                return json_encode(array('status'=>false,'message'=>"Không tồn tại sản phẩm"));
            }
        }else{
            return json_encode(array('status'=>false,'message'=>"Bình luận không tồn tại"));
        }
    }
    
}
