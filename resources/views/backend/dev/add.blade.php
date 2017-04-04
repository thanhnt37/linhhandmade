
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
       \.item-editable a{
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
        display: inline-block;
        border: 0px;
        font-family: "Roboto Medium";
        font-size: 11pt;
      }
    </style>
    </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
  <form ui-jp="parsley" action="{{route('layout.group.post_add')}}" method="post">
  	  <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div style="float:left;" class="title_form">
          <input style="font-size:11pt; font-family: Roboto Black;" type="" name="key" placeholder="Nhập tên Nhóm Layout">
      </div>
      <div style="float:right;margin-top:10px;">
        <button type="submit" name="submit"  value="post" class="btn success" style="
      padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 8px;font-family: 'Roboto-Bold';
      min-width:100px; background-color:#738CEC">TẠO</button>
      </div>
    </form>
</div>
</div>

<div class="app-body" id="view">
	<div class="padding">
		
</div>

@stop
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
     <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
  <script>
   var $container = $('.masonry-container');

    $container.masonry({
      columnWidth: '.item',
      itemSelector: '.item'
    });   
  	$(".select2-multiple").select2({
      placeholder: "Chọn danh mục "
    })
  </script>

@endsection