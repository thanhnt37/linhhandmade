@extends('backend.layouts.default')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" />
    <style type="text/css">
      .list-item{
        padding-left: 0px;
        padding-right: 0px;

      }
      .form-group input{
        padding-top: 0px  !important;
        padding-bottom: 0px !important;
        min-height: 1.5rem;
      }
      input{
        color: #A6A6A6 !important;
      }
      label{
        margin-bottom: 0px;
      }
      .box-body{
        padding-top: 0px;
        padding-bottom: 0px;
      }
       .box-body ul{
        padding-top: 0px !important;
        margin-bottom: 0px !important;
        padding-bottom: 0px !important;
      }
         .box-body ul li:first-child{
          /*padding-top: 0px !important;*/
        }
      .box-header{
        border-bottom: 0px;
      }
      .box-footer{
        padding-top: 5px;
      }
       .box-footer button{
        background-color: #F2F2F2;
        color: #A6A6A6;
        font-size: 8pt;
        min-width:60px;
        padding-top:6px;
        padding-bottom:6px
      }
      .box-header h3{
        font-size: 10pt;
      }
      .box-footer button:hover{
        background-color: #FFC000;
        color: #fff;
      }
       @media (min-width: 991px){
        .title_form{
            margin-left: 10px !important;
            margin-top: 16px;
            font-family: "Roboto Black"
        }
      }
      textarea{
        font-size: 9pt !important;
      }
      .form-group > label.bg{
        max-width: 100%;
        height: 60px;
        min-width: 100px;
        background-color: #F0F0F0;
        border: 1px solid #E7E7E7;
        position: relative;
      }
      .form-group > label span{
        display: none;
      }
      .form-group > label.bg span{
        position: absolute;
        width: 100%;
        text-align: center;
        top: 20px;
        display: block;
      }
      .box-footer button{
        font-size: 10pt;
        font-weight: 400;
        padding-top: 4px;
        padding-bottom: 4px;
      }
       .box-footer button:hover{
        background-color: #95C760 !important;
       }
      
    </style>
@endsection
@section('content')
<div class="app-header white box-shadow">
<div class="navbar">
      <div style="float:left;" class="title_form">
        {{$layout_group->name}}
      </div>
</div>
 </div>

 <div class="app-body" id="view">
  <div class="padding">
    <?php $list_layout  = App\Layout::where('contribute_id',$layout_group->id)->orderby('created_at','desc')->get();?>
     <div class="row masonry-container">
     @foreach($list_layout as $key => $value)
    
            <div class="col-sm-6 col-md-4 item">
              <form id="form-{{$value->id}}" method="post" enctype="multipart/form-data">
              <div class="box">
                  <div class="box-header">
                    <h3>{{$value->name}}</h3>
                  </div>
                  <div class="box-body">
                     
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <ul class="list no-border p-b">
                          @foreach( $value->getItems as $key1 => $item)
                              <li class="list-item">
                                @if($item->type =="img")
                                <div class="form-group" style="margin-bottom:2px;text-align: left;">
                                  <label @if(!$item->value) class="bg" @endif>
                                        <img id="img_preview_{{$key1}}" style="max-height:60px;" @if($item->value) src="{{asset($item->value)}}" @endif>
                                        <input onchange="reUploadImg(this)" type="file" style="display: none;" name="layout_img[{{$key1}}][value]" data-id="{{$key1}}">
                                        <span>Ảnh</span>
                                  </label>
                                </div>
                                <input type="hidden" name="layout_img[{{$key1}}][id]" value="{{$item->id}}">

                              

                                <div class="form-group" style=" @if($item->pin == 0) display:none; @endif  margin-bottom:5px;text-align: left;">
                                  <input class="form-control" name="layout_img[{{$key1}}][link]" placeholder="link" value="{{$item->link}}">
                                </div>
                                @endif
                                @if($item->type =="des")
                                  <div class="form-group" style="margin-bottom:2px;text-align: left;">
                                     <input type="hidden" name="post_des[{{$key1}}][id]" value="{{$item->id}}">
                                    <textarea name="post_des[{{$key1}}][value]" class="form-control" rows="3">{{$item->value}}</textarea>
                                  </div>
                                  <div class="form-group" style=" @if($item->pin == 0) display:none; @endif margin-bottom:5px;text-align: left;">
                                    <input class="form-control" placeholder="link" value="{{$item->link}}" name="post_des[{{$key1}}][link]">
                                  </div>
                                @endif
                              </li>
                          @endforeach
                          </ul>
                     
                  </div>
                  <div class="box-footer">
                        <button class="btn btn-sm  pull-right" data-type="{{$value->id}}" id="update-layout" type="submit">Lưu</button>
                        <div style="clear:both">
                        </div>
                  </div>
                  
                </div>
                </form>
             </div>
      
    @endforeach
     </div>
  </div>






@endsection
@section('js-footer')
  <script src="{{ asset('backend/libs/jquery/screenfull/dist/screenfull.min.js') }}"></script>
  <script src="{{ asset('backend/libs/jquery/footable/dist/footable.all.min.js') }}"></script>
  <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
  <script>
   jQuery(function($){
  $('.table').footable({
    "paging": {
      "enabled": true
    }
  });
});
  $(document).on('click', '#update-layout', function(event){
    event.preventDefault();
    id_form= $(this).attr('data-type');
    var formData = new FormData($('#form-'+id_form)[0]);
    formData.append('key', id_form);
     $.ajax({
      url:'{{ route('layout.update') }}',
      type:'post',
      data:formData,
      cache: false,
      processData: false,
      contentType: false
     }).done(function(data){
           console.log(data);
           if(data=true){
             location.reload();
           }
     }).fail(function(){
       alert('co loi xay ra');
     })

  });
  function reUploadImg(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(input).prev().attr('src', e.target.result);
            $(input).parent().removeClass('bg');
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL(input,id) {

      if (input.files && input.files[0]) {
         
          var reader = new FileReader();
          reader.onload = function (e) {

              $('#img_preview_'+id).attr('src', e.target.result);
              $('#img_preview_'+id).parent().removeClass('bg');
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
 $('input[type=file]').each(function(i){
     $('#file_img_preview_'+i).on('change', function() {
      readURL(this, i);
});
 })
 function load_masonry(){
      var $container = $('.masonry-container');
      $container.masonry({
        columnWidth: '.item',
        itemSelector: '.item'
      });   
  }
  load_masonry();
    
   $.each($('textarea'),function(i,v){
    $(v).attr('spellcheck','false');
   });
    $.each($('input'),function(i,v){
    $(v).attr('spellcheck','false');
   });
  </script>
@endsection