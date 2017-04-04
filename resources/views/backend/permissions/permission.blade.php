@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
   <!-- <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" /> -->
    <style type="text/css">
      .list-item{
        padding-left: 0px;
        padding-right: 0px;

      }
      label {
        padding-bottom: 0.5rem;
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
      .s-name{
        display: inline-block;
        float: left;
        width: calc(100% - 60px);
      }
      .s-name a{
        width: 60px;
        float: left;
        height: 28px;
        background-color: #fff;
        outline: none;
        border: 1px solid #D9D9D9;
        border-left: 0px;
        font-family: "Roboto";
        font-size: 10pt;
        color:#7F7F7F;
        display: block;
        text-align: center;
        padding-top: 3px;
      }
      .s-name input{
        width: calc(100% - 70px);
        height: 28px;
        float: left;
        border: 1px solid #D9D9D9;
        padding-top: 4px !important;
        padding-left: 10px !important;
        padding-bottom: 4px !important;
        font-size: 10pt;
        font-family: "Roboto";
        color:#7F7F7F;
        
      }
      .s-add{
        display: inline-block;
        float: right;
      }
      .s-add a{
        width: 60px;
        height: 28px;
        background-color: #fff;
        outline: none;
        border: 1px solid #D9D9D9;
        font-family: "Roboto";
        font-size: 10pt;
        color: #2E75B6;
        display: block;
        text-align: center;
        padding-top: 3px;
      }
      h3 input{
        height: 30px;
        width: 100%;
        border: 0px;
        font-size: "Roboto Medium";
        font-size: 11pt;
      }
      .s-change{
        width: 100%;
        height: 25px;
        background-color: #fff;
        outline: none;
        border: 0px solid #D9D9D9;
        font-family: "Roboto";
        font-size: 10pt;
        color: #2E75B6;
        display: block;
        text-align: left;
        padding-top: 2px;
        color:#7F7F7F;
        padding-left: 10px;
      }
      .s-linkable{
         color:#7F7F7F;
        background-color: #F2F2F2;
      }
      .s-change:hover{
        color:#7F7F7F;
        background-color: #F2F2F2;
      }
      .item-editable textarea{
        background-color: #F2F2F2 !important;
        margin-bottom: 2px;
        border: 0px;
        font-size: 9pt;
      }
      .item-editable span,a{
        font-size: 10pt;
        font-family: "Roboto";
      }
       .item-editable a{
        font-size: 10pt;
        font-family: "Roboto";
      }
      .s-img-container{
        margin-bottom: 3px;
      }
      .s-img{
        width: 80px;
        height: 70px;
      }
      @media (min-width: 991px){
          .title_form{
              margin-left: 9px;
              margin-top:13px;

          }
      }
      .title_form input{
        height: 30px;
        width: 100%;
        border: 0px;
        font-size: "Roboto Medium";
        font-size: 11pt;
      }
    </style>
@endsection

@section('content')

<div class="app-header white box-shadow">
  <div class="navbar">
    
  </div>
</div>

 <div class="app-body" id="view">
    <div class="padding">



      <div class="box">
        <div class="box-header">
          <h2>Danh sách thuộc tính</h2>
        </div>
        <div class="box-body">
          Tìm kiếm: <input id="filter" type="text" class="form-control input-sm w-auto inline m-r"/>
            <a href=""><button class="md-btn md-raised m-b-sm w-xs orange"  data-toggle="modal" data-target="#m-a-a" ui-toggle-class="fade-right" ui-target="#animate" >Thêm</button></a>
        </div>
        @include('backend.partials._messages')
        <!-- .modal -->
        <a type="button" data-toggle="modal" id="edit_preview" data-target="#edit" ui-toggle-class="fade-right" ui-target="#animate1"style="display: none;"></a>
        <div id="m-a-a" class="modal fade animate" data-backdrop="true">
          <div class="modal-dialog" id="animate">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Thêm thuộc tính</h5>
              </div>
              <form action="{{route('admin.config.add.permission')}}" method="post">
              <div class="modal-body text-center p-lg">
                  <div class="row">
                    <div class="col-sm-10 col-sm-offset-1" id="input-select" style="text-align: left;">

                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                  <label>Tên phân quyền</label>
                                  <input type="text" class="form-control" name="name" >                  
                            </div>

                    </div>   
                     
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Hủy</button>
                <button type="submit" class="btn danger p-x-md" >Tạo</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div>
        </div>
        <!-- / .modal -->
        <!-- .modal -->
        <div id="edit" class="modal fade animate" data-backdrop="true">
          <div class="modal-dialog" id="animate1">
            
              
          
          </div>
        </div>
        <!-- / .modal -->
        <div>
        <style type="text/css">
          .edit{
            color:orange;
          }
          .edit i{
            font-size: 15pt !important;
          }
        </style>
         
          <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="20">
            <thead>
              <tr>
                  <th data-toggle="true">
                    Tên 
                  </th>
                  <th>
                    Chi tiết
                  </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($permissions as $per)
                  <tr>
                    <td>{{$per->name}}</td>
                    <td class="action-post">
                     <a href="#" data-id="{{$per->id}}" id="edit-value">Sửa</a>
                     <a href="#" data-id="{{$per->id}}" id="del-value">xóa</a>
                    </td>
                  
                </tr>
              @endforeach
             
             
            </tbody>
            <tfoot class="hide-if-no-paging">
              <tr>
                  <td colspan="5" class="text-center">
                      <ul class="pagination"></ul>
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
      "enabled": true
    }
  });
});

 


  </script>
@endsection