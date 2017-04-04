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
    .box-body{
      padding-bottom: 15px !important;
    }
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
    .modal-content{
      border-radius: 0px;
    }
     .edit-tag_submit , .edit-tag_submit:hover{
        
        background-color: #92D050 !important;
        color: #fff;
        font-size: 10pt;
        padding-top: 6px;
        padding-bottom: 6px;
        min-width: 70px;
    }
    .edit-tag_cancel,  .edit-tag_cancel:hover{
       background-color: rgba(1,1,1,0) !important;
        font-size: 10pt;
        padding-top: 6px;
        padding-bottom: 6px;
        min-width: 70px;
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
    .comment-pagination > li > .active{
       background-color: #0CC2AA;
       color: #fff;
       border: 1px solid #0CC2AA;
    }
   </style>
<?php
   $comments = App\CommentPost::select('comment_posts.*','accounts.username','posts.title','posts.slug')->leftJoin('accounts', 'comment_posts.account_id', '=', 'accounts.id')->where('comment_posts.status',0)->leftJoin('posts', 'posts.id', '=', 'comment_posts.post_id')->orderby('created_at','asc')->paginate(10); 
?>
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
       
        <p>Tất cả bình luận chưa duyệt</p>
        
    </div>
</div>
</div>
 

 <div class="app-body" id="view">
    <div class="padding">
      <div class="box">
        
        <div class="box-body">
          <input id="filter" style="width:calc(100% - 100px); line-height:30px;" placeholder="Tìm kiếm comment" type="text" class="form-control input-sm inline m-r"/>
          <button class="btn white dropdown-toggle drop-cate" data-toggle="dropdown"></button>
          <div class="dropdown-menu pull-right">
             <a  class="dropdown-item" href="{{route('comments.post.list')}}">Chưa duyệt</a>
             <a  class="dropdown-item" href="{{route('comments.post.list.done')}}">Đã duyệt</a>
            
          </div>

          <button class="number-post">{{sizeof($comments)}} BL</button>
          <div style="clear:both"></div>
        </div>
        <div class="table-responsive">
          <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
            <thead>
              <tr>
                  <th>Người dùng</th>
                  <th data-toggle="true">
                      Nội dung
                  </th>
                  <th>
                      Rate
                  </th>
                  <th>Sản phẩm</th>
                  <th style="padding-left:26px;">
                      Hành động
                  </th>
                  <th>
                      Tạo ngày
                  </th>
              </tr>
            </thead>
            <tbody>
              @foreach($comments as $key => $value)
              <tr>
                  <td>{{$value->username}}</td>
                  <td>{{$value->comment}}</td>
                  <td>
                  <div style="min-width:80px;color:#7f7f7f">@for($i=0;$i< intval($value->rating);$i++)
                  <i class="fa fa-star t-blue-text"></i>
                  @endfor
                  </div>
                  </td>
                  <td><a style="" href="{{route('frontend.bai-viet.slug',['id'=>$value->post_id,'slug'=>$value->slug])}}" target="_blank">{{$value->title}}</a></td>
                  <td class="action-post" >
                    <div style="min-width:140px">
                      <a class="duyet" href="#" data-id="{{$value->id}}">
                      Duyệt
                      </a>
                      <a class="xoa" href="#" data-id="{{$value->id}}">
                      Xóa
                      </a>
                      <a href="{{route('posts.edit',['id'=>$value->post_id])}}" target="_blank">
                      SP
                      </a>
                    </div>
                  </td>
                  <td>{{$value->created_at}}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot class="hide-if-no-paging">
              <tr>
                  <td colspan="12" class="text-center">
                       <ul class="list-inline comment-pagination">
                                <?php $link_limit = 9; ?>
                                  @for ($i = 1; $i <= $comments->lastPage(); $i++)
                                            <?php
                                            $half_total_links = floor($link_limit / 2);
                                            $from = $comments->currentPage() - $half_total_links;
                                            $to = $comments->currentPage() + $half_total_links;
                                            if ($comments->currentPage() < $half_total_links) {
                                               $to += $half_total_links - $comments->currentPage();
                                            }
                                            if ($comments->lastPage() - $comments->currentPage() < $half_total_links) {
                                                $from -= $half_total_links - ($comments->lastPage() - $comments->currentPage()) - 1;
                                            }
                                            ?>
                                            @if ($from < $i && $i < $to)
                                                <li class="{{ ($comments->currentPage() == $i) ? ' active' : '' }}">
                                                    <a  class="{{ ($comments->currentPage() == $i) ? ' active' : '' }}" href="{{$comments->url($i)}}" data-page={{$i}}>{{ $i }}</a>
                                                </li>
                                            @endif
                                  @endfor
                            </ul>
                  </td>
              </tr>
            </tfoot>
          </table>
           <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog" id="edit-tag">
                  <!-- Modal content-->    
                </div>
            </div>
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
      "enabled": true
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
 var click_duyet = 0;
 var click_del = 0;
 $(document).on('click', '.duyet', function(event){

    event.preventDefault();
    id = $(this).attr('data-id');
    content = this;
    if(click_duyet==0){
         click_duyet = 1;  
        $.ajax({
          type: 'post',
          url:  "{{route('comments.post.accept')}}",
          data: { 'id' : id},
          success: function(data){
             click_duyet = 0;  
             $(content).parent().parent().parent().remove();
          },
          dataType:'json'
        })
    }
    
    //alert(id);
 });
 $(document).on('click','.xoa', function(event){
     event.preventDefault();
     if(xacnhanxoa('Bạn có muốn xóa comment này không?')===false){

     }
     else{
      content = this;
      id = $(this).attr('data-id');
      if(click_del==0){
        click_del = 1;
         $.ajax({
             type: 'post',
             url:  "{{route('comments.post.delete')}}",
             data: {'id': id},
             dataType:'json',
             success: function(data){
                click_del = 0;  
                $(content).parent().parent().parent().remove();
             }
         });
      }
     }
                     
     });
  </script>
@endsection