@extends('backend.layouts.default')
@section('css')
     <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('backend/libs/jquery/nestable/jquery.nestable.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
     <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
     <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
    <style type="text/css">
       @media (min-width:991px){.title_form{margin-left:10px!important;margin-top:16px}}.dd{max-width:none!important}.p-themmoi{margin-left:30px;font-size:14pt;font-family:'Roboto Black';color:rgba(0,0,0,.87)}.p-themmoi:hover{color:#738CEC}.modal-header{height:auto;padding-top:14px;padding-bottom:12px}.modal-header .modal-title{line-height:normal}.d-danhmuc{padding-top:0}.wrap-d-duongdan{border-bottom:solid 1px #EDEFF0;padding-top:3px;padding-bottom:9px}.d-danhmuc .d-duongdan{padding-left:0;margin-top:5px;font-size:11.5px}.d-danhmuc .d-duongdan li{list-style-type:none;float:left}.d-danhmuc .d-duongdan li:nth-child(2),.d-danhmuc .d-duongdan li:nth-child(4){margin-left:5px;margin-right:5px;color:#edeff0}.d-danhmuc .d-duongdan li a{color:#bac1c5}.d-select-style{background-size:10px 10px;margin-bottom:15px}.d-select-style select{border:1px solid #E7E7E7;display:block;width:100%;height:38px;padding:.375rem .75rem;line-height:1.5;color:#55595c;background-color:#fff;background-image:none}@media (min-width:544px){.modal-dialog{width:450px}}.d-danhmuc input{background-color:#fff!important;margin-bottom:15px}.d-danhmuc .d-content-footer-btn{float:right;background-color:#92D050;color:#fff;padding-top:6px;padding-bottom:6px;width:80px;border:none}.d-danhmuc p{margin-top:18px;margin-bottom:13px}.d-danhmuc div p:first-child{margin-top:15px}
       .select2-search__field{display:none}h2{font-family:Roboto-Bold;font-size:10.5pt!important}div#myDropZone{width:100%;min-height:100px;background-color:#F0F0F0;border:1px solid #E7E7E7!important}.dz-message span{font-size:10pt!important;font-family:Roboto;color:#7F7F7F}.dz-remove{font-size:9pt!important}.dz-image{border-radius:0!important}option:disabled{background:#ddd}.select2-container .select2-selection--single{height:37px}.select2-selection__arrow{height:35px!important}.select2-search--dropdown{padding:0!important}.select2{width:100%!important;font-size:10pt}.select2-selection__rendered{font-size:10pt!important}

    /*Xem thuộc tính ///////////////////////////*/
    </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
            <a href="" id="popup-quantri-themdanhmuc" class="p-themmoi" style="margin-left:0px">+ Danh mục cấp 1</a>
    </div>
</div>
 </div>
<!-- Popup //////////////////////////////////////// -->
    <div id="dialog-quantri-themdanhmuc" class="modal" data-backdrop="true" style="display: none;">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                    <form action="" id="form-parent">
                        <div class="modal-header">
                            <table>
                                <tbody><tr><td style="width: 100%;">
                                            <h5 class="modal-title">Tạo danh mục cấp 1</h5> </td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-body p-lg d-danhmuc">
                            <div class="wrap-d-duongdan">
                                <table><tr><td>
                                            <ul class="d-duongdan"><li><a href="">Tất cả sản phẩm</a></li><li>/</li>
                                            </ul></td></tr>
                                </table>
                            </div>
                            <div>
                                <p>Chọn giá trị thuộc tính muốn gán vào danh mục này</p>
                                <div id="notify1"></div>
                                <div class="d-select-style">
                                    <select class="d-list-province" id="AttributeKey" name="key" >
                                        <?php $list_attr = App\Attribute::where('type',1)->where('name','<>','Giá')->get(); ?>
                                        <option class="q-ft-option" value="0" data-id="0">Chọn thuộc tính</option>
                                        @foreach($list_attr as $k => $v)
                                      
                                        <option class="q-ft-option" value="{{$v->id}}" data-id="{{$v->id}}">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-select-style">
                                    <select class="d-list-province" id="AttributeValue" name="value">
                                        <option class="q-ft-option" value="0" data-id="0">Chọn giá trị</option>
                                    </select>
                                </div>
                                <p>Tên danh mục</p>
                                <input type="text" id="nameCategory1" placeholder="Tên danh mục..." class="form-control" name="name" value="">
                                <button class="d-content-footer-btn">Tạo</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
<!-- End of popup ///////////////////////////////// -->

<!-- Popup //////////////////////////////////////// -->
    <div id="dialog-quantri-themdanhmuc-child" class="modal" data-backdrop="true" style="display: none;">
        <div class="modal-dialog" id="animate">
            <div class="modal-content" id="modal-child">
                    
            </div>
        </div>
    </div>
<!-- End of popup ///////////////////////////////// -->


<div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->
    <div class="padding">
       <div class="row masonry-container">
          
          <style type="text/css">
            .cate_edit{
              display:inline-block; 
              float:right;
              margin-right: 10px;
              /*color: blue;*/
            }
            .cate_edit i{
              font-size: 13pt !important;
            }
            .cate_name{
              display:inline-block
            }
          </style>
            <?php
               $list_categories = App\GroupAttribute::select('group_attributes.*',"filters.min",'filters.max','filters.value','filters.type')->where(['group_attributes.group_id'=>0])->leftjoin('filters','group_attributes.filter_id','=','filters.id')->get();

            ?>
            @foreach($list_categories as $v0)
            <div class="col-sm-6 item" style="margin-bottom:20px">
              <div  class="dd">
                <ol class="dd-list dd-list-handle" >
                
                     <li class="dd-item dd-collapsed" data-id="{{$v0->id}}" >
                      <div class="dd-content box">
                       <!--  <div class="dd-handle">
                          <i class="fa fa-reorder text-muted"></i>
                        </div> -->
                        <div>
                            <div class="cate_name">{{$v0->name}} <span style="color:#d6d6d6">@if($v0->type ==0) [ {{$v0->value}} ]@else [ {{$v0->min}} - {{$v0->max}} ]@endif</span></div>
                            <div class="cate_edit">
                                <a href="#" class="add-child" data-id="{{$v0->id}}" style="display:block; font-size:17px; padding: 0px 10px 2px 10px; margin-right: 11px;"><i class="material-icons" style="vertical-align: -4px;"></i>
                                </a> 
                            </div>
                            <div class="cate_edit">
                                <a href="#" type="submit" id="xoa-cate" data-id="{{$v0->id}}">
                                     Xóa
                                </a>
                             </div>
                            <div class="cate_edit">
                            <a href="{{route('edit-content-folder',['id'=>$v0->id])}}">
                              Sửa
                            </a>
                            </div>
                            <div class="cate_edit">
                                <a href="{{route('folder.product',['id'=>$v0->id])}}">
                                  Xem
                                </a>
                            </div>

                        </div>
                      </div>
                      <?php 
                      if (!function_exists('show_child'))
                      {
                        function show_child($object){
                            $d = $object->subcategory;
                            $d =  App\GroupAttribute::select('group_attributes.*',"filters.min",'filters.max','filters.value','filters.type')->where(['group_attributes.group_id'=>$object->id])->leftjoin('filters','group_attributes.filter_id','=','filters.id')->get();
                            if($d){
                              ?>
                                <ol class="dd-list dd-list-handle" style="display: block;">
                              <?php
                            }
                            foreach ($d as $v) {
                               ?>
                                <li class="dd-item" data-id="{{$v->id}}">
                                    <div class="dd-content box">
                                     
                                      <div>
                                         <div class="cate_name">{{$v->name}} <span style="color:#d6d6d6">@if($v->type ==0) [ {{$v->value}} ]@else [ {{$v->min}} - {{$v->max}} ]@endif</span></div>
                                           <div class="cate_edit">
                                            <a href=""  class="add-child" data-id="{{$v->id}}"  style="display:block; font-size:17px; padding: 0px 10px 2px 10px; margin-right: 11px;"><i class="material-icons" style="vertical-align: -4px;"></i>
                                            </a> 
                                          </div>
                                          <div class="cate_edit">
                                              <a href="#" type="submit" id="xoa-cate" data-id="{{$v->id}}">
                                                   Xóa
                                              </a>
                                           </div>
                                          <div class="cate_edit">
                                            <a href="{{route('edit-content-folder',['id'=>$v->id])}}">
                                              Sửa
                                            </a>
                                          </div>
                                          <div class="cate_edit">
                                            <a href="{{route('folder.product',['id'=>$v->id])}}">
                                              Xem
                                            </a>
                                          </div>
                                      </div>
                                    </div>
                                    <?php
                                    show_child($v);
                                    ?>
                                </li>
                               <?php
                                
                            }
                            if($d){
                              ?>
                                </ol>
                              <?php
                            }
                        };
                      }
                        show_child($v0);
                      ?>
                  </li>
                
                </ol>
              </div>
            </div>
              @endforeach
        </div>
    </div>
</div>
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/nestable/jquery.nestable.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
  <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
  <script>
    $('.dd').nestable({ /* config options */ });
    $('.dd').on('change', function() {
        console.log($('.dd').nestable('serialize'));
    });
    var $container = $('.masonry-container');

    $container.masonry({
      columnWidth: '.item',
      itemSelector: '.item'
    });   
      $(document).on('click','.dd-item > button',function(){
        setTimeout(function(){
          var $container = $('.masonry-container');

              $container.masonry({
                columnWidth: '.item',
                itemSelector: '.item'
              });   
        },100);
     });
    function xacnhanxoa(msg){
      if(window.confirm(msg)){
        return true;
      }
      else
        return false;

     };
     $(document).on('click','#xoa-cate', function(event){
           event.preventDefault;
           if(xacnhanxoa('Bạn có chắc xóa danh mục hiện tại hay không?')===false){

           }else{
             id = $(this).attr('data-id');
             $.ajax({
                 type: 'post',
                 url:  '{{ route('folder-del') }}',
                 data: {'id': id},
                 dataType:'json',
                 success: function(msg){
                   location.reload();
                 }
             })
           
           }
                     
     });
     $(document).on('click',"#popup-quantri-themdanhmuc",function(e){
        e.preventDefault();
        $('#dialog-quantri-themdanhmuc').modal('show');
     });
     id_click = 0;
      $(document).on('click',".add-child",function(e){
        e.preventDefault();
        id = $(this).data('id');
        id_click = id;
        $.ajax({
                 type: 'post',
                 url:  '{{ route('product.get.modal.attribute') }}',
                 data: {"id":id},
                 dataType:'json',
                 success: function(data){
                    console.log(data);
                    if(data.status == true){
                        $("#modal-child").html(data.html);
                        $('#modal-attr-value').select2();
                        $('#modal-attr-key').select2();
                    }else{
                        $("#modal-child").html(data.html);
                    } 
                 }
        });
        $('#dialog-quantri-themdanhmuc-child').modal('show');
     });
    $('#AttributeKey').select2();
    $('#AttributeValue').select2();
    $(document).on('change',"#AttributeKey",function(){
        value = $(this).val();
        $.ajax({
                 type: 'post',
                 url:  '{{ route('product.get.select.attribute') }}',
                 data: {'attr_id':value},
                 dataType:'json',
                 success: function(data){
                    if(data.status == true ){
                      $("#AttributeValue").html(data.html);
                      $("#AttributeValue").select2();
                    }else{
                      $("#AttributeValue").html(data.html);
                      $("#AttributeValue").select2();
                    }
                 }
        });

    });
     $(document).on('change',"#modal-attr-key",function(){
        value = $(this).val();
        if(value ==0){
          $("#nameCategory2").val('');
        }
        $.ajax({
                 type: 'post',
                 url:  '{{ route('product.get.select.attribute') }}',
                 data: {'attr_id':value,'id_click':id_click},
                 dataType:'json',
                 success: function(data){
                    if(data.status == true ){
                      $("#modal-attr-value").html(data.html);
                      $("#modal-attr-value").select2();
                    }else{
                      $("#modal-attr-value").html(data.html);
                      $("#modal-attr-value").select2();
                    }
                 }
        });
    });
     $(document).on('change',"#AttributeValue",function(){
        text = $("#AttributeValue option:selected").text();
        if( $("#AttributeValue option:selected").val() ==0 ){
          $("#nameCategory1").val('');
        }else{
          $("#nameCategory1").val(text);
        }
      });
     $(document).on('change',"#modal-attr-value",function(){
        text = $("#modal-attr-value option:selected").text();
        if( $("#modal-attr-value option:selected").val() ==0 ){
          $("#nameCategory2").val('');
        }else{
          $("#nameCategory2").val(text);
        }
      });
     
    submit = 1;
    $(document).on('submit','#form-parent',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        thiss = this;
        if(submit == 1){
          submit = 0;
          $.ajax({
                  type:"post",
                  url:"{{route('folder-submit-1')}}",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success:function(data){
                      submit = 1;
                      if(data.status == true){
                        $("#form-parent")[0].reset();
                        $("#AttributeValue").html(data.html);
                        $('#AttributeKey').select2();
                        $('#AttributeValue').select2();
                        $("#notify1").html(data.message);
                        $('div.alert').delay(2000).slideUp();
                        setTimeout(function(){
                          location.reload();
                        },2400);
                      }
                      else{
                        $("#form-parent")[0].reset();
                        $("#AttributeValue").html(data.html);
                        $('#AttributeKey').select2();
                        $('#AttributeValue').select2();
                        $("#notify1").html(data.message);
                        $('div.alert').delay(2000).slideUp();
                      }
                  },
                  dataType:"json"
          });
        }
        
    });
    submit2 = 1;
    $(document).on('submit','#form-child',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        thiss = this;
        if(submit2 == 1){
          submit2 = 0;
          $.ajax({
                  type:"post",
                  url:"{{route('folder-submit-2')}}",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success:function(data){
                      submit2 = 1;
                      console.log(data);
                      if(data.status == true){
                        $("#form-child")[0].reset();
                        $("#modal-attr-value").html(data.html);
                        $('#modal-attr-key').select2();
                        $('#modal-attr-value').select2();
                        $("#notify2").html(data.message);
                        $('div.alert').delay(2000).slideUp();
                        setTimeout(function(){
                          location.reload();
                        },2400);
                      }
                      else{
                        $("#form-child")[0].reset();
                        $("#modal-attr-value").html(data.html);
                        $('#modal-attr-key').select2();
                        $('#modal-attr-value').select2();
                        $("#notify2").html(data.message);
                        $('div.alert').delay(2000).slideUp();
                      }
                  },
                  dataType:"json"
          });
        }
        
    });
    
   
    // $(document).ready(function(){
    //   $("button[data-action='collapse']").css('display','none');
    //   $("button[data-action='expand']").css('display','block');
    // });
  </script>

@endsection