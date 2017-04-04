@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
   <style type="text/css">
     option:disabled {
        background: #dddddd;
    }
   </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
    <!-- Open side - Naviation on mobile -->
    {{-- <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
      <i class="material-icons">&#xe5d2;</i>
    </a>
    <!-- / -->

    <!-- Page title - Bind to $state's title -->
    <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>

    <!-- navbar right -->
    <ul class="nav navbar-nav pull-right">
      <li class="nav-item dropdown pos-stc-xs">
        <a class="nav-link" href data-toggle="dropdown">
          <i class="material-icons">&#xe7f5;</i>
          <span class="label label-sm up warn">3</span>
        </a>
         @include('backend.partials.notification')
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link clear" href data-toggle="dropdown">
          <span class="avatar w-32">
            <img src="{{url('backend/assets/images/a0.jpg')}}" alt="...">
            <i class="on b-white bottom"></i>
          </span>
        </a>
        @include('backend.partials.user')
      </li>
      <li class="nav-item hidden-md-up">
        <a class="nav-link" data-toggle="collapse" data-target="#collapse">
          <i class="material-icons">&#xe5d4;</i>
        </a>
      </li>
    </ul>
    <!-- / navbar right -->

    <!-- navbar collapse -->
    <div class="collapse navbar-toggleable-sm" id="collapse">
      <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
      <!-- link and dropdown -->
      <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href data-toggle="dropdown">
            <i class="fa fa-fw fa-plus text-muted"></i>
            <span>New</span>
          </a>
          <div ui-include="'../views/blocks/dropdown.new.html'"></div>
        </li>
      </ul>
      <!-- / -->
    </div> --}}
    <!-- / navbar collapse -->
</div>
 </div>
 
   <div class="app-body" id="view">
    <div class="padding">
     <div class="row">
        <div class="col-sm-12">
          <form ui-jp="parsley" action="{{route('menu.edit.post')}}" method="post" enctype="multipart/form-data">
            <div class="box">
              <div class="box-header">
                <h2>Chỉnh sửa menu</h2>

              </div> 

              <div class="box-body">
          <div class="row">
              <div class="col-sm-6">
                    @include('backend.partials._messages')
                    <?php
                      $list_menus = App\Menu::where(['parent_id'=>0])->get();

                    ?>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$menu->id}}">
                            <div class="form-group">
                            <label>Tên menus</label>
                            <input type="text" class="form-control" name="name" required  value="{{$menu->name}}">                        
                          </div>
                          <div class="form-group">
                            <label>Đường dẫn</label>
                            <input type="text" class="form-control" name="link" value="{{$menu->link}}" >                        
                          </div>
                          <div class="form-group">
                            <label>Ảnh mô tả menu (nếu có)</label>
                            <?php if(strlen($menu->img)):?>
                            <img src="{{url($menu->img)}}" style="width:100%;height:auto" >
                            <?php endif;?>
                            <input type="file" class="form-control" name="img">                        
                          </div>
                         

                          <div class="form-group">
                            <?php $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                          <label for="single">Lựa chọn vị trí lưu</label>
                          <select id="single" class="form-control select2" name="parent">
                              <option  @if($menu->parent_id ==0) selected @endif value="0">Mặc định</option>
                              @foreach($list_menus as $v0)
                              <option  @if($menu->id == $v0->id) disabled @endif   @if($menu->parent_id ==$v0->id) selected @endif value="{{$v0->id}}">{{$v0->name}}</option>
                              @if($v0->subcategory)
                                   @foreach($v0->subcategory as $v1)
                                                        <option  @if($menu->id == $v1->id || $menu->id == $v0->id) disabled @endif   @if($menu->parent_id ==$v1->id) selected @endif value="{{$v1->id}}">{{$space}}{{$v1->name}}</option>
                                                         @if($v1->subcategory)
                                       @foreach($v1->subcategory as $v2)
                                                            <option  @if($menu->id == $v1->id || $menu->id == $v0->id || $menu->id == $v2->id) disabled @endif  @if($menu->parent_id ==$v2->id) selected @endif value="{{$v2->id}}">{{$space.$space}}{{$v2->name}}</option>
                                                            @if($v2->subcategory)
                                           @foreach($v2->subcategory as $v3)
                                                                <option  @if($menu->id == $v1->id || $menu->id == $v0->id || $menu->id == $v2->id || $menu->id == $v3->id) disabled @endif  @if($menu->parent_id ==$v3->id) selected @endif value="{{$v3->id}}">{{$space.$space.$space}}{{$v3->name}}</option>
                                                                @if($v3->subcategory)
                                               @foreach($v3->subcategory as $v4)
                                                                    <option disabled @if($menu->parent_id ==$v4->id) selected @endif  value="{{$v4->id}}">{{$space.$space.$space.$space}}{{$v4->name}}</option>
                                                                 @endforeach
                                                             @endif
                                                             @endforeach
                                                         @endif
                                                         @endforeach
                                                     @endif
                                                     @endforeach
                                                 @endif
                              @endforeach
                          </select>
                      </div>
                   <div class="dker p-a text-right">
                          <button type="submit" class="btn info">Lưu lại</button>
                        </div>
                    </div>   
                    <div class="col-sm-6">
                      
                    </div>
                  </div>
             
            </div>
          </form>
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

@endsection