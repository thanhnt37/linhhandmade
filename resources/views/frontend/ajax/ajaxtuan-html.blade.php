@foreach($viewtt as $tuan271192)
    <div class="col-xs-6 col-sm-4 col-lg-4 col-12-mobile">
        <div class="d-sp d-sp-top text-center" style="margin-top: 35px;">
            <div class="moi">Mới</div>
            <img src="{{ asset($tuan271192->thumb_images) }}" alt="">
            <div class="absolute_img tan-bovien">
                <ul class="div_img">
                    <li class="tan-bovienpic"><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                    <li><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                    <li><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                </ul>
            </div>
            <p>{!! $tuan271192['name'] !!}</p>
            <p class="fontBold" style="color: #000;">{!! $tuan271192['price'] !!}đ</p>
        </div><!-- end of d-sp -->
    </div><!--/.col-xs-6.col-lg4-->
@endforeach