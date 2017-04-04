@if(sizeof($product) > 1)
  <tr style="font-size:12px;background-color:none!important;" id="d_none">
    <th style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
      Chọn
    </th>
    <th style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
      Ảnh 
    </th>
    <th style=" padding-top: 10px; padding-bottom: 10px;">
      Tên
    </th>
    <th style=" padding-top: 10px; padding-bottom: 10px;">
      Mã
    </th>
    <th style=" padding-top: 10px; padding-bottom: 10px;">
      Niêm Yết
    </th>
    <th style=" padding-top: 10px; padding-bottom: 10px;">
      Sale
    </th>
  </tr>
  @foreach($product as $item)
    @if($item->id != $frame->id)
      <tr style="font-size:12px;" data-check="{!! $item->id !!}">
      <td style="width: 5%; text-align:center;">
        <label class="ui-check m-a-0">
          <input type="checkbox" class="has-value choose-product1" value="{{$item->id}}" >
          <i class="dark-white" ></i>
        </label>
      </td>
       <td style=" text-align:center; padding-top: 5px; padding-bottom: 5px;">
       <img src="{!! asset($item->thumb_images) !!}" style="width:55px;height:auto;margin: 10px;"  alt="">
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
    @endif
  @endforeach

@endif
