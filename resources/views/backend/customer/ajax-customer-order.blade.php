<tr style="font-size:12px;">
      <td>
        Ngày mua 
      </td>
      <td>
        Tên khách 
      </td>
      <td>
        Mã
      </td>
      <td>
        Tổng
      </td>
      <td>
        Chi Tiết
      </td>
  </tr>
@foreach($order as $item) 
  <tr style="font-size:12px;">
      <?php $date = new DateTime($item->created_at);?>

      <td>
      {{$date->format(' d/m/Y')}}
      </td>
      <td>
      {!! $item->fullname !!}
      </td>
      <td>
      #{!! $item->id !!}
      </td>
      <td>
       {!! number_format((int)$item->total + $item->total_weight,0,'','.') !!} vnđ  
      </td>
      <td>
       <a href="{{ route('order.show',['id'=>$item->id]) }}" >Chi tiết</a> 
      </td>
  </tr>
@endforeach 