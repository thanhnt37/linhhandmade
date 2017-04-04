<div class="danhsach-donhang">
    @foreach($order as $item)
        <div class="row" style="margin:0px !important;border-bottom:1px solid #d9d9d9 ">
            <div class="center-col margin-ten no-margin-top xs-margin-bottom-seven let" style="margin-top: 15px !important; margin-bottom: 15px !important">
                
                    <span class="dsdh-title">Mã ĐH:</span> #{!! $item->id !!}&nbsp &nbsp-&nbsp &nbsp<span><span class="dsdh-title">Tình trạng:</span> <span></span>
                        @if($item->status == 0) Bị xóa @endif
                        @if($item->status == 1) Đang đợi @endif
                        @if($item->status == 2) Bị hủy @endif
                        @if($item->status == 3) Đang xử lý @endif
                        @if($item->status == 4) Đang giao hàng @endif
                        @if($item->status == 5) Đã thanh toán @endif
                        @if($item->status == 6) Đã nhận hàng @endif
                    </span><br>
            </div>
            @if($item->note_stick)
            <!-- <div class="row" style="margin:0px !important;border-bottom:1px solid #d9d9d9 "> -->
            <div class="center-col">
                    <p style="margin-top: -10px; margin-bottom: 15px">
                        <span class="t-note-pop dsdh-title">Ghi chú thêm: </span><span>{!! $item->note_stick !!}</span>
                    </p>
            </div>
            <!-- </div> -->
            @endif
        </div>
    @endforeach
</div><!-- end of danhsach-donhang -->

<!-- button  -->
<button title = "Close (Esc)" class="t-btn-hide btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu mfp-close">Đóng lại</button>
<!-- end button  -->