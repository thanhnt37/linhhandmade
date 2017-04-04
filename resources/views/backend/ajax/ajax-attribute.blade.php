<div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Sửa thuộc tính</h5>
              </div>
                 <form action="{{route('product.attribute.update.post')}}" method="post">
                            <div class="modal-body text-center p-lg">
                                <div class="row">
                                  <div class="col-sm-10 col-sm-offset-1" id="input-select" style="text-align: left;">

                                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                                          <input type="hidden" name="id" value="{{$attribute->id}}">
                                          <div class="form-group">
                                                <label>Tên thuộc tính </label>
                                                <input type="text" class="form-control" name="name" value="{{$attribute->name}}" >                  
                                          </div>
                                          <div class="form-group">
                                                <label>Phân loại thuộc tính</label>
                                                <select class="form-control" name="type" id="select2" value="{{$attribute->type}}">
                                                  <option value="">Chọn thuộc tính </option>
                                                  <option @if($attribute->type==1) selected="" @endif value="1">Sản phẩm</option>
                                                  <option @if($attribute->type==2) selected="" @endif value="2">Bộ lọc giá</option>
                                                  <option @if($attribute->type==3) selected="" @endif value="3">Bộ lọc</option>
                                                </select>               
                                          </div>
                                          <div class="form-group" id="san-pham2" style="display: @if($attribute->type !=2) display @else none @endif">
                                                <label>Giá trị </label>
                                                <input type="text" class="form-control" name="value" value="{{$attribute->value}}">                  
                                          </div>
                                          <div class="form-group" id="filter-price2" style="display:  @if($attribute->type ==2) display @else none @endif">
                                                <div class="col-md-12"><label>Khoảng giá cho bộ lọc </label></div>
                                                <div class="col-md-6">                                
                                                    <input type="mumber" class="form-control" placeholder="Giá trị min" name="min_price" value="{{$attribute->min}}" > 
                                                </div>
                                                <div class="col-md-6">
                                                   <input type="mumber" class="form-control" placeholder="Giá trị max" name="max_price" value="{{$attribute->max}}" > 
                                                </div>                
                                         </div>
                                  </div>   
                                   
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Hủy</button>
                              <button type="submit" class="btn danger p-x-md" >Tạo</button>
                            </div>
                </form>
</div><!-- /.modal-content -->