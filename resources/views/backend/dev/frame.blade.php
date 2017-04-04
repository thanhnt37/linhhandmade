@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('summernote/dist/summernote.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
   <style type="text/css">
    h2{
          font-family: "Roboto";
          font-size: 10pt !important;
    }
   .box-body {
    padding: 0rem !important;
  }
  </style>
@endsection
@section('content')
<form ui-jp="parsley" method="post" action="{{route('admin.config.frame.post')}}">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Thuộc tính không được xóa</p>
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
     <?php 
     $attribute = App\Attribute::where('type', 1)->where('avaiable',0)->get();
     $attribute_v = App\Attribute::where('type', 1)->where('avaiable',1)->get();

     $frame = App\Item::where('key_item', 'config_frame_attribute')->first();
    
     ?>
    <div class="padding">
    
         <div class="col-sm-6 ">
                <div class="box">
                  <div class="box-header">
                    <h2>Định tính</h2>
                  </div>
                  <div class="box-body">
                        <div class="table-responsive">
                          <table class="table table-striped b-t">
                            <tbody>
                              @foreach($attribute as $item) 
                              <tr>
                                <td style="width: 5%"><label class="ui-check m-a-0">
                                  <input type="checkbox" name="attr[]" class="has-value d-attr-config" @if($item->isDelete == 1) checked="" @endif value="{!! $item->id !!}"><i class="dark-white" >
                                </i>
                                </label>
                                </td>
                                <td>
                                   {!! $item->name !!}
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                </div>
            </div>
          <div class="col-sm-6 ">
                <div class="box">
                  <div class="box-header">
                    <h2>Định lượng</h2>
                  </div>
                  <div class="box-body">
                        <div class="table-responsive">
                                <table class="table table-striped b-t">
                                  <tbody>
                                    @foreach($attribute_v as $item) 
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0">
                                        <input type="checkbox" name="attr[]" class="has-value d-attr-config" @if($item->isDelete == 1) checked="" @endif value="{!! $item->id !!}"><i class="dark-white" >
                                      </i>
                                      </label>
                                      </td>
                                      <td>
                                         {!! $item->name !!}
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
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