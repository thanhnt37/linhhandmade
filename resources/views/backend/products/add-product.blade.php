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
			/*.splq tr:nth-child(2) td, .splq tr:nth-child(4) td, .splq tr:nth-child(6) td, .splq tr:nth-child(8) td, .splq tr:nth-child(10) td {
				background-color: #f6f6f6;
			}*/
	</style>
@endsection
@section('content')
<form ui-jp="parsley" method="post" action="{{route('product.add')}}" enctype="multipart/form-data" id="form-add-product">
<div class="app-header white box-shadow">
<div class="navbar">
		<div style="float:left;" class="title_form">
	      <p>Thêm sản phẩm</p>
	    </div>
    	<div style="float:right;margin-top:10px;">
    	@if(session('admin')->can('luu_san_pham'))
    	<button  type="submit" name="submit" value="save" class="btn" style="
    	padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 10px;font-family: 'Roboto-Bold';
    	min-width:100px; background-color:#F2F2F2">THÊM</button>
		@endif
		</div>
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
										<input type="hidden" value="{{csrf_token()}}" name="_token">
							            <div class="form-group">
								              <p style="margin-bottom:10px;line-height:0px">
								               <img id="img_preview" style="max-height:200px;">
								              </p>
								              <label for="file_img_preview">
								                <a class="btn info">Chèn ảnh</a>
								              </label>
								              <input type="file" style="display:none" class="form-control" name="prod_img"  id="file_img_preview">                    
							            </div>
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
				          <div class="box-header"><h2>Thuộc tính định tính</h2>
				          	<i class="material-icons md-24  add-attribute" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="fade-left-big" >&#xe147;</i>
							<!-- .modal -->
							<div id="m-a-a" class="modal fade animate" data-backdrop="true">
							  <div class="modal-dialog" id="animate">
							    <div class="modal-content">
							      <div class="modal-header">
							      	<h5 class="modal-title">Thêm thuộc tính</h5>
							      </div>
							      <div class="modal-body p-lg">
							      		<?php $attribute = App\Attribute::where('type',1)->where('avaiable',0)->groupby('name')->orderby('created_at')->get();
							      		?>
						      		    <div class="table-responsive">
			                                <table class="table b-t">
			                                  <tbody>
			                                  	@foreach($attribute as $key => $value)
			                                    	<tr>
				                                      <td style="width: 5%">
				                                      <label class="ui-check m-a-0">
				                                      <input type="checkbox" class="add_check" data-id="{{$value->id}}" data-name="{{$value->name}}" checked>
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
				          	<p style="margin-top:0px;margin-bottom:10px; font-size:10pt; color:#a6a6a6" class="text-muted">Nhấn vào (+) để thêm thuộc tính định tính vào sản phẩm</p>

							<div class="row">
								<div class="col-sm-12" id="atrribute-containner">
									@foreach($attribute as $value2)
													<div class="row attr-item ">
											        	<div class="col-sm-3">
											        		<label style="margin-top:10px;">{{$value2->name}}</label>
											        	</div>
											        	<div class="col-sm-9">
											        		<div class="form-group attr-item ">
											        			<input type="hidden"  name="attrbute_k[]" value="{{$value2->name}}">
													            <input type="text" class="form-control i_name" name="attrbute_v[]" value="{{$value2->value}}">
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
				    <!-- Begin Item Thêm thuộc tính -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Thuộc tính định lượng</h2>
				          	<i class="material-icons md-24  add-attribute" data-toggle="modal" data-target="#m-a-a1" ui-toggle-class="fade-left-big">&#xe147;</i>
							<!-- .modal -->
							<div id="m-a-a1" class="modal fade animate" data-backdrop="true">
							  <div class="modal-dialog" id="animate">
							    <div class="modal-content">
							      <div class="modal-header">
							      	<h5 class="modal-title">Thêm thuộc tính</h5>
							      </div>
							      <div class="modal-body p-lg">
							      		<?php $attribute = App\Attribute::where('type',1)->where('avaiable',1)->where('name',"<>","Giá")->groupby('name')->orderby('created_at')->get();
							      		?>
						      		    <div class="table-responsive">
			                                <table class="table b-t">
			                                  <tbody>
			                                  	@foreach($attribute as $key => $value)
			                                    	<tr>
				                                      <td style="width: 5%">
				                                      <label class="ui-check m-a-0">
				                                      <input type="checkbox" class="add_check"  data-init="{{$value->init}}" data-id="{{$value->id}}" data-name="{{$value->name}}" checked>
				                                      	<i class="dark-white" ></i>
				                                      </label>
				                                      </td>
				                                      <td>{{$value->name}}</td>
				                                    </tr>
			                                    @endforeach
			                                  </tbody>
			                                </table>
				                        </div>
					                   
									    <a id="add_item1" class="btn btn-sm warn pull-left add-attr"  data-dismiss="modal">Chọn</a>
									    <div style="clear:both"></div>
								   </div>
							    </div><!-- /.modal-content -->
							  </div>
							</div>
							<!-- / .modal -->
				          </div>
				          <div class="box-body">
				          	<p style="margin-top:0px;margin-bottom:10px; font-size:10pt; color:#a6a6a6" class="text-muted">Nhấn vào (+) để thêm thuộc tính định lượng vào sản phẩm</p>

							<div class="row">
								<div class="col-sm-12" id="atrribute-containner1">
									@foreach($attribute as $value2)
													<div class="row attr-item ">
											        	<div class="col-sm-3">
											        		<label style="margin-top:10px;">{{$value2->name}}@if($value2->init) ({{$value2->init}})@endif</label>
											        	</div>
											        	<div class="col-sm-9">
											        		<div class="form-group attr-item ">
											        			<input type="hidden"  name="attrbute_k[]" value="{{$value2->name}}">
													            <input type="text" class="form-control" name="attrbute_v[]" value="{{$value2->value}}">
													        </div>
											        	</div>
											        </div>
							      	@endforeach
								</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>

				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Đặc tính sản phẩm</h2>
				          	<i class="material-icons md-24  add-attribute" data-toggle="modal" data-target="#m-a-a2" ui-toggle-class="fade-left-big">&#xe147;</i>
							<!-- .modal -->
							<div id="m-a-a2" class="modal fade animate" data-backdrop="true">
							  <div class="modal-dialog" id="animate">
							    <div class="modal-content">
							      <div class="modal-header">
							      	<h5 class="modal-title">Thêm đặc tính</h5>
							      </div>
							      <div class="modal-body p-lg">
							      		<?php $feature = App\Feature::where('type',1)->groupby('name')->orderby('created_at')->get();
							      		?>
						      		    <div class="table-responsive">
			                                <table class="table b-t">
			                                  <tbody>
			                                  	@foreach($feature as $key => $value)
			                                    	<tr>
				                                      <td style="width: 5%">
				                                      <label class="ui-check m-a-0">
				                                      <input type="checkbox" class="add_check" data-id="{{$value->id}}" data-name="{{$value->name}}" checked>
				                                      	<i class="dark-white" ></i>
				                                      </label>
				                                      </td>
				                                      <td>{{$value->name}}</td>
				                                    </tr>
			                                    @endforeach
			                                  </tbody>
			                                </table>
				                        </div>
					                   
									    <a id="add_item_features" class="btn btn-sm warn pull-left add-attr"  data-dismiss="modal">Chọn</a>
									    <div style="clear:both"></div>
								   </div>
							    </div><!-- /.modal-content -->
							  </div>
							</div>
							<!-- / .modal -->
				          </div>
				          <div class="box-body">
				          	<p style="margin-top:0px;margin-bottom:10px; font-size:10pt; color:#a6a6a6" class="text-muted">Nhấn vào (+) để thêm đặc tính vào sản phẩm</p>
							<div class="row">
								<div class="col-sm-12" id="atrribute-containner_features">
									@foreach($feature as $value2)
													<div class="row attr-item ">
											        	<div class="col-sm-3">
											        		<label style="margin-top:10px;">{{$value2->name}}</label>
											        	</div>
											        	<div class="col-sm-9">
											        		<div class="form-group attr-item ">
											        			<input type="hidden"  name="feature_k[]" value="{{$value2->name}}">
													            <input type="text" class="form-control i_name_feature" name="feature_v[]" value="{{$value2->value}}">
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
				          <div class="box-header"><h2>Thông tin cơ bản</h2></div>
				          <div class="box-body">
							<div class="row">
								<div class="col-sm-12" style="">
									<div class="form-group">
						              <label>Tên sản phẩm</label>
						              <input type="text" class="form-control" name="product_name" autocomplete="off" value="New Product" >
						            </div>
						            <div class="form-group">
						              <label>Mô tả ngắn</label>
						              <textarea name="product_des" class="form-control" rows="5">Mô tả ngắn gọn về sản phẩm</textarea>
						            </div>
								</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->
				    <!-- Begin Item Nhãn -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Giá sản phẩm</h2></div>
				          <div class="box-body">
							<div class="row">
								<div class="col-sm-12" style="">
								    <div class="form-group m-money">
						              <label>Giá niêm yết</label>
						              <input  type="text" class="form-control" name="price" autocomplete="off">
						              <div class="m-tooltip"></div>
						            </div>
						             <div class="form-group m-money">
						              <label>Giá Sale : Để trống khi không giảm giá </label>
						              <input  type="text" class="form-control" name="price_sale" autocomplete="off">
						               <div class="m-tooltip"></div>
						            </div>
								</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->
				    <!-- Begin Item Thuộc tính -->
				    <?php $last_frame = DB::table('frames')->orderby('id', 'desc')->first();
				    	$code = "P-01";
				    	if($last_frame){
				    		$code_id = $last_frame->id+1;
				    		if($last_frame->id <10){

				    			$code = "P-000".$code_id;
				    		}
				    		if($last_frame->id <100 && $last_frame->id >= 10){
				    			$code = "P-00".$code_id;
				    		}
				    		if($last_frame->id <1000 && $last_frame->id >= 100){
				    			$code = "P-0".$code_id;
				    		}
				    		if($last_frame->id >= 1000){
				    			$code = "P-".$code_id;
				    		}
				    	}
				     ?>
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Thông số cơ bản </h2></div>
				          <div class="box-body">
							<div class="row">
								<div class="col-sm-12">
						            <div class="form-group">
						              <label>Mã sản phẩm</label>
						              <input type="text" class="form-control" name="product_code" autocomplete="off" value="{{$code}}" >
						            </div>
						            <div class="form-group m-money1">
						              <label>Khối Lượng : đvt = gam/1 sản phẩm . vd: 15.51</label>
						              <input  type="text" class="form-control" name="weight" autocomplete="off">
						               <div class="m-tooltip"></div>
						            </div>
						            <div class="form-group">
						              <label>Số lượng sản phẩm</label>
						              <input type="number"  type="text" class="form-control" name="sku" >
						            </div>
								</div>
							</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->
				    <?php
						$list_categories = App\CategoryProduct::get();
						$space = "--";
					?>
					@if(sizeof($list_categories))
				    <!-- Begin Item Nhãn -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Sắp xếp</h2></div>
				          <div class="box-body">
							<div class="row">
								<div class="col-sm-12" style="">
									
						            <div class="form-group">
						               
								        <label for="multiple">Nhóm sản phẩm</label>
								        <select id="multiple" class="form-control select2-multiple" name="choose_cate[]" multiple >
								        	{{cate_parent($list_categories)}}
								        </select>
									</div>
								</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->
				    @endif
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
								            <option value="0">Không nhãn</option>
								            <option value="1">New</option>
								            <option value="2">Kool</option>
								            <option value="3">Sale</option>
								        </select>
								    </div>	
								</div>
				         	</div>	 
		                  </div>
				        </div>
				    </div>
				    <!-- End item -->
				    <!-- Begin Item Nhãn -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          	<div class="box-header"><h2>Sản phẩm liên quan</h2></div>
				          		<div class="box-body" style="padding-top: 27px;">
									<div class="row">
										<div class="col-sm-12" style="">
											<div class="form-group">
												<span id="d_product_related" class="btn-primary" style="padding:5px 10px;border-radius:3px;cursor:pointer;background-color:#738CEC" >Thêm sản phẩm</span>
											</div>
										</div>
										<div class="col-sm-12" id="d_popup_related" style="display:none;">
											<div class="form-group">
												<table  style="width: 100%" class="splq" >
													<tbody id="d_list_related">
														<tr >
														<th style="width: 35%; padding-top: 10px; padding-bottom: 10px">Tên sản phẩm</th>
														<th style="width: 25%; padding-top: 10px; padding-bottom: 10px">Mã</th>
														<th style="width: 20%; text-align:center; padding-top: 10px; padding-bottom: 10px">Ảnh</th>
														<th style="width: 10%; text-align:center; padding-top: 10px; padding-bottom: 10px">Xóa</th>
													</tr>
													</tbody>
													
												</table>
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
										<!-- <p style="margin-top:0px;margin-bottom:10px; font-size:10pt; color:#a6a6a6" class="text-muted">Tab 1 mặc định là bài viết đơn, nếu muốn bài viết nhiều tab vui lòng nhấn Thêm tab</p> -->
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
				    <!-- End Item -->
				    <!-- Begin Item youtube -->
				    <div class="col-sm-6 item">
				        <div class="box">
				          <div class="box-header"><h2>Video Youtube</h2>
				          <i class="material-icons md-24" id="add_youtube">&#xe147;</i>
				          </div>
				          <div class="box-body">
							<div class="row">
								<div class="col-sm-12" id="add_youtube_containner">
									
								</div>
							</div>
						  </div>
						</div>
					</div>
					<!-- End item -->
			 	</div>
	 </div>
</form>

<!-- add_related_product -->
<div id="m-a-tab_related" class="modal " data-backdrop="true" style="border:0px;">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tìm sản phẩm liên quan</h5>
        </div>
        <div class="modal-body p-lg" style="padding-bottom:0px !important;">
          	<div class="table-responsive">
            <input type="text"  id="search" class="form-control thong-tin" placeholder="Nhập tên hoặc mã sản phẩm" autocomplete="off">
	            <div class="col-sm-12 item" style="padding:0px">
		            <div class="box-body" style="background-color:#FFFFFF;padding:0px !important;" >
		            	<div class="box-body" style="padding-left:0; padding-right:0;">
		                <div class="table-responsive">
		                 	<table class="tablel-box table-striped b-t">
			                    <tbody id="l-box1">
			                        
			                    </tbody>
		                	</table>
		              	</div>
		          	  </div> 
		          	</div>
	          	</div> 
       		</div>
      	</div>
    </div>
 </div>
<!-- end add_related_product -->
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
   		i_name = $('.i_name');
   		$.each(i_name,function(i,v){
   			$(v).stag("Thêm " + $(v).prev().val(),[]);
   		});
   		i_name_feature = $('.i_name_feature');
   		$.each(i_name_feature,function(i,v){
   			$(v).stag("Thêm " + $(v).prev().val(),[],'stag2');
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
  	// Thêm thuộc tính định tính
  	$(document).on('click','#add_item',function(){
  		var list_check = $("#m-a-a .add_check:checked");
  		var list_uncheck = $("#m-a-a .add_check:not(:checked)");
  		$.each(list_check,function(i,v){
  			id = $(v).attr('data-id');
  			text = $(v).attr('data-name');
  			var d = $('#atrribute-containner .attr-item input[value="'+text+'"]');
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
		  		$(".attr_temp").stag('Thêm '+text,[]);
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
  	// Thêm đặc tính
  	$(document).on('click','#add_item_features',function(){
  		var list_check = $("#m-a-a2 .add_check:checked");
  		var list_uncheck = $("#m-a-a2 .add_check:not(:checked)");
  		$.each(list_check,function(i,v){
  			id = $(v).attr('data-id');
  			text = $(v).attr('data-name');
  			var d = $('#atrribute-containner_features .attr-item input[value="'+text+'"]');
  			if(d.length == 0){
  				content = '<div class="row attr-item ">'+
				        	'<div class="col-sm-3">'+
				        		'<label style="margin-top:10px;">'+text+'</label>'+
				        	'</div>'+
				        	'<div class="col-sm-9">'+
				        		'<div class="form-group attr-item ">'+
				        			'<input type="hidden"  name="feature_k[]" value="'+text+'">'+
						            '<input type="text"  class="form-control i_name feature_temp" name="feature_v[]" autocomplete="off">'+
						        '</div>'+
				        	'</div>'+
				        '</div>';
		  		$("#atrribute-containner_features").append(content);
		  		$(".feature_temp").stag('Thêm '+text,[],'stag2');
	  			$(".feature_temp").removeClass('feature_temp');
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

  	// Thêm thuộc tính Định lượng
  	$(document).on('click','#add_item1',function(){
  		var list_check = $("#m-a-a1 .add_check:checked");
  		var list_uncheck = $("#m-a-a1 .add_check:not(:checked)");
  		$.each(list_check,function(i,v){
  			id = $(v).attr('data-id');
  			text = $(v).attr('data-name');
  			init = $(v).attr('data-init');
  			if(init.length) init= " ("+init+")";
  			var d = $('#atrribute-containner1 .attr-item input[value="'+text+'"]');
  			if(d.length == 0){
	  			content = '<div class="row attr-item ">'+
				        	'<div class="col-sm-3">'+
				        		'<label style="margin-top:10px;">'+text+init+'</label>'+
				        	'</div>'+
				        	'<div class="col-sm-9">'+
				        		'<div class="form-group attr-item ">'+
				        			'<input type="hidden"  name="attrbute_k[]" value="'+text+'">'+
						            '<input type="text"  class="form-control i_name attr_temp" name="attrbute_v[]" autocomplete="off">'+
						        '</div>'+
				        	'</div>'+
				        '</div>';
		  		$("#atrribute-containner1").append(content);
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
  
  	$(document).on('focus','#atrribute-containner .attr-item .stag-input',function(e){
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
  	$(document).on('focus','#atrribute-containner_features .attr-item .stag-input',function(e){
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
              url:"{{route('check-key.feature')}}",
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
	      	    			'<button class="btn btn-sm warn pull-left ">'+
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
	  count_rank = null;
	  $(document).on('click','.add_attr_tab',function(e){
	  		count_rank = $(this).next();
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
	      	    			'<button class="btn btn-sm warn pull-left ">'+
	      	    				'<i class="material-icons md-24 remove_row_attr">&#xe5cd;</i>'+
	      	    			'</button>'+
	      	    		'</div>'+
	  	    		'</div>'+
	  	    	'</div>';
	  	    	html +=str;
	  		});
	  		$('.list_attr_tab').html(html);
	  		add_attr_tab_none();
	  		return false;
	  });
  	$('#single').select2();
  	$('#list_attribute').select2();
  	$(".select2-multiple").select2({
      placeholder: "Chọn danh mục "
    });
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
			    dictDefaultMessage: 'Ảnh chi tiết sản phẩm',
			    dictResponseError: 'Error uploading file!',
			    headers: {
			        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			    },
			    error: function (file, response) {
			       load_masonry();
			    },
			    success: function (file, response) {
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
				    	console.log(1);
				    	setTimeout(function(){
				  			load_masonry();
				  		},200);
				    }
				 }
	    });
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
					               'name="post_name[]" value="Tab '+c+'">'+                        
					            '</div>'+
					            '<div class="form-group">'+
					 '<textarea  id="editor_'+c+'" class="form-control i_content"'+
					  'rows="5" name="post_content[]" ></textarea></div>'+
		    '</div>';
    	$(this).parent().before(html);
    	$("#list_tab_content").prepend(content);
    	$('#editor_'+c).summernote({
   	        lang: "vi-VN",
		    height: (270),
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
			    ['insert', ['link','picture']],
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
			    ['insert', ['link','picture']],
			    ['view', [ 'codeview']],
			    ['help', ['help']]
			  ],
		    callbacks: {
		        onImageUpload: function(image) {
		            uploadImage(image[0],"#editor_1");
		        }
		    }
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

	  $(document).on('click','#d_product_related',function(e){
	  	e.preventDefault();
	  	$('#m-a-tab_related').modal('show');
	  	$('#search').on('keyup',function(e){
	      e.preventDefault();
	      var code = e.which;
	      value = $(this).val();
	        if($.trim(value)){
	            $.ajax({
	              headers: {
	                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	              },
	              type:"post",
	              url:"{{route('add.related.product')}}",
	              data:{'key':value},
	              success:function(data){
	                console.log(data);
	                if(data.status ==true ){
	                	$('#l-box1').html(data.html_search);
	                }else{
	                	$('#l-box1').html("");
	                }
	              },
	              cache:false,
	              dataType:'json'
	            });
	        }else{
	           
	        }
	    });
	  });
	c_related = 0;
	$(document).on('click', '.choose-product1', function(event) {
	  	event.preventDefault();
	  	id=$(this).val();
	  	container = this;
		$.ajax({
	        headers: {
	              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        },
	        type:"post",
	        url:"{{route('checkbox.add.related')}}",
	        data:{'id':id},
	        success:function(data){
	          if(data.status == true){
	          	$('#d_popup_related').css('display','block');
	          	c_related += 1;
	          	id = data.product.id;
	          	c_ = $('#d_list_related > tr[data-id="'+id+'"]');
		          	if(c_.length > 0){
		            	$(container).parent().parent().parent().remove();
			       	}else{
			        	$('#d_list_related').append(data.html_check);
			        	$(container).parent().parent().parent().remove();
			        }
	          	d = $('#l-box1 > tr');
	        	if(d.length == 1){
	        		$('#search').val("");
	        		$('#d_none').css('display','none');
	        		$('#m-a-tab_related').modal('hide');
	        	}
	          }
	         
	        },
	        cache:false,
	        dataType:'json'
	    });
	});
	$(document).on('click','.del_related',function(){
		id = $(this).data('id');
      	$('#d-del_related_'+id).remove();
	  	e = $('#d_list_related > tr');
	  	console.log(e.length);
	  	if(e.length == 1){
	  		$('#d_popup_related').css('display','none');
	  	}
    });
  </script>

@endsection