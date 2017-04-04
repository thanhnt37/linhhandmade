<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>@yield('title')</title>
    @yield('meta')
        <meta name="keywords" content="">
        <meta charset="utf-8">
        <meta name="author" content="{{url('')}}">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        @include('frontend.partials.css_js_top')

    </head>
    <body>
       <!-- navigation panel -->
        @include('frontend.partials.main-menu')
        <!--end navigation panel -->

        <!-- head section -->
        @include('frontend.partials.img-big')
        <!-- end head section -->
        
        <!-- MAIN CONTENT -->
        @yield('content')
        <!-- FOOTER -->
        @include('frontend.partials.footer')
        <!-- END OF FOOTER -->
        @include('frontend.partials.popup')
        <!-- javascript libraries / javascript files set #1 --> 
        @include('frontend.partials.js-bottom')
        @yield('js')
         <script>
            $("#t-timsp").on("input", function(){
                var a = $("#t-timsp").val();
                if(a==""){
                    $(".t-box-tim-kiem").css({"opacity":'0','visibility':'hidden'});
                }
                else{
                    $(".t-box-tim-kiem").css({"opacity":'01','visibility':'visible'});
                }
            });
            $(document).click(function (e)
             {
                 // Đối tượng container chứa popup
                 var container = $(".t-box-tim-kiem");
              
                 // Nếu click bên ngoài đối tượng container thì ẩn nó đi
                 if (!container.is(e.target) && container.has(e.target).length === 0)
                 {
                     container.css({"opacity":'0','visibility':'hidden'});
                 }
             });
        </script>
        <script>
                spam = 0;                
                $(document).on('submit','#d-form-uudai',function(e){
                      container = $(this);
                       e.preventDefault();       
                       if(spam == 0){
                          spam++; 
                           v = $('.d-uudai-email').val();
                           formData = new FormData($("#d-form-uudai")[0]);  
                        $.ajax({
                       headers: {
                                     'X-CSRF-TOKEN':'{{ csrf_token() }}'
                               },
                       type:"post",
                       url:"{{route('email.uudai')}}",
                       data: formData,
                       contentType: false,
                       processData: false,
                       dataType:"json",
                       success:function(data){
                           spam = 0
                           if(data.status == true){
                              spam = 0
                              $.magnificPopup.open({
                                   items: {
                                       src: '#modal-popup-guithanhcong-uudai' 
                                   },
                                   type: 'inline',
                                   blackbg: true,
                                   zoom: {
                                           enabled: true,
                                           duration: 300 
                                         },
                                   mainClass: 'my-mfp-zoom-in',
                                   callbacks: {
                                     beforeOpen: function() {
                                      
                                     }
                                   }
                               });
                              $("#d-form-uudai")[0].reset();
                           }else{
                               spam = 0
                              $.magnificPopup.open({
                                   items: {
                                       src: '#modal-popup-guithanhcong-uudai1' 
                                   },
                                   type: 'inline',
                                   blackbg: true,
                                   zoom: {
                                           enabled: true,
                                           duration: 300 
                                         },
                                   mainClass: 'my-mfp-zoom-in',
                                   callbacks: {
                                     beforeOpen: function() {
                                      
                                     }
                                   }
                               });
                              $("#d-form-uudai")[0].reset();
                           }
                       }
                   });
                   }
                   spam = 1;

                   });

                 // tim kiếm sản phẩm
                 
                 $(document).on('keyup','#d-timsp',function(e){
                    value = $(this).val();
                     if($.trim(value)){
                            $.ajax({
                              headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                              },
                              type:"post",
                              url:"{{route('product.search')}}",
                              data:{'key':value},
                              success:function(data){
                                // console.log(data);
                                  if(data.status){
                                    $(".t-box-tim-kiem").css({"opacity":'1','visibility':'visible'});
                                    $('.t-box-tim-kiem').html(data.html_search);
                                  }else{
                                    $(".t-box-tim-kiem").css({"opacity":'0','visibility':'hidden'});
                                    $('.t-box-tim-kiem').html(data.html_search);
                                  }
                                  $('#d-timsp').keypress(function(event){
                                  var keycode = (event.keyCode ? event.keyCode : event.which);
                                    if (keycode == '13') {

                                    }
                                  });
                              },
                              cache:false,
                              dataType:'json'
                            });
                        }else{
                           $(".t-box-tim-kiem").css({"opacity":'0','visibility':'hidden'});
                        }
                 }); 



                 $(document).on('click','.d-add-cart',function(e){
                    e.preventDefault();
                    num = $(this).parent().parent().find('.pro-select').find(':selected').val();
                    frame_id = $(this).data('frame');
                   // console.log(num);
                       $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type:"post",
                    url:"{{route('ajax.add.card')}}",
                    data:{'num':num,'frame_id':frame_id},
                    success:function(data){
                         //console.log(data);
                        if(data.status === true){
                            amount = data.total;
                            list_item  = data.session;
                             frame  = data.frame;
                             id = frame.id;
                             $('#name_product_add').text(frame.name);
                             $('.t-i-cart').text(list_item.length);
                             $('.amount').text(amount);
                             str = data.html;
                             $('.cart-list li').remove();
                             $('.cart-list').append(str);
                             size = $('.cart-list li').length;
                             $('.top-cart').attr('data-size',size);
                             $('.t-cart-content').attr('data-num',size);
                            // console.log(id);

                             $.magnificPopup.open({
                                items: {
                                    src: '#modal-popup-cart' 
                                },
                                type: 'inline',
                                blackbg: true,
                                zoom: {
                                        enabled: true,
                                        duration: 300 
                                      },
                                mainClass: 'my-mfp-zoom-in',
                                callbacks: {
                                  beforeOpen: function() {
                                   
                                  }
                                }
                            });
                             setTimeout(function(){
                                $('#modal-popup-cart').magnificPopup('close');
                            },4000);
                        }
                    },
                    cache:false,
                    dataType: 'json'
                  });
                 }); 

                 $(document).on('click','.remove',function(e){
                    e.preventDefault();
                    container = $(this);
                    id_frame = $(this).data('frame');
                    transpost = $('.d-district-list').find(':selected').data('id');
                    show_cart = '<div class="col-md-12  d-item2" style="display:block">'+
                      '<span style="font-size:11pt;font-family:Roboto Bold; margin-left:324px;">Không có sản phẩm nào trong giỏ hàng của bạn</span>'+
                      '<div style="background-color:#7b1fa2; line-height: 40px; margin-left:382px; border-radius: 4px;margin-top: 12px; width:200px;height:40px;text-align:center;">'+
                        '<a style="color: #fff;font-size: 10pt;font-family:Roboto Bold;text-transform: uppercase; " href="{!! route('view.category') !!}">Tiếp Tục mua hàng</a>'+
                      '</div>'+
                    '</div>';
                    $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type:"post",
                    url:"{{route('ajax.remove.cart')}}",
                    data:{'id_frame':id_frame,'transpost':transpost},
                    success:function(data){
                        // console.log(data);
                        $(container).parent().remove();
                        $('.amount').html(data.text);
                        num = $('.l_cart2').text() - 1;
                        so = $('#d-hover').data('size');
                        if(id_frame){
                          $('.class_'+id_frame).remove();
                        }else{
                          $('.class_'+id).remove();
                        }
                        
                        $('#total').text((data.text + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ").attr('value',data.text);
                        $('#total_weight').text(data.text_weight+" gam").attr('value',data.text_weight);
                        if(data.text == 0){
                          $('.show_cart').html(show_cart);
                        }
                        if(data.district == null){
                            $('#all-total').text((data.text + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
                        }else{
                            if(data.text == 0){
                                $('.show_cart').html(show_cart);
                            }
                            $('.d-transpost1').text((parseInt(data.some) + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + "đ");
                            data1 = parseInt(data.text) + parseInt(data.some);
                            $('#all-total').text((data1 + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"đ");
                        }
                        // console.log("zkxjc" + $('.l_cart2').text());
                        $('.l_cart2').text(num);
                        $('.top-cart').attr('data-size',num);
                        $('.t-cart-content').attr('data-num',num);
                    },
                    cache:false,
                    dataType: 'json'
                  });
                 });  
               
                 
              $('#d-hover').hover(
              function(){
                 $('.cart-content').css({"opacity":"01",'visibility':'visible'});
                 so = $(this).data('size');
                 if(so == 0){
                     $('.cart-content').css({"opacity":"0",'visibility':'hidden'});
                 }
              },
              function(){
                 $('.cart-content').css({"opacity":"0",'visibility':'hidden'});
              }); 

              $(document).on('submit','#d-tracuu',function(e){
                e.preventDefault();
                value = $('.t-ip-form1').val();
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type:"post",
                url:"{{route('ajax.tra.cuu')}}",
                data:{'value':value},
                success:function(data){
                  console.log(data);
                  if(data.status == true){
                    $('#modal-popup-tracuu').magnificPopup('close');
                    $("#d-tracuu")[0].reset();
                     $.magnificPopup.open({
                        items: {
                            src: '#modal-popup-tracuu1' 
                        },
                        type: 'inline',
                        blackbg: true,
                        zoom: {
                                enabled: true,
                                duration: 300 
                              },
                        mainClass: 'my-mfp-zoom-in',
                        callbacks: {
                          beforeOpen: function() {
                            $('#d-ket-qua').html(data.html);
                          }
                        }
                    });
                  }else{
                    $('#modal-popup-tracuu').magnificPopup('close');
                    $("#d-tracuu")[0].reset();
                     $.magnificPopup.open({
                        items: {
                            src: '#modal-popup-tracuu1' 
                        },
                        type: 'inline',
                        blackbg: true,
                        zoom: {
                                enabled: true,
                                duration: 300 
                              },
                        mainClass: 'my-mfp-zoom-in',
                        callbacks: {
                          beforeOpen: function() {
                            $('#d-ket-qua').html(data.message);
                          }
                        }
                    });
                  }
                },
                cache:false,
                dataType: 'json'
              });
          });
              $(document).on('submit','#d-popup-tra-cuu',function(e){
                  e.preventDefault();
                  var form = $('#d-popup-tra-cuu')[0];
                  var formData = new FormData(form);

                  $.ajax({
                  headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                  type:"post",
                  url:"{{route('ajax.tra.cuu.frontend')}}",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success:function(data){
                    if(data.status == true){
                      $('#d-ajax-tra-cuu-giam-gia').html(data.html);
                        $.magnificPopup.open({
                             items: {
                                 src: '#modal-popup-tichdiem24' 
                             },
                             type: 'inline',
                             blackbg: true,
                             zoom: {
                                     enabled: true,
                                     duration: 300 
                                   },
                             mainClass: 'my-mfp-zoom-in',
                             callbacks: {
                               beforeOpen: function() {
                                  
                               }
                             }
                         });
                    }else{
                        $('#d-mess').css('display','block').text(data.message);
                    }
                  },
                  dataType:"json"
                  });
                });
            </script>
            <!-- click show menu footer-->
            <!-- <script type="text/javascript">
              $(document).on('click','.show_cate_footer',function() {
                  $(this).next().slideToggle();
              });
            </script> -->
            <!-- click menu2 catagory -->
            <script type="text/javascript">
               $(document).on('click','.t-hover-catagory',function(){
                   //$(".dropdown-menu2").removeClass('dropdown-menu2-rotate');
                   x = $(this).find(".dropdown-menu2").first();
                   $(x).toggleClass('dropdown-menu2-rotate');
                   $(x).addClass('done_change');
                   list =  $(".dropdown-menu2");
                   $.each(list,function(i,v){
                       // if(v != x){
                       if( !$(v).hasClass('done_change') ){
                           $(v).removeClass('dropdown-menu2-rotate');
                       }
                       // }
                   });
                   $(".dropdown-menu2").removeClass('done_change');
                   // $(".dropdown-menu2").toggleClass('dropdown-menu2-rotate');
               });
                $(window).on('resize', function(){
                    var win = $( window ).width(); //this = window
                    if (win >= 980) {
                      if( $('#search-header').css('display') == "block"){
                        $('#search-header').magnificPopup('close');
                      }
                    }
                });
                $(document).ready(function(){
                $(document).on('mouseover','.stag-close-ctg-prnt',function(){
                  $(this).parent().find('span').addClass('txtlnthgh');
                  l = $(this).parent().nextAll();
                  console.log(l);
                  $.each(l,function(i,v){
                    $(v).find('span').addClass('txtlnthgh');
                    $(v).find('span').addClass('txtlnthgh');
                  });
                });
                $(document).on('mouseleave','.stag-close-ctg-prnt',function(){
                  $(this).parent().parent().find('.stag-ctg span').removeClass('txtlnthgh');
                  $(this).parent().parent().find('.stag-tht span').removeClass('txtlnthgh');
                });
                $(document).on('mouseover','.stag-close-tht',function(){
                  $(this).parent().find('span').addClass('txtlnthgh');
                });
                $(document).on('mouseleave','.stag-close-tht',function(){
                  $(this).parent().parent().find('.stag-tht span').removeClass('txtlnthgh');
                });
                
              });
            </script>

            
    </body>
</html>
