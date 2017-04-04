<?php
function cate_parent ($data, $parent=0, $str='', $select=0){
	foreach($data as $val){
	   $name =$val["name"];
	   $id   =$val["id"];
	   if($val["parent_id"] ==$parent){

	    if($select !=0 && $id == $select){
	      echo "<option value='$id' selected='selected'> $str $name</option>";
	    }
	     else{
	      echo "<option value='$id'> $str $name</option>";
          }
	    cate_parent($data,$id,$str.'--',$select);
 	   }
	  
	}
	
}
function choose_menu_link ($data, $type, $parent=0, $str='', $select='')
{   //dd($data);
	//dd($select);
	foreach($data as $item){
		  
		  $name = $item->name;
		  if($type == "danh-muc-bai-viet"){
		  	$slug = $type.'/'.$item->prefix.'-'.$item->id;
		  	if($item->parent_id ==$parent){
				if($select !='' && $slug == $select){

					 echo "<option value='$slug' selected='selected'> $str $name</option>";
				}
				else{
	                echo "<option value='$slug'> $str $name</option>";
				}
				choose_menu_link($data,$type, $item->id,$str.'--', $select );
			}
		  }else{
		  	$slug = $type.'/'.str_slug($item->name).'-'.$item->id;
		  	if($item->group_id ==$parent){
				if($select !='' && $slug == $select){

					 echo "<option value='$slug' selected='selected'> $str $name</option>";
				}
				else{
	                echo "<option value='$slug'> $str $name</option>";
				}
				choose_menu_link($data,$type, $item->id,$str.'--', $select );
			}
		  }
		
	}
}
function check_status_order($status){
	switch ($status) {
		case '1':
			echo 'đang đợi';
			break;
		case '2':
			echo 'bị hủy';
			break;
		case '3':
			echo 'đang xử lý';
			break;
		case '4':
			echo 'đang giao hàng';
			break;	
		case '5':
			echo 'đã thanh toán';
			break;
		case '6':
			echo 'đã nhận hàng';
			break;
		default:
			echo 'bị xóa';
			break;
	}
}



function mutiselect ($data, $parent=0, $str='', $selects){
	foreach($data as $k=> $val){
	   $name =$val->name;
	   $id   =$val->id;
	   if($val->parent_id ==$parent){
	  
	   if(in_array($id, $selects)){

	      echo "<option value='$id' selected=''> $str $name</option>";
	    }
	    else{
	      echo "<option value='$id'> $str $name</option>";
          }
	    mutiselect($data,$id,$str.'--',$selects);    	  
	   	
	  }
	  
 }
}

function subMenu($data, $id){
    foreach ($data as $value) {
        if($value['parent_id'] == $id){
        $link = url($value->link);
        echo "<li><a href='".$link."''>".$value['name']."</a>";
        subMenu($data, $value['id']);        }
        echo "</li>";
    }
}

function subMenuAttribute($data, $id){
    foreach ($data as $value) {
        if($value['group_id'] == $id){
        $link =url($value->link);
        echo "<li><a href='".$link."''>".$value['name']."</a>";
        subMenu($data, $value['id']);        }
        echo "</li>";
    }
}
?>