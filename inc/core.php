<?php
function ip2int($ip) {
   $a=explode(".",$ip);
   return $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
}
function int2ip($i) {
   $d[0]=(int)($i/256/256/256);
   $d[1]=(int)(($i-$d[0]*256*256*256)/256/256);
   $d[2]=(int)(($i-$d[0]*256*256*256-$d[1]*256*256)/256);
   $d[3]=$i-$d[0]*256*256*256-$d[1]*256*256-$d[2]*256;
   return "$d[0].$d[1].$d[2].$d[3]";
}
function _view_page($id){
  $query=sql_placeholder('select c.*, p.content from ?#CATALOG as c left join ?#CONTENT as p
  		on (c.id=p.id)
  		where c.id=?
  		', $id);
   $row=select_row($query);
   return $row;
}
 function print_menu($tpl, $id=1){

     $text='';
     $arr=_list_menu($id);
     foreach($arr as $vl){
     	$text.=pars($vl, $tpl);
     }
    return $text;
 }
 function _list_menu($pid){

    $r=array();
    $query=sql_placeholder('select  * from ?#CATALOG where parent_id=? order by num', $pid);

    $result=mysql_query($query)
    	or db_error($query."\n\n".mysql_error()."\n\n line ".__LINE__.' file '.__FILE__);
   if (!$result) return 0;
   while($row=mysql_fetch_assoc($result)){
       $row=stripslashes_array($row);
       $r[]=$row;
    }
   return $r;
 }
function _list_banners($pid=0){
  $query=sql_placeholder('select contact_top, banner_left1, banner_left2,banner_right1, banner_right2, contact_bottom, banner, banner_right0 from ?#BANNERS');
  return select_row($query);
}
function _make_ukey(){
    if (!isset($_SERVER["HTTP_X_FORVARDED_FOR"]))$_SERVER["HTTP_X_FORVARDED_FOR"]=$_SERVER["REMOTE_ADDR"];
    return $_SERVER["REMOTE_ADDR"].'_'.$_SERVER["HTTP_X_FORVARDED_FOR"];
}
function _list_variant($vop_id){

   $r=array();
   $query=sql_placeholder('select * from variant where vop_id=? order by num ', $vop_id);
   $result=mysql_query($query)
   		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
   while($row=mysql_fetch_assoc($result)){
      $r[]=$row;
   }
   return $r;
}

function _make_otvet($var_id){
  $ukey=_make_ukey();
  $query=sql_placeholder('select vop_id from variant where id=?', $var_id);
  $vop_id=select_row($query);

  if (!$vop_id) return 0;
  if (!_check_otver($vop_id, $ukey)){
    $query=sql_placeholder('insert into otvet (`vop_id`, `var_id`, `ukey`) values(?,?,?)', $vop_id, $var_id, $ukey);
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
     if ($result){
        $query=sql_placeholder('update variant set cnt_otvet=cnt_otvet+1 where id=? ', $var_id);
        $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
      return 1 ;
     }
  }
    return 0;
}

function _check_otver($vop_id, $ukey){
    $query=sql_placeholder('
  	select count(*) as cnt  from  otvet where vop_id=? and ukey=?', $vop_id, $ukey);
    return select_row($query);

}
function _get_vopros(){
   $query=sql_placeholder('select * from  vopros ');
   $arr[0]=select_row($query);
   $arr[1]=_list_variant($arr[0]['id']);
   return $arr;
}
function print_vote(){

    $text='';
    $arr=_get_vopros();
    $tpl=load_tpl_var('vote_form.tpl');
    $ukey=_make_ukey();
    $tpl_tr=(!_check_otver($arr[0]['id'], $ukey))?pars_reg($tpl, "TR"):pars_reg($tpl, "TR2");
    $tpl_main=pars($arr[0], pars_reg($tpl, "MAIN"));
    foreach($arr[1] as $row){
     $text.=pars($row, $tpl_tr);
    }
    $text=pars(array('TR'=>$text), $tpl_main);
    return $text;
}
function mail_send(){
 $fio = (empty($_POST['fio']))?'':$_POST['fio'];
 $email = (empty($_POST['email']))?'':$_POST['email'];
 $subject = (empty($_POST['subject']))?'':$_POST['subject'];
 $text = (empty($_POST['text']))?'':$_POST['text'];
	if ($email!='' && $text!='') {  
  if (!preg_match('/.+\@.+\..+/', $email) && $email!='') {
    $r='<br><font color=red>Ошибка: Неправильный адрес e-mail!</font><br><br><br>';
  } else {
   $message="Добрый день!

Вам пришло сообщение  с сайта dostavka-rus.ru
<br><br>

Информация о посетителе:<br>

Имя: $fio<br><br>

E-mail: $email<br><br>

Тема сообщения: $subject<br><br>


Текст сообщения:<br>



$text

-------------------------------------------------<br>


Это письмо было сгенерировано автоматически. Пожалуйста, не отвечайте на него.<br>

С уважением,<br>
  Робот Обслуживания,<br>
  dostavka-rus.ru";
send_mail_html("dostavka-rus.ru", "dostavka-rus@mail.ru", $subject, $message);
  
   $r="Ваше сообщение отправлено.<br><br><br>";
  };}
 else {
 $r='<br><font color=red>Ошибка: Не все обязательные поля заполнены</font><br><br><br>';
 }

return $r;
}
function make_history($tpl, $arr){

   array_shift($arr);
   $cnt=count($arr);
   $text='';
   for($i=0;$i<$cnt;$i++){
      $row=_view_page($arr[$i]);
      // print_r(_view_page())  //
      if($i<$cnt-1)
         $text.=pars($row, $tpl);
      else {
      	$text.=" ".$row['name'];
      }
   }
   return $text;
}
$parent_menu=array();

function _list_parent_id($id){
    global $parent_menu;
	$r=array();
	$query=sql_placeholder('select parent_id from ?#CATALOG where id=?', $id);
	$row['parent_id']=select_row($query);
	if ($row['parent_id']>0){
	 $parent_menu[]=$row['parent_id'];
     _list_parent_id($row['parent_id']);
	}
    return $parent_menu;
}

function print_submenu($tpl, $id=0, $parent){
    $text='';
    $arr=_list_menu($id);
    foreach($arr as $row){
	
       if (in_array($row['id'], $parent)){
          $row['sub']=print_submenu($tpl, $row['id'], $parent);
       }
       else{
       	$row['sub']='';
       }
      $text.=pars($row, $tpl);
     }
    return $text;
}
  function _list_sub($pid){

    $r=array();
   $query=sql_placeholder('select * from ?#SUB where pid=?   order by num ',$pid);
  $result=mysql_query($query);

   if (!$result) return 0;
   while($row=mysql_fetch_assoc($result)){
       $row=stripslashes_array($row);
       $r[]=$row;
	  
    }
   return $r;
 }
 function _list_cat($type){
         $query=sql_placeholder('select * from ?#CATALOG where type=? ',$type);
    $row1=select_row($query);
	$id=$row1['id'];
    $r=array();
   $query=sql_placeholder('select * from ?#MADER where list_parent like \'%'.$id.'%\'   order by num ');
  $result=mysql_query($query);
   if (!$result) return 0;
   while($row=mysql_fetch_assoc($result)){
       $row=stripslashes_array($row);
	   $row['type']=$type;
	   $row['mader']= $row['id'];
       $r[]=$row;
    }
   return $r;
 }

function sub_menu($tpl_sub,$mader){

  $text='';
    $arr=_list_sub($mader);
    foreach($arr as $row){
	   
		
       $text.=pars($row, $tpl_sub);
	   }
	   
    return $text;
}
function cat_menu($tpl_cat1,$tpl_cat2,$tpl_sub, $type=0){
    $text='';
    $arr=_list_cat($type);
    foreach($arr as $row){
	   if ($row['reg']==0){$tpl_cat=$tpl_cat1;}else{$tpl_cat=$tpl_cat2;};
       $text.=pars($row, $tpl_cat);
	   $mader=$row['mader'];
	   $query=sql_placeholder('select * from ?#SUB where pid=? order by num',$mader);
       $result=mysql_query($query);
        if ($result){
		
		$text_sub=sub_menu($tpl_sub,$mader);
		$text.=$text_sub;
		};
	   
                         }
    return $text;
}

function list_otz($tpl){
 $page=(empty($_GET['page']))?1:(int)$_GET['page'];

     $text='<div align="center" class="h2">Фото доставок:</div><br>';
    $query=sql_placeholder('select * from ?#OTZ  order by date_otz desc  limit  ?,? ',($page-1)*LIMIT_PAGE, LIMIT_PAGE);
    //echo $query;
	
	 $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
		    if (!$result) return '';
		$query=sql_placeholder('select count(*) as cnt from ?#OTZ ');

           $cnt=select_row($query);
		   



    while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		$row['date_otz']=date(" d.m.Y", $row['date_otz']);
        $text.=pars($row, $tpl);
    }
	 $list_page='';
	 
	if ($cnt>LIMIT_PAGE){
     for($i=1;$i<=ceil($cnt/LIMIT_PAGE);$i++){
      $list_page.=($i==$page)?'[ '.$i.' ]':'[ <a href=?action=otz&id='.$pid.'&page='.$i.'>'.$i.'</a> ]';
      }
    }
	
	$text.='<div align="center">'.$list_page.'</div>';
	
  return array('name'=>'Отзывы', 'content'=>$text);

}
function list_last_news($tpl, $pid){
    $text='<div align="center" class="h2">ПОСЛЕДНИЕ НОВОСТИ:</div><br>';
    $query=sql_placeholder('select * from ?#NEWS  order by date_news desc limit 7', $pid);
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
    if (!$result) return '';

    while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		$row['date_news']=date(" d.m.Y", $row['date_news']);
        $text.=pars($row, $tpl);
    }
  return $text;
}

function list_news($tpl, $pid){
 $page=(empty($_GET['page']))?1:(int)$_GET['page'];

     $text='<div align="center" class="h2">НОВОСТИ:</div><br>';
    $query=sql_placeholder('select * from ?#NEWS where pid=? order by date_news desc  limit  ?,? ', $pid,($page-1)*LIMIT_PAGE, LIMIT_PAGE);
    //echo $query;
	
	 $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
		    if (!$result) return '';
		$query=sql_placeholder('select count(*) as cnt from ?#NEWS where  pid=?', $pid);

           $cnt=select_row($query);
		   



    while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		$row['date_news']=date(" d.m.Y", $row['date_news']);
        $text.=pars($row, $tpl);
    }
	 $list_page='';
	 
	if ($cnt>LIMIT_PAGE){
     for($i=1;$i<=ceil($cnt/LIMIT_PAGE);$i++){
      $list_page.=($i==$page)?'[ '.$i.' ]':'[ <a href=?action=news&id='.$pid.'&page='.$i.'>'.$i.'</a> ]';
      }
    }
	
	$text.='<div align="center">'.$list_page.'</div>';
	
  return array('name'=>'Новости', 'content'=>$text);

}
function view_news($tpl, $id){
  $text='';
  $query=sql_placeholder('select * from ?#NEWS where id=?', $id);
  $row=select_row($query);
   if (!$row) return array('name'=>'', 'content'=>'Новость не найдена');
  $row['date_news']=date(" d.m.Y", $row['date_news']);
  return array('name'=>$row['header_news'], 'content'=>pars($row, $tpl));
}

function list_arr_id($arr_id){
$temp_arr_id=$arr_id;
  foreach($arr_id as $parent_id){
$query=sql_placeholder('select id from ?#CATALOG where parent_id=? ', $parent_id);
     $result=select_col($query);
		if ($result){$row=list_arr_id($result);

     $temp_arr_id=array_merge($temp_arr_id, $row);
	             };         

}
return $temp_arr_id;
};
function list_serv($tpl, $pid){
 $page=(empty($_GET['page']))?1:(int)$_GET['page'];

     $text='<div align="center" class="h2">СЕРВИСЫ:</div><br>';
    $query=sql_placeholder('select * from ?#SERV where pid=? order by date_news desc  limit  ?,? ', $pid,($page-1)*LIMIT_PAGE, LIMIT_PAGE);
    //echo $query;
	
	 $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
		    if (!$result) return '';
		$query=sql_placeholder('select count(*) as cnt from ?#SERV where  pid=?', $pid);

           $cnt=select_row($query);
		   



    while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		
        $text.=pars($row, $tpl);
    }
	 $list_page='';
	 
	if ($cnt>LIMIT_PAGE){
     for($i=1;$i<=ceil($cnt/LIMIT_PAGE);$i++){
      $list_page.=($i==$page)?'[ '.$i.' ]':'[ <a href=?action=serv&id='.$pid.'&page='.$i.'>'.$i.'</a> ]';
      }
    }
	
	$text.='<div align="center">'.$list_page.'</div>';
	
  return array('name'=>'Сервисы', 'content'=>$text);

}
function view_serv($tpl, $id){
  $text='';
  $query=sql_placeholder('select * from ?#SERV where id=?', $id);
  $row=select_row($query);
   if (!$row) return array('name'=>'', 'content'=>'Новость не найдена');
  $row['date_news']=date(" d.m.Y", $row['date_news']);
  return array('name'=>$row['header_news'], 'content'=>pars($row, $tpl));
}

function list_last_info($tpl){

    $text='';
    $query=sql_placeholder('select * from ?#INFO  order by date_info desc limit 7 ');
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
    if (!$result) return '';
    while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		$row['date_info']=date(" d.m.Y", $row['date_info']);
        $text.=pars($row, $tpl);
    }
  return $text;
}


function list_info($tpl, $pid){
    $text='';
    $query=sql_placeholder('select * from ?#INFO where pid=? order by date_info desc', $pid);
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
    if (!$result) return '';

    while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		$row['date_info']=date(" d.m.Y", $row['date_info']);
        $text.=pars($row, $tpl);
    }
  return array('name'=>'Полезная информация', 'content'=>$text);

}


function view_info($tpl, $id){
  $text='';
  $query=sql_placeholder('select * from ?#INFO where id=?', $id);
  $row=select_row($query);
   if (!$row) return array('name'=>'', 'content'=>'Информация  не найдена');
  $row['date_info']=date(" d.m.Y", $row['date_info']);
  return array('name'=>$row['header_info'], 'content'=>pars($row, $tpl));

}
function view_path(){
 
 $type=(empty($_GET['type']))?0:(int)$_GET['type'];
 $mader=(empty($_GET['mader']))?0:(int)$_GET['mader'];
 $sid=(empty($_GET['sid']))?0:(int)$_GET['sid'];
 $poz_id=(empty($_GET['poz_id']))?0:(int)$_GET['poz_id'];
 $text='<a href="index.php">Главная</a>/';
 
 switch(TRUE){
 
   	  case($mader!=0 && $sid!=0 && $poz_id!=0):
	     $query=sql_placeholder('select * from ?#CATALOG where type=?', $type);
         $row1=select_row($query);
		 $query=sql_placeholder('select * from ?#MADER where id=?', $mader);
         $row2=select_row($query);
		 $query=sql_placeholder('select * from ?#SUB where sid=?', $sid);
         $row3=select_row($query);
		 $query=sql_placeholder('select * from ?#POZ where poz_id=?', $poz_id);
         $row4=select_row($query);
		 $text.='<a href="index.php?action=magaz&type='.$type.'&rand=1">Каталог - '.$row1['name'].'</a>/';
		 $text.='<a href="index.php?action=magaz&type='.$type.'&mader='.$mader.'">'.$row2['name'].'</a>/';
		 $text.='<a href="index.php?action=magaz&type='.$type.'&mader='.$mader.'&sid='.$sid.'">'.$row3['name'].'</a>/';
		 $text.='<a href="index.php?action=magaz&type='.$type.'&mader='.$mader.'&sid='.$sid.'&poz_id='.$poz_id.'">'.$row4['name'].'</a>/';
	 break;
	 case($mader!=0 && $sid!=0):
	     $query=sql_placeholder('select * from ?#CATALOG where type=?', $type);
         $row1=select_row($query);
		 $query=sql_placeholder('select * from ?#MADER where id=?', $mader);
         $row2=select_row($query);
		 $query=sql_placeholder('select * from ?#SUB where sid=?', $sid);
         $row3=select_row($query);
		 $text.='<a href="index.php?action=magaz&type='.$type.'&rand=1">Каталог - '.$row1['name'].'</a>/';
		 $text.='<a href="index.php?action=magaz&type='.$type.'&mader='.$mader.'">'.$row2['name'].'</a>/';
		 $text.='<a href="index.php?action=magaz&type='.$type.'&mader='.$mader.'&sid='.$sid.'">'.$row3['name'].'</a>/';
	 break;
	 case($mader!=0):
	     $query=sql_placeholder('select * from ?#CATALOG where type=?', $type);
         $row1=select_row($query);
		 $query=sql_placeholder('select * from ?#MADER where id=?', $mader);
         $row2=select_row($query);
		 $text.='<a href="index.php?action=magaz&type='.$type.'&rand=1">Каталог - '.$row1['name'].'</a>/';
		 $text.='<a href="index.php?action=magaz&type='.$type.'&mader='.$mader.'">'.$row2['name'].'</a>/';
	 break;
	 default:
	     $query=sql_placeholder('select * from ?#CATALOG where type=?', $type);
         $row=select_row($query);
	     $text.='<a href="index.php?action=magaz&type='.$type.'&rand=1">Каталог - '.$row['name'].'</a>/';
	break;
	         };

return $text;
}
function list_poz($tpl, $type,$mader,$sid){

 $query=sql_placeholder('select count(*)  from ?#POZ 

   			   	where type=? ', $type);
				if ($mader!=0){
				$query=sql_placeholder('select count(*)  from ?#POZ 
   			   	where type=? and mader=? and sid=?', $type,$mader,$sid);
				};
				
$url='action=magaz';

$cnt=select_row($query);

 $query=sql_placeholder('select * from ?#POZ where type=? order by   num desc limit  ?,?', $type,($_GET['page']-1)*LIMIT_POZ, LIMIT_POZ);

 if ($mader!=0)
 {
    $query=sql_placeholder('select * from ?#POZ where type=? and mader=? order by num desc limit  ?,?', $type,$mader,($_GET['page']-1)*LIMIT_POZ, LIMIT_POZ);
 };
 if ($sid!=0)
 {
    $query=sql_placeholder('select * from ?#POZ where type=? and mader=? and sid=? order by num desc limit  ?,?', $type,$mader,$sid,($_GET['page']-1)*LIMIT_POZ, LIMIT_POZ);
 
 };
 
 $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
  if (!$result) return '';

    while($row=mysql_fetch_assoc($result)){
	
		$row=stripslashes_array($row);

		$row['page']=$_GET['page'];
        $text.=pars($row, $tpl);
    }
	
	if ($cnt>LIMIT_POZ)
	{
	    $text='<div align="center">'.$text.'</div>';
		$text.='<br><div style="clear: both;">&nbsp;</div>';
		$text.='<div class="page_list" style="font-size:13px">';
		$text.=page_list($cnt, LIMIT_POZ,$url,$_GET['page']);
		$text.='</div>';
    };
       
   $title='';  
     
  return array('title'=>$title, 'content'=>$text);

}

function view_basket($tpl,$user){

    $text='';
    $tpl_basket_main=pars_reg($tpl, "MAIN");
    $tpl_basket_tr=pars_reg($tpl, "TR");
    $query=sql_placeholder('select poz_id from ?#TEMP where user_id=? ', $user);
    $result=mysql_query($query) or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
    if (!$result) return '';

    while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		$poz_id=$row['poz_id'];
		 $query=sql_placeholder('select * from ?#POZ where poz_id=?', $poz_id);
		 
        $row=select_row($query);
		 $temp=$row['mader'];
	  $query=sql_placeholder('select * from ?#MADER where id=? ', $row['mader']);
	  
	  $row2=select_row($query);
	  $row['distr']=$row2['name'];
	
        $text.=pars($row, $tpl_basket_tr);
		}
		$row['tr']=$text;
		 $text=pars($row, $tpl_basket_main);
		
		
		return $text;
		}
		function del_basket($poz_id){
		 $sql=sql_placeholder('delete from ?#TEMP where poz_id=?', $poz_id);
          $err=mysql_query($sql);
		
		return $err;
		};
		
	function view_zakaz($kol){
		
              $text='<table border="1" cellspacing="0" cellpadding="15" align="center">
<tr>
	 <td><h3>Наименование изделия</h3></td>
	<td><h3>Производитель</h3></td>
    <td><h3>Артикул</h3></td>
    <td><h3>Цена</h3></td>
    <td><h3>Количество</h3></td>
    
</tr>';
			  $tpl='<tr>
	<td>{name}</td>
	<td>{distr}</td>
	<td>{artikul}</td>
	<td>&nbsp;{price}&nbsp;руб.</td>
	<td>{kol}</td>
</tr>';
                  foreach($kol as $poz_id=>$val){
				  $query=sql_placeholder('select * from ?#POZ where poz_id=?', $poz_id);
		
        $row=select_row($query);
		
				  $row['kol']=$val;
				  $temp=$row['mader'];
	  $query=sql_placeholder('select * from ?#MADER where id=? ', $row['mader']);
	  
	  $row2=select_row($query);
	  $row['distr']=$row2['name'];
				  $text.=pars($row, $tpl);
	   
	              };
				 $text.='</table>'; 
			return $text;
	          }	
		function view_full_poz($tpl,$tpl_img2,$poz_id,$type){
		$text='';
		 $query=sql_placeholder('select * from ?#POZ where poz_id=? ', $poz_id);
      $row=select_row($query);
	  $temp=$row['mader'];
	  $query=sql_placeholder('select * from ?#MADER where id=? ', $row['mader']);
	  
	  $row2=select_row($query);
	  $row['distr']=$row2['name'];
	  
	  if (!empty($row['photo1'])){
	  $text2=pars($row, $tpl_img2);
	  $row['full_img2']=$text2;
	  }else{$row['full_img2']='';};
		$text.=pars($row, $tpl);
		$row['content']=$text;
		$title='';
		switch(TRUE){
	 case($type==1):
        	
			$title='Свадебные 
платья - Каталог';
   	 break;
	  case($type==2):
        	
			$title='Вечерние платья - Каталог';
   	 break;
	  case($type==3):
        	
			$title='Украшения - Каталог';
   	 break;
	  case($type==4):
        	
			$title='Украшения - Каталог';
   	 break;
       };       
		$title.=' - '.$row['name'];
		$row['title']=$title;

		return $row;

		}
		function view_big($tpl,$poz_id,$photo){
		$text='';
		 $query=sql_placeholder('select * from ?#POZ where poz_id=? ', $poz_id);
      $row=select_row($query);
	  $temp=$row['mader'];
	  $query=sql_placeholder('select * from ?#MADER where id=? ', $row['mader']);
	  
	  $row2=select_row($query);
	  $row['distr']=$row2['name'];
      if($photo=='photo1'){$row['photo']=$row['photo1'];};
		$text.=pars($row, $tpl);
		
		return $text;

		}
	function print_tree($tpl, $id=0){
    $text='';
    $arr=_list_menu($id);
    foreach($arr as $row){
      $row['sub']=print_tree($tpl, $row['id']);
      $text.=pars($row, $tpl);
     }


    return $text;

}	

function list_mader($type) {
  $text='<div style="padding-right:30px;"><font class="h2">Производители:</font><br><br>';
  $r1=array();
  $r2=array();
$query=sql_placeholder('select * from ?#POZ where type=? ', $type);
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
   while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		$r1[]=$row['mader'];
	   };
$query=sql_placeholder('select * from ?#MADER ');
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
		 while($row=mysql_fetch_assoc($result)){
		$row=stripslashes_array($row);
		if($row['logo']==''){
		$tpl='<h2>{name}</h2><br><br><br>';
		
		};
		if (in_array($row['id'],$r1)){$r2[]=$row;};
		};
		 foreach($r2 as $row){
      if($row['logo']==''){
		$tpl='<a href="?action=magaz&type='.$_GET['type'].'&mader={id}"><h3>&bull;&nbsp;{name}</h3></a>';
		} else {
		$tpl='<a href="?action=magaz&type='.$_GET['type'].'&mader={id}"><h3>&bull;&nbsp;{name}</h3></a><img src="../photos/{logo}" alt="{name}" width="100" border="0">';};
      $text.=pars($row, $tpl);
     }
	return $text;	
};
function view_mader($mader){
$text='';
$tpl='<h2>{name}</h2><div align="justify">{description}</div><br>';
if ($mader==0){ return '';};
  $query=sql_placeholder('select * from ?#MADER where id=? ', $mader);
   $row=select_row($query);
   $text=pars($row, $tpl);
   return $text;
}


function _view_gallery($id){
   $query=sql_placeholder('select c.*, p.* from ?#CATALOG as c left join ?#GALLERY as p
                  on (c.id=p.id)
                  where c.id=?
                  ', $id);
   $row=select_row($query);
   return $row;
}




function _list_photo($pid){
  $r=array();
  $query=sql_placeholder('select * from ?#GPHOTO where pid=? order by num', $pid);
  $result=mysql_query($query);
  while($row=mysql_fetch_assoc($result)){
    $r[]=$row;
  }

  return $r;
}

function _list_subphoto($sid){
  $r=array();
  $query=sql_placeholder('select * from ?#GPSUBHOTO where sid=? order by num', $sid);
  $result=mysql_query($query);
  while($row=mysql_fetch_assoc($result)){
    $r[]=$row;
  }

  return $r;
}
function _view_photo($id){
  $query=sql_placeholder('select * from ?#GPSUBHOTO where id=?', $id);
  $row=select_row($query);
  $type=$row['type'];
   if ($type=="image/gif"){ $row['type']="gif";}else{ $row['type']="jpg";};
  $r=_list_photo($row['pid']);
  if (!count($r)) return;
  foreach($r as $kl => $vl){
     if ($vl['id']==$id) {
       $row['lid']=(empty($r[$kl-1]['id']))?$r[(count($r)-1)]['id']:$r[$kl-1]['id'];
       $row['nid']=(empty($r[$kl+1]['id']))?$r[0]['id']:$r[$kl+1]['id'];
     }
  }

  return $row;
}

function print_gallery($id, $fid=0){
  $text=$bphoto='';
  $tpl=load_tpl_var('gallery.tpl');
  $tpl_main=pars_reg($tpl, "MAIN");
  $tpl_list=pars_reg($tpl, "LISTPHOTO");
  $tpl_sublink='<a href=?action=subgallery&id={pid}&sid={id}><img src="UserFiles/gallery/{pid}/{sphoto}" alt="{alt}" width="250"   border="0" style="border: thin double #AEE3FF;" title="{alt}"></a>';
  $tpl_bphoto=pars_reg($tpl, "BPHOTO");


  $arr=_list_photo($id);

	
  foreach($arr as $row){
    $sid = $row['id'];
	//echo $sid.'<br>yy';
  $query=sql_placeholder('select * from ?#GPSUBHOTO where sid=? order by num', $sid);
 
  $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
		 $res=mysql_num_rows($result);
		//echo $res;
    if ($res==0) {$tpl_sublink='<img src="UserFiles/gallery/{pid}/{sphoto}" alt="{alt}" width="250"   border="0" style="border: thin double #AEE3FF;" title="{alt}">';};
  $type=$row['type'];
   if ($type=="image/gif"){ $imgtype=".gif";}else{ $imgtype=".jpg";};
   $row['type']=$imgtype;
   $row['sphoto']="".$row['id'].$imgtype;
   
   $text_sub=pars($row, $tpl_sublink);
   $row['sublink']=$text_sub;
   $text.=pars($row, $tpl_list);
  }

  if ($fid){
    $row=_view_photo($fid);
          if ($row){
              $row['bphoto']="_".$row['id'].$imgtype;
             $bphoto=pars($row, $tpl_bphoto);
    }
    $text=pars(array(
                 'BPHOTO'=>$bphoto,
                 'LISTPHOTO'=>$text,
                 'comment'=>$row['comment'],
         ), $tpl_main);
  }else{
    $text='<div class="space"></div>'.$text.'<div class="space"></div>';
  }



  $row=_view_gallery($id);
  $row['content']=$row['header']. $text . $row['footer'];
  unset($row['header']);
  unset ($row['footer']);

  return $row;
}
function print_subgallery($sid, $fid=0){
  $text=$bphoto='';
  $tpl=load_tpl_var('subgallery.tpl');
  $tpl_main=pars_reg($tpl, "MAIN");
  $tpl_list=pars_reg($tpl, "LISTPHOTO");
  $tpl_bphoto=pars_reg($tpl, "BPHOTO");


  $arr=_list_subphoto($sid);
  foreach($arr as $row){
  $type=$row['type'];
   if ($type=="image/gif"){ $imgtype=".gif";}else{ $imgtype=".jpg";};
   $row['type']=$imgtype;
   $row['sphoto']="".$row['id'].$imgtype;

   $text.=pars($row, $tpl_list);
  }

  if ($fid){
    $row=_view_photo($fid);
          if ($row){
              $row['bphoto']="_".$row['id'].$imgtype;
             $bphoto=pars($row, $tpl_bphoto);
    }
    $text=pars(array(
                 'BPHOTO'=>$bphoto,
                 'LISTPHOTO'=>$text,
                 'comment'=>$row['comment'],
         ), $tpl_main);
  }else{
    $text='<div class="space"></div>'.$text.'<div class="space"></div>';
  }



  $row=_view_gallery($sid);
  $row['content']=$row['header']. $text . $row['footer'];
  unset($row['header']);
  unset ($row['footer']);

  return $row;
}
function rand_photo($tpl, $type,$mader){
$r=array();
$arr=array();
$query=sql_placeholder('select * from ?#MADER where rand=0');
$result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
while($row=mysql_fetch_assoc($result)){
	$r[]=$row['id'];
	}
$query=sql_placeholder('select * from ?#POZ where type=? order by num ', $type);

 if ($mader!=0)
 {
    $query=sql_placeholder('select * from ?#POZ where type=? and mader=? order by num ', $type,$mader);
 };

 
 $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
  if (!$result) return '';

  while($row=mysql_fetch_assoc($result)){
	
		if (!in_array($row['mader'],$r)){
		
		$arr[]=$row;
		
		};
    }
  for ($i=0; $i<5; $i++) {
  $row=$arr[$i];
  $row=stripslashes_array($row);
  $row['page']=$_GET['page'];
        $text.=pars($row, $tpl);
  };

$text.='<div style="clear:both"></div>';

 
  return $text;
}

                                   //////////////////РЕГИСТРАЦИЯ ПОЛЬЗОВАТЕЛЯ\\\\\\\\\\\\\\\\\\\\\\

function reg_user(){
$err='';
//Если кнопка была нажата то проверяем данные


    $login=$_POST['login'];
    $password1=$_POST['password1'];
	$password2=$_POST['password2'];
    $email=$_POST['email'];
	$name=$_POST['name'];
    $ip=$_SERVER['REMOTE_ADDR'];
    if(trim($login)==''){
	$err='Вы не ввели логин !<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
	};
	if(trim($password1)=='') {
    $err='Вы не ввели пароль!<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
    };
    if($password1!=$password2){
	$err='Пароли не совпадают!<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
	};
     if(trim($email)=='') {
    $err='Вы не ввели ваш EMAIL !<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
    };
	if(trim($name)=='') {
    $err='Вы не ввели название организации !<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
    };




//Проверяем валидность электронного адреса пользователя

if(!preg_match('/.+\@.+\..+/', $email)){
    $err='Ошибочный формат EMAIL-адреса !<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
    }

//Пароль не должен быть менее 3-х символов
if(strlen($password1)<3) {
    $err='Длина пароля должна быть не менее 3-х символов !<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
    }

//Шифруем пароль
$passwd=md5($password1);


//А пользователь ещё не зарегистрирован ?


   
$query=sql_placeholder('select id from ?#REGUS where login=? or email=?', $login,$email);


if(@mysql_num_rows($query)!=0) {
    $err='Пользователь с такими логином или почтовым адресом уже зарегистрирован!<br><br><div align="center"><a href=# onclick="history.back();">Назад</a></div>';
    }

if ($err=='')
{	
    unset($query);
    //Регистрируем пользователя
	$date=time();
	$query=sql_placeholder('insert into ?#REGUS (`login`, `password`, `email`, `name`,`date`)
             values(?,?,?,?,?)', $login, $passwd,$email,$name,$date);
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
    



//Начинаем процесс составления ХЕШ-подписи, для подтверждения личности 
//пользователя при активации



//Получаем логин пользователя в EMAIL-сети

$email_cnx=explode("@",$email);

//Формируем подпись 
$checkSum=base64_encode(substr($login,0,3).$email_cnx[0].
          md5($_SERVER['REMOTE_ADDR']));

//Получаем временную метку


unset($query);

//Добавляем данные во временную таблицу
$query=sql_placeholder('insert into ?#VALID ( `email`, `checkSum`, `date`)
             values(?,?,?)', $email, $checkSum,$date);
     $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
		
		



	
//Сообщение зарегистрированному пользователю

$message='Здравствуйте '.$login.',
<br><br>
Это письмо отправлено с сайта http://dostavka-rus.ru/
<br><br>
Вы получили это письмо, так как этот e-mail адрес был использован при регистрации на сайте.<br>
 Если Вы не регистрировались на этом сайте, просто проигнорируйте это письмо и удалите его.<br>
  Вы больше не получите такого письма.
<br><br>
------------------------------------------------<br>
Ваш логин и пароль на сайте:<br>
------------------------------------------------
<br>
Логин: '.$login.'<br>
Пароль: '.$password1.'<br>

------------------------------------------------<br>
Инструкция по активации<br>
------------------------------------------------<br><br>

Благодарим Вас за регистрацию.
Аккаунт будет действителен до
'.date("d.m.Y",mktime(0,0,0,date("d",$date)+4,date("m",$date),date("Y",$date))).', 
после чего аккаунт активировать будет невозможно !<br>
Мы требуем от Вас подтверждения Вашей регистрации, для проверки того, что введённый Вами e-mail адрес - реальный.
Это требуется для защиты от нежелательных злоупотреблений и спама.
<br><br>
Для активации Вашего аккаунта, зайдите по следующей ссылке:
<br><br>
<a href="http://dostavka-rus.ru/index.php?action=reg&checkSum='.$checkSum.'&email='.$email.'">Перейти</a>
<br><br>
Если и при этих действиях ничего не получилось, возможно Ваш аккаунт удалён или просрочен. В этом случае, обратитесь к Администратору, для разрешения проблемы.
<br><br>
С уважением администрация dostavka-rus.ru
<br><br>
Email для контактов:<a href="mailto: dostavka-rus.ru@mail.ru"> dostavka-rus.ru@mail.ru </a>';





//Посылаем сообщение пользователю

@mail($email,"Активация аккаунта",$message,"Content-Type: text/html;charset=windows-1251","From: robot@dostavka-rus.ru");

$err='Спасибо за регистрацию на ваш email отправлено письмо с инструкцией по активации аккаунта<br><br><div align="center"><a href="index.php">На главную</a></div>'; 
};   	       
return $err;
}

function appruv_user(){
$err='';
$checkSum=$_GET['checkSum'];

$email=$_GET['email'];

$ip=$_SERVER['REMOTE_ADDR'];


   
$query=sql_placeholder('select id from ?#VALID where email=? ', $email);
$row=select_row($query);

if(@$row['id']=='') {
    $err='Ошибка при проверке данных !';
    };



$query=sql_placeholder("SELECT login,date FROM ?#REGUS WHERE email=?",$email);

$row=select_row($query);

$login=$row['login'];
$date=$row['date'];

$time=time();

$total_date=$time-$date;

$max_time=172800;// максимальное время активации 2 суток
if($total_date>$max_time) {
    $err='Просроченая активация аккаунта !';
    }

$email_cnx=explode("@",$email);
$new_checkSum=base64_encode(substr($login,0,3).$email_cnx[0].md5($_SERVER['REMOTE_ADDR']));

if($checkSum!=$new_checkSum) {
    $err='Ошибка при проверке ключа или это адресс email уже используется!';
    };
if ($err=='')
{
    unset($query);
    $query=sql_placeholder("UPDATE ?#REGUS SET status=1 WHERE email=?",$email);
    $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
		$query=sql_placeholder("DELETE FROM ?#VALID  WHERE email=?",$email);
    $result=mysql_query($query)
 		or db_error($query.' '.mysql_error().' line '.__LINE__ .' file '.__FILE__);
    $err='Ваш аккаунт активирован <br><br><div align="center"><a href="index.php">На главную</a></div>';
};
return $err;
}
function logg_err(){
$err='';
$login=$_POST['login'];

$password=md5($_POST['password']);

$query=sql_placeholder('select * from ?#REGUS where login=? ', $login);
$row=select_row($query);
if (empty($row['login'])){
$err=1;
} elseif ($row['password']!=$password) {
$err=2;} else {$err=0; }
return $err;
}
function logging(){

$text='';
$err=logg_err();
if ($err!=0){$text='<font color="#FF0000">Неправильный логин или пароль!</font>';}else
{

$query=sql_placeholder('select * from ?#REGUS where login=? ', $_POST['login']);
$row=select_row($query);
$id_user=$row['id'];
$email=$row['email'];
$session_id = session_id();
$time=mktime()+RTIME;
$query=sql_placeholder('select * from ?#USER_SESSION where login=? ',$_POST['login']);
$row=select_row($query);
if (empty($row['id_user']))
  { 
  
$query=sql_placeholder('insert into ?#USER_SESSION (`id_user`, `session_id`,`login`,`email`, `delet_time`)
             values(?,?,?,?,?)', $id_user, $session_id,$_POST['login'],$email,$time);
			   mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<BR>");
  }
	setcookie("id_user",$id_user);		    
    setcookie("login",$_POST['login']);	
	
$text='Добро пожаловать, '.$_POST['login'];


};
return $text;
}
function logout(){
     $query=sql_placeholder('delete from  `'.USER_SESSION.'`  where `id_user`<?', $_COOKIE['id_user']);
     mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<BR>");
     setcookie("id_user");		    
     setcookie("login");	
}
?>