@extends('backend.layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('summernote/dist/summernote.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />

   <style type="text/css">
    h2{
          font-family: "Roboto-Bold";
          font-size: 10.5pt !important;
    }
   
      
   </style>
@endsection

@section('content')

<form ui-jp="parsley" method="post" id="d_submit_add_order" action="" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Thêm Đơn Hàng</p>
      </div>
      <div style="float:right;margin-top:10px;">
     
    <button id="d_luu" type="submit" name="submit"  value="post" class="btn success" style="
    padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 8px;font-family: 'Roboto-Bold';
    min-width:100px; background-color:#738CEC">Lưu</button>
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
      label {
          font-size: 10pt;
          color: #404040;
      }
      .form-control{
        margin-bottom: 15px !important;
        border: 1px solid #E7E7E7 !important; 
       
      }
      .thong-tin{
          background-color: #fff !important;
      }
      .box{
        min-height: 275px;
      }
      .s-img{
        max-width:100%;
        min-width:100px;
        background-color:#F0F0F0;
        border:1px solid #E7E7E7;
        position: relative;

      }
      .s-img img{
        max-height: 100px;
      }
      .s-img span{
          position: absolute;
          top: 35px;
          left: calc(50% - 15px);
      }
      .s-img1{
        max-width:100%;height:40px;min-width:130px;background-color:#F0F0F0;
        border:1px solid #E7E7E7;
        position: relative;

      }
       .s-img1 img{
        max-height: 100px;
      }
      .s-img1 span{
          position: absolute;
          top: 35px;
          left: calc(50% - 15px);
      }
      
      .no-border{
        border: 0px !important;
        background-color: rgba(1,1,1,0);
      }
      .add-attribute{
        position: absolute;
        right: 15px;
        top: 10px;
        color: #738CEC;
        cursor: pointer;
      }
      .add-attribute1{
        position: absolute;
        right: 10px;
        top: 10px;
        color: #FFFFFF;
      }
      .material-icons{
      cursor: pointer;
      }
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
      .td{
        padding:12px 0px !important;
      }
      .wt{
        width: 145px !important;
      }
      .tw{
        width: 30px !important;
      }
      .loader {
    width: 21px;
    animation: spin 1.3s linear infinite;
    margin: auto;
  margin-top: -48px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
     </style>
    <div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
        @include('backend.partials._messages')
        <div id="error" class="col-sm-12" style="background-color:#F2DEDE;padding:20px 0px 20px 17px;margin:15px 0px;border:1px solid #EBCCCC;border-radius:3px;display:none;"></div>
    </div>
    <div class="padding">
         <div class="row">
          <div class="col-sm-5" style="padding-bottom:50px !important;">
            <div class="box" >
                  <div class="box-header">
                    <h2 style="font-family:'Roboto Black';">Thông Tin Khách Hàng</h2>
                  </div>
                  <div class="box-body" style="padding-top:10px;">
                        <div class="row">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                             <div class="form-group" >
                                    <div class="form-group">
                                          <label class="col-sm-2 form-control-label">Khách Hàng</label>
                                          <div class="col-sm-10">
                                                <input type="text" placeholder="Tên khách hàng" class="form-control thong-tin" name="full_name" id="name_search" phone_search" autocomplete="off"> 
                                          </div>                       
                                    </div>
                                    <div class="form-group">
                                          <label class="col-sm-2 form-control-label ">Email</label>
                                          <div class="col-sm-10">
                                               <input type="email"   placeholder="Email" class="form-control thong-tin" name="email" value="" id="email_search" phone_search" autocomplete="off"> 
                                          </div>                       
                                    </div>
                                    <div class="form-group">
                                          <label class="col-sm-2 form-control-label ">Phone</label>
                                          <div class="col-sm-10">
                                               <input type="text"  placeholder="Số điện thoại" class="form-control thong-tin" name="phone" value="" id="phone_search" autocomplete="off"> 
                                          </div>                       
                                    </div>
                                    <div class="form-group">
                                          <label class="col-sm-2 form-control-label ">Địa chỉ</label>
                                          <div class="col-sm-10">
                                               <input type="text" class="form-control thong-tin"  placeholder="Địa chỉ" name="address" value="" id="address_search" phone_search" autocomplete="off"> 
                                          </div>                       
                                    </div>
                                    <div class="form-group">
                                          <label class="col-sm-2 form-control-label ">Ghi chú</label>
                                          <div class="col-sm-10">
                                               <input style="" type="text" class="form-control thong-tin"  placeholder="Ghi chú" name="note" value="" phone_search" autocomplete="off"> 
                                          </div>                       
                                    </div> 
                                    
                                      <div class="form-group">
                                          <label class="col-sm-2 form-control-label" >Tỉnh Thành</label>
                                          <div class="col-sm-10">
                                            <select id="d-province" name="province" class=" form-control">
                                                <option value="0">Chọn tỉnh thành phố</option>
                                                <?php 
                                                  $province = App\Province::orderby('type','asc')->orderby('name','asc')->get();
                                                ?>
                                                @foreach($province as $key => $item)
                                                    <option value="{!! $item->id !!}">- {!! $item->name !!}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                  </div> 
                                  <div class="form-group" id="d-block1" style="display:none;">
                                      <label class="col-sm-2 form-control-label" >Quận Huyện</label>
                                      <div class="col-sm-10" id="d-append">
                                      </div>
                                  </div> 
                                                 
                                  
                            </div>   
                       </div>  
                  </div>   
            </div> 
          </div>
          <div class="col-sm-7" style="padding-bottom:200px !important;" >         
                <div class="box" style="min-height:0px">
                    <div class="box-header">
                      <h2>Giỏ Hàng</h2>
                      <i class="material-icons md-24  add-attribute" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="fade-left-big" ui-target="#animate">&#xe147;</i>
                    </div>
                    <div class="box-body" style="padding-top:6px !important;padding-left:14px !important;padding-bottom:0px !important;">
                          <div class="row">
                            <div class="col-sm-12" >
                                <div class="box-body" style="padding:16px 0px !important;padding-bottom:0px !important">
                                  <div class="table-responsive">
                                    <table class="table table-striped b-t">
                                      <tbody id="d-list">
                                          <tr style="font-size:12px;">
                                            <td class="td wt" style="padding-left:3px !important;">
                                              Tên
                                            </td>
                                            <td class="td wt" style="padding-left:6px !important;">
                                              Ảnh 
                                            </td>
                                            <td class="td wt" style="padding-left:0px !important;">
                                              Mã 
                                            </td>
                                            <td class="td tw" style="width:60px !important;text-align: center;">
                                              Số Lượng 
                                            </td>
                                            <td class="td wt" style="text-align:center !important;">
                                              Giá
                                            </td>
                                            <td class="td wt" >
                                              Thành Tiền
                                            </td>
                                            <td class="td tw" style="text-align:center !important;">
                                              Xóa
                                            </td>
                                          </tr>
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
  </div>
</form>
 <div id="m-a-tab" class="modal " data-backdrop="true" style="border:0px;">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tìm kiếm sản phẩm</h5>
          <i class="material-icons a-d add-attribute1"  style="font-family:Roboto-Bold; color:#000000;opacity:0.3">×</i>
        </div>
        <div class="modal-body p-lg" style="padding-bottom:0px !important;">
              <div class="table-responsive">
                <input type="text"  id="search" class="form-control thong-tin" placeholder="Tên Hoặc Mã Sản Phẩm" autocomplete="off">
                <div class="col-sm-12 item" style="padding:0px">
                <div class="box-body" style="background-color:#FFFFFF;padding:0px !important;" >
                    <div class="table-responsive">
                      <table class="table table-striped b-t" style="margin-bottom:0px;">
                        <tbody id="l-box">
                           
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-striped b-t">
                        <tbody id="l-box">
                            
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
   <div id="m-a-custommer" class="modal" data-backdrop="true" style="border:0px;">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Khách hàng</h5>
          <i class="material-icons a-d add-attribute1"  style="font-family:Roboto-Bold; color:#000000;opacity:0.3">×</i>
        </div>
        <div class="modal-body p-lg " style="padding-bottom:0px !important;">
              <div class="table-responsive">
                <div class="box-body" style="padding: 0px;">
                    <div class="table-responsive">
                      <table class="table table-striped b-t">
                        <tbody id="l-custommer">
                          
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
<div id="popup-loading" class="modal fade  in" data-backdrop="true" style="display: none; padding-left: 17px;">
   <div class="modal-dialog"  style="width: 300px;margin-top: 150px;">
       <div class="modal-content">
           <div class="modal-header">
               <table>
                   <tbody>
                       <tr>
                           <td style="width: 70%;">
                               <h5 class="modal-title">Loading...</h5>
                           </td>
                       </tr>
                   </tbody>
               </table>
           </div>
           <div class="modal-body p-lg" id="d-edit-label" style="
    padding: 15px;
">
  <p style="
">Tình trạng đơn hàng của bạn đang được xử lý. Vui lòng đợi trong giây lát.</p>
  <a id="add_item" class="btn btn-sm warn pull-left add-attr" data-dismiss="modal" style="background-color:#92D050;height: 30px;width: 80px;float: right;">
  <div class="loader" style="margin-top: -1px;width: 18px;">
      <img src="{!! asset('frontend/img/wheel.svg') !!}" alt="" style="
    width: 18px;
    margin-top: 0px;
">
  </div>
</a>
  <div class="clearfix"></div>
</div>
       </div>
       <!-- /.modal-content -->
   </div>
</div>

@endsection

@section('js-footer')order.submit.add
  

  <script>
  submit = 0;
  $(document).on('mouseenter',"button[type=submit]",function(){
      submit = 1;
    });
    $(document).on('mouseleave',"button[type=submit]",function(){
      submit = 0;
    }); 
  $(document).on('keyup','#phone_search',function(e){
    if ( e.which == 13 ) {
      phone = $("#phone_search").val();
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type:"post",
        url:"{{route('order.search.customer')}}",
        data:{'phone':phone},
        success:function(data){
          if(data.status == true){
            $('#l-custommer').html(data.html_customer);
            $("#m-a-custommer").modal('show');
          }
        },
        cache:false,
        dataType:'json'
      });
    }
  });
  $(document).on('click','.choose_customer',function(){
    // alert("1");
    td = $(this).parent().parent();
    if($(td).hasClass('customer_td')){
      name = $(td).next().text();
      $("#name_search").val(name.trim());
      email = $(td).next().next().text();
      $("#email_search").val(email.trim());
      phone = $(td).next().next().next().text();
      $("#phone_search").val(phone.trim());
      address = $(td).next().next().next().next().text();
      $("#address_search").val(address.trim());
       $("#m-a-custommer").modal('hide');
       $('#l-custommer').html("");
    }
  });
  spam = 0;
  $(document).on('submit','#d_submit_add_order',function(e){
    e.preventDefault();
    if(submit ==0){
        return false;
    }
       $('#popup-loading').modal('show');
      var form = $('#d_submit_add_order')[0];
      var formData = new FormData(form);
      if(spam == 0){
        spam = 1;
          $.ajax({
          headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
          type:"post",
          url:"{{route('order.submit.add')}}",
          data: formData,
          contentType: false,
          processData: false,
          success:function(data){
            spam = 0;
            if(data.status == true){
              $('#d_luu').css('display','none');
              setTimeout(function(){
                 window.location = data.link;
              },200);
            }
            if(data.status == false){
              if(data.errors == 0){
                span = '<span style="color:#B84855!important"><span style="color:#A94442!important">Error:</span> Chọn sản phẩm cần thêm</span>';
                $('#error').css('display','block').html(span).delay(4000).slideUp();
                $('#popup-loading').modal('hide');
              }
              if(data.errors == 1){
                //tinh thành
                span = '<span style="color:#B84855!important"><span style="color:#A94442!important">Error:</span> Vui lòng chọn tỉnh thành</span>';
                $('#error').css('display','block').html(span).delay(4000).slideUp();
                $('#popup-loading').modal('hide');
              }
              if(data.errors == 2){
                //quận huyện 
                span = '<span style="color:#B84855!important"><span style="color:#A94442!important">Error:</span> Vui lòng chọn quận huyện</span>';
                $('#error').css('display','block').html(span).delay(4000).slideUp();
                $('#popup-loading').modal('hide');
              }
            }
          },
          dataType:"json"
        });
      }
  });

    $(document).on('change','#d-province',function(){
       id = $(this).find(':selected').val();
       $.ajax({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              type:"post",
              url:"{{route('order.ajax.province')}}",
              data:{'id':id},
              success:function(data){
                if(data.status == true){
                  $('#d-block1').css('display','block');
                  $('#d-append').html(data.html);
                }
                
              },
              cache:false,
              dataType:'json'
            });
    });

    $(document).on('click','.add-attribute',function(){
      $('#m-a-tab').modal('show');
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
              url:"{{route('order.search.add')}}",
              data:{'key':value},
              success:function(data){
                console.log(data);
                $('#l-box').html(data.html_search);
              },
              cache:false,
              dataType:'json'
            });
        }else{
           $('#l-box').html('');
        }
    });
      $('.a-d').click(function(){
        $('#m-a-tab').modal('hide');
      });
    });

    $(document).on('click','.choose-product',function(){
      id = $(this).val();
      container = this;
      $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('order.checkbox.add')}}",
            data:{'id':id},
            success:function(data){
              console.log(data);
              id = data.product.id;
              c = $('#d-list > tr[data-id="'+id+'"]');
              if(c.length > 0){
                $(container).parent().parent().parent().remove();
              }else{
                $('#d-list').append(data.html_check);
                $(container).parent().parent().parent().remove();
              }
             
            },
            cache:false,
            dataType:'json'
          });
    });

    $(document).on('change','.d-price',function(){
        console.log($(this).val());
        d_='<sup>đ</sup>';
        var a = parseInt($(this).val());
        var price = $(this).attr('data-price');
        var totalPrice = a*price;
        totalPrice = (totalPrice + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $(this).parent().next().next().html(totalPrice + d_);
    });

    $(document).on('keyup','.d-price',function(){
       console.log($(this).val());
        var a = parseInt($(this).val());
        var price = $(this).attr('data-price');
        var totalPrice = a*price;
        totalPrice = (totalPrice + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $(this).parent().next().next().text(totalPrice + " vnđ");
    });

    $(document).on('click','.del',function(){
      $('#d-del').remove();
    });

  </script>

@endsection