
<?php
	$name = "";
?>
@foreach($feature as $k => $v)
	@if($v->name != $name)
		<div class="t-tt4 t-tt">
			<p>{!! $v->name !!}</p>	
	@endif
	@if(isset($feature[$k+1]))
		@if($feature[$k+1]->name != $feature[$k]->name)
			@if($v->img)
				<img src="{{asset($v->img)}}" width="30" height="30"  style="margin-left:13px">
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
<div class="t-tt4 t-tt">
	<p>{!! $content->name !!}</p>
	{!! $content->content !!}
</div>
<?php
	$list_related=App\Related_product::where('frame_id',$frame->id)->orwhere('frame_related',$frame->id)->get();
	$list = array();
	foreach ($list_related as $key => $value) {
		if($value->frame_id == $frame->id){
			array_push($list,$value->frame_related);
			}
		if($value->frame_related == $frame->id){
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
                <a href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}"><img width="130px" height="90px" src="{!! $item->thumb_images !!}" />
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