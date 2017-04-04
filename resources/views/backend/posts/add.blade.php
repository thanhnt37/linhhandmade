@extends('backend.layouts.default')
@section('css')
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('summernote/dist/summernote.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/stag/css/stag.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
	 <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	 <style type="text/css">
	 	h2{
	 		    font-family: "Roboto-Bold";
	 		    font-size: 10.5pt !important;
	 	}
	  input::-webkit-calendar-picker-indicator {
		  display: none;
		}
		
		div#myDropZone {
		    width: 100%;
		    min-height: 100px;
		    background-color: #F0F0F0;
		    border: 1px solid #E7E7E7 !important;
		}
		#DropZone{

		}	
		.dz-message span{
			font-size: 10pt !important;
			font-family: "Roboto";
			color: #7F7F7F;
		}
		.dz-remove{
			font-size: 9pt !important;
		}
		.dz-image{
			border-radius: 0px !important;
		}

		.list-value{
			position: absolute;
			display: none;
			background-color: #fff;
			border: 1px solid #E7E7E7;
			width: 100%;
			z-index: 99;
			max-height: 150px;
			overflow-y: scroll;
		}
		.list-value div{
			padding: 5px 10px;
		}
		.autocomplete_tag{
			font-family: "Roboto";
			font-size: 9pt;
			padding: 7px 10px;
		}
		.autocomplete_tag:hover{
			background-color: #F0F0F0;
		}
		
		.seo_tags{
			position: relative;
		}
		.seo_tags  .bootstrap-tagsinput{
			padding: 4px 10px;
			padding-left: 10px;
		}
		.seo_tags  .bootstrap-tagsinput  span[data-role="remove"]{
			color: #bfbfbf !important;
			margin-left: 0px !important;
		}
		.seo_tags  .bootstrap-tagsinput  span[data-role="remove"]:hover{
			color: #404040 !important;
		}
		.seo_tags  .bootstrap-tagsinput span{
			background-color: rgba(0,0,0,0) !important;
			border:1px solid rgba(0,0,0,0) !important;
			color: #404040 !important;
		}
		.seo_tags  .bootstrap-tagsinput .label{
			padding: 2px 0px !important;
		}
		.seo_tags  .bootstrap-tagsinput input{
			padding-left: 0px;
			min-height: 1em;
		}
	 </style>
		
@endsection
@section('content')
<form ui-jp="parsley" method="post" action="{{route('ppostt_posts.add')}}" enctype="multipart/form-data" id="add_post_form">
<div class="app-header white box-shadow">
<div class="navbar">
		<div style="float:left;" class="title_form">
	      <p>Thêm bài viết</p>
	    </div>
    	<div style="float:right;margin-top:10px;">
    	@if(session('admin')->can('luu_bai_viet'))
    	<button type="submit" name="submit" value="save" class="btn" style="
    	padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 10px;font-family: 'Roboto-Bold';
    	min-width:100px; background-color:#F2F2F2">LƯU</button>
		@endif
    	@if(session('admin')->can('dang_bai_viet'))
		<button type="submit" name="submit"  value="post" class="btn success" style="
		padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 8px;font-family: 'Roboto-Bold';
		min-width:100px; background-color:#738CEC">ĐĂNG</button>
		@endif
    	</div>
       
    <!-- / navbar collapse -->
</div>
</div>

 
	 <div class="app-body" id="view">
		 <style type="text/css">
		 	.alert{
		 		margin-top:20px;
		 		margin-bottom: 0px;
		 	}
		 </style>
	 	<div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
	 			@include('backend.partials._messages')
	 	</div>
	   
	 	<div class="padding">
	 	
			 	 <div class="row">
			 	 	
				    <div class="col-sm-6">
				    
				        <div class="box">
				          <div class="box-header">
				            <h2>Thiết lập</h2>
				          </div>
				        
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-12">
												<input type="hidden" value="{{csrf_token()}}" name="_token">
									           
									            <div class="form-group">
									              <p style="margin-bottom:10px;line-height:0px">
									               <img id="img_preview" style="max-height:200px;">
									              </p>
									              <label for="file_img_preview">
									                <a class="btn info">Chèn ảnh</a>
									              </label>
									              <input type="file" style="display:none" class="form-control" name="post_img"  id="file_img_preview"> 
									                <div class="body-nest" id="DropZone" >
													   <div id="myDropZone" class="dropzone">
													   </div>
													</div>
													<input type="hidden" name="img_post">                  
									            </div>
									           



									             <div class="form-group">
									              <label>Tiêu đề</label>
									              <input type="text" class="form-control" name="post_title">
									            </div>
									            <div class="form-group">
									              <label>Mô tả ngắn</label>
									              <textarea name="post_des" class="form-control" rows="5"></textarea>                       
									            </div>
			     								
												 <div class="form-group">
									                <?php
														$list_categories = App\Category::get();
														 $space = "--";
													?>
												        <label for="multiple">Chọn danh mục</label>
												        <select id="multiple" class="form-control select2-multiple" name="choose_cate[]" multiple >
												        	{{cate_parent($list_categories)}}
												        </select>
												   </div>

									            <!--  <div class="form-group">
												   <label>SEO tiêu đề</label>
											       <input type="text" class="form-control" name="seo_title">
												</div>	
												<div class="form-group">
												   <label>SEO Mô tả không quá 160 kí tự</label>
												   <textarea name="seo_des" class="form-control" rows="4"></textarea>
												</div> -->
												<div class="form-group">
												   <label>Tags: Khi tạo một Tag nhấn "Tab" hoặc "Enter" để kết thúc Tag</label>
											       <input type="text" id="list_tag"  name="seo_tags"   class="form-control" autocomplete="off">
										         
												</div>
												<div class="form-group">
												   <label>Google Struct data</label>
												   <textarea name="seo_struct" class="form-control" rows="4"></textarea>
												</div>
												
									</div>
								    
				         </div>	 
		                  </div>
				         
				        </div>
				     
				    </div>
				    <div class="col-sm-6">
				    
				        <div class="box">
				          <div class="box-header">
				            <h2>Nội dung</h2>
				         
				          </div>
				      
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-12">
											   <p style="margin-top:0px;margin-bottom:10px; font-size:10pt; color:#a6a6a6" class="text-muted">Tab 1 mặc định là bài viết đơn, nếu muốn bài viết nhiều tab vui lòng nhấn Thêm tab</p>
									           	<ul class="nav nav-sm nav-pills nav-active-primary clearfix" id="list_tab_title">
												    <li class="nav-item">
												      <a class="nav-link active" id="default_tab" href data-toggle="tab" data-target="#tab_1">Tab 1</a>
												    </li>
												    <li class="nav-item">
												      <a class="nav-link" href="#" id="add_tab">Thêm tab</a>
												    </li>
												</ul>
												
												<div class="tab-content" id="list_tab_content">      
												    <div class="tab-pane p-v-sm active" id="tab_1">
												      <div class="box m-t p-a-sm">
												      	<div class="form-group">
											              <label>Tên thẻ tab</label>
											              <input type="text" class="form-control i_name" data-tab="1" name="post_name[]" value="Tab 1">
											            </div>
											            <div class="form-group">
											              <!-- <label>Nội dung bài viết</label> -->
											              <textarea  id="editor_1" class="form-control" rows="5" name="post_content[]"></textarea>
											            </div>
											          </div>
												    </div>
												</div>
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
  <script src="{{ asset('summernote/dist/summernote.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/lang/summernote-vi-VN.js') }}"></script>
  <script src="{{ asset('summernote/dist/summernote-image-title.js') }}"></script>
  <script src="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
  <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
  <script src="{{ asset('backend/stag/js/stag.js') }}"></script>
   <?php   $font_default = App\Item::where('key_item', 'font_default')->first();

           $font_custom = App\Item::where('key_item', 'font_custom')->first(); ?>
   <script type="text/javascript">
		submit = 0;
		$(document).on('mouseenter',"button[type=submit]",function(){
			submit = 1;
		});
		$(document).on('mouseleave',"button[type=submit]",function(){
			submit = 0;
		});	
		$(document).on('submit','#add_post_form',function(e){
			if(submit ==0){
				e.preventDefault();
			}
	});
		<?php $list_tag =  App\Tag::get();
			$l_tag= array();
			foreach ($list_tag  as $key => $value) {
					array_push($l_tag,$value->tag);
			}
		?>
		var obj = <?php echo json_encode($l_tag); ?>;
		$("#list_tag").stag('Thêm tag',obj);
		
	</script>

  <script>

   
  // CHen anhr
  $(function() {
		Dropzone.autoDiscover = false;
	    $("div#myDropZone").dropzone({
	    		maxFiles:6,
	    		maxfilesexceeded:function(file){
	    			this.removeFile(file);
	    		},
		        url : "{{route('quan-tri.upload.up-img')}}",
	            addRemoveLinks : true,
			    maxFilesize: 5,
			    dictDefaultMessage: 'Thêm ảnh bài viết',
			    dictResponseError: 'Error uploading file!',
			    headers: {
			        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			    },
			    error: function (file, response) {
			       
			    },
			    success: function (file, response) {
			        console.log($(file.previewElement).find('.dz-filename span').text(response));
			        var fileupload = $('.dz-filename span');
			  		var t = "";
			  		$.each(fileupload,function(i,v){
			  			if( i== fileupload.length - 1 ){
			  				t += $(v).text();
			  			}else{
			  				t += $(v).text()+ ",,,";
			  			}
			  		});
			  		$("input[name='img_post']").val(t);
			  		
			    },
			    removedfile: function(file) {
				    var _ref;
				    _ref = file.previewElement;
				    if(_ref!= null){
				    	_ref.parentNode.removeChild(file.previewElement);
				    	console.log(1);
				    	setTimeout(function(){
				  			
				  		},200);
				    }
				 }
	    });
	});

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
    					'<a class="nav-link " href data-toggle="tab" data-target="#tab_'+c+'">Tab '+c+'<span  tab_id="'+c+'" >×</span></a>'+
										    '</li>';
		var content = '<div class="tab-pane p-v-sm" id="tab_'+c+'">'+
					'<div class="box m-t p-a-sm">'+
			      	'<div class="form-group">'+
		              '<label>Tên thẻ tab</label>'+
		              '<input  type="text" class="form-control i_name"'+
		               'name="post_name[]" value="Tab '+c+'" >'+                        
		            '</div>'+
		            '<div class="form-group">'+
		 '<textarea  id="editor_'+c+'" class="form-control i_content"'+
		  'rows="5" name="post_content[]" ></textarea></div>'+
		    '</div>';
    	$(this).parent().before(html);
    	$("#list_tab_content").prepend(content);
    	
    	$('#editor_'+c).summernote({
   	        lang: "vi-VN",
   	        imageTitle: {
				          specificAltField: true,
				        },
		    height: (485),
		    defaultFontName:'Roboto',
		    fontNames: [{!!isset($font_default) ?$font_default->value.',':''!!}{!!isset($font_custom) ?$font_custom->value:''!!}],
			fontNamesIgnoreCheck: [{!!isset($font_custom) ?$font_custom->value:''!!}],
	  
		    popover: {
					  image: [
					    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					    ['float', ['floatLeft', 'floatRight', 'floatNone']],
					    ['custom', ['imageTitle']],
					    ['remove', ['removeMedia']]
					  ],
					  link: [
					    ['link', ['linkDialogShow', 'unlink']]
					  ],
					  air: [
					    ['color', ['color']],
					    ['font', ['bold', 'underline', 'clear']],
					    ['para', ['ul', 'paragraph']],
					    ['table', ['table']],
					    ['insert', ['link', 'picture']]
					  ]
			},
			toolbar: [
			    ['style', ['style']],
			    ['font', [ 'italic', 'underline', 'clear']],
			    ['fontname', ['fontname']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    // ['height', ['height']],
			    ['table', ['table']],
			    ['insert', ['link', 'picture', 'video']],
			    ['view', [ 'codeview']],
			    ['help', ['help']]
			  ],
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
  
    count= 0 ;
  	var TEMP_I = ''
	click_tag = false;

  	$("#search_tag").on('itemAdded', function(event) {
 		if(event.item == TEMP_I){
 			if(click_tag||count==0){
 				$("#search_tag").tagsinput('remove',event.item);
	    		click_tag= false;count++;
	    	}		
	    }
	});
	$("#search_tag").on('beforeItemAdd', function(event) {
		value = $('#search_tag').val();
		temp = $('.seo_tags .bootstrap-tagsinput input').val();
		this_item = event.item;
		l = value.split(",");c = 0;
    	$.each(l,function(i,v){
    		if(v == temp) c++;
    	});
    	if(c==0){
    		if(this_item ==  temp){
    			TEMP_I  = temp;
    		}	
    	}
	});
	$(document).on('click','.autocomplete_tag',function(e){
		click_tag = true;
		v = $('.seo_tags .bootstrap-tagsinput input').val();
		s_value = v;
  		$('.seo_tags .bootstrap-tagsinput input').val('');
  		$('.list-value').css('display','none');
  		tagsinput = $(this).parent().prev();
  		$(tagsinput).tagsinput('add',$(this).text());
  		$(tagsinput).tagsinput('removeData',$(this).text());
  
  	});
  	
  	$(document).on('keyup','.seo_tags .bootstrap-tagsinput input',function(e){
  		cony = this;
  		var key = $(cony).parent().prev().val();
  		var container = $(cony).parent().next().next();
  		value = $(cony).val();
  		
  		$(container).css('display','block');
  		if($(cony).hasClass('data_avaiable')){
  		}else{
  			$(cony).addClass('data_avaiable');

  			$.ajax({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              type:"post",
              url:"{{route('get_list_tag_ajax')}}",
              data:{'key':"post",'name_tag':value},
              success:function(data){
              	// console.log(data.list);
              	
              	$(cony).removeClass('data_avaiable');
              	var d = "";
              	$.each(data.list,function(i,v){
              		d += "<div class='autocomplete_tag'>"+v.tag+"</div>"
              	});
              	$(container).html(d);
              },
              cache:false,
              dataType:'json'
          	});
  		}
  	});

  	$(document).on('blur','.seo_tags .bootstrap-tagsinput input',function(e){

  		setTimeout(function(){
  			$('.list-value').css('display','none');
  		},400);
  		
  	});


    $(document).on('click','.nav-link span',function(){
    	id = $(this).attr('tab_id');
    		if(id!=1){
    				$("#tab_"+id).remove();
    				$("#li_tab"+id).remove();
    		};
    	$("#default_tab").click();
    });
    
	 $('#editor_1').summernote({
	 	     lang: 'vi-VN',
	 	     imageTitle: {
				          specificAltField: true,
				        },
   	        
		    height: (485),
		    fontNames: [{!!isset($font_default) ?$font_default->value.',':''!!}{!!isset($font_custom) ?$font_custom->value:''!!}],
			fontNamesIgnoreCheck: [{!!isset($font_custom) ?$font_custom->value:''!!}],
	       
		    popover: {
		    	       
					  image: [
					    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					    ['float', ['floatLeft', 'floatRight', 'floatNone']],
					    ['custom', ['imageTitle']],
					    ['remove', ['removeMedia']]
					  ],
					  link: [
					    ['link', ['linkDialogShow', 'unlink']]
					  ],
					  air: [
					    ['color', ['color']],
					    ['font', ['bold', 'underline', 'clear']],
					    ['para', ['ul', 'paragraph']],
					    ['table', ['table']],
					    ['insert', ['link', 'picture']]
					  ]
			},
			
			toolbar: [
			    ['style', ['style']],
			    ['font', [ 'italic', 'underline', 'clear']],
			    ['fontname', ['fontname']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    // ['height', ['height']],
			    ['table', ['table']],
			    ['insert', ['link', 'picture', 'video']],
			    ['view', [ 'codeview']],
			    ['help', ['help']]
			  ],
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
		        success: function(data) {
		           var image = $('<img>').attr('src', data['url']).attr('alt', data['name']).attr('title', data['name']);
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
	  $(".select2-multiple").select2({
	  placeholder: "Không thuộc danh mục nào",
	  allowClear: true
	});
	
	 $.each($('textarea'),function(i,v){
	 	$(v).attr('spellcheck','false');
	 });
	 	$.each($('input'),function(i,v){
	 	$(v).attr('spellcheck','false');
	 });
	 $.each($('.note-editable'),function(i,v){
	 	$(v).attr('spellcheck','false');
	 });
	 $(document).ready(function() {
	 	$("body").on('keyup', ".bootstrap-tagsinput input", function(evt) {
              tag = $(this).val();
              $.ajax({
              	'type': 'post',
              	 'url':  '{{ route('tag.post.search') }}',
              	 'data': {'name':tag, '_token': '{{csrf_token()}}'},
              	 'cache': false,
              success: function(data){
              	console.log(data);
              	$('#tag-list').html('');
              	$('#tag-list').append(data);
              }
              })
	     
	    }); 
	  }); 
  </script>

@endsection