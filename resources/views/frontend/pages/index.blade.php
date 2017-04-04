@extends('frontend.layout')
@section('title','Linhhandmade')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/html/css/d-catagory.css') }}">
    <link rel="stylesheet" href="{!! asset('frontend/html/css/home.css') !!}">
    <style type="text/css">
        #owl-demo2 .owl-pagination{
            display: none;
        }
    </style>
@endsection
@section('menu')
 <div class="pull-left">
    <button type="button" class="navbar-toggle menu-catagory" data-target="#menu-catagory">
        <i class="fa fa-th-large" aria-hidden="true"></i>
    </button>
</div>
@endsection
@section('content')

<div class="container container-responsive">
    @include('frontend.partials.banner')
    <div class="text-center d-1000x300">
        <div id="demo">
            <!-- <div class="span12"> -->
                <?php $slide_trang_chu = App\Slide::where('type','Slide Trang chủ')->where('status',1)->get(); ?>

                <div id="slide-header" class="owl-carousel duyanlon">
                    @if(sizeof($slide_trang_chu) ==0)
                        <div class="item">
                            <img src="https://placeholdit.imgix.net/~text?txtsize=69&txt=970%C3%97274&w=970&h=274" alt="">
                        </div>
                        <div class="item">
                            <img src="https://placeholdit.imgix.net/~text?txtsize=69&txt=970%C3%97274&w=970&h=274" alt="">
                        </div>
                        <div class="item">
                            <img src="https://placeholdit.imgix.net/~text?txtsize=69&txt=970%C3%97274&w=970&h=274" alt="">
                        </div>
                    @else
                        @foreach($slide_trang_chu as $key =>$value)
                        <div class="item">
                            <img src="{{asset($value->img_1)}}" alt="">
                        </div>
                        @endforeach
                    @endif
                </div><!-- end of owl-carousel -->
            <!-- </div>end of span12 -->
        </div><!-- end of demo slide -->
    </div>
    <!-- end of .d-1000x300 -->
</div><!-- end of container -->
<div class="container main-content">
            <div class="row">
                <section class="home-top">
                    <div class="row">
                        <div class="col-sm-6 text-center home-top-left">
                            <p>Lọc theo màu sắc</p>
                            <?php $slide_mau_sac= App\Slide::where('type','Màu sắc')->where('status',1)->get(); ?>
                            <form role="form" class="text-center">
                                <ul>
                                    @if(sizeof($slide_mau_sac) ==0)
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=37%C3%9737&w=37&h=37" alt="" width="37" height="37"></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=37%C3%9737&w=37&h=37" alt=""  width="37" height="37"></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=37%C3%9737&w=37&h=37" alt=""  width="37" height="37"></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=37%C3%9737&w=37&h=37" alt=""  width="37" height="37"></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=37%C3%9737&w=37&h=37" alt=""  width="37" height="37"></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=37%C3%9737&w=37&h=37" alt=""  width="37" height="37"></a></li>
                                    @else
                                        @foreach($slide_mau_sac as $key =>$value)
                                        <li><a href="//{{$value->link_1}}"><img src="{{asset($value->img_1)}}" alt=""  width="37" height="37"></a></li>
                                        @endforeach
                                    @endif
                                   
                                </ul>
                            </form>
                        </div><!-- end of col-sm-6 -->
                        <div class="col-sm-6 text-center home-top-right">
                            <p>Lọc theo chất liệu</p>
                            <?php $slide_chat_lieu= App\Slide::where('type','Chất liệu')->where('status',1)->get(); ?>
                            <form role="form" class="text-center">
                                <ul>
                                    
                                    @if(sizeof($slide_chat_lieu) ==0)
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64" alt=""></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64" alt=""></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64" alt=""></a></li>
                                        <li><a href=""><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64" alt=""></a></li>
                                    @else
                                        @foreach($slide_chat_lieu as $key =>$value)
                                        <li><a href="//{{$value->link_1}}"><img src="{{asset($value->img_1)}}" alt=""></a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </form>
                        </div><!-- end of col-sm-6 -->
                    </div><!-- end of row -->
                </section><!-- end of Home-Top -->
                <section class="home-center">
                       <div class="row">
                            <?php $four_pic =  App\Item::where('key_layout','4 Ảnh trang chủ')->get();?>
                            @foreach($four_pic as $key =>$item)
                            <div class="col-xs-6 col-sm-3">
                                <a href="//{{$item->link}}">
                                    <img src="{{asset($item->value)}}" alt="" style="border-radius:4px;">
                                </a>
                            </div>
                            @endforeach
                       </div>
                </section><!-- end of home-center -->
                <section class="home-bottom" style="padding-bottom:39px">
                    <ul class="nav nav-tabs" style="margin-bottom:-35px">
                        <li class="active">
                            <a id="d_new" data-id="1" style="cursor:pointer;">New</a>
                            <i id="d_new1" class="fa fa-sort-desc" aria-hidden="true"></i>
                        </li>
                        <li>
                            <a id="d_coll" data-id="2" style="cursor:pointer;">Kool</a>
                            <i id="d_coll1" class="fa fa-sort-desc" aria-hidden="true"></i>
                        </li>
                        <li>
                            <a id="d_sale" data-id="3" style="cursor:pointer;">Sale</a>
                            <i id="d_sale1" class="fa fa-sort-desc" aria-hidden="true"></i>
                        </li>
                    </ul>
                    <?php 
                        $product = App\Frame::where('label',1)->where('status',1)->orderby('created_at','desc')->limit(8)->get();    
                    ?>
                    <div class="tab-content d_status">
                        <div id="home" class="tab-pane fade in active">
                            <div id="demo">
                                <div class="span12">
                                    <div id="owl-demo2" class="owl-carousel ">
                                        @foreach($product as $item)
                                            <div class="item">
                                                <a href="{!! Route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" style="display: block;">
                                                <div class="home-bottom-img">
                                                    
                                                    <img src="{!! $item->img !!}" style="height:auto;padding:20px" alt="Owl Image">
                                                    
                                                </div>
                                                <p><a href="{!! Route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" >{!! $item->name !!}</a></p>
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
                    </div><!-- end of tab-content-->
                </section><!-- end of home-bottom -->
            </div>
        </div><!--/.container-->


@endsection
  @section('js')
    <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<!--Script click filter2-->
<script>

$(document).on('click','#d_coll',function(e){
    e.preventDefault();
    status = $(this).data('id');
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
         url:"{{route('ajax.home.coll')}}",
        data:{'status':status},
        success:function(data){
            $('.d_status').html(data.html);
            $("#owl-demo2").owlCarousel({
                autoPlay: 3000,
                items : 4,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                // Navigation
                navigation : true,
                 navigationText: ["<img  class='taokhongbiet taokhongbiet1' src='{{asset('frontend/img/back.svg')}}' alt=''>","<img  class='taokhongbiet taokhongbiet2' src='{{asset('frontend/img/next.svg')}}' alt=''>"],
                  
                // pagination : true
              });
        },
        cache:false,
        dataType: 'json'
    });
});

$(document).on('click','#d_new',function(e){
    e.preventDefault();
    status = $(this).data('id');
    console.log(status);
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
         url:"{{route('ajax.home.new')}}",
        data:{'status':status},
        success:function(data){
            $('.d_status').html(data.html);
            $("#owl-demo2").owlCarousel({
                autoPlay: 3000,
                items : 4,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                // Navigation
                navigation : true,
                // pagination : true
                 navigationText: ["<img  class='taokhongbiet taokhongbiet1' src='{{asset('frontend/img/back.svg')}}' alt=''>","<img  class='taokhongbiet taokhongbiet2' src='{{asset('frontend/img/next.svg')}}' alt=''>"],
              });
        },
        cache:false,
        dataType: 'json'
    });
});

$(document).on('click','#d_sale',function(e){
    e.preventDefault();
    status = $(this).data('id');
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
         url:"{{route('ajax.home.sale')}}",
        data:{'status':status},
        success:function(data){
            $('.d_status').html(data.html);
            $("#owl-demo2").owlCarousel({
                autoPlay: 3000,
                items : 4,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                // Navigation
                navigation : true,
                // pagination : true
                 navigationText: ["<img  class='taokhongbiet taokhongbiet1' src='{{asset('frontend/img/back.svg')}}' alt=''>","<img  class='taokhongbiet taokhongbiet2' src='{{asset('frontend/img/next.svg')}}' alt=''>"],
              });
        },
        cache:false,
        dataType: 'json'
    });
});

// ajax frame

$(document).on('click','#d-ajax-fame',function(){
    id = $(this).data('id');
    id_product = $(this).parent().parent().parent().attr('data-id');
    // alert(id_product);
    container = $(this);
    $.ajax({
    headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    type:"post",
    url:"{{route('ajax.frame.category')}}",
    data:{'id':id,'id_product':id_product},
    success:function(data){
        
        console.log(data);
        $('.d-ajax_'+id_product).html(data.html);
    },
    cache:false,
    dataType: 'json'
    });
});
    $(document).ready(function(){
        $(".t-filter3 li").click(function(){
        $(".t-filter3").find(".tan-bovienpic").removeClass("tan-bovienpic");
        $(this).addClass("tan-bovienpic");
    })
    });
</script>
<!--hết Script click filter2-->
<!--filter 1-->

<script>
    $(document).ready(function() {
        $(".t-hover-catagory").click(function() {
            //$('.t-hover-catagory').removeClass('category-active');
            list = $('.t-hover-catagory');
            click = this;
            $.each(list,function(i,v){
                if(v !== click) {
                    $(v).removeClass('category-active');
                }
            });
            $(this).toggleClass('category-active');
            // var ul = $(this).find('.t-sub-mn');
            // $('.t-sub-mn').slideUp('fast');
            // if(ul){
            //     $(ul).slideDown("fast");
            // }
            
        });
    });
    $(document).mouseup(function (e)
    {
        var container = $(".t-catagory");
        var icon = $(".menu-catagory");
        
        if (!icon.is(e.target) // if the target of the click isn't the container...
            && icon.has(e.target).length === 0) // ... nor a descendant of the container
        {}else{
            return false;
        }

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $(".t-catagory").removeClass('t-catagory-visible'); 
        }
    });
    
</script>
    <!-- Tab bootstrap -->
        <script>
            $(document).ready(function(){
                $(".nav-tabs a").click(function(){
                    $(this).tab('show');
                });
            });
        </script>
        <!-- Owl slide header -->
        <script>
            $(document).ready(function() {
              $("#slide-header").owlCarousel({
                autoPlay: 3000,
                items : 1,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                pagination : true,
                // navigation : true,
                // navigationText: ["<img  class='taokhongbiet taokhongbiet1' src='{{asset('frontend/img/back.svg')}}' alt=''>","<img  class='taokhongbiet taokhongbiet2' src='{{asset('frontend/img/next.svg')}}' alt=''>"],
              });
            
            });
        </script>
        <!-- Owl slide -->
        <script>
            $(document).ready(function() {
              $("#owl-demo2").owlCarousel({
                autoPlay: 3000,
                items : 4,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                // Navigation
                navigation : true,
                navigationText: ["<img  class='taokhongbiet taokhongbiet1' src='{{asset('frontend/img/back.svg')}}' alt=''>","<img  class='taokhongbiet taokhongbiet2' src='{{asset('frontend/img/next.svg')}}' alt=''>"],
                // pagination : true
              });
            
            });
        </script>
        <!-- add next... slide -->
        <script>
        $(document).ready(function() {
            $('#owl-demo2 .owl-next').append('<i class="home-bottom-next fa fa-angle-right" aria-hidden="true"></i>');
            $('#owl-demo2 .owl-prev').append('<i class="home-bottom-prev fa fa-angle-left" aria-hidden="true"></i>');
        });
        </script>
        <script>
            $("button.menu-catagory").click(function() {
                $(".t-catagory").toggleClass("t-catagory-visible");
            });
        </script>

@endsection
