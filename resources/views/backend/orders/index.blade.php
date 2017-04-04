@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
@endsection

@section('content')
<style type="text/css">
    .label-info{background-color:#5bc0de}.bootstrap-tagsinput,.select2-selection,input,textarea{background-color:#F0F0F0!important}.bootstrap-tagsinput{width:100%}.bootstrap-tagsinput input{min-height:2rem}.label{font-size:96%}.select2-results__option,input,select,textarea{font-size:10pt!important}input,textarea{border:1px solid #E7E7E7!important}.select2-results__option{padding-left:14px!important}.select2-dropdown{border-radius:0!important;border-bottom:1px solid #E7E7E7!important;border-top:1px solid #E7E7E7!important;border-left:1px solid #E7E7E7!important;border-right:1px solid #E7E7E7!important}.select2-selection{color:#D1F5F1;border-radius:0!important;border:1px solid #E7E7E7!important}.select2-selection__choice{font-size:10pt!important;background-color:#0CC2AA!important;border:1px solid #0CC2AA!important;color:#D1F5F1!important}.select2-search__field{background-color:#F0F0F0!important;border:none!important}.box-header,.modal-header{border-bottom:1px solid #E7E7E7}.select2-selection__choice__remove{color:#D1F5F1!important}.select2-selection__rendered{padding-top:5px!important;padding-bottom:5px!important;padding-left:13px!important;border-radius:0!important}.select2-results__option--highlighted{background-color:#F0F0F0!important;color:#404040!important}.select2-selection__clear{color:#BFBFBF!important}.select2-search__field::-webkit-input-placeholder{color:#404040}.select2-search__field::-moz-placeholder{color:#404040}.select2-search__field:-ms-input-placeholder{color:#404040}.select2-search__field:-moz-placeholder{color:#404040}.nav-item a,label{color:#A6A6A6}label{font-size:10pt}.nav-item a{background-color:#F2F2F2;margin-right:10px}.note-toolbar{background-color:#fff;padding:0!important}.dropdown-toggle::after,.note-popover{display:none}.p-a-sm{box-shadow:none!important;padding:0!important}.note-editable{padding-right:0!important;padding-left:0!important}.title_form{margin-top:16px;font-size:14pt}.dd-content{padding-top:15px!important;padding-bottom:15px!important}.dd-item>button{height:41px!important}.cate_name,.menu_name{font-size:10.5pt}.alert,.nav-item a,.note-editable{font-size:10pt}.cate_edit a,.menu_edit a{background-color:#E7E7E7;padding:4px 12px;border-radius:3px;color:#A6A6A6}label[for=file_img_preview]{line-height:1.3}label[for=file_img_preview] a{padding-top:4px!important;padding-bottom:4px!important;min-width:120px}.title_form p{font-family:'Roboto Black'}.nav-link{padding-right:3px}.nav-item span{padding-left:8px;cursor:pointer}h2{font-family:Roboto-Bold;font-size:10.5pt!important}@media (min-width:991px){.title_form{margin-left:10px!important;margin-top:16px}}.number-post{width:80px;height:44px;background-color:#fff;border:1px solid #E7E7E7;float:left;color:#404040;font-size:10pt}.drop-cate,.drop-cate:hover{background-color:rgba(1,1,1,0)!important;box-shadow:none!important}.dropdown-item,td,th{font-size:10pt!important}#filter{float:left}.modal-body .so-sp input:first-child,.pagination{float:right}.box-body{position:relative}.drop-cate{position:absolute;left:calc(100% - 150px);top:28px;width:20px!important;height:20px!important;padding:7px!important}.dropdown-menu{left:16px!important;top:58px!important;width:calc(100% - 132px);padding-top:0!important;padding-bottom:0!important;border-top:0!important;border-top-left-radius:0!important;border-top-right-radius:0!important}.dropdown-item{padding-top:10px!important;padding-bottom:10px!important}.dropdown-toggle::after{margin-left:-1px!important;display:inline-block;width:0;height:0;margin-right:.25rem;vertical-align:middle;content:"";border-top:.3em solid;border-right:.3em solid transparent;border-left:.3em solid transparent;margin-top:-20px}th{font-family:Roboto-Bold!important}.action-post a{padding:4px 10px}.action-post a:hover{background-color:#bfbfbf;border-radius:2px}.pagination>li>a{padding:.4rem .75rem!important}.footable{margin-bottom:0!important}.status:first-letter{text-transform:uppercase}.modal-dialog{width:600px;margin:70px auto}.modal-content{border:1px solid #E7E7E7;border-radius:0}.modal-title{font-size:10.5pt;font-family:"Roboto Bold"}.add-attr{background-color:#92D050;color:#fff;font-size:8pt;padding-top:6px;padding-bottom:6px}.add-attr:hover{background-color:#92D050!important}option:disabled{background:#ddd}.select2-container .select2-selection--single{height:37px}.select2-selection__arrow{height:35px!important}.select2-search__field{display:none}.select2-search--dropdown{padding:0!important}.select2{width:100%!important;font-size:10pt}.select2-selection__rendered{font-size:10pt!important}.del-order{color:#777;font-family:Roboto-Bold}.del-order:hover{color:#404040}.modal-header{height:50px;padding:0 15px}.modal-header .modal-title{font-size:10.5pt;font-family:'Roboto Bold';line-height:50px}.modal-body p,.modal-header button{font-size:10pt;font-family:Roboto}.modal-header button{background-color:#92D050;color:#fff;padding-top:6px;padding-bottom:6px;width:80px;border:none}.modal-body .email-tb input,.modal-body .so-sp input,textarea{height:38px;font-size:10pt!important;border:1px solid #E7E7E7!important;background-color:#F0F0F0;padding-left:10px;padding-right:10px}.email-tb,.so-sp{margin-bottom:0}.modal-body .so-sp input,textarea{width:48%}.modal-body .email-tb input{width:100%;margin-bottom:16px}.wrap-email-tb{border:1px solid #e5e5e5;padding:10px}.wrap-email-tb p:first-child{border-bottom:solid 1px #e5e5e5;margin-left:-10px;margin-right:-10px;padding-left:10px;padding-right:10px;margin-bottom:15px;padding-bottom:10px;font-family:'Roboto Bold'}.p-themmoi,.p-themmoi1{margin-left:30px;font-size:14pt;font-family:'Roboto Black'}.wrap-email-tb textarea{width:100%;height:180px}.p-themmoi{color:rgba(0,0,0,.4)}.p-themmoi:hover{color:#738CEC}.p-themmoi1{color:rgba(0,0,0,.87)}.p-themmoi1:hover{color:#738CEC}
            .pagination{float:right}th{font-family:Roboto-Bold!important}.action-post a{padding:4px 10px}.comment-pagination>li>a,.pagination>li>a{padding:.4rem .75rem!important}.action-post a:hover{background-color:#bfbfbf;border-radius:2px}.footable{margin-bottom:0!important}.add_attr_tab{color:#738CEC}.comment-pagination>li{display:inline;list-style:none}.comment-pagination>li>a{position:relative;float:left;margin-left:-1px;line-height:1.5;color:#0275d8;text-decoration:none;background-color:#fff;border:1px solid #ddd}.comment-pagination>li>.active{background-color:#0CC2AA;color:#fff;border:1px solid #0CC2AA}
       </style>
 <?php   
  if (!isset($a)){
  if(isset($id)) {
          $list_orders = App\Order::where('status', $id)->orderby('created_at','desc')->limit(500)->paginate(5);
      }else{
        $list_orders = App\Order::where('status', 1)->orwhere('status',2)->orwhere('status',3)->orwhere('status',4)->orwhere('status',5)->orwhere('status',6)->orderby('created_at','desc')->limit(500)->paginate(5);
      }
    }
  
  ?>

<div class="app-header white box-shadow">
<div class="navbar">
     <div style="float:left;" class="title_form">
          <!-- phong -->
          
          @if(session('admin')->can('them_don_hang'))
            @if(isset($id))
            <p style="float: left;">Tất cả đơn hàng {{isset($id) ? check_status_order($id) :''}}</p>
          @else
            <a href="{{ route('order.add') }}" class="p-themmoi1" style="margin-left:0px">+ Thêm đơn hàng</a>
          @endif  
          @endif
        
    </div>
     @if(session('admin')->can('cau_hinh_tu_dong_huy_don_hang'))
     <div style="float:right;line-height:60px;">
         <span class="nav-icon">
            <i class="material-icons" id="d-popup-config-order" style="font-size:23px;cursor:pointer">&#xe8b8;</i>
          </span>
      </div>
      @endif
</div>
</div>
 

 <div class="app-body" id="view">
    <div class="padding">
      <div class="box">
        
        <div class="box-body">
          <form method="get" action="{{route('order.search')}}" style="display: inline-block; width: 100%;">
              <input style="width:calc(100% - 100px); line-height:30px;" autocomplete="off" placeholder="Tìm kiếm đơn hàng" type="text" class="form-control input-sm inline m-r" name="od"/>
              <button class="number-post" style="float:right">{{$list_orders->count()}} ĐH</button>
          </form>
          <button class="btn white dropdown-toggle drop-cate" data-toggle="dropdown"></button>
          <div class="dropdown-menu pull-right">
                 <a  class="dropdown-item" href="{{route('order.list')}}">Tất cả</a>
                 <a  class="dropdown-item" href="{{route('order.type', ['id'=>1])}}">Đang đợi</a>
                 <a  class="dropdown-item" href="{{route('order.type', ['id'=>2])}}">Bị hủy</a>
                 <a  class="dropdown-item" href="{{route('order.type', ['id'=>3])}}">Đang xử lý</a>
                 <a  class="dropdown-item" href="{{route('order.type', ['id'=>4])}}">Đang giao hàng</a>
                 <a  class="dropdown-item" href="{{route('order.type', ['id'=>5])}}">Đã thanh toán</a>
                 <a  class="dropdown-item" href="{{route('order.type', ['id'=>6])}}">Đã nhận hàng</a>
          </div>
          
          <div style="clear:both"></div>
        </div>
        <div class="table-responsive">
        <style type="text/css">
          .edit{
            color:orange;
          }
          .edit i{
            font-size: 15pt !important;
          }
        </style>
         
          <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
            <thead>
              <tr>
                  <th data-toggle="true">
                      Mã ĐH
                  </th>
                  <th data-toggle="true">
                      Khách Hàng
                  </th>
                  <th data-toggle= "true">
                      Điện thoại
                  </th>
                  
                <!--   <th>
                      Email
                  </th> -->
                  <th>
                      Thời gian đặt hàng
                  </th>
                  <th>
                    Tổng đơn hàng
                  </th>
                  
                   @if(session('admin')->can('xu_li_don_hang'))
                  <th>
                    Tình trạng
                  </th>

                  @endif
                  @if(session('admin')->can('xem_don_hang') || session('admin')->can('them_don_hang'))
                  <th>
                     Chi tiết 
                  </th>
                  @endif
                  @if(session('admin')->can('xoa_don_hang'))
                  <th >
                    Xóa
                  </th>
                  @endif
              </tr>
            </thead>
            <tbody>

              @foreach($list_orders as $key => $value)
              <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->fullname}}</td>
                  <td>{{$value->phone}}</td>
                 
                  <!-- <td>
                      {{$value->email}}
                  </td> -->
                  <td >
                     {{$value->created_at}}
                  </td>
                 
                  <td>{{number_format($value->total+(int)$value->total_weight, 0, '', '.')}}đ</td>
                  <td class="status show-status" data-id="{{$value->id}}" style="cursor : pointer">{{check_status_order($value->status)}}</td>
                  @if(session('admin')->can('xem_don_hang') || session('admin')->can('them_don_hang'))
                  <td><a href="{{ route('order.show',['id'=>$value->id]) }}" title="Thông tin chi tiết">Chi tiết</a></td>
                  @endif
                  @if(session('admin')->can('xoa_don_hang'))
                  <td><a><span data-id="{!! $value->id !!}" class="close-slide del-order" style="font-size:14px;">×</span></a></td>
                  @endif
              </tr>
              @endforeach
            </tbody>
            <tfoot class="hide-if-no-paging">
              <tr>
                  <td colspan="12" class="text-center">
                    <ul class="list-inline comment-pagination">
                      <?php $link_limit = 9; ?>
                        @for ($i = 1; $i <= $list_orders->lastPage(); $i++)
                          <?php
                          $half_total_links = floor($link_limit / 2);
                          $from = $list_orders->currentPage() - $half_total_links;
                          $to = $list_orders->currentPage() + $half_total_links;
                          if ($list_orders->currentPage() < $half_total_links) {
                             $to += $half_total_links - $list_orders->currentPage();
                          }
                          if ($list_orders->lastPage() - $list_orders->currentPage() < $half_total_links) {
                              $from -= $half_total_links - ($list_orders->lastPage() - $list_orders->currentPage()) - 1;
                          }
                          ?>
                          @if ($from < $i && $i < $to)
                              <li class="{{ ($list_orders->currentPage() == $i) ? ' active' : '' }}">
                                  @if(!$s)
                                    <a  class="{{ ($list_orders->currentPage() == $i) ? ' active' : '' }}" href="{{$list_orders->url($i)}}" data-page={{$i}}>{{ $i }}</a>
                                    
                                  @else
                                    <a  class="{{ ($list_orders->currentPage() == $i) ? ' active' : '' }}" href="{{$list_orders->url($i)}}&od={!! $s !!}" data-page={{$i}}>{{ $i }}</a>
                                  @endif
                              </li>
                          @endif
                        @endfor
                    </ul>
                  </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</div>
<div id="info_order" class="modal fade animate" data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <table>
                    <tr>
                        <td style="width: 98%;"><h5 class="modal-title" id="OrderID">Lịch sử đơn hàng</h5></td>
                       
                    </tr>
                </table>
            </div>
            <div class="modal-body p-lg" id="content_logs">
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@if(session('admin')->can('cau_hinh_tu_dong_huy_don_hang'))
<div id="popup-order" class="modal fade animate" data-backdrop="true">
   <div class="modal-dialog" id="animate">
       <div class="modal-content">
       <form method="post" id="d-submit">
           <div class="modal-header">
               <table>
                   <tr>
                       <td style="width: 98%;"><h5 class="modal-title">Cấu hình đơn hàng</h5></td>
                       <td><button>Lưu</button></td>
                   </tr>
               </table>
           </div>
           <div class="modal-body p-lg">
               <div class="row">
                   
                  <div class="col-sm-12">
                      <div class="email-tb">
                           <div class="wrap-email-tb">
                               <p>Email nhận đơn hàng mới</p>
                               <p>Email nhận thông báo</p>
                               <?php $email_order_recv = App\Email_General::where('name','Email Nhận đơn hàng')->first(); ?>
                               <input name="email_order_recv" type="text" @if(isset($email_order_recv)) value="{!! $email_order_recv->email !!}" @else placeholder="Email nhận đơn hàng" @endif>
                               
                               <p>Tiêu đề email</p>
                               <input name="description_order" type="text" value="Có đơn hàng mới {mã đơn hàng}" class="form-control" disabled >
                               <p>Nội dung email</p>
                               <textarea name="content_order" cols="20" rows="50" disabled class="form-control" >Chi tiết đơn hàng {mã đơn hàng} : 
{Sản phẩm 1} x số lượng
{Sản phẩm 2} x số lượng
...
                               </textarea>
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
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/footable/dist/footable.all.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
  <script>


  order = null;
    function xacnhanxoa(msg){
      if(window.confirm(msg)){
        return true;
      }
      else
        return false;

     };
      $(document).on('submit','#d-submit',function(e){
      e.preventDefault();
      var form = $('#d-submit')[0];
      var formData = new FormData(form);

      $.ajax({
        headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        type:"post",
        url:"{{route('ajax.order.config.task')}}",
        data: formData,
        contentType: false,
        processData: false,
        success:function(data){
          console.log(data);
          $("#message").text(data.message);
          setTimeout(function(){
            $('#popup-order').modal('hide');
          },2000)
        },
        dataType:"json"
      });
     });

     $(document).ready(function(){
        // $('a[data-page="first"]').text('Đầu tiên');
        $('a[data-page="first"]').remove();
        $('a[data-page="prev"]').text('Trước');
        $('a[data-page="next"]').text('Tiếp');
        // $('a[data-page="last"]').text('Cuối cùng');
        $('a[data-page="last"]').remove();
     });
     $(document).on('click','.del-order',function(){
        
        container = this;
        id = $(this).attr('data-id');
        if(xacnhanxoa('Bạn có muốn xóa đơn hàng này không?')===false){

       }
       else{

        $.ajax({
          headers:{
            'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
          },
          type:'post',
          url:"{!! route('order.status') !!}",
          data:{'id':id},
          cache:false,
          dataType:"json",
          success:function(data){
            console.log(data);
            $(container).parent().parent().parent().remove();
          }
        });
      }
     });
     $(document).on('click','.show-status',function(){
        id = $(this).data('id');
        $.ajax({
          headers:{
            'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
          },
          type:'post',
          url:"{!! route('order.history') !!}",
          data:{'id':id},
          cache:false,
          dataType:"json",
          success:function(data){
            console.log(data);
            if(data.status == true){
              $('#content_logs').html(data.html);
              $('#OrderID').text("Lịch sử đơn hàng #" + data.orderID);
              $("#info_order").modal('show');
            }
          }
        });
       
     });
@if(session('admin')->can('cau_hinh_tu_dong_huy_don_hang'))
    $(document).on('click', '#d-popup-config-order', function(event) {
       event.preventDefault();
       $('#popup-order').modal('show');
     });
@endif
  </script>
@endsection