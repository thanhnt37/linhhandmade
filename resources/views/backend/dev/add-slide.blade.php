
@extends('backend.layouts.default')
@section('css')
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
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
        top: 24px;
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
      .box-body{
        padding: 0px ;
      }
    </style>
	 <style type="text/css">
     option:disabled {
        background: #dddddd;
    }
    .name-slide{
      height: 30px;
      width: 100%;
      border: 0px !important;
      font-family: "Roboto Medium";
      font-size: 12pt !important;
      background-color: #fff !important;
      padding-left: 0px !important;
      padding-right: 0px !important;

    }
    .box-header{
      padding-top: 0px !important;
    }
    .x-create{
      background-color: #F2F2F2;
      color: #A6A6A6;
      font-size: 10pt;
      min-width: 60px;
      padding-top: 4px;
      padding-bottom: 4px;
      font-weight: 400;
      outline: 0 !important;
      border-width: 0;
      border-radius: 2px;
    }
    .x-create:hover{
      color: rgba(255, 255, 255, 0.87) !important;
      background-color: #95C760 !important;
    }
   </style>
@endsection
@section('content')
	<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
      <p>Quản lý slide</p>
    </div>
</div>
 </div>
	 <div class="app-body" id="view"> 
	 	<div class="padding">
      @include('backend.partials._messages')
	 	 <div class="row">
		          </div>
		          <div class="box-body">
					<div class="row">
							<div class="col-sm-6 col-md-4">
							  <form ui-jp="parsley" action="{{route('layout.dev.slide_add')}}" method="post">
						        <div class="box">
						          <div class="box-header">
						            <input type="hidden" name="_token" value="{{csrf_token()}}">
					          		    <div class="form-group">
							              <label></label>
							              <input type="text" class="form-control name-slide" name="name" placeholder="Nhập tên slide">                  
							               </div>
      								   <div class=" text-right">
      							     <ul class="list no-border p-b">
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="img_1" placeholder="img_1" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="img_2" placeholder="img_2" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="img_3" placeholder="img_3" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text_1" placeholder="text_1" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text_2" placeholder="text_2" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text_3" placeholder="text_3" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text_4" placeholder="text_4" >
                                              </div>
                                         </li>

                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:2px;text-align: left;">
                                              <input name="des_1" class="form-control" rows="5" placeholder="des_1">
                                            </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:2px;text-align: left;">
                                              <input name="des_2" class="form-control" rows="5" placeholder="des_2">
                                            </div>
                                         </li>

                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="link_1" placeholder="link_1">
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="link_2" placeholder="link_2">
                                              </div>
                                         </li>
                          </ul>
      							      <button type="submit" class="x-create">Tạo</button>
      							     </div>
                                   
									   </div>
		         
							        </div>
							      </form>
		         	</div>	 
                  @if(isset($slide_types))
                  @foreach($slide_types as $key => $slide)
                  <div class="col-sm-6 col-md-4">
                <form ui-jp="parsley" action="{{route('edit.slide.types', [$slide->id])}}" method="post">
                    <div class="box">
                      <div class="box-header">
                        
                          <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <span class="close-slide-type pull-right" data-id="{{ $slide->id }}">×</span>
                            
                            <label></label>
                            <input type="text" class="form-control  name-slide" name="name" value="{{ $slide->name }}">   
                          </div>               
                           <div class=" text-right">
                               <ul class="list no-border p-b">
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="img_1" value="{{ $slide->img_1 }}" placeholder="img_1">
                                          </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="img_2" value="{{ $slide->img_2 }}" placeholder="img_2">
                                          </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="img_3" value="{{ $slide->img_3 }}" placeholder="img_3">
                                          </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="text_1" value="{{ $slide->text_1 }}" placeholder="text_1">
                                          </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="text_2" value="{{ $slide->text_2 }}" placeholder="text_2">
                                          </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="text_3" value="{{ $slide->text_3 }}" placeholder="text_3">
                                          </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="text_4" value="{{ $slide->text_4 }}" placeholder="text_4" >
                                          </div>
                                     </li>

                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:2px;text-align: left;">
                                          <input name="des_1" class="form-control" rows="5" value="{{ $slide->des_1 }}" placeholder="des_1">
                                        </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:2px;text-align: left;">
                                          <input name="des_2" class="form-control" rows="5" value="{{ $slide->des_2 }}" placeholder="des_2">
                                        </div>
                                     </li>

                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="link_1" value="{{ $slide->link_1 }}" placeholder="link_1">
                                          </div>
                                     </li>
                                     <li class="list-item">
                                        <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                            <input class="form-control" name="link_2" value="{{ $slide->link_2 }}" placeholder="link_2" >
                                          </div>
                                     </li>
                                </ul>
                          <button type="submit" class="x-create">Lưu</button>
                      </div>
                             
                  </div>
             
                      </div>
                    </form>
                  </div>  
                  @endforeach
                  @endif 
		         				<div class="col-sm-6">
		         					
		         				</div>
                  
	 	</div>
	 </div>
@stop
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
  <script>
  	$(".select2-multiple").select2({
      placeholder: "Chọn danh mục "
    })
  </script>
  <script> 
  $(document).on('click','.close-slide-type',function(event){
        data_id = $(this).attr('data-id');

       event.preventDefault();
       if(xacnhanxoa('Bạn có chắc muốn xóa loại Slide này không?')===false){

       }
       else{
           $.ajax({
                 type: 'post',
                 url:  '{{ route('del.slide.types') }}',
                 data: {'id': data_id},
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
       }
  }); 
  function xacnhanxoa(msg){
      var footable = $('.table').data('footable');
      

      if(window.confirm(msg)){
        return true;
      }
      else
        return false;
  };
  </script>

@endsection