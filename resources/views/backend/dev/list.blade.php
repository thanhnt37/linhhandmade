@extends('backend.layouts.default')
@section('css')
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" type="text/css" />
   <link rel="stylesheet" href="{{ asset('backend/libs/jquery/select2/dist/css/select2.min.css') }}" type="text/css" />
   <!-- <link rel="stylesheet" href="{{ asset('backend/assets/styles/backend.css') }}" type="text/css" /> -->
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
        /*color: #A6A6A6 !important;*/
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
        position: relative;
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
     
      .close-slide{
        position: absolute;
        right: 20px;
        top: 12px;
        text-transform: lowercase;
        font-family: "Roboto";
        font-size: 13pt;
        cursor: pointer;
        text-align: center;
        color: #A6A6A6;
      }
      .close-slide:hover{
        color: #404040;
      }
      

      .s-img{
        max-width:100%;height:100px;min-width:170px;background-color:#F0F0F0;
        border:1px solid #E7E7E7;
        position: relative;
      }
      .s-img-reset{
        background-color: #fff;
        border: 0px;
      }
      .s-img img{
        max-height: 70px;
      }
      .s-img span{
          position: absolute;
          top: 35px;
          left: calc(50% - 15px);
      }
      .s-name{
        display: inline-block;
        float: left;
        width: calc(100% - 60px);
      }
      .s-name a{
        width: 60px;
        float: left;
        height: 28px;
        background-color: #fff;
        outline: none;
        border: 1px solid #D9D9D9;
        border-left: 0px;
        font-family: "Roboto";
        font-size: 10pt;
        color:#7F7F7F;
        display: block;
        text-align: center;
        padding-top: 3px;
      }
      .s-name input{
        width: calc(100% - 70px);
        height: 28px;
        float: left;
        border: 1px solid #D9D9D9;
        padding-top: 4px !important;
        padding-left: 10px !important;
        padding-bottom: 4px !important;
        font-size: 10pt;
        font-family: "Roboto";
        color:#7F7F7F;
        
      }
      .s-add{
        display: inline-block;
        float: right;
      }
      .s-add a{
        width: 60px;
        height: 28px;
        background-color: #fff;
        outline: none;
        border: 1px solid #D9D9D9;
        font-family: "Roboto";
        font-size: 10pt;
        color: #2E75B6;
        display: block;
        text-align: center;
        padding-top: 3px;
      }
      h3 input{
        height: 30px;
        width: 100%;
        border: 0px;
        font-size: "Roboto Medium";
        font-size: 11pt;
      }
      .s-change{
        width: 100%;
        height: 25px;
        background-color: #fff;
        outline: none;
        border: 0px solid #D9D9D9;
        font-family: "Roboto";
        font-size: 10pt;
        color: #2E75B6;
        display: block;
        text-align: left;
        padding-top: 2px;
        color:#7F7F7F;
        padding-left: 10px;
      }
      .s-linkable{
         color:#7F7F7F;
        background-color: #F2F2F2;
      }
      .s-change:hover{
        color:#7F7F7F;
        background-color: #F2F2F2;
      }
      .item-editable textarea{
        background-color: #F2F2F2 !important;
        margin-bottom: 2px;
        border: 0px;
        font-size: 9pt;
      }
      .item-editable span,a{
        font-size: 10pt;
        font-family: "Roboto";
      }
       .item-editable a{
        font-size: 10pt;
        font-family: "Roboto";
      }
      .item-editable >span{
        display: inline-block;
        padding-bottom: 5px;
        padding-right: 20px;
        position: relative;
      }
      .item-editable >span:hover span{
        display: block;
      }
       .item-editable >span span{
        display: none;
        position: absolute;
        top: -3px;
        left: calc( 100% - 15px);
        color: #A6A6A6;
        font-size: 12pt;
        cursor: pointer;
      }
      .item-editable >span span:hover{
        color: #000000;
      }
      .s-img-container{
        margin-bottom: 3px;
      }
      .s-img{
        width: 80px;
        height: 70px;
      }
      @media (min-width: 991px){
          .title_form{
              margin-left: 9px;
              margin-top:13px;

          }
      }
      .title_form input{
        height: 30px;
        width: 100%;
        border: 0px;
        font-size: "Roboto Medium";
        font-size: 11pt;
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
    <form ui-jp="parsley" action="{{route('layout.group.post_add')}}" method="post">
      <div style="float:left;" class="title_form">
          <input style="font-family: 'Roboto Black';font-size: 14pt;background-color: #fff !important " type="" name="" placeholder="Nhập tên Nhóm layout" value="{{$layout_group->name}}" disabled >
      </div>
      <!-- <div style="float:right;margin-top:10px;">
        <button type="submit" name="submit" value="save" class="btn" style="
        padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 10px;font-family: 'Roboto-Bold';
        min-width:100px; background-color:#F2F2F2">XÓA</button>
        <button type="submit" name="submit"  value="post" class="btn success" style="
      padding-bottom: 8px;padding-top: 8px;font-size: 10pt;margin-right: 8px;font-family: 'Roboto-Bold';
      min-width:100px; background-color:#738CEC">TẠO</button>
      </div> -->
    </form>
</div>
</div>

 <div class="app-body" id="view">
    <div class="padding">
      <div class="row masonry-container">

                <div class="col-sm-6 col-md-4 item">
                 <form class="" id="form" method="post" action="{{route('dev.add.item')}}" enctype="multipart/form-data">
                      <div class="box">
                          <div class="box-header">
                            <h3>
                              <input type="" name="layout_name" placeholder="Nhập tên Layout" required>
                            </h3>
                          </div>
                          <div class="box-body">
                             
                                  <ul class="list no-border p-b">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="new" value="1">
                                        <input type="hidden" name=" contribute_id" value="{{$layout_group->id}}">
                                        <li class="list-item">
                                          <div class="s-name">
                                            <input placeholder="Text_Name" id="id_name_text">
                                            <a class="link_change">Link</a>
                                          </div>
                                          <div class="s-add">
                                            <a class="add_text">Thêm</a>
                                          </div>
                                        </li>
                                        <li class="list-item">
                                          <div class="s-name">
                                            <input placeholder="Image_Name" id="id_name_img">
                                            <a class="link_change">Link</a>
                                          </div>
                                          <div class="s-add">
                                            <a class="add_img">Thêm</a>
                                          </div>
                                        </li>
                                  </ul>
                          </div>
                          <div class="box-footer">
                                <button class="btn btn-sm pull-right" id="update-layout" type="submit">Thêm</button>
                                <div style="clear:both">
                                </div>
                          </div>
                        </div>
                   </form>
                 </div>
                 <!-- for -->
                @foreach($layout as $i_l)
                <div class="col-sm-6 col-md-4 item">
                 <form class="" id="form" method="post" action="{{route('dev.add.item')}}" enctype="multipart/form-data">
                      <div class="box">
                          <div class="box-header">
                            <h3>
                              <input type="" name="layout_name" value="{{$i_l->name}}">
                            </h3>
                          </div>
                           <div class="box-body">
                              <ul class="list no-border p-b">
                                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                                  <input type="hidden" name="new" value="0">
                                  <input type="hidden" name=" contribute_id" value="{{$layout_group->id}}">
                                  <li class="list-item">
                                    <div class="s-name">
                                      <input placeholder="Text_Name" id="id_name_text">
                                      <a class="link_change">Link</a>
                                    </div>
                                    <div class="s-add">
                                      <a class="add_text">Thêm</a>
                                    </div>
                                  </li>
                                  <li class="list-item">
                                    <div class="s-name">
                                      <input placeholder="Image_Name" id="id_name_img">
                                      <a class="link_change">Link</a>
                                    </div>
                                    <div class="s-add">
                                      <a class="add_img">Thêm</a>
                                    </div>
                                  </li>
                               
                              <?php $l_item = App\Item::where('key_layout',$i_l->key)->get();?>
                              @foreach($l_item as $i_i)
                                  @if($i_i->type =="des")
                                    <li class="list-item item-editable">
                                      <span>{{$i_i->key_item}}
                                         <span data-v="{{$i_i->id}}">×</span>
                                      </span>
                                      <input style="display:none" name="text_name[]" value="{{$i_i->key_item}}">
                                      <input style="display:none" name="text_id[]" value="{{$i_i->id}}">
                                      <textarea class="form-control" rows="3" name="text_value[]">{{$i_i->value}}</textarea>
                                      @if($i_i->pin)
                                      <label class="s-change">Có link</label>
                                      <input style="display:none" name="text_link[]" value="1">
                                      @else
                                      <label class="s-change s-linkable">Không link</label>
                                      <input style="display:none" name="text_link[]" value="0">
                                      @endif
                                    </li> 
                                  @else
                                    <li class="list-item item-editable">
                                      <span>{{$i_i->key_item}}
                                        <span data-v="{{$i_i->id}}">×</span>
                                      </span>
                                      <input style="display:none" name="img_name[]" value="{{$i_i->key_item}}">
                                      <input style="display:none" name="img_id[]" value="{{$i_i->id}}">
                                      <div class="s-img-container">
                                        <label class="s-img   @if($i_i->value) s-img-reset  @endif">
                                          <img @if($i_i->value) src="{{asset($i_i->value)}}" @endif>
                                          <input onchange="reUploadImg(this)" type="file" name="img_value[]"
                                          style="display:none" >
                                        </label>
                                      </div>
                                      @if($i_i->pin)
                                      <label class="s-change">Có link</label>
                                      <input style="display:none" name="img_link[]" value="1">
                                      @else
                                      <label class="s-change s-linkable">Không link</label>
                                      <input style="display:none" name="img_link[]" value="0">
                                      @endif
                                    </li>
                                  @endif
                              @endforeach
                              </ul>
                           </div>
                           <div class="box-footer">
                             <button class="btn btn-sm  pull-right" id="update-layout" type="submit">Lưu</button>
                                <div style="clear:both">
                                </div>
                           </div>
                      </div>
                 </form>
                </div>
                @endforeach
                <!-- endfor -->
            </div> 
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
  $(document).on('click','.add_text',function(){
    
    var text = $(this).parent().parent().find('#id_name_text').first().val();
    var islink = $(this).parent().parent().find('.link_change').first().text();
    if(text){
      if(islink == "Link"){
          content = '<li class="list-item item-editable">'+
            '<span>'+text+'<span data-v="0">×</span></span>'+
            '<input style="display:none" name="text_name[]" value="'+text+'">'+
            '<input style="display:none" name="text_id[]" value="0">'+
            '<textarea class="form-control" rows="3" name="text_value[]">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</textarea>'+
            '<label class="s-change">Có link</label>'+
            '<input style="display:none" name="text_link[]" value="1">'+
          '</li>'; 
          $(this).parent().parent().parent().append(content);
      }else{
          content = '<li class="list-item item-editable">'+
            '<span>'+text+'<span data-v="0">×</span></span>'+
            '<input style="display:none" name="text_name[]" value="'+text+'">'+
            '<input style="display:none" name="text_id[]" value="0">'+
            '<textarea class="form-control" rows="3" name="text_value[]">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</textarea>'+
            '<label class="s-change s-linkable">Không link</label>'+
            '<input style="display:none" name="text_link[]" value="0">'+
          '</li>'; 
          $(this).parent().parent().parent().append(content);
      }
    }
    $(this).parent().parent().find('#id_name_text').first().val('');
    load_masonry();
  });

  $(document).on('click','.add_img',function(){
  

    var text = $(this).parent().parent().find('#id_name_img').first().val();
    var islink = $(this).parent().parent().find('.link_change').first().text();
    if(text){
      if(islink == "Link"){
          content = '<li class="list-item item-editable">'+
                      '<span>'+text+'<span data-v="0">×</span></span>'+
                      '<input style="display:none" name="img_name[]" value="'+text+'">'+
                      '<input style="display:none" name="img_id[]" value="0">'+
                      '<div class="s-img-container">'+
                        '<label class="s-img">'+
                          '<img >'+
                          '<input onchange="reUploadImg(this)" type="file" name="img_value[]"'+ 
                          'style="display:none" >'+
                        '</label>'+
                      '</div>'+
                      '<label class="s-change">Có link</label>'+
                      '<input style="display:none" name="img_link[]" value="1">'+
                    '</li>'; 
          $(this).parent().parent().parent().append(content);
      }else{
          content = '<li class="list-item item-editable">'+
                      '<span>'+text+'<span data-v="0">×</span></span>'+
                      '<input style="display:none" name="img_name[]" value="'+text+'">'+
                      '<input style="display:none" name="img_id[]" value="0">'+
                      '<div class="s-img-container">'+
                        '<label class="s-img">'+
                          '<img >'+
                          '<input onchange="reUploadImg(this)" type="file" name="img_value[]"'+ 
                          'style="display:none" >'+
                        '</label>'+
                      '</div>'+
                      '<label class="s-change s-linkable">Không link</label>'+
                      '<input style="display:none" name="img_link[]" value="0">'+
                    '</li>';
          $(this).parent().parent().parent().append(content);
      }

    }
     var text = $(this).parent().parent().find('#id_name_img').first().val('');
    load_masonry();
  });
  function load_masonry(){
      var $container = $('.masonry-container');
      $container.masonry({
        columnWidth: '.item',
        itemSelector: '.item'
      });   
  }
  function makeid()
    {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( var i=0; i < 5; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
  }
  $(document).on('click','.link_change',function(){
  
    if($(this).text() == "Link"){
      $(this).text("Unlink");
    }else{
      $(this).text("Link");
    }
  });
  $(document).on('click','.item-editable > span > span',function(){
    v = $(this).attr('data-v');
    if( v== 0 ){
      $(this).parent().parent().remove();
      load_masonry();
    }else{
      if(xacnhanxoa('Bạn có chắc muốn xóa Layout này không?')===false){

      }else{
          $.ajax({
          url:'{{ route('layout.delete') }}',
          type:'post',
          data:{"id":v},
          cache: false,
          dataType: 'json'
         }).done(function(data){
               console.log(data);
               if(data.status == true){
                 location.reload();
               }
         }).fail(function(){
           alert('co loi xay ra');
         })
      }
       
    }
  });
   function xacnhanxoa(msg){
      var footable = $('.table').data('footable');
      if(window.confirm(msg)){
        return true;
      }
      else
        return false;
  };
  $(document).on('click','.s-change',function(){
    // alert("3");
    if($(this).next().val() == 1){
      $(this).next().val(0);
    }else{
       $(this).next().val(1);
    }
    if($(this).hasClass('s-linkable')){
      $(this).toggleClass('s-linkable');
       $(this).text('Có link');
    }else{
      $(this).toggleClass('s-linkable');
       $(this).text('Không link');
    }
  });
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
  var $container = $('.masonry-container');

    $container.masonry({
      columnWidth: '.item',
      itemSelector: '.item'
    });   
  </script>
@endsection