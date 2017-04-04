@extends('frontend.layout')

@section('title', 'Ferliz')
@section('meta')
<meta name="description" content="" />
<meta property="og:url"           content="" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="" />
<meta property="og:description"   content="" />
<meta property="og:image"         content="" />

@endsection
<style type="text/css">
	/*body{background-color: #f2f2f2 !important}
	.container{background-color: #fff}
	.header-top{padding: 25px 0;padding-bottom: 17px;margin-top: 0px !important}
	.footer-cpr{background-color: transparent !important;margin-top: 0px !important}
	.footer-copyright{padding: 30px 0;height: auto !important}
	.footer-copyright>div{background-color: #416424}*/
	
	.inf-box-nvgt .btn-prev, .inf-box-nvgt .btn-next{top: calc(50% - 21px) !important;}
	.header-top{margin-bottom:20px !important}
	#prop-slider2 .clickable{display:none !important}
	#prop-slider3 .clickable{display:none !important}
	#prop-slider3 .pdct-box-rate span::before{font-size: 10px !important}
	#prop-slider2{padding-bottom: 25px;border-bottom:1px dashed #d9d9d9 }
	.t-cate{padding: 17px;padding-top: 20px}
	.t-cate>ul{text-align: center;}
	.t-cate li{position: relative;margin: 5px}
	.t-cate li a{padding: 5px 15px; color:#56822D;border:2px solid transparent;border-radius: 4px }
	.t-cate .t-active a{padding: 6px 17px;border-radius: 4px;background-color: #56822D;color:#fff}
	.t-cate .fa-sort-desc{position: absolute;bottom: -12px;left: calc(42%); color: #56822D;font-size: 18px}
	.flaticon-arrows::before{font-size: 8pt !important}
	.inf-box-nvgt3{padding: 25px 0;padding-bottom: 27px; border-bottom: 1px dashed #d9d9d9;border-top:1px dashed #d9d9d9}
	.inf-box-nvgt2 .btn, .inf-box-nvgt3 .btn{padding: 3px 30px !important;top: calc(50% - 45px) !important;}
	.inf-box-nvgt3 .btn{top: calc(50% - 12px) !important;}
	.inf-box-nvgt2 .btn-prev, .inf-box-nvgt3 .btn-prev{left: -26px !important}
	.inf-box-nvgt2 .btn-next, .inf-box-nvgt3 .btn-next{right: -26px !important}
	#prop-slider3 .pdct-box-infrm1{margin-top: 0px !important;text-align: center;max-height: 74px;min-height: 60px}
	.pdct-box-name a{color: #000;overflow:hidden;max-height: 23px}
	.t-cm{width:calc(100% - 150px);margin-left: 17px}
	.t-rate span::before{font-size: 7.5pt !important}
	@media (min-width:991px){
		.t-overflow{overflow: scroll; max-height: 370px;}
	}
	
	#prop-slider4 .clickable{display:none !important}
	.footer-menu{position: relative;}
	.footer-menu::before{position: absolute; content: "";background-color: #d9d9d9;width:calc(100% - 30px);height: 1px;top: -45px}
	.footer-menu{margin-top:80px !important}
	.t-cate a{cursor: pointer;}
	
/*	@media (max-width:767px){
		.t_buynow{padding:7px 15px;padding-bottom: 6px;font-size: 9pt;right: 27px;bottom: 20px;opacity: 0.9}
	}*/
</style>
@section('content')
<section>
	<div class="container" style="padding-top: 17px">
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12">
			<?php $slide = App\Slide::where('status', 1)->where('type', 'Big slide trang chủ')->get() ?>
				<div class="properties-slider slide-id">
					<div id="prop-slider" class="prop-img-slider">
					@if($slide)
						@foreach($slide as $item)
						<div class="item" linkfk ="{{$item->link_1}}"><img src="{{asset($item->img_1)}}" alt="Owl Image"></div>
						@endforeach
					@endif
					</div>
					<a class="t_buynow" href="" target="_blank">Mua ngay</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="padding-top:16px; padding-bottom: 16px">
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12">
				<div style="position: relative;" class="inf-box-nvgt">
					<a class="btn prev btn-prev"><i class="flaticon-arrows"></i></a>
					<a class="btn next btn-next"><i class="flaticon-arrows"></i></a>
					<div class="clear"></div>
					<div class="properties-slider">
						<div id="prop-slider2" class="prop-img-slider">
						<?php $slide2 = App\Slide::where('status', 1)->where('type', 'Brands Slide')->get() ?>
						@if($slide2)
						@foreach($slide2 as $item)
							<div class="item"><a href="{{$item->link_1}}" target="_blank"><img src="{{asset($item->img_1)}}" alt="Owl Image"></a></div>
						@endforeach
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section style="margin-bottom: 20px">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="t-cate">
					<ul>
					<?php $cate1 = App\CategoryProduct::where('status', 0)->get(); ?>
					@if($cate1)
						@foreach($cate1 as $key=> $item)
							<li class="{{$key == 0? 't-active':''}}"><a class="t_a" adu="{{$item->id}}">{{$item->name}}</a><i class="fa fa-sort-desc"></i></li>
						@endforeach
					@endif	
					</ul>
				</div>
				<div style="position: relative;" class="inf-box-nvgt inf-box-nvgt2">
					<a class="btn prev btn-prev"><i class="flaticon-arrows"></i></a>
					<a class="btn next btn-next"><i class="flaticon-arrows"></i></a>
					<div class="clear"></div>

					<div class="properties-slider">
						<div id="prop-slider3" class="prop-img-slider">
						<?php $prod = App\Frame::join('frame_categorys', 'frame_categorys.frame_id', '=', 'frames.id')->join('category_products', 'category_products.id','=','frame_categorys.cate_pro_id')->select('frames.name as name','frames.rating as rating', 'frames.id as id', 'frames.slug as slug', 'frames.img as img', 'frames.price as price', 'frames.price_sale as price_sale')->where('frames.status',1)->where('category_products.id',$cate1[0]->id)->get() ?>
							@foreach($prod as $item)
							<?php $brand = $item->getAttributes()->where('type',0)->where('name',"Hãng")->first();?>
							<div class="item">
								<a target="_blank" href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}"><img src="{{asset($item->img)}}" alt="Owl Image"></a>
								<div class="pdct-box-infrm1">
									<div class="pdct-box-name"><a href="{!! route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" target="_blank"><span class="ffRB txtblack pdct-box-name-hv">@if($brand){{$brand->value}} @endif </span>{{$item->name}}</a></div>
									<div class="pdct-box-rate">
                                    @if($item->rating <= 1)
                                    <span class="flaticon-cinema-1"></span>
                                    <span class="flaticon-cinema"></span>
                                    <span class="flaticon-cinema"></span>
                                    <span class="flaticon-cinema"></span>
                                    <span class="flaticon-cinema"></span>
                                    @endif
                                    @if($item->rating <= 2 && $item->rating > 1)
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema"></span>
                                        <span class="flaticon-cinema"></span>
                                        <span class="flaticon-cinema"></span>
                                    @endif
                                    @if($item->rating <= 3 && $item->rating > 2)
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema"></span>
                                        <span class="flaticon-cinema"></span>
                                    @endif
                                    @if($item->rating <= 4 && $item->rating > 3)
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema"></span>
                                    @endif
                                    @if($item->rating <= 5 && $item->rating > 4)
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                        <span class="flaticon-cinema-1"></span>
                                    @endif
                                </div>
									<div class="pdct-box-price">
										@if($item->price_sale == 0)
										<span class="pdct-box-listedpr txtblack">{{$item->price}}đ</span>
										@else
										<span class="pdct-box-salepr">{{$item->price}}đ</span>
										<span class="pdct-box-listedpr txtblack">{{$item->price_sale}}đ</span>
										@endif
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div style="position: relative;" class="inf-box-nvgt inf-box-nvgt3">
					<a class="btn prev btn-prev"><i class="flaticon-arrows"></i></a>
					<a class="btn next btn-next"><i class="flaticon-arrows"></i></a>
					<div class="clear"></div>
					<?php $slide4 = App\Slide::where('status', 1)->where('type', 'Slide 2 Item')->get() ?>
					<div class="properties-slider">
						<div id="prop-slider4" class="prop-img-slider">
						@foreach($slide4 as $item)
							<div class="item">
								<a href="{{$item->link_1}}" target="_blank"><img src="{{asset($item->img_1)}}" alt="Owl Image"></a>
							</div>
						@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container t-overflow">
		<div class="row">
		<?php $cmt = App\CommentFrame::where('status',1)->orderby('id', 'desc')->limit(8)->get() ?>
			@foreach($cmt as $item)
			<div class="col-md-6 mrgtp25 ">
				<?php $img = App\Frame::select()->where('id', $item->frame_id)->first(); ?>
				<img style="max-width:130px" class="fleft" src="{{asset($img['img'])}}"/>
				<div class="t-cm fleft">
				<?php $user = App\Account::select('name')->where('id', $item->account_id)->first(); ?>
				
					<p><span style="font-family:'Roboto Bold';margin-right: 7px;font-size: 10pt ">{{$user['name']}}</span>Đã bình chọn</p>
					<div class="pdct-box-rate t-rate">
						@if($item->rating <= 1)
                        <span class="flaticon-cinema-1"></span>
                        <span class="flaticon-cinema"></span>
                        <span class="flaticon-cinema"></span>
                        <span class="flaticon-cinema"></span>
                        <span class="flaticon-cinema"></span>
                        @endif
                        @if($item->rating <= 2 && $item->rating > 1)
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema"></span>
                            <span class="flaticon-cinema"></span>
                            <span class="flaticon-cinema"></span>
                        @endif
                        @if($item->rating <= 3 && $item->rating > 2)
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema"></span>
                            <span class="flaticon-cinema"></span>
                        @endif
                        @if($item->rating <= 4 && $item->rating > 3)
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema"></span>
                        @endif
                        @if($item->rating <= 5 && $item->rating > 4)
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                            <span class="flaticon-cinema-1"></span>
                        @endif
					</div>
					<p class="fs90 disin-b txt7f">{{$item->updated_at}}</p>
					<p style="margin-top: 7px;line-height: 20px;color: #595959">{{$item->comment}}</p>
				</div>
				<div class="clear"></div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection

@section('js')
	<script>
		$(document).ready(function() {
		  var owl = $("#prop-slider");
		  owl.owlCarousel({
		  	autoPlay:true,
		      items : 1, //10 items above 1000px browser width
		      itemsDesktop : [1000,1], //5 items between 1000px and 901px
		      itemsDesktopSmall : [900,1], // betweem 900px and 601px
		      itemsTablet: [600,1], //2 items between 600 and 0
		      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
		  });
		  // Custom Navigation Events
		 /* $(".next").click(function(){
		    owl.trigger('owl.next');
		  })
		  $(".prev").click(function(){
		    owl.trigger('owl.prev');
		  })*/
		});
	</script>
	<script>
		$(document).ready(function() {
		a = $('.t-cate ul li');
		a.each(function(i, v){
			if(!$(v).hasClass('t-active')){
			$(this).find('i').remove();
		}
		});
		
		  var owl2 = $("#prop-slider2");
		  owl2.owlCarousel({
		  	/*autoPlay:true,*/
		      items : 5, //10 items above 1000px browser width
		      itemsDesktop : [1000,3], //5 items between 1000px and 901px
		      itemsDesktopSmall : [900,3], // betweem 900px and 601px
		      itemsTablet: [600,3], //2 items between 600 and 0
		      itemsMobile : true // itemsMobile disabled - inherit from itemsTablet option
		  });
		  // Custom Navigation Events
		  $(".next").click(function(){
		    $(this).next().next().find('#prop-slider2').trigger('owl.next');
		  })
		  $(".prev").click(function(){
		     $(this).next().next().next().find('#prop-slider2').trigger('owl.prev');
		  })
		});
	</script>
	<script>
		$(document).ready(function() {
		  var owl3 = $("#prop-slider3");
		  owl3.owlCarousel({
		  	autoPlay:true,
		      items : 4, //10 items above 1000px browser width
		      itemsDesktop : [1000,3], //5 items between 1000px and 901px
		      itemsDesktopSmall : [900,3], // betweem 900px and 601px
		      itemsTablet: [600,2], //2 items between 600 and 0
		      itemsMobile : true // itemsMobile disabled - inherit from itemsTablet option
		  });
		  // Custom Navigation Events
		  $(".next").click(function(){
		    $(this).next().next().find('#prop-slider3').trigger('owl.next');
		  })
		  $(".prev").click(function(){
		    $(this).next().next().next().find('#prop-slider3').trigger('owl.prev');
		  })
		});
	</script>
	<script>
		$(document).ready(function() {
		  var owl4 = $("#prop-slider4");
		  owl4.owlCarousel({
		  	autoPlay:true,
		      items : 2, //10 items above 1000px browser width
		      itemsDesktop : [1000,2], //5 items between 1000px and 901px
		      itemsDesktopSmall : [900,2], // betweem 900px and 601px
		      itemsTablet: [600,2], //2 items between 600 and 0
		      itemsMobile : true // itemsMobile disabled - inherit from itemsTablet option
		  });
		  // Custom Navigation Events
		  $(".next").click(function(){
		    $(this).next().next().find('#prop-slider4').trigger('owl.next');
		  })
		  $(".prev").click(function(){
		     $(this).next().next().next().find('#prop-slider4').trigger('owl.prev');
		  })
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.t_a').hover(
				function(){
					if(!$(this).parent().hasClass('t-active')){
						$(this).css({'border':'2px solid','transition':'0.0s'});
					}
					
				}, 
				function(){
					if(!$(this).parent().hasClass('t-active')){
					$(this).css({'border':'2px solid transparent', 'transition':'0.3s'});
					}
				});
			$('.t_a').click(function(){
				$(this).parent().parent().find('.t-active').removeClass('t-active').find('i').remove();
				$(this).parent().addClass('t-active');
				$(this).css('border', '2px solid transparent').append('<i class="fa fa-sort-desc"></i>');
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.t_buynow').hover(function(){
				var a;
				$('#prop-slider .owl-page').each(function(i,v){
					if($(v).hasClass('active')){
						a = i;
					}
				});
				b = $('#prop-slider .owl-item:eq('+a+')').find('.item').attr('linkfk');
				$(this).attr('href', b);
			});
		});
	</script>
	<script type="text/javascript">
		$(document).on('click','.t-cate a', function(){
			id = $(this).attr('adu');
			$.ajax({
                headers: {
                      'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:"post",
                url:"{{route('view.home.indexajax')}}",
                data:{'id':id},
                success:function(data){
                    console.log(data);
                    // data = abc
                    $('.inf-box-nvgt2').html(data);

					  var owl3 = $("#prop-slider3");
					  owl3.owlCarousel({
					  	autoPlay:true,
					      items : 4, //10 items above 1000px browser width
					      itemsDesktop : [1000,3], //5 items between 1000px and 901px
					      itemsDesktopSmall : [900,3], // betweem 900px and 601px
					      itemsTablet: [600,2], //2 items between 600 and 0
					      itemsMobile : true // itemsMobile disabled - inherit from itemsTablet option
					  		});
		  // Custom Navigation Events
						  $(".next").click(function(){
						    $(this).next().next().find('#prop-slider3').trigger('owl.next');
						  })
						  $(".prev").click(function(){
						    $(this).next().next().next().find('#prop-slider3').trigger('owl.prev');
						  })
						
                },
                cache:false,
                dataType: 'html'
            });
		})
	</script>
@endsection