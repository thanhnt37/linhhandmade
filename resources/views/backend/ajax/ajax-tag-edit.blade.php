<div id="Model-edit" class="modal zoom" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
           <form action="{{ route('tags.edit.post') }}" method="post" accept-charset="utf-8">
			    <input type="hidden" name="{{{$tag->id}}">
				<div class="form-group">
				   
					<input type="text" class="form-control" name="tag_name" value="{{$tag->name}}" >                        
			    </div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

