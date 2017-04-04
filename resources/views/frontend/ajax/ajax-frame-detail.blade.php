<?php $frame_image1 = App\FrameImage::where('frame_id',$frame->id)->first();
	$youtube = json_decode($frame->youtube_link);
 ?>
<div>
	<img style="height:auto;" src="@if(isset($frame_image1)){{ $frame_image1->img }}@else{{ $frame->img }}@endif" alt="" class="product-imgs" id="containner_images_product"/>
	 <!-- featured products slider -->
	<div id="shop-products" class="owl-carousel products-thumb  owl-theme dark-pagination owl-no-pagination owl-prev-next-simple index-product-featured" style="margin-top:1px">
		<!-- shop item -->
		<?php $frame_image = App\FrameImage::where('frame_id',$frame->id)->get(); ?>
		@foreach($frame_image as $item)
				<div class="item t-item-slide d-image_detail" data-src="{{ $item->img }}" style="padding-right:2px;">
					<div class="text-center position-relative overflow-hidden t-home-product" data-src="{{ $item->img }}">
						<img src="{{ $item->thumb_images }}" alt=""/>
					</div>
				</div>	
		@endforeach
		@if($frame->youtube_link)
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

<p class="t-ten-sp" style="font-size: 11pt; margin-top: 23px !important; margin-bottom: 15px !important;">{{ $frame->name }} <span>{!! $frame->code_frame !!}</span></p>
									
Giá : 
@if($frame->price_sale)
	<span class="t-pro-gia">
	<span style="margin-left: 5px">
	{!! number_format((int)$frame->price,0,'','.') !!} đ
	</span>{!! number_format((int)$frame->price_sale,0,'','.') !!} đ</span>
@else
	<span class="t-pro-gia" style="padding-left: 5px">{!! number_format((int)$frame->price,0,'','.') !!} đ</span>
@endif

@if($frame->sku > 0)
	<!-- <p><span>Tình Trạng : Còn Hàng</span></p> -->
	<div class ="row t-div-btn">
	<div class="col-md-12 col-sm-9 d-pd-button">
		<div class="row product-div t-dm-share-button" style="margin-top: 23px; margin-bottom: -19px;">
			<div class="col-md-5 col-sm-2 col-xs-3 xs-no-padding-left no-padding" @if($frame->sku>100) style="width: 92px !important;" @endif @if($frame->sku>1000) style="width: 112px !important;" @endif >
				<div style = "padding:0px;" class="select-style t-popup-sl med-input xs-med-input shop-shorting-details no-border-round">
					<select class="pro-select t-pro-select">
						@for($i=1;$i<=$frame->sku;$i++)
							@if( $i< 10)
								<option value="{{$i}}">0{{$i}}</option>
							@else
								<option value="{{$i}}">{{$i}}</option>
							@endif
						@endfor
					</select>
				</div>
			</div>
			
			<div class="col-md-7 col-sm-4 col-xs-8 " @if($frame->sku>100) style=" width: calc(100% - 108px) !important;" @endif @if($frame->sku>1000) style=" width: calc(100% - 128px) !important;" @endif >
				<a style="cursor: pointer" class="highlight-button-dark btn-small no-margin-right no-margin-bottom t-ind-btn d-add-cart" data-frame="{!! $frame->id !!}">Thêm vào giỏ</a>
			</div>
		</div>
	</div>
</div>
@else
	<div class="h-hethang">
		<div class="h-btn-hethang ajax-h-btn-hethang" style="height: 40px;">
			<span class="h-btn-hethang-text" style="line-height: 40px;font-size: 10pt;font-family: 'Roboto';">Hết hàng</span>
		</div>
		<div class="h-thongbao" style="margin-left: 5px;">
			<p><span class="d-het-hang" data-id="{{ $frame->product_id }}" data-frame="{{ $frame->id }}">Thông báo cho tôi</span> <span>khi có hàng</span></p>
		</div>
	</div>
@endif
