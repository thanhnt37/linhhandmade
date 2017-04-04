@extends('frontend.layout')
@section('title',"Sản phẩm vừa xem")
@section('meta')
<meta name="description" content="Sản phẩm vừa xem">
@endsection

@section('menu')
 <div class="pull-left">
    <button type="button" class="navbar-toggle menu-catagory" data-target="#menu-catagory">
        <i class="fa fa-th-large" aria-hidden="true"></i>
    </button>
</div>
@endsection
@section('content')
<style type="text/css">
    @media (max-width: 413px) {
        .not_show{
            display: none !important;
        }
    }
    .abc.filter_click{
        display:none;
    }
    .can-le-fillter .abc{
        display: none
    }
    @media screen and (min-width: 768px) {
        .h-res-mar {height: 278px;}
    }
    .tan-ke-bottom{
        margin-right: 0%;
        width: 155px;
    }
    .name_img_filter{
        margin-bottom: 0px;
        font-size: 8pt !important;
        text-align: center !important;
    }
    .t-page::before{
        background: #75005f !important;
    }
    .t-page > a{
        color: #75005f;
    }

</style>
<div class="container container-responsive">
    @include('frontend.partials.banner')
    <div class="text-center d-1000x300">

    <?php $banner_item = App\Item::where('key_layout','Banner Vừa xem')->get();
        if(isset($banner_item[0])) $img_banner = asset($banner_item[0]->value);
        else $img_banner = "https://placeholdit.imgix.net/~text?txtsize=80&txt=1000%C3%97320&w=1000&h=320";
       
    ?>
        <img src="{{asset($img_banner)}}" alt="">
    </div>
    <!-- end of .d-1000x300 -->
               <!-- phần đường dẫn -->
    <section class="t_section_content_products">
        <div class="d_section_content_pr t_section_content_pr">
            <div class="row row-duongdan">
                <div>
                    <ul class="d_cate_products" style="border-top:0px !important;">
                        <li style="color:#7F7F83"><a href= "{!! url('') !!}" style="color:#7F7F83">Trang chủ</a></li>
                        <li style="color:#d6e9d7">/</li>
                       
                        <li id="d-123" data-id="50">Sản phẩm vừa xem</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end of phần đường dẫn -->
   
</div><!-- end of container -->
<div class="container main-content">
    <div class="row row-offcanvas row-offcanvas-left">
        @if(sizeof($products) ==0)
               <div class="col-md-12  d-item2" style="display:block; text-align: center; margin-top:60px;margin-bottom:30px;"><span style="font-size:10pt;font-family:Roboto">Bạn chưa xem qua sản phẩm nào</span><div style="background-color: #7b1fa2; line-height: 40px; border-radius: 4px; width: 200px; height: 40px; margin: auto; margin-top: 12px; margin-bottom: 27px;"><a style="color: #fff;font-size: 10pt;font-family:Roboto Bold;" href="{{url('')}}">Quay về trang chủ</a></div></div>
        @else
        <div class="button-offcanvas">
            <p class="pull-left visible-xs visible-sm">
                <button type="button" class="btn btn-primary btn-xs btn-offcanvas" data-toggle="offcanvas">
                    <img src="{{ asset('frontend/html/images/filter.svg') }}" alt="">
                </button>
            </p>
            <button type="button" class="visible-xs visible-sm d-btn-thapcao pull-right">
                <select name="" id="price_list">
                    <option value="0">Chọn khoảng giá</option>
                </select>
            </button>
        </div><!-- button off canvas --> 
        <div class="col-xs-6 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
                <div class="c-select">
                    <!--sọc kẻ fillter--> 
                    <div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
                    <div id="load_filter">
                            
                    </div>
                </div><!--end c-select-->
            </div><!-- end of list-group -->
        </div><!--/.sidebar-offcanvas-->
        <div class="col-xs-12 col-md-9" id="tuan" style="padding: 0;">
            <div class="d-dachon col-sm-12 " id="stag">
                @if(isset($stag_box))
                    {!!$stag_box!!} 
                @endif
            </div> <!-- end of d-dachon -->

            <div class="row row-content-responsive " id="d-ok">
            <?php $list_color = App\Filter::where('name','Màu Sắc')->get();
                $in_color = array();
                foreach ($list_color as $key => $value) {
                    array_push($in_color, $value->attribute_id);
                }    
            ?>
            @foreach($products as $key=> $data)
                    <?php $id_product = $data->product_id; $frame_str =  $data->frame_str;?>
                            <?php $list_frame = explode(",",$frame_str);
                              $in = array();
                              foreach ($list_frame as $key => $id_frame) {
                                  if($id_frame){
                                    array_push($in, $id_frame);
                                  }
                              }
                            $frame_y = App\Frame::whereIn('id',$in)->orderby('updated_at','desc')->get();

                            ?>

                    @if(sizeof($frame_y))
                        <div class="col-xs-6 col-sm-4 col-lg-4 col-12-mobile h-res-mar">
                            <div id="d-ajax" class="d-ajax_{!! $data->product_id !!} d-sp d-sp-top text-center " data-id="{!! $data->product_id !!}" style="margin-top: 15px;">
                                @if($frame_y[0]->label == 1)<div class="moi">Mới</div>@endif
                                @if($frame_y[0]->label == 2)<div class="kool">Kool</div>@endif
                                @if($frame_y[0]->label == 3)<div class="off">Sale</div>@endif
                                <a class="d-list-xem" data-id="{!! $frame_y[0]->id !!}" href="{!! Route('getProDetail',['id'=>$frame_y[0]->id,'slug'=>$frame_y[0]->slug]) !!}"><img src="{{ $frame_y[0]->img }}" alt=""></a>
                                <div class="absolute_img tan-bovien"> 
                                    <ul class="div_img">
                                    @foreach($frame_y as $key=> $item)
                                        @if($key > 2)
                                            <?php
                                                $attr_color = DB::table('frame_attributes')
                                                 ->whereIn('frame_attributes.attribute_id',$in_color)
                                                 ->where('frame_attributes.frame_id',$item->id)
                                                 ->leftjoin('filters','frame_attributes.attribute_id','=','filters.attribute_id')->first(); 
                                            ?> 
                                            @if($attr_color)
                                            @if(sizeof($frame_y) == 4)
                                                <li style="cursor:pointer;" class="@if($key == 0) tan-bovienpic @endif" id="d-ajax-fame" data-id="{!! $item->id !!}"><img   src="{!! $attr_color->img !!}"></li>
                                            @else 
                                                <li style="cursor:pointer; position:relative" class="@if($key == 0) tan-bovienpic @endif" id="d-ajax-fame" data-id="{!! $item->id !!}"><a href="{!! Route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" style="position: absolute;left: 0;top: 6px;" ><span style="display: inline-block;width: 17px;height: 17px;border: solid 1px #a3a3a3;border-radius: 50%;color: #a3a3a3;line-height: 15px;text-align: center;padding-left: 0px;margin-left: 2px;">+</span> </a> </li>
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
                                            <li style="cursor:pointer;" class="@if($key == 0) tan-bovienpic @endif" id="d-ajax-fame" data-id="{!! $item->id !!}"><img src="{!! $attr_color->img !!}"></li>
                                            @endif
                                        @endif
                                    @endforeach
                                    </ul>     
                                </div>
                                <p><a class="d-list-xem" data-id="{!! $data->product_id !!}" href="{!! Route('getProDetail',['slug'=>$frame_y[0]->slug,'id'=>$frame_y[0]->id]) !!}">{{ $frame_y[0]->name }}</a></p>
                                <p class="fontBold" style="color: #000;">

                                    @if($frame_y[0]->price_sale)
                                        <span class="catagory-sale">{!! number_format( $frame_y[0]->price,0,'','.' ) !!}đ</span>
                                        {!! number_format( $frame_y[0]->price_sale,0,'','.' ) !!}đ
                                    @else
                                        {!! number_format( $frame_y[0]->price,0,'','.' ) !!}đ
                                    @endif
                                </p>
                            </div><!-- end of d-sp -->
                        </div><!--/.col-xs-6.col-lg-4--> 
                            
                    @endif   
                    
                    @endforeach
            </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->
        @endif
    </div><!--/row-->
</div><!--/.container-->
<!-- page -->
@if(sizeof($products) !=0)
<div class="tan_page " id="d-ok-paginate" style="margin-top: 29px">
    <ul>
        <?php
          $link_limit = 7; 
        ?>
        <ul>
          <li><a  href="@if($products->currentPage() > 1) {{ $products->currentPage() -1 }} @endif " >Trước</a></li>
          @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <?php
                    $half_total_links = floor($link_limit / 2);
                    $from = $products->currentPage() - $half_total_links;
                    $to = $products->currentPage() + $half_total_links;
                    if ($products->currentPage() < $half_total_links) {
                       $to += $half_total_links - $products->currentPage();
                    }
                    if ($products->lastPage() - $products->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($products->lastPage() - $products->currentPage()) - 1;
                    }
                    ?>
                    @if ($from < $i && $i < $to)
                        <li class=" {{ ($products->currentPage() == $i) ? 't-page' : '' }}">
                            <a href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
          @endfor
          <li class="next"><a href="@if($products->currentPage() < $products->lastPage()) {{ $products->url($products->currentPage() + 1) }} @endif" >Sau</i></a></li>
        </ul>
        <!-- /.list-inline --> 
      </div>
    </ul>
</div><!-- end of page -->
@endif
@endsection
  @section('js')
    <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<!--Script click filter2-->
<script>
function price_show(){
    list_filter_radio = $('.t-filter2');
    p = 0;
    $.each(list_filter_radio,function(i,v){
        h4 = $(v).find("h4").first();
        div = $(v).find("div");
        if(h4){
            if( h4.text() == "Giá" ){
                p = 1;
                option = "<option value='0'>Chọn khoảng giá</option>";
                $.each(div,function(i2,v2){
                    id = $(v2).data('filter');
                    text =  $(v2).find('label').text();
                    if($(v2).hasClass('tan')){
                      option += '<option value="'+id+'" selected>'+text+'</option>'
                    }else{
                      option += '<option value="'+id+'">'+text+'</option>'
                    }
                });
                $("#price_list").html(option);
            };
        }
    });
    if( p == 0){
        option = "<option value='0'>Chọn khoảng giá</option>";
        $("#price_list").html(option); 
    }
} 

$.ajax({
    headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    type:"post",
    url:"{{route('load.filter.view')}}",
    data:{},
    success:function(data){
        // console.log(data);
        $('#load_filter').html(data.html);
        price_show();
    },
    dataType: 'json'
});
// ajax frame
$(document).on('click','.stag-close-tht',function(e){
        filter = $(this).parent().data('filter');
        $('.frame_tan[data-filter="'+filter+'"]').removeClass("frame_tan");
        $('.tan[data-filter="'+filter+'"]').removeClass("tan");
        x = $('.tan');
        filter_list = [];
        $.each(x,function(i, v){
            id = $(v).data('filter');
            if(id != undefined){   
                filter_list.push(id);
            }
        });
        frame = $('.frame_tan');
        $.each(frame,function(i, v){
            id = $(v).data('filter');
            if(id != undefined){   
                filter_list.push(id);
            }
        });
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type:"post",
            url:"{{route('load.filter.click.view')}}",
            data:{'list':filter_list},
            success:function(data){
              console.log(data);
              $('#load_filter').html(data.view);
              $('#d-ok').html(data.product_view);
              $('#d-ok-paginate').html(data.product_paginate);
              $('#stag').html(data.stag_box);
              price_show();
            },
            dataType:'json'
        });
});
$(document).on('click','.filter_click',function(e){
    e.preventDefault();
    // get order  => nếu có thì push biến orderby vào ajax
    if($(this).hasClass('abcd')){
        $(this).parent().toggleClass('tan-bovienpic');
        $(this).parent().toggleClass('frame_tan');
    }
    $(this).parent().parent().toggleClass('tan');
    x = $('.tan');
    filter_list = [];
    $.each(x,function(i, v){
        id = $(v).data('filter');
        if(id != undefined){   
            filter_list.push(id);
        }
    });
    frame = $('.frame_tan');
    $.each(frame,function(i, v){
        id = $(v).data('filter');
        if(id != undefined){   
            filter_list.push(id);
        }
    });
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
        },
        type:"post",
        url:"{{route('load.filter.click.view')}}",
        data:{'list':filter_list},
        success:function(data){
          console.log(data);
          $('#load_filter').html(data.view);
          $('#d-ok').html(data.product_view);
          $('#d-ok-paginate').html(data.product_paginate);
          $('#stag').html(data.stag_box);
          price_show();
        },
        dataType:'json'
    });
});
 $(document).on('change','#price_list',function(){
    id = $(this).find(":selected").val();
    // console.log(id);
    filter_list = [];
    if(id !=0 ){
        filter_list.push(id);
    }
    x = $('.tan');
    $.each(x,function(i, v){
        id = $(v).data('filter');
        if(id != undefined){   
            filter_list.push(id);
        }
    });
    frame = $('.frame_tan');
    $.each(frame,function(i, v){
        id = $(v).data('filter');
        if(id != undefined){   
            filter_list.push(id);
        }
    });
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
        },
        type:"post",
        url:"{{route('load.filter.click.view')}}",
        data:{'list':filter_list},
        success:function(data){
          console.log(data);
          $('#load_filter').html(data.view);
          $('#d-ok').html(data.product_view);
          $('#d-ok-paginate').html(data.product_paginate);
          $('#stag').html(data.stag_box);
           price_show();
        },
        dataType:'json'
    });        
});

$(document).on('click','.d-ajax-click-load-filter',function(e){
    e.preventDefault();
    page = $(this).data('page');
    x = $('.tan');
    filter_list = [];
    $.each(x,function(i, v){
        id = $(v).data('filter');
        if(id != undefined){   
            filter_list.push(id);
        }
    });
    frame = $('.frame_tan');

    $.each(frame,function(i, v){
        id = $(v).data('filter');
        if(id != undefined){   
            filter_list.push(id);
        }
    });
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
        },
        type:"post",
        url:"{{route('load.filter.click.view')}}",
        data:{'list':filter_list,'page':page},
        success:function(data){
          console.log(data);
          $('#load_filter').html(data.view);
          $('#d-ok').html(data.product_view);
          $('#d-ok-paginate').html(data.product_paginate);
          $('#stag').html(data.stag_box);
        },
        dataType:'json'
    });
});
// ajax frame
 $(document).on('click','.optradio1',function(e){
    var a = $(this).val();
    console.log(a);
    e.preventDefault();
    $(this).toggleClass('tan');
    x = $('.tan');
    filter_list = [];
    $.each(x,function(i, v){
        id = $(v).data('filter');
        if(id != undefined){   
            filter_list.push(id);
        }
    });
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
        },
        type:"post",
        url:"{{route('load.filter.click.view')}}",
        data:{'list':filter_list,'order_by':a},
        success:function(data){
          console.log(data);
          $('#load_filter').html(data.view);
          $('#d-ok').html(data.product_view);
          $('#d-ok-paginate').html(data.product_paginate);
        },
        dataType:'json'
    });
}); 

    //
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
        absolute_img = $('.d-ajax_'+id_product+ " .absolute_img").html();
        $('.d-ajax_'+id_product).html(data.html);
        $('.d-ajax_'+id_product+ " .absolute_img").html(absolute_img);
        $('.d-ajax_'+id_product).find('li').removeClass('tan-bovienpic');
        $('.d-ajax_'+id_product+ " li[data-id='"+id+"']").addClass('tan-bovienpic');
    },
    cache:false,
    dataType: 'json'
    });
});
</script>
<script>
    $(".div_img li").click(function(){
        $(this).parent().find(".tan-bovienpic").removeClass("tan-bovienpic");
        $(this).addClass("tan-bovienpic");
    });
</script>
<!-- Visible menu catagory -->
<script>
    $("button.menu-catagory").click(function() {
        $(".t-catagory").toggleClass("t-catagory-visible");
    });
</script>
<!-- click slide down small menu catagory -->
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
<!-- filter1 -->

@endsection
