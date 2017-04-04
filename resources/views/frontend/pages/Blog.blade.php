@extends('frontend.layout')
@section('title','Blog')
@section('css')
	<link rel="stylesheet" href="{{asset ('frontend/html/css/blog.css') }}">
	<style>
		.right-slide-bar ul li:last-child{margin-bottom: 0px}
	</style>
@endsection
@section('content')
<!-- blog style-->

    <!-- end-catagory style-->
<!-- end parallax section -->

<!-- phần đường dẫn -->
<section class="t_section_content_products">
    <div class="container d_section_content_pr t_section_content_pr">
        <div class="row">
            <div class="col-md-12">
                <ul class="d_cate_products" style="border-top: 1px solid #d7d7d7 !important;">
                    <li style="color:#7F7F83"><a href="" style="color:#7F7F83">Trang chủ</a></li>
                    <li style="color:#d6e9d7">/</li>
                    <li style="color:#7F7F83"><a href="" style="color:#7F7F83" href="">Blog</a></li>
                    <li style="color:#d6e9d7">/</li>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- phần đường dẫn -->
<!--content-->
<div class="content">
	<div class="container">
		<div class="row">
			<!--left sile bar-->
				<div class="col-md-8 left-slide-bar col-xs-12 col-sm-8">
					<p class="title">{{ $post->title }}</p>
					
					<span>{!! $post->description !!}</span>
					<div>
						<img style="margin-top: 21px;width:640px" src="{{asset($post->img)}}">
					</div>
					<div class="t-fix-content">
						<?php $contents = $post->contents; ?>
						@foreach($contents as $content)
							{!!$content->content!!}
						@endforeach
					</div>
				</div>
			<!--left sile bar-->
			<!--right sile bar-->
			<div class="col-md-4 right-slide-bar col-xs-12 col-sm-4 f4">
				<div class="tan-canle">
					<?php $dataft1 = App\Category::get(); ?>
					@foreach($dataft1 as $key => $item1)
						<p><span>{{$item1->name}}</span></p>
						<ul style="margin-bottom: 22px;" class = "">
							
							<?php $post = $item1->post_public; ?>
							@foreach($post as $item2)
								<li class="{{$item2->id == $id? 't-blog': ''}} t-slide"><a href="{{route('view.blog',['id'=>$item2->id,'alias'=>$item2->slug])}}" >{{$item2->title}}</a></li>

							@endforeach

						</ul>

					@endforeach
				
				</div>
				
			</div><!--right sile bar-->
		</div><!--end row-->
	</div><!--end container-->
</div>
<!--content-->
@endsection
@section('js')
	<script type="text/javascript">
		$('.tan-canle > ul').find('.t-blog').parent().css('display','block');
		$('.tan-canle > p > span').click(function(){
			$(this).parent().next().slideToggle();
			$(this).parent().next().css('transition-duration', '0s');
		});
	</script>
@endsection