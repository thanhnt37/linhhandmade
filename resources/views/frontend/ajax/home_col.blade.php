<div id="home" class="tab-pane fade in active">
    <div id="demo">
        <div class="span12">
            <div id="owl-demo2" class="owl-carousel ">
                @foreach($product as $item)
                    <div class="item">
                        <a href="{!! Route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" style="display: block;">
                        <div class="home-bottom-img">
                            <img src="{!! $item->img !!}" alt="Owl Image"  style="height:auto;padding:20px">
                        </div>
                        <p><a  href="{!! Route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" style="display: block;">{!! $item->name !!}</a></p>
                        @if($item->price_sale)
                            <p><span class="home-sale">{!! number_format((int)$item->price,0,'.','') !!}đ</span>{!! number_format((int)$item->price_sale,0,'.','') !!}đ</p>
                        @else
                            <p>{!! number_format((int)$item->price,0,'','.') !!}đ</p>
                        @endif
                        </a>
                    </div><!-- end of item -->
                @endforeach
            </div><!-- end of owl-carousel -->
        </div>
    </div>
</div><!-- end of catagory 1 -->