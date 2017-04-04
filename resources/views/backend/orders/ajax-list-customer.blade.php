<tr style="font-size:12px;">
  <td>
    Chọn
  </td>
  <td>
    Khách hàng 
  </td>
  <td>
    Email
  </td>
  <td>
    Số điện thoại
  </td>
  <td style="min-width: 100px">
    Địa chỉ
  </td>
</tr>
@foreach($order as $key => $item)
<tr style="font-size:12px;">
  <td style="width: 5%" class="customer_td">
    <label class="ui-check m-a-0">
      <input type="checkbox" class="has-value choose_customer" >
      <i class="dark-white" ></i>
    </label>
  </td>
  <td>
  {{$item->fullname}}
  </td>
  <td>
  {{$item->email}}
  </td>
  <td>
   {{$item->phone}}
  </td>
  <td >
   {{$item->address}}
  </td>
</tr>
@endforeach