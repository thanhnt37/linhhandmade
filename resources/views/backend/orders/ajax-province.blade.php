<select class="form-control" name="district">
    <option value="0">Chọn quận huyện</option>
    @foreach($district as $key=>$item)
		<option value="{!! $item->id !!}">- {!! $item->name !!}</option>
    @endforeach
</select>