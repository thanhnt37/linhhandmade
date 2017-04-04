<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" style="font-size: 10.5pt">Sửa tag</h5>
  </div>
     <form action="{{ route('tags.edit.post') }}" method="post">
                <div class="modal-body text-center p-lg">
                    <div class="row">
                      <div class="col-sm-12" id="input-select" style="text-align: left;">

                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <input type="hidden" name="id" value="{{$tag->id}}">
                              <div class="form-group">
                                  
                                    <input type="text" class="form-control" name="tagname" value="{{$tag->tag}}" >                  
                              </div>
                      </div>   
                       
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn dark-white p-x-md edit-tag_cancel" data-dismiss="modal">Hủy</button>
                  <button type="submit" class="btn danger p-x-md edit-tag_submit" >Sửa</button>
                </div>
  </form>
</div><!-- /.modal-content -->
