<?php

header("Expires: Thu, 19 Feb 2006 13:24:18 GMT");
header("Last-Modifier: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0");
header("Cache-Control: max-age=0");
header("Pragma: no-cache");



define('START_TIME', array_sum(explode(' ', microtime())));

$action=(empty($_GET['action']))?'':$_GET['action'];
$id=(empty($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id']<0)?0:$_GET['id'];
$_GET['page']=(empty($_GET['page']) || !is_numeric($_GET['page']) && $_GET['page']<1)?1: (int) $_GET['page'];


 // удал€ем просроченные сессии
 $time=mktime();
 mysql_query("delete from ".SESSIONS. " where delet_time<'$time'") or die (mysql_error());


 $auth=false;

if (!empty($_COOKIE['session']))

 {

    $session=mysql_escape_string($_COOKIE['session']);
//    $session=$_COOKIE['session'];
    $time=mktime()+STIME; //

    $array=array('delet_time'=>$time,);
    edit_to_bases(SESSIONS, $array, 'session_id', $session);

    $query=sql_placeholder('select count(*) as cnt, u.id, u.login, u.email from ?#USER as u, ?#SESSIONS as s
    			       where s.session_id=?
    			       and s.id_user=u.id group by u.id', $session);

   $user_data=select_row($query);

   if (!empty($user_data['cnt']))
   {
	   $auth=true;
	   define('USER_ID', $user_data['id'] );
   }

}

if ($auth==false)
  {
     $session=md5($_SERVER['REMOTE_ADDR'].mktime());
     $time=mktime()+STIME; //
     $query="insert into " .SESSIONS."(id_user,session_id,delet_time)
                            values('1','$session','$time')";

      $array=array('id_user'=>1,'session_id'=>$session, 'delet_time'=>$time);
      add_to_bases(SESSIONS , $array);
      $user_data=array('id'=>1, 'login'=>'√ость', 'email'=>'');
      define("USER_ID", 1);

  }



   $domain =explode('.', $_SERVER["HTTP_HOST"]);
   $cnt=count($domain);
 if ($cnt<1) die ('ƒомен не определен') ;


   $host=(empty($domai[$cnt-2]))?'.'.$domain[$cnt-2]:'';
   $host.='.'. $domain[$cnt-1];

// устанавливаем константу сессии
define('SESSION_ID',$session);
setcookie("session",$session, time()+STIME,'/', $host);



?>