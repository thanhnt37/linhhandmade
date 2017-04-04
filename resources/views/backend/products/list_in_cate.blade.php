@extends('backend.layouts.default')
@section('content')
<style>
      .modal-body .email-tb input,.modal-body .so-sp input,textarea{height:38px;padding-left:10px;padding-right:10px;background-color:#F0F0F0}.material-icons,.nav-item span{cursor:pointer}body{font-family:Roboto!important}.modal-body .so-sp input,textarea{width:48%;font-size:10pt!important;border:1px solid #E7E7E7!important}.modal-body .email-tb input,.modal-body .nd-email textarea{width:100%;font-size:10pt!important;border:1px solid #E7E7E7!important}.modal-body .so-sp input:first-child{float:right}.modal-body .nd-email textarea{height:100px;padding:10px}.modal-content{border-radius:0}.modal-header{height:45px;padding:0 15px}.modal-header .modal-title{font-size:10.5pt;font-family:'Roboto Bold';line-height:45px}.modal-body p,.modal-body tr td,.modal-body tr th,.modal-header button{font-family:Roboto}.modal-header button{background-color:#92D050;color:#fff;font-size:10pt;padding-top:5px;padding-bottom:5px;width:70px;border:none}.modal-body p{font-size:10pt}.email-tb,.so-sp{margin-bottom:16px}.modal-body .so-sp input{width:100%;height:38px;font-size:10pt!important;border:1px solid #E7E7E7!important;padding-left:10px;padding-right:10px}.modal-body .email-tb table{border:1px solid #E7E7E7;width:100%}.modal-body .email-tb table ul li{list-style-type:none;float:left}.modal-body tr td,.modal-body tr th{width:50%;padding-left:15px;font-size:10pt}.modal-body tr th{padding-top:13px;padding-bottom:5px;font-family:'Roboto Bold'}.modal-body tr td{padding-bottom:3px}.modal-body tr:last-child td{width:100%;padding:0;text-align:center}.modal-body tr:last-child td ul li a{border-radius:0}.pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,.pagination>.disabled>span:focus,.pagination>.disabled>span:hover{padding:5px 10px;cursor:pointer}.pagination{margin:15px 0}.label-info{background-color:#5bc0de}.bootstrap-tagsinput,.select2-selection,input,textarea{background-color:#F0F0F0!important}.bootstrap-tagsinput{width:100%}.bootstrap-tagsinput input{min-height:2rem}.label{font-size:96%}.select2-results__option,input,select,textarea{font-size:10pt!important}input,textarea{border:1px solid #E7E7E7!important}.select2-results__option{padding-left:14px!important}.select2-dropdown{border-radius:0!important;border-bottom:1px solid #E7E7E7!important;border-top:1px solid #E7E7E7!important;border-left:1px solid #E7E7E7!important;border-right:1px solid #E7E7E7!important}.select2-selection{color:#D1F5F1;border-radius:0!important;border:1px solid #E7E7E7!important}.select2-selection__choice{font-size:10pt!important;background-color:#0CC2AA!important;border:1px solid #0CC2AA!important;color:#D1F5F1!important}.select2-search__field{background-color:#F0F0F0!important;border:none!important}.select2-selection__choice__remove{color:#D1F5F1!important}.select2-selection__rendered{padding-top:5px!important;padding-bottom:5px!important;padding-left:13px!important;border-radius:0!important}.select2-results__option--highlighted{background-color:#F0F0F0!important;color:#404040!important}.select2-selection__clear{color:#BFBFBF!important}.select2-search__field::-webkit-input-placeholder{color:#404040}.select2-search__field::-moz-placeholder{color:#404040}.select2-search__field:-ms-input-placeholder{color:#404040}.select2-search__field:-moz-placeholder{color:#404040}.nav-item a,label{color:#A6A6A6}label{font-size:10pt}.nav-item a{background-color:#F2F2F2;margin-right:10px}.box-header{border-bottom:1px solid #E7E7E7}.note-toolbar{background-color:#fff;padding:0!important}.dropdown-toggle::after,.note-popover{display:none}.p-a-sm{box-shadow:none!important;padding:0!important}.note-editable{padding-right:0!important;padding-left:0!important}.title_form{margin-top:16px;font-size:14pt}.dd-content{padding-top:15px!important;padding-bottom:15px!important}.dd-item>button{height:41px!important}.cate_name,.menu_name{font-size:10.5pt}.alert,.nav-item a,.note-editable{font-size:10pt}.cate_edit a,.menu_edit a{background-color:#E7E7E7;padding:4px 12px;border-radius:3px;color:#A6A6A6}label[for=file_img_preview]{line-height:1.3}label[for=file_img_preview] a{padding-top:4px!important;padding-bottom:4px!important;min-width:120px}.title_form p{font-family:'Roboto Black'}.nav-link{padding-right:3px}.nav-item span{padding-left:8px}h2{font-family:Roboto-Bold;font-size:10.5pt!important}@media (min-width:991px){.title_form{margin-left:10px!important;margin-top:16px}}.number-post{width:80px;height:44px;background-color:#fff;border:1px solid #E7E7E7;float:left;color:#404040;font-size:10pt}.drop-cate,.drop-cate:hover{background-color:rgba(1,1,1,0)!important;box-shadow:none!important}.dropdown-item,td,th{font-size:10pt!important}#filter{float:left}.box-body{position:relative}.drop-cate{position:absolute;left:calc(100% - 150px);top:28px;width:20px!important;height:20px!important;padding:7px!important}.dropdown-menu{left:16px!important;top:58px!important;width:calc(100% - 132px);padding-top:0!important;padding-bottom:0!important;border-top:0!important;border-top-left-radius:0!important;border-top-right-radius:0!important}.dropdown-item{padding-top:10px!important;padding-bottom:10px!important}.dropdown-toggle::after{margin-left:-1px!important;display:inline-block;width:0;height:0;margin-right:.25rem;vertical-align:middle;content:"";border-top:.3em solid;border-right:.3em solid transparent;border-left:.3em solid transparent;margin-top:-20px}.pagination{float:right}th{font-family:Roboto-Bold!important}.action-post a{padding:4px 10px}.comment-pagination>li>a,.pagination>li>a{padding:.4rem .75rem!important}.action-post a:hover{background-color:#bfbfbf;border-radius:2px}.footable{margin-bottom:0!important}.add_attr_tab{color:#738CEC}.comment-pagination>li{display:inline;list-style:none}.comment-pagination>li>a{position:relative;float:left;margin-left:-1px;line-height:1.5;color:#0275d8;text-decoration:none;background-color:#fff;border:1px solid #ddd}.comment-pagination>li>.active{background-color:#0CC2AA;color:#fff;border:1px solid #0CC2AA}.edit{color:orange}.edit i{font-size:15pt!important}.d-background:hover{background-color:rgba(204, 204, 204, 0.4);cursor: pointer; }
       /*phong*/
         .alert{
          font-size: 10pt !important;
          font-family: "Roboto" !important;
          }
          table.m-b-none thead th {
              border-bottom: 1px solid #eceeef;
          }
          table.m-b-none tbody tr:first-child td {
              border-top: none;
          }
          .d-dstt {
              padding: 1rem;
          }
          .d-dstt .d-dstt-row {
              margin-top: 1px;
          }
          .d-dstt .d-dstt-row .d-dstt-row-title {
              font-size: 10pt;
              font-family: 'Roboto Bold';
          }
          .d-dstt .d-dstt-row .d-dstt-row-name {
              color: rgba(0, 0, 0, 0.87);
              font-size: 10pt;
              /*background-color: #f6f6f6;*/
              padding: 4px 10px;
              margin: 0px 2.5px;
          }
          .d-dstt .d-dstt-row p span.d-dstt-row-name:nth-child(2) {
              margin-left: 15px;
          }
          .d-dstt .d-dstt-row .d-dstt-row-name .slsptt {
              color: #a6a6a6;
              /*margin-left: 2px;*/
          }
       .p-themmoi {
          margin-left:30px;
          font-size: 14pt;
          font-family: 'Roboto Black';
          color: rgba(0, 0, 0, 0.87);
        }
        .p-themmoi:hover {
          color: #738CEC;
        }
        .p-themmoi1 {
          margin-left:30px;
          font-size: 14pt;
          font-family: 'Roboto Black';
          color: rgba(0, 0, 0, 0.4);
        }
        .p-themmoi1:hover {
          color: #738CEC;
        }
        #popup-label-list .email-tb, #popup-label-list .so-sp {
          margin-bottom: 0;
        }
        #popup-label-list .modal-body {
          padding: 0;
        }
        #popup-label-list .modal-dialog {
          width: 300px;
          margin-top: 150px;
        }


</style>
 <style type="text/css">

  

</style>
<?php
   $space = "&nbsp;&nbsp;&nbsp;&nbsp;"
?>
 <?php if($cate) { 
        $pro_id = DB::table('frame_categorys')->where('cate_pro_id',$cate->id)->take(500)->get();
        $in = array();
        foreach ($pro_id as $key => $value) {
          array_push($in,$value->frame_id);
        }
        $list_san_pham  = App\Frame::wherein('frames.id',$in)->leftJoin('admins', 'frames.create_by', '=', 'admins.id')->leftJoin('admins as tbl_edit', 'frames.last_edit_by', '=', 'tbl_edit.id')->select('frames.*','admins.username as create_by_u','tbl_edit.username as last_edit_by_u')->orderby('frames.created_at','desc')->paginate(5);
      }
?>
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        @if($cate) 
          <p style="float: left;">{{$cate->name}}</p>
        @else
        @endif
    </div>
</div>
</div>
 

 <div class="app-body" id="view">
    <div class="padding">
       @include('backend.partials._messages')
      <div class="box">
       
        <div class="box-body">
        
          <form action="{!! route('search.product') !!}" method="get">
            <input id="filter" style="width:calc(100% - 100px); line-height:30px;" placeholder="Nhập tên sản phẩm hoặc mã" type="text" class="form-control input-sm inline m-r" name="name" autocomplete="off" />
          </form>
          <button class="number-post d-list1"></button>
          <div style="clear:both"></div>
        </div>
        <div class="table-responsive">
            <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
            <thead>
              <tr>
                  <th data-toggle="true">
                      Tên sản phẩm
                  </th>
                  <th>
                    Mã sản phẩm
                  </th>
                  <th>
                      Ảnh
                  </th>
                  <th>
                    Số Lượng
                  </th>
                  
                  <th>
                      Trạng thái
                  </th>
                  <th>
                      Nhãn 
                  </th>
                  <th>
                      Điểm/Vote 
                  </th>
                  <th style="padding-left:40px;">
                      Hành động
                  </th>
                  <th>Cập nhập ngày</th>
              </tr>
            </thead>
            <tbody id="list_frame">
              @foreach($list_san_pham as $key => $value)
                <tr @if($key%2 == 0) style="background-color:rgb(246,246,246)" @endif>
                   <td><a href="{{route('getProDetail',['id'=>$value->id,'slug'=>$value->slug])}}">{!! $value->name !!} </a></td>
                   <td>{!! $value->code_frame!!}</td>
                   <td style="padding:5px"><a href="{{route('getProDetail',['id'=>$value->id,'slug'=>$value->slug])}}"><img  src="{!! $value->thumb_images !!}" alt="" style="width:auto;height:37px;"></a></td>
                   
                   <td id="d-edit-so-luong" style="cursor:pointer;padding-left:38px;" data-id="{!! $value->id !!}">{!! $value->sku !!}</td>
                   <td>
                    @if($value->status == 1)
                      <span style="color:#009D17;" class="d-status">
                        <i class="material-icons " data-status="{!! $value->status !!}" data-id="{!! $value->id !!}"  style="padding-left: 17px; font-size:20px;">&#xe80b;</i>
                      </span>
                    @endif
                    @if($value->status == 0)
                      <span style="color:#404040;" class="d-status">
                          <i class="material-icons " data-status="{!! $value->status !!}" data-id="{!! $value->id !!}"  style="padding-left: 17px; font-size:20px;">&#xe62f;</i>
                      </span>
                    @endif
                   </td>
                   <td id="d-label-list" class="d-edit-true_{!! $value->id !!}" data-id="{{ $value->id }}">
                    @if($value->label == 0)
                      <span class="d-background" style="padding: 2px; border-radius: 3px;padding-left: 5px; padding-right: 5px;font-family:Roboto;">Dán</span>
                      @endif
                    @if($value->label == 1)
                      <span class="d-background" style="padding: 2px; border-radius: 3px;color: #BC0098 ;padding-left: 5px; padding-right: 5px;">New</span>
                      @endif
                      @if($value->label == 2)
                      <span class="d-background" style="padding: 2px; border-radius: 3px;padding-left: 5px; padding-right: 5px;color:#ff9900  ">Kool</span>
                      @endif
                      @if($value->label == 3)
                      <span class="d-background" style="padding: 2px; border-radius: 3px;padding-left: 5px; padding-right: 5px; color: #00B0F0;">Sale</span>
                    @endif
                   </td>
                   <td>
                     {{$value->rating}}/{{$value->number_rate}}
                   </td>
                   <td class="action-post color1" style="padding: 7px 5px 5px 5px;">
                    <a href="{!! route('frame.edit.frame',['id'=>$value->id]) !!}">
                      Sửa
                    </a>
                    <a href="#" type="submit" id="xoa-sp-f" data-id="{{$value->id}}">
                      Xóa
                    </a> 
                     <a href="{!! route('frame.create.frame',['id'=>$value->id]) !!}" style="font-size:17px; padding: 0 4px 3px 4px;"><i class="material-icons" style="vertical-align: -4px;">&#xe148;</i></a> 
                   </td>
                   <?php 
                      $start_date = new DateTime($value->updated_at);
                      $since_start = $start_date->diff(new DateTime());
                   ?>
                   <td id="321">
                    @if($since_start->m > 0)
                        <span class="time-date"><{{ $since_start->m." tháng trước"  }}  bởi /span>
                        <a href="#"  data-time="{!! $value->updated_at !!}" style="color:#738CEC">@if($value->last_edit_by_u == 0) {!! $value->create_by_u !!} @else {{$value->last_edit_by_u}} @endif</a>
                    @else
                      @if($since_start->d > 0)
                        <span class="time-date">{{ $since_start->d." ngày trước"  }}  bởi</span> 
                        <a href="#"  data-time="{!! $value->updated_at !!}" style="color:#738CEC">@if($value->last_edit_by_u == 0) {!! $value->create_by_u !!} @else {{$value->last_edit_by_u}} @endif</a>
                      @else
                          @if($since_start->h > 0)
                            <span class="time-date">{{ $since_start->h." giờ trước"  }}  bởi </span>
                            <a href="#"  data-time="{!! $value->updated_at !!}" style="color:#738CEC">@if($value->last_edit_by_u == 0) {!! $value->create_by_u !!} @else {{$value->last_edit_by_u}} @endif</a>
                          @else
                            @if($since_start->i >0)
                              <span class="time-date">{{ $since_start->i." phút trước" }} bởi </span>
                              <a href="#"  data-time="{!! $value->updated_at !!}" style="color:#738CEC">@if($value->last_edit_by_u == 0) {!! $value->create_by_u !!} @else {{$value->last_edit_by_u}} @endif</a>
                            @else
                                <span class="time-date">{!! "Vừa xong" !!} bởi</span>
                                <a href="#"  data-time="{!! $value->updated_at !!}" style="color:#738CEC">@if($value->last_edit_by_u == 0) {!! $value->create_by_u !!} @else {{$value->last_edit_by_u}} @endif</a>
                            @endif  
                          @endif    
                      @endif    
                    @endif
                   </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot class="hide-if-no-paging">
              <tr>
                  <td colspan="12" class="text-center">
                    <ul class="list-inline comment-pagination">
                      <?php $link_limit = 9; ?>
                        @for ($i = 1; $i <= $list_san_pham->lastPage(); $i++)
                          <?php
                          $half_total_links = floor($link_limit / 2);
                          $from = $list_san_pham->currentPage() - $half_total_links;
                          $to = $list_san_pham->currentPage() + $half_total_links;
                          if ($list_san_pham->currentPage() < $half_total_links) {
                             $to += $half_total_links - $list_san_pham->currentPage();
                          }
                          if ($list_san_pham->lastPage() - $list_san_pham->currentPage() < $half_total_links) {
                              $from -= $half_total_links - ($list_san_pham->lastPage() - $list_san_pham->currentPage()) - 1;
                          }
                          ?>
                          @if ($from < $i && $i < $to)
                              <li class="{{ ($list_san_pham->currentPage() == $i) ? ' active' : '' }}">
                                  <a  class="{{ ($list_san_pham->currentPage() == $i) ? ' active' : '' }}" href="{{$list_san_pham->url($i)}}" data-page={{$i}}>{{ $i }}</a>
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
<div id="m-a-a_01" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content" style="width: 430px;">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:10pt;line-height: 25px;padding-left:15px;padding-right:16px;font-family:'Roboto Bold' " id="model-h5">Sửa Số Lượng <div style="float:right;margin-right: 26px;"><a id="d-edit-luu" class="btn btn-primary "  data-dismiss="modal">Lưu</a></div></h5>
      </div>
        <div class="table-responsive">
          <table class="table b-t" style=" margin-bottom: 0px;">
            <tbody>
              <tr>
                <td style="line-height: 50px;padding-left: 31px;">
                  Số Lượng
                </td>
                <td style="padding:20px 0px;">
                  <div id="ajax-d-sku">
                    
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<div id="m-a-a_02" class="modal fade animate" data-backdrop="true">
    <div class="modal-dialog" id="animate">
      <div class="modal-content" style="width: 430px;">
        <div class="modal-header">
          <h5 class="modal-title" style="font-size:10pt;line-height: 25px;padding-left:15px;padding-right:16px;font-family:'Roboto Bold' " id="model-h5">Sửa Số Lượng <div style="float:right;margin-right: 26px;"><a id="d-edit-luu-product" class="btn btn-primary "  data-dismiss="modal">Lưu</a></div></h5>
        </div>
          <div class="table-responsive">
            <table class="table b-t" style=" margin-bottom: 0px;">
              <tbody>
                <tr>
                  <td style="line-height: 50px;padding-left: 31px;">
                    Số Lượng
                  </td>
                  <td style="padding:20px 0px;">
                    <input id="d-sku"  style="height:40px; width: 80%;padding-left:10px;" type="text" name="sku" value="" >
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
      </div><!-- /.modal-content -->
    </div>
  </div>
  {{-- popup số lượng --}}
<div id="so-luong-sp" class="modal fade animate" data-backdrop="true" >
   <div class="modal-dialog" id="animate">
       <div class="modal-content" >
            <div  id="d-html">
                  {{-- dữ liệu ajax đổ ra --}}
            </div>
       </div>
    </div>   
</div>
{{-- end popup số lượng --}}

{{-- popup config het hang --}}
  <div id="popup-quantri-config-hethang" class="modal fade animate" data-backdrop="true">
     <div class="modal-dialog" id="animate">
         <div class="modal-content">
             <div id="d-ajax-config-hethang">
               
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
 </div>
{{-- end popup config het hang --}}

<!-- popup nhãn -->
  <div id="popup-label-list" class="modal fade animate in" data-backdrop="true" style="display: none; padding-left: 17px;">
   <div class="modal-dialog" id="animate">
       <div class="modal-content">
           <div class="modal-header">
               <table>
                   <tbody>
                       <tr>
                           <td style="width: 70%;">
                               <h5 class="modal-title">Nhãn sản phẩm</h5>
                           </td>
                       </tr>
                   </tbody>
               </table>
           </div>
           <div class="modal-body p-lg" id="d-edit-label">
               
           </div>
       </div>
       <!-- /.modal-content -->
   </div>
</div>
<!-- end -->
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/footable/dist/footable.all.min.js') }}"></script>
  <script>

 $(document).ready(function(){
        x = $("#list_frame tr").length;
        $(".d-list1").text(x + " SP");
  });

  $(document).on('click','#d-label-list',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $('#popup-label-list').modal('show');
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
        url:"{{route('ajax.get.label')}}",
        data:{'id':id},
        success:function(data){
          console.log(data);
          if(data.status == true){
            $('#d-edit-label').html(data.html);
          }
        },
        cache:false,
        dataType: 'json'
      });
  });

  $(document).on('click','.d-click-choose',function(){
    container = $(this);
    label = $(this).data('label');
    id = $(this).data('id');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type:"post",
        url:"{{route('ajax.edit.label')}}",
        data:{'id':id,'label':label},
        success:function(data){
          console.log(data);
          if(data.status == true){
            $('#popup-label-list').modal('hide');
            if(data.frame.label == 0){
              content0 = '<span  style=" border-radius: 3px;color: #2E3E4E ;font-family:Roboto ;">Dán</span>';
              $('.d-edit-true_'+id).children().html(content0);
            }
            if(data.frame.label == 1){
              content1 = ' <span  style=" border-radius: 3px;color: #BC0098 ; ">New</span>';
              $('.d-edit-true_'+id).children().html(content1);
            }
            if(data.frame.label == 2){
              content2 = ' <span  style=" border-radius: 3px; color:#ff9900  ">Kool</span>';
              $('.d-edit-true_'+id).children().html(content2);
            }
            if(data.frame.label == 3){
              content3 = '<span  style=" border-radius: 3px; color: #00B0F0;">Sale</span>';
              $('.d-edit-true_'+id).children().html(content3);
            }
          }
        },
        cache:false,
        dataType: 'json'
      });
  });
  @if(session('admin')->can('them_san_pham'))
    $(document).on('click','.d-status',function(e){
    e.preventDefault();
    container = $(this);
    status = $(this).children().data('status');
    id = $(this).children().data('id');
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      type:"post",
      url:"{{route('ajax.edit.list.status')}}",
      data:{'id':id,'status':status},
      success:function(data){
        
          if(data.status == true){
            if(data.sta == 0){
              content1 = '<i class="material-icons " data-status="'+data.frame.status+'" data-id="'+data.frame.id+'"  style="padding-left: 18px; font-size:20px;">'+
              '&#xe62f;'+
              '</i>';
              container.css('color','#404040').html(content1);
            }
            if(data.sta == 1){
              content = '<i class="material-icons " data-status="'+data.frame.status+'" data-id="'+data.frame.id+'"  style="padding-left: 17px; font-size:20px;">'+
            '&#xe80b;'+
            '</i>'; 
            container.css('color','#009D17').html(content);
            }
          }
        
      },
      cache:false,
      dataType: 'json'
    });
  });
  @endif

  @if(session('admin')->can('cau_hinh_email_het_hang_san_pham'))
  $(document).on('click', '#d-popup-config-het-hang', function(event) {
    event.preventDefault();
    $('#popup-quantri-config-hethang').modal('show');
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      type:"post",
      url:"{{route('d.ajax.config.hethang')}}",
      data:{},
      success:function(data){
        if(data.status == true){
          $('#d-ajax-config-hethang').html(data.html);
        }
      },
      cache:false,
      dataType:'json'
    });

  });
  @endif
  setInterval(function(){
    x = $('.time-date');
    $.each(x,function(i,v){
          b = $(v).next().data('time');
          d  = new Date(b);
          cur_date  = new Date();
          time_minisecond  = cur_date.getTime() - d.getTime();
          s = parseInt( ( time_minisecond ) / 1000 );
          m = parseInt( ( time_minisecond ) / 1000 / 60 ) ;
          h = parseInt( ( time_minisecond ) / 1000 / 60 / 60 ) ;
          d = parseInt( ( time_minisecond ) / 1000 / 60  / 60 / 24) ;
          Mo = parseInt( ( time_minisecond ) / 1000 / 60  / 60 / 24 / 30) ;
          Y = parseInt( ( time_minisecond ) / 1000 / 60 / 60/ 24 / 30 / 12  ) ;
          if( Y > 0 ){
            // $(v).text(Y+' năm trước bởi');
          }else{
            if(Mo > 0){
              $(v).text(Mo+' tháng trước bởi');
            }else{
              if(d > 0){
                $(v).text(d+' ngày trước bởi');
              }else{
                if(h > 0){
                  $(v).text(h+' giờ trước bởi');
                }else{
                  if(m > 0){
                    $(v).text(m+' phút trước bởi');
                  }
                }
              }
            }
          }
    }); 
  },1000);
  // submit-email-hethang
  $(document).on('submit','#d-submit-config-hethang',function(e){
    e.preventDefault()
      var form = $('#d-submit-config-hethang')[0];
      var formData = new FormData(form);

      $.ajax({
        headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        type:"post",
        url:"{{route('ajax.form.email.hethang')}}",
        data: formData,
        contentType: false,
        processData: false,
        success:function(data){
          if(data.status == true){
            $("#d-submit-config-hethang")[0].reset();
            $('#popup-quantri-config-hethang').modal('hide');
            window.location.reload();
          }
        },
        dataType:"json"
      });
  });
  
  $(document).on('click','#d-edit-so-luong',function(){
    container = $(this);
    id = $(this).data('id');
    $('#so-luong-sp').modal('show');
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      type:"post",
      url:"{{route('d.edit.sku')}}",
      data:{'id':id},
      success:function(data){
        $('#d-html').html(data.html);
      },
      cache:false,
      dataType:'json'
    });
  });

  //phân trang nhap kho
  $(document).on('click','.d-paginate-ul-nhap-kho',function(e){
    e.preventDefault();
    page = $(this).data('page');
    id = $(this).data('frame');
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      type:"post",
      url:"{{route('ajax.phan.trang.nhap.kho')}}",
      data:{'id':id,'page':page},
      success:function(data){
        if(data.status==true){
          $('#d-html-email').html(data.view);
        }
      },
      cache:false,
      dataType:'json'
    });
  });

  $(document).on('submit','#d-form-nhap-kho',function(e){
    e.preventDefault();
      var form = $('#d-form-nhap-kho')[0];
      var formData = new FormData(form);

      $.ajax({
        headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        type:"post",
        url:"{{route('ajax.form.nhap.kho')}}",
        data: formData,
        contentType: false,
        processData: false,
        success:function(data){
          if(data == true){
            $("#d-form-nhap-kho")[0].reset();
            $('#so-luong-sp').modal('hide');
            window.location.reload();
          }
        },
        dataType:"json"
      });
  });


  //  jQuery(function($){
  //   $('.table').footable({
  //     "paging": {
  //       "enabled": false,
  //       "size": 70,
  //     }
  //   });
  // });
   function xacnhanxoa(msg){
      // var footable = $('.table').data('footable');
      

      if(window.confirm(msg)){
        return true;
      }
      else
        return false;

     };
     $(document).on('click','#xoa-sp', function(event){
           event.preventDefault();
           if(xacnhanxoa('Bạn có chắc muốn xóa sản phẩm này không?')===false){

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
             })
           // alert(id);
           }
                     
     });
      $(document).on('click','#xoa-sp-f', function(event){
           event.preventDefault();
           if(xacnhanxoa('Bạn có chắc muốn xóa sản phẩm này không?')===false){

           }
           else{
            id = $(this).attr('data-id');
             $.ajax({
                 type: 'post',
                 url:  '{{ route('frame.delete') }}',
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
             })
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

     $(document).on('click','#d-product-sku',function(e){
        e.preventDefault();
        id = $(this).data('id');
        sku = $(this).data('sku');
        $('#m-a-a_02').modal('show');
        $('#d-sku').attr('value',sku); 
     });
     
  </script>
@endsection