<style type="text/css">
	.grey_color{ 
			font-family: "Roboto" !important;
            color: #40454B !important;
            opacity: 0.5
		 }
</style>.
@foreach ($tags as $element)
	 <option value="{{$element->tag}}" class="grey_color">
@endforeach