
     <?php $price = 0 ; 
        if( $product->price_sale ){
            $price = $product->price_sale;
        }else{
            $price = $product->price;
        }
        ?>   

<tr style="font-size:12px; background-color:rgba(0, 0, 0, 0);" data-id="{!! $product->id !!}" id="d-del">
    <td style="padding-left:5px !important;">
     {!! $product->name !!}
    </td>
    <td style="padding-left:5px !important;">
     <img src="{!! asset($product->thumb_images) !!}" style="width:55px;height:auto" alt="">
    </td>
      <td style="padding-left:5px !important;">
     {!! $product->code_frame !!}
    </td>
    <td>
     <input data-price="{!! (int)$price !!}" class="d-price" type="number"  style="width:40px;" value="1" name="productNum[]" >

     <input  type="hidden" name="productId[]" value="{!! $product->id !!}">

    </td>
    <td style="text-align:center">   
        {{number_format( (int)$price,0,'','.')}}<sup>đ</sup>  
    </td>
    <td>
        {{number_format( (int)$price,0,'','.')}}<sup>đ</sup>
    </td>
    <td>
     <a><span class="close-slide del" style="font-size:17px;opacity:0.5">×</span></a>
    </td>
</tr>
