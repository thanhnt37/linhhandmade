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

<form ui-jp="parsley" method="post" action="{{route('editor.user.add.permission')}}">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="id" value="{{$editor->id}}">
<div class="app-header white box-shadow">
  <div class="navbar">
    <div style="float:left;" class="title_form">
        <p>Phân quyền {{$editor->username}}</p>
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
     <?php  $baiviet = App\Permission::where('key', 'like', '%bai_viet')->get();
            $sanpham = App\Permission::where('key', 'like', '%san_pham')->get();
            $menu = App\Permission::where('key', 'like', '%menu')->get();
            $layout = App\Permission::where('key', 'like', '%layout')->get();
            $slide = App\Permission::where('key', 'like', '%slide')->get();
            $taikhoan = App\Permission::where('key', 'like', '%thanh_vien')->get();
            $donhang = App\Permission::where('key','like','%don_hang')->get();
            $thuoctinh = App\Permission::where('key','like','%thuoc_tinh')->get();
            $lienhe = App\Permission::where('key','like','%lien_he')->get();
            $khachhang = App\Permission::where('key','like','%khach_hang')->get();

            $check= $editor->getPermission()->lists('permissions.id')->toArray();
            $admin = App\Admins::where('id',2)->first();  
     ?>
    <div class="padding">
         <div class="row masonry-container">
            <div class="col-sm-6 item">
                <div class="box">
                  <div class="box-header">
                    <h2>Bài viết</h2>
                  </div>
                  <div class="box-body">
                        <div class="table-responsive">
                                <table class="table table-striped b-t">
                                  <tbody>
                                     @foreach ($baiviet as $v1)
                                     @if ($admin->can($v1->key))
                                        <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0">
                                      <input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}"
                                       @if(isset($check) && in_array($v1->id, $check) ) 
                                       checked
                                       @endif >
                                       <i class="dark-white" >
                                       </i>
                                      </label>
                                      </td>
                                      <td>
                                        {!! $v1->username !!}
                                      </td>
                                    </tr>
                                    @endif
                                     @endforeach
                                      <a target=""></a>
                                  </tbody>
                                </table>
                              </div>
                      </div>
                </div>
             
           </div>
          
            
            <div class="col-sm-6 item"> 
                 <div class="box">
                  <div class="box-header">
                    <h2>Sản phẩm</h2>
                  </div>
                  <div class="box-body">
                        <div class="table-responsive">   
                                <table class="table table-striped b-t">
                                  <tbody>
                                        @foreach ($sanpham as $v1)
                                            @if ($admin->can($v1->key))
                                            <tr>
                                              <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                                              <td>{{$v1->username}}</td>
                                            </tr>
                                            @endif
                                         @endforeach
                                        @foreach ($thuoctinh as $v1)
                                          @if ($admin->can($v1->key))
                                          <tr>
                                            <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                                            <td>{{$v1->username}}</td>
                                          </tr>
                                          @endif
                                        @endforeach
                                        @foreach ($donhang as $v1)
                                            @if ($admin->can($v1->key))
                                              <tr>
                                            <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                                            <td>{{$v1->username}}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($khachhang as $v1)
                                            @if ($admin->can($v1->key))
                                              <tr>
                                            <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                                            <td>{{$v1->username}}</td>
                                            </tr>
                                            @endif
                                        @endforeach

                                  </tbody>
                                </table>
                         </div>
                  </div>
             </div>
         </div>
         
      <div class="col-sm-6 item">
         <div class="box">
          <div class="box-header">
            <h2>Phân Quyền</h2>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-striped b-t">
                <tbody>
                  @foreach ($taikhoan as $v1)
                  @if ($admin->can($v1->key))
                      <tr>
                    <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                    <td>{{$v1->username}}</td>
                  </tr>
                  @endif
                   @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     
      <div class="col-sm-6 item">
        <div class="box">
          <div class="box-header">
            <h2>Menu</h2>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-striped b-t">
                <tbody>
                   @foreach ($menu as $v1)
                   @if ($admin->can($v1->key))
                      <tr>
                    <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                    <td>{{$v1->username}}</td>
                  </tr>
                  @endif
                  @endforeach
                    <a target=""></a>
                </tbody>
              </table>
            </div>
          </div>  
        </div>   
      </div>  
     
      <div class="col-sm-6 item">
        <div class="box">
          <div class="box-header">
            <h2>Form</h2>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-striped b-t">
                <tbody>
                   @foreach ($lienhe as $v1)
                   @if ($admin->can($v1->key))
                      <tr>
                    <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                    <td>{{$v1->username}}</td>
                  </tr>
                  @endif
                  @endforeach
                    <a target=""></a>
                </tbody>
              </table>
            </div>
          </div>  
        </div>   
      </div>
      <div class="col-sm-6 item">
             <div class="box">
                <div class="box-header">
                    <h2>Slide</h2>
                </div>
                <div class="box-body">
                        <div class="table-responsive">
                                <table class="table table-striped b-t">
                                  <tbody>
                                    @foreach ($slide as $v1)
                                    @if ($admin->can($v1->key))
                                        <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                                      <td>{{$v1->username}}</td>
                                    </tr>
                                    @endif
                                     @endforeach
                                  </tbody>
                                </table>
                          </div>
                  </div>
           </div>
        </div>
          
          <div class="col-sm-6 item">
                 <div class="box">
                  <div class="box-header">
                    <h2>Layout</h2>
                  </div>
                  <div class="box-body">
                        <div class="table-responsive">
                                <table class="table table-striped b-t">
                                  <tbody>
                                    @foreach ($layout as $v1)
                                    @if ($admin->can($v1->key))
                                        <tr>
                                      <td style="width: 5%"><label class="ui-check m-a-0"><input type="checkbox" name="post[id][]" class="has-value" value="{{$v1->id}}" @if(isset($check) && in_array($v1->id, $check) !==false) checked="" @endif ><i class="dark-white" ></i></label></td>
                                      <td>{{$v1->username}}</td>
                                    </tr>
                                    @endif
                                     @endforeach
                                  </tbody>
                                </table>
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