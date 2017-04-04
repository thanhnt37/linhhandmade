<div class="modal-header">
    <h5 class="modal-title" style="    font-weight: 600;font-size:15pt;">Đặt phí : {!! $province->name !!} </h5>
  </div>
  <div class="modal-body p-lg" style="padding: 0px 15px 15px;">
        <div class="table-responsive">
            <table class="table b-t" style=" margin-bottom: 0px;">
              <tbody id="d-province">
                <tr  data-id="{!! $province->id !!}">
                  <td style="width: 20%;padding:20px 0px;">
                      <label style="height: 40px;padding-top: 10px;font-size: 15px;">
                        {!! $province->name !!}
                      </label>
                  </td>
                  <td style="padding:20px 0px;">
                    <div class="m-money">
                      <input id="d-price-province" style="height:40px; width: 100%;padding-left:10px;" type="text" name="price" value="{{$province->price}}" >
                      <div class="m-tooltip"></div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
    <div><a id="add_price_province" data-id="{!! $province->id !!}" class="btn btn-sm warn pull-left add-attr"  data-dismiss="modal">ĐẶT GIÁ</a></div>
    <div style="clear:both"></div>
 </div>

  

