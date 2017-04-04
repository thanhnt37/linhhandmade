@extends('backend.layouts.default')
@section('css')
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
	  <link rel="stylesheet" href="{{ asset('summernote/dist/summernote.css') }}" type="text/css" />
	  <style type="text/css">
	  	.note-editor .note-frame{
	  		border: 1px solid #a9a9a9 !important;
	  	}
	  	.note-editable{
	  		border: 1px solid #a9a9a9 !important;
	  	}
	  </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
    <!-- Open side - Naviation on mobile -->
    {{-- <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
      <i class="material-icons">&#xe5d2;</i>
    </a>
    <!-- / -->

    <!-- Page title - Bind to $state's title -->
    <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>

    <!-- navbar right -->
    <ul class="nav navbar-nav pull-right">
      <li class="nav-item dropdown pos-stc-xs">
        <a class="nav-link" href data-toggle="dropdown">
          <i class="material-icons">&#xe7f5;</i>
          <span class="label label-sm up warn">3</span>
        </a>
         @include('backend.partials.notification')
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link clear" href data-toggle="dropdown">
          <span class="avatar w-32">
            <img src="{{url('backend/assets/images/a0.jpg')}}" alt="...">
            <i class="on b-white bottom"></i>
          </span>
        </a>
        @include('backend.partials.user')
      </li>
      <li class="nav-item hidden-md-up">
        <a class="nav-link" data-toggle="collapse" data-target="#collapse">
          <i class="material-icons">&#xe5d4;</i>
        </a>
      </li>
    </ul>
    <!-- / navbar right -->

    <!-- navbar collapse -->
    <div class="collapse navbar-toggleable-sm" id="collapse">
      <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
      <!-- link and dropdown -->
      <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href data-toggle="dropdown">
            <i class="fa fa-fw fa-plus text-muted"></i>
            <span>New</span>
          </a>
          <div ui-include="'../views/blocks/dropdown.new.html'"></div>
        </li>
      </ul>
      <!-- / -->
    </div> --}}
    <!-- / navbar collapse -->
</div>
 </div>
 
	 <div class="app-body" id="view">
	 	<div class="padding">
	 	 <div class="row">
		    <div class="col-sm-12">
		      <form ui-jp="parsley" method="post" action="{{route('ppostt_posts.add')}}" enctype="multipart/form-data">
		        <div class="box">
		          <div class="box-header">
		            <h2>Đăng bài viết</h2>
		          </div>
		          @include('backend.partials._messages')
		          <div class="box-body">
					<div class="row">
							<div class="col-sm-7">
										<input type="hidden" value="{{csrf_token()}}" name="_token">
							            <div class="form-group">
							              <label>Tiêu đề bài viết</label>
							              <input type="text" class="form-control" name="post_title" value="{!!old('post_title'), isset($post) ? $post->title : ''!!}">                        
							            </div>
							            <div >
							            	<img id="img_preview" style="width:100%">
							            </div>
							            <div class="form-group">
							              <label>Ảnh mô tả cho bài viết (nếu có)</label>
							              <input type="file" class="form-control" name="post_img"  id="file_img_preview">                        
							            </div>
							            <div class="form-group">
							              <label>Tóm tắt nội dung bài viết</label>
							              <textarea name="post_des" class="form-control" rows="5">{!!old('post_des', isset($post) ? $post->description :'')!!}</textarea>                       
							            </div>
	     								<p class="text-muted">Dưới đây là nội dung của bài viết (mặc định là bài viết đơn, nếu muốn bài viết nhiều tab vui lòng nhấn thêm tab)</p>
							           	<ul class="nav nav-sm nav-pills nav-active-primary clearfix" id="list_tab_title">
										    <li class="nav-item">
										      <a class="nav-link active" id="default_tab" href data-toggle="tab" data-target="#tab_1">Tab 1 (mặc định)</a>
										    </li>
										    <li class="nav-item">
										      <a class="nav-link" href="#" id="add_tab">Thêm tab mới</a>
										    </li>
										</ul>
										
										<div class="tab-content" id="list_tab_content">      
										    <div class="tab-pane p-v-sm active" id="tab_1">
										      <div class="box m-t p-a-sm">
										      	<div class="form-group">
									              <label>Tên thẻ tab</label>
									              <input type="text" class="form-control i_name" data-tab="1" name="post_name[]">
									            </div>
									            <div class="form-group">
									              <label>Nội dung bài viết</label>
									              <textarea  id="editor_1" class="form-control" rows="5" name="post_content[]"></textarea>
									            </div>
									          </div>
										    </div>
										</div>
							</div>
							<div class="col-sm-5">
		          						    <div class="form-group">
							                <?php
												$list_categories = App\Category::where(['parent_id'=>0])->get();
												 $space = "--";
											?>
										        <label for="multiple"> Chọn danh mục </label>
										        <select id="multiple" class="form-control select2-multiple" name="choose_cate[]" multiple >
										         	@foreach($list_categories as $v0)
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
						                                                        <option value="{{$v4->id}}">{{$space.$space.$space.$space}}{{$v4->name}}</option>
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

							            <div class="form-group">
										   <label>SEO tiêu đề</label>
									       <input type="text" class="form-control" name="seo_title">
										</div>	
										<div class="form-group">
										   <label>SEO Mô tả</label>
										   <textarea name="seo_des" class="form-control" rows="4"></textarea>
										</div>
										<div class="form-group">
										   <label>Struct Data</label>
										   <textarea name="seo_struct" class="form-control" rows="4"></textarea>
										</div>
		          			</div>    
		         </div>	 
                  </div>
		          <div class="dker p-a text-right">
		            <button type="submit" name="save" class="btn info">Lưu bài viết</button>
		            <button type="submit" name="post"  class="btn success">Đăng luôn</button>
		          </div>
		        </div>
		      </form>
		    </div>
	 	</div>
	 </div>
@stop
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
 
  <script src="{{ asset('summernote/dist/summernote.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/lang/summernote-vi-VN.js') }}"></script>

  <script>
  	$(".select2-multiple").select2({
      placeholder: "Chọn danh mục "
    });
    $(document).on('click',"#add_tab",function(e){
    	e.preventDefault();
    	var c = $("#list_tab_title li").length;
    	if(c>5) return false;
    	
    	if( $("#li_tab2").length == 0  ){
    		c = 2;
    	}else{
    		if( $("#li_tab3").length  == 0 ){
	    			c = 3;
	    	}else{
	    		if( $("#li_tab4").length == 0  ){
		    		c = 4;
		    	}else{
		    		if( $("#li_tab5").length >0  ){
			    		c= 5;
			    	}
		    	}
	    	}
    	}
    	console.log('c = ' +c );    
    	var html = '<li class="nav-item new_tab" id="li_tab'+c+'">'+
    					'<a class="nav-link " href data-toggle="tab" data-target="#tab_'+c+'">Tab mới</a>'+
										    '</li>';
		var content = '<div class="tab-pane p-v-sm" id="tab_'+c+'">'+
					'<div class="box m-t p-a-sm">'+
			      	'<div class="form-group">'+
		              '<label>Tên thẻ tab</label>'+
		              '<input  type="text" class="form-control i_name"'+
		               'name="post_name[]" >'+                        
		            '</div>'+
		            '<div class="form-group">'+
		              '<label>Nội dung bài viết</label>'+
		 '<textarea  id="editor_'+c+'" class="form-control i_content"'+
		  'rows="5" name="post_content[]" ></textarea></div>'+
		            '<div class="form-group">'+
		             '<button class="btn btn-warning btn-small close_tab" tab_id="'+c+'" >Đóng tab</button>'+
		            '</div>'+	 
			      '</div>';
    	$(this).parent().before(html);
    	$("#list_tab_content").prepend(content);
    	
    	$('#editor_'+c).summernote({
   	        lang: "vi-VN",
		    height: ($(window).height() - 300),
		    popover: {
		         image: [],
		         link: [],
		         air: []
		       },
		    callbacks: {
		        onImageUpload: function(image) {
		            uploadImage(image[0],'#editor_'+c);
		        }
		    }
		});
    });
    var setting_tab = function(){
    	var li = $("#list_tab_title li");
    	for(i=2 ; i < li.length -1 ;i++){
    		// $(li[i-1]).attr('id',"li_tab"+i);
    		// $(li[i-1]).find('a').attr('data-target',"#tab_"+i); 
    		// $(li[i-1]).find('a').text("Tab "+i); 
    		// console.log(i);
    	}
    	var tab = $("#list_tab_content .tab-pane");
    	for(i=2;i <= tab.length ;i ++){
    		// $(tab[i]).attr('id',"tab_"+i);
    		// $(tab[i]).find('i_name').attr('name','content['+i+'][name]');
    		// $(tab[i]).find('i_content').attr('name','content['+i+'][content]');
    		// $(tab[i]).find('i_content').attr('id','editor_'+i);
    	}

    }
    $(document).on('click','.close_tab',function(){
    		id = $(this).attr('tab_id');
    		if(id!=1){
    				$("#tab_"+id).remove();
    				$("#li_tab"+id).remove();
    		};
    		$("#default_tab").click();
    		// setting_tab();
    });
	 $('#editor_1').summernote({
   	        lang: "vi-VN",
		    height: ($(window).height() - 300),
		    popover: {
		         image: [],
		         link: [],
		         air: []
		       },
		    callbacks: {
		        onImageUpload: function(image) {
		            uploadImage(image[0],"#editor_1");
		        }
		    }
	});

	function uploadImage(image,editor) {
		    var data = new FormData();
		    data.append("image", image);
		    $.ajax({

		        url: "{{route('quan-tri/dang-anh')}}",
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: data,
		        type: "post",
		        success: function(url) {
		        	//console.log(url);
		            var image = $('<img>').attr('src', 'http://' + url);
		            $(editor).summernote("insertNode", image[0]);
		        },
		        error: function(data) {
		            console.log(data);
		        }
		    });
	}
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