@extends('backend.layouts.default')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/libs/jquery/nestable/jquery.nestable.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
    <style type="text/css">
      .list-item{
        padding-left: 0px;
        padding-right: 0px;

      }
      .form-group input{
        padding-top: 0px  !important;
        padding-bottom: 0px !important;
        min-height: 1.5rem;
      }
      input{
        /*color: #A6A6A6 !important;*/
      }
      label{
        margin-bottom: 0px;
      }
      .box-body{
        padding-top: 0px;
        padding-bottom: 0px;
      }
       .box-body ul{
        padding-top: 0px !important;
        margin-bottom: 0px !important;
        padding-bottom: 0px !important;
      }
         .box-body ul li:first-child{
          /*padding-top: 0px !important;*/
        }
      .box-header{
        border-bottom: 0px;
        position: relative;
      }
      .box-footer{
        padding-top: 5px;
      }
      .box-footer button{
        background-color: #F2F2F2;
        color: #A6A6A6;
        font-size: 8pt;
        min-width:60px;
        padding-top:6px;
        padding-bottom:6px
      }
       .box-header h3{
        font-size: 10pt;
      }
      .box-footer button:hover{
        background-color: #FFC000;
        color: #fff;
      }
       @media (min-width: 991px){
        .title_form{
            margin-left: 10px !important;
            margin-top: 16px;
            font-family: "Roboto Black"
        }
      }
      .close-slide{
        position: absolute;
        right: 20px;
        top: 12px;
        text-transform: lowercase;
        font-family: "Roboto";
        font-size: 13pt;
        cursor: pointer;
        text-align: center;
        color: #A6A6A6;
      }
      .close-slide:hover{
        color: #404040;
      }
      

      .s-img{
        max-width:100%;height:100px;min-width:170px;background-color:#F0F0F0;
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
      .close-slide-type {
        position: absolute;
        right: 20px;
        top: 12px;
        text-transform: lowercase;
        font-family: "Roboto";
        font-size: 13pt;
        cursor: pointer;
        text-align: center;
        color: #A6A6A6;
      }
      @media (min-width: 991px){
        .title_form{
            margin-left: 10px !important;
            margin-top: 16px;
        }
       
      }
      .cate_edit a:hover {
          background-color: #fff;
          padding: 4px 12px;
          border-radius: 3px;
          color: #111;
      }
    </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
      <p>Config danh mục bài viết</p>
    </div>
</div>
 </div>
<div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->
    <div class="padding">
       <div class="row">
          
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
                      $list_categories = App\CategoryProduct::where(['parent_id'=>0])->get();

            ?>
         
            <div class="col-sm-6">
            <div  class="dd">
              <ol class="dd-list dd-list-handle">
                @foreach($list_categories as $v0)
                   <li class="dd-item" data-id="{{$v0->id}}">
                    <div class="dd-content box">
                      
                      <div>
                          <div class="cate_name">{{$v0->name}}</div>
                           <div class="cate_edit">
                              @if($v0->editable == 0)
                              <a href="#" type="submit" class="editable" data-id="{{$v0->id}}">
                                 <i class="material-icons md-24">&#xe876;</i>
                              </a>
                              @else
                               <a href="#" type="submit" class="editable" data-id="{{$v0->id}}">
                                  <i class="material-icons md-24">&#xe612;</i>
                              </a>
                              @endif

                           </div>
                            
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
                                    <div class="dd-handle">
                                      <i class="fa fa-reorder text-muted"></i>
                                    </div>
                                    <div>
                                        <div class="cate_name">{{$v->name}}</div>
                                        <div class="cate_edit">
                                               @if($v->editable == 0)
                                                <a href="#" type="submit" class="editable" data-id="{{$v->id}}">
                                                   <i class="material-icons md-24">&#xe876;</i>
                                                </a>
                                                @else
                                                 <a href="#" type="submit" class="editable" data-id="{{$v->id}}">
                                                    <i class="material-icons md-24">&#xe612;</i>
                                                </a>
                                                @endif
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
                @endforeach
              </ol>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/nestable/jquery.nestable.js') }}"></script>
  <script>
    $('.dd').nestable({ /* config options */ });
    $('.dd').on('change', function() {
        console.log($('.dd').nestable('serialize'));
    });
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
    $(document).on('click','.editable', function(event){
          event.preventDefault;
          id = $(this).attr('data-id');
          $.ajax({
                 type: 'post',
                 url:  '{{ route("dev.editable.product") }}',
                 data: {'id': id},
                 dataType:'json',
                 success: function(msg){
                   console.log(msg);
                    if(msg.status == true){
                      location.reload();
                    }
                    else{
                      alert('có lỗi xảy ra');
                    }
                 }
             });
                     
     });
  </script>

@endsection