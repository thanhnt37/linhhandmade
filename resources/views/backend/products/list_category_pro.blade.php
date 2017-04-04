@extends('backend.layouts.default')
@section('css')
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
        /*phong*/
       .p-themmoi {
          margin-left:30px;
          font-size: 14pt;
          font-family: 'Roboto Black';
          color: rgba(0, 0, 0, 0.87);
        }
        .p-themmoi:hover {
          color: #738CEC;
        }
    </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
   <div style="float:left;" class="title_form">
   <!-- phong -->
      @if(session('admin')->can('them_danh_muc_san_pham'))
              <a  href="{!!route('category.product.add')!!}" class="p-themmoi" style="margin-left:0px">+ Thêm nhóm sản phẩm</a>
      @endif
    </div>
</div>
 </div>
 
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
                      $list_categories = App\CategoryProduct::where(['parent_id'=>0])->get();

            ?>
            @foreach($list_categories as $v0)
            <div class="col-sm-6 item" style="margin-bottom:20px">
              <div  class="dd">
                <ol class="dd-list dd-list-handle">
                
                     <li class="dd-item" data-id="{{$v0->id}}">
                      <div class="dd-content box">
                       <!--  <div class="dd-handle">
                          <i class="fa fa-reorder text-muted"></i>
                        </div> -->
                        <div>
                            <div class="cate_name">{{$v0->name}}</div>
                              @if($v0->editable == 0)
                              @if(session('admin')->can('xoa_danh_muc_san_pham'))
                                 <div class="cate_edit">
                                    <a href="#" type="submit" id="xoa-cate" data-id="{{$v0->id}}">
                                         Xóa
                                    </a>
                                 </div>
                              @endif  
                              @endif
                              @if(session('admin')->can('sua_danh_muc_san_pham')) 
                                <div class="cate_edit">
                                <a href="{{route('cate.products.edit',['id'=>$v0->id])}}">
                                  Sửa
                                </a>
                                </div>
                              @endif
                              <div class="cate_edit">
                                  <a href="{{route('cate.products.detail',['id'=>$v0->id])}}">
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
                                          <div class="cate_name">{{$v->name}}</div>
                                           @if($v->editable == 0)
                                          <div class="cate_edit">
                                              <a href="#" type="submit" id="xoa-cate" data-id="{{$v->id}}">
                                                   Xóa
                                              </a>
                                           </div>
                                          <div class="cate_edit">
                                            <a href="{{route('cate.products.edit',['id'=>$v->id])}}">
                                              Sửa
                                            </a>
                                          </div>
                                          @endif
                                          <div class="cate_edit">
                                            <a href="{{route('cate.products.detail',['id'=>$v->id])}}">
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

           }
           else{
            id = $(this).attr('data-id');
             $.ajax({
                 type: 'post',
                 url:  '{{ route('cate.products.del') }}',
                 data: {'id': id},
                 dataType:'json',
                 success: function(msg){
                   console.log(msg);
                    if(msg == true){
                      window.location= '{{ route('dev.list.category.product') }}';
                    }
                    else{
                      alert('có lỗi xảy ra');
                    }
                 }
             })
           
           }
                     
     });
  </script>

@endsection