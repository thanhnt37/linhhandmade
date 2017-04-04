<nav class="navbar navbar-default nav-border-bottom t-nav" role="navigation">
    <div class="t-nav-container">
        <div class="row">
             <!-- Tìm kiếm và search khi ở màn hình nhỏ  -->
            <div class="col-md-2 no-padding-left search-cart-header pull-right t-search-mb">
                <?php
                         $list_pro = Session::get('product');
                        ?>
                <div class="top-cart">
                    <!-- nav shopping bag -->
                    <a href="#" class="shopping-cart">
                        <i class="fa fa-shopping-cart t-cart-icon"></i>
                        <span class="t-i-cart t-i-cart2 d-so" style="">{{sizeof($list_pro)}}</span>
                    </a>
                    <!-- end nav shopping bag -->
                    <!-- shopping bag content -->

                    <div class="cart-content t-cart-content"  data-num="{{sizeof($list_pro)}}">
                        <div class="t-box-cart">
                            <ul class="cart-list t-cart-list ">
                            
                                <?php $asset_dir = asset('');?>
                                <?php $total = 0;?>
                                @if($list_pro)
                                    @foreach($list_pro as $key=>$item)
                                        <li id="d-list-cart-ajax" class="classli_{!! $item['frame']->id !!}" data-id="{{ $item['frame']->id }}" >
                                        <a href="{!! Route('getProDetail',['id'=>$item['frame']->id,'slug'=>$item['frame']->slug]) !!}"><img alt="" src="{{$asset_dir}}{{ $item['frame']->img }}"/></a>
                                        <p><a href="{!! Route('getProDetail',['id'=>$item['frame']->id,'slug'=>$item['frame']->slug]) !!}">{{ $item['frame']->name }}</a></p>
                                        <?php
                                            if($item['frame']->price_sale){
                                                $price_frame = $item['frame']->price_sale;
                                            }else{
                                                $price_frame = $item['frame']->price;
                                            }
                                            $price_frame = $price_frame;
                                            $total += $price_frame * $item['num'];
                                        ?>
                                        <p class="tan-font-RB" >
                                             <span class="amount">{{number_format( (int)$price_frame,0,'','.')}}đ x 
                                             <span id="d-num">{{$item['num']}}</span> </span>
                                        </p>
                                        <span class="pull-right x-search remove" data-id="{{ $item['frame']->id }}" data-frame="{!! $item['frame']->id !!}">×</span>
                                        <div style="clear :both"></div>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            <p class="buttons t-buttons">
                                <a href="{!! route('get.shoppingcart') !!}" class="">Xem giỏ hàng</a>
                            </p>
                        </div>
                    </div>
                    <!-- end shopping bag content -->
                </div>
                <div id="top-search" style="margin-right:25px">
                    <!-- nav search -->
                    <a href="#search-header" class="header-search-form"><img src="{{ asset('frontend/html/Pic/Searcher.png') }}" alt="" class="t-search-button"></a>
                    <!-- end nav search -->
                </div>
                <!-- search input-->
                <form id="search-header" method="post" action="{!! route('frontend.search') !!}" name="search-header" class="mfp-hide search-form-result">
                    <div class="search-form position-relative">
                        <button type="submit" class=" close-search search-button"><img src="{{ asset('frontend/html/Pic/musica-searcher.png') }}" alt="" class="t-search-button" style="transform: rotate(90deg);"></button>
                        <input type="text" name="search" class="search-input" placeholder="Nhập sản phẩm cần tìm..." autocomplete="off">
                    </div>
                </form>
                <!-- end search input -->
            </div>
            <!-- end search and cart /khi ở màn hình nhỏ  -->
            <!-- button #menu-catagory -->
            @yield('menu')
            <!-- toggle navigation -->
            <div class="navbar-header pull-right">
                <button type="button" class="navbar-toggle t-btn-mn" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="d_icon_dropdown_menu fa fa-caret-down"></span></button>
            </div>
            <!-- toggle navigation end -->
            <!-- main menu -->
            <div class="col-md-12 accordion-menu text-center t-nav-ul">
                <div class="navbar-collapse collapse">
                    <ul id="accordion" class="nav navbar-nav  panel-group t-panel-group">
                        <!-- menu item -->
                        <li class="dropdown panel">
                             <a class="popup-with-zoom-anim" href="#modal-popup-tichdiem">Tích điểm</a>
                        </li>
                        <!-- end menu item -->
                        <!-- menu item -->
                        <li class="dropdown panel">
                            <a id="d-tra-cuu" style="cursor:pointer;"  >Tra cứu đơn hàng</a>
                        </li>
                        <!-- end menu item -->
                        <!-- menu item -->
                        <li class="dropdown panel">
                            <a class="popup-with-zoom-anim" href="#modal-popup-vuaxem" style="border-bottom: none !important;">Vừa xem</a>
                        </li>
                        <!-- end menu item -->
                        <!-- menu item tìm kiếm khi ở Decktop-->
                        <li class="dropdown panel t-hide t-li-db top-cart">
                            <div class="t-timsp">
                                <form action="{!! route('frontend.search') !!}">
                                    <img src="{{ asset('frontend/html/Pic/Searcher.png') }}" width="19px" height="19px" style="padding-right:4px; margin-top:-4px;">
                                    <input  type="text" placeholder="Tìm sản phẩm" name="search" id="d-timsp"  autocomplete="off" />
                                </form>
                            </div>
                            <!-- box tìm kiếm-->
                            <div class="t-box-tim-kiem" visibility="hidden">
                            
                            </div>
                                <!-- end box tìm kiếm-->
                        </li>
                        <!-- end menu item tìm kiếm Decktop -->
                        <!-- item Giỏ hàng khi màn hình Decktop-->
                        
                        <li class="t-hide">
                            <div class="top-cart t-top-cart" id="d-hover" data-size="{{ sizeof($list_pro) }}" >
                                <!-- nav shopping bag -->
                                <a href="#" class="shopping-cart">
                                    <i class="fa fa-shopping-cart t-cart-icon"></i>
                                    <span class="t-i-cart l_cart2 " >{{sizeof($list_pro)}}</span>
                                    <div class="subtitle" style="display:inherit">Giỏ hàng</div>
                                </a>
                                <!-- end nav shopping bag -->
                                <!-- shopping bag content -->
                                <div class="cart-content t-cart-content abc" data-num="{{sizeof($list_pro)}}">
                                    <div class="t-box-cart">
                                        <ul class="cart-list">
                                            <?php $asset_dir = asset('')?>
                                            <?php $total = 0;
                                            ?>
                                            @if($list_pro)
                                                @foreach($list_pro as $key=>$item)
                                                    <li id="d-list-cart-ajax" class="classli_{!! $item['frame']->id !!}" data-id="{{ $item['frame']->id }}" >
                                                    <a href="{!! Route('getProDetail',['id'=>$item['frame']->id,'slug'=>$item['frame']->slug]) !!}"><img alt="" src="{{$asset_dir}}{{ $item['frame']->img }}"/></a>
                                                    <p><a href="{!! Route('getProDetail',['id'=>$item['frame']->id,'slug'=>$item['frame']->slug]) !!}">{{ $item['frame']->name }}</a></p>
                                                    <?php
                                                        if($item['frame']->price_sale){
                                                            $price_frame = $item['frame']->price_sale;
                                                        }else{
                                                            $price_frame = $item['frame']->price;
                                                        }
                                                        $price_frame = $price_frame;
                                                        $total += $price_frame * $item['num'];
                                                    ?>
                                                    <p class="tan-font-RB" >
                                                         <span class="amount">{{number_format( (int)$price_frame,0,'','.')}}đ x 
                                                         <span id="d-num">{{$item['num']}}</span> </span>
                                                    </p>
                                                    <span class="pull-right x-search remove" data-frame="{!! $item['frame']->id !!}">×</span>
                                                    <div style="clear :both"></div>
                                                </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        <p class="buttons t-buttons">
                                            <a href="{!! route('get.shoppingcart') !!}" class="">Xem giỏ hàng</a>
                                        </p>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                                <!-- end shopping bag content -->
                            </div>
                        </li>
                        <!-- end menu item khi màn hình Decktop-->
                    </ul>
                </div>
            </div>
            <!-- end main menu -->

                            <!--popup vừa xem-->
        <div id="modal-popup-vuaxem" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup t-popup-vuaxem">
            <?php $list_pro_xem = Session::get('xem_product'); ?>
            <div >
                <h5>Vừa xem</h5>
            </div>
             <div class="t-popup-padding-rp">               
                <div class="row" style="margin:0px !important">

                   
                    @if(sizeof($list_pro_xem) > 0)
                        <div class="center-col">
                        <!-- box vừa xem-->
                            <div class="t-box-vua-xem">

                                 <ul>
                                @foreach($list_pro_xem as $key => $item)
                                    @if($key< 3)
                                    <li>    
                                        <a href="{!! Route('getProDetail',['id'=>$item['xem_product']->id,'slug'=>$item['xem_product']->slug]) !!}"><img alt="" src="{!! asset($item['xem_product']->img) !!}"/></a>
                                        <p><a href="{!! Route('getProDetail',['id'=>$item['xem_product']->id,'slug'=>$item['xem_product']->slug]) !!}">{!! $item['xem_product']->name !!}</a></p>
                                        <p class="tan-font-RB">
                                            
                                            @if($item['xem_product']->price_sale)
                                                {!! number_format($item['xem_product']->price_sale,0,'','.') !!}đ
                                            @else
                                                {!! number_format($item['xem_product']->price,0,'','.') !!}đ
                                            @endif
                                        </p>
                                        <div style="clear :both"></div>
                                    </li>
                                    @endif
                                @endforeach 
                                </ul>
                            </div>
                            @if(sizeof($list_pro_xem) > 3)
                            <div style="border-top:1px solid #d9d9d9;    margin-left: -20px;padding-left: 20px;    margin-right: -20px;padding-right: 20px;">
                            <p  class="tan-font-RB" style ="margin:15px 0px; "><a href="{!! route('danh.sach.vua.xem') !!}" style="color:#7f7f7f">
                                +{!! sizeof($list_pro_xem)-3 !!} sản phẩm khác
                            </a></p>
                            </div>
                            @endif

                        </div>
                    @else 
                         <div class="center-col">
                        <!-- box vừa xem-->
                            <div class="t-box-vua-xem">
                                <div>
                                <p class="tan-font-RB" style ="margin:5px 0px; "><a style="font-family: 'Roboto';">
                                    Không có sản phẩm nào vừa xem
                                </a></p>
                                </div>
                            </div>
                        </div>
                    @endif 
                </div>
            </div>
        </div>
        <!--end popup vừa xem-->
        <!--Popup tra đơn hàng-->
        <div id="modal-popup-tracuu" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
            <div style="">
                <h5>Tra cứu đơn hàng</h5>
            </div>
            <div class="t-popup-padding-rp">
                <div class="row" style="margin:0px !important">
                    <div class="center-col text-center margin-ten no-margin-top xs-margin-bottom-seven let" style="margin-bottom:0px !important">
                        <p class="t-nd-popup">Nhập một trong các thông tin dưới đây để tra cứu tình trạng đơn hàng của bạn</p>
                    </div>
                </div>
                <div class="row" style="margin:0px !important">
                    <div class="center-col text-center">
                        <form id="d-tracuu">
                            <!-- input  -->
                            <input class="t-ip-form1" type="text" placeholder="Số điện thoại hoặc mã đơn hàng" required name="phone">
                            <!-- end input -->              
                            <!-- button  -->
                            <button class="btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu" type="submit">Tra cứu</button>

                            <!-- end button  -->
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Hết popup tra đơn hàng-->
                <!--Popup thông báo tra đơn hàng-->
        <div id="modal-popup-tracuu1" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
            <div style="">
                <h5>Kết quả</h5>
            </div>
            <div class="t-popup-padding-rp">
                <div id="d-ket-qua">
                    
                </div>
            </div>
        </div>
        <!--Hết popup thông báo tra đơn hàng-->

                <!-- modal popup -->
        <!--Popup tích điểm-->
        <div id="modal-popup-tichdiem" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
            <div style="">
                <h5>Tích điểm</h5>
            </div>
            <div class="t-popup-padding-rp">
                <div class="row" style="margin:0px !important">
                    <div class="center-col text-center margin-ten no-margin-top xs-margin-bottom-seven let" style="margin-bottom:0px !important">
                        <p class="t-nd-popup"style="">Nhập số điện thoại để tra cứu ưu đãi bạn được hưởng qua Chương trình tích điểm</p>
                    </div>
                </div>
                <div class="row" style="margin:0px !important">
                    <div class="center-col text-center">
                        <form id="d-popup-tra-cuu">
                            <!-- input  -->
                            <input class="t-ip-form1" type="text" placeholder="Số điện thoại..."  style="" required name="phone">
                            <p style="margin-bottom:10px;color:red;display:none;font-family:Roboto;" id="d-mess"></p>
                            <!-- end input -->              
                            <!-- button  -->
                            <button  class="btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu"   type="submit">Tra cứu</button>
                            <!-- end button  -->                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Hết popup tích điểm-->
        <!--Popup thông báo tích điểm-->
        <div id="modal-popup-tichdiem24" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
            <div style="">
                <h5>Kết quả</h5>
            </div>
            <div class="t-popup-padding-rp">
                <div class="row" style="margin:0px !important">
                <div class="center-col text-center margin-ten no-margin-top xs-margin-bottom-seven let" style="margin-bottom:0px !important">
                    <p class="t-nd-popup" style="">Bạn là khách hàng quen thuộc. Dưới đây là ưu đãi giảm giá bạn được hưởng trong lần mua hàng tới </p>
                </div>
            </div>
                <div class="row" style="margin:0px !important">
                    <div class="center-col text-center">
                        <div id="d-ajax-tra-cuu-giam-gia">
                            
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <!--Hết popup thông báo tích điểm-->
                </div>
            </div>
        </nav>