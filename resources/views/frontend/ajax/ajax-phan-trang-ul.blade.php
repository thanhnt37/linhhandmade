<?php
  $link_limit = 9; 
?>
<ul class="list-inline list-unstyled ">

  <li class="d-comment " style=" cursor:pointer;" data-page="{{ $comments->currentPage() - 1 }}" data-frame="{!! $product->id !!}"  ><a >Trước</a></li>
  @for ($i = 1; $i <= $comments->lastPage(); $i++)
        <?php
        $half_total_links = floor($link_limit / 2);
        $from = $comments->currentPage() - $half_total_links;
        $to = $comments->currentPage() + $half_total_links;
        if ($comments->currentPage() < $half_total_links) {
           $to += $half_total_links - $comments->currentPage();
        }
        if ($comments->lastPage() - $comments->currentPage() < $half_total_links) {
            $from -= $half_total_links - ($comments->lastPage() - $comments->currentPage()) - 1;
        }
        ?>
        @if ($from < $i && $i < $to)
            <li style="cursor:pointer;" data-page="{{ $i }}" data-frame="{!! $product->id !!}" class="d-comment {{ ($comments->currentPage() == $i) ? ' active' : '' }}">
                <a  href="{{ $comments->url($i) }}">{{ $i }}</a>
            </li>
        @endif
  @endfor
 
  <li class=" d-comment" style="cursor:pointer;" data-page="{{ $comments->currentPage() + 1 }}" data-frame="{!! $product->id !!}"  ><a>Sau</a></li>
</ul>