<style type="text/css">
	.tan .name_img_filter{
		color: #75005F;
	}
	.can-le-fillter label:after{
		display: none;
	}
</style>
<?php if(!isset($group_name))  $group_name = array();?>
@if(sizeof($filter_0))
	<?php
	 if (!function_exists('partition')) {
	     function partition( $list, $p ) {
	         $listlen = count( $list );
	         $partlen = floor( $listlen / $p );
	         $partrem = $listlen % $p;
	         $partition = array();
	         $mark = 0;
	         for ($px = 0; $px < $p; $px++) {
	             $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
	         
	             $partition[$px] = array_slice( $list, $mark, $incr );
	             $mark += $incr;
	         }
	         return $partition;
	     }
	 }
	 $cate_list = array();
	 foreach ($filter_0 as $key2 => $item2) {
	 	if($item2->name == "Màu sắc")
	   		array_push($cate_list, $item2);
	 }
	 $for_x = partition( $cate_list, 6 );
	 ?>
	@if(!in_array("Màu sắc", $group_name))
		<div class="c-form tan-filtersapxep1 t-filter3" style="margin-top: 24px;">
		    <h4>Màu sắc</h4>
		<form role="form ">
		    @foreach($for_x as $x1 )
		        <div class=" tan-filter2 tan-bovien1 tan-bovien ">
		           <ul>
		            @foreach($x1 as $x2)
		                <li class="@if(in_array($x2->id,$list_filter)) frame_tan tan-bovienpic @endif " data-filter="{!! $x2->id !!}"><img class="abcd filter_click" id="d-img-color" src="{{ $x2->img }}" /></li>
		            @endforeach
		           </ul> 
		        </div>    
		    @endforeach 
		    <div style=" clear:both; height: 6px;"></div>   
		    </form>
		</div><!--end c-form-->
		<div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
	@endif
@endif
 <!--sọc kẻ fillter--> 
<div class="tan-filtersapxep1 t-filter2">
<?php
	$name = "";
	$count = 0;
?>

@foreach($filter_0 as $key => $item)
	@if(!in_array($item->name, $group_name))
		@if($item->name != "Màu sắc")
			<?php $filter_h = App\Attribute::where('name',$item->name)->where('type',1)->first();?>
			@if($filter_h->isDelete == 0)
				@if($item->name != $name)
					<div class="c-form tan-filtersapxep1 t-filter2">
					    <h4>{!! $item->name !!}</h4>	            
				@endif
				@if(isset($filter_0[$key+1]))
					@if($filter_0[$key+1]->name != $filter_0[$key]->name)
							<div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}" style="margin-top: 5px;">
				        	    <label><input class="abc filter_click" type="checkbox" name="optradio">{!! $item->value !!}</label>
				        	</div>
				    	
			    	</div><!--end c-form-->
			    	<div class="tan-ke-bottom"></div>
			    	@else
							<div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}" style="margin-top: 5px;">
				        	    <label><input class="abc filter_click" type="checkbox" name="optradio">{!! $item->value !!}</label>
				        	</div>
			    	@endif
				@else
							<div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}" style="margin-top: 5px;">
				        	    <label><input class="abc filter_click" type="checkbox" name="optradio">{!! $item->value !!}</label>
				        	</div>
				    	
					</div><!--end c-form-->
				@endif
			@else
				@if($item->name != $name)
					<?php $count = 0;?>
					<div class=" tan-filtersapxep1 t-filter2" style="margin-bottom:18px">
					    <h4>{!! $item->name !!}</h4>      
				@endif
				@if(isset($filter_0[$key+1]))
					<!-- Kết thúc -->
					@if($filter_0[$key+1]->name != $filter_0[$key]->name)
							@if($count%2 == 0 )
								<ul class="can-le-fillter" data-num="1">
							@endif
							        <li class="pull-left" style="margin-right:5px">
		                                <div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}">
		                                    <label  style="padding-left:0px; padding-top: 5px; ">
		                                        <input class="abc filter_click" type="checkbox" name="optradio"  style="display:none">
		                                        <img src="{{asset($filter_0[$key]->img)}}">
		                                        <p  class="name_img_filter">{{$filter_0[$key]->value}}</p>
		                                    </label>
		                                </div>
		                            </li>
		                    @if($count%2 == 1 )        
		                        </ul>
					    		<div style="clear:both"></div>
					    	@endif
					    	</div><!--end c-form-->
					    	<div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
			    	@else
							@if($count%2 == 0 )
								<ul class="can-le-fillter" data-num="2">
							@endif
		                            <li class="pull-left" style="margin-right:5px">
		                                <div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}">
		                                    <label  style="padding-left:0px; padding-top: 5px; ">
		                                        <input class="abc filter_click" type="checkbox" name="optradio"  style="display:none">
		                                        <img src="{{asset($filter_0[$key]->img)}}">
		                                        <p  class="name_img_filter">{{$filter_0[$key]->value}}</p>
		                                    </label>
		                                </div>
		                            </li>
		                            
		                     @if($count%2 == 1 )        
		                        </ul>
					    		<div style="clear:both"></div>
					    	@endif
			    	@endif
				@else
							@if($count%2 == 0 )
								<ul class="can-le-fillter" data-num="3">
							@endif
		                            <li class="pull-left" style="margin-right:5px">
		                                <div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}">
		                                    <label  style="padding-left:0px; padding-top: 5px; ">
		                                        <input class="abc filter_click" type="checkbox" name="optradio"  style="display:none">
		                                        <img src="{{asset($filter_0[$key]->img)}}">
		                                        <p class="name_img_filter">{{$filter_0[$key]->value}}</p>
		                                    </label>
		                                </div>
		                            </li>
		                        </ul>
					    		<div style="clear:both"></div>
					    	</div><!--end c-form-->
					    	<div class="tan-ke-bottom"></div>
							@if($key != sizeof($filter_0) -1 )
								<div class="tan-ke-bottom"></div>  <!--sọc kẻ fillter-->
							@endif
				@endif
			@endif
		@endif
	@endif
	<?php $name = $item->name;?>
	<?php $count++ ;?>
@endforeach

<?php $name = ""; ?>
@foreach($filter_y as $key => $item)
	@if(!in_array($item->name, $group_name))
		@if($item->name != $name)
			<div class="c-form tan-filtersapxep1 t-filter2">
			    <h4>{!! $item->name !!}</h4>	            
		@endif
		@if(isset($filter_y[$key+1]))
			@if($filter_y[$key+1]->name != $filter_y[$key]->name)
					<div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}" style="margin-top: 5px;">
		        	    <label><input class="abc filter_click" type="checkbox" name="optradio">{!! $item->config_name !!}</label>
		        	</div>
	    	</div><!--end c-form-->
	    	<div class="tan-ke-bottom"></div>
	    	@else
					<div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}" style="margin-top: 5px;">
		        	    <label><input class="abc filter_click" type="checkbox" name="optradio">{!! $item->config_name !!}</label>
		        	</div>
	    	@endif
		@else
					<div class="radio  @if(in_array($item->id,$list_filter)) tan @endif " data-filter="{!! $item->id !!}" style="margin-top: 5px;">
		        	    <label><input class="abc filter_click" type="checkbox" name="optradio">{!! $item->config_name !!}</label>
		        	</div>
		    	
			</div><!--end c-form-->
		@endif
	@endif
	<?php $name = $item->name;?>
@endforeach
</div>