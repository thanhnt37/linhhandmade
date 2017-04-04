@if($frame->label == 1)<div class="moi">Mới</div>@endif
@if($frame->label == 2)<div class="kool">Kool</div>@endif
@if($frame->label == 3)<div class="off">Sale</div>@endif
<?php $list_color = App\Filter::where('name','Màu Sắc')->get();
    $in_color = array();
    foreach ($list_color as $key => $value) {
        array_push($in_color, $value->attribute_id);
    }    
?>

<a class="d-list-xem"  data-id="{!! $product->id !!}" href="{!! Route('getProDetail',['id'=>$frame->id,'slug'=>$frame->slug]) !!}" >
    <img src="{{ $frame->img }}" alt="">
</a>
<div class="absolute_img tan-bovien"> 
    <ul class="div_img">
    @foreach($frame_filter as $key => $item)   
        @if($key > 2)
            <?php
                $attr_color = DB::table('frame_attributes')
                 ->whereIn('frame_attributes.attribute_id',$in_color)
                 ->where('frame_attributes.frame_id',$item->id)
                 ->leftjoin('filters','frame_attributes.attribute_id','=','filters.attribute_id')->first(); 
            ?> 
            @if($attr_color)
            @if(sizeof($frame_filter) == 4)
                 <li style="cursor:pointer;" id="d-ajax-fame" class="@if($item->id == $frame->id) tan-bovienpic @endif" data-id="{!! $item->id !!}"><img src=" {!! $attr_color->img !!}"></li>
            @else 
                 <li style="cursor:pointer; position:relative" id="d-ajax-fame" class="@if($item->id == $frame->id) tan-bovienpic @endif" data-id="{!! $item->id !!}"><a style="position: absolute;left: 0;top: 6px;"   href="{!! Route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" > <span style="display: inline-block;width: 17px;height: 17px;border: solid 1px #a3a3a3;border-radius: 50%;color: #a3a3a3;line-height: 15px;text-align: center;padding-left: 0px;margin-left: 2px;">+</span>  </a> </li>
                <?php break; ?>
            @endif
            @endif
        @else
             <?php
                 $attr_color = DB::table('frame_attributes')
                 ->whereIn('frame_attributes.attribute_id',$in_color)
                 ->where('frame_attributes.frame_id',$item->id)
                 ->leftjoin('filters','frame_attributes.attribute_id','=','filters.attribute_id')->first(); 
                ?> 
            @if($attr_color)
                <li style="cursor:pointer;" id="d-ajax-fame" class="@if($item->id == $frame->id) tan-bovienpic @endif" data-id="{!! $item->id !!}"><img src=" {!! $attr_color->img !!}"></li>
            @endif  
        @endif                                
                                             
    @endforeach
    </ul>     
</div>
<p><a class="d-list-xem" data-id="{!! $product->id !!}" href="{!! Route('getProDetail',['id'=>$frame->id,'slug'=>$frame->slug]) !!}">{{ $frame->name }}</a></p>
<p class="fontBold" style="color: #000;">
    @if($frame->price_sale)
        <span class="catagory-sale">{!! number_format( $frame->price,0,'','.' ) !!}đ</span>
        {{ number_format($frame->price_sale,0,'','.') }}đ
    @else
        {{ number_format($frame->price,0,'','.') }}đ
    @endif
</p>