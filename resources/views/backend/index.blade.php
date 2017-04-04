@extends('backend.layouts.default')
@section('css')
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
        color: #A6A6A6 !important;
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
      textarea{
        font-size: 9pt !important;
      }
      .form-group > label.bg{
        max-width: 100%;
        height: 60px;
        min-width: 100px;
        background-color: #F0F0F0;
        border: 1px solid #E7E7E7;
        position: relative;
      }
      .form-group > label span{
        display: none;
      }
      .form-group > label.bg span{
        position: absolute;
        width: 100%;
        text-align: center;
        top: 20px;
        display: block;
      }
      .box-footer button{
        font-size: 10pt;
        font-weight: 400;
        padding-top: 4px;
        padding-bottom: 4px;
      }
       .box-footer button:hover{
        background-color: #95C760 !important;
       }
      
    </style>
@endsection
@section('content')
<div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->
<div class="p-a white lt box-shadow">
	<div class="row">
		<div class="col-sm-6">
			<h4 class="m-b-0 _300">Chào mừng bạn tới hệ thống Quản trị</h4>
			
		</div>
		
	</div>
</div>    
<div class="padding">
	<div class="row masonry-container">
		<div class="col-sm-6 col-md-4 item">
        <div class="box">
            <div class="box-header">
              <h3>Sitemap</h3>
            </div>
            <div class="box-body">
              <!-- <a href="{{route('create.sitemap')}}" target="_blank">Cập nhập sitemap</a> -->
            </div>
            <div class="box-footer">
                <a href="{{route('create.sitemap')}}" target="_blank">
                  <button class="btn btn-sm  pull-right" >Cập nhập</button>
                </a>
                <div style="clear:both">
                </div>
            </div>
        </div>
		</div>
    
	</div>
</div>
</div>

<!-- ############ PAGE END-->

</div>
    
@endsection

@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/footable/dist/footable.all.min.js') }}"></script>
  <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
  <script>
  function load_masonry(){
      var $container = $('.masonry-container');
      $container.masonry({
        columnWidth: '.item',
        itemSelector: '.item'
      });   
  }
  load_masonry();
    
  </script>
@endsection