<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Đăng nhập quản trị website </title>
  <meta name="description" content="Admin, Dashboard" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="{{URL::asset('backend/assets/animate.css/animate.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('backend/assets/glyphicons/glyphicons.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('backend/assets/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('backend/assets/material-design-icons/material-design-icons.css')}}" type="text/css" />

  <link rel="stylesheet" href="{{URL::asset('backend/assets/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="{{URL::asset('backend/assets/styles/app.css')}}" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="{{URL::asset('backend/assets/styles/font.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('backend/assets/styles/fonts.css')}}" type="text/css" />
  <style type="text/css">
    .alert{
      font-size: 10pt !important;
      font-family: "Roboto" !important;
    }
    .company{
          padding-top: 31px;
          text-align: center;
          text-transform: uppercase;
          font-size: 18pt;
          font-family: Roboto Bold;
    }
    .p-y-md {
        padding-top: 4.5rem !important;
        padding-bottom: 1.5rem !important;
    }
  </style>
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->
  <div class="center-block w-xxl w-auto-xs p-y-md">
    <div class="navbar company">
      <div class=""><?php $name= App\System::first(); ?>
        {{isset($name)? $name->domain :'Domain.com'}}
      </div>
    </div>
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <div class="m-b text-sm">
        Đăng nhập vào hệ thống quản trị
      </div>
      @if ($errors->any())
      <div class="alert alert-danger alert-dismissable margin5">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error:</strong> 
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
      @endif

      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissable margin5">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Success:</strong> {{ $message }}
      </div>
      @endif

      @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-dismissable margin5">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Error:</strong> {{ $message }}
      </div>
      @endif

      @if ($message = Session::get('warning'))
      <div class="alert alert-warning alert-dismissable margin5">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Warning:</strong> {{ $message }}
      </div>
      @endif

      @if ($message = Session::get('info'))
      <div class="alert alert-info alert-dismissable margin5">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Info:</strong> {{ $message }}
      </div>
      @endif

      <form name="form" action="{{url('quan-tri/dang-nhap')}}" method="post" >
         <input type="hidden" class="form-control"  name="_token" value="{{csrf_token()}}"/>
        <div class="md-form-group float-label">
          <input type="text" class="md-input"  name="username" required>
          <label style="font-size:10pt;">Tài khoản</label>
        </div>
        <div class="md-form-group float-label">
          <input type="password" class="md-input" name="password" required>
          <label  style="font-size:10pt;">Mật khẩu</label>
        </div>      
        <button type="submit" class="btn primary btn-block p-x-md">Đăng nhập</button>
      </form>
    </div>

   {{--  <div class="p-v-lg text-center">
      <div class="m-b"><a ui-sref="access.forgot-password" href="#" class="text-primary _600">Quên mật khẩu</a>
      </div>
    </div>
  </div> --}}

<!-- ############ LAYOUT END-->

  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="{{URL::asset('backend/libs/jquery/jquery/dist/jquery.js')}}"></script>
<!-- Bootstrap -->
  <script src="{{URL::asset('backend/libs/jquery/tether/dist/js/tether.min.js')}}"></script>
  <script src="{{URL::asset('backend/libs/jquery/bootstrap/dist/js/bootstrap.js')}}"></script>
<!-- core -->
  <script src="{{URL::asset('backend/libs/jquery/underscore/underscore-min.js')}}"></script>
  <script src="{{URL::asset('backend/libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
  <script src="{{URL::asset('backend/libs/jquery/PACE/pace.min.js')}}"></script>

  <script src="{{URL::asset('backend/html/scripts/config.lazyload.js')}}"></script>

  <script src="{{URL::asset('backend/html/scripts/palette.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-load.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-jp.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-include.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-device.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-form.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-nav.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-scroll-to.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ui-toggle-class.js')}}"></script>

  <!-- <script src="{{URL::asset('backend/html/scripts/app.js')}}"></script> -->

  <!-- ajax -->
  <script src="{{URL::asset('backend/libs/jquery/jquery-pjax/jquery.pjax.js')}}"></script>
  <script src="{{URL::asset('backend/html/scripts/ajax.js')}}"></script>
<!-- endbuild -->
</body>
</html>
