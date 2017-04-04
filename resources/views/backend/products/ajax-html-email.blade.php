<div class="email-tb">
	<p>Email nhận thông báo</p>
	<table>
	<tr>
	   <th>Email</th>
	   <th>Họ tên</th>
	</tr>
	@foreach($email_out_of_stocks as $item1)
	<tr>
	   <td>{!! $item1->email !!}</td>
	   <td>{!! $item1->username !!}</td>
	</tr>
	@endforeach
	<tr>
               <td colspan="2" id="d-paginate-nhap-kho">
                <?php $link_limit = 7; ?>
                   <ul class="pagination">
                       <li class="d-paginate-ul-nhap-kho footable-page-arrow " style=" cursor:pointer;" @if ($email_out_of_stocks->currentPage() > 1 ) data-frame="{!! $frame->id !!}" data-page="{{ $email_out_of_stocks->currentPage() - 1 }}" @endif >
                           <a>Trước</a>
                       </li>
                       @for ($i = 1; $i <= $email_out_of_stocks->lastPage(); $i++)
                          <?php
                          $half_total_links = floor($link_limit / 2);
                          $from = $email_out_of_stocks->currentPage() - $half_total_links;
                          $to = $email_out_of_stocks->currentPage() + $half_total_links;
                          if ($email_out_of_stocks->currentPage() < $half_total_links) {
                             $to += $half_total_links - $email_out_of_stocks->currentPage();
                          }
                          if ($email_out_of_stocks->lastPage() - $email_out_of_stocks->currentPage() < $half_total_links) {
                            $from -= $half_total_links - ($email_out_of_stocks->lastPage() - $email_out_of_stocks->currentPage()) - 1;
                          }
                          ?>
                          @if ($from < $i && $i < $to)
                            <li style="cursor:pointer;" data-page="{{ $i }}" data-frame="{!! $frame->id !!}" class="d-paginate-ul-nhap-kho footable-page-arrow {{ ($email_out_of_stocks->currentPage() == $i) ? ' active' : '' }}">
                              <a>{{ $i }}</a>
                            </li>
                          @endif
                      @endfor
                       <li class="d-paginate-ul-nhap-kho footable-page-arrow " style=" cursor:pointer;"  @if($email_out_of_stocks->currentPage() < $email_out_of_stocks->lastPage()) data-frame="{!! $frame->id !!}" data-page="{{ $email_out_of_stocks->currentPage() + 1 }}"  @endif>
                           <a>Sau</a>
                       </li>
                   </ul>
               </td>
           </tr>
	</table>
</div>	