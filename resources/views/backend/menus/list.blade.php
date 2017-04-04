@extends('backend.layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('backend/libs/jquery/nestable/jquery.nestable.css') }}" type="text/css" />
       <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
      <style type="text/css">
       @media (min-width: 991px){
        .title_form{
            margin-left: 10px !important;
            margin-top: 16px;
        }
       
      }
       .dd{
          max-width: none !important;
        }
        .select2-container .select2-selection--single{
      height: 37px;
    }
    .select2-selection__arrow{
      height: 35px !important;
    }
    .select2-search__field{
      display: none;
    }
    .select2-search--dropdown{
      padding: 0px !important;
    }
    .select2{
      width: 100% !important;
      font-size: 10pt;
    }
    .select2-selection__rendered{
      font-size: 10pt !important;
    }
      </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
    
    <div style="float:left;" class="title_form">
      <p>Menu</p>
    </div>
</div>
 </div>
<div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->
    <div class="padding">
       <div class="row  masonry-container" >
          
          <style type="text/css">
            .menu_edit{
              display:inline-block; 
              float:right;
              margin-right: 10px;
              /*color: blue;*/
            }
            .menu_edit i{
              font-size: 13pt !important;
            }
            .menu_name{
              display:inline-block
            }
            .dd-content:hover .change_pos{
              visibility: visible;
            }
            .change_pos{
                width: 30px;
                position: absolute;
                right: -6px;
                top: 0px;
                visibility: hidden;
            }
            .change_pos > div{
              line-height: 10px;
            }
            .change_pos i{
              font-size: 24px !important;
            }
            .change_pos .material-icons{
              line-height: 0;
              height: 10px;
            }
            .up{
              padding-top:10px;
              cursor: pointer;
            }
            .down{
              cursor: pointer;
               padding-bottom:10px;
            }
            .up_1{
              padding-top:10px;
              cursor: pointer;
            }
            .down_1{
              cursor: pointer;
               padding-bottom:10px;
            }
            .noselect {
              -webkit-touch-callout: none; /* iOS Safari */
              -webkit-user-select: none;   /* Chrome/Safari/Opera */
              -khtml-user-select: none;    /* Konqueror */
              -moz-user-select: none;      /* Firefox */
              -ms-user-select: none;       /* Internet Explorer/Edge */
              user-select: none;           /* Non-prefixed version, currently
                                              not supported by any browser */
            }
            .dd-content {
                padding: 10px 24px 10px 30px;
                margin-bottom: 5px;
            }
          </style>
            <?php
                      $list_menus = App\Menu::where(['parent_id'=>0])->orderby('order', 'asc')->get();

            ?>
            @foreach($list_menus as $v0)
            <div class="col-sm-6 item" style="margin-bottom:20px">
          
            <div  class="dd">
              <ol class="dd-list dd-list-handle">
              
                   <li class="dd-item" data-id="{{$v0->id}}">
                    <div class="dd-content box">
                      <!-- <div class="dd-handle">
                        <i class="fa fa-reorder text-muted"></i>
                      </div> -->
                      <div>
                          <div class="menu_name">{{$v0->name}}</div>
                          @if(session('admin')->can('sua_menu'))
                          <div class="change_pos menu_edit noselect">
                            <div class="up_1">
                              <i class="material-icons md-24">&#xe5c7;</i>
                            </div>
                            <div class="down_1">
                              <i class="material-icons md-24">&#xe5c5;</i>
                            </div>
                          </div>
                           @endif
                           @if(session('admin')->can('xoa_menu'))
                          <div class="menu_edit">
                            <a href="#" class="" type="submit" id="xoa-menu" data-id="{{$v0->id}}">
                                Xóa
                            </a>
                          </div>
                          @endif
                           @if(session('admin')->can('sua_menu'))
                          <div class="menu_edit">
                            <a href="{{route('menu.edit',['id'=>$v0->id])}}">
                              Sửa
                            </a>
                          </div>
                          @endif
                      </div>
                    </div>
                    <?php 
                    if (!function_exists('show_child'))
                    {
                      function show_child($object){
                          $d = $object->subcategory;
                          if($d){
                            ?>
                              <ol class="dd-list dd-list-handle">
                            <?php
                          }
                          foreach ($d as $v) {
                             ?>
                              <li class="dd-item" data-id="{{$v->id}}">
                                  <div class="dd-content box">
                                    <div>
                                        <div class="menu_name">{{$v->name}}</div>
                                        @if(session('admin')->can('sua_menu'))
                                        <div class="change_pos menu_edit noselect">
                                          <div class="up">
                                            <i class="material-icons md-24">&#xe5c7;</i>
                                          </div>
                                          <div class="down">
                                            <i class="material-icons md-24">&#xe5c5;</i>
                                          </div>
                                        </div>
                                        @endif
                                        @if(session('admin')->can('xoa_menu'))
                                        <div class="menu_edit">
                                          <a href="#" type="submit" id="xoa-menu" data-id="{{$v->id}}">
                                            Xóa
                                          </a>
                                        </div>
                                        @endif
                                         @if(session('admin')->can('sua_menu'))
                                        <div class="menu_edit">
                                          <a href="{{route('menu.edit',['id'=>$v->id])}}">
                                            Sửa
                                          </a>
                                        </div>
                                        @endif
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

   <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
   <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
   <script src="http://biostall.com/wp-content/uploads/2010/07/jquery-swapsies.js"></script>
  <script>
   // $('#single').select2();
    $(document).on('click','.up',function(e){
      dd=$(this).parent().parent().parent().parent();
      if($(dd).prev().hasClass('dd-item')){
        prev = $(dd).prev();
        var strDiv1Cont = $(dd).html();
        var data_id1 = $(dd).attr('data-id');
        
        var strDiv2Cont = $(prev).html();
        var data_id2 = $(prev).attr('data-id');

        $(dd).html(strDiv2Cont);
        $(dd).attr('data-id',data_id2);
        $(prev).html(strDiv1Cont);
        $(prev).attr('data-id',data_id1);
      }
      var arr=[];
      list = $(dd).parent().children();
      $.each(list,function(i,v){
        arr.push($(v).attr('data-id'));
      });
      console.log(arr);
      $.ajax({
               type: 'post',
               url:  "{{ route('menu.orderby') }}",
               data: {'arr': arr},
               dataType:'json',
               success: function(msg){
                  console.log(msg);
               }
      });
    });
    $(document).on('click','.down',function(e){
      dd=$(this).parent().parent().parent().parent();
      if($(dd).next().hasClass('dd-item')){
        next = $(dd).next();
        var strDiv1Cont = $(dd).html();
        var data_id1 = $(dd).attr('data-id');
        var strDiv2Cont = $(next).html();
        var data_id2 = $(next).attr('data-id');
        $(dd).html(strDiv2Cont);
        $(dd).attr('data-id',data_id2);
        $(next).html(strDiv1Cont);
        $(next).attr('data-id',data_id1);
      }
      var arr=[];
      list = $(dd).parent().children();
      $.each(list,function(i,v){
        arr.push($(v).attr('data-id'));
      });
      console.log(arr);
       $.ajax({
               type: 'post',
               url:  "{{ route('menu.orderby') }}",
               data: {'arr': arr,'action':'children'},
               dataType:'json',
               success: function(msg){
                  console.log(msg);
               }
      });
    });
     $(document).on('click','.up_1',function(e){
        con_1 = $(this).parent().parent().parent().parent().parent().parent().parent();
        dd = $(this).parent().parent().parent().parent();
        if($(con_1).prev().hasClass('item')){
            change = $(con_1).prev(); 
            var strDiv1Cont = $(con_1).html();
            // var data_id1 = $(dd).attr('data-id');
            var strDiv2Cont = $(change).html();
            // var data_id2 = $(next).attr('data-id');
            $(con_1).html(strDiv2Cont);
            // $(dd).attr('data-id',data_id2);
            $(change).html(strDiv1Cont);
            // $(next).attr('data-id',data_id1);
            load_masonry();
        }
     });
     $(document).on('click','.down_1',function(e){
      console.log('đ');
        con_1 = $(this).parent().parent().parent().parent().parent().parent().parent();
         if($(con_1).next().hasClass('item')){
            console.log('d');
            change = $(con_1).next(); 
            var strDiv1Cont = $(con_1).html();
            // var data_id1 = $(dd).attr('data-id');
            var strDiv2Cont = $(change).html();
            // var data_id2 = $(next).attr('data-id');
            $(con_1).html(strDiv2Cont);
            // $(dd).attr('data-id',data_id2);
            $(change).html(strDiv1Cont);
            // $(next).attr('data-id',data_id1);
            load_masonry();
         }
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
     $(document).on('click','#xoa-menu', function(event){
           event.preventDefault;
           if(xacnhanxoa('Bạn có chắc xóa menu hiện tại hay không?')===false){

           }
           else{
            id = $(this).attr('data-id');
             $.ajax({
                 type: 'post',
                 url:  '{{ route('menu.del') }}',
                 data: {'id': id},
                 dataType:'json',
                 success: function(msg){
                   console.log(msg);
                    if(msg == true){
                      window.location= '{{ route('menu.list') }}';
                    }
                    else{
                      alert('có lỗi xảy ra');
                    }
                 }
             })
           
           }
                     
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
    
  </script>

@endsection