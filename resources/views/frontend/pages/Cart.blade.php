@extends('frontend.layout')
@section('title','Cart')
@section('css')
<link rel="stylesheet" href="{{asset ('frontend/html/css/linhhandmade-cart.css')}}" />
 <style type="text/css">
    @media (min-width:992px){.t-catagory{display:none}}
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
<style>
    .d-district{
    display: none;
    }
    .d-item2{
    display: none;
    }
    #d-phi-gam{
        display: none !important; 
    }
</style>
<!-- phần đường dẫn -->
@include('frontend.partials.banner')
<section class="t_section_content_products">
    <div class="container d_section_content_pr t_section_content_pr">
        <div class="row">
            <div class="col-md-12">
                <ul class="d_cate_products">
                    <li style="color:#7F7F83"><a href= "{!! url('') !!}" style="color:#7F7F83">Trang chủ</a></li>
                    <li style="color:#d6e9d7">/</li>
                    <li style="color:#"><a href="" style="color:#" href="">Giỏ hàng</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--Hết phần đường dẫn-->
<!--Phần nội dung chính-->
<section class="d-margin-header" style="padding:30px 0px;padding-bottom:0px" >
    <Div class="container">
        <div class="row show_cart">
            <?php 
                $list_pro = Session::get('product');
                $total = 0;
                $total_weight = 0;
                ?>
            @if(sizeof($list_pro)==null)
            <div class="col-md-12  d-item2" style="display:block; text-align: center;">
                <span style="font-size:9.5pt;font-family:Roboto">Không có sản phẩm nào trong giỏ hàng của bạn</span>
                <div style="background-color: #7b1fa2; line-height: 40px; border-radius: 4px; width: 150px; height: 40px; margin: auto; margin-top: 12px; margin-bottom: 27px;">
                    <a style="color: #fff;font-size: 10pt;font-family:Roboto Bold;text-transform: uppercase; " href="{!! route('view.category') !!}">Tiếp tục mua hàng</a>
                </div>
            </div>
            @else		
            <div class="col-md-8 d-item1">
                <div>
                    <table class="table shop-cart text-center t-table">
                        <thead>
                            <tr>
                                <th class="t-pd-left-big text-left t-pd-left-big-db" style="padding-bottom:16px;padding-left: 10px !important;">Sản phẩm</th>
                                <th class="text-left t-pd-left-big t-pd-left-big-sl" style="padding-bottom:18px;">Số lượng</th>
                                <th class="text-left t-pd-left-big t-pd-left-big-tt" style="padding-bottom:18px;">Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="t-tbody">
                            @if($list_pro)
                            @foreach($list_pro as $key => $item)
                            <tr id="d-list-shopingcart" class="class_{!! $item['frame']->id !!} !!}" data-id="{!! $item['frame']->id !!}">
                                <td class="product-thumbnail t-td-img text-left" style="padding-top: 19px;width:205px">
                                    <a href="{!! route('getProDetail',['id'=>$item['frame']->id,'slug'=>$item['frame']->slug]) !!}"><img src="{{ $item['frame']->img }}" alt="" ></a>
                                </td>
                                <td class="t-td-sl text-left">
                                    <div class="t-padding-10">
                                        <div class="t-ten-gia">
                                            <p>{!! $item['frame']->name !!}</p>
                                            <span>
                                            <?php    
                                                if($item['frame']->price_sale){
                                                    $price_frame = $item['frame']->price_sale;
                                                }else{
                                                	$price_frame = $item['frame']->price;
                                                }
                                                $price_frame = $price_frame;
                                                $total += $price_frame * $item['num'];
                                                $weight_frame = $item['frame']->weight;
                                                $weight_frame = $weight_frame;
                                                $total_weight += $weight_frame * $item['num'];
                                                $num = $item['num'];
                                                ?>
                                            <span class="amount" data-value="{{$price_frame}}">{{number_format( (int)$price_frame,0,'','.')}}đ
                                                <span id="d-gam" class="d-gam_{!! $item['frame']->id !!}" data-value="{{ (float)$weight_frame }}" > / {{ (float)$weight_frame*$num }} 
                                                    <span style="font-family: 'Roboto';">gam</span>
                                                </span>
                                            </span>
                                            <br>
                                            
                                        </div>
                                        <div class="select-style t-select-style med-input shop-shorting shop-shorting-cart no-border-round d-select" data-frame="{!! $item['frame']->id !!}" style="background-size: 12px 12px">
                                            <select class="pro-select">
                                            @for($i=1;$i<= $item['frame']->sku;$i++)
                                                @if( $i< 10)
                                                    <option @if( $num== $i) selected @endif value="{{$i}}">0{{$i}}</option>
                                                @else
                                                    <option @if( $num== $i) selected @endif value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-subtotal text-left t-gia-gio"><span id="d-total">{{ number_format((int)($price_frame*$num),0,'','.') }}đ </span></td>
                                <td class="product-remove q-padding-bot-2 text-center" style="vertical-align: 150px; padding-top: 8px;">
                                    <span id="d-del-cart" data-frame="{!! $item['frame']->id !!}" style="font-size:15pt;color:#7f7f7f;cursor:pointer;">
                                    ×
                                    </span>
                                </td>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
                </Div>
            </div>
            <div class="col-md-4 d-item1">
                <div class="t-cart-form">
                    <form id="d-form-cart">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div>
                            <table>
                                <tr>
                                    <td><span>Tổng tiền</span></td>
                                    <td class="text-right"><span id='total' value="{!! $total !!}">{{number_format( (int)$total,0,'','.')}}đ</span></td>
                                </tr>
                                <tr>
                                    <td><span>Tổng khối lượng</span></td>
                                    <td class="text-right"><span id='total_weight' value="{!! $total_weight !!}">{!! $total_weight !!} gam</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="t-sel-ct" style="padding-bottom: 15px;">
                            <div class="select-style t-select-style med-input shop-shorting shop-shorting-cart no-border-round " id="d-an" style="background-size: 10px 10px" >
                                <?php $province = App\Province::orderBy('type','asc')->orderBy('name','asc')->get(); ?>
                                <select class="d-list-province" required>
                                    <option class="q-ft-option" value="0" data-id="0">Chọn Tỉnh , Thành Phố</option>
                                    @foreach($province as $item)
                                    <option class="q-ft-option" value="{!! $item->id !!}" required>{!! $item->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select-style t-select-style med-input shop-shorting no-border-round d-district" style="background-size: 10px 10px;width:100%;" >
                                <select class="d-district-list" required>
                                </select>
                            </div>
                            <div>
                                <table>
                                    <tr id="d-phi-gam" style="display:none;">
                                        <td><span>Phí quận huyện</span></td>
                                        <td class="text-right d-phi-gam2"></td>
                                    </tr>
                                    <tr>
                                        <td><span>Phí vận chuyển</span></td>
                                        <td class="text-right d-transpost1"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div>
                            <table>
                                <tr class="t-total-cart">
                                    <td><span>Tổng đơn hàng</span></td>
                                    <td class="text-right"><span id="all-total">{{ number_format((int)$total,0,'','.') }}đ</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-tb" style="color:#C9322E;font-family: Roboto;margin-top: 14px; "></div>
                        <div class="t-btn"><a class="d-click" href="{!! route('get.oder') !!}" style="cursor:pointer;" >Đặt hàng</a></div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!--Phần nội dung chính-->
@endsection
@section('js')
<script>
    $(document).on('change','.d-select',function(){
      money = $(this).parent().children('.t-ten-gia').find('.amount').data('value');
      num = $(this).children('.pro-select').find(':selected').val();
      tamp1 =  $(this).parent().parent().next();
      id_frame = $(this).data('frame');
      transpost = $('.d-district-list').find(':selected').data('id');
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
        url:"{{route('ajax.total.product')}}",
        data:{'num':num,'id_frame':id_frame,'transpost':transpost},
        success:function(data){
        	gam = $('.d-gam_'+id_frame).data('value');
        	// console.log(data);
            all1=parseFloat(money)*num;
            $('#d-num').text(num);
            all1 = (all1 + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            $(tamp1).find('#d-total').text(all1 +" đ");
            $('#total').attr('value',parseFloat(data.text)).text((data.text + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
            allgam = parseFloat(gam)*num;
            $('.d-gam_'+id_frame).text("/ "+allgam+" gam").attr('value',allgam);
            
            $('#total_weight').text(data.total_weight+" gam").attr('value',data.total_weight);
            
            // -----
            if(data.district == null){
            	$('#all-total').text((data.text + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
            }else{
            	// tonggam = $('#total_weight').attr('value');
            	// tongphivanchuyen = parseFloat(transpost)*parseFloat(tonggam);
            	$('.d-transpost1').text((parseInt(data.some) + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + "đ");
            	data1 = parseInt(data.text) + parseInt(data.some);
            	$('#all-total').text((data1 + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
            }

        },
        cache:false,
        dataType: 'json'
      });
     });
    
    $(document).on('change','.d-list-province',function(){
         id = $(this).val();
         weigh = parseFloat($('#total_weight').text());
         container = $(this).parent().next().find('.d-district-list');
         // console.log(price);
          $.ajax({
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
             },
             type:"post",
             url:"{{route('ajax.province.fronted')}}",
             data:{'id':id,'weigh':weigh},
             success:function(data){
               // console.log(data);
               $('.d-district').show();
               $(container).html(data.html);
               if(data.id == 0){
                 $('.d-district').hide();
               }
             },
             cache:false,
             dataType: 'json'
           });
           
         });
    $(document).on('change','.d-district',function(){
      price = $(this).children('.d-district-list').val();
      price1 = (price + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
      all = $('#total').attr('value');
      transpost = $(this).next().find('.d-transpost1');
      // gam = $('#total_weight').attr('value');
      $('#d-phi-gam').css('display','table-row').find('.d-phi-gam2').text(price1+"đ/1gam");
      tongphivanchuyen = parseFloat(price);
      $(transpost).text((parseInt(tongphivanchuyen) + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + "đ");
        total = parseFloat(tongphivanchuyen) + parseFloat(all); 
        $('#all-total').text((parseInt(total) + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
    });
    
    $(document).on('click','.d-click',function(e){
    	e.preventDefault();
    	id_link = $('.d-district-list').find(':selected').data('id');
    	link = $(this).attr('href')+"?district="+id_link;
    	value = $('.d-list-province').val();
    	value1 = $('.d-district-list').val();
    	 if(value == 0){
    	 	$('.d-tb').text('Xin Vui Lòng Chọn Tỉnh hoặc Thành Phố');	
    	 }else{
    	 	if(value1 == -1) {
    	 		$('.d-tb').text('Xin Vui Lòng Chọn Quận hoặc Huyện');
    	 	}else{
    	 		window.location = link;
    	 	}	
    	 }
    });
    
    $(document).on('click','#d-del-cart',function(){
    	id_frame = $(this).data('frame');
    	container = $(this).parent().parent();
    	transpost = $('.d-district-list').find(':selected').data('id');
    	show_cart = '<div class="col-md-12  d-item2" style="display:block; text-align: center;">'+
			'<span style="font-size:9.5pt;font-family: Roboto">Không có sản phẩm nào trong giỏ hàng của bạn.</span>'+
			'<div style="background-color: #7b1fa2; line-height: 40px; border-radius: 4px; width: 150px; height: 40px; margin: auto; margin-top: 12px; margin-bottom: 27px;">'+
				'<a style="color: #fff;font-size: 10pt;font-family:Roboto Bold;text-transform: uppercase;" href="{!! route('view.category') !!}">Tiếp tục mua hàng</a>'+
			'</div>'+
		'</div>';
    	$.ajax({
            headers: {
            	  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type:"post",
            url:"{{route('ajax.del.cart')}}",
            data:{'id_frame':id_frame,'transpost':transpost},
            success:function(data){
            	$(container).remove();
            	$('#total').text((data.text + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ").attr('value',data.text);
            	$('#total_weight').text(data.text_weight+" gam").attr('value',data.text_weight);
            	num = $('.l_cart2').text() - 1;
            	$('.l_cart2').text(num);
            	$('#d-hover').attr('data-size',num);
            	id_li = $('#d-list-cart-ajax').data('id');
            	if(id_frame){
            		$('.classli_'+id_frame).remove();
            	}else{
            		$('.classli_'+id).remove();
            	}
            	if(data.text == 0){
            		$('.show_cart').html(show_cart);
            	}
                if(data.district == null){
                    $('#all-total').text((data.text + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
                }else{
                    if(data.text == 0){
                        $('.show_cart').html(show_cart);
                    }
                    $('.d-transpost1').text((parseInt(data.some) + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + "đ");
                    data1 = parseInt(data.text) + parseInt(data.some);
                    $('#all-total').text((data1 + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
                }
            },
            cache:false,
            dataType: 'json'
            });
    });
    
</script>
<script>
             $("button.menu-catagory").click(function() {
                $(".t-catagory").toggleClass("t-catagory-visible");
            });
            $(document).ready(function() {
                $(".t-hover-catagory").click(function() {
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
@endsection