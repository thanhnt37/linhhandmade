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
<form ui-jp="parsley" method="post" action="{{route('admin.config.fonts.post')}}">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="app-header white box-shadow">
<div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Config font chữ</p>
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
     <?php $font_default = App\Item::where('key_item', 'font_default')->first();

           $font_custom = App\Item::where('key_item', 'font_custom')->first();
    
     ?>
    <div class="padding">
    
         <div class="row">
          
            <div class="col-sm-6">
            
                <div class="box">
                  <div class="box-header">
                    <h2>Font mặc định</h2>
                  </div>
                
                  <div class="box-body">
                        <div class="table-responsive">
                                <table class="table table-striped b-t">
                                  <tbody>
                                    
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[]" class="has-value" value="'Arial'" @if(isset($font_default) && in_array("'Arial'", explode(',', $font_default->value)) !==false) checked="" @endif><i class="dark-white" ></i></label></td>
                                      <td>Arial</td>
                                    </tr>
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[]" class="has-value" value="'Arial Black'" @if(isset($font_default) && in_array("'Arial Black'", explode(',', $font_default->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Arial Black</td>
                                    </tr>
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[]" class="has-value" value="'Comic Sans MS'" @if(isset($font_default) && in_array("'Comic Sans MS'", explode(',', $font_default->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Comic Sans MS</td>
                                    </tr>
                                     
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[]" class="has-value" value="'Courier New'"  @if(isset($font_default) && in_array("'Courier New'", explode(',', $font_default->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Courier New</td>            
                                    </tr>
                                    <tr>
                                      <td style="width: 5%" ><label class="ui-check m-a-0"><input type="checkbox" name="post[]" class="has-value" value="'Tahoma'" @if(isset($font_default) && in_array("'Tahoma'", explode(',', $font_default->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Tahoma</td>
                                    </tr>
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[]" class="has-value" value="'Times New Roman'" @if(isset($font_default) && in_array("'Times New Roman'", explode(',', $font_default->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Times New Roman</td>     
                                    </tr>
                                    <tr>
                                      
                                  </tbody>
                                </table>
                              </div>
                  </div>
                 
           </div>
             
      </div>
            <div class="col-sm-6">
            
                 <div class="box">
                  <div class="box-header">
                    <h2>Font Roboto</h2>
                  </div>
                  <div class="box-body">
                        <div class="table-responsive">
                                <table class="table table-striped b-t">
                                  <tbody>
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post1[]" class="has-value" value="'Roboto'" @if(isset($font_custom) && in_array("'Roboto'", explode(',', $font_custom->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Roboto</td>
                                     </tr>
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post1[]" class="has-value" value="'Roboto Light'" @if(isset($font_custom) && in_array("'Roboto Light'", explode(',', $font_custom->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Roboto Light</td>
                                    </tr>
                                      
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post1[]" class="has-value" value="'Roboto Regular'" @if(isset($font_custom) && in_array("'Roboto Regular'", explode(',', $font_custom->value)) !==false) checked="" @endif><i class="dark-white"></i></label></td>
                                      <td>Roboto Regular</td>
                                      
                                    </tr>
                                    <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post1[]" class="has-value" value="'Roboto Bold'" @if(isset($font_custom) && in_array("'Roboto Bold'", explode(',', $font_custom->value)) !==false) checked="" @endif ><i class="dark-white"></i></label></td>
                                      <td>Roboto Bold</td>
                                  
                                    </tr>
                                     <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post1[]" class="has-value" value="'Roboto Black'" @if(isset($font_custom) && in_array("'Roboto Black'", explode(',', $font_custom->value)) !==false) checked="" @endif ><i class="dark-white"></i></label></td>
                                      <td>Roboto Black</td>
                                  
                                    </tr>
                                    
                                    
                                    
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