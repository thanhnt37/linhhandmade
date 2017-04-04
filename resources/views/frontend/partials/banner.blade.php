<div class="t-catagory" style="z-index: 99999">
    <div class="menu2">
        <ul>
        <?php $menu_item = App\Menu::where('status', 1)->orderby('order', 'asc')->get();?>
        @foreach ($menu_item as $item)
        @if($item->parent_id == 0)
        <li class="t-hover-catagory" >
            <a style="cursor:pointer;" href="{{url($item->link)}}" >{{$item->name}}</a>
            <i class="fa fa-angle-down pull-right dropdown-menu2" aria-hidden="true"></i>
            <ul class='t-sub-mn t-hover-catagory'>
          <?php subMenu($menu_item, $item->id);?>
            </ul>
        </li>
        @endif 
        @endforeach
        </ul>
        <div style="clear:both"></div>
    </div>
</div>