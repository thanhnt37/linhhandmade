<form action="" method="post" id="d-form-nhap-kho">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<input type="hidden" name="frame_id" value="{!! $frame->id !!}">
  <div class="modal-header">
   <table>
       <tr>
           <td style="width: 98%;"><h5 class="modal-title">Nhập kho</h5></td>
           <td><button>Nhập</button></td>
       </tr>
   </table>
  </div>
  <div class="modal-body p-lg">
    <div class="so-sp">
       <p>Số lượng sản phẩm</p>
       <input type="text" name="sku" autocomplete="off">
    </div>
    @if($frame->sku <= 0 && sizeof($email_out_of_stocks))

    <div id="d-html-email">
    <div class="email-tb">
       <p>Email nhận thông báo</p>
       <table>
              <tr>
                 <th>Email</th>
                 <th>Họ tên</th>
             </tr>
             @foreach($email_out_of_stocks as $item)
             <tr>
                 <td>{!! $item->email !!}</td>
                 <td>{!! $item->username !!}</td>
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
    </div>
    <div class="so-sp">
       <p>Tiêu đề email</p>
       <input type="text" name="description" disabled autocomplete="off" value="{Domain} Đã có sản phẩm mới bạn mong chờ {tên sản phẩm}">
    </div>
    <div class="so-sp" style="margin-bottom: 5px;">
       <p>Nội dung email</p>
       <textarea style="height:100px;" rows="20" cols="100" disabled class="form-control">Đã có sản phẩm mới bạn mong đợi
Tên sản phẩm : {mã đơn hàng}
Link sản phẩm</textarea>
    </div>
    @endif
  </div>
</form>