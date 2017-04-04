@extends('backend.layouts.default')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/libs/jquery/nestable/jquery.nestable.css') }}" type="text/css" />
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
<div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->
    <div class="padding">
       <div class="row">
          
          <style type="text/css">
            .cate_edit{
              display:inline-block; 
              float:right;
              margin-right: 10px;
              /*color: blue;*/
            }
            .cate_edit i{
              font-size: 13pt !important;
            }
            .cate_name{
              display:inline-block
            }
          </style>
            <?php
                      $list_categories = App\Category::where(['parent_id'=>0])->get();

            ?>
        
            <div class="col-sm-6">
            <p class="m-a-0 m-b">Danh mục bài viết</p>
            <div  class="dd">
              <ol class="dd-list dd-list-handle">
                @foreach($list_categories as $v0)
                   <li class="dd-item" data-id="{{$v0->id}}">
                    <div class="dd-content box">
                      <div class="dd-handle">
                        <i class="fa fa-reorder text-muted"></i>
                      </div>
                      <div>
                          <div class="cate_name">{{$v0->name}}</div>
                          <div class="cate_edit">
                            <a href="{{route('category.detail',['id'=>$v0->id])}}">
                              <i class="material-icons md-24">&#xe02f;</i>
                            </a>
                          </div>
                          <div class="cate_edit">
                            <a href="{{route('category.edit',['id'=>$v0->id])}}">
                              <i class="material-icons md-24">&#xe22b;</i>
                            </a>
                          </div>
                      </div>
                    </div>
                    <?php 
                    if (!function_exists('show_child'))
                    {
                      function show_child($object){
                          $d = $object->subcategory;
                          if($d){
                            ?>
                              <ol class="dd-list dd-list-handle">
                            <?php
                          }
                          foreach ($d as $v) {
                             ?>
                              <li class="dd-item" data-id="{{$v->id}}">
                                  <div class="dd-content box">
                                    <div class="dd-handle">
                                      <i class="fa fa-reorder text-muted"></i>
                                    </div>
                                    <div>
                                        <div class="cate_name">{{$v->name}}</div>
                                        <div class="cate_edit">
                                          <a href="{{route('category.detail',['id'=>$v->id])}}">
                                            <i class="material-icons md-24">&#xe02f;</i>
                                          </a>
                                        </div>
                                        <div class="cate_edit">
                                          <a href="{{route('category.edit',['id'=>$v->id])}}">
                                            <i class="material-icons md-24">&#xe22b;</i>
                                          </a>
                                        </div>
                                    </div>
                                  </div>
                                  <?php
                                  show_child($v);
                                  ?>
                              </li>
                             <?php
                              
                          }
                          if($d){
                            ?>
                              </ol>
                            <?php
                          }
                      };
                    }
                      show_child($v0);
                    ?>
                </li>
                @endforeach
              </ol>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/nestable/jquery.nestable.js') }}"></script>
  <script>
    $('.dd').nestable({ /* config options */ });
    $('.dd').on('change', function() {
        console.log($('.dd').nestable('serialize'));
    });
  </script>

@endsection