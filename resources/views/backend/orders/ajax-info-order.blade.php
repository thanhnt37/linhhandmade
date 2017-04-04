<form id="form-edit-order">
<div class="row">
  <input type="hidden" name="id" value="{{$order->id}}">
      <div class="col-sm-12" style="">
        <div class="form-group">
            <label for="single">Tình trạng</label>
            <select id="single" class="form-control select2" name="status">
                @if($order->status < 6)
                  @if($order->status != 5)
                    @if($order->status != 4 && $order->status != 3)
                      <option value="1" @if($order->status == 1 ) selected @endif >Đang chờ</option>
                    @endif
                  @endif
                  <option value="2" @if($order->status == 2 ) selected @endif >Bị hủy</option>
                  @if($order->status != 5)
                    @if($order->status != 4)
                      <option value="3" @if($order->status == 3 ) selected @endif >Đang xử lý</option>
                    @endif
                  <option value="4" @if($order->status == 4 ) selected @endif >Đang giao hàng</option>
                  @endif
                  <option value="5" @if($order->status == 5 ) selected @endif >Đã thanh toán</option>
                @endif
                @if($order->status == 5)
                  <option value="6" @if($order->status == 6 ) selected @endif >Đã nhận hàng</option>
                @endif
                 @if($order->status == 6)
                <option value="6" @if($order->status == 6 ) selected @endif >Đã nhận hàng</option>
                @endif
            </select>
        </div>    
      </div>
</div>   
<div class="form-group">
  <label>Ghi chú thay đổi</label>
  <textarea name="note_stick" class="form-control" rows="5">{{$order->note_stick}}</textarea>
</div>
<button id="add_attr_to_tab" class="btn btn-sm warn pull-left add-attr" type="submit">Lưu</button>
<div style="clear:both"></div>
</form>