<tr style="border-top: 1px solid #eceeef;" data-id="{!! $product->id !!}" id="d-del_related_{!! $product->id !!}">
    <td>{!! $product->name !!}</td>
    <td>{!! $product->code_frame !!}</td>
    <td style="text-align:center;"><img style="width: 60px!important;
    height: auto!important;margin: 10px;" src="{!! asset($product->thumb_images) !!}" alt=""></td>
    <input  type="hidden" name="productId[]" value="{!! $product->id !!}">
    <td style="text-align:center;cursor:pointer;" class="del_related" data-id="{!! $product->id !!}"><span id="d_sty" style="font-size:16px;">×</span></td>
</tr>