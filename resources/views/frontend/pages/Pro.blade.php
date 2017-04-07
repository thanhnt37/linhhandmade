@extends('frontend.layout')
@section('title',$product->name)
	@section('meta')
	<meta name="description" content="{{$product_root->short_description}}">
	<meta property="og:title" content="{{$product_root->name}}"/>
    <meta property="og:image" content="{{asset($product_root->img)}}"/>
    <meta property="og:site_name" content="{{url('')}}"/>
    <meta property="og:url" content="{{route('getProDetail',['id'=>$product_root->id,'slug'=>$product_root->slug])}}"/>
    <meta property="og:description" content="{{$product_root->short_description}}"/>
    @endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/html/css/linhhandmade-Pro.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/html/css/duy-edit.css') }}">
	<!-- hover by duy -->
    <link rel="stylesheet" href="{{ asset('frontend/html/css/d-hover.css') }}">
    <!-- click d-click-form -->
    <link rel="stylesheet" href="{{ asset('frontend/html/css/d-click-form.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endsection
@section('menu')
<div class="pull-left">
    <button type="button" class="navbar-toggle menu-catagory" data-target="#menu-catagory">
        <i class="fa fa-th-large" aria-hidden="true"></i>
    </button>

</div>
@endsection
@section('content')
	<style>
	.h-btn-hethang-text,.h-thongbao>p>span,.h-thongbao>p>span:first-child{font-family:'Roboto Bold'}@media (max-width:413px){.not_show{display:none!important}}.noselect{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.d-comment.active a{color:#75005f}.list-inline li{padding:0!important}.h-hethang{margin-top:20px}.h-btn-hethang{display:inline-block;width:90px;height:36px;background-color:#e53935;text-align:center;border-radius:3px}.h-btn-hethang-text{line-height:36px;color:#fff}.h-thongbao{display:inline-block;margin-left:12px}.h-thongbao>p>span:first-child{color:#75005f;transition:.4s;cursor:pointer}.h-thongbao>p>span{color:#404040}.h-thongbao>p>span:first-child:hover{color:#e53935}#frame_x_img img{height:85%!important}.owl-item{cursor:pointer!important}@media screen and (min-width:768px){.bbb{margin-top:-9px;padding-right:2px}}@media screen and (max-width:767px){.bbb{margin:-9px 0 19px}}.vid-style{background:0 0!important}.vid-style .wrap-div{background-color:#fff;box-shadow:0 0 64px 0 rgba(17,17,17,1);padding:15px;border-radius:7px;width:670px;margin:auto}.vid-style iframe{display:block;margin:auto;width:640px;height:360px}@media (min-width:992px){.t-catagory{display:none}}
		.fa-facebook:hover{color:#3b5998;}.fa-twitter:hover{color:#00abf0;}.fa-google-plus:hover{color:#d00018;}
		#owl-demo2 span{
			font-size: 10pt;
		    font-family: 'Roboto Bold';
		    color: #0D0D0D;

		}
		#owl-demo2{
			/*margin-top:20px;*/
			/*border-bottom: 1px dashed #d9d9d9;*/
			/*padding-bottom: 10px;*/
		}
	</style>
    <?php
		$content = App\ContentFrame::where('frame_id',$product->id)->first();
		$face = Session::get('face');
	?>
	@include('frontend.partials.banner')
    <section class="t_section_content_products">
	    <div class="container d_section_content_pr t_section_content_pr">
	        <div class="row">
	            <div class="col-md-12">
	                <ul class="d_cate_products">
	                    <li style="color:#7F7F83"><a href="{!! url('') !!}" style="color:#7F7F83">Trang chủ</a></li>
	                    <li style="color:#d6e9d7">/</li>
	                    <li style="color:#7F7F83" class="not_show"><a  style="color:#7F7F83" >Sản phẩm</a></li>
	                    <li style="color:#d6e9d7" class="not_show">/</li>
	                    <li style="#484040" id="d-name">{!! $product->name !!}</li>
	                </ul>
	            </div>
	        </div>
	    </div>
	</section>
    	<section class="t-sec1">
		<div class="container">
			<!-- <div class="t-cacvongtron" id="frame_x_img">
				<ul>
				 <?php $list_color = App\Filter::where('name','Màu Sắc')->get();
			                    $in_color = array();
			                    foreach ($list_color as $key => $value) {
			                        array_push($in_color, $value->attribute_id);
			                    }    
			                ?>
				@foreach($frame_fillter as $key=> $item)
					<?php
			                     $attr_color = DB::table('frame_attributes')
			                     ->whereIn('frame_attributes.attribute_id',$in_color)
			                     ->where('frame_attributes.frame_id',$item->id)
			                     ->leftjoin('filters','frame_attributes.attribute_id','=','filters.attribute_id')->first(); 
			                    ?> 
			                    @if($attr_color)		
						<li >
							<img active id="d-frame" data-id="{!! $item->id !!}" @if($item->id == $product->id) class=" t-bovien" @endif width="32px" src="{!! $attr_color->img !!}" style="height: auto" />
						</li>
					@endif
				@endforeach
			
				</ul>
			</div> -->
			
			<div class="row t-margin">
				<div class="col-md-4  col-sm-12 col-xs-12 sm-margin-bottom-three t-padding-pro">
					<div class="row">
						<div class="col-md-12 ">
							<p>Màu sắc khác</p>
							<div class="color-hoho">

								@foreach($frame_fillter as $key=> $item)
									<a href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" @if($item->id == $product->id) class="color-hoho-active" @endif><img src="{!! $item->img !!}" alt=""></a>
								@endforeach
							</div>
							<div id="d-frame-detail">
							 @if($product)
							 <?php $frame_image = App\FrameImage::where('frame_id',$product->id)->get();
								$youtube = json_decode($product->youtube_link);
							 ?>
								<div>
									@if(sizeof($frame_image))
										@foreach($frame_image as $key => $item)
												@if($key == 0)
													<img src="{{ $item->img }}" alt="" class="product-imgs" id="containner_images_product" style="height:auto" />
												@endif
										@endforeach
									@else
										<img src="  {{ $product->img }} " alt="" class="product-imgs" id="containner_images_product" style="height:auto" />
									@endif
									
									
									 <!-- featured products slider -->
									<div id="shop-products" class="owl-carousel products-thumb  owl-theme dark-pagination owl-no-pagination owl-prev-next-simple index-product-featured" style="margin-top:1px">
										<!-- shop item -->
										
										@foreach($frame_image as $item)
												<div class="item t-item-slide d-image_detail" data-src="{{ $item->img }}" style="padding-right:2px;">
													<div class="text-center position-relative overflow-hidden t-home-product" data-src="{{ $item->img }}">
														<img src="{{ $item->thumb_images }}" alt=""/>
													</div>
												</div>	
										@endforeach
										@if($product->youtube_link)
											@foreach($youtube as $item2)
												<?php 
													$link = $item2;
													$video_id = explode("?v=", $link);
													$video_id = $video_id[1];
												?>
												<div class="item t-item-slide d-youtube" data-link="{!! $video_id !!}" style="padding-right:2px;">
													<div class="text-center position-relative overflow-hidden t-home-product" style="padding-top: 4%;background-color: black;padding-bottom: 4%;">
														<img style="" src="http://img.youtube.com/vi/{!! $video_id !!}/hqdefault.jpg">
														<i class="fa fa-play" style="font-size: 20px;position: absolute;color: white;top: calc(50% - 10px);right: calc(50% - 10px);"></i>
													</div>
												</div>
											@endforeach
										@endif

										<!-- end shop item -->
									</div>
								</div>
								<!-- end featured products slider -->
								
								<p class="t-ten-sp" style="font-size: 11pt; margin-top: 23px !important; margin-bottom: 15px !important;">{{ $product->name }} <span>{!! $product->code_frame !!}</span></p>
									
								Giá : 
								@if($product->price_sale)
									<span class="t-pro-gia">
									<span style="margin-left: 5px">
									{!! number_format((int)$product->price,0,'','.') !!} đ
									</span>{!! number_format((int)$product->price_sale,0,'','.') !!} đ</span>
								@else
									<span class="t-pro-gia" style="padding-left: 5px">{!! number_format((int)$product->price,0,'','.') !!} đ</span>
								@endif
							
								@if($product->sku > 0)
										<!-- <p><span>Tình Trạng : Còn Hàng</span></p> -->
								<div class ="row t-div-btn" style="margin-top: 7px;">
									<div class="col-md-12 col-sm-9 d-pd-button">
										<div class="row product-div t-dm-share-button">
											<div class="col-md-5 col-sm-2 col-xs-3 xs-no-padding-left no-padding" @if($product->sku>100) style="width: 92px !important;" @endif @if($product->sku>1000) style="width: 112px !important;" @endif >
												<div style = "padding:0px;" class="select-style t-popup-sl med-input xs-med-input shop-shorting-details no-border-round">
													<select class="pro-select t-pro-select">
														@for($i=1;$i<=$product->sku;$i++)
															@if( $i< 10)
																<option value="{{$i}}">0{{$i}}</option>
															@else
																<option value="{{$i}}">{{$i}}</option>
															@endif
														@endfor
													</select>
												</div>
											</div>
											
											<div class="col-md-7 col-sm-4 col-xs-8 " @if($product->sku>100) style=" width: calc(100% - 108px) !important;" @endif @if($product->sku>1000) style=" width: calc(100% - 128px) !important;" @endif >
												<a style="cursor: pointer" class="highlight-button-dark btn-small no-margin-right no-margin-bottom t-ind-btn d-add-cart" data-frame="{!! $product->id !!}">Thêm vào giỏ</a>
											</div>
										</div>
									</div>
								</div>
									@else
										<div class="h-hethang" style="margin-bottom: -7px;">
											<div class="h-btn-hethang" style="height: 40px;">
												<span class="h-btn-hethang-text" style="line-height: 40px;font-size: 10pt;font-family: 'Roboto';">Hết hàng</span>
											</div>
											<div class="h-thongbao" style="margin-left: 5px;">
												<p><span class="d-het-hang" data-id="{{ $product->product_id }}" data-frame="{{ $product->id }}">Thông báo cho tôi</span> <span>khi có hàng</span></p>
											</div>
										</div>
									@endif
								<!--Hệ thống 2 nút-->
								@endif	
									
								
							</div>
							<!--Hết Hệ thống 2 nút-->
							<!--Sản phẩm liên qua-->
							<?php
								$attr = $product->getAttributes;
								$in = array();
								foreach ($attr as $key => $value) {
									array_push($in,$value->id);
								}
								$list_same_attr = DB::table('frame_attributes')->where('frame_attributes.frame_id','<>',$product->id)->whereIn('frame_attributes.attribute_id',$in)->where('frame_attributes.status_frame',1)->take(4)->leftjoin('frames','frame_attributes.frame_id','=','frames.id')->select('frames.*')->get();
							?>
							<!-- <div class="t-splq">
								<p style="font-size: 11pt; font-family: 'Roboto Light'">Có thể bạn thích</p>
								<div class="t-hang">
								@foreach($list_same_attr as $item)
									@if($item->id != $product->id)
										<div class="col-md-6 col-xs-6 no-padding ">
											<a href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}"><img width="130px" height="90px" src="{!! $item->thumb_images !!}" />
											</a>
											<a href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" style="font-size: 9pt">{!! $item->name !!}</a>
											<span>
												@if($item->price_sale)
												<span>{!! number_format((int)$item->price_sale,0,'','.') !!} đ</span>
												@else
													{!! number_format((int)$item->price,0,'','.') !!} đ
												@endif		
											</span>
										</div>
									@endif
								@endforeach
									<div style="clear:both"></div>
								</div>
							</div> -->
							<!--hết sản phẩm liên quan-->
						</div>
					</div>
                </div>
				<!--Bắt đầu khung thuộc tính-->
				<div class="col-md-8 col-sm-8 col-xs-12 t-khungthuoctinh">
				<!--Tiêu đề mô tả-->
				<div id="d-content">
					<div class="t-tt4 t-tt d-tensp">
						<p>{!! $product->name !!}</p>
						{!! $content->content !!}
					</div>
					<?php $feature  = $product->getFeatures()->orderby('name')->get(); ?>
					<?php $name = "" ?>
					@foreach($feature as $k => $v)
						@if($v->name != $name)
							<div class="t-tt4 t-tt">
								<p>{!! $v->name !!}</p>	
						@endif
						@if(isset($feature[$k+1]))
							@if($feature[$k+1]->name != $feature[$k]->name)
								@if($v->img)
									<img src="{{asset($v->img)}}" width="30" height="30" style="margin-left:13px">
								@else
									<span style="background-color:none;">{!! $v->value !!}</span>
								@endif
							</div>
							@else
								@if($v->img)
									<img src="{{asset($v->img)}}" width="30" height="30"  style="margin-left:13px">
								@else
									<span style="background-color:none;">{!! $v->value !!}</span>
								@endif
							@endif
						@else
								@if($v->img)
									<img src="{{asset($v->img)}}" width="30" height="30"  style="margin-left:13px">
								@else
									<span style="background-color:none;">{!! $v->value !!}</span>
								@endif
							</div>
						@endif
						<?php $name = $v->name;?>
					@endforeach
					
					<?php
						$list_related=App\Related_product::where('frame_id',$product->id)->orwhere('frame_related',$product->id)->get();
						$list = array();
						foreach ($list_related as $key => $value) {
							if($value->frame_id == $product->id){
								array_push($list,$value->frame_related);
								}
							if($value->frame_related == $product->id){
								array_push($list,$value->frame_id);
								}
							}
						
						$product_lienquan = App\Frame::wherein('id',$list)->where('status',1)->limit(12)->get();
					?>
					@if(sizeof($product_lienquan))
					<div class="t-tt4 t-tt">
						<p>Liên quan</p>
						<div id="owl-demo2" class="owl-carousel ">
	                        @foreach($product_lienquan as $item)
	                            <div class="item" style="text-align:center">
	                                <a href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}"><img width="130px" height="90px" src="{!! $item->img !!}" />
	                                </a>
									<a href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" style="font-size: 9pt;display: block;">{!! $item->name !!}</a>
									<span>
										@if($item->price_sale)
										<span>{!! number_format((int)$item->price_sale,0,'','.') !!} đ</span>
										@else
											{!! number_format((int)$item->price,0,'','.') !!} đ
										@endif		
									</span>
	                            </div><!-- end of item -->
	                        @endforeach
	                    </div><!-- end of owl-carousel -->
					</div>
					@endif
				</div>
				<!--Hết tiêu đề mô tả-->
				<!--Mạng xã hội-->
				
				<div class="t-tt t-soc2">
                    <!-- social media link -->
                    <?php $url = route('getProDetail',['id'=>$product_root->id,'slug'=>$product_root->slug]); ?>
                    <a target="_blank"  href="http://www.facebook.com/sharer.php?u={{$url}}" title="{{$product->name}}" class="fb_share"><i class="fa fa-facebook"></i></a>
                    <a target="_blank" href="http://twitter.com/share?url={{$url}}"  title="{{$product->name}}"  class="tw_share"  ><i class="fa fa-twitter"></i></a>
                    <a target="_blank" href="https://plus.google.com/share?url={{$url}}"  title="{{$product->name}}"   class="gp_share" ><i class="fa fa-google-plus"></i></a>
                    <!-- <a target="_blank" href="https://dribbble.com/"><i class="fa fa-dribbble"></i></a> -->
                    <!-- <a target="_blank" href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a> -->
                    <!-- end social media link -->
                </div>
				<!--hết Mạng xã hội-->
				<!--Bình luận fb-->
				<div class="t-cmt">
					<div id="d-ajax_">
						<div class="t-comment">
							<div>
								<div><img style="border-radius: 4px !important" src="@if($face){!! $face->img !!}@else{!! asset('frontend/img/user.png') !!}@endif"/></div>
								<div class="t-comment-p">
									<p>Bình luận</p>
									<input placeholder="Nhập nội dung bình luận ..." type="text" id="d-popup-binhluan" data-id="{!! $product->id !!}"/>
								</div>
								<div style="clear:both"></div>
							</div>
						</div>
					<!--Phần trả lời comment -->
					<?php $comments = App\CommentFrame::select('comment_frames.*','accounts.name','accounts.img')->leftJoin('accounts','comment_frames.account_id','=','accounts.id')->where('comment_frames.status',1)->where('comment_frames.frame_id',$product->id)->where('comment_frames.parent_id','=',0)->orderby('created_at','desc')->paginate(3);?>
					{{-- left joint bang acc theo account id --}}
					@foreach($comments as $comment)
						<div class="t-comment2" >
							<div>
								<div><img style="border-radius: 4px !important" src="{!! asset($comment->img) !!}"/></div>
								<div class="t-comment-p2">
									<div>
										<p class="t-name-tl">{{ $comment->name }}<a href="" id="d-comment-dequy" data-frame="{!! $product->id !!}" data-id="{!! $comment->id !!}" >Trả lời</a></p>
										<p class="t-noidung-cmt">{{$comment->comment}}</p>
										<span class="t-tg-cmt">{{$comment->created_at}}</span>

										<?php $comment_cap2 = App\CommentFrame::select('comment_frames.*','accounts.name','accounts.img')->leftJoin('accounts','comment_frames.account_id','=','accounts.id')->where('comment_frames.status',1)->where('comment_frames.frame_id',$product->id)->where('comment_frames.parent_id','=',$comment->id)->orderby('created_at','desc')->paginate(3);?>
										@foreach($comment_cap2 as $item)
											@if($item->parent_id == $comment->id)
												<div class="t-tl-cmt">
													<div class="t-tl-cmt-img"><img style="border-radius: 4px !important" src="{!! asset($item->img) !!}"  /></div>
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
				                            <input id="d_id_comnent" type="hidden" name="id_comment" data-id="">
				                            <!-- end input -->              
				                            <!-- button  -->
				                            <button id="d-click-comment" data-id="{!! $comment->id !!}" class="btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu" type="submit">Gửi</button>
				                            <!-- end button  -->    
				                        </form>
				                    </div>
				                </div>
				            </div>
				        </div>
					@endforeach
					</div>
				</div>
				<!--hết Bình luận fb-->
				<!--phần điều hướng -->
                <div class="t-div-pagi noselect" id="d-paginate" style="margin-top: 36px;" >
                        <?php
                          $link_limit = 9; 
                        ?>
                        <ul class="list-inline list-unstyled ">
                          <li class="d-comment " style=" cursor:pointer;" data-page="{{ $comments->currentPage() - 1 }}" data-frame="{!! $product->id !!}"  ><a >Trước</a></li>
                          @for ($i = 1; $i <= $comments->lastPage(); $i++)
                                <?php
                                $half_total_links = floor($link_limit / 2);
                                $from = $comments->currentPage() - $half_total_links;
                                $to = $comments->currentPage() + $half_total_links;
                                if ($comments->currentPage() < $half_total_links) {
                                   $to += $half_total_links - $comments->currentPage();
                                }
                                if ($comments->lastPage() - $comments->currentPage() < $half_total_links) {
                                    $from -= $half_total_links - ($comments->lastPage() - $comments->currentPage()) - 1;
                                }
                                ?>
                                @if ($from < $i && $i < $to)
                                    <li style="cursor:pointer;" data-page="{{ $i }}" data-frame="{!! $product->id !!}" class="d-comment {{ ($comments->currentPage() == $i) ? ' active' : '' }}">
                                        <a  href="{{ $comments->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                          @endfor
                          <li class=" d-comment" style="cursor:pointer;" data-page="{{ $comments->currentPage() + 1 }}" data-frame="{!! $product->id !!}"  ><a>Sau</a></li>
                        </ul>
                </div>
                <!--hết phần điều hướng -->
				</div>
				<!--kết thúc khung thuộc tính-->
			</div>
			
		</div>
		<!-- popup thêm giỏ hàng thành công -->
		<div id="modal-popup-cart" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
		    <div style="">
		        <h5><i style="color: #000;font-size: 19px;margin-right: 6px;" class="fa fa-shopping-cart"></i>Giỏ hàng</h5>
		    </div>
		    <div class="t-popup-padding-rp">
		        <div class="row" style="margin:0px !important">
		            <div class="center-col">
		                <p style="text-align:center;margin-top: 25px;margin-bottom: 8px;"><span style="font-size:10.5pt; font-family: 'Roboto Bold'; " id="name_product_add"> </span></p>
		                <p style="text-align: center;margin-bottom: 0 !important;">Đã được thêm vào giỏ hàng thành công</p>
		            </div>
		        </div>
			</div>
		</div>
		
		        <!--Popup bình luận-->
    <div id="modal-popup-binhluan" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
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
                    <form id="d-submit" data-id="{!!  $product->id  !!}">
                        <!-- input  -->
                        <textarea  name="comment" class="t-ip-form1 tan-textarea-binhluan" placeholder="Nhập nội dung..."></textarea>
                        
							<input id="d_hidden" type="hidden" name="hidden" data-id="">
                        <!-- end input -->              
                        <!-- button  -->
                        <button class="btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu" type="submit">Gửi</button>
                        <!-- end button  -->    
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Hết popup bình luận-->
    <!--Popup tích điểm-->
        <div id="modal-popup-dangnhap" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
            <div style="">
                <h5>Đăng nhập</h5>
            </div>
            <div class="t-popup-padding-rp">
                <div class="row" style="margin:0px !important">
                    <div class="center-col text-center margin-ten no-margin-top xs-margin-bottom-seven let" style="margin-bottom:0px !important">
                    </div>
                </div>
                <div class="row" style="margin:0px !important">
                    <div class="center-col text-center">            
                            <!-- button  -->
                            <a href="{{ route('frontend.loginfb') }}?cur_url={{Request::url()}}" class="btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu" type="submit" style="    background-color: #3B5998 !important; border: none !important; margin-top: 23px;    line-height: 27px">Facebook</a>
                            <!-- end button  -->
                    </div>
                </div>
            </div>
        </div>
        <!--Hết popup tích điểm-->
    <!--Popup thông báo-->
    <div id="modal-popup4" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
        <div style="">
            <h5>Thông báo</h5>
        </div>
        <div class="t-popup-padding-rp">
            <div class="row" style="margin:0px !important">
                <div class="center-col text-center">
                    <form  id="d-form-het-hang">
                        <!-- input  -->
                        <input class="t-ip-form1" type="email" placeholder="Email" required name="email">
                        <input class="t-ip-form1" type="text" placeholder="Số điện thoại" name="phone">
                        <input class="t-ip-form1 t-ip-form2" type="text" placeholder="Họ tên"  name="name">
                        <label class="text-left">
                            <input class="t-ip-form1 text-left" type="radio" checked>Thông báo cho tôi khi có sản phẩm {{ $product->name }}
                        </label>
                        <!-- end input -->              
                        <!-- button  -->
                        <p id="d-email-ton-tai" style="color:red;font-family: Roboto;font-weight: 500;font-size: 14px;display:none;"></p>
                        <button class="btn btn-black no-margin-bottom btn-small font-weight-400  t-xd-pu" style="" type="submit">Xác nhận</button>

                        <!-- end button  -->
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Hết popup thông báo-->
    <!--Popup thông báo gửi thành công-->
    <div id="modal-popup-guithanhcong" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
        <div style="">
            <h5>Gửi thành công</h5>
        </div>
        <div class="t-popup-padding-rp">
            <div class="row" style="margin:0px !important">
                <div class="center-col">
                    <p style="margin:10px 0px 0px">Bình luận của bạn đã được hiển thị. Bạn có thể refresh lại trang để xem.</p>
                </div>
            </div>
        </div>
    </div>
    <!--Hết popup thông báo gửi thành công-->

    <!--Popup thông báo gửi thành công-->
    <div id="modal-popup-guithanhcong-hethang" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
        <div style="">
            <h5>Gửi thành công</h5>
        </div>
        <div class="t-popup-padding-rp">
            <div class="row" style="margin:0px !important">
                <div class="center-col">
                    <p style="margin:10px 0px 0px">Cảm ơn bạn đã để lại thông tin. {!! url('') !!} sẽ thông báo đến bạn khi có sản phẩm {!! $product->name !!}</p>
                </div>
            </div>
        </div>
    </div>
    <!--Hết popup thông báo gửi thành công-->
    <div id="modal-popup-vid" class="col-md-6 zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main vid-style" style="padding:0px">

        <div class="wrap-div">
        	<div id="wrap_containner" style="text-align:center">
            	<iframe id="d-popup-video" frameborder="0" allowfullscreen></iframe>
            </div>
        	<img src="{{asset('frontend/img/back.svg')}}" class="svg popup-vid-controls-prev">
        	<img src="{{asset('frontend/img/next.svg')}}" class="svg popup-vid-controls-next">
    		<button type="button" class="mfp-close" style="">×</button>
        </div><!-- end of wrap-vid -->
    </div>
	
	
	</section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<!-- Icon menu catagory ========================================================================== -->
<!-- Visible menu catagory -->
<script>
    $("button.menu-catagory").click(function() {
        $(".t-catagory").toggleClass("t-catagory-visible");
    });
</script>
<!-- click slide down small menu catagory -->
<script>
	 $("#owl-demo2").owlCarousel({
        slideSpeed : 300,
		paginationSpeed : 300,
		items : 4,
		autoPlay:true,
		itemsDesktop : false,
		itemsDesktopSmall : false,
		itemsTablet: false,
		itemsMobile : false,
        navigation : true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        pagination : false
      });

    $(document).ready(function() {
        $(".t-hover-catagory").click(function() {
            //$('.t-hover-catagory').removeClass('category-active');
            list = $('.t-hover-catagory');
            click = this;
            $.each(list,function(i,v){
                if(v !== click) {
                    $(v).removeClass('category-active');
                }
            });
            $(this).toggleClass('category-active');
            
        });
    });
    $(document).mouseup(function (e)
    {
        var container = $(".t-catagory");
        var icon = $(".menu-catagory");
        
        if (!icon.is(e.target) // if the target of the click isn't the container...
            && icon.has(e.target).length === 0) // ... nor a descendant of the container
        {}else{
            return false;
        }

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $(".t-catagory").removeClass('t-catagory-visible'); 
        }
    });
    
</script>
<!-- Icon menu catagory ========================================================================== -->
<script>
$(document).on('click','.popup-vid-controls-prev',function(){
		children = $("#wrap_containner").children().first();
		type = 0;
		src = "";
		if(children.is('iframe')){
			src = children.attr('src');
			type = 1;
		}
		if(children.is('img')){
			src = children.attr('src');
			type = 2;
		}
		x = $('.owl-item .item');
		current = -1;
		$.each(x,function(i,v){
			if($(v).hasClass('d-youtube')){
					link = $(v).data('link');
					yt = "https://www.youtube.com/embed/" + link;
					if(src == yt){
						current = i;
					}
			}	
			if($(v).hasClass('d-image_detail')){
					src_v = $(v).data('src');
					if(src == src_v){
						current = i;
					}
			}
		});
		if(current >=0){
			console.log(current);
			if(x[current-1]){
				if($(x[current-1]).hasClass('d-youtube')){
					link = $(x[current-1]).data('link');
					str = '<iframe id="d-popup-video" src="https://www.youtube.com/embed/'+link+'" frameborder="0" allowfullscreen></iframe>';
              		$("#wrap_containner").html(str);
				}
				if($(x[current-1]).hasClass('d-image_detail')){
					src_v = $(x[current-1]).data('src');
					str = '<img src="'+src_v+'" style="height:auto">'
              		$("#wrap_containner").html(str);
				}
			}
		}
});
$(document).on('click','.popup-vid-controls-next',function(){
		children = $("#wrap_containner").children().first();
		type = 0;
		src = "";
		if(children.is('iframe')){
			src = children.attr('src');
			type = 1;
		}
		if(children.is('img')){
			src = children.attr('src');
			type = 2;
		}
		x = $('.owl-item .item');
		current = -1;
		$.each(x,function(i,v){
			if($(v).hasClass('d-youtube')){
					link = $(v).data('link');
					yt = "https://www.youtube.com/embed/" + link;
					if(src == yt){
						current = i;
					}
			}	
			if($(v).hasClass('d-image_detail')){
					src_v = $(v).data('src');
					if(src == src_v){
						current = i;
					}
			}
		});
		if(current >=0){
			console.log(current);
			if(x[current+1]){
				if($(x[current+1]).hasClass('d-youtube')){
					link = $(x[current+1]).data('link');
					str = '<iframe id="d-popup-video" src="https://www.youtube.com/embed/'+link+'" frameborder="0" allowfullscreen></iframe>';
              		$("#wrap_containner").html(str);
				}
				if($(x[current+1]).hasClass('d-image_detail')){
					src_v = $(x[current+1]).data('src');
					str = '<img src="'+src_v+'" style="height:auto">'
              		$("#wrap_containner").html(str);
				}
			}
		}
});
$(document).on('click','.d-youtube',function(){
		link = $(this).data('link');
		// alert(link);
		$.magnificPopup.open({
            items: {
                src: '#modal-popup-vid' 
            },
            type: 'inline',
            blackbg: true,
            zoom: {
                    enabled: true,
                    duration: 300 
                  },
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
              beforeOpen: function() {
              	str = '<iframe id="d-popup-video" src="https://www.youtube.com/embed/'+link+'" frameborder="0" allowfullscreen></iframe>';
              	$("#wrap_containner").html(str);
              	
              }
            }
    	});
});
$(document).on('click','#containner_images_product',function(){
		src = $(this).attr('src');
		// alert(link);
		$.magnificPopup.open({
            items: {
                src: '#modal-popup-vid' 
            },
            type: 'inline',
            blackbg: true,
            zoom: {
                    enabled: true,
                    duration: 300 
                  },
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
              beforeOpen: function() {
              	str = '<img src="'+src+'" style="height:auto">'
              	$("#wrap_containner").html(str);
              	
              }
            }
    	});
});
$(document).ready(function(){
	t_home = $('.t-home-product');
	$.each(t_home,function(i,v){
		if(i == 0) $(v).addClass('t-active');
		$(v).addClass('t-home-'+i);
		$(v).attr('data-class',i);
	});
});	
t_home_product = $('')
$(document).on('click','.t-home-product',function(e){
	src = $(this).data('src');
	$("#containner_images_product").attr('src',src);
});



id_product = "";
id_frame = "";
$("#shop-products").owlCarousel({
	// navigation : true, 
	slideSpeed : 500,
	paginationSpeed : 300,
	items : 4,
	autoPlay:true,
	itemsDesktop : false,
	itemsDesktopSmall : false,
	itemsTablet: false,
	itemsMobile : false,
	navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
});

$(document).on('click','.d-het-hang',function(e){
	e.preventDefault();
	id = $(this).data('id');
	idframe = $(this).data('frame');
	$.magnificPopup.open({
            items: {
                src: '#modal-popup4' 
            },
            type: 'inline',
            blackbg: true,
            zoom: {
                    enabled: true,
                    duration: 300 
                  },
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
              beforeOpen: function() {
               
              }
            }
    	});
    id_product = id;
    id_frame = idframe;
});

$(document).on('submit','#d-form-het-hang',function(e){
	e.preventDefault();
	id_product = id_product;
	id_frame = id_frame;
	var form = $('#d-form-het-hang')[0];
	var formData = new FormData(form);
	formData.append('id_product',id_product );
	formData.append('id_frame',id_frame);
	$.ajax({
		headers: {
					  'X-CSRF-TOKEN': '{{ csrf_token() }}'
				},
		type:"post",
		url:"{{route('ajax.form.het.hang')}}",
		data: formData,
		contentType: false,
		processData: false,
		success:function(data){
			if(data.status == true){
				$('#modal-popup4').magnificPopup('close');
					$("#d-form-het-hang")[0].reset();
					$.magnificPopup.open({
                        items: {
                            src: '#modal-popup-guithanhcong-hethang' 
                        },
                        type: 'inline',
                        blackbg: true,
                        zoom: {
                                enabled: true,
                                duration: 300 
                              },
                        mainClass: 'my-mfp-zoom-in',
                        callbacks: {
                          beforeOpen: function() {
                           
                          }
                        }
                    });
			}else{
				$('#d-email-ton-tai').css('display','block').text(data.message);
			}
		},
		dataType:"json"
	});
});

function readURL(input) {
	if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img_preview').attr('src', e.target.result);
            
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#file_img_preview").change(function(){
    readURL(this);
});


$(document).on('click','#d-frame',function(){
	id = $(this).data('id');
	page = 1;
	$.ajax({
		headers: {
			  'X-CSRF-TOKEN': '{{ csrf_token() }}'
		},
		type:"post",
		url:"{!! route('ajax.frame.chitiet') !!}",
		data:{'id':id,'page':page},
		success:function(data){
			if(data.status == true){
				$('#d-frame-detail').html(data.html);
				$('#d-content').html(data.content);
				$('#d-ajax_').html(data.comments);
				$('#d-paginate').html(data.ul_frame);
				$('.t-splq').html(data.relate);
				$("#shop-products").owlCarousel({
					// navigation : true, 
					slideSpeed : 500,
					paginationSpeed : 300,
					items : 4,
					autoPlay:true,
					itemsDesktop : false,
					itemsDesktopSmall : false,
					itemsTablet: false,
					itemsMobile : false,
					navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				});
				$("#owl-demo2").owlCarousel({
			        slideSpeed : 300,
					paginationSpeed : 300,
					items : 4,
					autoPlay:true,
					itemsDesktop : false,
					itemsDesktopSmall : false,
					itemsTablet: false,
					itemsMobile : false,
			        navigation : true,
			        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			        pagination : false
			      });
				t_home = $('.t-home-product');
				$.each(t_home,function(i,v){
					if(i == 0) $(v).addClass('t-active');
					$(v).addClass('t-home-'+i);
					$(v).attr('data-class','t-home-'+i);
				});
				window.history.pushState({},data.frame.name, data.str_link);
				document.title = data.frame.name;
			}
		},
		cache:false,
		dataType: 'json'
	});
});
// phân trang
$(document).on('click','.d-comment',function(e){
	e.preventDefault();
	page = $(this).data('page');
	id_frame = $(this).data('frame');
	    $.ajax({
		headers: {
			'X-CSRF-TOKEN': '{{ csrf_token() }}'
		},
		type:"post",
		url:"{{route('ajax.pagination')}}",
		data:{'id_frame':id_frame,'page':page},
		success:function(data){
			if(data.status == true){
				$('#d-ajax_').html(data.html);
				$('#d-paginate').html(data.ul);
			}
		},
		cache:false,
		dataType: 'json'
	});
});

id_comment = "";
$(document).on('click','#d-comment-dequy',function(e){
	e.preventDefault();
	
	@if($face != null)
		id = $(this).data('id');
		frame_id = $(this).data('frame');
		$.magnificPopup.open({
	            items: {
	                src: '#modal-popup-binhluan2' 
	            },
	            type: 'inline',
	            blackbg: true,
	            zoom: {
	                    enabled: true,
	                    duration: 300 
	                  },
	            mainClass: 'my-mfp-zoom-in',
	            callbacks: {
	              beforeOpen: function() {
	               $('#d_id_comnent').val(id);
	              }
	            }
	    	});
		id_comment = id;
	@else
		$.magnificPopup.open({
            items: {
                src: '#modal-popup-dangnhap' 
            },
            type: 'inline',
            blackbg: true,
            zoom: {
                    enabled: true,
                    duration: 300 
                  },
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
              beforeOpen: function() {

              }
            }
    	});
	@endif

});	
 spam = 0;
$(document).on('submit','#d-submit2',function(e){
	e.preventDefault();
	if(spam == 0){
		spam ++;
		var form = $('#d-submit2')[0];
		var formData = new FormData(form);
		$.ajax({
			headers: {
						 'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
			type:"post",
			url:"{{route('ajax.pro.comment.quy')}}",
			data: formData,
			contentType: false,
			processData: false,
			success:function(data){
				spam = 0;
				if(data.status == true){
					$('#modal-popup-binhluan2').magnificPopup('close');
					$("#d-submit2")[0].reset();
					$.magnificPopup.open({
                        items: {
                            src: '#modal-popup-guithanhcong' 
                        },
                        type: 'inline',
                        blackbg: true,
                        zoom: {
                                enabled: true,
                                duration: 300 
                              },
                        mainClass: 'my-mfp-zoom-in',
                        callbacks: {
                          beforeOpen: function() {
                           
                          }
                        }
                    });
				}

			},
			dataType:"json"
			});
	}
	spam = 1
	

});
id="";
$(document).on('click','#d-popup-binhluan',function(){
	
	@if($face != null)
		id=$(this).data('id');
		id=id;
		$.magnificPopup.open({
	        items: {
	            src: '#modal-popup-binhluan' 
	        },
	        type: 'inline',
	        blackbg: true,
	        zoom: {
	                enabled: true,
	                duration: 300 
	              },
	        mainClass: 'my-mfp-zoom-in',
	        callbacks: {
	          beforeOpen: function() {
	           $('#d_hidden').val(id);
	          }
	        }
	    });
	@else
		$.magnificPopup.open({
            items: {
                src: '#modal-popup-dangnhap' 
            },
            type: 'inline',
            blackbg: true,
            zoom: {
                    enabled: true,
                    duration: 300 
                  },
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
              beforeOpen: function() {

              }
            }
    	});
	@endif
});

spam = 0;
$(document).on('submit','#d-submit',function(e){
	e.preventDefault();
	if(spam == 0){
		spam ++;
		var form = $('#d-submit')[0];
		var formData = new FormData(form);
		$.ajax({
			headers: {
						 'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
			type:"post",
			url:"{{route('ajax.pro.comment')}}",
			data: formData,
			contentType: false,
			processData: false,
			success:function(data){
				spam = 0;
				if(data.status == true){
					$('#modal-popup-binhluan').magnificPopup('close');
					$("#d-submit")[0].reset();
					$.magnificPopup.open({
                        items: {
                            src: '#modal-popup-guithanhcong' 
                        },
                        type: 'inline',
                        blackbg: true,
                        zoom: {
                                enabled: true,
                                duration: 300 
                              },
                        mainClass: 'my-mfp-zoom-in',
                        callbacks: {
                          beforeOpen: function() {
                           
                          }
                        }
                    });
				}

			},
			dataType:"json"
			});
	}
	spam = 1

});
	$(".t-cacvongtron li").click(function(){
	$(".t-cacvongtron").find(".t-bovien").removeClass("t-bovien");
	$(this).children("img").addClass("t-bovien");
	});
</script>

<!-- slide -->
<script>



(function($){
  
  $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
    
    // Prevent default anchor event
    e.preventDefault();
    
    // Set values for window
    intWidth = intWidth || '500';
    intHeight = intHeight || '400';
    strResize = (blnResize ? 'yes' : 'no');

    // Set title and open popup with focus on it
    var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
        strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
        objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
  }
  
  /* ================================================== */
  
  $(document).ready(function ($) {
    $('.fb_share').on("click", function(e) {
      $(this).customerPopup(e);
    });
    $('.gp_share').on("click", function(e) {
      $(this).customerPopup(e);
    });
    $('.tw_share').on("click", function(e) {
      $(this).customerPopup(e);
    });
  });
    
}(jQuery));
jQuery('img.svg').each(function(){
    var $img = jQuery(this);
    var imgID = $img.attr('id');
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');

    jQuery.get(imgURL, function(data) {
        // Get the SVG tag, ignore the rest
        var $svg = jQuery(data).find('svg');

        // Add replaced image's ID to the new SVG
        if(typeof imgID !== 'undefined') {
            $svg = $svg.attr('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if(typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', imgClass+' replaced-svg');
        }

        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');

        // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
        if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
        }

        // Replace image with new SVG
        $img.replaceWith($svg);

    }, 'xml');

});
</script>
@endsection