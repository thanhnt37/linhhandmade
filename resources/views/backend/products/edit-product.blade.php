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
	 	h2{
	 		    font-family: "Roboto-Bold";
	 		    font-size: 10.5pt !important;
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
		}
		.dz-remove{
			font-size: 9pt !important;
		}
		.dz-image{
			border-radius: 0px !important;
		}
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
	    .dz-progress{
	    	background-color: rgba(255,255,255,0) !important;
	    }
	     .add-attribute{
	    	position: absolute;
	    	right: 15px;
	    	top: 10px;
	    	color: #738CEC;
	    	cursor: pointer;
	    }
	    .modal-dialog {
		    width: 600px;
		    margin: 70px auto;
		}
		.modal-content{
			border-radius: 0px;
			border: 1px solid #E7E7E7;
		}
		.modal-header {
		    padding: 12px 15px;

		    border-bottom: 1px solid #E7E7E7;
		}
		.modal-title{
			font-size: 10.5pt;
			font-family: "Roboto Bold";
		}
		.add-attr{
		    background-color: #92D050;
		    color: #fff;
		    font-size: 10pt;
		    padding-top: 5px;
		    padding-bottom: 5px;
		    width: 70px;
		}
		.add-attr:hover{
		    background-color: #92D050 !important;
		    color: #fff;
		}
		.modal-content{
	        border: 0px;
	    }
		.attr-item{
			position: relative;
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
		.add_attr_tab{
			color:#738CEC;
		}
		.autocomplete{
			font-family: "Roboto";
			font-size: 9pt;
			padding: 7px 10px;
		}
		.autocomplete:hover{
			background-color: #F0F0F0;
		}
		.attr-item  .bootstrap-tagsinput{
			padding: 4px 10px;
			padding-left: 10px;
		}
		.attr-item  .bootstrap-tagsinput  span[data-role="remove"]{
			color: #bfbfbf !important;
			margin-left: 0px !important;
		}
		.attr-item  .bootstrap-tagsinput  span[data-role="remove"]:hover{
			color: #404040 !important;
		}
		.attr-item  .bootstrap-tagsinput span{
			background-color: rgba(0,0,0,0) !important;
			border:1px solid rgba(0,0,0,0) !important;
			color: #404040 !important;
		}
		.attr-item  .bootstrap-tagsinput .label{
			padding: 2px 0px !important;
		}
		.attr-item  .bootstrap-tagsinput input{
			padding-left: 0px;
			min-height: 1em;
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
		.material-icons{
			cursor: pointer;
		}
		.m-money{
			position: relative;
		}
		.m-money:hover .m-tooltip{
			display: block;
		}
		.m-tooltip{
			display: none;
		}
		.m-money .m-tooltip{
			position: absolute;
			height: 28px;
			width: auto;
			background-color: #fff;
			border: 1px solid #E7E7E7;
			padding-top: 4px;
			padding-left: 10px;
			padding-right: 10px;
			border-bottom: 0px;
			font-family: "Roboto";
			font-size: 10pt;
			z-index: 9999;
			background-color: black;
			color: #fff;
			border-radius: 6px;
			top: 60px;
		}
		.m-money .m-tooltip:after{    
			content: "";
		    position: absolute;
		    bottom: 100%;
		    left: 50%;
		    margin-left: -5px;
		    border-width: 5px;
		    border-style: solid;
		    border-color: transparent transparent #000 transparent;
		}
		.m-money1{
			position: relative;
		}
		.m-money1:hover .m-tooltip{
			display: block;
		}
		.m-tooltip{
			display: none;
		}
		.m-money1 .m-tooltip{
			position: absolute;
			height: 28px;
			width: auto;
			background-color: #fff;
			border: 1px solid #E7E7E7;
			padding-top: 4px;
			padding-left: 10px;
			padding-right: 10px;
			border-bottom: 0px;
			font-family: "Roboto";
			font-size: 10pt;
			z-index: 9999;
			background-color: black;
			color: #fff;
			border-radius: 6px;
			top: 60px;
		}
		.m-money1 .m-tooltip:after{    
			content: "";
		    position: absolute;
		    bottom: 100%;
		    left: 50%;
		    margin-left: -5px;
		    border-width: 5px;
		    border-style: solid;
		    border-color: transparent transparent #000 transparent;
		}
		.alert{
		 		margin-top:20px;
		 		margin-bottom: 0px;
		 	}
	 </style>

@endsection
@section('content')

	<?php $frame_config = App\Item::where('key_item','config_frame_attribute')->where('value','>',0)->first(); 
			if($frame_config){
			$attr_frame = App\Attribute::where('id',$frame_config->value)->where('type',1)->where('avaiable',0)->first();
		}
		$attribute = App\Attribute::where('type',1)->groupby('name')->orderby('created_at')->get();
	
?>
<form ui-jp="parsley" method="post" action="{{route('product.edit')}}" enctype="multipart/form-data" id="form-edit-product">
<div class="app-header white box-shadow">
<div class="navbar">
		<div style="float:left;" class="title_form">
	      <p>Chỉnh sửa sản phẩm</p>
	    </div>
    	<div style="float:right;margin-top:10px;">
		@if(session('admin')->can('luu_san_pham'))
    	<button type="submit" name="submit" value="save" class="btn" style="
    	padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 10px;font-family: 'Roboto-Bold';
    	min-width:100px; background-color:#F2F2F2">LƯU</button>
		@endif
		@if(session('admin')->can('them_san_pham'))
		<button type="submit" name="submit"  value="post" class="btn success" style="
		padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 8px;font-family: 'Roboto-Bold';
		min-width:100px; background-color:#738CEC">ĐĂNG</button>
		@endif
    	</div>
    	<input type="hidden" value="{{csrf_token()}}" name="_token">
    	<input type="hidden" value="{{$product->id}}" name="id">
    <!-- / navbar collapse -->
</div>
</div>

 
	 <div class="app-body" id="view">
		
	 	<div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
	 			@include('backend.partials._messages')
	 	</div>
	   
	 	<div class="padding">
	 	
			 	 <div class="row masonry-container">
			 	 	<div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Ảnh</h2></div>
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-12">
												
												
							           <div class="form-group">
							           	  <div>   
							               <label tyle="margin-bottom:10px;">
							                <p style="margin-bottom:10px;line-height:0px">Ảnh preview</p>
							               </label>
							              </div>
							              <p style="margin-bottom:10px;line-height:0px">
							               <img id="img_preview" style="max-height:200px;" @if($product->img) src="{{$product->img}}" @endif>
							              </p>
							              <label for="file_img_preview">
							                <a class="btn info">Chèn ảnh</a>
							              </label>
							              <input type="file" style="display:none" class="form-control" name="prod_img"  id="file_img_preview">                    
							            </div>
							            <label tyle="margin-bottom:10px;">
							                <p style="margin-bottom:10px;line-height:0px">Ảnh chi tiết sản phẩm</p>
							            </label>
							            <div class="body-nest" id="DropZone" >
										   <div id="myDropZone" class="dropzone">
										   </div>
										</div>
										<input type="hidden" name="img_product">
									            
									</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    
				     <!-- Begin Item Thêm thuộc tính -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Thêm thuộc tính</h2>
				          	<i class="material-icons md-24  add-attribute" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="fade-left-big" ui-target="#animate">&#xe147;</i>
				          	
							<!-- .modal -->
							<div id="m-a-a" class="modal fade animate" data-backdrop="true">
							  <div class="modal-dialog" id="animate">
							    <div class="modal-content">
							      <div class="modal-header">
							      	<h5 class="modal-title">Thêm thuộc tính</h5>
							      </div>
							      <div class="modal-body p-lg">
							      		
						      		    <div class="table-responsive">
				                                <table class="table b-t">
				                                  <tbody>
				                                  	@foreach($attribute as $key => $value)
				                                  		<?php $c=0;?>
				                                  		@foreach($attr as $key2 => $value2 )
				                                  			@if($value->name == $value2->name)
				                                  				<?php $c++;?>
				                                  			@endif
				                                  		@endforeach

					                                    <tr>
					                                      <td style="width: 5%">
					                                      <label class="ui-check m-a-0">
					                                      <input type="checkbox" class="add_check" data-id="{{$value->id}}" data-name="{{$value->name}}"
					                                      @if($c) checked="" @endif 
					                                      >
					                                      	<i class="dark-white" ></i>
					                                      </label>
					                                      </td>
					                                      <td>{{$value->name}}</td>
					                                    </tr>
				                                    @endforeach
				                                  </tbody>
				                                </table>
				                        </div>
									    <a id="add_item" class="btn btn-sm warn pull-left add-attr"  data-dismiss="modal">Chọn</a>
									    <div style="clear:both"></div>
								   </div>
							    </div><!-- /.modal-content -->
							  </div>
							</div>
							<!-- / .modal -->
				          </div>
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-12" id="atrribute-containner">
											@foreach($attr as $key => $value )
											
									      	<div class="row attr-item ">
									        	<div class="col-sm-3">
									        		<label style="margin-top:10px;">{{$value->name}}</label>
									        	</div>
									        	<div class="col-sm-9">
									        		<div class="form-group attr-item ">
									        			<input type="hidden"  name="attrbute_k[]" value="{{$value->name}}">
											            <input type="text" class="form-control i_name" name="attrbute_v[]" value="{{$value->value}}">
											        </div>
									        	</div>
									        </div>
									        @endforeach
									</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->

				     <!-- Begin Item Nhãn -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Nhãn</h2></div>
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-12" style="">
											<div class="form-group">
							            	<label for="single">Nhãn</label>
									        <select id="single" class="form-control select2" name="label">
									            <option value="0" @if($product->label == 0 ) selected @endif>Không nhãn</option>
									            <option value="1" @if($product->label == 1 ) selected @endif>New</option>
									            <option value="2" @if($product->label == 2 ) selected @endif>Kool</option>
									            <option value="3" @if($product->label == 3 ) selected @endif>Off</option>
									        </select>
									    </div>	
									</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->
				    <!-- Begin Item -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Mô tả chi tiết</h2></div>
				          <div class="box-body">
							<div class="row">
									<div class="col-sm-12">
									   	<ul class="nav nav-sm nav-pills nav-active-primary clearfix" id="list_tab_title">
							           	  @foreach ($content as $key => $v3)
                                            @if($key==0)
										    <li class="nav-item">
										      <a class="nav-link active " id="default_tab" href data-toggle="tab" data-target="#tab_1">Tab 1</a>
										    </li>
                                            @else
										     <li class="nav-item new_tab" id="li_tab{{$key+1}}"><a class="nav-link " href data-toggle="tab" data-target="#tab_{{$key+1}}">Tab {{$key+1}}<span tab_id="{{$key+1}}">×</span></a></li>
										    
										     @endif
										   @endforeach
										   <li class="nav-item">
										      <a class="nav-link" href="#" id="add_tab">Thêm tab</a>
										    </li>   
										</ul>
										
										<div class="tab-content" id="list_tab_content"> 
										 @foreach ($content as $key => $v3)
										    <div class="tab-pane p-v-sm @if($key==0) active @endif" id="tab_{{$key+1}}">
										     <input type="hidden" name="content[id][]" value="{{$v3->id}}">
										      <div class="box m-t p-a-sm">
										      	<div class="form-group">
									              <label>Tên thẻ tab</label>
									              <input type="text" class="form-control" data-tab="1" name="content[name][]" value="{{$v3->name}}">
									            </div>
									            <div class="form-group">
									              <!-- <label>Nội dung bài viết</label> -->
									              <textarea  id="editor_{{$key+1}}" class="form-control" rows="5"  data-content="{{$v3->id}}" name="content[content][]">{{$v3->content}}</textarea>
									            </div>
									          </div>
									          <div class="attr_container">
									          	<?php $x = $v3->getAttributes_group;?>
									          	<div class="view_des">
									          	<i class="material-icons md-24 add_attr_tab" data-toggle="modal">&#xe147;</i>
									          	@if(sizeof($x))
									          		<span>Đã chọn {{sizeof($x)}} thuộc tính</span>
									          	@else
									          		<span>Thêm đặc tính</span>
									          	@endif
									          	
									          	</div>
									          	<?php $v_str="" ; foreach( $x as $it){
									          		$v_str .= $it->name.",";
									          	}?>
									          	<input type="hidden" name="tab_list[]" class="list_attr_valie" value="{{$v3->json_attr}}">
									          	<div class="tab_list_attr">
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
				    <!-- End Item -->
				    <!-- Begin Item Thuộc tính -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Các thuộc tính cơ bản</h2></div>
				          <div class="box-body">
							<div class="row">
								<div class="col-sm-12">
											<div class="form-group">
								              <label>Tên sản phẩm</label>
								              <input type="text" class="form-control" name="product_name" value="{{$product->name}}" autocomplete="off">                        
								            </div>
								            <div class="form-group">
								              <label>Mã sản phẩm</label>
								              <input type="text" class="form-control" name="product_code" value="{{$product->code_product}}" autocomplete="off" >
								            </div>
								            <div class="form-group m-money1">
								              <label>Khối Lượng : đvt = gam/1 sản phẩm . vd: 15.51</label>
								              <input  type="text" class="form-control" name="weight" autocomplete="off" value="{{ $product->weight }}">
								               <div class="m-tooltip"></div>
								            </div>
								            <div class="form-group">
								              <label>Mô tả ngắn</label>
								              <textarea name="product_des" class="form-control" rows="5">{{$product->short_description}}</textarea>
								            </div>
										    <div class="form-group m-money">
								              <label>Giá niêm yết</label>
								              <input  type="text" class="form-control" name="price"  value="{{$product->price}}" autocomplete="off" >
								              <div class="m-tooltip"></div>
								            </div>
								             <div class="form-group m-money">
								              <label>Giá bán</label>
								              <input  type="text" class="form-control" name="price_sale" value="{{$product->price_sale}}"  autocomplete="off" >
								              <div class="m-tooltip"></div>
								            </div>
								            <div class="form-group">
								              <label>Số lượng sản phẩm</label>
								              <input type="number"  type="text" class="form-control" name="sku" value="{!! $product->sku !!}" >
								            </div>
								            <div class="form-group seo_tags">
											   <label>Tags : Khi tạo một Tag nhấn "Tab" hoặc "Enter" để kết thúc Tag</label>
										       <input type="text" id="list_tag"  name="seo_tags"  class="form-control" autocomplete="off" value="{!!old('seo_tags'), isset($product_tags) ? $product_tags : ''!!}">
									        </div>
									        <div class="form-group">
								                <?php
													$list_categories = App\CategoryProduct::get();
													 $space = "--";
												?>
											        <label for="multiple">Danh mục sản phẩm</label>
											       
											        <select id="multiple" class="form-control select2-multiple" name="choose_cate[]" multiple >
											        	<?php mutiselect ($list_categories , $parent=0, $str='', $catIds) ?>
											        </select>
											</div>
											
											
												
								</div>
							</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->
				   
			 	</div>
	 	 
	 </div>
</form>
<div id="m-a-tab" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title" style="float:left">Thêm thuộc tính</h5>
      	<div style="float:right">
      		<i class="material-icons md-24 add_row_attr">&#xe147;</i>
      	</div>
      </div>
       <div class="modal-body p-lg">
				<div class="row">
      	    		<div class="col-sm-12 list_attr_tab" >
      	    			
		      	    	
      	    		</div>
      	    	</div>
      	   	<a id="add_attr_to_tab" class="btn btn-sm warn pull-left add-attr"  data-dismiss="modal" style="width:120px">Lưu thay đổi</a>
		    <div style="clear:both"></div>
	   </div>
    </div><!-- /.modal-content -->
  </div>
</div>

@stop
@section('js-footer')

  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/summernote.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/lang/summernote-vi-VN.js') }}"></script>
  <script src="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
  <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
  <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
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
   		$(document).on('submit','#form-edit-product',function(e){
   			if(submit ==0){
   				e.preventDefault();
   			}
		});
		<?php $list_tag =  App\TagP::get();
   			$l_tag= array();
   			foreach ($list_tag  as $key => $value) {
   					array_push($l_tag,$value->tag);
   			}
   		?>
   		var obj = <?php echo json_encode($l_tag); ?>;
   		$("#list_tag").stag('Thêm tag',obj);
   		i_name = $('.i_name');
   		$.each(i_name,function(i,v){
   			$(v).stag("Thêm " + $(v).prev().val(),[]);
   		});
   		
   		setInterval(function(){
   			load_masonry();
   		},1000);
   		$(document).on('mouseenter','.m-money',function(){
   			value = $(this).find('input').val();
   			if(!value){
				$(this).find('.m-tooltip').text("Chưa nhập giá");
   			}else{
   				value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
   				
   				$(this).find('.m-tooltip').text(value+"đ");
   			}
   		});
   		$(document).on('keyup','.m-money input',function(){
   			value = $(this).val();
   			if(!value){
				$(this).next().text("Chưa nhập giá");

   			}else{
   				value = parseInt(value);
				value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
   				$(this).next().text(value+"đ");
   			}
   		});
   		// jquery khối lượng
   		$(document).on('mouseenter','.m-money1',function(){
   			value = $(this).find('input').val();
   			if(!value){
				$(this).find('.m-tooltip').text("Chưa nhập Khối Lượng");
   			}else{
   				// value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
   				
   				$(this).find('.m-tooltip').text(value+"gam");
   			}
   		});
   		$(document).on('keyup','.m-money1 input',function(){
   			value = $(this).val();
   			if(!value){
				$(this).next().text("Chưa nhập Khối Lượng");

   			}else{
   				value = parseFloat(value);
				// value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
   				$(this).next().text(value+"gam");
   			}
   		});
   </script>
  <script>
  
  	$(document).on('click','#add_item',function(){
  		var list_check = $(".add_check:checked");
  		var list_uncheck = $(".add_check:not(:checked)");
  		$.each(list_check,function(i,v){
  			id = $(v).attr('data-id');
  			text = $(v).attr('data-name');
  			var d = $('.attr-item input[value="'+text+'"]');
  			if(d.length == 0){
	  			content = '<div class="row attr-item ">'+
				        	'<div class="col-sm-3">'+
				        		'<label style="margin-top:10px;">'+text+'</label>'+
				        	'</div>'+
				        	'<div class="col-sm-9">'+
				        		'<div class="form-group attr-item ">'+
				        			'<input type="hidden"  name="attrbute_k[]" value="'+text+'">'+
						            '<input type="text"  class="form-control i_name attr_temp" name="attrbute_v[]" autocomplete="off">'+
						        '</div>'+
				        	'</div>'+
				        '</div>';
		  		$("#atrribute-containner").append(content);
		  		$(".attr_temp").stag('Thêm '+text,['1','2']);
	  			$(".attr_temp").removeClass('attr_temp');
	  		}	  		
  		});
  		$.each(list_uncheck,function(i,v){
  			id = $(v).attr('data-id');
  			text = $(v).attr('data-name');
  			var d = $('.attr-item input[value="'+text+'"]');
  			if(d.length !== 0){
  				$(d).parent().parent().parent().remove();
  			}
  		});
  		load_masonry();
  	});
  
  	$(document).on('focus','.attr-item .stag-input',function(e){
  		input = this;
  		container  = $(this).getStagContainer();
  		var key = $(container).prev().prev().val();
  		if($(input).hasClass('data_avaiable')){
  		}else{
  			$.ajax({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              type:"post",
              url:"{{route('check-key.products')}}",
              data:{'key':key},
              success:function(data){
              	list = [];
              	$.each(data.list,function(i,v){
              		list.push(v.value);
              	});
              	$(input).addClass('data_avaiable');
              	$(container).stagSuggestList(list);
              },
              cache:false,
              dataType:'json'
          	});
  			
  		}
  	});
  	

  	$('#single').select2();
  	$(".select2-multiple").select2({
      placeholder: "Chọn danh mục "
    });
   $(function() {
		Dropzone.autoDiscover = false;
	    $("div#myDropZone").dropzone({
	    		maxFiles:6 - {{$images->count() }},
	    		maxfilesexceeded:function(file){
	    			// this.removeAllFiles();
           			 this.removeFile(file);
	    		},
		        url : "{{route('quan-tri.upload.up-img')}}",
	            addRemoveLinks : true,
			    maxFilesize: 5 - {{$images->count() }},
			    dictDefaultMessage: '',
			    dictResponseError: 'Error uploading file!',
			    headers: {
			        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			    },
			    error: function (file, response) {
			       load_masonry();
			    },
			    success: function (file, response) {
			    	console.log(response);
			    	$(file.previewElement).find('.dz-filename span').text(response);
			        var fileupload = $('.dz-filename span');
			  		var t = "";
			  		$.each(fileupload,function(i,v){
			  			if( i== fileupload.length - 1 ){
			  				t += $(v).text();
			  			}else{
			  				t += $(v).text()+ ",,,";
			  			}
			  		});
			  		$("input[name='img_product']").val(t);
			  		load_masonry();
			    },
			    removedfile: function(file) {
				    var _ref;
				    _ref = file.previewElement;

				    if(_ref!= null){
				    	_ref.parentNode.removeChild(file.previewElement);
				    	var fileupload = $('.dz-filename span');
				  		var t = "";
				  		$.each(fileupload,function(i,v){
				  			if( i== fileupload.length - 1 ){
				  				t += $(v).text();
				  			}else{
				  				t += $(v).text()+ ",,,";
				  			}
				  		});
				  		$("input[name='img_product']").val(t);
				  		load_masonry();
				    	setTimeout(function(){
				  			load_masonry();
				  		},200);
				    }
				}
	    });
	    
		var myDropzone = Dropzone.forElement("#myDropZone");
		@foreach($images as $img)
		
			  var myFile = {
				    name: "{!! $img->img !!}",
				    @if(file_exists(public_path().''.$img->img))
				    	size: "{!! filesize(public_path().''.$img->img) !!}"
				    @endif
			  };
			  myDropzone.emit("addedfile", myFile);
		      myDropzone.createThumbnailFromUrl(myFile, '{{asset($img->img)}}');

		@endforeach
	  	var fileupload = $('.dz-filename span');
			  		var t = "";
			  		$.each(fileupload,function(i,v){
			  			if( i== fileupload.length - 1 ){
			  				t += $(v).text();
			  			}else{
			  				t += $(v).text()+ ",,,";
			  			}
		});
		$("input[name='img_product']").val(t);
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
    					'<a class="nav-link " href data-toggle="tab" data-target="#tab_'+c+'">Tab '+c+'<span  tab_id="'+c+'" >×</span></a>'
										   + '</li>';
		var content = '<div class="tab-pane p-v-sm" id="tab_'+c+'">'+
					'<div class="box m-t p-a-sm">'+
					'<input type="hidden" name="content[id][]" value="0" />'+
			      	'<div class="form-group">'+
		              '<label>Tên thẻ tab</label>'+
		              '<input  type="text" class="form-control i_name"'+
		               'name="content[name][]" value="Tab '+c+'">'+                        
		            '</div>'+
		            '<div class="form-group">'+
		     '<textarea  id="editor_'+c+'" class="form-control i_content"'+
		  'rows="5" name="content[content][]" ></textarea></div>'+
		             '<div class="attr_container">'+
				          	'<div class="view_des">'+
				          	'<i class="material-icons md-24 add_attr_tab" '+ 'data-toggle="modal">&#xe147;</i>'+
				          	'<span>Thêm đặc tính</span></div>'+
				          	'<input type="hidden" name="tab_list[]" class="list_attr_valie">'+
				          	'<div class="tab_list_attr">'+
				          	'</div>'+
				          '</div>'+
			      '</div>';
    	$(this).parent().before(html);
    	$("#list_tab_content").append(content);
    	
    	$('#editor_'+c).summernote({
   	        lang: "vi-VN",
		    height: (452),
		    fontNames: [{!!isset($font_default) ?$font_default->value.',':''!!}{!!isset($font_custom) ?$font_custom->value:''!!}],
			fontNamesIgnoreCheck: [{!!isset($font_custom) ?$font_custom->value:''!!}],
		    popover: {
					  image: [
					    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					    ['float', ['floatLeft', 'floatRight', 'floatNone']],
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
		load_masonry();
    });
    $(document).on('click','.nav-link',function(){
    	load_masonry();
    });
    $('#editor_1').summernote({
   	        lang: "vi-VN",
		    height: (270),
		    fontNames: [{!!isset($font_default) ?$font_default->value.',':''!!}{!!isset($font_custom) ?$font_custom->value:''!!}],
			fontNamesIgnoreCheck: [{!!isset($font_custom) ?$font_custom->value:''!!}],
	  
		    popover: {
					  image: [
					    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					    ['float', ['floatLeft', 'floatRight', 'floatNone']],
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
			    ['insert', ['link']],
			    ['view', [ 'codeview']],
			    ['help', ['help']]
			  ],
		    callbacks: {
		        onImageUpload: function(image) {
		            uploadImage(image[0],"#editor_1");
		        }
		    }
	});
	$("#list_tab_title li").each(function(i){
     	
     		$('#editor_'+i).summernote({
		   	        lang: "vi-VN",
		   	        defaultFontName:'Roboto',
		   	        fontNames: [{!!isset($font_default) ?$font_default->value.',':''!!}{!!isset($font_custom) ?$font_custom->value:''!!}],
			        fontNamesIgnoreCheck: [{!!isset($font_custom) ?$font_custom->value:''!!}],
			  
				    popover: {
							  image: [
							    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
							    ['float', ['floatLeft', 'floatRight', 'floatNone']],
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
				    height: (479),
				    callbacks: {
				        onImageUpload: function(image) {
				            uploadImage(image[0],'#editor_'+i);
				        }
				    }
			});
     	
        
     });
    $(document).on('click','.nav-link span',function(){
    	id = $(this).attr('tab_id');
    		if(id!=1){
    				$("#tab_"+id).remove();
    				$("#li_tab"+id).remove();
    		};
    	$("#default_tab").click();
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
	            load_masonry();
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
	 function load_masonry(){
	      var container = $('.masonry-container');
	      container.masonry({
	        columnWidth: '.item',
	        itemSelector: '.item'
	      });   
	  }
	  load_masonry();
	  setTimeout(function(){
			load_masonry();
	  },200);

	  //  Thêm thuộc tính vào tab
	  add_attr_tab = null;
	  // Thêm input vào tab
	  function add_attr_tab_none(){
	  	str = '<div class="row">'+
	  	    		'<div class="col-sm-3">'+
	      	    		'<div class="form-group">'+
	      	    			'<input type="text" class="form-control attr_option_key" autocomplete="off">'+
	      	    		'</div>'+
	  	    		'</div>'+
	  	    		'<div class="col-sm-8">'+
	  	    			'<div class="form-group">'+
	      	    			'<input type="text" class="form-control attr_option_value" autocomplete="off">'+
	      	    		'</div>'+
	  	    		'</div>'+
	  	    		'<div class="col-sm-1" style="padding-left:0px">'+
	  	    			'<div class="form-group">'+
	      	    			'<button style="min-height: 2.375rem;padding: 0.3445rem 0.55rem;" class="btn btn-sm warn pull-left ">'+
	      	    				'<i class="material-icons md-24 remove_row_attr">&#xe5cd;</i>'+
	      	    			'</button>'+
	      	    		'</div>'+
	  	    		'</div>'+
	  	    	'</div>';
	  		$('.list_attr_tab').append(str);
	  } 
	  $(document).on('click','.add_row_attr',function(){
	  		add_attr_tab_none();
      });
	  $(document).on('click','.remove_row_attr',function(){
	  		$(this).parent().parent().parent().parent().remove()
	  });
	  $(document).on('click','.add_attr_tab',function(e){
	  	    add_attr_tab =  this;
	  		$("#m-a-tab").modal('show');
	  		$(".list_attr_tab").html('');
	  		list = $(add_attr_tab).parent().next().val();

	  		if(list == ""){
	  			add_attr_tab_none();
	  			return false;
	  		}
	  		obj = JSON.parse(list);
	  		html = "";
	  		$.each(obj,function(i,v){
	  			str = '<div class="row">'+
	  	    		'<div class="col-sm-3">'+
	      	    		'<div class="form-group">'+
	      	    			'<input type="text" class="form-control attr_option_key" autocomplete="off" value="'+v.key+'">'+
	      	    		'</div>'+
	  	    		'</div>'+
	  	    		'<div class="col-sm-8">'+
	  	    			'<div class="form-group">'+
	      	    			'<input type="text" class="form-control attr_option_value" autocomplete="off"  value="'+v.value+'">'+
	      	    		'</div>'+
	  	    		'</div>'+
	  	    		'<div class="col-sm-1" style="padding-left:0px">'+
	  	    			'<div class="form-group">'+
	      	    			'<button style="min-height: 2.375rem;padding: 0.3445rem 0.55rem;" class="btn btn-sm warn pull-left ">'+
	      	    				'<i class="material-icons md-24 remove_row_attr">&#xe5cd;</i>'+
	      	    			'</button>'+
	      	    		'</div>'+
	  	    		'</div>'+
	  	    	'</div>';
	  	    	html += str;
	  		});
	  		$('.list_attr_tab').html(html);
	  		add_attr_tab_none();
	  		return false
	  });
	    
  	$(document).on('click','#add_attr_to_tab',function(){
  		var key = $(".attr_option_key");
  		var value = $(".attr_option_value");
  		l = [];
  		$.each(key,function(i,v){
  			x = {"key":$(v).val(),"value":$(value[i]).val()}
  			l.push(x);
  		});
  		str = JSON.stringify(l) ;
		$(add_attr_tab).parent().next().val(str);
  		
  	});
  	
  </script>

@endsection