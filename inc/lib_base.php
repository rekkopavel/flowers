<?
/*****************************************************************************
Файл содержит наиболее частоиспользуемые функции
*****************************************************************************/
// функция проверки доступа к действию

function access_user($modul,$mid)
{
  $query=sql_placeholder('select count(*) as cnt
          from  ?#ACCESS as a , ?#GROUP2USER as g2u
           where   a.mid=?
           and a.modul=?
           and g2u.user_id=?
           and g2u.group_id=a.gid
           ',
             $modul, $mid, USER_ID);
  return select_row($query);
}

function add_to_bases($table , $array)
{
   $kl_array=array();
   $vl_array=array();

   foreach($array as $kl=>$vl)
   {
    array_push ($kl_array ,$kl);
    array_push ($vl_array ,$vl);
   }

   $query=sql_placeholder('INSERT INTO `'.$table.'` (?_) VALUES (?@)' , $kl_array , $vl_array);
  mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<BR>");


}

 function delete_to_bases($table, $array ,$field)
  {
     $query=sql_placeholder('delete from  `'.$table.'`  where ?_ in (?@)' ,$field, $array);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
  }

 function  db_error($text='Остановленно'){
    echo "<pre>";
    echo $text;
    echo "</pre>";
    //exit;
 }


function escape_post()
{
       foreach ($_POST as $kl => $vl)
        {
          $_POST[$kl]=mysql_escape_string($vl);
        }
}
function escape_get()
{
       foreach ($_GET as $kl => $vl)
        {
          $_GET[$kl]=mysql_escape_string($vl);
        }
}

  function edit_to_bases($table, $array, $field='id', $value='')
  {

    // $value=(!empty($value))?$value:(empty($_GET['id']))?'':$_GET['id'];
     $query=sql_placeholder('update `'.$table.'` set  ?% where '.$field.'=?' ,$array, $value);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");

  }


// функция очишает значение Пост запрос от лишних пробелов
function form_trim($arr)
 {
    foreach($arr as $kl => $vl)
   {
     $arr[$kl]=trim($vl);
   }
   return $arr;
 }

function history($id)
{

   $text='';
   if ($id>0)
   {
    $query=sql_placeholder('select * from ?#CATALOG where id=?', $id);
    $row=select_row($query);
    $text='<a href=/page/'.$row['id'].'.html>'.$row['name'].'</a> / '. $text;
    if ($row['parent_id']>0)
    {
         $text=history($row['parent_id']).$text;
    }
   }
    return $text;
}

function htmlspecialchars_array($row)
{
    if (!is_array($row)) return;
     foreach ($row as $kl => $vl)
        {
          $row[$kl]=htmlspecialchars($vl);
        }

return $row;
}



// функция авторизации пользователя
function login_in_mme()
{
   $text='';
   $content='';
   $login='';
   $password='';
   $_POST=form_trim($_POST);
   escape_post();

   if(!empty($_POST['login_cms']))
   {
   $login=substr($_POST['login_cms'],0,15);
   $password=substr($_POST['password_cms'],0,15);
   }
   else
   {
    $login=substr($_POST['login'],0,15);
    $password=substr($_POST['password'],0,15);
   }

   $query="select login, id from ".USER." where login='".$login."' and password=md5('".$password."')";
   $result=mysql_query($query);
   $num=mysql_num_rows($result);


   if ($num==1)
   {
      $row=mysql_fetch_assoc($result);

      $content="Вы вошли как <b>".$row['login']."</b><br> <a href='index.php'>Я не хочу ждать</a>";
      $query=sql_placeholder('update  ?#SESSIONS set id_user=? where session_id=?',$row['id'], SESSION_ID);
      mysql_query($query) or die('error');
      header("Location: ".$_SERVER["REQUEST_URI"]);

   }
   else
   {
     $content="Такого сочетание логина и пароля не существует <br> <a href='index.php'>Я не хочу ждать</a>";
     $text=strtr(load_tpl_var('message.tpl'),
         array(
         "{TITLE}"=>'Авторизация',
             "{URL}"=> $_SERVER["REQUEST_URI"],//'index.php',//
             "{CONTENT}"=>$content,

                   ));

     echo $text;


  }
  exit;

}


// фозврашает страницу шаблона
function load_tpl_var($tpl)
{
  $text='';
  $lang=(!empty($_COOKIE['lang']) && $_COOKIE['lang']=='en')?'en':'ru';

  $filename="tpl/$lang/$tpl";
  if(!file_exists($filename))
    $text="Шаблон <b>".$filename."</b> не найден";
  else
   $text =        file_get_contents($filename);
  return $text;
}

function mysql_string($row)
{
 if (!is_array($row)) return;
     foreach ($row as $kl => $vl)
        {
          $row[$kl]=mysql_escape_string($vl);
        }
   return $row;
}



// функция возврашает часть  шаблона
function pars_reg($tpl,$mark)
{
    $text='';
        $reg="#<!--BEGIN $mark-->(.*?)<!--END $mark-->#is";
        $n=preg_match_all($reg,$tpl,$arr);
        if ($n!=0) $text=$arr[1][0];
  return $text;
}


// Функция замены шаблонов
 function pars($pars, $page)
 {
   if (!is_array($pars)) return $page;
   foreach($pars as $kl => $vl)
    {
       $page = str_replace("{".$kl."}", "$vl" ,  $page);
    }
   return $page;
 }

 function page_list($cnt, $limit , $url, $page)
{

   $page_list='';
   //$result=mysql_query($query) or die(mysql_error());
   //$row=mysql_fetch_array($result);
   //$cnt=$row['cnt'];
   $page_cnt=ceil ($cnt/$limit);
  // постраничный вывод
   $page_num=$page;
 if  ($page_cnt<11)
  {
       for($i=1;$i<=$page_cnt;$i++)
       {
           if (($i)==($page_num)) $page_list.=''.$i.' ';
          else $page_list.='<a href=?'.$url.'&type='.$_GET['type'].'&page='.$i.'&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>'.$i.'</a> ';
       }
   }
   else
   {
   
      switch(TRUE)
      {
       case (!$page_num||($page_num)<5):
   
          for($i=1;$i<=6;$i++)
         {
            if (($i)==($page_num)) $page_list.=''.$i.' ';
            else $page_list.='<a href=?'.$url.'&type='.$_GET['type'].'&page='.$i.'&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>'.$i.'</a> ';
         }
        $page_list.='...<a href=?'.$url.'&type='.$_GET['type'].'&page='.$page_cnt.'&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>'.$page_cnt.'</a>';
       break;
       case ($page_num==($page_cnt-1)||$page_num>$page_cnt-5):
            $page_list.='<a href=?'.$url.'&type='.$_GET['type'].'&page=1&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>1</a>...';
            for($i=($page_cnt-5);$i<=$page_cnt;$i++)
           {
             if (($i)==($page_num)) $page_list.=''.$i.' ';
             else $page_list.='<a href=?'.$url.'&type='.$_GET['type'].'&page='.$i.'&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>'.$i.'</a> ';
           }
       break;
       default:
	   
          $page_list.='<a href=?'.$url.'&type='.$_GET['type'].'&page=1&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>1</a>...';

             for($i=($page_num-3);$i<=($page_num+4);$i++)
           {
             if (($i)==($page_num)) $page_list.=''.$i.' ';
             else $page_list.='<a href=?'.$url.'&type='.$_GET['type'].'&page='.$i.'&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>'.$i.'</a> ';
           }
          $page_list.='...<a href=?'.$url.'&type='.$_GET['type'].'&page='.$page_cnt.'&mader='.$_GET['mader'].'&sid='.$_GET['sid'].'>'.$page_cnt.'</a>';
       break;
      }

   }
   // конец постраничной навигации
 return  $page_list;

}



function registration_in_mme()
{
   $error_msg='';
   if ($_POST['password']!=$_POST['password_2'])
     $error_msg.='Пароли не совподают<br>';
   if (preg_match("/\w+@\w+\.\w+/i",$_POST['email'])==0)
    $error_msg.='Email не корректен<br>';

   $query=sql_placeholder('select count(*) from ?#USER where login=?', $_POST['login']);
   if (select_row($query))
    $error_msg.='Логин занят<br>';

   if ($error_msg=='')
   {
      $query=sql_placeholder('insert into ?#USER(`login`, `password`, `email` )
            values(?,?,?)',
             $_POST['login'], md5($_POST['password']), $_POST['email']);
      mysql_query($query);
      $id=mysql_insert_id();

     $query=sql_placeholder('select id from ?#GROUP where name="users"');
     $gid=select_row($query);
     $query=sql_placeholder('insert into ?#GROUP2USER (`user_id`, `group_id`)
             values(?,?)', $id, $gid);
     mysql_query($query);
     $query=sql_placeholder('update ?#SESSIONS set  id_user=? where session_id=?', $id, SESSION_ID);
     mysql_query($query);

     header('Location: index.php?'.$_SERVER['QUERY_STRING']);
     exit;

   }
   else
   {
     echo $error_msg;
   }

}




function stripslashes_array($row)
{
    if (!is_array($row)) return;
     foreach ($row as $kl => $vl)
        {
          $row[$kl]=stripslashes($vl);
        }

return $row;
}


function  select_row($query)
{
   //echo $query.'<br>';
   $result=mysql_query($query) or die ( $query.'<hr>'.mysql_error().' line '.__LINE__. ' file '. __FILE__ );
   if ($row=mysql_fetch_assoc($result))
   {
       $row=stripslashes_array($row);
       if (count($row)==1)
        {
         foreach($row as $vl)
         return $vl;
        }
    return  $row;
   }
   else
   return '';

}
function  select_col($query)
{

$col=array();
   //echo $query.'<br>';
   $result=mysql_query($query) or die ( $query.'<hr>'.mysql_error().' line '.__LINE__. ' file '. __FILE__ );
     if (!$result) return '';
  while($row=mysql_fetch_row($result)){
		$row=stripslashes_array($row);
		$col=array_merge($col,$row);
		
    }
   
  return $col; 
}

// Функции отправки писем в текстовом формате и формате html
function send_mail($from, $to, $subject, $msg)
{
$header="From: $from
MIME-Version: 1.0
Content-type: text/plain; charset=windows-1251
Content-transfer-encoding: 8bit";
 mail($to , $subject, $msg, $header);
}

function send_mail_html($from,$to,$sub,$msg )
{
            $subject="Тема письма";
$header='Content-type: text/html; charset="windows-1251
From: "dostavka-rus.ru" <'.$from.'>
Subject: '.$sub.'
Content-type: text/html; charset="windows-1251"';

$msg="<body>$msg

</body>";
$err=mail($to, $sub, $msg, $header);
//echo $err.'yyyyyy';
}



function  send_email_attach($to,$from_mail,$from_name,$subject,$message,$file_name='') {
 $bound="spravkaweb-1234";
 $header="From: \"$from_name\" <$from_mail>\n";
// $header.="To: $to\n";
 $header.="Subject: $subject\n";
 $header.="Mime-Version: 1.0\n";
 $header.="Content-Type: multipart/mixed; boundary=\"$bound\"";
 $body="\n\n--$bound\n";
 $body.="Content-type: text/html; charset=\"windows-1251\"\n";
 $body.="Content-Transfer-Encoding: 8bit\n\n";//quoted-printable\n\n";
 $body.="$message";


 if (is_file($file_name))
 {
         $file=fopen($file_name,"rb");
         $body.="\n\n--$bound\n";
         $body.="Content-Type: application/octet-stream;";
         $body.="name=\"".basename($file_name)."\"\n";
         $body.="Content-Transfer-Encoding:base64\n";
         $body.="Content-Disposition:attachment\n\n";
         $body.=base64_encode(fread($file,filesize($file_name)))."\n";
         $body.="$bound--\n\n";
  }
 if(mail($to, $subject, $body, $header))
 return TRUE;
 else return FALSE;
};


//  функция отвечает за добавление дочернего элемента


  function select_to_bases($table, $field='id', $value='')
  {

      if (empty($value)) $value=(empty($_GET['id']))?'':$_GET['id'];
      $query=sql_placeholder('select *  from `'.$table.'` where `'.$field.'`=?' , $value);
      $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
      return stripslashes_array(mysql_fetch_assoc($result));

  }




 function resize_image($max_width, $max_height, $source, $destination) {


         $w_h=GetImageSize($source);
         $width=$w_h[0];
         $height=$w_h[1];

         $x_ratio = $max_width / $width;
         $y_ratio = $max_height / $height;

         if ( ($width <= $max_width) && ($height <= $max_height) ) {
           $tn_width = $width;
           $tn_height = $height;
         }
         else if (($x_ratio * $height) < $max_height) {
           $tn_height = ceil($x_ratio * $height);
           $tn_width = $max_width;
         }
         else {
           $tn_width = ceil($y_ratio * $width);
           $tn_height = $max_height;
         }

      $width=$tn_width ;
      $height= $tn_height;
$type =$_FILES['photo']['type'];
if ($type=="image/gif"){  $src = imagecreatefromgif($source);;}else{$src = imagecreatefromjpeg($source);};
      
      $img = imagecreatetruecolor($width, $height);
      imagecopyresampled($img, $src, 0, 0, 0, 0, $width, $height, imagesx($src),imagesy($src));
//    @unlink($destination);
if ($type=="image/gif"){imageGIF($img, $destination);}else{imageJPEG($img, $destination);};
      
       imagedestroy($img);
       imagedestroy($src);

}




function upload_jpg($fname, $filename, $dir)
{

$filename = str_replace(array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ъ', 'ы', 'э', 'ю', 'я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $filename);
$filename = str_replace(array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ъ', 'Ы', 'Э', 'Ю', 'Я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $filename);

 if (!empty($_FILES[$fname]) && is_uploaded_file($_FILES[$fname]["tmp_name"]))
    {

            $type=$_FILES[$fname]['type'];
			
            $allowed_types = array("image/jpeg","image/pjpeg",  "image/gif");
            $size=filesize($_FILES[$fname]['tmp_name']);
            if($size>307000) return -1;


        if ((in_array($type,$allowed_types)))// && $size<40*1024)
           {
                // echo $dir.$filename;
                   $res = move_uploaded_file($_FILES[$fname]["tmp_name"], $dir.$filename );
                  // resize_image($tn_width,$tn_height, $dir.$filename, $dir.'_'.$filename );
       
            if ($res)  return $filename;
            else
            {
                    return -2;
            }
           }
         else
         {

            return -2;
         }
    }
    else
    {
      return -2;
    }
}



?>