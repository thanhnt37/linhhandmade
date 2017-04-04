<ul>
    <?php
      $link_limit = 7; 
    ?>
    <ul>
      <li><a class="
      @if($status ==0) d-ajax-click-load-filter @endif 
      @if($status ==1) d-ajax-click-search-filter @endif 
      @if($status ==2) d-ajax-click-vua-xem-filter @endif 
      " @if($products->currentPage() > 1) data-page="{!! $products->currentPage() - 1 !!}" @endif
      @if($status ==0) href="@if($products->currentPage() > 1) {!! $products->currentPage() - 1 !!} @else {{ $products->url(1) }} @endif " @endif
      @if($status ==1) href="@if($products->currentPage() > 1) {!! $products->currentPage() - 1 !!} @else {{ $products->url(1) }}&search={!! $a !!} @endif " @endif
      @if($status ==2) href="@if($products->currentPage() > 1) {!! $products->currentPage() - 1 !!} @else {{ $products->url(1) }} @endif " @endif

      >Trước</a></li>
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
                        <a class="
                        @if($status ==0) d-ajax-click-load-filter @endif
                        @if($status ==1) d-ajax-click-search-filter @endif
                        @if($status ==2) d-ajax-click-vua-xem-filter @endif
  
                        " data-page="{!! $i !!}"
                        @if($status==0) href="{!! $products->url($i) !!}" @endif 
                        @if($status==1) data-search="{!! $a !!}" href="{{ $products->url($i) }}&search={!! $a !!}" @endif
                        @if($status==2) href="{!! $products->url($i) !!}" @endif 
                        >{{ $i }}</a>
                    </li>
                @endif
      @endfor
      <li class="next"><a class="
        @if($status ==0) d-ajax-click-load-filter @endif 
        @if($status ==1) d-ajax-click-search-filter @endif 
        @if($status ==2) d-ajax-click-vua-xem-filter @endif 
      "  data-page="@if($products->currentPage() < $products->lastPage()) {!! $products->currentPage() + 1 !!} @else {!! $products->currentPage() !!}  @endif"  
      @if($status ==0) href="@if($products->currentPage() < $products->lastPage()) {!!  $products->url($products->currentPage() + 1) !!} @else {!! $products->currentPage() !!} @endif " @endif
      @if($status ==1)  href="{{ $products->url($products->lastPage()) }}&search={!! $a !!}" @endif
      @if($status ==2) href="{!!  $products->url($products->lastPage()) !!}" @endif
      >Sau</i></a></li>
    </ul>
    <!-- /.list-inline --> 
  </div>
</ul>
