<p style="display: inline-block;padding: 5px; margin-top: 21px;margin-bottom: 1px">
    @if( (isset($route_attr) && sizeof($route_attr)) || (isset($list_filter) && sizeof($list_filter)) )
    <span style="font-family: Roboto Medium;font-size: 10pt;" class="d-dachon-title">Đã chọn:</span></p>
    @endif
    <div style="display: inline-block; padding: 5px;">
<style type="text/css">
    .stag-box {display: inline-block;}
    .stag-ctg, .stag-tht {margin: 0 15px 0 5px; cursor: pointer;}
    .stag-txt {cursor: pointer; padding: 3px 6px; border-radius: 3px; transition: .2s;}
    .stag-txt:hover {color: #56822E;}
    .stag-ctg>.flaticon-close, .stag-tht>.flaticon-close {color: #fff; border-radius: 15px; cursor: pointer; transition: .2s;}
    .stag-ctg>.flaticon-close:hover::before, .stag-tht>.flaticon-close:hover::before {background-color: #56822E; transition: .2s;}
    .stag-ctg>.flaticon-close::before, .stag-tht>.flaticon-close::before {font-size: 5pt; margin: 0; position: relative; top: -2px; width: 16px; height: 16px; line-height: 18px; border-radius: 15px; text-align: center; display: inline-block; background-color: #C9E1BD;}
    .flaticon-close:before {
        content: "\f104";
    }
    .txtlnthgh {
        text-decoration: line-through !important;
    }
</style>

@if(isset($route_attr) && sizeof($route_attr))
    @for($i = (sizeof($route_attr) -1 ); $i>=0; $i--)
        @if($i == (sizeof($route_attr) -1) )
            <span class="stag-ctg stag-ctg-prnt" >
                <span class="stag-txt">{{$route_attr[$i]->name}}</span>
                <span class="flaticon-close stag-close-ctg-prnt" data-href="{{route('view.category.new.products',['slug'=>str_slug($route_attr[$i]->name),'id'=>$route_attr[$i]->id])}}" ></span>
            </span>
        @else
        <span class="stag-ctg stag-ctg-prnt">
            <span class="stag-txt">{{$route_attr[$i]->name}}</span>
            <span class="flaticon-close stag-close-ctg-prnt" data-href="{{route('view.category.new.products',['slug'=>str_slug($route_attr[$i + 1]->name),'id'=>$route_attr[$i + 1]->id])}}"></span>
        </span>
        @endif
    @endfor
@endif
@if(isset($list_filter) && sizeof($list_filter))
        <?php $filter_tag = App\Filter::whereIn('id',$list_filter)->get();?>
        @foreach($filter_tag as $key => $item)
            <span class="stag-tht" data-filter="{{$item->id}}">
                @if($item->type==0)
                <span class="stag-txt">{{$item->value}}</span>
                @else
                <span class="stag-txt">{{$item->config_name}}</span>
                @endif
                <span class="flaticon-close stag-close-tht"></span>
            </span>
        @endforeach
@endif

    </div>
<div style="clear: both"></div>