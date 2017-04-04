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
        <p>Đặc tính</p>
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
     <?php $attribute = App\Feature::where('type',1)->groupby('name')->orderby('created_at')->get();?>
    <div class="padding">
    
         <div class="row">
          
              <div class="col-sm-12">
              
                  <div class="box">
                    <div class="box-header">
                      <h2 style="font-size:10.5pt; font-family: Roboto Bold">Danh sách đặc tính </h2>
                    </div>
                    
                    <div class="box-body">
                          <div class="table-responsive">
                            <table class="table table-striped b-t">
                              <tbody>
                              @if(session('admin')->can('them_thuoc_tinh'))
                                <tr id="add_attribute" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="fade-left-big" >
                                  <td style="width: 4%">
                                    <label class="ui-check m-a-0" style="padding-left:5px; font-family:Roboto Bold; font-size:12pt;">
                                      +
                                    </label>
                                  </td>
                                  <td>
                                    <!-- <input disabled="" id="new_attr" type="" spellcheck="false" name="" placeholder="Thêm đặc tính mới "> -->
                                    <p  id="new_attr" style="cursor:pointer;color:#A9ABB3;margin-bottom:0px;margin-top: 3px;">Thêm đặc tính mới </p>
                                  </td>
                                  <td style="width: 4%">
                                  </td>
                                </tr>
                              @endif
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
                                  
                                    $list_attr= App\Feature::where('name',$value->name)->where('type',0)->get();
                                    ?>
                                    <!--  Danh sách item filter type 0 -->
                                    @foreach($list_attr as $key2 => $value2)
                                      <div class="itemfilter" data-feature="{{$value2->id}}">
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
        <h5 class="modal-title">Thêm đặc tính</h5>
      </div>
      <div class="modal-body p-lg">
        <div class="form-group">
          <label>Tên đặc tính</label>
          <input type="text" id="value_attr" class="form-control" name="value" placeholder="ví dụ : Màu sắc, kích thước ...">
        </div>
        <!-- <div class="form-group d-dinh-tinh" >
          <label>Đơn vị (nếu cần)</label>
          
        </div> -->
        <input type="text" style="display:none" id="init_attr" class="form-control" name="value" placeholder="ví dụ : kg,cm ...">
        <a id="add_item" class="btn btn-sm warn pull-left add-attr"  data-dismiss="modal">Tạo</a>
        <div style="clear:both"></div>
     </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<div id="m-a-a_add" class="modal" data-backdrop="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <form id="add_attr" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:10pt;font-family:'Roboto Bold' " id="model-h5">Giá trị đặc tính</h5>
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
@endif
<!-- .modal -->
@if(session('admin')->can('sua_thuoc_tinh'))


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
<div id="m-a-a_0_edit_feature" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <form id="config_item_feature" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:10pt;font-family:'Roboto Bold' ">Giá trị thuộc tính</h5>
      </div>
      <div class="modal-body p-lg">
        
        <div class="form-group">
          <label>Giá trị</label>
          <input  id="model-value" name="value" type="text" class="form-control input_bg" autocomplete="off">
          <input  id="model-id-feature" type="hidden" class="form-control input_bg" name="id_feature">
        </div>
        <div class="form-group" style="margin-bottom:0px!important; ">
          <label>
            <a class="btn btn-sm warn pull-left choose_img_item" >Ảnh đại điện</a>
            <img id="model-preview-dt-feature" style="max-height:30px;padding-left: 20px;">
            <input  id="model-img-dt-feature" type="file" name="img" style="display:none;">
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
  id_add = "";
  list_c = null;
  $(document).on('click','.d-add-attr',function(){
    list_c = $(this).before();
    id = $(this).data('id');
    $('#m-a-a_add').modal('show');
    id_add = id;
  });
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
            url:"{{route('ajax.del.feature')}}",
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
 $(document).on('click','.x-item',function(e){
        id = $(this).parent().attr('data-feature');
        container = this;
        if(xacnhanxoa('Bạn có chắc muốn xóa Đặc tính này không?')===false){

       }else{
            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type:"post",
                url:"{{route('ajax.feature.del')}}",
                data:{'id':id},
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
        url:"{{route('ajax.add.feature.filter')}}",
        data: formData,
        contentType: false,
        processData: false,
        success:function(data){
          if(data.status == true){
            $('#m-a-a_add').modal('hide');
            content = '<div class="itemfilter" data-feature="'+data.feature.id+'">'+
                        '<span class="change-item" style="cursor:pointer;">'+
                          data.feature.value+
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
            $('#d-message').css('display','block').text(data.message).delay(3000).slideUp();
          }
        },
        dataType:"json"
      });
  });
    change_item = null;
    change_attr = null;
    @if(session('admin')->can('sua_thuoc_tinh'))
    $(document).on('click','.change-item',function(e){

      change_item = this;
        id = $(this).parent().attr('data-feature');
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('ajax.feature.get')}}",
            data:{'id':id},
            success:function(data){
              if(data.status === true){
                $("#model-value").val(data.attr.value);
                $("#model-id-feature").val(data.attr.id);
                if(data.attr.img.length > 0) {
                  $("#model-preview-dt-feature").attr('src',"{{asset('')}}" + data.attr.img);
                }else{
                  $("#model-preview-dt-feature").removeAttr('src');
                }
                 $("#m-a-a_0_edit_feature").modal('show');
              }       
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
                  $('#model-preview-dt-feature').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
    }
    $("#model-img-dt-feature").change(function(){
          readURL(this);
    });
    $(document).on('click','#save_0',function(){
        var form = $('#config_item_feature')[0];
        var formData = new FormData(form);
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "post",
            url: "{{route('ajax.feature.submit')}}",
            data: formData,
            success: function (data) {
                 $("#m-a-a_0_edit_feature").modal('hide');
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
    
    $(document).on('click','td',function(){
      i = $(this).find('input').first();
      if(i){
        $(i).focus();
      }
    });
    $('#list_attribute').select2();
    $(document).on('click','#add_item',function(){
      choose = $("#list_attribute").find(":selected").val();
      value  = $("#value_attr").val();
      init = $("#init_attr").val();
      text = "Nhập tên cho đặc tính";
      if(value.length > 0){
         $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('feature.products.create')}}",
            data:{'name':value,'init':init},
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
  
    

     function xacnhanxoa(msg){
     if(window.confirm(msg)){
          return true;
        }
        else
          return false;
    };
  </script>    

@endsection