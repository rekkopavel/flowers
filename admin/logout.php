<?php
chdir('../');
//include "_auth.php";
include "lib_fnc.php";
$query="delete from `".SESSIONS."` where session_id='".SESSION_ID."'";
mysql_query($query);


   $domain =explode('.', $_SERVER["HTTP_HOST"]);
   $cnt=count($domain);
 if ($cnt<1) die ('Домен не определен') ;


   $host=(empty($domai[$cnt-2]))?'.'.$domain[$cnt-2]:'';
   $host.='.'. $domain[$cnt-1];


setcookie("session", '', time()-24*60*60*60,'/',$host);
header('Location: index.php');

?>