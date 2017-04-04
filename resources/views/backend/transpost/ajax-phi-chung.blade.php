@foreach($district as $v1)
    <ol class="dd-list dd-list-handle child_ol province_{!! $province->id !!}" style="margin-left:40px;" >
      <li class="dd-item">
        <div class="dd-content box">
          <div>
              <div class="menu_name">{!! $v1->name !!}</div>
              <div class="menu_edit">
              <div id="d-district-ajax_{!! $v1->id !!}" class="price_{!! $province->id !!}" style="float:left;padding-right:100px;">{!! number_format((int)$province->price,0,'','.') !!}đ</div>
              </div>
          </div>
        </div>
      </li>
    </ol>
 @endforeach