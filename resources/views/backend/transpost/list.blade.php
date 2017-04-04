@extends('backend.layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('backend/libs/jquery/nestable/jquery.nestable.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
<style type="text/css">
    @media (min-width:991px){.title_form{margin-left:10px!important;margin-top:16px}}.dd{max-width:none!important}.select2-container .select2-selection--single{height:37px}.select2-selection__arrow{height:35px!important}.select2-search__field{display:none}.select2-search--dropdown{padding:0!important}.up,.up_1{padding-top:10px}.down,.down_1{padding-bottom:10px;cursor:pointer}.select2{width:100%!important;font-size:10pt}.select2-selection__rendered{font-size:10pt!important}</style><style type="text/css">.menu_edit{display:inline-block;float:right;margin-right:18px}.menu_edit i{font-size:13pt!important}.menu_name{display:inline-block}.d-block9,.m-money:hover .m-tooltip{display:block}.dd-content:hover .change_pos{visibility:visible}.change_pos{width:30px;position:absolute;right:-18px;top:0;visibility:hidden}.change_pos>div{line-height:10px}.change_pos i{font-size:24px!important}.change_pos .material-icons{line-height:0;height:10px}.up{cursor:pointer}.up_1{cursor:pointer}.d-style{width:520px!important;margin:150px auto}.d-style2{width:360px!important;margin:150px auto}.noselect{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.m-money{position:relative}.dd-1,.m-tooltip{display:none}.m-money .m-tooltip{position:absolute;width:auto;border:1px solid #E7E7E7;padding-top:2px;padding-left:10px;padding-right:10px;border-bottom:0;font-family:Roboto;font-size:10pt;z-index:9999;background-color:#000;color:#fff;border-radius:6px;top:40px}.m-money .m-tooltip:after{content:"";position:absolute;bottom:100%;left:50%;margin-left:-5px;border-width:5px;border-style:solid;border-color:transparent transparent #000}.d-selet{border:none;color:#a6a6a6;cursor:pointer;font-size:8pt}.d-selet:hover{background-color:#E7E7E7;border-radius:3px}.thiet-lap{margin-left:0;font-size:14pt;font-family:'Roboto Black';color:rgba(0,0,0,.87)}.thiet-lap:hover{color:#738CEC}.ui-check>i:before{left:5px;top:5px;width:6px;height:6px;background-color:#ccc}.modal-title{font-size:10.5pt;font-family:'Roboto Bold'}.modal-header{height:auto;padding-top:14px;padding-bottom:12px}.modal-header .modal-title{line-height:normal}@media (min-width:544px){.modal-dialog{width:450px}}.d-danhmuc .d-content-footer-btn{float:right;background-color:#92D050;color:#fff;padding-top:6px;padding-bottom:6px;width:80px;border:none;margin-top:15px}.phi-van-chuyen table{width:100%}.phi-van-chuyen table tr th{padding-top:5px;padding-bottom:5px;width:30%}.phi-van-chuyen table tr td{padding-top:7px;padding-bottom:7px}.phi-van-chuyen table tr td input,.phi-van-chuyen-max input{height:35px;padding:10px;margin-right:15px;text-align:center;background-color:transparent!important}.phi-van-chuyen table tr th:last-child{width:40%}.phi-van-chuyen table tr td input{width:85px}.phi-van-chuyen table tr td:last-child input{width:85px}.phi-van-chuyen-max input{width:70px;border:none;border-bottom:solid 1px #E7E7E7!important}.phi-van-chuyen-max{border-top:solid 1px #EDEFF0;margin-top:10px;padding-top:15px}.phi-van-chuyen-max p:first-child input{margin-left:10px;margin-right:10px}.delete td #d_delete{ visibility:hidden; }.delete:last-child:hover td #d_delete {visibility: visible;transition: width 0.5s;}.delete2 td #d_delete2{ visibility:hidden; }.delete2:last-child:hover td #d_delete2 {visibility: visible;transition: width 0.5s;}
</style>
@endsection
@section('content')
<div class="app-header white box-shadow">
    <div class="navbar">
        <div style="float:left;" class="title_form">
            <a style="cursor:pointer;" class="thiet-lap">+ Thiết lập</a>
        </div>
        <div id="error" class="col-sm-12" style="background-color:#F2DEDE;padding:20px 0px 20px 17px;margin:15px 0px;border:1px solid #EBCCCC;border-radius:3px;display:none;"></div>
        
    </div>
</div>
<div ui-view class="app-body" id="view">
    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="row  masonry-container" >
            <?php $list_transpost = App\Province::orderby('type', 'asc')->orderby('name', 'asc')->get(); ?>
            @foreach($list_transpost as $v0)
            <div class="col-sm-6 item" style="margin-bottom:20px">
                <div  class="dd">
                    <ol class="dd-list dd-list-handle root_ol">
                        <li class="dd-item" data-id="{{$v0->id}}">
                            <div class="dd-content box" style="@if($v0->price == 1)background-color: rgba(255, 255, 255, 0.4);@endif">
                                <div>
                                    <a id="d-block"  data-id="{!! $v0->id !!}" style="margin-right:8px;font-size:10pt;font-weight:Roboto Bold;cursor:pointer;">+</a>
                                    <div class="menu_name">{{$v0->name}}</div>
                                    <div class="menu_edit d-abcdf_{!! $v0->id !!} d_block" >
                                      <label class="ui-check m-a-0 " >
                                        <input type="checkbox"  class="has-value  province d_check" data-id="{!! $v0->id !!}" >
                                        <i class="dark-white " ></i>
                                      </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                    <!-- //quận huyên -->
                    <?php $lis_district = App\District::where('provinceid',$v0->id)->orderBy('type','asc')->orderBy('name','asc')->get(); ?>
                    <div id="d-config_{!! $v0->id !!}">
                        @foreach($lis_district as $v1)
                        <ol class="dd-list dd-list-handle child_ol province_{!! $v0->id !!}" style="display:none;margin-left:40px;" >
                            <li class="dd-item" data-id="">
                                <div class="dd-content box" style="@if($v1->price == 1)background-color: rgba(255, 255, 255, 0.4);@endif">
                                    <div>
                                        <div class="menu_name">{!! $v1->name !!}</div>
                                        <div class="menu_edit">
                                            <div  style="float:left;">
                                              <label for="">
                                                <a id="d_xem" data-type="{!! $v1->type !!}" data-name="{!! $v1->name !!}" data-id="{!! $v1->id !!}" style="font-size:9pt;cursor:pointer;">Xem</a>
                                              </label>
                                              <label class="ui-check m-a-0">
                                                <input type="checkbox" class="has-value d_checked_{!! $v0->id !!} district " data-id="{!! $v1->id !!}">
                                                <i class="dark-white"></i>
                                              </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach   
        </div>
    </div>
</div>
</div>

<!-- Popup //////////////////////////////////////// -->
    <div id="popup-quantri-themdanhmuc" class="modal fade animate in" data-backdrop="true" >
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                  <form action="" method="post" id="d_sm_province">
                    <input type="hidden" name="province" value="" id="d_province">
                      <div class="modal-header" >
                          <table>
                              <tbody>
                                  <tr>
                                      <td style="width: 100%;">
                                          <h5 class="modal-title">Tạo phí vận chuyển</h5>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <div class="modal-body p-lg d-danhmuc phi-van-chuyen">
                        <table>
                          <tr>
                            <th>Từ</th>
                            <th>Đến</th>
                            <th>Giá</th>
                          </tr>
                          <tr>
                            <td><input type="text" name="min[]" value="0" autocomplete="off" disabled="" style="cursor: not-allowed;">gr</td>
                            <td><input type="text" name="max[]" id="d_keyup2" autocomplete="off">gr</td>
                            <td><input type="text" name="price[]" autocomplete="off">vnđ</td>

                          </tr>
                        </table>
                        <a style="padding: 0 4px 3px 4px;margin-top: 10px;display: block;" class="add-khoang-gia">
                          <i class="material-icons" style="vertical-align: -3.5px;"></i> Thêm khoảng giá
                        </a>
                        <div id="abc" style="background-color:red;padding:50px 100px;display:none;">abc</div>
                        <div class="phi-van-chuyen-max">
                          <p style="font-family: 'Roboto Bold'">Từ <span id="d_kg"></span> trở đi</p>
                          <p>Cộng thêm <input type="text" name="init_price" autocomplete="off"> vnđ khi thêm <input type="text" name="init_weigh" autocomplete="off"> gr</p>
                        </div>
                        <div>
                            <p id="d_errors" style="margin-bottom:0px !important;color: #A94442;font-family: Roboto bold;display:none;"></p>
                            <button class="d-content-footer-btn">Lưu</button>
                            <div class="clearfix"></div>
                        </div>
                      </div>
                  </form>
            </div>
        </div>
    </div>
<!-- End of popup ///////////////////////////////// -->
<!-- Popup Xem //////////////////////////////////////// -->
    <div id="popup-quantri-xem" class="modal fade animate in" data-backdrop="true" >
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                    <div id="d_load">
                      
                    </div>
            </div>
        </div>
    </div>
<!-- End of popup ///////////////////////////////// -->
<!-- Popup distic //////////////////////////////////////// -->
    <div id="popup-quantri-themdanhmuc2" class="modal fade animate in" data-backdrop="true" >
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                  <form action="" method="post" id="d_sm_distric">
                    <input type="hidden" name="district" value="" id="district">
                      <div class="modal-header">
                          <table>
                              <tbody>
                                  <tr>
                                      <td style="width: 100%;">
                                          <h5 class="modal-title">Tạo phí vận chuyển</h5>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <div class="modal-body p-lg d-danhmuc phi-van-chuyen">
                        <table>
                          <tr>
                            <th>Từ</th>
                            <th>Đến</th>
                            <th>Giá</th>
                          </tr>
                          <tr>
                            <td><input type="text" name="min2[]" value="0" autocomplete="off" disabled=""  style="cursor: not-allowed;">gr</td>
                            <td><input type="text" name="max2[]" id="d_keyup" autocomplete="off">gr</td>
                            <td><input type="text" name="price2[]" autocomplete="off">vnđ</td>

                          </tr>
                        </table>
                        <a style="padding: 0 4px 3px 4px;margin-top: 10px;display: block;" class="add-khoang-gia-district">
                          <i class="material-icons" style="vertical-align: -3.5px;"></i> Thêm khoảng giá
                        </a>
                        <div class="phi-van-chuyen-max">
                          <p style="font-family: 'Roboto Bold'">Từ <span id="d_kg2"></span> trở đi</p>
                          <p>Cộng thêm <input type="text" name="init_price2" autocomplete="off"> vnđ khi thêm <input type="text" name="init_weigh2" autocomplete="off"> gr</p>
                        </div>
                        <div>
                            <p id="d_errors2" style="margin-bottom:0px !important;color: #A94442;font-family: Roboto bold;display:none;"></p>
                            <button class="d-content-footer-btn">Lưu</button>
                            <div class="clearfix"></div>
                        </div>
                      </div>
                  </form>
            </div>
        </div>
    </div>
<!-- End of popup ///////////////////////////////// -->
<div id="popup-flase-district" class="modal fade  in" data-backdrop="true" style="display: none; padding-left: 17px;">
   <div class="modal-dialog"  style="width: 300px;margin-top: 150px;">
       <div class="modal-content">
           <div class="modal-header">
               <table>
                   <tbody>
                       <tr>
                           <td style="width: 70%;">
                               <h5 class="modal-title name">Phí : </h5>
                           </td>
                       </tr>
                   </tbody>
               </table>
           </div>
           <div class="modal-body p-lg" id="d-edit-label" style="padding: 15px;">
              <p>Quận huyện này hiện tại chưa được đặt phí</p>
              <div id="d_click_den" style="text-align:center;padding:4px 10px;background-color:#009A5F;color:#FFFFFF;font-size:15px;font-family:Roboto ;cursor:pointer;">Đi đến đặt phí</div>
              <div class="clearfix"></div>
            </div>
       </div>
       <!-- /.modal-content -->
   </div>
</div>

@endsection
@section('js-footer')
<script src="{{ asset('backend/libs/jquery/nestable/jquery.nestable.js') }}"></script>
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
<script src="http://biostall.com/wp-content/uploads/2010/07/jquery-swapsies.js"></script>
<script>

spam = 0;
      $(document).on('click','#d_xem',function(e){
        e.preventDefault();
        $('#d_load').html("");
        id = $(this).data('id');
        name = $(this).data('name');
        type = $(this).data('type');
          $.ajax({
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          type:"post",
          url:"{{route('ajax.xem')}}",
          data:{'id':id},
          success:function(data){
            if(data.status == true){
              $('#popup-quantri-xem').modal('show');
              $('#d_load').html(data.html);
            }else{
              $('#popup-flase-district').modal('show');
              $('.name').text("Phí "+type+" : "+name);
              $(document).on('click','#d_click_den',function(){
                $('#popup-flase-district').modal('hide');
                $('#popup-quantri-themdanhmuc2').modal('show');
                $('#district').attr('value', id);
                $(document).on('submit', '#d_sm_distric', function(event) {
                  event.preventDefault();
                  if(spam == 0){
                    spam++;
                    var form = $('#d_sm_distric')[0];
                    var formData = new FormData(form);
                    $.ajax({
                      headers: {
                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                          },
                      type:"post",
                      url:"{{route('ajax.sm.district')}}",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success:function(data){
                        spam = 0;
                        if(data.status == true){
                          $('#popup-quantri-themdanhmuc2').modal('hide');
                          window.location.reload();
                        }else{
                          if(data.not == 1){
                            $('#d_errors2').css('display','block').text(data.message).delay(3000).slideUp();
                          }
                          if(data.not == 2){
                            $('#d_errors2').css('display','block').text(data.message).delay(3000).slideUp();
                          }
                          if(data.not == 3){
                            $('#d_errors2').css('display','block').text(data.message).delay(3000).slideUp();
                          }

                        }
                      },
                      dataType:"json"
                    });
                  }
                  spam = 1;
                });
              });
            }
          },
          cache:false,
          dataType: 'json'
        });
      });


      list2 = [];
      $(document).on('change','.district',function(){
        $(this).toggleClass('b');
        p2 = $('.b');
        l2 = [];
        $.each(p2,function(i, v) {
          id = $(this).data('id');
          l2.push(id);
        });
        list2 = l2;
        console.log(list2);
      });
      ////////////////////////////////////////
      list = [];
      $(document).on('change','.province',function(){
        $(this).toggleClass('a');
        p = $('.a');
        l = [];
        $.each(p,function(i, v) {
          id = $(this).data('id');
          l.push(id);
        });
        list = l;
        console.log(list);
      });

      $(document).on('click','.thiet-lap',function(e){
            e.preventDefault();
            if(list.length > 0 || list2.length > 0 ){
              if(list.length > 0 ){
              $('.delete').remove();  
              $('#popup-quantri-themdanhmuc input:enabled').val('');  
              $('#d_kg').text('');  
              // console.log($("#copy").html());
              // $('#popup-quantri-themdanhmuc').html($("#copy").html());
              $('#popup-quantri-themdanhmuc').modal('show');
              $('#d_province').attr('value', list);
              $(document).on('submit', '#d_sm_province', function(event) {
                event.preventDefault();
                if(spam == 0){
                  spam++;
                  var form = $('#d_sm_province')[0];
                  var formData = new FormData(form);
                  $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    type:"post",
                    url:"{{route('ajax.sm.province')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function(data){
                      spam = 0;
                      if(data.status == true){
                          $('#popup-quantri-themdanhmuc').modal('hide');
                          window.location.reload();
                        }else{
                          if(data.not == 1){
                            $('#d_errors').css('display','block').text(data.message).delay(3000).slideUp();
                          }
                          if(data.not == 2){
                            $('#d_errors').css('display','block').text(data.message).delay(3000).slideUp();
                          }
                          if(data.not == 3){
                            $('#d_errors').css('display','block').text(data.message).delay(3000).slideUp();
                          }
                        }
                    },
                    dataType:"json"
                  });
                }
                spam = 1;
              });

            }

              if(list2.length > 0 ){
                $('.delete2').remove();  
                $('#popup-quantri-themdanhmuc2 input:enabled').val('');  
                $('#d_kg2').text('');
                $('#popup-quantri-themdanhmuc2').modal('show');
                $('#district').attr('value', list2);
                $(document).on('submit', '#d_sm_distric', function(event) {
                  event.preventDefault();
                  if(spam == 0){
                    spam++;
                    var form = $('#d_sm_distric')[0];
                    var formData = new FormData(form);
                    $.ajax({
                      headers: {
                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                          },
                      type:"post",
                      url:"{{route('ajax.sm.district')}}",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success:function(data){
                        spam = 0;
                        if(data.status == true){
                          $('#popup-quantri-themdanhmuc2').modal('hide');
                          window.location.reload();
                        }else{
                          if(data.not == 1){
                            $('#d_errors2').css('display','block').text(data.message).delay(3000).slideUp();
                          }
                          if(data.not == 2){
                            $('#d_errors2').css('display','block').text(data.message).delay(3000).slideUp();
                          }
                          if(data.not == 3){
                            $('#d_errors2').css('display','block').text(data.message).delay(3000).slideUp();
                          }

                        }
                      },
                      dataType:"json"
                    });
                  }
                  spam = 1;
                });

              }
            }else{
              span = '<span style="color:#B84855!important"><span style="color:#A94442!important">Error:</span> Chưa có vị trí thiết lập </span>';
                $('#error').css('display','block').html(span).delay(500).slideUp();
          }
        });

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
    
      $(document).on('click','#d-block',function(){
        id = $(this).data('id');
        container = $(this);
        $(".province_"+id).addClass("adksj");
        if( $(".province_"+id).css("display") == "none"){
            $(".province_"+id).css("display","block");
            $(".d_block").parent().find('div:eq(1)').css("display",'none');
            $(container).text("-");
            list=[];
            $('.d_check').attr('checked', false);
            console.log(list);
        }else{
            $(".province_"+id).css("display","none");
            $(".d_block").parent().find('div:eq(1)').css("display",'block');
            list2=[];
            $('.d_checked_'+id).attr('checked', false);
            console.log(list2);
            $(container).text("+");
        }
        load_masonry();
      });
    
      $('.dd').nestable({ /* config options */ });
    
      $('.dd').on('change', function() {
          //console.log($(this).nestable('serialize'));
          //var data = ;
          var datastring = JSON.stringify($(this).nestable('serialize'));
      });
      function load_masonry(){
        var $container = $('.masonry-container');
        $container.masonry({
        columnWidth: '.item',
        itemSelector: '.item'
        });   
      }
      load_masonry();
       function xacnhanxoa(msg){
        if(window.confirm(msg)){
          return true;
        }
        else
          return false;
       };
       $(document).on('click','.dd-item > button',function(){
          setTimeout(function(){
            load_masonry();  
          },100);
       });
       
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
    $(document).on('click','.add-khoang-gia',function() {
      val2 = $(this).prev().children().find('tr:last').children().next().find('input:first').val();
      $('.phi-van-chuyen table').append('<tr class="delete"><td><input type="text" name="min[]" value="'+val2+'" disabled style="cursor: not-allowed;" autocomplete="off" >gr</td><td><input type="text" name="max[]" id="d_keyup2" autocomplete="off">gr</td><td><input type="text" name="price[]" autocomplete="off">vnđ<a id="d_delete" style="font-size: 18px;margin-left: 18px;display: inline-block;position: relative;top: 3px;color: #A6A6A6;">×</a></td></tr>');
    });
    $(document).on('click','.add-khoang-gia-district',function() {
      
      val = $(this).prev().children().find('tr:last').children().next().find('input:first').val();
      $('.phi-van-chuyen table').append('<tr class="delete2"><td><input type="text" name="min2[]" value="'+val+'" disabled style="cursor: not-allowed;" autocomplete="off" >gr</td><td><input type="text" name="max2[]" id="d_keyup" autocomplete="off">gr</td><td><input type="text" name="price2[]" autocomplete="off">vnđ<a id="d_delete2"  style="font-size: 18px;margin-left: 18px;display: inline-block;position: relative;top: 2px;color: #A6A6A6;">×</a></td></tr>'); 
    });

    $(document).on('keyup','#d_keyup2',function() {
      /* Act on the event */
      val2 = $(this).val();
      $(this).parent().parent().next().find('td:first').find('input:first').attr('value',val2);
      kg ='<sup>gr</sup>';
      $('#d_kg').html(val2+kg);
      // alert("123");
    });

    $(document).on('keyup','#d_keyup',function() {
      /* Act on the event */
      val = $(this).val();
      $(this).parent().parent().next().find('td:first').find('input:first').attr('value',val);
      kg ='<sup>gr</sup>';
      $('#d_kg2').html(val+kg);
      // alert("123");
    });

    $(document).on('click','#d_delete2',function(e){
      e.preventDefault();
      v2 = $(this).parent().prev().prev().find('input:first').val();
      kg ='<sup>gr</sup>';
      $('#d_kg2').html(v2+kg);
      $(this).parent().parent().remove();
    });
    $(document).on('click','#d_delete',function(e){
      e.preventDefault();
      v = $(this).parent().prev().prev().find('input:first').val();
      kg ='<sup>gr</sup>';
      $('#d_kg').html(v+kg);
      $(this).parent().parent().remove();
    });
</script>
@endsection