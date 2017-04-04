 @extends('frontend.layout')
        @section('title','Pay')
        @section('css')
            <link rel="stylesheet" href="{{ asset('frontend/html/css/linhhandmade-Pay.css') }}">
		    <link rel="stylesheet" href="{{ asset('frontend/html/css/d-catagory.css') }}">
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
         @include('frontend.partials.banner')
        <section class="t_section_content_products">
			<div class="container d_section_content_pr t_section_content_pr">
			<div class="row">
			    <div class="col-md-12">
			        <ul class="d_cate_products" style="border-top: 1px solid #d7d7d7 !important;">
			            <li style="color:#7F7F83"><a href="{!! url('') !!}" style="color:#7F7F83">Trang chủ</a></li>
			            <li style="color:#d6e9d7">/</li>
			            <li style="#484040">Thanh toán</li>
			        </ul>
			    </div>
			</div>
			</div>
			</section>
        		<!--Phần nội dung chính-->
		<section style="padding:50px 0px;padding-bottom:20px; font-size: 10pt;" class="d-section-pdt">
			<div class="container">
				<div class="row">
					<div class="col-md-8 t-khungthuoctinh">
						<div>
							<h4 class="t-namepage">Thanh toán</h4>
							<div class="t-tungmuc">								
								<div class="t-stt"><span>1</span></div>
								<Div class="t-noidung">
									<p>Đơn hàng của bạn chưa được xác nhận. Để xác nhận Đơn hàng này bạn vui lòng thanh toán cho chúng tôi bằng cách chuyển khoản đến một trong các tài khoản sau cùng với nội dung chuyển khoản là <span style="font-family: 'Roboto Bold'; color: #0d0d0d;">Thanh toán Đơn hàng #{!! $order->id !!}</span></p>
									<?php $pay = App\Slide::where('type','Thanh Toán')->where('status',1)->get();?>
									@if($pay)
										@foreach($pay as $value)
											<div>
												<div class="t-img-bank"><img src="{!! asset($value->img_1) !!}" style="width:auto;height:55px;" /></div>
												<div class="t-tt-cus">
													<p>{!! $value->text_1 !!}</p>
													<p>Số tài khoản : <span>{!! $value->text_2 !!}</span></p>
													<p>{!! $value->text_3 !!}</p>
												</div>
												<div style="clear:both"></div>
											</div>
										@endforeach
									@endif
									
								</div>
								<div style="clear:both"></div>
							</div>
							<div class="t-tungmuc t-noidung2">								
								<div class="t-stt"><span>2</span></div>
								<Div class="t-noidung">
									<?php $dieu_khoan = App\Item::where('key_layout','Điều khoản')->get();?>
                                   
									<p>Sau khi chuyển khoản thành công chúng tôi sẽ liên hệ với bạn để xử lý Đơn hàng này. Bạn có thể tìm hiểu thêm về <a  style="color:#75005F"  @if(isset($dieu_khoan[1])) href="//{{$dieu_khoan[1]->link}}" target="_blank" @endif >Chính sách chuyển hàng</a> của chúng tôi.</p>								
								</div>
								<div style="clear:both"></div>
							</div>
							<div class="t-tungmuc d-noidung3" style="margin-bottom: 48px;">								
								<div class="t-stt"><span>3</span></div>
								<Div class="t-noidung t-tt-email">
								
									<p>Thông tin về Đơn hàng của bạn đã được gửi về địa chỉ Email : <a style="color:#75005F" >@if($order->email) {{ $order->email }} @else  @endif</a></p>
									<p>Tổng giá trị Đơn hàng  <span>{!! number_format((int)$order->total,0,'','.') !!} <sup>đ</sup></span></p>
									<?php 
										$p = App\Configure_discounts::min('targets');
										$custome = App\Customer::where('phone',$order->phone)->where('points','>=',$p)->first();
										$some = $order->percent;
										$orderItem = App\OrderItem::where('order_id',$order->id)->get();
										$total_non_sale = 0;
										foreach ($orderItem as $key => $item) {
											if(!$item->price_sale){
												$total_non_sale += $item->price * $item->quantity;
											}
										}
										$tong_tien_giam_gia = (($total_non_sale) * $some)/100;
										$thanh_toan = $order->total - $tong_tien_giam_gia;
										$tong_tien_phai_tra = $thanh_toan + $order->total_weight;
									?>
									@if($custome)
										<p>Giảm {!! $some !!} % :<span>{!! number_format((int)$tong_tien_giam_gia,0,'','.') !!} <sup>đ</sup></span></p>
									@endif
									<p>Phí vận chuyển :<span>{!! number_format((int)$order->total_weight,0,'','.') !!} <sup>đ</sup></span></p>

									<p>Số tiền cần thanh toán <span>@if($custome) {!! number_format((int)$tong_tien_phai_tra,0,'','.') !!} <sup>đ</sup> @else {!! number_format((int)($tong_tien_phai_tra),0,'','.') !!} <sup>đ</sup> @endif</span></p>
									
									<p>Mã đơn hàng :<span>#{!! $order->id !!}</span></p>
								</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<!-- <div class="t-lorem">
							<?php $dataft1 = App\Category::get(); ?>
							@foreach($dataft1 as $key => $item1)
								<div>
									<h5 @if($key!=0) style="margin-top: 26px;" @endif>{{$item1->name}}</h5>
									<?php $post = $item1->post_public; ?>
						
									@foreach($post as $item2)
										<p><a href="{{route('view.blog',['id'=>$item2->id,'alias'=>$item2->slug])}}" >{{$item2->title}}</a></p>
									@endforeach
								</div>
							@endforeach
						</div> -->
						<h3>Chào <span>@if($order->fullname){!! $order->fullname !!}@else{!! $order->email !!}@endif</span></h3>
							<p>Cảm ơn bạn đã mua hàng tại Linhhandmade.</p>
							<p>Đơn hàng này của bạn sẽ được Hệ thống tích lũy và áp dụng giảm giá cho những lần mua hàng sau của bạn.</p>
							<p>Để biết chi tiết bạn có thể xem tại Chương trình <a href="">khách hàng thân thiết</a>.</p>
							<div class="d-shoping-continue">
								<?php $pay =  App\Item::where('key_layout','Pay')->get();?>
								<a href="{!! url('') !!}"><p>Tiếp tục mua hàng</p></a>
								<div>
									@if(isset($pay[0]))<a href="{!! $pay[0]->link !!}"><p>{!! $pay[0]->value !!}</p></a>@endif
									@if(isset($pay[1]))<a href="{!! $pay[1]->link !!}"><p>{!! $pay[1]->value !!}</p></a>@endif
								</div>
								<div>
									@if(isset($pay[2]))<a href="{!! $pay[2]->link !!}"><p>{!! $pay[2]->value !!}</p></a>@endif
									@if(isset($pay[3]))<a href="{!! $pay[3]->link !!}"><p>{!! $pay[3]->value !!}</p></a>@endif
								</div>
							</div>
					</div>
				</div>
			</div>
		</section>
		<!--hết Phần nội dung chính-->
        @endsection
        @section('js')
		<script type="text/javascript">
			$('.t-lorem a').click(function(){
				$(this).parent().parent().parent().find('.t-doimau').removeClass('t-doimau');
				$(this).addClass('t-doimau');
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