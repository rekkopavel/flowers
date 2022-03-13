<?php


function print_edit_banners($id){
   $text='';
   if (empty($_POST)){
      $row=_view_banners($id);
      $text=pars($row, load_tpl_var('cms_admin/banners/form_banners.tpl'));
   } else {
      $arr=array(
      		'contact_top'=>$_POST['contact_top'],
      		'banner_left1'=>$_POST['banner_left1'],
			'banner_left2'=>$_POST['banner_left2'],
			'banner_right0'=>$_POST['banner_right0'],
      		'banner_right1'=>$_POST['banner_right1'],
			'banner_right2'=>$_POST['banner_right2'],
			'contact_bottom'=>$_POST['contact_bottom'],
      		'banner'=>$_POST['banner'],
    			);
      _edit_banners($arr, $id);
      $text="<a href=?mod=banners>Назад</a>";
   }


    return $text;
}




function _view_banners($id){
  $query=sql_placeholder('select * from ?#BANNERS where id=?', $id);
  return select_row($query);
}


function _edit_banners($arr, $id){
  $query=sql_placeholder('update ?#BANNERS set ?% where id=?', $arr, $id);
  $result= mysql_query($query)
   or db_error($query."\n\n".mysql_error()." line ".__LINE__." file ".__FILE__);

   return ($result)?1:0;
}

?>