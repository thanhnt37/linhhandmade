<form action="" id="form-child">
    <div class="modal-header">
        <table>
            <tbody>
                <tr>
                    <td style="width: 100%;">
                        <h5 class="modal-title">Tạo danh mục cấp {{sizeof($group_name)+1}}</h5>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-body p-lg d-danhmuc">
        <div class="wrap-d-duongdan">
            <table>
                <tr>
                    <td>
                        <ul class="d-duongdan">
                            <li><a href="">Tất cả sp</a></li>
                            <li>/</li>
                                @for($i = sizeof($group_name) - 1 ; $i>=0; $i--)
                                   <li><a href="">{{$group_name[$i]}}</a></li>
                                    <li style="margin-left: 5px;
                                    margin-right: 5px;
                                    color: #edeff0;">/</li>
                                @endfor
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <p>Chọn giá trị thuộc tính muốn gán vào danh mục này</p>
            <div id="notify2"></div>
            <div class="d-select-style">
                <select class="d-list-province" id="modal-attr-key" name="key">
                    <?php $list_attr = App\Attribute::where('type',1)->where('name','<>','Giá')->get(); ?>
                    <option class="q-ft-option" value="0" data-id="0">Chọn thuộc tính</option>
                    @foreach($list_attr as $k => $v)
                        @if(!in_array($v->name, $arr_name))
                            <option class="q-ft-option" value="{{$v->id}}" data-id="{{$v->id}}">{{$v->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="d-select-style" >
                <select class="d-list-province" id="modal-attr-value" name="value" >
                    <option class="q-ft-option" value="0">Chọn giá trị</option>
                </select>
            </div>
            <p>Tên danh mục</p>
            <input type="text" placeholder="Tên danh mục..." class="form-control" id="nameCategory2" name="name" value="">
            <input type="hidden" name="group_id" value="{{$item->id}}">
            <button class="d-content-footer-btn">Tạo</button>
            <div class="clearfix"></div>
        </div>
    </div>
</form>