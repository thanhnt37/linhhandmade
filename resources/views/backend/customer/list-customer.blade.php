@extends('backend.layouts.default')


@section('content')
<style type="text/css">
    .note-editor .note-frame {
     /*border: 1px solid #a9a9a9 !important;*/
 }
 
 .note-editable {
     /*border: 1px solid #a9a9a9 !important;*/
 }
 
 .label-info {
     background-color: #5bc0de;
 }
 
 .bootstrap-tagsinput {
     width: 100%;
 }
 
 .bootstrap-tagsinput input {
     min-height: 2rem;
 }
 
 .label {
     font-size: 96%;
 }
 
 input {
     background-color: #F0F0F0 !important;
     font-size: 10pt !important;
     border: 1px solid #E7E7E7 !important;
 }
 
 textarea {
     background-color: #F0F0F0 !important;
     font-size: 10pt !important;
     border: 1px solid #E7E7E7 !important;
 }
 
 select {
     font-size: 10pt !important;
 }
 
 .select2-results__option {
     font-size: 10pt !important;
     padding-left: 14px !important;
 }
 
 .select2-selection__choice {
     font-size: 10pt !important;
 }
 
 .select2-dropdown {
     border-radius: 0px !important;
     border-bottom: 1px solid #E7E7E7 !important;
     border-top: 1px solid #E7E7E7 !important;
     border-left: 1px solid #E7E7E7 !important;
     border-right: 1px solid #E7E7E7 !important;
 }
 
 .bootstrap-tagsinput {
     background-color: #F0F0F0 !important;
 }
 
 .select2-selection {
     background-color: #F0F0F0 !important;
     color: #D1F5F1;
     border-radius: 0px !important;
     border: 1px solid #E7E7E7 !important;
 }
 
 .select2-selection__choice {
     background-color: #0CC2AA !important;
     border: 1px solid #0CC2AA !important;
     color: #D1F5F1 !important;
 }
 
 .select2-search__field {
     background-color: #F0F0F0 !important;
     border: none !important;
 }
 
 .select2-selection__choice__remove {
     color: #D1F5F1 !important;
 }
 
 .select2-selection__rendered {
     padding-top: 5px !important;
     padding-bottom: 5px !important;
     padding-left: 13px !important;
     border-radius: 0px !important;
 }
 
 .select2-results__option--highlighted {
     background-color: #F0F0F0 !important;
     color: #404040 !important;
 }
 
 .select2-selection__clear {
     color: #BFBFBF !important;
 }
 
 .select2-search__field::-webkit-input-placeholder {
     color: #404040;
 }
 
 .select2-search__field::-moz-placeholder {
     color: #404040;
 }
 
 .select2-search__field:-ms-input-placeholder {
     color: #404040;
 }
 
 .select2-search__field:-moz-placeholder {
     color: #404040;
 }
 
 .select2-selection__choice {
     background-color: #ffffff;
     color: #111;
 }
 
 label {
     font-size: 10pt;
     color: #A6A6A6;
 }
 
 .nav-item a {
     background-color: #F2F2F2;
     margin-right: 10px;
 }
 
 .box-header {
     border-bottom: 1px solid #E7E7E7;
 }
 
 .note-toolbar {
     background-color: #fff;
 }
 
 .dropdown-toggle::after {
     display: none;
 }
 
 .note-popover {
     display: none;
 }
 
 .p-a-sm {
     box-shadow: none !important;
     padding: 0px !important;
 }
 
 .note-toolbar {
     padding: 0px !important;
 }
 
 .note-editable {
     padding-right: 0px !important;
     padding-left: 0px !important;
 }
 
 @media (min-width: 991px) {
     .title_form {
         margin-left: 207px;
         margin-top: 16px;
     }
 }
 
 .title_form {
     margin-top: 16px;
     font-size: 14pt;
 }
 
 .dd-content {
     padding-top: 15px !important;
     padding-bottom: 15px !important;
 }
 
 .dd-item > button {
     height: 41px !important;
 }
 
 .menu_name {
     font-size: 10.5pt;
 }
 
 .cate_name {
     font-size: 10.5pt;
 }
 
 .cate_edit a {
     background-color: #E7E7E7;
     padding: 4px 12px;
     border-radius: 3px;
     color: #A6A6A6;
 }
 
 .menu_edit a {
     background-color: #E7E7E7;
     padding: 4px 12px;
     border-radius: 3px;
     color: #A6A6A6;
 }
 
 .nav-item a {
     font-size: 10pt;
     color: #A6A6A6;
 }
 
 .note-editable {
     font-size: 10pt;
 }
 
 label[for="file_img_preview"] {
     line-height: 1.3;
 }
 
 label[for="file_img_preview"] a {
     padding-top: 4px !important;
     padding-bottom: 4px !important;
     min-width: 120px;
 }
 
 .alert {
     font-size: 10pt;
 }
 
 .title_form p {
     font-family: 'Roboto Black';
 }
 
 .nav-link {
     padding-right: 3px;
 }
 
 .nav-item span {
     padding-left: 8px;
     cursor: pointer;
 }
 
 h2 {
     font-family: "Roboto-Bold";
     font-size: 10.5pt !important;
 }
 
 @media (min-width: 991px) {
     .title_form {
         margin-left: 10px !important;
         margin-top: 16px;
     }
 }
 
 .number-post {
     width: 80px;
     height: 44px;
     background-color: #fff;
     border: 1px solid #E7E7E7;
     float: left;
     color: #404040;
     font-size: 10pt;
 }
 
 #filter {
     float: left;
 }
 
 .box-body {
     position: relative;
 }
 
 .drop-cate {
     position: absolute;
     left: calc(100% - 150px);
     top: 28px;
     width: 20px !important;
     height: 20px !important;
     padding: 7px !important;
     background-color: rgba(1, 1, 1, 0) !important;
     box-shadow: none !important;
 }
 
 .drop-cate:hover {
     background-color: rgba(1, 1, 1, 0) !important;
     box-shadow: none !important;
 }
 
 .dropdown-menu {
     left: 16px !important;
     top: 58px !important;
     width: calc(100% - 132px);
     padding-top: 0px !important;
     padding-bottom: 0px !important;
     border-top: 0px !important;
     border-top-left-radius: 0px !important;
     border-top-right-radius: 0px !important;
 }
 
 .dropdown-item {
     padding-top: 10px !important;
     padding-bottom: 10px !important;
     font-size: 10pt !important;
 }
 
 .dropdown-toggle::after {
     /*display: none !important;*/
     margin-left: -1px !important;
 }
 
 .pagination {
     float: right;
 }
 
 th {
     font-size: 10pt !important;
     font-family: "Roboto-Bold" !important;
 }
 
 td {
     font-size: 10pt !important;
 }
 
 .action-post a {
     padding-left: 10px;
     padding-right: 10px;
     padding-top: 4px;
     padding-bottom: 4px;
 }
 
 .action-post a:hover {
     background-color: #bfbfbf;
     border-radius: 2px;
 }
 
 .pagination > li > a {
     padding: 0.4rem 0.75rem !important;
 }
 
 .footable {
     margin-bottom: 0px !important;
 }
 
 .dropdown-toggle::after {
     display: inline-block;
     width: 0;
     height: 0;
     margin-right: .25rem;
     margin-left: .25rem;
     vertical-align: middle;
     content: "";
     border-top: .3em solid;
     border-right: .3em solid transparent;
     border-left: .3em solid transparent;
     margin-top: -20px;
 }
 
 .material-icons {
     cursor: pointer;
 }
 
 .add_attr_tab {
     color: #738CEC;
 }
 
 #d-list-order {
     background-color: #5CB85C;
     padding: 5px 10px;
     border-radius: 2px;
     color: #fff;
     font-size: 11px;
     font-family: Roboto;
     font-weight: 600;
     cursor: pointer;
 }
 
 .modal-content {
     border-radius: 0;
 }
 
 .modal-header {
     height: 50px;
     padding: 0 15px;
 }
 
 .modal-header .modal-title {
     font-size: 10.5pt;
     font-family: 'Roboto Bold';
 }
 
 .modal-header .modal-title {
     line-height: 50px;
 }
 
 .modal-header button {
     background-color: #92D050;
     color: #fff;
     font-size: 10pt;
     padding-top: 6px;
     padding-bottom: 6px;
     width: 80px;
     border: none;
     font-family: 'Roboto';
 }
 
 .modal-body p {
     font-size: 10pt;
     font-family: 'Roboto';
 }
 
 .so-sp {
     margin-bottom: 13px;
 }
 
 .modal-body .so-sp input,
 textarea {
     width: 100%;
     height: 38px;
     font-size: 10pt !important;
     border: 1px solid #E7E7E7 !important;
     padding-left: 10px;
     padding-right: 10px;
     background-color: #F0F0F0;
 }
 
 table.so-sp {
     width: 100%;
 }
 
 table.so-sp tr {
     width: 100%;
 }
 
 .so-sp tr:first-child td {
     font-family: 'Roboto';
     width: 50%;
     font-size: 10pt;
     padding-bottom: 10px;
 }
 
 .modal-body p#click-p i {
     font-size: 12pt;
     margin-right: 3px;
     font-style: normal !important;
 }
 
 .modal-body p#click-p {
     display: inline-block;
 }
 
 .modal-body p#click-p:hover {
     cursor: pointer;
 }
 /*Click more*/
 
 .so-sp .click-more td {
     padding-top: 15px;
 }
 
 .cancel-x {
     display: none;
 }
 
 .d-toll {
     display: none;
     position: absolute;
 }
 
 .input {
     padding-bottom: 15px;
 }
 
 .input:hover .d-toll {
     display: block;
 }
 
 .d-toll > span {
     padding: 5px 10px;
     background-color: black;
     color: white;
     border-radius: 4px;
     font-size: 8pt;
     position: relative;
 }
 
 .d-toll > span::after {
     content: "";
     position: absolute;
     bottom: 100%;
     left: 50%;
     margin-left: -5px;
     border-width: 5px;
     border-style: solid;
     border-color: transparent transparent #000 transparent;
 }
 
 .d-123 {
     vertical-align: top;
     padding-top: 10px;
     padding-right: 3px;
 }
 
 .comment-pagination > li {
     display: inline;
     list-style: none;
 }
 
 .comment-pagination > li > a {
     padding: 0.4rem 0.75rem !important;
 }
 
 .comment-pagination > li > a {
     position: relative;
     float: left;
     padding: 0.5rem 0.75rem;
     margin-left: -1px;
     line-height: 1.5;
     color: #0275d8;
     text-decoration: none;
     background-color: #fff;
     border: 1px solid #ddd;
 }
 
 .comment-pagination > li > .active {
     background-color: #0CC2AA;
     color: #fff;
     border: 1px solid #0CC2AA;
 }
 
 #d_0 #d_1 {
     visibility: hidden;
 }
 
 #d_0:hover #d_1 {
     visibility: visible;
 }
</style>

<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
          <p>Danh sách khách hàng</p>
    </div>
    @if(session('admin')->can('cau_hinh_tich_diem_san_pham'))
    <div style="float:right;line-height:60px;">
       <span class="nav-icon">
          <i class="material-icons" id="d-popup-config-tich-diem" style="font-size:23px;cursor:pointer">&#xe8b8;</i>
        </span>
    </div>
    @endif
</div>
</div>
 <div class="app-body" id="view">
    <div class="padding">
      <div class="box">
       
        <div class="box-body">
         @include('backend.partials._messages')
          <!-- <input id="filter" style="width:calc(100% - 100px); line-height:30px;" placeholder="Tìm kiếm khách hàng" type="text" class="form-control input-sm inline m-r"/> -->
          <form  method="get" action="{{route('search.customer')}}" style="display: inline-block; width: 100%;">
              
              <input style="width:calc(100% - 100px); line-height:30px;" placeholder="Tìm kiếm khách hàng" type="text" class="form-control input-sm inline m-r" name="cus"/>
              <button class="number-post" style="float: right;">{!! sizeof($customer) !!} SP</button>
          </form>
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
                  <th>
                      Số điện thoại
                  </th>
                  <th>
                      Lịch sử lượt mua
                  </th>
                  <th>
                      Số lượt mua
                  </th>
                  <th>
                      Tổng Chi Tiêu 
                  </th>
                  <th>
                      % Giảm Giá 
                  </th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($customer as $key => $item) 
              <tr>
                <td>{!! $item->phone !!}</td>
                <td><a id="d-list-order" data-id="{!! $item->phone !!}">Danh Sách</a></td>
                <td>{!! $item->some_purchases !!}</td>
                <td class="action-post">{!! number_format((int)$item->points,0,'','.') !!}<sup>đ</sup> </td>
                <?php 
                  $list = App\Configure_discounts::orderby('targets','asc')->get();
                  $some = 0;
                ?>
                  @foreach ($list as $key => $value)
                  <?php 
                    if( (int)$value->targets <= (int)$item->points){
                        $some =  $value->percent;
                    }else{
                        break;
                    }
                  ?>
                  @endforeach 
                  <td>
                      {!! $some !!} %
                  </td>
              </tr> 
            @endforeach
            </tbody>
            <tfoot class="hide-if-no-paging">
              <tr>
                  <td colspan="12" class="text-center">
                   <ul class="list-inline comment-pagination">
                            <?php $link_limit = 9; ?>
                              @for ($i = 1; $i <= $customer->lastPage(); $i++)
                                        <?php
                                        $half_total_links = floor($link_limit / 2);
                                        $from = $customer->currentPage() - $half_total_links;
                                        $to = $customer->currentPage() + $half_total_links;
                                        if ($customer->currentPage() < $half_total_links) {
                                           $to += $half_total_links - $customer->currentPage();
                                        }
                                        if ($customer->lastPage() - $customer->currentPage() < $half_total_links) {
                                            $from -= $half_total_links - ($customer->lastPage() - $customer->currentPage()) - 1;
                                        }
                                        ?>
                                        @if ($from < $i && $i < $to)
                                            <li class="{{ ($customer->currentPage() == $i) ? ' active' : '' }}">
                                                <a  class="{{ ($customer->currentPage() == $i) ? ' active' : '' }}" href="{{$customer->url($i)}}" data-page={{$i}}>{{ $i }}</a>
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

<div id="m-a-tab" class="modal fade animate" data-backdrop="true" style="border:0px;">
    <div class="modal-dialog" id="animate">
      <div class="modal-content" style="    padding-bottom: 16px;top: 80px;">
        <div class="modal-header">
          <h5 class="modal-title">Lịch sử mua hàng</h5>
        </div>
        <div class="modal-body p-lg" style="padding-bottom:0px !important;">
              <div class="table-responsive">
                <div class="col-sm-12 item" style="padding:0px">
                <div class="box-body" style="background-color:#FFFFFF;padding:0px !important;" >
                    <div class="table-responsive">
                      <table class="table table-striped b-t" style="margin-bottom:0px;">
                        <tbody id="l-box1">
                          {{-- ajax gửi về đây --}}
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
  {{-- popup --}}
    <div id="popup-quantri-config-tich-diem" class="modal fade animate" data-backdrop="true">
       <div class="modal-dialog" id="animate">
           <div class="modal-content">
               <form method="post" id="d-popup-config-tichdiem">
                   <div class="modal-header">
                     <table>
                         <tr>
                             <td style="width: 98%;"><h5 class="modal-title">Cấu hình giảm giá</h5></td>
                             <td><button>Lưu</button></td>
                         </tr>
                     </table>
                 </div>
                 <div class="modal-body p-lg">
                     <table class="so-sp d-ajax-list">
                         

                     </table>
                     <p id="click-p"><i>+</i> Thêm mức giảm giá</p> 
                 </div>
               </form>
           </div>
           <!-- /.modal-content -->
       </div>
   </div>
  {{--end popup --}}
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/footable/dist/footable.all.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
  $(document).on('click','#d-popup-config-tich-diem',function(e){
    e.preventDefault();
    $('#popup-quantri-config-tich-diem').modal('show');
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      type:"post",
      url:"{{route('ajax.list.config.discounts')}}",
      data:{},
      success:function(data){
        if(data.status == true){
          $('.d-ajax-list').html(data.html);
        }
      },
      cache:false,
      dataType: 'json'
    });
  });

  $(document).on('submit','#d-popup-config-tichdiem',function(e){
      e.preventDefault();
      var form = $('#d-popup-config-tichdiem')[0];
      var formData = new FormData(form);

      $.ajax({
        headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        type:"post",
        url:"{{route('ajax.config.tichdiem')}}",
        data: formData,
        contentType: false,
        processData: false,
        success:function(data){
          if(data.status == true){
            $('#popup-quantri-config-tich-diem').modal('hide');
          }
          if(data.status == false && data.all == 1){
            $('#d-1').css('display','block');
          }
          if(data.status == false && data.tp == 1){
            $('#d-2').css('display','block');
          }
          if(data.status == false && data.not == 2){
            $('#d-2').css('display','block');
          }
          if(data.status == false && data.not == 1){
            $('#d-1').css('display','block');
          }
        },
        dataType:"json"
      });
    });

   $(document).on('click','#click-p',function(e) {
       $("#notify_tr").before('<tr id="d_0">'+
         '<td colspan="2">'+
             '<div class="input" style="width: 50%;float:left; padding-right:10px;">'+
             '<input type="text" name="chi_tieu[]">'+
                '<div class="d-toll">'+
                '<span class="price">'+
                '</span>'+
                '</div>'+
             '</div>'+
             '<div class="input" style="width: 50%;float:left;padding-left:10px;">'+
                '<input type="text" name="giam_gia[]" >'+
                '<div class="d-toll">'+
                '<span class="pt">'+
                '</span>'+
                '</div>'+
             '</div>'+
             '<div style="clear:both;"></div>'+
         '</td>'+
         '<td class="d-123">'+
                '<a href="javascript:void(0);" style="float:right;font-size: 17px;color: '+
                '#e60d09;font-weight: 700;" id="d_1" name="del" class="cancel-tr add-0">'+
                 '×'+
             '</a>'+
         '</td>'+
     '</tr>');
   });
</script>
<script>

   jQuery(function($){
  $('.table').footable({
    "paging": {
      "enabled": true,
      "size": 7,
    }
  });
});
   function xacnhanxoa(msg){
      var footable = $('.table').data('footable');
      

      if(window.confirm(msg)){
        return true;
      }
      else
        return false;

     };
   $(document).on('click','.cancel-tr',function(e) {
      container = $(this);
      if($(this).hasClass('add-0')){
        $(this).parent().parent().remove();
        return false;
      }
      if(xacnhanxoa('Bạn có chắc xóa cấu hình hiện tại hay không?')===false){

        }
        else{
          id = $(this).data('value');
          $.ajax({
             type: 'post',
             url:  '{{ route('config.giamgia.del') }}',
             data: {'id':id},
             dataType:'json',
             success: function(msg){
                if(msg.status == true){
                      $(container).parent().parent().remove();
                    }
                    else{
                      alert('có lỗi xảy ra');
                    }
             }
         });
    }
   });

   $(document).on('mouseenter ','.input input',function(){
        value = $(this).val();
        if(!value){
          $(this).next().children(".price").text("Chưa nhập chi tiêu");
        }else{
          value = parseInt(value);
          value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
           $(this).next().children(".price").text(value+" đ");
        }
       });
   $(document).on('keyup','.input input',function(){
    value = $(this).val();
    if(!value){
      $(this).next().children(".price").text("Chưa nhập chi tiêu");
    }else{
      value = parseInt(value);
      value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
       $(this).next().children(".price").text(value+" đ");
    }
   });
   $(document).on('mouseenter ','.input input',function(){
        value = $(this).val();
        if(!value){
          $(this).next().children('.pt').text("Chưa nhập % ");
        }else{
          value = parseFloat(value);
          value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
           $(this).next().children('.pt').text(value+"%");
        }
       });
   $(document).on('keyup ','.input input',function(){
        value = $(this).val();
        if(!value){
          $(this).next().children('.pt').text("Chưa nhập % ");
        }else{
          value = parseFloat(value);
          value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
           $(this).next().children('.pt').text(value+"%");
        }
       });
</script>
  <script>
  

     $(document).on('click','#xoa-sp', function(event){
           event.preventDefault();
           if(xacnhanxoa('Bạn có chắc xóa bài viết hiện tại hay không?')===false){

           }
           else{
            id = $(this).attr('data-id');
             $.ajax({
                 type: 'post',
                 url:  '{{ route('products.del') }}',
                 data: {'id': id},
                 dataType:'json',
                 success: function(msg){
                   console.log(msg);
                    if(msg == true){
                      console.log(msg);
                      location.reload();
                    }
                    else{
                      alert('có lỗi xảy ra');
                    }
                 }
             });
           // alert(id);
           }
                     
     });
     
     $(document).ready(function(){
        // $('a[data-page="first"]').text('Đầu tiên');
        $('a[data-page="first"]').remove();
        $('a[data-page="prev"]').text('Trước');
        $('a[data-page="next"]').text('Tiếp');
        // $('a[data-page="last"]').text('Cuối cùng');
        $('a[data-page="last"]').remove();
     });


     $(document).on('click','#d-list-order',function(e){
        e.preventDefault();
        phone = $(this).data('id');
        $('#m-a-tab').modal('show');
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
        url:"{{route('ajax.list.customer.order')}}",
        data:{'phone':phone},
        success:function(data){
          console.log(data);
          $('#l-box1').html(data.html);
        },
        cache:false,
        dataType: 'json'
      });
     });
     
  </script>
@endsection