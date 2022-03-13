<?

// устанавливает права для группы
function accesstogroup($gid)
{
  $query=sql_placeholder('
      select count(*) as cnt from ?#CMS_ACCESS as a , ?#GROUP2USER as g2u
        where a.name="addgroup"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);
   if  (!select_row($query)) return "Нет доступа для изменения прав доступа группы";


  $query=sql_placeholder('delete from ?#CMS_ACCESS where gid=?', $gid);
  $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");

  if (!empty($_POST['accessgroup']) && is_array($_POST['accessgroup']))
   {
    $query=sql_placeholder('insert into ?#CMS_ACCESS(`name`,`gid`) values');
     foreach($_POST['accessgroup'] as $kl=>$vl)
       {
          $q=sql_placeholder('select count(*) as cnt from ?#CMS_ACTION where name=?', $kl);

          if (select_row($q))
          $query.=sql_placeholder('(?,?),',$kl,$gid);
       }
      $query=substr($query,0,(strlen($query)-1));
      $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");
   }

   $text='<a href=?mod=user&action=g2u&gid='.$gid.'>Назад</a>';
   return $text;
}




// добавляет группу
function addgroup()
{
    $query=sql_placeholder('
      select count(*) as cnt from ?#ACCESS as a , ?#GROUP2USER as g2u
        where a.modul="addgroup"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

//    if  (!select_row($query)) return "Нет доступа для добавления группы";

   $text='';
   if (!empty($_POST['group']))
   {
       $query=sql_placeholder('select count(*) as cnt from ?#GROUP where name=?', $_POST['group']);
       $num=select_row($query);
       if ($num)
       {
          $text.="Группа уже сушествует. <br>";
       }
       else
       {
           $query=sql_placeholder('insert into ?#GROUP(`name`)  values(?)',$_POST['group']);
           $result=mysql_query($query);

       }

     $text.='<a href=?mod=user&action=viewgroup>Назад</a>';
     return $text;
   }
}

// добавляет пользователя

function addusertogroup($gid)
{
   $query=sql_placeholder('
      select count(*) as cnt from ?#ACCESS as a , ?#GROUP2USER as g2u
        where a.modul="adduser"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

//    if  (!select_row($query)) return "Нет доступа для добавления  пользователя в группы";

   $text='';
   if (!empty($_POST['login']))
   {
       $query=sql_placeholder('select count(*) as cnt from ?#USER where login=?', $_POST['login']);
       $num=select_row($query);
       if (!$num)
       {
          $text.="Пользователь не сушествует. <br>";
       }
       else
       {
           $query=sql_placeholder('select id from ?#USER where login=?', $_POST['login']) ;
           $uid=select_row($query);

           $query=sql_placeholder('select count(*) as cnt from ?#GROUP2USER where user_id=? and group_id=?', $uid,$gid);

           $num=select_row($query);
                       if (!$num)
                               {
                          $query=sql_placeholder('insert into ?#GROUP2USER(`user_id`, `group_id`)  values(?,?)',$uid, $gid );
                             $result=mysql_query($query);
                }
                else
                {
                   $text.='Пользователь уже добавлен. <br>';
                }

      }


     $text.='<a href=?mod=user&action=g2u&gid='.$gid.'>Назад</a>';
     return $text;
   }
}

// функция добавляет нового пользователя
function adduser()
{
    $query=sql_placeholder('
      select count(*) as cnt from ?#ACCESS as a , ?#GROUP2USER as g2u
        where a.modul="viewuser"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

   // if  (!select_row($query)) return "Нет доступа для добавления пользователей";

   $page=(!empty($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0)?$_GET['page']:0;

   if (!empty($_POST['login']) && !empty($_POST['password']))
   {
      $login=substr($_POST['login'],0,16);
      $password=substr($_POST['password'],0,16);
      $email=substr($_POST['email'],0,60);

      $query=sql_placeholder('
	      select count(*) as cnt from ?#USER where login=?
      ', $login);
      if (!select_row($query))
      {
        $query=sql_placeholder('
           insert into ?#USER(`login`,`password`,`email`) values(?,md5(?),?)
       	 ',$login,$password,$email);

     	  $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");
          $text="Пользователь добавлен <br> ";
          $text.="<a href=?mod=user&action=viewuser&page=$page>Назад</a>";

      }
      else
      {
          $text="Логин занят<br>";
          $text.="<a href=# onclick='history.back();'>Назад</a>";
      }

   }
   else
   {
       $text="Не все поля заполнены<br>";
       $text.="<a href=# onclick='history.back();'>Назад</a>";
   }
  return $text;
}


function deluser($id)
{
     $query=sql_placeholder('
      select count(*) as cnt from ?#ACCESS as a , ?#GROUP2USER as g2u
        where a.modul="viewuser"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

//    if  (!select_row($query)) return "Нет доступа для удаления пользователей";

    $query=sql_placeholder('delete from ?#USER where id=?', $id);
    $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");
    $query=sql_placeholder('delete from ?#GROUP2USER where user_id=?', $id);
    $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");

    $page=(!empty($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0)?$_GET['page']:0;
    header('Location: index.php?mod=user&action=viewuser&page='.$page);
    exit;
}



// удаляет группу
function delgroup($id)
{
  $query=sql_placeholder('
      select count(*) as cnt from ?#ACCESS as a , ?#GROUP2USER as g2u
        where a.modul="addgroup"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

//   if  (!select_row($query)) return "Нет доступа для удаления группы";

  $query=sql_placeholder('delete from ?#GROUP where id=?', $id);
  $result=mysql_query($query);
  $query=sql_placeholder('delete from ?#GROUP2USER where group_id=?', $id);
  $result=mysql_query($query);

   $text='<a href=?mod=user&action=viewgroup>Назад</a>';
   return $text;
}


function delusertogroup($uid, $gid)
{

  $query=sql_placeholder('
      select count(*) as cnt from ?#ACCESS as a , ?#GROUP2USER as g2u
        where a.modul="adduser"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

//    if  (!select_row($query)) return "Нет доступа для удаления пользователя из группы";

   $query=sql_placeholder('delete from ?#GROUP2USER where user_id=? and group_id=?', $uid, $gid);
   $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");
   $text='<a href=?mod=user&action=g2u&gid='.$gid.'>Назад</a>';
   return $text;


}
function editgroup($id)
{
    $query=sql_placeholder('
      select count(*) as cnt from ?#ACCESS as a , ?#GROUP2USER as g2u
        where a.modul="addgroup"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

//    if  (!select_row($query)) return "Нет доступа";



   $text='';
   $page=(!empty($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0)?$_GET['page']:0;
   if (empty($_POST['name']))
    {

          $tpl=load_tpl_var('cms_admin/users/edit_group.tpl');
          $query=sql_placeholder('select * from ?#GROUP where id=?', $id);
          $row=select_row($query);
          $row['page']=$page;
          $text=pars($row, $tpl);

    }
    else
    {
        $query=sql_placeholder('select count(*) as cnt from ?#GROUP where name=? and id!=?', $_POST['name'], $id);
          if (select_row($query))
          {
               $text="Группа с таким именем существует<br>";
               $text.="<a href=# onclick='history.back();'>Назад</a>";
          }
          else
          {
       	   $array=array(
	         	'name'=>substr($_POST['name'],0,255),
	          	);

            $query=sql_placeholder('update ?#GROUP set ?% where id=? ' ,$array, $id);
            $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");


            $text="Данные изменены <br> ";
            $text.="<a href=?mod=user&action=viewgroup&page=$page>Назад</a>";
          }

    }
    return $text;
}


function edituser($id)
{
  $query=sql_placeholder('
      select count(*) as cnt from ?#CMS_ACCESS as a , ?#GROUP2USER as g2u
        where a.name="adduser"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

     if (!select_row($query)) return "Нет доступа для добавления пользователей";

     $page=(!empty($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0)?$_GET['page']:0;

     $text='';
     if (empty($_POST['login']))
     {
          $tpl=load_tpl_var('cms_admin/users/view_user.tpl');

          $query=sql_placeholder('select * from ?#USER where id=?', $id);
          $row=select_row($query);
          $row['page']=$page;
          $text=pars($row, $tpl);

     }
     else
     {
	      $query=sql_placeholder('select count(*) as cnt from ?#USER where login=? and id!=?', $_POST['login'], $id);
          if (select_row($query))
          {
               $text="Логин занят<br>";
               $text.="<a href=# onclick='history.back();'>Назад</a>";
          }
          else
          {
	       $array=array(
	       	'login'=>substr($_POST['login'],0,16),
	       	'email'=>substr($_POST['email'],0,60),
	       	);
	      	if (!empty($_POST['password']))
	      	{
	           $array['password']=md5(substr($_POST['password'],0,16));
	        }
            $query=sql_placeholder('update ?#USER set ?% where id=? ' ,$array, $id);
            $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");


            $text="Данные изменены <br> ";
            $text.="<a href=?mod=user&action=viewuser&page=$page>Назад</a>";
          }
     }

  return $text;
}

// функция выводит список групп
function viewgroup()
{
   $text='';

   $query=sql_placeholder('
      select count(*) as cnt from ?#CMS_ACCESS as a , ?#GROUP2USER as g2u
        where a.name="viewgroup"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

    if  (!select_row($query)) return "Нет доступа для просмотра списка групп";

   $query=sql_placeholder('select g.* from ?#GROUP as g order by name');
   $result= mysql_query($query);
   $tpl=load_tpl_var('cms_admin/users/list_group.tpl');
   $tpltr=pars_reg( $tpl,'TR');
   $i=0;
   while($row=mysql_fetch_assoc($result))
   {
       $row=stripslashes_array($row);
       $i++;
       $row['color']=($i%2)?'ffffff':'95B6FF';
       $text.=pars($row, $tpltr);
   }
   $text=str_replace($tpltr,$text,$tpl);
   return $text;
}



// выводит всех пользователей в группе
function viewg2u($gid=0)
{
   $query=sql_placeholder('
      select count(*) as cnt from ?#CMS_ACCESS as a , ?#GROUP2USER as g2u
        where a.name="viewuser"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

  if  (!select_row($query)) return "Нет доступа для просмотра списка Пользователей в группе";

   $query=sql_placeholder('select name from ?#GROUP where id=?', $gid);
   $gname=select_row($query);



  $tpl='';
  $text='';
  $query=sql_placeholder('select u.login as name, u.id from ?#GROUP2USER as g2u , ?#USER as u
                                  where g2u.user_id=u.id
                                  and g2u.group_id=?
                                  ', $gid);


  $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");


  $tpl=pars(array('gname'=>$gname),load_tpl_var('cms_admin/users/list_user_to_group.tpl'));
  $tpltr=pars_reg( $tpl,'TR');
  $i=0;

  while($row=mysql_fetch_assoc($result))
  {
    $row=stripslashes_array($row);
    $i++;
    $row['color']=($i%2)?'ffffff':'95B6FF';
    $text.=pars($row, $tpltr);
  }


 $textaccess='';
 $modul=(empty($_GET['modul']))?'':$_GET['modul'];
 $folder='admin/moduls/access/';
 if ($dir = opendir($folder))
 {
 	 while (($file = readdir($dir)) !== false)
 	 {
  	     if (is_file($folder.$file)) include $folder.$file;
  	 }
  closedir($dir);
  }

  //$text.=$textaccess;
  $text=str_replace(array($tpltr,'{gid}','{modul}', '{tplaccess}'),array($text, $_GET['gid'], $modul, $textaccess),$tpl);
  return $text;
}




// функция выводит список пользователей
function viewuser()
{
   $query=sql_placeholder('
      select count(*) as cnt from ?#CMS_ACCESS as a , ?#GROUP2USER as g2u
        where a.name="viewuser"
        and a.gid=g2u.group_id
        and g2u.user_id=?
        ', USER_ID);

   if  (!select_row($query)) return "Нет доступа для просмотра списка Пользователей";

    $query=sql_placeholder('select count(*) as cnt from ?#USER');
    $limit=20;
    $page=(!empty($_GET['page'])
        	&& is_numeric($_GET['page'])
    		&& $_GET['page']>0)?($_GET['page']-1)*$limit:'0';



    $url="mod=user&action=viewuser";
	$page_link=page_list($query, $limit , $url, $page);

    $query=sql_placeholder('
        select * from ?#USER order by login limit ?, ?
    	', $page, $limit);
   $result=mysql_query($query) or die(mysql_error()."<hr> line ".__LINE__." file  ". __FILE__."<hr>");
   $tpl=load_tpl_var('cms_admin/users/list_user.tpl');
   $tpltr=pars_reg($tpl,"TR");
   $text="<div align=center>".$page_link."</div>";
   $i=0;
   while($row=mysql_fetch_assoc($result))
    {
        $row=stripslashes_array($row);
        $i++;
        $row['color']=($i%2)?'ffffff':'95B6FF';
        $row['page']=(empty($_GET['page']))?0:$_GET['page'];
        $text.=pars($row, $tpltr);
    }

    $text=str_replace($tpltr,$text,$tpl);

    return $text;
}









?>