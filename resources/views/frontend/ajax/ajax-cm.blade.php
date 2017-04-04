<div class="t-comment">
	<div>
		<div><img style="border-radius: 4px !important" src="{!! asset('frontend/img/user.png') !!}"/></div>
		<div class="t-comment-p">
			<p>Bình luận</p>
			<input placeholder="Nhập nội dung bình luận ..." type="text" id="d-popup-binhluan" data-id="{!! $frame->id !!}"/>
		</div>
		<div style="clear:both"></div>
	</div>
</div>
@foreach($comments as $comment)
<div class="t-comment2" >
	<div>
		<div><img style="border-radius: 4px !important" srcd="{!! asset($comment->img) !!}" src="{!! asset('frontend/img/user.png') !!}" /></div>
		<div class="t-comment-p2">
			<div>
				<p class="t-name-tl">{{ $comment->name }}<a href="" id="d-comment-dequy" data-id="{!! $comment->id !!}" >Trả lời</a></p>
				<p class="t-noidung-cmt">{{$comment->comment}}</p>
				<span class="t-tg-cmt">{{$comment->created_at}}</span>

				<?php $comment_cap2 = App\CommentFrame::select('comment_frames.*','accounts.name','accounts.img')->leftJoin('accounts','comment_frames.account_id','=','accounts.id')->where('comment_frames.status',1)->where('comment_frames.frame_id',$frame->id)->where('comment_frames.parent_id','=',$comment->id)->orderby('created_at','desc')->paginate(3);?>
				@foreach($comment_cap2 as $item)
					@if($item->parent_id == $comment->id)
						<div class="t-tl-cmt">
							<div class="t-tl-cmt-img"><img style="border-radius: 4px !important" srcd="{!! asset($item->img) !!}" src="{!! asset('frontend/img/user.png') !!}" /></div>
							<div class="t-tl-cmt-p">
								<p class="t-name-tl">{!! $item->name !!}</p>
								<p class="t-noidung-cmt">{{$item->comment}}</p>
								<span class="t-tg-cmt">{{$item->created_at}}</span>
							</div>
							<div style="clear:both"></div>
						</div>
					@endif
				@endforeach
			</div>
			
		</div>
		<div style="clear:both"></div>
	</div>

</div>
	<div id="modal-popup-binhluan2" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
    <div style="">
        <h5>Bình luận</h5>
    </div>
    <div class="t-popup-padding-rp">
        <div class="row" style="margin:0px !important">
            <div class="center-col text-center margin-ten no-margin-top xs-margin-bottom-seven let" style="margin-bottom:0px !important">
            </div>
        </div>
        <div class="row" style="margin:0px !important">
            <div class="center-col">
                <form id="d-submit2" data-id="{!!  $comment->id  !!}">
                    <!-- input  -->
                    <textarea id="d-comment" name="comment" class="t-ip-form1 tan-textarea-binhluan" placeholder="Nhập nội dung..."></textarea>
                    <div class="tan-themicon">
						<input type="file" style="display:none" name="comment_img"  id="file_img_preview">
                        <input id="d-name" class="t-ip-form1" type="text" placeholder="Name" name="name" style="margin-bottom: 5px">
                        <input id="d-phone" class="t-ip-form1" type="text" placeholder="Email hoặc Phone" name="phone">
                        <input id="d_id_comnent" type="hidden" name="id_comment" data-id="">
                    </div>
                    <!-- end input -->              
                    <!-- button  -->
                    <button id="d-click-comment" data-id="{!! $comment->id  !!}" class="btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu" type="submit">Gửi</button>
                    <!-- end button  -->    
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
