<div class="row row-content-responsive ">
@foreach($product as $data)
    <div class="col-xs-6 col-sm-4 col-lg-4 col-12-mobile">
        <div class="d-sp d-sp-top text-center" style="margin-top: 35px;">
            <div class="moi">
                @if($data->label == 0)   @endif
                @if($data->label == 1) Mới  @endif
                @if($data->label == 2) Koll  @endif
                @if($data->label == 3) Sale  @endif
            </div>
            <img src="{{ $data->thumb_images }}" alt="">
            <div class="absolute_img tan-bovien">
                <ul class="div_img">
                    <li class="tan-bovienpic"><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                    <li><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                    <li><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                </ul>
            </div>
            <p><a class="d-list-xem" data-id="{!! $data->id !!}" href="{!! Route('getProDetail',['id'=>$data->id,'slug'=>$data->slug]) !!}">{{ $data->name }}</a></p>
            <p class="fontBold" style="color: #000;"></p>
        </div><!-- end of d-sp -->
    </div><!--/.col-xs-6.col-lg-4--> 
@endforeach
</div><!--/row-->