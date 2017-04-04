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
<form ui-jp="parsley" method="post" action="{{route('admin.system.post.edit')}}" enctype="multipart/form-data">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Hệ Thống</p>
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
      .attr{
        background-color: #F0F0F0;
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
           <div class="box" style="padding-bottom:22px;">
            <div class="box-body" style="padding:0px 12px;">
            <div class="row">
            <div class="box-header" style="margin-bottom:10px;padding:0px 0px 0px 16px !important; " >
                    <h2 style="font-family:'Roboto Black';line-height: 30px; padding-top: 8px;padding-bottom: 8px; ">Thông Tin</h2>
            </div>
              <input type="hidden" value="{{csrf_token()}}" name="_token">
               <div class="box-body" style="padding:0 16px;" >

                <div >
                  <div class="row" >

               <div class="form-group">
                     <label class="col-sm-2 form-control-label " >Logo</label>
                     <label class="col-ms-10 s-img no-border 
                      " >
                      <img  type="hidden" @if(sizeof($system)) src="@if($system->img_logo) {{ asset('').$system->img_logo }} @else https://placehold.it/130x40 @endif" @else 
                       src="https://placehold.it/130x40"   @endif
                      >
                            <input onchange="reUploadImg(this)" type="file" name="img"
                            style="display:none" >
                      </label>
                      <input type="hidden" value="{{csrf_token()}}" name="_token">
                      
                      <div class="form-group">
                            <label class="col-sm-2 form-control-label">Domain</label>
                            <div class="col-sm-10">
                                  <input type="text" placeholder="Tên miền website" class="form-control thong-tin" name="domain"value="{{isset($system) ? $system->domain:''  }}" required=""> 
                            </div>                       
                      </div>
                      <div class="form-group" >
                            <label class="col-sm-2 form-control-label">Đại diện</label>
                            <div class="col-sm-10">
                                 <input  type="text"  class="form-control thong-tin"  placeholder="Họ tên" name="full_name" value="{{isset($system) ? $system->full_name:''  }}"> 
                            </div>                       
                      </div>
                      <div class="form-group">
                            <label class="col-sm-2 form-control-label ">Email</label>
                            <div class="col-sm-10">
                                 <input type="email"   placeholder="Email" class="form-control thong-tin" name="s_email" value="{{isset($system) ? $system->email:''  }}"> 
                            </div>                       
                      </div>
                      <div class="form-group">
                            <label class="col-sm-2 form-control-label ">Phone</label>
                            <div class="col-sm-10">
                                 <input type="text"  placeholder="Số điện thoại" class="form-control thong-tin" name="s_phone" value="{{isset($system) ? $system->phone:''  }}"> 
                            </div>                       
                      </div>
                      <div class="form-group">
                            <label class="col-sm-2 form-control-label ">Địa chỉ</label>
                            <div class="col-sm-10">
                                 <input type="text" class="form-control thong-tin"  placeholder="Địa chỉ" name="s_address" value="{{isset($system) ? $system->address:''  }}"> 
                            </div>                       
                      </div>  
                    </div>
                  </div>
              </div>

              </div>
              
             
         </div>  
     </div>
  
                
                 
          </div>
          </div>

          <div class="col-sm-6">
           <div class="box" style="padding-bottom:6px;">
            <div class="box-body" style="padding:0px 12px;">
            <div class="row">
              @if(session('admin')->level == 1)
              <div class="box-header" style="padding:0px !important;padding-bottom:0px !important;border:0px !important">
                    <h2 style="font-family:'Roboto Black';line-height: 30px;border-bottom:1px solid #F0F0F0;padding-left:16px;padding-top:8px;padding-bottom:8px;">Hộp Thư</h2>
              </div>
             <div class="box-header" style="padding-top:0px !important;padding-bottom:0px !important;border:0px !important;">
                <h2 style="padding:16px 0px;border-bottom:1px solid #F0F0F0;">Trung tâm</h2>
              </div>
              <div class="box-body" style="padding:0 16px;" >

                <div style="padding:0px;border-bottom:1px solid #F0F0F0;">
                  <div class="row" >
                  <div class="form-group">
                        <label class="col-sm-2 form-control-label ">Email</label>
                        <div class="col-sm-10">
                             <input type="email" style="background-color:#F0F0F0 !important;"  placeholder="Email Send" class="form-control thong-tin" name="email_send" value="{{isset($system) ? $system->email_send:''  }}" autocomplete="off"> 
                        </div>                       
                  </div>
                   <div class="form-group" >
                          <label class="col-sm-2 form-control-label">Password</label>
                          <div class="col-sm-10">
                               <input type="password"  style="background-color:#F0F0F0 !important;" placeholder="MK Email Send"  class="form-control thong-tin" name="EMpassword" value="{{isset($system) ? $system->email_password:''  }}"   autocomplete="off" > 
                          </div>                       
                    </div>
                </div>
                </div>

              </div>

            <!--   <div class="box-header" style="padding-top:0px !important;padding-bottom:0px !important;border:0px !important;" >
                <h2 style="padding:16px 0px;border-bottom:1px solid #F0F0F0;">Nhận thông tin</h2>
              </div>
              <div class="box-body" style="padding:0px 16px 0px 16px">
                <div class="row">
                   <div class="form-group">
                        <label class="col-sm-2 form-control-label ">Form</label>
                        <div class="col-sm-10">
                             <input type="email"   placeholder="Email Nhận" class="form-control thong-tin" name="email_form" value="{{isset($system) ? $system->email_form:'' }}"> 
                        </div>                       
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 form-control-label ">Đơn Hàng</label>
                        <div class="col-sm-10">
                             <input type="email"   placeholder="Email Đơn Hàng" class="form-control thong-tin" name="email_order" value="{{isset($system) ? $system->email_order:'' }}"> 
                        </div>                       
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 form-control-label ">Hết Hàng</label>
                        <div class="col-sm-10">
                             <input type="email"   placeholder="Email Hết Hàng" class="form-control thong-tin" name="email_hethang" value="{{isset($system) ? $system->email_hethang:'' }}"> 
                        </div>                       
                  </div>
                </div>
              </div> -->
              @endif
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