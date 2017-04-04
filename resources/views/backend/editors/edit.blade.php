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
<form ui-jp="parsley" method="post" action="{{route('post.editor.edit',['id'=>$admin['id']])}}" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Sửa tài khoản</p>
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
      .no-border{
        border: 0px !important;
        background-color: rgba(1,1,1,0);
      }
      .s-img{
        max-width:100%;
        min-width:100px;
        background-color:#F0F0F0;
        border:1px solid #E7E7E7;
        position: relative;
        margin-right: -11px;
        padding:0px !important;
      }
      .s-img img{
        max-height: 100px;

      }
      .s-img span{
          position: absolute;
          top: 35px;
          left: calc(50% - 15px);
      }
      .sty{
        background-color: #F0F0F0 !important;
      }
     </style>

    <div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
        @include('backend.partials._messages')
    </div>
    <div class="padding">
         <div class="row">
            <div class="col-sm-6">
                <div class="box">
                  <div class="box-header">
                    <h2>Thông tin tài khoản</h2>
                  </div>
                  <div class="box-body" style="padding-bottom:4px;">
                        <div class="row">
                            
                             <div class="form-group" style="margin-bottom:0px">
                                   <label class="col-sm-2 form-control-label ">Avatar</label>
                                   <label class="col-ms-10 s-img no-border" style="margin-left:11px;">
                                          <img  type="hidden"@if(sizeof($admin)) src="@if($admin->image) {{ asset('').$admin->image }} @else https://placehold.it/100x100 @endif" @else src="https://placehold.it/100x100" @endif>
                                          <input disabled="" onchange="reUploadImg(this)" type="file" name="fimg"
                                          style="display:none" >
                                    </label>                    
                            </div>
                             <div class="form-group">
                                  <label class="col-sm-2 form-control-label">Tên tài khoản</label>
                                  <div class="col-sm-10">
                                        <input type="text" disabled="" placeholder="Tên tài khoản" class="form-control thong-tin sty" name="username" value="{!! isset($admin['username']) ? $admin['username'] : null !!}"> 
                                  </div>                       
                            </div>
                            <div class="form-group" >
                                  <label class="col-sm-2 form-control-label">Password</label>
                                  <div class="col-sm-10">
                                       <input type="password"  class="form-control thong-tin"  placeholder="Password" name="password" > 
                                  </div>                       
                            </div>
                            <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Confirm Password</label>
                                  <div class="col-sm-10">
                                       <input type="password"   placeholder="Confirm Password" class="form-control thong-tin" name="confirm_pass" > 
                                  </div>                       
                            </div>
                       </div>  
                  </div>   
           </div>  
      </div>
      <div class="col-sm-6">
                <div class="box">
                  <div class="box-header">
                    <h2>Thông tin cá nhân</h2>
                  </div>
                  <div class="box-body" style="padding-bottom:4px;padding-top:4px">
                        <div class="row">
                             
                             <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Email</label>
                                  <div class="col-sm-10">
                                       <input type="email" disabled="" class="form-control thong-tin sty"  placeholder="Email" name="email" value="{!! isset($admin['email']) ? $admin['email'] : null !!}"> 
                                  </div>                       
                            </div>
                            <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Số điện thoại</label>
                                  <div class="col-sm-10">
                                       <input type="text" disabled="" placeholder="Số điện thoại" class="form-control thong-tin sty" name="phone" value="{!! isset($admin['phone']) ? $admin['phone'] : null !!}"> 
                                  </div>                       
                            </div>
                            <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Địa chỉ</label>
                                  <div class="col-sm-10">
                                       <input type="text" disabled="" class="form-control thong-tin sty"  placeholder="Địa chỉ" name="address" value="{!! isset($admin['address']) ? $admin['address'] : null !!}"> 
                                  </div>                       
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