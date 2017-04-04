
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
      <p>Quản lý Form</p>
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
							  <form ui-jp="parsley" action="{{route('dev.form.post')}}" method="post">
						        <div class="box">
						          <div class="box-header">
						            <input type="hidden" name="_token" value="{{csrf_token()}}">
					          		    <div class="form-group">
							              <label></label>
							              <input type="text" class="form-control name-slide" name="name" placeholder="Nhập tên Form">                  
							               </div>
      								   <div class=" text-right">
      							     <ul class="list no-border p-b">
                                        
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_1" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_2" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_3" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_4" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_5" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_6" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_7" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_8" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_9" >
                                              </div>
                                         </li>
                                         <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_10" >
                                              </div>
                                         </li>
                                        
                                       

                                        
                          </ul>
      							      <button type="submit" class="x-create">Tạo</button>
      							     </div>
                                   
									   </div>
		         
							        </div>
							      </form>
		         	</div>	 
                <?php $formtype = App\FormType::all();?>
                  @if(isset($formtype))
                  @foreach($formtype as $key => $item)
                  <div class="col-sm-6 col-md-4">
                <form ui-jp="parsley" action="{{route('edit.form.types', [$item->id])}}" method="post">
                    <div class="box">
                      <div class="box-header">
                        
                          <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <span class="close-slide-type pull-right" data-id="{{ $item->id }}">×</span>
                            
                            <label></label>
                            <input type="text" class="form-control  name-slide" name="name" value="{{ $item->name }}">   
                          </div>   <?php $ten =explode(',', $item->note) ;?>            
                           <div class=" text-right">
                               <ul class="list no-border p-b">
                                    @for($i=0; $i<10; $i++)
                                      @if($i<$item->count)
                                    <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                               <input type="text" class="form-control" name="text[]" value="{{$ten[$i]}}">
                                             </div>
                                      </li> 
                                      
                                      @else
                                      <li class="list-item">
                                            <div class="form-group" style="margin-bottom:5px;text-align: left;">
                                                <input class="form-control" name="text[]" placeholder="text_{{$i+1}}">
                                            </div>
                                      </li>
                                      @endif      
                                    @endfor
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
  
  <script> 
  $(document).on('click','.close-slide-type',function(event){
        data_id = $(this).attr('data-id');

       event.preventDefault();
       if(xacnhanxoa('Bạn có chắc muốn xóa loại Form này không?')===false){

       }
       else{
           $.ajax({
                 type: 'post',
                 url:  '{{ route('del.form.types') }}',
                 data: {'id': data_id},
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