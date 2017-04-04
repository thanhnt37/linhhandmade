@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
@endsection
@section('content')
<style type="text/css">
  .bootstrap-tagsinput,.select2-selection,input,textarea{background-color:#F0F0F0!important}@media (min-width:991px){.title_form{margin-left:10px!important;margin-top:16px}}.title_form{margin-top:16px;font-size:14pt}.select2-results__option,input,select,textarea{font-size:10pt!important}.title_form p{font-family:'Roboto Black'}.m-h-50{min-height:50px}.m-t-30{min-height:30px}@media print{@page{size:auto;margin:0}}.customer{text-transform:uppercase}.h-line>div{padding-top:10px;border-bottom:1px solid #E6E6E6}.cus-tilte{width:100px;display:inline-block}.none{display:none}.img{max-width:130px;min-width:40px;position:relative}input,textarea{border:1px solid #E7E7E7!important}.select2-results__option{padding-left:14px!important}.select2-dropdown{border-radius:0!important;border-bottom:1px solid #E7E7E7!important;border-top:1px solid #E7E7E7!important;border-left:1px solid #E7E7E7!important;border-right:1px solid #E7E7E7!important}.select2-selection{color:#D1F5F1;border-radius:0!important;border:1px solid #E7E7E7!important}.select2-selection__choice{font-size:10pt!important;background-color:#0CC2AA!important;border:1px solid #0CC2AA!important;color:#D1F5F1!important}.select2-search__field{background-color:#F0F0F0!important;border:none!important;display:none}.select2-selection__choice__remove{color:#D1F5F1!important}.select2-selection__rendered{padding-top:5px!important;padding-bottom:5px!important;padding-left:13px!important;border-radius:0!important}.select2-results__option--highlighted{background-color:#F0F0F0!important;color:#404040!important}.select2-selection__clear{color:#BFBFBF!important}.select2-search__field::-webkit-input-placeholder{color:#404040}.select2-search__field::-moz-placeholder{color:#404040}.select2-search__field:-ms-input-placeholder{color:#404040}.select2-search__field:-moz-placeholder{color:#404040}option:disabled{background:#ddd}.select2-container .select2-selection--single{height:37px}.select2-selection__arrow{height:35px!important}.select2-search--dropdown{padding:0!important}.select2{width:100%!important;font-size:10pt}.select2-selection__rendered{font-size:10pt!important}.del-order{color:#777;font-family:Roboto-Bold}.del-order:hover{color:#404040}.label{padding:.35em .7em}.add-attr{background-color:#92D050;color:#fff;padding-top:6px;padding-bottom:6px;min-width:70px}.add-attr:hover{background-color:#92D050!important}.modal-title{font-size:10.5pt}.add-attr{font-size:10pt}.label{font-size:9pt;font-family:Roboto}.change-status{cursor:pointer}p{margin-bottom:10px}.modal-content{border-radius:0}.modal-header{height:50px;padding:0 15px}.modal-header .modal-title{font-size:10.5pt;font-family:'Roboto Bold';line-height:50px}.modal-body p,.modal-header button{font-size:10pt;font-family:Roboto}.modal-header button{background-color:#92D050;color:#fff;padding-top:6px;padding-bottom:6px;width:80px;border:none}.modal-body .email-tb input,.modal-body .so-sp input,textarea{height:38px;font-size:10pt!important;border:1px solid #E7E7E7!important;background-color:#F0F0F0;padding-left:10px;padding-right:10px}.email-tb,.so-sp{margin-bottom:0}.modal-body .so-sp input,textarea{width:48%}.modal-body .so-sp input:first-child{float:right}.modal-body .email-tb input{width:100%;margin-bottom:16px}.wrap-email-tb{border:1px solid #e5e5e5;padding:10px}.wrap-email-tb p:first-child{border-bottom:solid 1px #e5e5e5;margin-left:-10px;margin-right:-10px;padding-left:10px;padding-right:10px;margin-bottom:15px;padding-bottom:10px;font-family:'Roboto Bold'}.wrap-email-tb textarea{width:100%;height:auto}          
</style>
 
 
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
          <p>Chi tiết đơn hàng</p>
    </div>
    @if(session('admin')->can('cau_hinh_email_don_hang'))
    <div style="float:right;line-height:60px;">
       <span class="nav-icon">
          <i class="material-icons" id="d-popup-config-email-thanh-toan" style="font-size:23px;cursor:pointer">&#xe8b8;</i>
        </span>
    </div>
    @endif
</div>
</div>
 
<div class="app-body" id="view">
  <div class="padding">
    @include('backend.partials._messages')
      <div class="box">  
        <div class="box-body">
          <div class="clearfix">
              <div class="pull-left">
              <?php $system = App\System::select('img_logo')->first() ?>
                  <h4 class="text-right"><img class="img" src="@if($system->img_logo) {{ asset('').$system->img_logo }} @else https://placehold.it/130x40 @endif" alt="Logo Công ty"></h4>
                  
              </div>
              <div class="pull-right">
                  <h4>Hóa đơn <strong>#HD-{{$order->id}}</strong>
                  </h4>
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong class="cus-tilte">Khách hàng </strong><strong class="customer">{{$order->fullname}}</strong></p>
                       
                    </div>
                    
                     <div class="clearfix"></div>
                  </div>
              </div>
              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong  class="cus-tilte">Mã đơn hàng</strong>#{{$order->id}}</p>
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>

              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong class="cus-tilte">Số điện thoại</strong>{{$order->phone}}</p>
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>

               <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong  class="cus-tilte">Địa chỉ</strong>{{$order->address}}</p>
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>
              <!-- phong -->
             @if ($order->district_id==0)
              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong  class="cus-tilte">Nơi nhận</strong>   </p>
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>
              @endif
              @if ($order->district_id!=0)
                 <?php
                
                  $dname = DB::table('district')->where('id',$order->district_id)->first();
                  $dprovince =DB::table('province')->where('id',$dname->provinceid)->first();
                
              ?>
              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong  class="cus-tilte">Nơi nhận</strong>{{$dname->name}} / {{$dprovince->name}}</p>
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>
              @endif

              <!-- phong -->
              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong  class="cus-tilte">Ghi chú</strong>{{$order->note}}</p>
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>

              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong  class="cus-tilte">Email</strong>{{$order->email}}</p>
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>
                
              
             
              <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p><strong  class="cus-tilte">Ngày đặt hàng</strong>{{$order->created_at}}</p>
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>
             

               <div class="col-md-12 h-line">
                  <div>
                    <div class="pull-left m-t-30">
                        <p> <strong class="cus-tilte">Trạng thái: </strong>
                        @if($order->status == 1)
                        <span class="label stick-show change-status" data-status="{!! $order->status !!}" data-id="{{$order->id}}" style="background-color:#777777">Đang chờ</span>
                        @endif
                        @if($order->status == 2)
                        <span class="label stick-show change-status" data-status="{!! $order->status !!}" data-id="{{$order->id}}"  style="background-color:#D9534F">Bị hủy</span>
                        @endif
                        @if($order->status == 3)
                        <span class="label stick-show change-status" data-status="{!! $order->status !!}" data-id="{{$order->id}}"  style="background-color:#0CC2AA">Đang xử lý</span>
                        @endif
                        @if($order->status == 4)
                        <span class="label stick-show change-status" data-status="{!! $order->status !!}" data-id="{{$order->id}}"  style="background-color:#F0AD4E">Đang giao hàng</span>
                        @endif
                        @if($order->status == 5)
                        <span class="label stick-show change-status" data-status="{!! $order->status !!}" data-id="{{$order->id}}"  style="background-color:#5CB85C">Đã thanh toán</span>
                        @endif
                        @if($order->status == 6)
                        <span class="label stick-show change-status" data-status="{!! $order->status !!}" data-id="{{$order->id}}"  style="background-color:#337AB7">Đã nhận hàng</span>
                        @endif
                        <span id="N404" style="display: none; margin-left: 5px;"></span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                  </div>
              </div>
          </div>
          <div class="m-h-50"></div>
          <div class="row">
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table m-t-30">
                          <thead>
                              <tr><th>STT</th>
                              <th>Sản phẩm</th>
                              <th>Mã sản phẩm</th>
                              <th>Số lượng</th>
                              <th>Giá sản phẩm</th>
                              <th>Khối lượng</th>
                              <th style="width:120px">Giá x số lượng</th>
                          </tr></thead>
                          <tbody>
                              <?php 
                                $percen = $order->percent;
                                if($percen){
                                    if($percen < 100 && $percen > 0){
                                    
                                    }else{
                                      $percen = 0;
                                    }
                                }else{
                                  $percen = 0;
                                }
                                $percent_x = $percen;
                                $a = ($order->total * (100-$percent_x))/100;
                                $b = $order->total - $a;
                                $total_non_sale = 0;
                              ?>
                              @foreach ($order->getItem as $key => $item)
                                <?php $frame_item = App\Frame::where('id',$item->frame_id)->first(); 
                                ?>

                                <tr> 
                                  <td>{{$key+1}}</td>
                                  <td>@if($frame_item) <a href="{{route('getProDetail',['id'=>$frame_item->id,'slug'=>$frame_item->slug])}}">{{$frame_item->name}}</a> @else {{"Đã bị xóa"}} @endif</td>
                                  <?php 
                                    $code ="";
                                    if( sizeof($frame_item ) ){
                                      $code = $frame_item->code_frame;
                                    }else{
                                      $code = "Đã bị xóa";
                                    }
                                  ?>
                                  <td>{!! $code !!}</td>
                                  <td>{{$item->quantity}}</td>
                                 
                                  @if($item->price_sale)
                                    <td>{{number_format($item->price_sale, 0, '', '.')}} đ/1sp</td>
                                     <td>{{$item->weight}} gam/1sp</td>
                                    <td>{{ number_format($item->quantity*$item->price_sale, 0, '', '.')}} đ</td>
                                  @else
                                    <?php $total_non_sale += $item->quantity*$item->price ?>
                                    <td>{{number_format($item->price, 0, '', '.')}}đ/1sp</td>
                                     <td>{{$item->weight}} gam/1sp</td>
                                    <td>{{ number_format($item->quantity*$item->price, 0, '', '.')}} đ</td>
                                  @endif
                                </tr>
                              @endforeach
                              <tr style="background-color: rgba(0, 0, 0, 0) !important;"> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td colspan="2">
                                      <div class="col-md-12" style="padding:0px;">
                                          <span class="text-right"> <h6 style="font-size:14px !important;"> Tổng sản phẩm: {{number_format($order->total, 0, '', '.')}} đ </h6> </span>
                                      </div>
                                    </td>
                              </tr>
                                  @if($percen)
                                    <tr style="background-color: rgba(0, 0, 0, 0) !important;"> 
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td colspan="2">
                                            <div class="col-md-12" style="padding:0px;">
                                                <span class="text-right"> <h6 style="font-size:14px !important;">Giảm {{ $percent_x }} %: {!! number_format((int)($total_non_sale*$percen/100),0,'','.') !!} đ</h6> </span>
                                            </div>
                                          </td>
                                    </tr>
                                  @endif
                                  <tr style="background-color: rgba(0, 0, 0, 0) !important;"> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                      <div class="col-md-12" style="padding:0px;">
                                          <span class="text-right"> <h6 style="font-size:14px !important;"> Phí vận chuyển: {{number_format($order->total_weight, 0, '', '.')}} đ </h6> </span>
                                      </div>
                                    </td>
                              </tr>
                              <tr style="background-color: rgba(0, 0, 0, 0) !important;"> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                      <div class="col-md-12" style="padding:0px;">
                                          <span class="text-right"> @if(!$percen) <h6> Tổng đơn hàng: {{number_format($order->total + $order->total_weight, 0, '', '.')}} đ </h6> @else <h6> Tổng đơn hàng: {{number_format(($order->total + $order->total_weight)-(int)($total_non_sale*$percen/100), 0, '', '.')}} đ </h6> @endif</span>
                                      </div>
                                    </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
            <div class="hidden-print" style="    background-color: #fff;  min-height: 30px;">
                <div class="pull-right">
                    <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                    
                </div>
            </div>
        </div>   
      </div>  
    </div>
</div>


<div id="m-a-tab" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thay đổi trạng thái đơn hàng</h5>
      </div>
      <div class="modal-body p-lg" id="info-order">
        
     </div>
    </div><!-- /.modal-content -->
  </div>
</div>
@if(session('admin')->can('cau_hinh_email_don_hang'))
  <div id="popup-quantri-email-thanh-toan" class="modal fade animate " data-backdrop="true">
   <div class="modal-dialog " id="animate" style="width:70% !important;">
       <div class="modal-content">
       <form method="post" id="d-submit-email-thanh-toan">
           <div class="modal-header">
               <table>
                   <tr>
                       <td style="width: 98%;"><h5 class="modal-title">Cấu hình email đơn hàng</h5></td>
                       <td style="display:none;"><button>Lưu</button></td>
                   </tr>
               </table>
           </div>
           <div class="modal-body p-lg">
               <div class="row">
                     <div class="col-sm-4">
                       <div class="email-tb">
                           <div class="wrap-email-tb">
                               <p>Email xác nhận thanh toán</p>
                               <p>Tiêu đề email</p>
                               <input name="description_thanhtoan" type="text" value="{Domain} Xác nhận thanh toán đơn hàng {mã đơn hàng}" class="form-control" disabled>
                               <p>Nội dung email</p>
                               <textarea name="content_thanhtoan" cols="20" rows="4" disabled class="form-control" >Xác nhận đơn hàng đã được thanh toán
Mã đơn hàng : {Mã đơn hàng}
{Domain}
                               </textarea>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-4">
                       <div class="email-tb">
                           <div class="wrap-email-tb">
                               <p>Email thông báo đơn hàng bị hủy</p>
                               <p>Tiêu đề email</p>
                               <input name="description_bihuy" type="text" value="{Domain} Thông báo đơn hàng bị hủy {mã đơn hàng}" class="form-control" disabled >
                               <p>Nội dung email</p>
                               <textarea name="content_bihuy" cols="20" rows="4" disabled class="form-control">Đơn hàng của bạn đã bị hủy bởi quản trị viên
Mã đơn hàng : {Mã đơn hàng}
{Domain}</textarea>
                           </div>
                       </div>
                   </div>

                   <div class="col-sm-4">
                       <div class="email-tb">
                           <div class="wrap-email-tb">
                               <p>Email thông báo đang xử lý</p>
                               <p>Tiêu đề email</p>
                               <input name="description_bihuy" type="text" value="{Domain} Thông báo đơn hàng đang xử lý {mã đơn hàng}" class="form-control" disabled >
                               <p>Nội dung email</p>
                               <textarea name="content_bihuy" cols="20" rows="4" disabled class="form-control">Đơn hàng của bạn đang được xử lý
Mã đơn hàng : {Mã đơn hàng}
{Domain}</textarea>
                           </div>
                       </div>
                   </div>

                   <div class="col-sm-6" style="margin-top: 24px">
                       <div class="email-tb">
                           <div class="wrap-email-tb">
                               <p>Email thông báo đang giao hàng</p>
                               <p>Tiêu đề email</p>
                               <input name="description_bihuy" type="text" value="{Domain} Thông báo đang giao hàng {mã đơn hàng}" class="form-control" disabled >
                               <p>Nội dung email</p>
                               <textarea name="content_bihuy" cols="20" rows="4" disabled class="form-control">Đơn hàng của bạn đang trong quá trình vận chuyển
Mã đơn hàng : {Mã đơn hàng}
{Domain}</textarea>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-6" style="margin-top: 24px">
                       <div class="email-tb">
                           <div class="wrap-email-tb">
                               <p>Email thông báo đã nhận hàng</p>
                               <p>Tiêu đề email</p>
                               <input name="description_bihuy" type="text" value="{Domain} Thông báo đã nhận hàng thành công{mã đơn hàng}" class="form-control" disabled >
                               <p>Nội dung email</p>
                               <textarea name="content_bihuy" cols="20" rows="4" disabled class="form-control">Đơn hàng của bạn đã giao hàng thành công
Mã đơn hàng : {Mã đơn hàng}
{Domain}</textarea>
                           </div>
                       </div>
                   </div>
                   
               </div>
           </div>
          </form> 
       </div>
       <!-- /.modal-content -->
   </div>
</div>
@endif
{{--end config-email-thanh-toan --}}
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/footable/dist/footable.all.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
  <script>
     jQuery(function($){
    $('.table').footable({
      "paging": {
        "enabled": true,
        "size": 7,
      }
    });
  });
     @if(session('admin')->can('cau_hinh_email_don_hang'))
     $(document).on('click', '#d-popup-config-email-thanh-toan', function(event) {
       event.preventDefault();
       $('#popup-quantri-email-thanh-toan').modal('show');
     });
     @endif
     $(document).on('submit','#d-submit-email-thanh-toan',function(e){
      e.preventDefault();
      var form = $('#d-submit-email-thanh-toan')[0];
      var formData = new FormData(form);

      $.ajax({
        headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        type:"post",
        url:"{{route('ajax.form.email.thanh.toan')}}",
        data: formData,
        contentType: false,
        processData: false,
        success:function(data){
          if(data == true){
            
            $('#popup-quantri-email-thanh-toan').modal('hide');
            window.location.reload();
          }
        },
        dataType:"json"
      });
     });
   
    @if(session('admin')->can('xu_li_don_hang'))
     $(document).on('click','.change-status',function(){
      order = this;
        $('#info-order').html('');
        id =$(this).attr('data-id');
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"post",
            url:"{{route('order.get.info')}}",
            data:{'id':id},
            success:function(data){
              console.log(data);
              $('#info-order').html(data.innertext);
              $('#single').select2();
              $('#m-a-tab').modal('show');
            },
            cache:false,
            dataType:'json'
        });   
     });
      $(document).on('submit','#form-edit-order',function(e){
        e.preventDefault();
        status = $('#single').find(':selected').val();
        form = $("#form-edit-order")[0];
        var formData = new FormData(form);
        formData.append('status', status);
        $.ajax({
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
          type:"post",
          url:"{{route('order.ajax.submit')}}",
          data: formData,
          contentType: false,
          processData: false,
          success:function(data){
                order = $('.change-status');
                if(data == 1){
                  $(order).text('Đang chờ');
                  $(order).css('background-color','#777777');
                }
                if(data == 2){
                  $(order).text('Bị hủy');
                  $(order).css('background-color','#D9534F');
                }
                if(data == 3){
                  $(order).text('Đang xử lý');
                  $(order).css('background-color','#0CC2AA');
                }
                if(data == 4){
                  $(order).text('Đang giao hàng');
                  $(order).css('background-color','#F0AD4E');
                }
                if(data == 5){
                  $(order).text('Đã thanh toán');
                  $(order).css('background-color','#5CB85C');
                }
                if(data == 6){
                  $(order).text('Đã nhận hàng');
                  $(order).css('background-color','#337AB7');
                }
                if(data == 404){
                  $("#N404").text('Số lượng sản phẩm không đủ để thanh toán');
                  $("#N404").css('display','inline-block');
                  setTimeout(function(){
                      $("#N404").slideUp();
                  },4000);
                }
              $('#info-order').html('');
              $('#m-a-tab').modal('hide');
          },
          dataType:"text"
        });

     });

     @endif
  </script>
@endsection