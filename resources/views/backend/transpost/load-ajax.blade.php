<input type="hidden" name="province" value="" id="d_province">
  <div class="modal-header">
      <table>
          <tbody>
              <tr>
                  <td style="width: 100%;">
                  <?php 
                    $province = App\Province::where('id',$district->provinceid)->first();
                  ?>
                      <h5 class="modal-title">Phí {!! $district->type !!} : {!! $district->name !!} - {!! $province->name !!} </h5>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
  <div class="modal-body p-lg d-danhmuc phi-van-chuyen">
    <table>
      <tr>
        <th>Từ</th>
        <th>Đến</th>
        <th>Giá</th>
      </tr>
      @foreach($conf as $item)
      <tr>
        <td><input type="text" disabled value="{!! $item->min_weigh !!}" style="cursor: not-allowed;">gr</td>
        <td><input type="text" disabled value="{!! $item->max_weigh !!}" style="cursor: not-allowed;">gr</td>
        <td><input type="text" disabled value="{!! $item->price !!}" style="cursor: not-allowed;">vnđ</td>
      </tr>
      @endforeach
    </table>
    {{-- <a style="padding: 0 4px 3px 4px;margin-top: 10px;display: block;" class="add-khoang-gia">
      <i class="material-icons" style="vertical-align: -3.5px;"></i> Thêm khoảng giá
    </a> --}}
    <div class="phi-van-chuyen-max">
      <p style="font-family: 'Roboto Bold'">Từ {!! $max !!}<sup>gr </sup> trở đi</p>
      <p>Cộng thêm <input type="text" disabled value="{!! $conf[0]->init_price !!}" style="cursor: not-allowed;">vnđ Khi thêm <input type="text" disabled value="{!! $conf[0]->init_weigh !!}" style="cursor: not-allowed;"> gr</p>
    </div>
  </div>