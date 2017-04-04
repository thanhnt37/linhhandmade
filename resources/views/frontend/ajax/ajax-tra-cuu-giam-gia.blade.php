<?php 
    $config = App\Configure_discounts::get();
    $percent = 0;
    foreach ($config as $key => $value) {
        if($value->targets <= $custom->points){
            $percent = $value->percent;
        }
    }
?>
<h4 class="t-process-pop">{{ $percent }} %<span> trên Tổng giá trị đơn hàng</span></h4>
<!-- button  -->
<button title = "Close (Esc)" class="t-btn-hide btn btn-black no-margin-bottom btn-small font-weight-400 t-xd-pu mfp-close">Đóng lại</button>
<!-- end button  -->
