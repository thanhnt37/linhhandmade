@extends('frontend.layout')
@section('title','Oder')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/html/css/oder.css') }}">
     <style type="text/css">
        @media (min-width:992px){.t-catagory{display:none}}
        @media(max-width: 736px){
            .t-popup2{
                width: 80%;
            }
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
@include('frontend.partials.banner')
@include('frontend.partials.link')
<div class="content">
    <div class="container">
        <div class="row show_cart">
            <div>
                <div class="col-md-8 tan-title">
                    <p>Thông tin Đơn hàng</p>
                    <div>
                        <form id="form_order">
                        <input type="hidden" name="id_district" value="{!! $district->id !!}">
                            <div class="tan-form">
                                <div>
                                    <input class ="t-form" type="text" name="name" placeholder="Họ tên" >
                                </div>
                                <div>
                                    <input type="text" name="phone" required  placeholder="Số điện thoại liên hệ" >
                                </div>
                                <div>
                                    <input type="text" name="email"  placeholder="Email" >
                                </div>
                                <div>
                                    <textarea name="note" placeholder="Ghi chú thêm..." style="padding-bottom: 0px; padding-top: 6px;"></textarea>
                                </div>
                                <div>
                                    <input style="padding-top: 5px;" type="text" name="address" value="" placeholder="Địa chỉ nhận hàng" >
                                </div>
                            </div>
                            <div>
                                <div class="radio tan-submit">
                                    <?php $dieu_khoan = App\Item::where('key_layout','Điều khoản')->get();?>
                                    @if(isset($dieu_khoan[0])) 
                                        <label class="tan-label"><input type="radio" class="t-radio" name="optradio" /><a href="//{{$dieu_khoan[0]->link}}" target="_blank">Tôi đồng ý với điều khoản mua hàng</a></label>
                                    @else
                                        <label class="tan-label"><input type="radio" class="t-radio" name="optradio" />Tôi đồng ý với điều khoản mua hàng</label>
                                    @endif
                                </div>
                                <div class="tan-submit-font">
                                    <input type="submit"  value="Xác nhận" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php $list_pro = Session::get('product');
                    $total = 0;
                    if($list_pro){
                        foreach($list_pro as $item){
                            if($item['frame']->price_sale){
                                $price_frame = $item['frame']->price_sale;
                            }else{
                                $price_frame = $item['frame']->price;
                            }
                            $price_frame = $price_frame;
                            $total += $price_frame * $item['num'];
                        }
                        
                    }
                ?>
                <div class="col-md-4 d-item1">
                    <div class="tan-dathang">
                        <div style="padding: 10px 0px;">
                            <table style="width: 100%;">
                                <tbody><tr>
                                        <td><span style="font-size: 10.5pt;">Tổng tiền</span></td>
                                        <td class="text-right">
                                            <span id="total" value="90000" style="color: #000 !important;font-size: 10.5pt;font-family: 'Roboto Bold';">{{number_format( (int)$total,0,'','.')}}đ</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                            $total = 0;
                            $total_weight = 0; 
                        ?>
                        <div class="tan-conten" style="border-bottom: 1px dashed #d9d9d9;
                             @if($list_pro) border-top: 1px dashed #d9d9d9; @endif">
                            @if($list_pro)
                                @foreach($list_pro as $item)
                                        <div class="tan-conten-cantop">
                                            <div class="tan-conten-img">
                                                <img width="76px" height="auto" src="{{ asset($item['frame']->img) }}" alt="">
                                            </div>
                                            <div class="tan-conten-sanpham">
                                                <p>{!! $item['frame']->name !!}</p>
                                                 <?php 
                                                    if($item['frame']->price_sale){
                                                        $price_frame = $item['frame']->price_sale;
                                                    }else{
                                                        $price_frame = $item['frame']->price;
                                                    }
                                                    $price_frame = $price_frame;
                                                    $total += $price_frame * $item['num'];
                                                    $weight_frame = $item['frame']->weight;
                                                    $total_weight += $weight_frame * $item['num'];
                                                    $total = $total;
                                                    $total_weight = $total_weight;
                                                    $district = App\District::where('id',$district->id)->first();
                                                    $some = 0;
                                                    if(sizeof($district)){
                                                        $list_phi = App\Config_distric::where('district_id',$district->id)->get();
                                                        if(sizeof($list_phi)){
                                                            foreach ($list_phi as $key => $value2) {
                                                                if((float)$total_weight > (float)$value2->min_weigh && (float)$total_weight <= (float)$value2->max_weigh ){
                                                                    $some = $value2->price;
                                                                }
                                                                if((float)$total_weight > (float)$value2->max_weigh){
                                                                    $max = App\Config_distric::where('district_id',$district->id)->max('price');
                                                                    $max_w = App\Config_distric::where('district_id',$district->id)->max('max_weigh');
                                                                    $c = (float)$total_weight - (float)$max_w;
                                                                    $d = ((float)$c*(float)$value2->init_price)/$value2->init_weigh; 
                                                                    $some = (float)$max + (float)$d;
                                                                }
                                                            }
                                                        }else{
                                                            $some = 0;
                                                        }
                                                    }
                                                    ?>
                                                <b> x <span> 0{!! $item['num'] !!}</span> </span></b>
                                            </div>
                                            <div style="clear :both"></div>
                                        </div>   
                                @endforeach
                            @endif
                        </div>

                        <div class="tan-phivanchuyen" style="border-bottom: 1px dashed #d9d9d9;padding-bottom:15px;margin-top: 15px;">
                        <?php if(!$list_pro){ $some = 0; } ?>
                            <table> 
                                <tr >
                                    <td style="font-family: Roboto; ">Phí vận chuyển</td>
                                    <td>
                                        {{number_format( (int)$some,0,'','.')}} đ
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="tan-phivanchuyen"  style="padding-bottom:15px;margin-top: 15px;">
                        <?php if(!$list_pro){ $some = 0; } ?>
                            <table> 
                                <tr>
                                    <td>Tổng Đơn Hàng</td>
                                    <td>{{number_format( (int)$total + $some,0,'','.')}} đ</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div><!--end container-->

     
</div><!--end content-->
<!--Popup thông báo thanh toán-->
<div id="modal-popup55" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup t-popup2" style="padding-top: 23px;">
    <div style="padding:0px !important; display: none;">
    </div>
    <div class="t-popup-padding-rp">
        <div class="row d-view-order" style="margin:0px !important">
            
        </div>
    </div>
</div>
<!--Hết popup thông báo thanh toán-->

    <div id="modal-popup-loading" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup" style="">
        <div style="">
            <h5>Loading...</h5>
        </div>
        <div class="t-popup-padding-rp">
            <div class="row" style="margin:0px !important">
                <div class="center-col text-center margin-ten no-margin-top xs-margin-bottom-seven let" style="margin-bottom:0px !important">
                    <p class="t-nd-popup" style="">Tình trạng đơn hàng của bạn đang được xử lý. Vui lòng đợi trong giây lát.</p>
                </div>
            </div>
            <div class="row" style="margin:0px !important">
                <div class="center-col text-center">
                    <form id="d-popup-tra-cuu">
                        <!-- input  -->
                        <input class="t-ip-form1" type="text" placeholder="Số điện thoại..." style="
                            display: none;
                            " required="" name="phone">
                        <p style="margin-bottom:10px;color:red;display:none;font-family:Roboto;" id="d-mess"></p>
                        <!-- end input -->              
                        <!-- button  -->
                        <button class="btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu" type="submit"><div class="loader">
                                <img src="{!! asset('frontend/img/wheel.svg') !!}" alt="">
                            </div></button>
                        <!-- end button  -->                            
                    </form>
                </div>
            </div>
        </div>
        <!-- <button title="Close (Esc)" type="button" class="mfp-close">×</button> -->
    </div>


        @endsection
        @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
	        <script>
                click_form = 0;
                $(document).on('submit','#form_order',function(e){
                    e.preventDefault();
                    $.magnificPopup.open({
                        items: {
                            src: '#modal-popup-loading' 
                        },
                        type: 'inline',
                        blackbg: true,
                        zoom: {
                                enabled: true,
                                duration: 300 
                              },
                        closeOnContentClick: false,
                        closeOnBgClick:false,
                        enableEscapeKey:false,
                        mainClass: 'my-mfp-zoom-in',
                    });
                            formData = new FormData($('#form_order')[0]);
                            if(click_form==0){
                                click_form =1;
                                $.ajax({
                                headers: {
                                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                type:"post",
                                url:"{{route('ajax.form.order')}}",
                                data: formData,
                                contentType: false,
                                processData: false,
                                dataType:"json",
                                success:function(data){ 
                                    console.log(data);
                                    click_form =0;
                                   if(data.status == true){
                                        $('#modal-popup-loading').magnificPopup('close');
                                        $("#form_order")[0].reset();
                                         $.magnificPopup.open({
                                            items: {
                                                src: '#modal-popup55' 
                                            },
                                            type: 'inline',
                                            blackbg: true,
                                            zoom: {
                                                    enabled: true,
                                                    duration: 300 
                                                  },
                                            mainClass: 'my-mfp-zoom-in',
                                            closeOnContentClick: false,
                                            closeOnBgClick:false,
                                            enableEscapeKey:false,
                                            callbacks: {
                                              beforeOpen: function() {
                                                $('.d-view-order').html(data.view);
                                              },
                                              beforeClose: function(){
                                                window.location = data.link;
                                              }
                                            }
                                        });
                                   }
                                   if(data.status == false){
                                    $('#modal-popup-loading').magnificPopup('close');     
                                    $("#form_order")[0].reset();
                                    if( data.link != undefined){
                                        window.location = data.link;
                                    }else{
                                        location.reload();
                                    }

                                   }
                                },
                            });
                        }  
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