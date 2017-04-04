

<option class="q-ft-option" value="0">Chọn giá trị</option>
@foreach($filter as $k => $v)
 @if(!in_array($v->id, $not_in))
  @if($v->type ==0)
    <option class="q-ft-option" value="{{$v->id}}" required="">{{$v->value}}</option>
  @else
    <option class="q-ft-option" value="{{$v->id}}" required="">@if($v->config_name) {{$v->config_name}} @else {{$v->min}} - {{$v->max}} @endif </option>
  @endif
 @endif
@endforeach