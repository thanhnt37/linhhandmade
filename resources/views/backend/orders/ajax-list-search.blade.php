
  <tr style="font-size:12px;">
    <td>
      Chọn
    </td>
    <td>
      Ảnh 
    </td>
    <td>
      Tên
    </td>
    <td>
      Mã
    </td>
    <td>
      Niêm Yết
    </td>
    <td>
      Sale
    </td>
  </tr>
  @foreach($product as $item)
  <tr style="font-size:12px;">
  <td style="width: 5%">
    <label class="ui-check m-a-0">
      <input type="checkbox" class="has-value choose-product" value="{{$item->id}}" >
      <i class="dark-white" ></i>
    </label>
  </td>
   <td>
   <img src="{!! asset($item->thumb_images) !!}" style="width:55px;height:auto;"  alt="">
  </td>
  <td>
   {!! $item->name !!}
  </td>
  <td>
   {!! $item->code_frame !!}
  </td>
  <td>
   {{number_format( (int)$item->price,0,'','.')}}<sup>đ</sup>
  </td>
  <td>
   {{number_format( (int)$item->price_sale,0,'','.')}}<sup>đ</sup>
  </td>
  </tr>
  @endforeach

