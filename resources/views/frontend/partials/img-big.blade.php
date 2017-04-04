<section class="t-banner">
    <div style="text-align:center">
    <?php $logo_item = App\Item::where('key_layout','Logo Trang chủ')->get();

    if(isset($logo_item[0])) $img_logo = asset($logo_item[0]->value);
    else $img_logo = asset('frontend/img/lhm.png');
    ?>

       <a href="{!! url('') !!}"> <img src="{{$img_logo}}"/></a>
    </div>
</section>