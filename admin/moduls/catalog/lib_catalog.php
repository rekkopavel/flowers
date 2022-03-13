<?

 function editotz_razdel($id){
    $text='';
    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
    $r=select_row($query);
    if (!$r) return 'Ошибка.  Раздел не найден';
    if (empty($_POST['name'])){
	    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
	    $row=select_row($query);
	    $text=pars($row, load_tpl_var('cms_admin/otz/form_news_rasdel.tpl'));
 	}else{
        $row['name']=$_POST['name'];
        $row['num']=$_POST['num'];
        $query=sql_placeholder('update ?#CATALOG set ?% where id=?', $row, $id);
        $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        if (!$result){
         	$text.="Ошибка базы данных <br>";
        }
        $text.="<a href=?mod=catalog&cid=".$r['parent_id'].">Назад</a>";
 	}

    return $text;
 }
function addotz($cid){
  $text='';

  if (empty($_POST['header_otz'])){
    $row=array('header_otz'=>'', 'date_otz'=>date('Y-m-d H:i:s'), 'autor'=>'', 'content_otz'=>'');
    $text=pars($row, load_tpl_var('cms_admin/otz/form_news.tpl'));

  }else{
    $query=sql_placeholder('insert into ?#OTZ(`pid`, `header_otz`, `autor`, `content_otz`, `date_otz` )
        values(?,?,?,?, unix_timestamp(?))
     ', $cid, $_POST['header_otz'], $_POST['autor'], $_POST['content_otz'], $_POST['date_otz']);
      $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listotz&cid=".$cid.">Назад</a>";
  }


  return $text;
}


function editotz($id){
   $text='';
   $query=sql_placeholder('select pid from ?#OTZ where id=?', $id);
   $cid=select_row($query);
   if (empty($_POST['header_otz'])){
    $query=sql_placeholder('select * from ?#OTZ where id=?', $id);
    $row=select_row($query);
    $row['date_otz']=date('Y-m-d H:i:s', $row['date_otz']);
    $text=pars($row, load_tpl_var('cms_admin/otz/form_news.tpl'));
  }else{
    $row['header_otz']=$_POST['header_otz'];
	$row['autor']=$_POST['autor'];
	$row['content_otz']=$_POST['content_otz'];
	$query=sql_placeholder('update ?#OTZ set ?% , date_otz=unix_timestamp(?) where id=?', $row, $_POST['date_otz'], $id);

    $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listotz&cid=".$cid.">Назад</a>";
  }
  return $text;
}
function delotz($id){
  $query=sql_placeholder('select * from ?#OTZ where id=?', $id);
  $r=select_row($query);
  $query=sql_placeholder('delete from ?#OTZ where id=?', $id);
  mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);

  $text='<a href=?mod=catalog&action=listotz&cid='.$r['pid'].'>Назад</a>';
  return $text;

}
function list_otz_ad($cid){
  $text='';
  $tpl=load_tpl_var('cms_admin/otz/list_news.tpl');
  $tpl_main=pars_reg($tpl, "MAIN");
  $tpl_tr=pars_reg($tpl, "TR");


  $query=sql_placeholder('select * from ?#OTZ where pid=? order by date_otz desc', $cid);
  $result=mysql_query($query);

  while($row=mysql_fetch_assoc($result)){
    $text.=pars($row, $tpl_tr);

  }

   $query=sql_placeholder('select * from ?#CATALOG where id=?', $cid);
   $row=select_row($query);
   $row['TR']=$text;
   $row['cid']=$cid;
   $row=array_reverse($row);

   $text=pars($row, $tpl_main);
   return $text;
}
function addnews_rasdel($cid){
   $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/news/form_news_rasdel.tpl');
     $row=array('name'=>'', 'num'=>'');
     $text=pars($row,$tpl);
  }  else {
     $row=array('parent_id'=>$cid, 'name'=>$_POST['name'], 'num'=>$_POST['num'], 'action'=>'news');;
  	 $query=sql_placeholder('insert into ?#CATALOG(`parent_id`, `name`, `num`, `action`)
  	   values(?@)
  	   ', $row);
      $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }

     $text.="<a href=?mod=catalog&cid=".$cid.">Назад</a>";
  }

  return $text;
}


function addnews($cid){
  $text='';

  if (empty($_POST['header_news'])){
    $row=array('header_news'=>'', 'date_news'=>date('Y-m-d H:i:s'), 'lid_news'=>'', 'content_news'=>'');
    $text=pars($row, load_tpl_var('cms_admin/news/form_news.tpl'));

  }else{
    $query=sql_placeholder('insert into ?#NEWS(`pid`, `header_news`, `lid_news`, `content_news`, `date_news` )
        values(?,?,?,?, unix_timestamp(?))
     ', $cid, $_POST['header_news'], $_POST['lid_news'], $_POST['content_news'], $_POST['date_news']);
      $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listnews&cid=".$cid.">Назад</a>";
  }


  return $text;
}


function editnews($id){
   $text='';
   $query=sql_placeholder('select pid from ?#NEWS where id=?', $id);
   $cid=select_row($query);
   if (empty($_POST['header_news'])){
    $query=sql_placeholder('select * from ?#NEWS where id=?', $id);
    $row=select_row($query);
    $row['date_news']=date('Y-m-d H:i:s', $row['date_news']);
    $text=pars($row, load_tpl_var('cms_admin/news/form_news.tpl'));
  }else{
    $row['header_news']=$_POST['header_news'];
	$row['lid_news']=$_POST['lid_news'];
	$row['content_news']=$_POST['content_news'];
	$query=sql_placeholder('update ?#NEWS set ?% , date_news=unix_timestamp(?) where id=?', $row, $_POST['date_news'], $id);

    $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listnews&cid=".$cid.">Назад</a>";
  }
  return $text;
}

 function editnews_rasdel($id){
    $text='';
    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
    $r=select_row($query);
    if (!$r) return 'Ошибка.  Раздел не найден';
    if (empty($_POST['name'])){
	    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
	    $row=select_row($query);
	    $text=pars($row, load_tpl_var('cms_admin/news/form_news_rasdel.tpl'));
 	}else{
        $row['name']=$_POST['name'];
        $row['num']=$_POST['num'];
        $query=sql_placeholder('update ?#CATALOG set ?% where id=?', $row, $id);
        $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        if (!$result){
         	$text.="Ошибка базы данных <br>";
        }
        $text.="<a href=?mod=catalog&cid=".$r['parent_id'].">Назад</a>";
 	}

    return $text;
 }


function delnews($id){
  $query=sql_placeholder('select * from ?#NEWS where id=?', $id);
  $r=select_row($query);
  if (!$r) return 'Новост не найдена';
  delete_to_bases(NEWS, array($r['id']), array('id')) ;
  $text='<a href=?mod=catalog&action=listnews&cid='.$r['pid'].'>Назад</a>';
  return $text;

}


function list_news_ad($cid){
  $text='';
  $tpl=load_tpl_var('cms_admin/news/list_news.tpl');
  $tpl_main=pars_reg($tpl, "MAIN");
  $tpl_tr=pars_reg($tpl, "TR");


  $query=sql_placeholder('select * from ?#NEWS where pid=? order by date_news desc', $cid);
  $result=mysql_query($query);

  while($row=mysql_fetch_assoc($result)){
    $text.=pars($row, $tpl_tr);

  }

   $query=sql_placeholder('select * from ?#CATALOG where id=?', $cid);
   $row=select_row($query);
   $row['TR']=$text;
   $row['cid']=$cid;
   $row=array_reverse($row);

   $text=pars($row, $tpl_main);
   return $text;
}

function addinfo_rasdel($cid){
   $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/info/form_info_rasdel.tpl');
     $row=array('name'=>'', 'num'=>'');
     $text=pars($row,$tpl);
  }  else {
     $row=array('parent_id'=>$cid, 'name'=>$_POST['name'], 'num'=>$_POST['num'], 'action'=>'info');;
  	 $query=sql_placeholder('insert into ?#CATALOG(`parent_id`, `name`, `num`, `action`)
  	   values(?@)
  	   ', $row);
      $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }

     $text.="<a href=?mod=catalog&cid=".$cid.">Назад</a>";
  }

  return $text;
}


function addinfo($cid){
$text='';

  if (empty($_POST['header_info'])){
    $row=array('header_info'=>'', 'content_info'=>'');
    $text=pars($row, load_tpl_var('cms_admin/info/form_info.tpl'));

  }else{
    $query=sql_placeholder('insert into ?#INFO(`pid`, `header_info`,  `content_info`, `date_info` )
        values(?,?,?, unix_timestamp(?))
     ', $cid, $_POST['header_info'],  $_POST['content_info'], date('Y-m-d H:i:s'));
      $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listinfo&cid=".$cid.">Назад</a>";
  }


  return $text;
}


function editinfo($id){
   $text='';
   $query=sql_placeholder('select pid from ?#INFO where id=?', $id);
   $cid=select_row($query);
   if (empty($_POST['header_info'])){
    $query=sql_placeholder('select * from ?#INFO where id=?', $id);
    $row=select_row($query);
    $row['date_info']=date('Y-m-d H:i:s', $row['date_info']);
    $text=pars($row, load_tpl_var('cms_admin/info/form_info.tpl'));
  }else{
    $row['header_info']=$_POST['header_info'];

	$row['content_info']=$_POST['content_info'];
	$query=sql_placeholder('update ?#INFO set ?% , date_info=unix_timestamp(?) where id=?', $row, date('Y-m-d H:i:s'), $id);

    $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listinfo&cid=".$cid.">Назад</a>";
  }
  return $text;
}

 function editinfo_rasdel($id){
    $text='';
    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
    $r=select_row($query);
    if (!$r) return 'Ошибка.  Раздел не найден';
    if (empty($_POST['name'])){
	    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
	    $row=select_row($query);
	    $text=pars($row, load_tpl_var('cms_admin/info/form_info_rasdel.tpl'));
 	}else{
        $row['name']=$_POST['name'];
        $row['num']=$_POST['num'];
        $query=sql_placeholder('update ?#CATALOG set ?% where id=?', $row, $id);
        $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        if (!$result){
         	$text.="Ошибка базы данных <br>";
        }
        $text.="<a href=?mod=catalog&cid=".$r['parent_id'].">Назад</a>";
 	}

    return $text;
 }


function delinfo($id){
  $query=sql_placeholder('select * from ?#INFO where id=?', $id);
  $r=select_row($query);
  if (!$r) return 'Информация не найдена';
  delete_to_bases(INFO, array($r['id']), array('id')) ;
  $text='<a href=?mod=catalog&action=listinfo&cid='.$r['pid'].'>Назад</a>';
  return $text;

}


function list_info_ad($cid){
  $text='';
  $tpl=load_tpl_var('cms_admin/info/list_info.tpl');
  $tpl_main=pars_reg($tpl, "MAIN");
  $tpl_tr=pars_reg($tpl, "TR");


  $query=sql_placeholder('select * from ?#INFO where pid=? order by date_info desc', $cid);
  $result=mysql_query($query);

  while($row=mysql_fetch_assoc($result)){
    $text.=pars($row, $tpl_tr);

  }

   $query=sql_placeholder('select * from ?#CATALOG where id=?', $cid);
   $row=select_row($query);
   $row['TR']=$text;
   $row['cid']=$cid;
   $row=array_reverse($row);

   $text=pars($row, $tpl_main);
   return $text;
}
function addserv_rasdel($cid){
   $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/serv/form_news_rasdel.tpl');
     $row=array('name'=>'', 'num'=>'');
     $text=pars($row,$tpl);
  }  else {
     $row=array('parent_id'=>$cid, 'name'=>$_POST['name'], 'num'=>$_POST['num'], 'action'=>'serv');;
  	 $query=sql_placeholder('insert into ?#CATALOG(`parent_id`, `name`, `num`, `action`)
  	   values(?@)
  	   ', $row);
      $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }

     $text.="<a href=?mod=catalog&cid=".$cid.">Назад</a>";
  }

  return $text;
}


function addserv($cid){
  $text='';

  if (empty($_POST['header_news'])){
    $row=array('header_news'=>'',  'lid_news'=>'', 'content_news'=>'');
    $text=pars($row, load_tpl_var('cms_admin/serv/form_news.tpl'));

  }else{
    $query=sql_placeholder('insert into ?#SERV(`pid`, `header_news`, `lid_news`, `content_news` )
        values(?,?,?,?)
     ', $cid, $_POST['header_news'], $_POST['lid_news'], $_POST['content_news']);
      $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listserv&cid=".$cid.">Назад</a>";
  }


  return $text;
}


function editserv($id){
   $text='';
   $query=sql_placeholder('select pid from ?#SERV where id=?', $id);
   $cid=select_row($query);
   if (empty($_POST['header_news'])){
    $query=sql_placeholder('select * from ?#SERV where id=?', $id);
    $row=select_row($query);
    
    $text=pars($row, load_tpl_var('cms_admin/serv/form_news.tpl'));
  }else{
    $row['header_news']=$_POST['header_news'];
	$row['lid_news']=$_POST['lid_news'];
	$row['content_news']=$_POST['content_news'];
	$query=sql_placeholder('update ?#SERV set ?%  where id=?', $row,  $id);

    $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      if (!$result){
      	$text.="Ошибка базы данных <br>";
      }
     $text.="<a href=?mod=catalog&action=listserv&cid=".$cid.">Назад</a>";
  }
  return $text;
}

 function editserv_rasdel($id){
    $text='';
    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
    $r=select_row($query);
    if (!$r) return 'Ошибка.  Раздел не найден';
    if (empty($_POST['name'])){
	    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
	    $row=select_row($query);
	    $text=pars($row, load_tpl_var('cms_admin/serv/form_news_rasdel.tpl'));
 	}else{
        $row['name']=$_POST['name'];
        $row['num']=$_POST['num'];
        $query=sql_placeholder('update ?#CATALOG set ?% where id=?', $row, $id);
        $result=mysql_query($query) or  db_error(mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        if (!$result){
         	$text.="Ошибка базы данных <br>";
        }
        $text.="<a href=?mod=catalog&cid=".$r['parent_id'].">Назад</a>";
 	}

    return $text;
 }


function delserv($id){
  $query=sql_placeholder('select * from ?#SERV where id=?', $id);
  $r=select_row($query);
  if (!$r) return 'Новост не найдена';
  delete_to_bases(SERV, array($r['id']), array('id')) ;
  $text='<a href=?mod=catalog&action=listserv&cid='.$r['pid'].'>Назад</a>';
  return $text;

}


function list_serv_ad($cid){
  $text='';
  $tpl=load_tpl_var('cms_admin/serv/list_news.tpl');
  $tpl_main=pars_reg($tpl, "MAIN");
  $tpl_tr=pars_reg($tpl, "TR");


  $query=sql_placeholder('select * from ?#SERV where pid=? order by date_news desc', $cid);
  $result=mysql_query($query);

  while($row=mysql_fetch_assoc($result)){
    $text.=pars($row, $tpl_tr);

  }

   $query=sql_placeholder('select * from ?#CATALOG where id=?', $cid);
   $row=select_row($query);
   $row['TR']=$text;
   $row['cid']=$cid;
   $row=array_reverse($row);

   $text=pars($row, $tpl_main);
   return $text;
}
function viewcatalog($id)
{
   $urledit="?mod=catalog&action=edit{type}&pid=$id&type=";
   $delete="<a href=# onclick=\"if (confirm('Вы желаете удалить: \\n {DNAME}')) location.href='?mod=catalog&action=delcatalog&pid=$id&type={TP}&id={ID}' ;else return false;\">Удалить</a>";
   if ($id==238){$tpl=load_tpl_var('/cms_admin/cms/view_catalog_d.tpl');}else{
   $tpl=load_tpl_var('/cms_admin/cms/view_catalog.tpl');}
   
   $tpltr=pars_reg($tpl,"TR");
   $tpl_photo=pars_reg($tpl,"PHOTO");
   $tpl_news=pars_reg($tpl,"NEWS");
   $tpl_otz=pars_reg($tpl,"OTZ");
   $tpl_info=pars_reg($tpl,"INFO");
   $tpl=pars_reg($tpl,"MAIN");
   $text='';
   $i=0;

  $query=sql_placeholder('select * from ?#CATALOG where parent_id=? AND mag=0 order by num',  $id);
  $result=mysql_query($query);
  while($row=mysql_fetch_assoc($result))
   {


            switch(TRUE){
   	 default:
 	   $row['TYPE']='Страница';
   	 break;
	 case($row['action']=='gallery'):
	 
        	$row['TYPE']=pars(array('name'=>'Галлерея','id'=>$row['id']), $tpl_photo )   ;
			
   	 break;
	  case($row['action']=='otz'):
	 
        	$row['TYPE']=pars(array('name'=>'Отзывы','id'=>$row['id']), $tpl_otz )   ;
			
   	 break;
	  case($row['action']=='news'):
	 
        	$row['TYPE']=pars(array('name'=>'Новости','id'=>$row['id']), $tpl_news )   ;
			
   	 break;
                    }      

           $row=stripslashes_array($row);
           $row['bgcolor']=($i++%2)?'fffff':'95B6FF';
        // при замене шаблонов важен порядок вхождения пример {CID} используется 2 раза
        $text.=pars($row, $tpltr);



       }


    $query=sql_placeholder('select parent_id from ?#CATALOG where id=?',  $id);
    $pid=select_row($query);
    $pid=($pid)?$pid:0;
    $text=str_replace(array($tpltr,'{PID}','{ID}'), array($text,$pid, $id), $tpl);


    return  $text;


}

function editgallery($id){
$text='';
 if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/gallery/form_gallery.tpl');
    $query=sql_placeholder('
     select c.name, c.num, c.id, c.parent_id as pid, p.header, p.footer,c.title,c.description,c.keywords from ?#CATALOG as c left join ?#GALLERY as p on (c.id=p.id)
     where c.id=?
     ', $id);
     $text=pars(select_row($query),$tpl);

  }else{
     $catalog=array('name'=>$_POST['name'], 'num'=>$_POST['num'], 'title'=>$_POST['title'], 'description'=>$_POST['description'], 'keywords'=>$_POST['keywords']);
     $query=sql_placeholder('update ?#CATALOG set ?% where id=?', $catalog, $id);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
     $gallery=array('header'=>$_POST['header'], 'footer'=>$_POST['footer']);
     $query=sql_placeholder('update ?#GALLERY set ?% where id=?', $gallery, $id);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");

     $text="<a href=?mod=catalog&cid=".$_GET['pid'].">Назад</a>";
  }


    return $text;
}


function editcatalog($id)
{
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/cms/page_form.tpl');
     $query=sql_placeholder('
     select c.name,c.title,c.description,c.keywords, c.num, c.id, c.parent_id as pid, p.content from ?#CATALOG as c left join ?#CONTENT as p on (c.id=p.id)
     where c.id=?
     ', $id);
    //     echo $query."<hr>";
     $text=pars(htmlspecialchars_array(select_row($query)),$tpl);

  }
  else
  {
     $catalog=array('name'=>$_POST['name'],'title'=>$_POST['title'],'description'=>$_POST['description'],'keywords'=>$_POST['keywords'], 'num'=>$_POST['num'], );
     $query=sql_placeholder('update ?#CATALOG set ?% where id=?', $catalog, $id);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
     $query=sql_placeholder('select count(*) as cnt from ?#CONTENT where id=?', $id);
     if (select_row($query))
       $query=sql_placeholder('update ?#CONTENT set content=? where id=?', $_POST['textcontent'], $id);
     else
       $query=sql_placeholder('insert into ?#CONTENT(`id`,`content`) values(?,?) ', $id, $_POST['textcontent']) ;

     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");

     $text="<a href=?mod=catalog&cid=".$_GET['pid'].">Назад</a>";
  }

  return $text;
}


function addcatalog()
{
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/cms/page_form.tpl');
     $row=array('name'=>'', 'title'=>'','description'=>'','keywords'=>'','content'=>'', 'num'=>'', );
     $text=pars($row,$tpl);
  }
  else
  {
     $catalog=array(
              'name'=>$_POST['name'],
			  'title'=>$_POST['title'],
			  'keywords'=>$_POST['keywords'],
			  'description'=>$_POST['description'],
              'num'=>$_POST['num'],
              'parent_id'=>$_GET['cid'],
              'action'=>'page',               );
     $query=sql_placeholder('insert into ?#CATALOG (`name`,`title`,`keywords`,`description`,`num`,`parent_id`, `action`) values(?@)', $catalog );
                 // echo $query."<hr>";
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
     if (isset($_POST['textcontent']))
     {
        $id=mysql_insert_id();
        $query=sql_placeholder('insert into ?#CONTENT (`id`, `content`) values(?,?)', $id, $_POST['textcontent']);
        $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
     }
           $text.="<a href=?mod=catalog&cid=".$_GET['cid'].">Назад</a>";
  }


   return $text;
}


function  delcatalog($id){

       $list_pid=showTreeDel(CATALOG , $_GET['id']);
       delete_to_bases(CATALOG, $list_pid, array('parent_id')) ;
       delete_to_bases(CONTENT, $list_pid, array('id') ) ;
       delete_to_bases(CATALOG, $list_pid, array('id')) ;
       delete_to_bases(GALLERY, $list_pid, array('id')) ;
       delete_to_bases(NEWS, $list_pid, array('pid')) ;


       header ('Location: index.php?mod=catalog&cid='.$_GET['pid']);
       exit;
}


$list_id=array();
  function showTreeDel($table , $id)
  {
      global $list_id ;
      array_push ($list_id ,$id);
      $query=sql_placeholder('select id  from `'.$table.'` where parent_id=?' , $id);

      $result=mysql_query($query) or  die (mysql_error(). " T ёЄЁюъх  ". __LINE__ . " Lрщы ". __FILE__. "<br>");
      while ($row=mysql_fetch_assoc($result))  {
        showTreeDel($table,$row['id']);
     }
      return $list_id;

  }


function addgallery(){
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/gallery/form_gallery.tpl');
     $row=array('name'=>'', 'content'=>'', 'num'=>'', 'header'=>'', 'footer'=>'', 'title'=>'', 'description'=>'', 'keywords'=>''  );
     $text=pars($row,$tpl);
  }
  else
  {
     $catalog=array(
              'name'=>$_POST['name'],
              'num'=>$_POST['num'],
			  'title'=>$_POST['title'],
			  'description'=>$_POST['description'],
			  'keywords'=>$_POST['keywords'],
              'parent_id'=>$_GET['cid'],
              'action'=>'gallery',
                             );
     $query=sql_placeholder('insert into ?#CATALOG (`name`,`num`,`title`,`description`,`keywords`,`parent_id`, `action`) values(?@)', $catalog );

     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      $id=mysql_insert_id();
        $query=sql_placeholder('
                insert into ?#GALLERY (`id`, `header`, `footer`)
                values(?,?,?)', $id, $_POST['header'], $_POST['footer'] );
        $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");

           $text.="<a href=?mod=catalog&cid=".$_GET['cid'].">Назад</a>";
  }


   return $text;

}



function listphoto($pid){
        $text='';
        $tpl=load_tpl_var('/cms_admin/gallery/listphoto.tpl');
    $tpl_main=pars_reg($tpl, "MAIN");
    $tpl_tr=pars_reg($tpl, "TR");
        $query=sql_placeholder('select * from ?#GPHOTO where pid=? order by num', $pid);
    $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
    while($row=mysql_fetch_assoc($result)){
      $row=stripslashes_array($row);
	   $type=$row['type'];
   if ($type=="image/gif"){ $imgtype="gif";}else{ $imgtype="jpg";};
   $row['type']=$imgtype;
      $text.=pars($row,$tpl_tr);

    }

     $query=sql_placeholder('select * from ?#CATALOG where id=?', $pid);
     $row=select_row($query);

     $row=array('TR'=>$text, 'parent_id'=>$row['parent_id'], 'pid'=>$row['id'], 'cid'=>$_GET['cid']);
     $text=pars($row, $tpl_main);
     return $text;
}


function addphoto($pid){
   $dir=''.DIR_GALLERY;
   $text='';
   if (empty($_POST)){
           $text=pars(array('comment'=>'','num'=>'', 'alt'=>''),load_tpl_var('cms_admin/gallery/from_photo.tpl'));

   }
   elseif(empty($_FILES['photo']['name'])){
         $text.='Вы не выбрали фото <br> <a href=# onclick="history.back();">Назад</a> ';
   } else{
       if (!file_exists($dir.$pid)){
               mkdir($dir.$pid);
       }
    $type =$_FILES['photo']['type'];
       $query=sql_placeholder('insert into ?#GPHOTO(`pid`, `num`, `comment`, `alt`, `type`)
                               values(?,?,?,?,?)
                               ', $pid,  $_POST['num'], $_POST['comment'], $_POST['alt'],$type);

      
	  
     
      mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);
      $dir=$dir.$pid.'/';
      $fid=mysql_insert_id();
	  
	  if ($type=="image/gif"){ $filename=$fid.".gif";}else{$filename=$fid.".jpg";};
      
      $err=upload_jpg('photo', $filename, $dir);
      if ($err==-1){
          $text.='Файл имеет неверный формат <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }elseif ($err<1){
          $text.='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }

      // resize_image(450, 320,  $dir.$filename, $dir."_".$filename );
       resize_image(150, 100,  $dir.$filename, $dir."__".$filename );

    $text='<a href="?mod=catalog&action=listphoto&cid='.$pid.'">Назад</a>';
   }

   return $text;
}


function editphoto($id){
  $dir=''.DIR_GALLERY;
  $text='';
  $query=sql_placeholder('select * from ?#GPHOTO where id=?', $id);
   $row=select_row($query);
   if (!$row) return ' Ошибка. Записи не сушествует ';
   $pid=$row['pid'];
   $type=$row['type'];
   $dir=$dir.$pid.'/';
   if (empty($_POST))
         $text=pars($row,load_tpl_var('cms_admin/gallery/from_photo.tpl'));
   else{
      if(!empty($_FILES['photo']['name'])){
          if (!file_exists($dir)){
               mkdir($dir);
          }
		 if ($type=="image/gif"){ $imgtype=".gif"; }else{ $imgtype=".jpg";};
		
      @    unlink($dir.$id.$imgtype);
     // @   unlink($dir."_".$id.".jpg");
      @   unlink($dir."__".$id.$imgtype);
	  
      $filename=$id.$imgtype;
      $err=upload_jpg('photo', $filename, $dir);
      if ($err==-1){
          $text.='Файл имеет неверный формат <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }elseif ($err<1){
          $text.='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }

      // resize_image(400, 300,  $dir.$filename, $dir."_".$filename );
       resize_image(150, 100,  $dir.$filename, $dir."__".$filename );


      }

      $arr['comment']=$_POST['comment'];
      $arr['num']=$_POST['num'];
      $arr['alt']=$_POST['alt'];
      $query=sql_placeholder('update ?#GPHOTO set ?% where id=?', $arr, $id);
      mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);
      $text='<a href="?mod=catalog&action=listphoto&cid='.$pid.'">Назад</a>';
   }

   return $text;

 }


function delphoto($id){
  $text='';
  $query=sql_placeholder('select * from ?#GPHOTO where id=?', $id);
  $row=select_row($query);
  $type=$row['type'];
   if ($type=="image/gif"){ $imgtype=".gif";}else{ $imgtype=".jpg";};
  if (!$row) {
          header('Location: index.php');
          exit;
  }
   $dir=''.DIR_GALLERY.$row['pid']."/";
   @   unlink($dir.$id.$imgtype);
   @   unlink($dir."_".$id.$imgtype);
   @   unlink($dir."__".$id.$imgtype);

   $query=sql_placeholder('delete from ?#GPHOTO where id=?', $id);
  mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);

  $text='<A href=?mod=catalog&action=listphoto&cid='.$row['pid'].'>Назад</a>';
  return $text;

}

//функции субгалерея



function listsubphoto($sid){
        $text='';
        $tpl=load_tpl_var('/cms_admin/gallery/listsubphoto.tpl');
    $tpl_main=pars_reg($tpl, "MAIN");
    $tpl_tr=pars_reg($tpl, "TR");
        $query=sql_placeholder('select * from ?#GPSUBHOTO where sid=? order by num', $sid);
    $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
    while($row=mysql_fetch_assoc($result)){
      $row=stripslashes_array($row);
	   $type=$row['type'];
   if ($type=="image/gif"){ $imgtype="gif";}else{ $imgtype="jpg";};
   $row['type']=$imgtype;
      $text.=pars($row,$tpl_tr);

    }

     $query=sql_placeholder('select * from ?#CATALOG where id=?', $sid);
     $row=select_row($query);

     $row=array('TR'=>$text, 'parent_id'=>$row['parent_id'], 'pid'=>$_GET['pid'], 'sid'=>$_GET['sid']);
     $text=pars($row, $tpl_main);
     return $text;
}


function addsubphoto($pid,$sid){
   $dir=''.DIR_GALLERY.$pid;
   $text='';
   if (empty($_POST)){
           $text=pars(array('comment'=>'','num'=>'', 'alt'=>''),load_tpl_var('cms_admin/gallery/from_photo.tpl'));

   }
   elseif(empty($_FILES['photo']['name'])){
         $text.='Вы не выбрали фото <br> <a href=# onclick="history.back();">Назад</a> ';
   } else{
       if (!file_exists($dir.'/'.$sid)){
               mkdir($dir.'/'.$sid);
       }
    $type =$_FILES['photo']['type'];
       $query=sql_placeholder('insert into ?#GPSUBHOTO(`pid`, `sid`,`num`, `comment`, `alt`, `type`)
                               values(?,?,?,?,?,?)
                               ', $pid, $sid, $_POST['num'], $_POST['comment'], $_POST['alt'],$type);

      
	  
     
      mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);
      $dir=$dir.'/'.$sid.'/';
      $fid=mysql_insert_id();
	  //echo $fid;
	  if ($type=="image/gif"){ $filename=$fid.".gif";}else{$filename=$fid.".jpg";};
      //echo $dir.'/'.$filename;
      $err=upload_jpg('photo', $filename, $dir);
      if ($err==-1){
          $text.='Файл имеет неверный формат <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }elseif ($err<1){
          $text.='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }

      // resize_image(450, 320,  $dir.$filename, $dir."_".$filename );
       resize_image(150, 100,  $dir.$filename, $dir."__".$filename );

    $text='<a href="?mod=catalog&action=listsubphoto&pid='.$pid.'&sid='.$sid.'">Назад</a>';
   }

   return $text;
}


function editsubphoto($pid,$sid,$id){
  $dir=''.DIR_GALLERY;
  $text='';
  $query=sql_placeholder('select * from ?#GPSUBHOTO where id=?', $id);
   $row=select_row($query);
   if (!$row) return ' Ошибка. Записи не сушествует ';
   $pid=$row['pid'];
   $sid=$row['sid'];
   $type=$row['type'];
   $dir=$dir.'/'.$pid.'/'.$sid.'/';
   if (empty($_POST))
         $text=pars($row,load_tpl_var('cms_admin/gallery/from_photo.tpl'));
   else{
      if(!empty($_FILES['photo']['name'])){
          if (!file_exists($dir)){
               mkdir($dir);
          }
		 if ($type=="image/gif"){ $imgtype=".gif"; }else{ $imgtype=".jpg";};
		
      @    unlink($dir.$id.$imgtype);
     // @   unlink($dir."_".$id.".jpg");
      @   unlink($dir."__".$id.$imgtype);
	  
      $filename=$id.$imgtype;
      $err=upload_jpg('photo', $filename, $dir);
      if ($err==-1){
          $text.='Файл имеет неверный формат <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }elseif ($err<1){
          $text.='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }

      // resize_image(400, 300,  $dir.$filename, $dir."_".$filename );
       resize_image(150, 100,  $dir.$filename, $dir."__".$filename );


      }

      $arr['comment']=$_POST['comment'];
      $arr['num']=$_POST['num'];
      $arr['alt']=$_POST['alt'];
      $query=sql_placeholder('update ?#GPSUBHOTO set ?% where id=?', $arr, $id);
      mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);
      $text='<a href="?mod=catalog&action=listsubphoto&pid='.$pid.'&sid='.$sid.'">Назад</a>';
   }

   return $text;

 }


function delsubphoto($pid,$sid,$id){
  $text='';
  $query=sql_placeholder('select * from ?#GPSUBHOTO where id=?', $id);
  $row=select_row($query);
  $type=$row['type'];
   if ($type=="image/gif"){ $imgtype=".gif";}else{ $imgtype=".jpg";};
  if (!$row) {
          header('Location: index.php');
          exit;
  }
   $dir=''.DIR_GALLERY.$row['pid']."/".$row['sid']."/";
   @   unlink($dir.$id.$imgtype);
   @   unlink($dir."_".$id.$imgtype);
   @   unlink($dir."__".$id.$imgtype);

   $query=sql_placeholder('delete from ?#GPSUBHOTO where id=?', $id);
  mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);

   $text='<a href="?mod=catalog&action=listsubphoto&pid='.$pid.'&sid='.$sid.'">Назад</a>';
  return $text;

}


?>