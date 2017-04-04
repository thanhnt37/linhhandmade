<?php
	$attr = $product->getAttributes;
	$in = array();
	foreach ($attr as $key => $value) {
		array_push($in,$value->id);
	}
	$list_same_attr = DB::table('frame_attributes')->where('frame_attributes.frame_id','<>',$product->id)->whereIn('frame_attributes.attribute_id',$in)->where('frame_attributes.status_frame',1)->take(4)->leftjoin('frames','frame_attributes.frame_id','=','frames.id')->select('frames.*')->get();
?>

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