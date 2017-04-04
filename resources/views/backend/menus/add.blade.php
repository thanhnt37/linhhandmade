@extends('backend.layouts.default')
@section('css')
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
	  <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
	 <style type="text/css">
     option:disabled {
        background: #dddddd;
    }
	.select2-container .select2-selection--single{
    	height: 37px;
    }
    .select2-selection__arrow{
    	height: 35px !important;
    }
    .select2-search__field{
    	display: none;
    }
    .select2-search--dropdown{
    	padding: 0px !important;
    }
    .select2{
    	width: 100% !important;
    	font-size: 10pt;
    }
    .select2-selection__rendered{
    	font-size: 10pt !important;
    }
    .nav-active-primary .nav-link.active, .nav-active-primary .nav > li.active > a{
			color: #262626 !important;
			background-color: #FFFFFF !important;
	}
	.nav-pills .nav-item+.nav-item {
    margin-left: 0 ;
     }
     .nav-pills .nav-link {
     	border-radius: 0;
     }
      .nav-item a {
          margin-right: 0px;
          background: rgb(255,255,255);
     }
   </style>
   
	
@endsection
@section('content')
  <form ui-jp="parsley" action="{{route('menu.post_add')}}" method="post" enctype="multipart/form-data">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
   		<p>Tạo menu</p>
   	</div>
   	<div style="float:right;margin-top:14px;">
   	<button type="submit" class="btn success" style="
		padding-bottom: 5px;padding-top: 6px;font-size: 10pt;margin-right: 8px;
		min-width:100px; background-color:#738CEC">TẠO</button>
    </div>
</div>
 </div>
	 <div class="app-body" id="view">
	 	<div class="padding">
	 	 <div class="row">
		    <div class="col-sm-12">
		    
		        <div class="box">
		          <div class="box-body">
					<div class="row">
							<div class="col-sm-6">
										@include('backend.partials._messages')
										<?php
											$list_menus = App\Menu::where(['parent_id'=>0])->orderby('order','asc')->get();
											$list_danhmuc= App\Category::all();
											$list_sanpham= App\GroupAttribute::all();
											//dd(choose_menu_link($list_danhmuc, 'danh-muc') );
                                             
										?>
										<input type="hidden" name="_token" value="{{csrf_token()}}">
					          		   
							            
										<div class="row">
											<div class="col-sm-12">
									           	<ul class="nav nav-sm nav-pills nav-active-primary clearfix" id="list_tab_title">
												    <li class="nav-item">
												      <a class="nav-link menu-tab active" id="default_tab" href data-toggle="tab"  data-target="#tab_1">Đường link</a>
												    </li>
												    <li class="nav-item">
												      <a class="nav-link menu-tab"  href data-toggle="tab" data-target="#tab_2">Danh mục bài viết</a>
												    </li>
												    <li class="nav-item">
												      <a class="nav-link menu-tab" href data-toggle="tab" data-target="#tab_3">Danh mục Sản phẩm</a>
												    </li>
												</ul>
														
												<div class="tab-content" id="list_tab_content">      
												    <div class="tab-pane p-v-sm active" id="tab_1">
													      <div class="box p-a-sm">
													      	<div class="form-group">
												             <input type="text" class="form-control" name="link">    
												          	</div>
												   		 </div>
												    </div>
												    <div class="tab-pane p-v-sm" id="tab_2">
													      <div class="box p-a-sm">
													      	<div class="form-group">
												               <select id="single" class="form-control select2" name="link_danh_muc">
												               <option value="">Chọn danh mục bài viết</option>
												                <?php choose_menu_link($list_danhmuc, 'danh-muc-bai-viet'); ?> 
												                 </select> 
												          	</div>
												   		 </div>
												    </div>
												     <div class="tab-pane p-v-sm " id="tab_3">
													      <div class="box p-a-sm">
													      	<div class="form-group">
												              <select id="single1" class="form-control select2" name="link_san_pham">
												               <option value="">Chọn danh mục sản phẩm</option>
												                <?php choose_menu_link($list_sanpham, 'danh-muc-san-pham') ?> 
												                 </select>    
												          	</div>
												   		 </div>
												    </div>
												    
				         	                     </div>	 
				                            </div>
					                      </div>
					                  	 <div class="form-group">
							              <label>Tên menu</label>
							              <input type="text" class="form-control" name="name" required >                        
							            </div>
							            <div class="form-group">
							              <label>Số thứ tự nếu có</label>
							              <input type="mumber" class="form-control" name="order">                        
							            </div>
                                       
							            <div class="form-group">
							            	<?php $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
									        <label for="single">Lựa chọn vị trí lưu</label>
									        <select id="single" class="form-control select2" name="parent">
									            <option value="0">Mặc định</option>
									            @foreach($list_menus as $v0)
									            <option value="{{$v0->id}}">{{$v0->name}}</option>
									            @if($v0->subcategory)
									                 @foreach($v0->subcategory as $v1)
                                                        <option value="{{$v1->id}}">{{$space}}{{$v1->name}}</option>
                                                         @if($v1->subcategory)
											                 @foreach($v1->subcategory as $v2)
		                                                        <option value="{{$v2->id}}">{{$space.$space}}{{$v2->name}}</option>
		                                                        @if($v2->subcategory)
													                 @foreach($v2->subcategory as $v3)
				                                                        <option value="{{$v3->id}}">{{$space.$space.$space}}{{$v3->name}}</option>
				                                                        @if($v3->subcategory)
															                 @foreach($v3->subcategory as $v4)
						                                                        <option disabled value="{{$v4->id}}">{{$space.$space.$space.$space}}{{$v4->name}}</option>
						                                                     @endforeach
						                                                 @endif
				                                                     @endforeach
				                                                 @endif
		                                                     @endforeach
		                                                 @endif
                                                     @endforeach
                                                 @endif
									            @endforeach
									        </select>
									    </div>
									
		         				</div>	 
		         				<div class="col-sm-6">
		         					 <div class="form-group">
							             
							               <label style="margin-bottom:5px;">Ảnh mô tả menu nếu có</label>
							              <p style="margin:0px; margin-bottom:10px;line-height:0px">
									               <img id="img_preview" style="max-height:100px;">
									      </p>
										  <label style="padding-top:2px !important;padding-bottom:2px !important;" for="file_img_preview">
									                <a class="btn info">Chèn ảnh</a>
									      </label>
							              <input type="file" class="form-control" style="display:none" id="file_img_preview" name="img">                          
							         </div>
		         				</div>
                  </div>
		         
		        </div>
		  
		    </div>
	 	</div>
	 </div>
    </form>
@stop
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
  <script>
  	 $('#single').select2().on("change", function(e) {
         $( "#single1").val('');
         var d = $('#single').find(":selected").text();
         $('input[name="name"]').val($.trim(d));
         $('input[name=link]'). val('');
  	 });
  	  $('#single1').select2().on("change", function(e) {
         $('#single').val(''); 
         var d = $('#single1').find(":selected").text();
         $('input[name="name"]').val($.trim(d));
         $('input[name=link]').val('');
  	 });
  	  $(document).on('keydown', 'input[name=link]',function(){
             $('#single').val(''); 
             $('#single1').val(''); 
  	  });
  	 
    function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#img_preview').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$("#file_img_preview").change(function(){
	    readURL(this);
	});
  
  </script>

@endsection