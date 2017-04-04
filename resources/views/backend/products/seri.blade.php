@extends('backend.layouts.default')
@section('css')
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('summernote/dist/summernote.css') }}" type="text/css" />
	
	 <link rel="stylesheet" href="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/stag/css/stag.css') }}" type="text/css" />
	
	 <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	 <style type="text/css">
	 	.add-attribute,.material-icons{cursor:pointer}.list-value,.none,.select2-search__field{display:none}h2{font-family:Roboto-Bold;font-size:10.5pt!important}div#myDropZone{width:100%;min-height:100px;background-color:#F0F0F0;border:1px solid #E7E7E7!important}.dz-message span{font-size:10pt!important;font-family:Roboto;color:#7F7F7F}.dz-remove{font-size:9pt!important}.dz-image{border-radius:0!important}option:disabled{background:#ddd}.select2-container .select2-selection--single{height:37px}.select2-selection__arrow{height:35px!important}.select2-search--dropdown{padding:0!important}.select2{width:100%!important;font-size:10pt}.select2-selection__rendered{font-size:10pt!important}.add-attribute{position:absolute;right:15px;top:10px;color:#738CEC}.modal-dialog{width:600px;margin:70px auto}.modal-content{border-radius:0}.modal-header{padding:12px 15px;border-bottom:1px solid #E7E7E7}.modal-title{font-size:10.5pt;font-family:"Roboto Bold"}.add-attr{background-color:#92D050;color:#fff;font-size:10pt;padding-top:5px;padding-bottom:5px;width:70px}.add-attr:hover{background-color:#92D050!important;color:#fff}.attr-item{position:relative}.list-value{position:absolute;background-color:#fff;border:1px solid #E7E7E7;width:100%;z-index:99;max-height:150px;overflow-y:scroll}.m-money,.seo_tags{position:relative}.autocomplete:hover,.autocomplete_tag:hover{background-color:#F0F0F0}.list-value div{padding:5px 10px}.autocomplete,.autocomplete_tag{font-family:Roboto;font-size:9pt;padding:7px 10px}.add_attr_tab{color:#738CEC}.attr-item .bootstrap-tagsinput span,.seo_tags .bootstrap-tagsinput span{background-color:rgba(0,0,0,0)!important;border:1px solid transparent!important}.attr-item .bootstrap-tagsinput{padding:4px 10px}.attr-item .bootstrap-tagsinput span[data-role=remove]{color:#bfbfbf!important;margin-left:0!important}.attr-item .bootstrap-tagsinput span,.attr-item .bootstrap-tagsinput span[data-role=remove]:hover{color:#404040!important}.attr-item .bootstrap-tagsinput .label{padding:2px 0!important}.attr-item .bootstrap-tagsinput input{padding-left:0;min-height:1em}.seo_tags .bootstrap-tagsinput{padding:4px 10px}.seo_tags .bootstrap-tagsinput span[data-role=remove]{color:#bfbfbf!important;margin-left:0!important}.seo_tags .bootstrap-tagsinput span,.seo_tags .bootstrap-tagsinput span[data-role=remove]:hover{color:#404040!important}.seo_tags .bootstrap-tagsinput .label{padding:2px 0!important}.seo_tags .bootstrap-tagsinput input{padding-left:0;min-height:1em}.m-money .m-tooltip,.m-money1 .m-tooltip{height:28px;width:auto;padding-top:4px;padding-left:10px;padding-right:10px;font-family:Roboto;font-size:10pt;z-index:9999;background-color:#000;color:#fff;top:60px}.modal-content{border:0}.m-money1:hover .m-tooltip,.m-money:hover .m-tooltip{display:block}.m-money .m-tooltip{position:absolute;border:1px solid #E7E7E7;border-bottom:0;border-radius:6px}.m-money .m-tooltip:after{content:"";position:absolute;bottom:100%;left:50%;margin-left:-5px;border-width:5px;border-style:solid;border-color:transparent transparent #000}.m-money1{position:relative}.m-tooltip{display:none}.m-money1 .m-tooltip{position:absolute;border:1px solid #E7E7E7;border-bottom:0;border-radius:6px}.m-money1 .m-tooltip:after{content:"";position:absolute;bottom:100%;left:50%;margin-left:-5px;border-width:5px;border-style:solid;border-color:transparent transparent #000}#add_youtube{position:absolute;right:15px;top:10px;color:#738CEC}.link_youtube{position:relative}.alert{margin-top:20px;margin-bottom: 0px;}
	 		.link_youtube input{width:calc(100%)}
	 		.link_youtube i{position:absolute;right:0;top:14px;transform:rotate(135deg);color:#DA2623;margin-right: 7px;margin-top:-3px; color: #9c9c94 !important; visibility: hidden; opacity: 0}
	 		.link_youtube:hover i{
	 			visibility: visible; opacity: 1;
	 			transition: 0.4s
	 		}
	 		i {
			  -webkit-touch-callout: none; 
			    -webkit-user-select: none; 
			     -khtml-user-select: none; 
			       -moz-user-select: none; 
			        -ms-user-select: none;
			            user-select: none; 
			}
			.list_attr_tab button{
				background-color: #F0F0F0 !important;
			    border: 1px solid #E7E7E7;
			    border-radius: 0px;
			    color: #7f7f7f;
				min-height: 1.375rem;
    			padding: 0.2345rem 0.30rem;
			}
			.list_attr_tab button:hover{
				background-color: #7f7f7f !important;
				color: #fff !important;
			}
			.list_attr_tab button:active{
				background-color: #7f7f7f  !important;
				color: #fff !important;
			}
			.list_attr_tab button:focus{
				background-color: #7f7f7f  !important;
				color: #fff !important;
			}
			.list_attr_tab .form-control {
				min-height: 1.375rem;
			}
			.del_related #d_sty:hover{
				font-family: Roboto-Bold;
				color: #000!important;
			}
			 .dz-progress{
		    	background-color: rgba(255,255,255,0) !important;
		    }
			
	</style>
@endsection
@section('content')
<form ui-jp="parsley" method="post" action="{{route('product.seri.post')}}" enctype="multipart/form-data" id="form-add-product">
<div class="app-header white box-shadow">
<div class="navbar">
		<div style="float:left;" class="title_form">
	      <p>Chỉnh sửa Series {{$product->name}}</p>
	    </div>
	    <div style="float:right;margin-top:10px;">
	    	<button  type="submit" name="submit"  value="post" class="btn success" style="
			padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 8px;font-family: 'Roboto-Bold';
			min-width:100px; background-color:#738CEC">LƯU</button>
		</div>
    <!-- / navbar collapse -->
</div>
</div>
	 <div class="app-body" id="view">
	 	<div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
	 		@include('backend.partials._messages')
	 	</div>
	 	<div class="padding">
			 	<div class="row">
				    <div class="col-sm-12 item">
				        <div class="box">
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-6">
									        <div class="form-group">
								              <label>Tên Series</label>
								              <input type="text" class="form-control" name="seri_name" autocomplete="off" value="{{$product->name}}" >
								            </div>
								            <div class="form-group">
								              <label>Mô tả ngắn</label>
								              <textarea name="seri_des" class="form-control" rows="5">{{$product->description}}</textarea>
								            </div>
							        </div>
									<div class="col-sm-6">
										<input type="hidden" value="{{csrf_token()}}" name="_token">
										<input type="hidden" value="{{$product->id}}" name="seri_id">
							            <div class="form-group">
							            	<label style="margin-bottom:5px;">Ảnh mô tả nhóm nếu có</label>
								              <p style="margin-bottom:10px;line-height:0px">
								               <img id="img_preview" style="max-height:200px;" @if($product->img) src="{{$product->img}}" @endif >
								              </p>
								              <label for="file_img_preview">
								                <a class="btn info">Chèn ảnh</a>
								              </label>
								              <input type="file" style="display:none" class="form-control" name="prod_img"  id="file_img_preview">                    
							            </div>
							        </div>
							        
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- Begin Item Nhãn -->
				    
				    <!-- End item -->
				    <!-- End item -->
				    <!-- Begin Item -->
				   <!--  <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Mô tả chi tiết</h2></div>
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-12">
									   	<div class="tab-content" id="list_tab_content">      
										    <div class="tab-pane p-v-sm active" id="tab_1">
										      <div class="box m-t p-a-sm">
										      	<div class="form-group">
									              <textarea  id="editor_1" class="form-control" rows="5" name="post_content"></textarea>
									            </div>
									          </div>
									        </div>
										</div>       	
				          			</div> 
				        	 </div>	 	
		                  </div>
				        </div>
				     </div> -->
				    <!-- End Item -->
				    <!-- Begin Item youtube -->
				    <!-- <?php $links_yt = json_decode($product->youtube_link);?> -->
				   <!--  <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Video Youtube</h2>
				          <i class="material-icons md-24" id="add_youtube">&#xe147;</i>
				          </div>
				          <div class="box-body">
							<div class="row">
								<div class="col-sm-12" id="add_youtube_containner">
									@if( is_array($links_yt) )
									@foreach($links_yt as $link)
									<div class="form-group link_youtube" >
						              <input type="text" class="form-control" name="youtube[]"  autocomplete="off" value="{!! $link !!}">
						              <i class="material-icons md-20 close_yt">&#xe147;</i>
						            </div>
						            @endforeach
						            @endif
								</div>
							</div>
						  </div>
						</div>
					</div> -->
					<!-- End item -->
			 	</div>
	 </div>
</form>

@stop
@section('js-footer')
  <?php   $font_default = App\Item::where('key_item', 'font_default')->first();
           $font_custom = App\Item::where('key_item', 'font_custom')->first();
   ?>
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/summernote.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/lang/summernote-vi-VN.js') }}"></script>
  <script src="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
  <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
  <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
  <script src="{{ asset('backend/stag/js/stag.js') }}"></script>
  <script type="text/javascript">
   		submit = 0;
   		$(document).on('mouseenter',"button[type=submit]",function(){
   			submit = 1;
   		});
   		$(document).on('mouseleave',"button[type=submit]",function(){
   			submit = 0;
   		});	
   		$(document).on('submit','#form-add-product',function(e){
   			if(submit ==0){
   				e.preventDefault();
   			}
		});
   		
   		setInterval(function(){
   			load_masonry();
   		},1000);
  </script>

  <script>
  	
	// $('#editor_1').summernote({
 //   	        lang: "vi-VN",
	// 	    height: (270),
	// 	    fontNames: [{!!isset($font_default) ?$font_default->value.',':''!!}{!!isset($font_custom) ?$font_custom->value:''!!}],
	// 		fontNamesIgnoreCheck: [{!!isset($font_custom) ?$font_custom->value:''!!}],
	  
	// 	    popover: {
	// 				  image: [
	// 				    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
	// 				    ['float', ['floatLeft', 'floatRight', 'floatNone']],
	// 				    ['remove', ['removeMedia']]
	// 				  ],
	// 				  link: [
	// 				    ['link', ['linkDialogShow', 'unlink']]
	// 				  ],
	// 				  air: [
	// 				    ['color', ['color']],
	// 				    ['font', ['bold', 'underline', 'clear']],
	// 				    ['para', ['ul', 'paragraph']],
	// 				    ['table', ['table']],
	// 				    ['insert', ['link', 'picture']]
	// 				  ]
	// 		},
			
	// 		toolbar: [
	// 		    ['style', ['style']],
	// 		    ['font', [ 'italic', 'underline', 'clear']],
	// 		    ['fontname', ['fontname']],
	// 		    ['color', ['color']],
	// 		    ['para', ['ul', 'ol', 'paragraph']],
	// 		    // ['height', ['height']],
	// 		    ['table', ['table']],
	// 		    ['insert', ['link','picture']],
	// 		    ['view', [ 'codeview']],
	// 		    ['help', ['help']]
	// 		  ],
	// 	    callbacks: {
	// 	        onImageUpload: function(image) {
	// 	            uploadImage(image[0],"#editor_1");
	// 	        }
	// 	    }
	// });
  
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
	            load_masonry();
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#file_img_preview").change(function(){
	    readURL(this);
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
	 function load_masonry(){
	      var $container = $('.masonry-container');
	      $container.masonry({
	        columnWidth: '.item',
	        itemSelector: '.item'
	      });   
	  }
	  load_masonry();
	  setTimeout(function(){
			load_masonry();
	  },500);

	 // thêm yt
	 $(document).on('click','#add_youtube',function(){
	 	str = '<div class="form-group link_youtube" >'+
	              '<input type="text" class="form-control" name="youtube[]" autocomplete="off" >'+
	              '<i class="material-icons md-20 close_yt">&#xe147;</i>'+
	            '</div>';
	    $("#add_youtube_containner").append(str);
	    load_masonry();
	 });
	 $(document).on('click','.close_yt',function(){
	 	$(this).parent().remove();
	 	load_masonry();
	 });

  </script>

@endsection