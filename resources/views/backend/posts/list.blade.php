@extends('backend.layouts.default')


@section('content')
<style type="text/css">
    .note-editor .note-frame{
        /*border: 1px solid #a9a9a9 !important;*/
      }
      .note-editable{
        /*border: 1px solid #a9a9a9 !important;*/
      }
      .label-info{
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
        input{
          background-color: #F0F0F0 !important;
          font-size: 10pt !important;
          border: 1px solid #E7E7E7 !important;
        }
        textarea{
          background-color: #F0F0F0 !important;
          font-size: 10pt !important;
          border: 1px solid #E7E7E7 !important;
        }
        select{
          font-size: 10pt !important;
        }
        .select2-results__option{
          font-size: 10pt !important;
          padding-left: 14px !important;
        }
        .select2-selection__choice{
          font-size: 10pt !important;
        }
        .select2-dropdown{
          border-radius: 0px !important;
          border-bottom: 1px solid #E7E7E7 !important;
          border-top: 1px solid #E7E7E7 !important;
          border-left: 1px solid #E7E7E7 !important;
          border-right: 1px solid #E7E7E7 !important;
        }
        .bootstrap-tagsinput{
          background-color: #F0F0F0 !important;
        }
        .select2-selection{
          background-color: #F0F0F0 !important;
          color: #D1F5F1;
          border-radius: 0px !important; 
          border: 1px solid #E7E7E7 !important;
        }
        .select2-selection__choice{
          background-color: #0CC2AA !important;
          border: 1px solid #0CC2AA !important;
          color:#D1F5F1 !important;
        }
        .select2-search__field{
          background-color: #F0F0F0 !important;
          border: none !important;
        }
        .select2-selection__choice__remove{
          color:#D1F5F1 !important;
        }
        .select2-selection__rendered{
          padding-top: 5px !important;
          padding-bottom: 5px  !important;
          padding-left: 13px !important;
          border-radius: 0px !important; 
        }
        .select2-results__option--highlighted{
          background-color: #F0F0F0 !important;
          color: #404040 !important;
        }
        .select2-selection__clear{
          color:#BFBFBF !important;
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
    .select2-selection__choice{
      background-color: #ffffff;
      color:#111;
    }
    label{
      font-size: 10pt;
      color: #A6A6A6;
    }
    .nav-item a{
      background-color: #F2F2F2;
      margin-right: 10px;
    }
    .box-header{
      border-bottom: 1px solid #E7E7E7;
    }
    .note-toolbar{
      background-color: #fff;
    }
    .dropdown-toggle::after{
      display: none;
    }
    .note-popover{
      display: none;
    }
    .p-a-sm{
          box-shadow: none !important;
          padding: 0px !important;
    }
    .note-toolbar{
      padding: 0px !important;
    }
.note-editable{
    padding-right: 0px !important;
    padding-left: 0px !important;
}
@media (min-width: 991px){
    .title_form{
        margin-left: 207px;
        margin-top:16px;

    }
}
.title_form{
        margin-top:16px;
        font-size: 14pt;
}
.dd-content{
    padding-top: 15px !important;
    padding-bottom: 15px !important;
}
.dd-item > button{
    height: 41px !important; 
}
.menu_name{
     font-size: 10.5pt;
}
.cate_name{
    font-size: 10.5pt;
}
.cate_edit a{
    background-color: #E7E7E7;
    padding:4px 12px;
    border-radius: 3px;
    color:#A6A6A6;
}
.menu_edit a{
    background-color: #E7E7E7;
    padding:4px 12px;
    border-radius: 3px;
    color:#A6A6A6;
}
.nav-item a{
    font-size: 10pt;
    color:#A6A6A6;
}
.note-editable{
    font-size: 10pt;
}
label[for="file_img_preview"]{
    line-height: 1.3;
}
label[for="file_img_preview"] a{
    padding-top: 4px !important; 
    padding-bottom: 4px !important; 
    min-width: 120px;
}
.alert{
    font-size: 10pt;
}
.title_form p{
    font-family: 'Roboto Black';
}
.nav-link {
    padding-right: 3px;
}
.nav-item span{
    padding-left: 8px;
    cursor: pointer;
}
    h2{
          font-family: "Roboto-Bold";
          font-size: 10.5pt !important;
    }
      @media (min-width: 991px){
        .title_form{
            margin-left: 10px !important;
            margin-top: 16px;
        }
      }
    .number-post{
      width: 80px;
      height: 44px;
      background-color: #fff;
      border: 1px solid #E7E7E7;
      float: left;
      color: #404040;
      font-size: 10pt;
    } 
    #filter{
      float: left;
    } 
    .box-body{
      position: relative;
    }
    .drop-cate{
      position: absolute;
      left: calc(100% - 150px);
      top: 28px;
      width: 20px !important;
      height: 20px !important;
      padding: 7px !important;
      background-color: rgba(1,1,1,0) !important;
      box-shadow:none !important;
    }
    .drop-cate:hover{
      background-color: rgba(1,1,1,0) !important;
      box-shadow:none !important;
    }
    .dropdown-menu{
      left: 16px !important;
      top: 58px !important;
      width: calc(100% - 132px);
      padding-top: 0px !important;
      padding-bottom: 0px !important;
      border-top:0px !important;
      border-top-left-radius: 0px !important;
      border-top-right-radius: 0px !important;
    }
    .dropdown-item{
      padding-top: 10px !important;
      padding-bottom: 10px !important;
      font-size: 10pt !important;
    }
    .dropdown-toggle::after{
      /*display: none !important;*/
      margin-left: -1px !important;
    }
    .pagination{
      float: right;
    }
    /*.box-body{
      padding-bottom: 40px !important;
    }*/
    th{
      font-size: 10pt !important;
      font-family: "Roboto-Bold" !important;
    }
    td{
      font-size: 10pt !important;
    }
    .action-post a{
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 4px;
        padding-bottom: 4px;

    }
    .action-post a:hover{
       background-color: #bfbfbf;
       border-radius: 2px;
    }
    .pagination > li > a {
          padding: 0.4rem 0.75rem !important;
    }
    .footable{
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
    .comment-pagination > li > .active{
       background-color: #0CC2AA;
       color: #fff;
       border: 1px solid #0CC2AA;
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
        .p-themmoi1 {
          margin-left:30px;
          font-size: 14pt;
          font-family: 'Roboto Black';
          color: rgba(0, 0, 0, 0.4);
        }
        .p-themmoi1:hover {
          color: #738CEC;
        }
   </style>
<?php
  $cate =null;
 if(isset($id_cate)) {
    $cate = App\Category::where('id',$id_cate)->first();
    
  }
  $list_categories = App\Category::where(['parent_id'=>0])->get();
   $space = "&nbsp;&nbsp;&nbsp;&nbsp;"
?>
 <?php if($cate) { 
                  $post_id = DB::table('post_category')->where('category_id',$cate->id)->get();
                  $in = array();
                  foreach ($post_id as $key => $value) {
                    array_push($in,$value->post_id);
                  }
                  $list_bai_viet  = App\Post::wherein('posts.id',$in)->leftJoin('admins', 'posts.create_by', '=', 'admins.id')->leftJoin('admins as tbl_edit', 'posts.last_edit_by', '=', 'tbl_edit.id')->select('posts.*','admins.username as create_by_u','tbl_edit.username as last_edit_by_u')->orderby('posts.created_at','desc')->paginate(10);
                }
                else{
                  $list_bai_viet  = App\Post::leftJoin('admins', 'posts.create_by', '=', 'admins.id')->leftJoin('admins as tbl_edit', 'posts.last_edit_by', '=', 'tbl_edit.id')->select('posts.*','admins.username as create_by_u','tbl_edit.username as last_edit_by_u')->orderby('posts.created_at','desc')->paginate(10);
                }
          ?>


<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        @if($cate) 
          <p style="float:left;">{{$cate->name}}</p>
          @if(session('admin')->can(['dang_bai_viet']) || session('admin')->can(['luu_bai_viet']))
          
            <a href="{{ route('posts.add') }}" class="p-themmoi1">+ Thêm bài viết</a>
         
           @endif
        @else
           @if(session('admin')->can(['dang_bai_viet']) || session('admin')->can(['luu_bai_viet']))
          
            <a href="{{ route('posts.add') }}" class="p-themmoi" style="margin-left:0px">+ Thêm bài viết</a>
          
           @endif
        @endif
        
    </div>
</div>
</div>
 

 <div class="app-body" id="view">
    <div class="padding">
      <div class="box">
        
        <div class="box-body">
          <input id="filter" style="width:calc(100% - 100px); line-height:30px;" placeholder="Tìm kiếm bài viết" type="text" class="form-control input-sm inline m-r"/>
          <button class="btn white dropdown-toggle drop-cate" data-toggle="dropdown"></button>
          <div class="dropdown-menu pull-right">
             <a  class="dropdown-item" href="{{route('posts.list')}}">Tất cả</a>
            @foreach($list_categories as $v0)
              <a  class="dropdown-item" href="{{route('category.detail',['id'=>$v0->id])}}">{{$v0->name}}</a>
              @if($v0->subcategory)
                   @foreach($v0->subcategory as $v1)
                        <a  class="dropdown-item"  href="{{route('category.detail',['id'=>$v1->id])}}">{{$space}}{{$v1->name}}</a>
                        @if($v1->subcategory)
                          @foreach($v1->subcategory as $v2)
                            <a  class="dropdown-item"  href="{{route('category.detail',['id'=>$v2->id])}}">{{$space.$space}}{{$v2->name}}</a>
                                @if($v2->subcategory)
                                @foreach($v2->subcategory as $v3)
                                  <a  class="dropdown-item" href="{{route('category.detail',['id'=>$v3->id])}}">{{$space.$space.$space}}{{$v3->name}}</a>
                                  @if($v3->subcategory)
                                     @foreach($v3->subcategory as $v4)
                                      <a  class="dropdown-item" href="{{route('category.detail',['id'=>$v4->id])}}">{{$space.$space.$space.$space}}{{$v4->name}}</a>
                                     @endforeach
                                 @endif
                                 @endforeach
                             @endif
                             @endforeach
                         @endif
                         @endforeach
                     @endif
              @endforeach
          </div>

          <button class="number-post">{{sizeof($list_bai_viet)}} Bài</button>
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
                      Tiêu đề
                  </th>
                  <th>
                      Ảnh
                  </th>
                 <!--  <th>
                      Đường dẫn
                  </th> -->
                  <th>
                      Trạng thái
                  </th>
                  <th style="padding-left:26px;">
                      Hành động
                  </th>
                  <th>
                      Tạo ngày
                  </th>
                  <th>Cập nhập ngày</th>
              </tr>
            </thead>
            <tbody>
              @foreach($list_bai_viet as $key => $value)
              <tr>
                  <td>{{$value->title}}</td>
                  <td><img src="{{$value->thumb_images}}" style="height:30px"></td>
                 <!--  <td>
                    <a href="{{url('bai-viet/'.$value->id.'/'.$value->slug)}}">{{'bai-viet/'.$value->id.'/'.$value->slug}}</a>
                  </td> -->
                  <td>

                    @if($value->status == 1)
                    <a style="color:#738CEC">Công khai</a>
                    @endif
                    @if($value->status == 0)
                    <a  style="">Không công khai</a>
                    @endif
                  </td>
                  <td class="action-post">
                    
                    @if(session('admin')->can('sua_bai_viet'))
                    <a href="{{route('posts.edit',['id'=>$value->id])}}">
                    Sửa</a>
                    @endif
                    
                    @if(session('admin')->can('xoa_bai_viet'))
                    <a href="#" type="submit" id="xoa-cate" data-id="{{$value->id}}">
                    Xóa
                    </a>
                     @endif
                    @if($value->status == 1)
                    <a href="{{url('bai-viet/'.$value->id.'/'.$value->slug)}}">Xem</a>
                    @endif
                  </td>
                  <?php $date = new DateTime($value->created_at);?>
                  <td>{{$date->format(' d/m/Y H:i')}} bởi 
                  <a href="#" style="color:#738CEC">{{$value->create_by_u}}</a></td>
                  <?php $date = new DateTime($value->updated_at);?>
                  <td>{{$date->format(' d/m/Y H:i')}} bởi 
                  <a href="#"  style="color:#738CEC">{{$value->last_edit_by_u}}</a></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot class="hide-if-no-paging">
              <tr>
                  <td colspan="12" class="text-center">
                   <ul class="list-inline comment-pagination">
                            <?php $link_limit = 9; ?>
                              @for ($i = 1; $i <= $list_bai_viet->lastPage(); $i++)
                                        <?php
                                        $half_total_links = floor($link_limit / 2);
                                        $from = $list_bai_viet->currentPage() - $half_total_links;
                                        $to = $list_bai_viet->currentPage() + $half_total_links;
                                        if ($list_bai_viet->currentPage() < $half_total_links) {
                                           $to += $half_total_links - $list_bai_viet->currentPage();
                                        }
                                        if ($list_bai_viet->lastPage() - $list_bai_viet->currentPage() < $half_total_links) {
                                            $from -= $half_total_links - ($list_bai_viet->lastPage() - $list_bai_viet->currentPage()) - 1;
                                        }
                                        ?>
                                        @if ($from < $i && $i < $to)
                                            <li class="{{ ($list_bai_viet->currentPage() == $i) ? ' active' : '' }}">
                                                <a  class="{{ ($list_bai_viet->currentPage() == $i) ? ' active' : '' }}" href="{{$list_bai_viet->url($i)}}" data-page={{$i}}>{{ $i }}</a>
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
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/footable/dist/footable.all.min.js') }}"></script>
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
     $(document).on('click','#xoa-cate', function(event){
           event.preventDefault();
           if(xacnhanxoa('Bạn có chắc xóa bài viết hiện tại hay không?')===false){

           }
           else{
            id = $(this).attr('data-id');
             $.ajax({
                 type: 'post',
                 url:  '{{ route('del.post') }}',
                 data: {'id': id},
                 dataType:'json',
                 success: function(msg){
                   console.log(msg);
                    if(msg == true){
                      location.reload();
                    }
                    else{
                      alert('có lỗi xảy ra');
                    }
                 }
             })
           
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
  </script>
@endsection