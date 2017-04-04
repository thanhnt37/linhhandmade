@foreach($district as $v1)
    <ol class="dd-list dd-list-handle child_ol province_{!! $province->id !!}" style="margin-left:40px;" >
      <li class="dd-item">
        <div class="dd-content box">
          <div>
              <div class="menu_name">{!! $v1->name !!}</div>
              <div class="menu_edit">
              <div id="d-district-ajax_{!! $v1->id !!}" style="float:left;padding-right:100px;">{!! number_format((int)$v1->price,0,'','.') !!}đ</div>
              <a id="d-dat-gia-district" data-id="{!! $v1->id !!}" href="">
                 Đặt Giá
              </a>
              </div>
          </div>
        </div>
      </li>
    </ol>
 @endforeach