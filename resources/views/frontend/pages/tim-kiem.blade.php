        @extends('frontend.layout')
        @section('title','Tìm kiếm sản phẩm')
        @section('css')
            <link rel="stylesheet" href="{{ asset('frontend/html/css/d-catagory.css') }}">
        @endsection
        @section('menu')
         <div class="pull-left">
            <button type="button" class="navbar-toggle menu-catagory" data-target="#menu-catagory">
                <i class="fa fa-th-large" aria-hidden="true"></i>
            </button>
        </div>
        @endsection
        @section('content')

        <div class="container container-responsive">
            <div class="t-catagory">
                <div class="menu2">
                    <ul>
                    <?php $data = App\CategoryProduct::select()->get()?>
                    @foreach ($data as $item)
                    @if($item['parent_id']==0)
                    <li class="t-hover-catagory" href="">
                        <a>{{$item['name']}}</a>
                        <ul class='t-sub-mn t-hover-catagory'>
                      <?php
                             subMenu($data, $item['id']);
                        ?> 
                        </ul>
                    </li>
                    @endif 
                    @endforeach
                    <div style="clear:both"></div>
                    <ul>
                </div>
            </div>
            <div class="text-center d-1000x300">
                <img src="https://placeholdit.imgix.net/~text?txtsize=80&txt=1000%C3%97320&w=1000&h=320" alt="">
            </div>
            <!-- end of .d-1000x300 -->
                       <!-- phần đường dẫn -->
            <section class="t_section_content_products">
                <div class="d_section_content_pr t_section_content_pr">
                    <div class="row row-duongdan">
                        <div>
                            <ul class="d_cate_products">
                                <li style="color:#c3c3c3"><a href= "" style="color:#c3c3c3">Trang chủ</a></li>
                                <li style="color:#d6e9d7">/</li>
                                <li style="color:#c3c3c3"><a href="" style="color:#c3c3c3" href="">Catagories1</a></li>
                                <li style="color:#d6e9d7">/</li>
                                <li>Máy móc thiết bị {{$a}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end of phần đường dẫn -->
           
        </div><!-- end of container -->
        <div class="container main-content">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="button-offcanvas">
                    <p class="pull-left visible-xs visible-sm">
                        <button type="button" class="btn btn-primary btn-xs btn-offcanvas" data-toggle="offcanvas">
                            <img src="{{ asset('frontend/html/images/filter.svg') }}" alt="">
                        </button>
                    </p>
                    <button type="button" class="visible-xs visible-sm d-btn-thapcao pull-right">
                        <select name="" id="">
                            <option value="">Từ giá thấp đến cao</option>
                            <option value="">Từ giá cao đến thấp </option>
                        </select>

                    </button>
                </div><!-- button off canvas --> 
                <div class="col-xs-6 col-md-3 sidebar-offcanvas" id="sidebar">
                    <div class="list-group">
                        <div class="c-select">
                            <div class="c-form tan-filtersapxep tan-filtersapxep1 t-filter1">
                                <h4>Sắp xếp</h4>
                                <form role="form">
                                    <div class="radio tan" style="margin-top: 5px;">
                                        <label ><input  class="optradio1" type="radio" name="optradio" id="gia1">Giá từ thấp đến cao</label>
                                    </div>
                                    <div class="radio" style="margin-bottom: 7px;">
                                        <label ><input type="radio"  class="optradio1" name="optradio" id="gia2" >Giá từ cao đến thấp</label>
                                    </div>
                                </form>
                            </div><!--end c-form-->
                           <!--sọc kẻ fillter--> <div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
                            <div class="c-form tan-filtersapxep1 t-filter2">
                                <h4>Filter 1</h4>
                                <form role="form">
                                    <div class="radio tan" style="margin-top: 5px;">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                </form>
                            </div><!--end c-form-->
                             <!--sọc kẻ fillter--> <div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
                            <div class="c-form tan-filtersapxep1 t-filter3" style="margin-top: 17px;">
                                <h4>Filter 2</h4>
                            <form role="form ">
                                    <div class=" tan-filter2 tan-bovien1 tan-bovien ">
                                       <ul>
                                            <li class="tan-bovienpic"><img src="http://placehold.it/316x256" /></li>
                                            <li><img src="http://placehold.it/316x256"></li>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                       </ul>
                                    </div>
                                    <div class=" tan-filter2 tan-bovien1 ">
                                       <ul>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                       </ul>
                                    </div>
                                    <div class=" tan-filter2 tan-bovien1">
                                       <ul>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                       </ul>
                                    </div>
                                    <div class=" tan-filter2 tan-bovien1">
                                       <ul>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                            <li><img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=66%C3%9766&w=66&h=66"></li>
                                       </ul>
                                    </div>
                                    <div style=" clear:both; height: 6px;"></div>
                                </form>
                            </div><!--end c-form-->
                             <!--sọc kẻ fillter--> <div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
                            <div class="tan-filter1 tan-filtersapxep1 c-form  t-filter4">
                                <h4>Filter 3</h4>
                                <form role="form">
                                    <div class="radio tan" style="margin-top: 5px;">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Option 1</label>
                                    </div>
                                </form>
                            </div><!--end c-form-->
                             <!--sọc kẻ fillter--> <div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
                            <div class="c-form1 tan-filtersapxep1 t-filter5">
                                <h4 style="margin-bottom:13px">Filter 4</h4>
                                <form role="form " class="tan-filter4">
                                    <div>
                                        <ul class="can-le-fillter">
                                            <li class="pull-left">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="small" value="small">
                                                        <img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64" style="margin-right: 2px;">
                                                        <p>Name 1</p>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="small" value="small">
                                                        <img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64">
                                                        <p>Name 2</p>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="can-le-fillter clearfix">
                                            <li class="pull-left">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="small" value="small">
                                                        <img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64" style="margin-right: 2px;">
                                                        <p>Name 1</p>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="small" value="small">
                                                        <img src="https://placeholdit.imgix.net/~text?txtsize=8&txt=64%C3%9764&w=64&h=64">
                                                        <p>Name 2</p>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div><!--end c-form-->
                        </div><!--end c-select-->
                    </div><!-- end of list-group -->
                </div><!--/.sidebar-offcanvas-->
                <div class="col-xs-12 col-md-9" id="tuan" style="padding: 0;">
                    <div class="row row-content-responsive ">
                    @if(sizeof($products))
                    @foreach($products as $data)
                        <div class="col-xs-6 col-sm-4 col-lg-4 col-12-mobile">
                            <div class="d-sp d-sp-top text-center" style="margin-top: 35px;">
                                <div class="moi">Mới</div>
                                <img src="{{ $data->thumb_images }}" alt="">
                                <div class="absolute_img tan-bovien">
                                    <ul class="div_img">
                                        <li class="tan-bovienpic"><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                                        <li><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                                        <li><img src="https://placeholdit.imgix.net/~text?txtsize=5&txt=10%C3%9710&w=10&h=10&txtpad=1"></li>
                                    </ul>
                                </div>
                                <p><a class="d-list-xem" data-id="{!! $data->id !!}" href="{!! Route('getProDetail',['id'=>$data->id,'slug'=>$data->slug]) !!}">{{ $data->name }}</a></p>
                                <p class="fontBold" style="color: #000;">
                                    
                                    @if($data->price_sale)
                                        {{ $data->price_sale }}
                                    @else
                                        {{ $data->price }}
                                    @endif
                                </p>
                            </div><!-- end of d-sp -->
                        </div><!--/.col-xs-6.col-lg-4--> 
                    @endforeach
                    @else
                        <div style="text-align: center;padding: 30px">
                            <span style="font-size: 12pt;font-weight: 600;color: red">Không không tìm thấy sản phẩm nào !</span>
                        </div>
                    @endif
                    </div><!--/row-->
                </div><!--/.col-xs-12.col-sm-9-->
            </div><!--/row-->
        </div><!--/.container-->
        <!-- page -->
        <div class="tan_page">
            <ul>
                <?php
                  $link_limit = 7; 
                ?>
                <ul>
                  <li><a href="{{ $products->url(1) }}">Trước</a></li>
                  @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <?php
                            $half_total_links = floor($link_limit / 2);
                            $from = $products->currentPage() - $half_total_links;
                            $to = $products->currentPage() + $half_total_links;
                            if ($products->currentPage() < $half_total_links) {
                               $to += $half_total_links - $products->currentPage();
                            }
                            if ($products->lastPage() - $products->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($products->lastPage() - $products->currentPage()) - 1;
                            }
                            ?>
                            @if ($from < $i && $i < $to)
                                <li class=" {{ ($products->currentPage() == $i) ? 't-page' : '' }}">
                                    <a href="{{ $products->setPath('tim-kiem?search='.$search)->url($i)}}">{{ $i }}</a>
                                </li>
                            @endif
                  @endfor
                  <li class="next"><a href="{{ $products->url($products->lastPage()) }}">Sau</i></a></li>
                </ul>
                <!-- /.list-inline --> 
              </div>
            </ul>
        </div><!-- end of page -->
        @endsection
          @section('js')
            <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
        <!--Script click filter2-->
        <script>

            $(document).ready(function(){
                $(".t-filter3 li").click(function(){
                $(".t-filter3").find(".tan-bovienpic").removeClass("tan-bovienpic");
                $(this).addClass("tan-bovienpic");
            })
            });
        </script>
        <!--hết Script click filter2-->
        <!--filter 1-->
        <script>
            $(".t-filter2 label").click(function(){
                $(".t-filter2").find(".tan").removeClass("tan");
                $(this).parent().addClass("tan");
            });
        </script>
        <!--hết filter 1-->
        <!--sắp xếp-->
        <script>
            $(".t-filter1 label").click(function(){
                $(".t-filter1").find(".tan").removeClass("tan");
                $(this).parent().addClass("tan");
            });
        </script>
        <!--hết sắp xếp-->
        <!--filter 3-->
        <script>
            $(".t-filter4 label").click(function(){
                $(".t-filter4").find(".tan").removeClass("tan");
                $(this).parent().addClass("tan");
            });
        </script>
        <!--hết filter 3-->
        <script>
            $(".div_img li").click(function(){
                $(this).parent().find(".tan-bovienpic").removeClass("tan-bovienpic");
                $(this).addClass("tan-bovienpic");
            });
        </script>
        <!-- Visible menu catagory -->
        <script>
            $("button.menu-catagory").click(function() {
                $(".t-catagory").toggleClass("t-catagory-visible");
            });
        </script>
        <!-- click slide down small menu catagory -->
        <script>
            $(document).ready(function() {
                $(".t-hover-catagory").click(function() {
                    //$('.t-hover-catagory').removeClass('category-active');
                    list = $('.t-hover-catagory');
                    click = this;
                    $.each(list,function(i,v){
                        if(v !== click) {
                            $(v).removeClass('category-active');
                        }
                    });
                    $(this).toggleClass('category-active');
                    // var ul = $(this).find('.t-sub-mn');
                    // $('.t-sub-mn').slideUp('fast');
                    // if(ul){
                    //     $(ul).slideDown("fast");
                    // }
                    
                });
            });
            $(document).mouseup(function (e)
            {
                var container = $(".t-catagory");
                var icon = $(".menu-catagory");
                
                if (!icon.is(e.target) // if the target of the click isn't the container...
                    && icon.has(e.target).length === 0) // ... nor a descendant of the container
                {}else{
                    return false;
                }

                if (!container.is(e.target) // if the target of the click isn't the container...
                    && container.has(e.target).length === 0) // ... nor a descendant of the container
                {
                    $(".t-catagory").removeClass('t-catagory-visible'); 
                }
            });
            
        </script>
        <!-- filter1 -->
          <script type="text/javascript">
                $(document).on('click','.optradio1',function(e){
                    var a = $(this).attr('id');
                    e.preventDefault();
                    var a = $(this).attr('id');
                    $.ajax({
                        headers: {
                              'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        type:"post",
                        url:"{{route('view.category.filter1')}}",
                        data:{'psaph':a},
                        success:function(data){
                            console.log(data);
                            // data = abc
                            $('#tuan').html(data);
                        },
                        cache:false,
                        dataType: 'html'
                    });
                });         
            </script>
        @endsection
        