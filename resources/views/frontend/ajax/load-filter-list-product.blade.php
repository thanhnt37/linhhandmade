<?php $list_color = App\Filter::where('name','Màu Sắc')->get();
    $in_color = array();
    foreach ($list_color as $key => $value) {
        array_push($in_color, $value->attribute_id);
    }    
?>  
@foreach($products as $key=> $data)
                    <?php $id_product = $data->product_id; $frame_str =  $data->frame_str;?>
                            <?php $list_frame = explode(",",$frame_str);
                              $in = array();
                              foreach ($list_frame as $key => $id_frame) {
                                  if($id_frame){
                                    array_push($in, $id_frame);
                                  }
                              }
                            $frame_y = App\Frame::whereIn('id',$in)->orderby('updated_at','desc')->get();

                            ?>

                    @if(sizeof($frame_y))
                        <div class="col-xs-6 col-sm-4 col-lg-4 col-12-mobile h-res-mar">
                            <div id="d-ajax" class="d-ajax_{!! $data->product_id !!} d-sp d-sp-top text-center " data-id="{!! $data->product_id !!}" style="margin-top: 15px;">
                                @if($frame_y[0]->label == 1)<div class="moi">Mới</div>@endif
                                @if($frame_y[0]->label == 2)<div class="kool">Kool</div>@endif
                                @if($frame_y[0]->label == 3)<div class="off">Sale</div>@endif
                                <a class="d-list-xem" data-id="{!! $frame_y[0]->id !!}" href="{!! Route('getProDetail',['id'=>$frame_y[0]->id,'slug'=>$frame_y[0]->slug]) !!}"><img src="{{ $frame_y[0]->img }}" alt=""></a>
                                <div class="absolute_img tan-bovien"> 
                                    <ul class="div_img">
                                    @foreach($frame_y as $key=> $item)
                                        @if($key > 2)
                                            <?php
                                                $attr_color = DB::table('frame_attributes')
                                                 ->whereIn('frame_attributes.attribute_id',$in_color)
                                                 ->where('frame_attributes.frame_id',$item->id)
                                                 ->leftjoin('filters','frame_attributes.attribute_id','=','filters.attribute_id')->first(); 
                                            ?> 
                                            @if($attr_color)
                                            @if(sizeof($frame_y) == 4)
                                                <li style="cursor:pointer;" class="@if($key == 0) tan-bovienpic @endif" id="d-ajax-fame" data-id="{!! $item->id !!}"><img   src="{!! $attr_color->img !!}"></li>
                                            @else 
                                                <li style="cursor:pointer; position:relative" class="@if($key == 0) tan-bovienpic @endif" id="d-ajax-fame" data-id="{!! $item->id !!}"><a href="{!! Route('getProDetail',['id'=>$item->id,'slug'=>$item->slug]) !!}" style="position: absolute;left: 0;top: 6px;" ><span style="display: inline-block;width: 17px;height: 17px;border: solid 1px #a3a3a3;border-radius: 50%;color: #a3a3a3;line-height: 15px;text-align: center;padding-left: 0px;margin-left: 2px;">+</span> </a> </li>
                                                <?php break; ?>
                                            @endif
                                            @endif
                                        @else
                                            <?php
                                             $attr_color = DB::table('frame_attributes')
                                             ->whereIn('frame_attributes.attribute_id',$in_color)
                                             ->where('frame_attributes.frame_id',$item->id)
                                             ->leftjoin('filters','frame_attributes.attribute_id','=','filters.attribute_id')->first(); 
                                            ?> 
                                            @if($attr_color)
                                            <li style="cursor:pointer;" class="@if($key == 0) tan-bovienpic @endif" id="d-ajax-fame" data-id="{!! $item->id !!}"><img src="{!! $attr_color->img !!}"></li>
                                            @endif
                                        @endif
                                    @endforeach
                                    </ul>     
                                </div>
                                <p><a class="d-list-xem" data-id="{!! $data->product_id !!}" href="{!! Route('getProDetail',['slug'=>$frame_y[0]->slug,'id'=>$frame_y[0]->id]) !!}">{{ $frame_y[0]->name }}</a></p>
                                <p class="fontBold" style="color: #000;">

                                    @if($frame_y[0]->price_sale)
                                        <span class="catagory-sale">{!! number_format( $frame_y[0]->price,0,'','.' ) !!}đ</span>
                                        {!! number_format( $frame_y[0]->price_sale,0,'','.' ) !!}đ
                                    @else
                                        {!! number_format( $frame_y[0]->price,0,'','.' ) !!}đ
                                    @endif
                                </p>
                            </div><!-- end of d-sp -->
                        </div><!--/.col-xs-6.col-lg-4--> 
                            
                    @endif   
                    
                    @endforeach