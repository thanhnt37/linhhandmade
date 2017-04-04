<div class="center-col ">
@if($percen > 0)
     <span style="font-size: 9.5pt"><span>{!! $order->fullname !!}</span> thân mến,</span>
    <p style="font-size: 9.5pt">Hệ thống nhận ra bạn là khách hàng quen thuộc của {!! url('') !!}. Với chương trình tích điểm chúng tôi đang có Đơn hàng này của bạn sẽ được áp dụng giảm giá.</p>
<table>
    <tr>
        <td>Tổng đơn hàng</td>
        <td>{!! number_format((int)$total,0,'','.') !!} đ</td>
    </tr>

    <tr>
        <td>Giảm {!! $percen !!}%</td>
        <?php 
            $a = ($total_non_sale * ($percen))/100;
            $b =  $total - $a;
        ?>
        <td>-{!! number_format((int)$a,0,'','.') !!} đ</td>
    </tr>
    <tr>
        <td>Phí vận chuyển</td>
        <td>{!! number_format((int)$total_weight1,0,'','.') !!} đ</td>
    </tr>
    <tr>
        <td><span>Cần thanh toán</span></td>
        <td><span>{!! number_format((int) $b + $total_weight1 ,0,'','.') !!} đ</span></td>
    </tr>
</table>
@else
<span>Đặt hàng thành công</span>
@endif
<!-- button  -->
<button id="d-esc" title = "Close (Esc)" class="t-btn-hide btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu mfp-close">Đi đến thanh toán</button>
</div>
<!-- end button  -->

            