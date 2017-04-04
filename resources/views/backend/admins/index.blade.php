@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('summernote/dist/summernote.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
   <style type="text/css">
    h2{
          font-family: "Roboto-Bold";
          font-size: 10.5pt !important;
    }
   
      
   </style>
@endsection
@section('content')
<form ui-jp="parsley" method="post" action="{{route('admin.post.edit')}}" enctype="multipart/form-data">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Thông tin cá nhân</p>
      </div>
      <div style="float:right;margin-top:10px;">
     
    <button type="submit" name="submit"  value="post" class="btn success" style="
    padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 8px;font-family: 'Roboto-Bold';
    min-width:100px; background-color:#738CEC">Lưu</button>
      </div>
       
    <!-- / navbar collapse -->
</div>
</div>

 
   <div class="app-body" id="view">
     <style type="text/css">
      .alert{
        margin-top:20px;
        margin-bottom: 0px;
      }
      label {
          font-size: 10pt;
          color: #404040;
      }
      .form-control{
        margin-bottom: 15px !important;
        border: 1px solid #E7E7E7 !important; 
       
      }
      .thong-tin{
          background-color: #fff !important;
      }
      .box{
        min-height: 275px;
      }
      .s-img{
        max-width:100%;
        min-width:100px;
        background-color:#F0F0F0;
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
      .s-img1{
        max-width:100%;height:40px;min-width:130px;background-color:#F0F0F0;
        border:1px solid #E7E7E7;
        position: relative;

      }
       .s-img1 img{
        max-height: 100px;
      }
      .s-img1 span{
          position: absolute;
          top: 35px;
          left: calc(50% - 15px);
      }
      
      .no-border{
        border: 0px !important;
        background-color: rgba(1,1,1,0);
      }
     </style>
    <div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
        @include('backend.partials._messages')
    </div>
     <?php $system = App\System::first();

     ?>

    <div class="padding">
    
         <div class="row">
          
          <div class="col-sm-6">
            
                <div class="box" style="padding-bottom:37px;">
                  <div class="box-header" style="margin-bottom:0px;">
                    <h2 style="font-family:'Roboto Black';">Thông Tin</h2>
                  </div>
                  <div class="box-body" style="padding-bottom:2px;">
                          <div class="row">
                   <div class="form-group">
                                    <label class="col-sm-2 form-control-label ">Email</label>
                                    <div class="col-sm-10">
                                         <input type="email"  class="form-control thong-tin" name="email" value="{!! $admin->email !!}"> 
                                    </div>                       
                              </div>
                               <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Phone</label>
                                  <div class="col-sm-10">
                                       <input type="text"  class="form-control thong-tin" name="phone" value="{{$admin->phone}}"> 
                                  </div>                       
                            </div>
                            <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Địa chỉ</label>
                                  <div class="col-sm-10">
                                       <input type="text" class="form-control thong-tin" name="address" value="{{$admin->address}}"> 
                                  </div>                       
                            </div>
                            </div>
                            </div>
                 
          </div>
             
           </div>
           <div class="col-sm-6">
            
                <div class="box">
                    <div class="box-header">
                      <h2>Tài khoản</h2>
                    </div>
                    
                    <div class="box-body" style="padding-bottom:0px;">
                          <div class="row">
                           
                               <input type="hidden" value="{{csrf_token()}}" name="_token">
                               <div class="form-group" style="margin-bottom:0px">
                                   <label class="col-sm-2 form-control-label ">Avatar</label>
                                   <label class="col-ms-10 s-img no-border" style="margin-left:11px;">
                                          <img style="margin-left:-11px;" type="hidden"@if(sizeof($admin)) src="@if($admin->image) {{ asset('').$admin->image }} @else https://placehold.it/100x100 @endif" @else src="https://placehold.it/100x100" @endif>
                                          <input onchange="reUploadImg(this)" type="file" name="fimg"
                                          style="display:none" >
                                    </label>                    
                            </div>
                               <div class="form-group">
                                    <label class="col-sm-2 form-control-label">Tài khoản</label>
                                    <div class="col-sm-10">
                                          <input type="text" disabled="" class="form-control" name="username" value="{{$admin->username}}"> 
                                    </div>                       
                              </div>
                              <div class="form-group" >
                                    <label class="col-sm-2 form-control-label">Mật khẩu</label>
                                    <div class="col-sm-10">
                                         <input type="password"  class="form-control thong-tin" name="password"> 
                                    </div>                       
                              </div>
                             
                              
                         </div>  
                     </div>
                
                </div>
            </div>
        
   </div>
</form>
@stop
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/select2/dist/js/select2.min.js') }}"></script>
 
  <script src="{{ asset('summernote/dist/summernote.min.js') }}"></script>
  <script src="{{ asset('summernote/dist/lang/summernote-vi-VN.js') }}"></script>
  <script src="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

<script>
  
  function reUploadImg(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(input).prev().attr('src', e.target.result);
            $(input).parent().css('background-color','#fff');
            $(input).parent().css('border','0px');
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
</script>
    

@endsection