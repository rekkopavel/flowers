<?

if (!$modul)
{
  $textaccess.='<a href=?mod=user&modul=cms&action=g2u&gid='.$gid.'>МодульCMS</a><br>';
}
elseif (empty($_POST['access']) && $modul=='cms')
{
  $textaccess.=list_action_cms($gid, $modul);
}
elseif (!empty($_POST['access']) && $modul=='cms')
{
   $textaccess.=accesstogroup($gid);
}

function list_action_cms($gid, $modul)
{
  if($modul!='cms') return '';
  $query=sql_placeholder('select * from ?#CMS_ACTION');
  $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");
  $text='';
  $i=0;
  $tpl=load_tpl_var('cms_admin/users/list_access.tpl');
  $tpl_tr=pars_reg($tpl, "ACCESS");
  while($row=mysql_fetch_assoc($result))
  {
		    $row=stripslashes_array($row);
		    $i++;
		    $query=sql_placeholder('select count(*) as cnt from ?#CMS_ACCESS where gid=? and name=?', $gid, $row['name']);
		    $row['checked']=(select_row($query))?'checked':'';
		    $row['color']=($i%2)?'ffffff':'95B6FF';
		    $text.=pars($row, $tpl_tr);
  }
 $text='<b>Модуль CMS</b>'.str_replace($tpl_tr, $text,$tpl);
 return $text;
}
?>