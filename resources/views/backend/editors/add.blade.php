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
<form ui-jp="parsley" method="post" action="{{route('post.editor.add')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Thêm tài khoản</p>
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
     </style>
    <div class="padding" style="padding-top:0px !important; padding-bottom:0px;">
        @include('backend.partials._messages')
    </div>
    
    <div class="padding">
         <div class="row">
            <div class="col-sm-6">
                <div class="box">
                  <div class="box-header">
                    <h2>Tài khoản</h2>
                  </div>
                  <div class="box-body" style="padding-bottom:4px;padding-top:4px">
                        <div class="row">
                             <div class="form-group">
                                  <label class="col-sm-2 form-control-label">Tên tài khoản</label>
                                  <div class="col-sm-10">
                                        <input type="text" placeholder="Tên tài khoản" class="form-control thong-tin sty" name="username" value="{!! old('username') !!}"> 
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
                    <h2>Thông tin</h2>
                  </div>
                  <div class="box-body" style="padding-bottom:4px;padding-top:4px">
                        <div class="row">
                             
                             <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Email</label>
                                  <div class="col-sm-10">
                                       <input type="email"  class="form-control thong-tin sty"  placeholder="Email" name="email" value="{!! old('email') !!}"> 
                                  </div>                       
                            </div>
                            <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Số điện thoại</label>
                                  <div class="col-sm-10">
                                       <input type="text"  placeholder="Số điện thoại" class="form-control thong-tin sty" name="phone" value="{!! old('phone') !!}"> 
                                  </div>                       
                            </div>
                            <div class="form-group">
                                  <label class="col-sm-2 form-control-label ">Địa chỉ</label>
                                  <div class="col-sm-10">
                                       <input type="text"  class="form-control thong-tin sty"  placeholder="Địa chỉ" name="address" value="{!! old('address') !!}"> 
                                  </div>                       
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


    

@endsection