<option class="q-ft-option" value="-1" data-id="" >Chọn Quận , Huyện</option>
@foreach($district as $item)
<?php 
	$list_phi = App\Config_distric::where('district_id',$item->id)->get();
        $some = 0;
        if(sizeof($list_phi)){
            foreach ($list_phi as $key => $value2) {
                if((float)$weight > (float)$value2->min_weigh && (float)$weight <= (float)$value2->max_weigh ){
                    $some = $value2->price;
                }
                if((float)$weight > (float)$value2->max_weigh){
                    $max = App\Config_distric::where('district_id',$item->id)->max('price');
                    $max_w = App\Config_distric::where('district_id',$item->id)->max('max_weigh');
                    $c = (float)$weight - (float)$max_w;
                    $d = ((float)$c*(float)$value2->init_price)/$value2->init_weigh; 
                    $some = (float)$max + (float)$d;
                }
            }
        }else{
            $some = 0;
        }
?>
	<option data-price="{!! $some!!}" value="{!! $some !!}" data-id = "{!! $item->id !!}" >{!! $item->name !!}
		
	</option>
@endforeach