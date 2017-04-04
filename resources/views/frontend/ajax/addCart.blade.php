<?php $asset_dir = asset('')?>
<?php $total = 0;
?>
@if($list_pro)
    @foreach($list_pro as $key=>$item)
        <li id="d-list-cart-ajax" class="classli_{!! $item['frame']->id !!}" data-id="{{ $item['frame']->id }}" >
        <a href="{!! Route('getProDetail',['id'=>$item['frame']->id,'slug'=>$item['frame']->slug]) !!}"><img alt="" src="{{$asset_dir}}{{ $item['frame']->img }}"/></a>
        <p><a href="{!! Route('getProDetail',['id'=>$item['frame']->id,'slug'=>$item['frame']->slug]) !!}">{{ $item['frame']->name }}</a></p>
        <?php
            if($item['frame']->price_sale){
                $price_frame = $item['frame']->price_sale;
            }else{
                $price_frame = $item['frame']->price;
            }
            $price_frame = $price_frame;
            $total += $price_frame * $item['num'];
        ?>
        <p class="tan-font-RB" >
             <span class="amount">{{number_format( (int)$price_frame,0,'','.')}}đ x 
             <span id="d-num">{{$item['num']}}</span> </span>
        </p>
        <span class="pull-right x-search remove" data-frame="{!! $item['frame']->id !!}">×</span>
        <div style="clear :both"></div>
    </li>
    @endforeach
@endif