@foreach($logs as $key => $log)
	<div>
		<p><strong>Người cập nhập</strong>: {{$log->username}}</p>
		<p><strong>Thời gian cập nhập</strong>:<?php $date = new DateTime($log->created_at);?>
        {{$date->format(' d/m H:i')}}</p>
		<p><strong>Tình trạng đơn hàng</strong>:  
						@if($log->status == 1)
                        <span class="label"  style="background-color:#777777">Đang chờ</span>
                        @endif
                        @if($log->status == 2)
                        <span class="label"   style="background-color:#D9534F">Bị hủy</span>
                        @endif
                        @if($log->status == 3)
                        <span class="label"   style="background-color:#0CC2AA">Đang xử lý</span>
                        @endif
                        @if($log->status == 4)
                        <span class="label"   style="background-color:#F0AD4E">Đang giao hàng</span>
                        @endif
                        @if($log->status == 5)
                        <span class="label"   style="background-color:#5CB85C">Đã thanh toán</span>
                        @endif
                        @if($log->status == 6)
                        <span class="label"   style="background-color:#337AB7">Đã nhận hàng</span>
                        @endif 
        </p>
		<p><strong>Ghi chú</strong>: {{$log->note_stick}}</p>
		@if($key != sizeof($logs) - 1)
		<hr>
		@endif
	</div>
@endforeach