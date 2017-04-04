@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('summernote/dist/summernote.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
   <style type="text/css">
    .box-body,.select2-search--dropdown{padding:0!important}.itemfilter_type_0:hover,h2{font-family:Roboto}.name-attr{cursor:pointer}.title_form{margin-left:10px}h2{font-size:10.5pt!important}div#myDropZone{width:100%;min-height:100px;background-color:#F0F0F0;border:1px solid #E7E7E7!important}.dz-message span{font-size:10pt!important}.dz-remove{font-size:9pt!important}.dz-image{border-radius:0!important}option:disabled{background:#ddd}.choose_img_item,.choose_img_item:hover{background-color:#00B0F0!important}.select2-container .select2-selection--single{height:37px}.select2-selection__arrow{height:35px!important}.select2-search__field{display:none}.select2{width:100%!important;font-size:10pt}.choose_img_item,.select2-selection__rendered{font-size:10pt!important}.change-item{cursor:default}.add-attribute,.x-item{cursor:pointer}.itemfilter_type_0,.itemfilter_type_1{position:relative}.itemfilter_type_1:hover{color:#111}.itemfilter_type_0 .x-item,.itemfilter_type_1 .x-item{display:none;position:absolute;right:-3px;top:3px}.itemfilter_type_0:hover .x-item,.itemfilter_type_1:hover .x-item{display:block}.choose_img_item{font-family:Roboto}.save-item:hover{box-shadow:inset 0 -10rem 0 rgba(158,158,158,.2)}.save-item{text-transform:uppercase;font-size:9pt;font-family:Roboto-Bold}#new_attr,.itemfilter,.name-attr,label{font-size:10pt}#model-preview{margin-left:20px}.del_attribute{visibility:hidden}tr:hover .del_attribute{visibility:visible}.d-add-attr{visibility: hidden}tr:hover .d-add-attr{visibility:visible;}.alert{margin-top:20px;margin-bottom:0}label{color:#404040}.form-control{margin-bottom:15px!important;border:1px solid #E7E7E7!important}.thong-tin{background-color:#fff!important}.itemfilter{display:inline-block;margin-left:10px;font-family:Roboto}.name-attr{font-family:Roboto Bold;display:inline-block}#new_attr,.modal-title{font-family:"Roboto Bold"}input{border:0!important;background-color:rgba(1,1,1,0)!important;min-width:230px}.add-attribute{position:absolute;right:15px;top:10px;color:#738CEC}.modal-dialog{width:600px;margin:70px auto}.modal-content{border-radius:0}.modal-header{padding:12px 15px;border-bottom:1px solid #E7E7E7}.modal-title{font-size:10.5pt}.add-attr{background-color:#92D050;color:#fff;font-size:10pt;padding-top:5px;padding-bottom:5px;width:70px}.add-attr:hover{background-color:#92D050!important;color:#fff}.attr-item{position:relative}.list-value{position:absolute;display:none;background-color:#fff;border:1px solid #E7E7E7;width:100%;z-index:99}#e-init,#e-name,#init_attr,#value_attr,.input_bg{background-color:#F0F0F0!important;font-size:10pt!important;border:1px solid #E7E7E7!important}.itemfilter{padding:3px 7px}.modal-content{border:0}.table td.active,.table th.active,.table tr.active,.table-hover tr:hover{background-color:rgba(0,0,0,.025)!important}.table{margin-bottom:0}.d-add-attr:hover{color: #000!important;}
     .modal-dialog {
          width: 600px;
          margin: 70px auto;
      }
      .modal-content{
        border-radius: 0px;
      }
      .modal-header {
          padding: 12px 15px;
          border-bottom: 1px solid #E7E7E7;
      }
      .modal-title{
        font-size: 10.5pt;
        font-family: "Roboto Bold";
      }
   </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Thuộc tính</p>
      </div>
      <div style="float:right;margin-top:10px;">
      </div>
       
    <!-- / navbar collapse -->
</div>
</div>

 
   <div class="app-body" id="view">
    <div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
        @include('backend.partials._messages')
    </div>
     <?php $attribute = App\Attribute::where('type',1)->where('name', '<>',"Giá")->groupby('name')->orderby('created_at')->get();?>
     <?php $price_attribute = App\Attribute::where('type',1)->where('name', '=',"Giá")->groupby('name')->orderby('created_at')->get();?>
    <div class="padding">
    
         <div class="row">
          
              <div class="col-sm-12">
              
                  <div class="box">
                    <div class="box-header">
                      <h2 style="font-size:10.5pt; font-family: Roboto Bold">Danh sách thuộc tính </h2>
                    </div>
                    
                    <div class="box-body">
                          <div class="table-responsive">
                            <table class="table table-striped b-t">
                              <tbody>
                              @if(session('admin')->can('them_thuoc_tinh'))
                                <tr id="add_attribute" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="fade-left-big" style="cursor:pointer" >
                                  <td style="width: 4%">
                                    <label class="ui-check m-a-0" style="padding-left:5px; font-family:Roboto Bold; font-size:12pt;">
                                      +
                                    </label>
                                  </td>
                                  <td>
                                    <p  id="new_attr" style="cursor:pointer;color:#A9ABB3;margin-bottom:0px;margin-top: 3px;">Thêm thuộc tính mới </p>
                                  </td>
                                  <td style="width: 4%">
                                  </td>
                                </tr>
                              @endif
                              
                                 @foreach($price_attribute as $key=> $value)
                                <tr>
                                  <td style="width: 4%">
                                  <label class="ui-check m-a-0">
                                    <input type="checkbox" checked  name="post[]" class="has-value filter_group" value="{{$value->id}}" @if(!session('admin')->can('sua_thuoc_tinh')) disabled @endif >
                                    <i class="dark-white" ></i>
                                  </label>
                                  </td>
                                  <td data-type="{{$value->avaiable}}" data-name="{{$value->name}}">
                                    <div class="name-attr edit" >{{$value->name}}</div>
                                    <?php
                                    $list_filter= App\Filter::where('name',$value->name)->where('type',0)->get();
                                    $list_attr= App\Attribute::where('name',$value->name)->where('type',0)->get();
                                    $list_filter_1= App\Filter::where('name',$value->name)->where('type',1)->get();
                                    ?>
                                    @if($value->avaiable == 1)
                                       <?php $min = 100000000; $max = -100000000;?>
                                      @foreach($list_attr as $key2 => $value2)
                                      <?php 
                                          if($value2->value > $max) $max = $value2->value;
                                          if($value2->value < $min) $min = $value2->value;
                                      ?>
                                      @endforeach
                                        @if($max !=-100000000  && $min != 100000000)
                                          <div class="itemfilter" style="font-family:'Roboto Bold'" >{{$min}} - {{$max}}</div>
                                        @endif
                                      <!--  Danh sách item filter type 1 -->
                                      @foreach($list_filter_1 as $key2 => $value2)
                                        <div class="itemfilter itemfilter_type_1" data-filter="{{$value2->id}}">
                                          @if($value2->img)
                                            <span>
                                              <img src=" {!! asset($value2->img) !!} " style="width:12px;height:12px;" alt="">
                                            </span>
                                          @endif
                                          <span class="change-item" style="cursor:pointer;">
                                          {{$value2->config_name}}
                                          </span>
                                          @if(session('admin')->can('xoa_thuoc_tinh'))
                                            <span class="x-item">×</span>
                                          @endif
                                        </div>
                                      @endforeach
                                      @if(session('admin')->can('them_thuoc_tinh'))
                                        <input  class="itemfilter inpput-filter" style="width:auto" placeholder="Nhập và enter, ví dụ 100 - 200">
                                      @endif
                                    @else
                                      <!--  Danh sách item filter type 0 -->
                                      @foreach($list_filter as $key2 => $value2)
                                        <div class="itemfilter itemfilter_type_0" data-filter="{{$value2->id}}">
                                          @if($value2->img)
                                            <span>
                                              <img src=" {!! asset($value2->img) !!} " style="width:12px;height:12px;" alt="">
                                            </span>
                                          @endif
                                          <span class="change-item" style="cursor:pointer;">
                                          {{$value2->value}}
                                          </span>
                                          @if(session('admin')->can('xoa_thuoc_tinh'))
                                            <span class="x-item">×</span>
                                          @endif
                                        </div>
                                      @endforeach
                                      @if(session('admin')->can('them_thuoc_tinh'))
                                        <span class="d-add-attr" data-id="{!! $value->id !!}" style="background-color:rgba(204, 204, 204, 0.4);font-family:Roboto ;cursor:pointer;border-radius:4px;  padding: 4px 9px;;color:#ABA9B3;    margin-left: 17px;display:inline-block;font-family:Roboto">+ Thêm</span>
                                      @endif
                                    @endif
                                  </td>
                                  <td style="width: 4%">
                                    <label class="ui-check m-a-0 del_attribute" data-name="{{$value->name}}" style="padding-left:5px; font-family:Roboto Bold; font-size:12pt;">
                                      @if(session('admin')->can('xoa_thuoc_tinh')) @if($value->isDelete == 0) ×  @endif @endif
                                    </label>
                                  </td>
                                </tr>
                                @endforeach 

                                @foreach($attribute as $key=> $value)
                                <tr>
                                  <td style="width: 4%">
                                  <label class="ui-check m-a-0">
                                    <input type="checkbox" checked  name="post[]" class="has-value filter_group" value="{{$value->id}}" @if(!session('admin')->can('sua_thuoc_tinh')) disabled @endif >
                                    <i class="dark-white" ></i>
                                  </label>
                                  </td>
                                  <td data-type="{{$value->avaiable}}" data-name="{{$value->name}}">
                                    <div class="name-attr edit" >{{$value->name}}</div>
                                    <?php
                                    $list_filter= App\Filter::where('name',$value->name)->where('type',0)->get();
                                    $list_attr= App\Attribute::where('name',$value->name)->where('type',0)->get();
                                    $list_filter_1= App\Filter::where('name',$value->name)->where('type',1)->get();
                                    ?>

                                    @if($value->avaiable == 1)
                                       <?php $min = 100000000; $max = -100000000;?>
                                      @foreach($list_attr as $key2 => $value2)
                                      <?php 

                                          if($value2->value > $max) $max = $value2->value;
                                          if($value2->value < $min) $min = $value2->value;
                                      ?>
                                      @endforeach
                                        @if($max !=-100000000  && $min != 100000000)
                                          <div class="itemfilter" style="font-family:'Roboto Bold'" >{{$min}} - {{$max}}</div>
                                        @endif
                                      <!--  Danh sách item filter type 1 -->
                                      @foreach($list_filter_1 as $key2 => $value2)
                                        <div class="itemfilter itemfilter_type_1" data-filter="{{$value2->id}}">
                                          @if($value2->img)
                                            <span>
                                              <img src=" {!! asset($value2->img) !!} " style="width:12px;height:12px;" alt="">
                                            </span>
                                          @endif
                                          <span class="change-item" style="cursor:pointer;">
                                          {{$value2->config_name}}
                                          </span>
                                          @if(session('admin')->can('xoa_thuoc_tinh'))
                                            <span class="x-item">×</span>
                                          @endif
                                        </div>
                                      @endforeach
                                      @if(session('admin')->can('them_thuoc_tinh'))
                                        <input  class="itemfilter inpput-filter" style="width:auto" placeholder="Nhập và enter, ví dụ 100 - 200">
                                      @endif
                                    @else
                                      <!--  Danh sách item filter type 0 -->
                                      @foreach($list_filter as $key2 => $value2)
                                        <div class="itemfilter itemfilter_type_0" data-filter="{{$value2->id}}">
                                          @if($value2->img)
                                            <span>
                                              <img src=" {!! asset($value2->img) !!} " style="width:12px;height:12px;" alt="">
                                            </span>
                                          @endif
                                          <span class="change-item" style="cursor:pointer;">
                                          {{$value2->value}}
                                          </span>
                                          @if(session('admin')->can('xoa_thuoc_tinh'))
                                            <span class="x-item">×</span>
                                          @endif
                                        </div>
                                      @endforeach
                                      @if(session('admin')->can('them_thuoc_tinh'))
                                        <span class="d-add-attr" data-id="{!! $value->id !!}" style="background-color:rgba(204, 204, 204, 0.4);font-family:Roboto ;cursor:pointer;border-radius:4px;  padding: 4px 9px;;color:#ABA9B3;    margin-left: 17px;display:inline-block;font-family:Roboto">+ Thêm</span>
                                      @endif
                                    @endif
                                  </td>
                                  <td style="width: 4%">
                                    <label class="ui-check m-a-0 del_attribute" data-name="{{$value->name}}" style="padding-left:5px; font-family:Roboto Bold; font-size:12pt;">
                                      @if(session('admin')->can('xoa_thuoc_tinh')) @if($value->isDelete == 0) ×  @endif @endif
                                    </label>
                                  </td>
                                </tr>
                                @endforeach 
                              </tbody>
                            </table>
                        </div>
                    </div>
                   
             </div>
        </div>
        </div>
     
   </div>
<!-- .modal -->
@if(session('admin')->can('them_thuoc_tinh'))
<div id="m-a-a" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thêm thuộc tính</h5>
      </div>
      <div class="modal-body p-lg">
        <div class="form-group">
            <label for="list_attribute">Loại thuộc tính</label>
            <select id="list_attribute" class="form-control select2" >
                 <option value="0">Định tính</option>
                 <option value="1">Định lượng</option>
            </select>  
        </div>  
        <div class="form-group">
          <label>Tên thuộc tính</label>
          <input type="text" id="value_attr" class="form-control" name="value" placeholder="ví dụ : Màu sắc, kích thước ...">
        </div>
        <div class="form-group d-dinh-tinh" style="display:none">
          <label>Đơn vị (nếu cần)</label>
          <input type="text" id="init_attr" class="form-control" name="value" placeholder="ví dụ : kg,cm ...">
        </div>
        <a id="add_item" class="btn btn-sm warn pull-left add-attr"  data-dismiss="modal">Tạo</a>
        <div style="clear:both"></div>
     </div>
    </div><!-- /.modal-content -->
  </div>
</div>
@endif
<!-- .modal -->
@if(session('admin')->can('sua_thuoc_tinh'))
  <div id="m-a-e" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chỉnh sửa thuộc tính</h5>
      </div>
      <div class="modal-body p-lg">
        <div class="form-group">
            <label for="list_attribute">Loại thuộc tính</label>
            <select id="list_attribute" class="form-control select2" disabled="" >
                 <option value="0" id="list_attribute_0">Định tính</option>
                 <option value="1" id="list_attribute_1">Định lượng</option>
            </select>
           
        </div>  
        <div class="form-group">
          <label>Tên thuộc tính</label>
          <input id="e-name" type="text" id="value_attr" class="form-control" name="value" placeholder="ví dụ : Màu sắc, kích thước ...">
           <input  id="e-id" type="hidden" class="form-control input_bg" name="id">
        </div>
        <div class="form-group d-init">
          <label>Đơn vị</label>
          <input id="e-init" type="text" id="init_attr" class="form-control" name="value" placeholder="ví dụ : kg,cm ...">
        </div>
        <a id="save_attr" class="btn btn-sm warn  pull-left add-attr"  data-dismiss="modal">Lưu</a>
        <div style="clear:both"></div>
     </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<div id="m-a-a_0_dinh_tinh" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <form id="config_item_dt" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:10pt;font-family:'Roboto Bold' ">Giá trị thuộc tính</h5>
      </div>
      <div class="modal-body p-lg">
        
        <div class="form-group">
          <label>Giá trị</label>
          <input  id="model-value" name="value" type="text" class="form-control input_bg" autocomplete="off">
          <input  id="model-id-dt" type="hidden" class="form-control input_bg" name="id_dt">
        </div>
        <div class="form-group" style="margin-bottom:0px!important; ">
          <label>
            <a class="btn btn-sm warn pull-left choose_img_item" >Ảnh đại điện</a>
            <img id="model-preview-dt" style="max-height:30px;padding-left: 20px;">
            <input  id="model-img-dt" type="file" name="img" style="display:none;">
          </label>
          <div style="clear:both"></div>
        </div>
        <a id="save_0" class="btn pull-right save-item" >LƯU</a>
        <div style="clear:both"></div>
     </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>
<div id="m-a-a_0_dinh_luong" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <form id="config_item_dl" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:10pt;font-family:'Roboto Bold' " id="model-h5">Giá trị thuộc tính</h5>
      </div>
      <div class="modal-body p-lg">
        
        <div class="form-group">
          <label>Giá trị</label>
          <input  id="model-value-dl" disabled="" name="name_config" type="text" class="form-control input_bg" autocomplete="off">
          <input  id="model-id-dl" type="hidden" class="form-control input_bg" name="id_dl">
        </div>
        <div class="form-group">
          <label>Tên hiển thị</label>
          <input id="model-input-dl"  type="text" class="form-control input_bg" name="config_name" placeholder="Ví dụ : Màu vàng, Hàng ngoại, 100cm - 200cm ...">
        </div>
        <div class="form-group" style="margin-bottom:0px!important; ">
          <label>
            <a class="btn btn-sm warn pull-left choose_img_item" >Ảnh đại điện</a>
            <img id="model-preview-dl" style="max-height:30px;padding-left:20px;">
            <input  id="model-img-dl" type="file" name="img-dl" style="display:none">
          </label>
          <div style="clear:both"></div>
        </div>
        <a id="save_1_dl" class="btn pull-right save-item"  >LƯU</a>
        <div style="clear:both"></div>
     </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>
<div id="m-a-a_add" class="modal" data-backdrop="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <form id="add_attr" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:10pt;font-family:'Roboto Bold' " id="model-h5">Giá trị thuộc tính</h5>
      </div>
      <div class="modal-body p-lg">
        
        <div class="form-group">
          <label>Giá trị</label>
          <input  id="model-value2" name="value" type="text" class="form-control input_bg" autocomplete="off" placeholder="Nhập giá trị cho thuộc tính ...">
          <input  id="model-id2" type="hidden" class="form-control input_bg" name="id">
        </div>
        <div class="form-group" style="margin-bottom:0px!important; ">
          <label>
            <p id ="d-message" style="display:none;color:#952C2C"></p>
            <a class="btn btn-sm warn pull-left choose_img_item" >Ảnh đại điện</a>
            <img id="model-preview2" style="max-height:30px;margin-left:20px;">
            <input  id="model-img2" type="file" name="img_add" style="display:none">
          </label>
          <div style="clear:both"></div>
        </div>
        <button id="save_add" class="btn pull-right save-item" style="background-color:#fff;" >LƯU</button>
        <div style="clear:both"></div>
     </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

<div id="m-a-a_01" class="modal " data-backdrop="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <form id="config_item_price" method="post" action="" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" style="font-size:10pt;font-family:'Roboto Bold' " id="model-h5">Giá trị thuộc tính</h5>
        </div>
        <div class="modal-body p-lg">
          
          <div class="form-group">
            <label>Giá trị</label>
            <input  id="model-value1" disabled type="text" class="form-control input_bg" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Tên hiển thị</label>
            <input  id="model-input1" type="text" class="form-control input_bg" name="config_name1" placeholder="Ví dụ :Từ 1tr nghìn đến 5tr nghìn ..." autocomplete="off" >
            <input  id="model-id1" type="hidden" class="form-control input_bg" name="id1">
          </div>
          <div class="form-group" style="margin-bottom:0px!important; ">
            <label>
              <a class="btn btn-sm warn pull-left choose_img_item" >Ảnh đại điện</a>
              <img id="model-preview1" style="max-height:30px;margin-left:20px;">
              <input  id="model-img1" type="file" name="img1" style="display:none">
            </label>
            <div style="clear:both"></div>
          </div>
          <button id="save_01" class="btn pull-right save-item" style="background-color:#ffffff;" >LƯU</button>
          <div style="clear:both"></div>
       </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

<div id="popup-notify" class="modal fade  in" data-backdrop="true" style="display: none; padding-left: 17px;">
   <div class="modal-dialog"  style="width: 300px;margin-top: 150px;">
       <div class="modal-content">
           <div class="modal-header">
               <table>
                   <tbody>
                       <tr>
                           <td style="width: 70%;">
                               <h5 class="modal-title">Thông báo</h5>
                           </td>
                       </tr>
                   </tbody>
               </table>
           </div>
           <div class="modal-body p-lg" id="d-edit-label" style=" padding: 15px;text-align:center">
    <p style="text-align:center"  id="notify">OK</p>
    <a id="add_item" class="btn btn-sm warn add-attr" data-dismiss="modal" style="background-color:#92D050;height: 30px;width: 80px;">Đóng</a>
  <div class="clearfix"></div>
</div>
       </div>
       <!-- /.modal-content -->
   </div>
</div>

@endif
<!-- / .modal -->

@stop
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
 
  <script src="{{ asset('summernote/dist/summernote.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/lang/summernote-vi-VN.js') }}"></script>
  <script src="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

  
  <script type="text/javascript">
  $(document).on('change','#list_attribute',function(){
    val=$(this).val();
      if(val == 1){
        $('.d-dinh-tinh').css('display','block');
      }else{
        $('.d-dinh-tinh').css('display','none');
      }   
  });


  id_add = "";
  list_c = null;
    $(document).on('click','.d-add-attr',function(){
      list_c = $(this).before();
      console.log(list_c);
      id = $(this).data('id');
      $('#m-a-a_add').modal('show');
      id_add = id;
    });

    $(document).on('submit','#add_attr',function(e){
      e.preventDefault();
      id = id_add;
      var form = $('#add_attr')[0];
      var formData = new FormData(form);
          formData.append('id',id );
      $.ajax({
          headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
          type:"post",
          url:"{{route('ajax.add.attr.filter')}}",
          data: formData,
          contentType: false,
          processData: false,
          success:function(data){
            if(data.status == true){
              $('#m-a-a_add').modal('hide');
              content = '<div class="itemfilter itemfilter_type_0" data-filter="'+data.filter.id+'">'+
                          '<span class="change-item" style="cursor:pointer;">'+
                            data.filter.value+
                          '</span>'+
                          @if(session('admin')->can('xoa_thuoc_tinh'))
                          '<span class="x-item">'+'×'+
                          @endif
                          '</span>'+
                        '</div>';
              list_c.before(content);
              $('#model-preview2').removeAttr('src');
              $('#model-value2').val("");
            }else{
              $('#d-message').css('display','block').text(data.message).delay(5000).slideUp();
            }
          },
          dataType:"json"
        });
    });
    change_item = null;
    change_attr = null;
    @if(session('admin')->can('sua_thuoc_tinh'))
    $(document).on('click','.name-attr.edit',function(){
      name = $(this).parent().attr('data-name');
      container = this;
      change_attr = this;
      $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('ajax.attr.get')}}",
            data:{'name':name},
            success:function(data){

              if(data.status === true){
                $("#e-id").val(data.attr.id);
                $("#e-name").val(data.attr.name);
                $("#e-init").val(data.attr.init);
                if(data.attr.avaiable == 1){
                  $("#list_attribute_0").attr('selected',false);
                  $("#list_attribute_1").attr('selected',true);
                  $(".d-init").css('display',"block");
                }else{
                  $("#list_attribute_0").attr('selected',true);
                  $("#list_attribute_1").attr('selected',false);
                  $(".d-init").css('display',"none");
                }
                $("#m-a-e").modal('show');
              }  
            },
            cache:false,
            dataType:'json'
        });     
    });
    @endif
    $(document).on('click','#save_attr',function(){
          var id = $("#e-id").val();
          var name = $("#e-name").val();
          var init = $("#e-init").val();
           $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('ajax.attr.save')}}",
            data:{'id':id,'name':name,'init':init},
            success:function(data){
              if(data.status === true){
                $(change_attr).text(data.attr.name);
                $(change_attr).parent().attr('data-name',data.attr.name);
              }  
            },
            cache:false,
            dataType:'json'
        });
    });
    @if(session('admin')->can('sua_thuoc_tinh'))
    $(document).on('click','.itemfilter_type_0 .change-item',function(e){
      change_item = this;
        id = $(this).parent().attr('data-filter');
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('ajax.filter.get.dt')}}",
            data:{'id':id},
            success:function(data){
              if(data.status === true){
                $("#model-value").val(data.item.value);
                $("#model-id-dt").val(data.item.id);
                if(data.item.img.length > 0) {
                  $("#model-preview-dt").attr('src',"{{asset('')}}" + data.item.img);
                }else{
                  $("#model-preview-dt").removeAttr('src');
                }
                 $("#m-a-a_0_dinh_tinh").modal('show');
              }       
            },
            cache:false,
            dataType:'json'
        });
    });
    $(document).on('click','.itemfilter_type_1 .change-item',function(e){
      change_item = this;
        id = $(this).parent().attr('data-filter');
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('ajax.filter.get.dl')}}",
            data:{'id':id},
            success:function(data){
              if(data.status === true){
                $("#model-value-dl").val(data.item.min+ " - " + data.item.max);
                $("#model-id-dl").val(data.item.id);
                $("#model-input-dl").val(data.item.config_name);
                if(data.item.img.length > 0) {
                  $("#model-preview-dl").attr('src',"{{asset('')}}" + data.item.img);
                }else{
                  $("#model-preview-dl").removeAttr('src');
                }
                 $("#m-a-a_0_dinh_luong").modal('show');
              }       
            },
            cache:false,
            dataType:'json'
        });
    });
    @endif
     $(document).on('click','.del_attribute',function(e){
        if(xacnhanxoa('Bạn có chắc muốn xóa tất cả Thuộc tính này không?')===false){

       }else{
        name = $(this).attr('data-name');
        container =  this;
        $.ajax({
            headers:{
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('ajax.del.attr')}}",
            data:{'name':name},
            success:function(data){
              if(data.status === true){
                $(container).parent().parent().remove();
              }else{
                $('#popup-notify').modal('show');
                $('#notify').text(data.message);

              }
            },
            cache:false,
            dataType:'json'
        });
       }
        
    });
    
     $(document).on('click','.itemfilter_type_0 .x-item,.itemfilter_type_1 .x-item',function(e){
        id = $(this).parent().attr('data-filter');
        container = this;
        if(xacnhanxoa('Bạn có chắc muốn xóa Thuộc tính này không?')===false){

       }else{
           if($(this).hasClass('price_x')){
              $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type:"post",
                    url:"{{route('ajax.filter.del')}}",
                    data:{'id':id,"price":1},
                    success:function(data){
                      console.log(data);
                      if(data.status === true){
                        $(container).parent().remove();
                      }else{
                          $('#popup-notify').modal('show');
                          $('#notify').text(data.message);
                      }   
                    },
                    cache:false,
                    dataType:'json'
                });
            }else{
             
                $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type:"post",
                    url:"{{route('ajax.filter.del')}}",
                    data:{'id':id,"price":0},
                    success:function(data){
                      console.log(data);
                      if(data.status === true){
                        $(container).parent().remove();
                      }else{
                         $('#popup-notify').modal('show');
                         $('#notify').text(data.message);
                      }   
                    },
                    cache:false,
                    dataType:'json'
                });
            }
       }
       
        
    });
     @if(session('admin')->can('sua_thuoc_tinh'))
     $(document).on('change','.filter_group',function(e){
      e.preventDefault();
      return false;
        id = $(this).val();
        console.log("change");
         $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('ajax.attr.filter.change')}}",
            data:{'id':id},
            success:function(data){
              
            },
            cache:false,
            dataType:'json'
        });
     });
    @endif
    function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#model-preview').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
    }
    $("#model-img").change(function(){
          readURL(this);
    });
    function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#model-preview1').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
    }
    $("#model-img1").change(function(){
          readURL(this);
    });
    function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#model-preview2').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
    }
    $("#model-img2").change(function(){
          readURL(this);
    });
    function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#model-preview-dt').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
    }
    $("#model-img-dt").change(function(){
          readURL(this);
    });
    $(document).on('click','#save_0',function(){
        var form = $('#config_item_dt')[0];
        var formData = new FormData(form);
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "post",
            url: "{{route('ajax.filter.submit')}}",
            data: formData,
            success: function (data) {
                 $("#m-a-a_0_dinh_tinh").modal('hide');
                 window.location.reload();
            },
            cache: false,
            contentType: false,
            processData: false,
        });
    });
    function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#model-preview-dl').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
    }
    $("#model-img-dl").change(function(){
          readURL(this);
    });
    $(document).on('click','#save_1_dl',function(){
        var form = $('#config_item_dl')[0];
        var formData = new FormData(form);
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "post",
            url: "{{route('ajax.filter.submit.dl')}}",
            data: formData,
            success: function (data) {
                 $("#m-a-a_0_dinh_luong").modal('hide');
                 window.location.reload();
            },
            cache: false,
            contentType: false,
            processData: false,
        });
    });
     
    $(document).on('click','td',function(){
      i = $(this).find('input').first();
      if(i){
        $(i).focus();
      }
    });
    $('#list_attribute').select2();
    $(document).on('click','#new_attr',function(){
       
    });
    $(document).on('click','#add_item',function(){
      choose = $("#list_attribute").find(":selected").val();
      value  = $("#value_attr").val();
      init = $("#init_attr").val();
       if(choose == 0){
         text = "Nhập tên cho thuộc tính";
       }else{
         text = "Nhập khoảng và enter để lọc ví dụ : 100 - 200 ";
       }
      if(value.length > 0){
         $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('attr.products.create')}}",
            data:{'name':value,'type':choose,'init':init},
            success:function(data){
              if(data.status === true){
                location.reload();
                text = '<tr>'+
                        '<td style="width: 4%">'+
                        '<label class="ui-check m-a-0">'+
                          '<input type="checkbox" name="post[]" class="has-value">'+
                          '<i class="dark-white" ></i>'+
                        '</label>'+
                        '</td>'+
                        '<td >'+
                          '<div class="name-attr" >'+value+'</div>'+
                          '<input class="itemfilter" style="width:auto">'+
                       '</td>'+
                      '</tr>';
                $('tbody').append(text);
              }       
            },
            cache:false,
            dataType:'json'
        });
      }
    });
    $(document).on('keyup','.inpput-filter',function(e){
       container = this;
       text = $(container).parent().find('.name-attr').first().text();
       if($(this).hasClass('price_add') ) text = "price";
       var keyCode = e.keyCode || e.which;
       if (keyCode === 13) {
         name = $(this).val();
         if(name.length > 0){
            var res = name.split("-");
            if(res[0]==undefined || res[1] == undefined){
              $('#popup-notify').modal('show');
              $('#notify').text("Bộ lọc khoảng không dúng định dạng");
            }else{
              if($.isNumeric(res[0]) && $.isNumeric(res[1])){
                min  = res[0];
                max  = res[1];
                $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type:"post",
                    url:"{{route('product.add-filter')}}",
                    data:{'avaiable':"1",'min': min,'max':max,'name':text},
                    success:function(data){
                      if(data.status === true){
                         if(data.price == 1){
                          str = '<div  class="itemfilter itemfilter_type_1" data-filter="'+data.item.id+'" >'+
                            '<span id="d-price-edit" style="cursor:pointer;">'+
                            data.item.config_name +
                            '</span>'+
                            @if(session('admin')->can('xoa_thuoc_tinh'))
                            '<span class="x-item price_x">'+'×'+'</span>'+
                            @endif
                            '</div>';
                         }else{
                          str = '<div class="itemfilter itemfilter_type_1" data-filter="'+data.item.id+'"><span class="change-item" style="cursor:pointer;">'+data.item.config_name+
                          @if(session('admin')->can('xoa_thuoc_tinh'))
                          '</span><span class="x-item">×</span>'+
                          @endif
                          '</div>';
                         }
                          $(container).before(str);
                         $(container).val('');
                      }
                    },
                    cache:false,
                    dataType:'json'
                });
              }else{
                $('#popup-notify').modal('show');
                $('#notify').text("Bộ lọc khoảng phải là số");
              }
            }
            // str = '<div class="itemfilter">'+name+'</div>';
            // $(this).before(str);
            // $(this).val('');
         }
       }
    }); 

    $(document).on('click','#d-price-edit',function(e){
      e.preventDefault();
      container = $(this);
      c = container.parent().data('filter');
      $("#m-a-a_01").modal('show');
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
        url:"{{route('ajax.get.filter.price')}}",
        data:{'id':c},
        success:function(data){
           if(data.status == true){
            $('#model-input1').val(data.filter.config_name);
            $('#model-value1').val(data.filter.min+" - "+data.filter.max);
            $('#model-id1').val(data.filter.id);
            if(data.filter.img.length > 0){
              $('#model-preview1').attr("src","{{asset('')}}"+data.filter.img);
            }else{
              $('#model-preview1').removeAttr("src");
            }
           }
        },
        cache:false,
        dataType: 'json'
      });
      
    });

    $(document).on('submit','#config_item_price',function(e){
        e.preventDefault();
        var form = $('#config_item_price')[0];
        var formData = new FormData(form);
        var name = $('#model-input1').val();
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "post",
            url: "{{route('ajax.filter.submit.price')}}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data.status == true){
                  $("#m-a-a_01").modal('hide');

                }
                
            },
            dataType:"json"
        });
      });

    
    
    

     function xacnhanxoa(msg){
     if(window.confirm(msg)){
          return true;
        }
        else
          return false;
    };
  </script>    

@endsection