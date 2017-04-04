@if($list_pro_xem)
	@foreach($list_pro_xem as $item)
		<li>	
			<a href=""><img alt="" src="{!! asset($item['xem_product']->img) !!}"/></a>
			<p><a href="{!! Route('getProDetail',['id'=>$item['xem_product']->id,'slug'=>$item['xem_product']->slug]) !!}">{!! $item['xem_product']->name !!}</a></p>
			<p class="tan-font-RB">
				
				@if($item['xem_product']->price_sale)
					{!! number_format($item['xem_product']->price_sale,0,'','.') !!}đ
				@else
					{!! number_format($item['xem_product']->price,0,'','.') !!}đ
				@endif
			</p>
			<div style="clear :both"></div>
		</li>
	@endforeach	
@endif