<?
session_start();
include "../lib_fnc.php";

if (empty($_GET['action'])) $_GET['action']='brows';
 switch($_GET)
 {
    // отображуем содержимое учтановленного каталога
    case ($_GET['action']=='brows'):
    $content=view_files();

    break;
    // добавляем подкаталог
    case ($_GET['action']=='add'):

     	if (empty($_POST['namedir']))
	       {
	         $content=load_tpl_var('filemanager/form_new_dir.tpl');
	       }
	      elseif(!empty($_POST['namedir']))
	       {
	               if (valid_name_dir($_POST['namedir']))
	               {
	                  add_dir();
	                  $content=load_tpl_var('filemanager/form_new_dir.tpl');
	               }
	               else  {  $content='Имя каталога не корректно.<br>'. view_files(); }
	       }
     break;
     case ($_GET['action']=='del'):

          if(!empty($_GET['f']))
          {
             	 if (delet_file('file'))
	               {
	                 header('Location: ?mod=files&action=brows');
	                 exit;
	               }
	               else
	               {
	                  $content='Нет прав на удаление '.$_GET['f'].'<br>
	                  <a href="?mod=files&action=brows">Назад</a>
	                   ';
	               }
          }
         if(!empty($_GET['c']))
         {
                  if (delet_file('dir'))
	               {
	                 header('Location: ?mod=files&action=brows');
	                 exit;
	               }
	               else
	               {
	                  $content='Нет прав на удаление '.$_GET['c'].' или каталог не пуст<br>
	                  <a href="?mod=files&action=brows">Назад</a>
	                   ';
                   }
           }
     break;
     case ($_GET['action']=='load'):
        if (!empty($_POST['act']))
        {
          if  (upload_file())
          {
           header('Location: ?mod=files&action=brows');
	        exit;
          }
          else
          {
             $content="Ошибка загрузки файла <br>".load_tpl_var('filemanager/form_upload_file.tpl');
          }
        }
        else
        {
          $content=load_tpl_var('filemanager/form_upload_file.tpl');

        }

     break;

 }

?>
  <DIV id="boxmenu">
<table cellspacing="2" cellpadding="2" align="left"><TR><TD>
<DIV id="m">
<DIV class="menu"><A class="a" href="#">Действия<br>
<TABLE>
<TR><TD>
<DIV><A href="?mod=files&action=add">Новая папка</A></DIV>
<DIV><A href="?mod=files&action=load">Загрузить файл</A></DIV>
</TD></TR>
</TABLE>
</A>
</DIV>
</table>
</div>    <br>
<?

echo $content;

// функиця добавляет каталог на сервере в отведенном по файлы каталоге
function add_dir()
{
  if (valid_name_dir())
  {
   $tmp=$_POST['namedir'];
   chdir('../UserFiles');
   if (!file_exists($_SESSION['dir'].$tmp))  mkdir ($_SESSION['dir'].$tmp, 0777);
  }
   header("Location: ?mod=files&action=brows");
   exit;
}
// функция ппоказывает содержание каталога отведенного под файлы
function  view_files()
 {
   chdir('../UserFiles');
	    if (empty($_SESSION['dir'])) $_SESSION['dir']='./';
        if (!empty($_GET['cat'])&& basename($_GET['cat'])!='..' && basename($_GET['cat'])!='.')
	    {
	      $_SESSION['dir'].=basename($_GET['cat']).'/';
	      header("Location: ?mod=files&action=brows");
	      exit;
	    }
	    if(isset($_GET['up']))
	    {
	      $leng_1=strlen($_SESSION['dir']);
	      $leng_2=strlen(basename($_SESSION['dir']));
	      $_SESSION['dir']=substr($_SESSION['dir'],0,($leng_1-$leng_2-1));
	      header("Location:  ?mod=files&action=brows");
	      exit;
	    }
   if (file_exists($_SESSION['dir'])) return brows_folder();
   else
   {
    $_SESSION['dir']='./';
    header("Location:  ?mod=files&action=brows");
    exit;
   }
}

function brows_folder()
{
    $i=0;
    $dir=$_SESSION['dir'];
    $imgdir=opendir($dir);
    $text= '<table border=0 width="80%"><tr><td colspan=2><b>Имя файла</b></td><td><a href=?mod=files&action=brows&up>UP</a></td></tr>';
	            while ($file=readdir($imgdir))
	               {
	                if (!is_dir($dir.$file))
	                    {
	                      $i++;
                          ($i%2)? $color="#CFCFCF" : $color='#F9F9F9';
                      $insert="
                      [<a href=# onclick=\"if (confirm('Вы желаете удалить: \\n $file'))
                       location.href='?mod=files&action=del&f=".$file."' ;else return false;\">Удалить</a>]";
                     $sel="<a href=# onclick=\"window.opener.document.forms.f1('address').value='/UserFiles/".substr($dir,2)."$file';window.self.close();\">[выбрать]</a>";
                      $text.= "<tr bgcolor=$color align='center'><td align='left'>$file</td><td><a href=".'/UserFiles/'.substr($dir,2).$file." target='_blank'>Загрузить</a> </td><td>$insert</td><td>$sel</td></tr>";
	                    }
	                  elseif($file!="." && $file!="..")
	                   {
	                     $i++;
                         ($i%2)? $color="#CFCFCF" : $color='#F9F9F9';
	                     $text.="<tr bgcolor=$color align='center'><td align='left'>$file</td><td><a href='?mod=files&action=brows&cat=$file'> Передти </a>
                          </td><td>
                          [<a href=# onclick=\"if (confirm('Вы желаете удалить: \\n $file')) location.href='?mod=files&action=del&c=$file' ;else return false;\">Удалить</a>]
                          </td><td>&nbsp;</td></tr>";
	                   }
	                }
	            $text.= "</table>";
   return $text;

}
// проверяет коректность имени каталога

function valid_name_dir()
{
$name=$_POST['namedir'];
  	$name=trim($name);
	if (preg_match("/^[A-Za-z_0-9]+$/i", $name)==0) return 0;
	else return 1;
}

// удаляет файлы и паки
function delet_file($flag='')
{
  $a=0;

  switch($flag)
  {
    case 'file':
     if (!empty($_GET['f']) &&  basename(trim($_GET['f']))!='.' && basename(trim($_GET['f']))!='..')
     {
       $file=basename(trim($_GET['f']));
 	      if (!file_exists('../UserFiles/'.substr($_SESSION['dir'],2).$file))
	       {
    	      $_SESSION['dir']='./';
	          return 0;
	       }


     @   $a = unlink('../UserFiles/'.substr($_SESSION['dir'],2).$file);
     }


    return $a;
    break;
    case 'dir';

      if (!empty($_GET['c']))// &&  basename(trim($_GET['p']))!='.' && basename(trim($_GET['p']))!='..')
      {
           $file=basename(trim($_GET['c']));
        if (!file_exists('../UserFiles/'.substr($_SESSION['dir'],2).$file))
         {
           $_SESSION['dir']='./';
           return 0;
         }
       @     $a =  rmdir('../UserFiles/'.substr($_SESSION['dir'],2).$file);

      }
    return $a;
    break;

  }

 // return 0;
}


function upload_file()
{

    if (is_uploaded_file(preg_replace('[\s+]', '_', $_FILES["yourfile"]["tmp_name"] )))
	{

	$type=$_FILES['yourfile']['type'];

            $_FILES["yourfile"]["tmp_name"] = preg_replace('[\s+]', '_', $_FILES["yourfile"]["tmp_name"]);
            $_FILES["yourfile"]["name"] = basename(preg_replace('[\s+]', '_', $_FILES["yourfile"]["name"]));
            //echo substr($_SESSION['dir'],2).$_FILES["yourfile"]["name"];
            $res = move_uploaded_file($_FILES["yourfile"]["tmp_name"], '../UserFiles/'.substr($_SESSION['dir'],2).$_FILES["yourfile"]["name"]);
            chmod('../UserFiles/'.substr($_SESSION['dir'],2).$_FILES["yourfile"]["name"], 0777);
           if ($res)  return 1;
           else       return 0;
	}
    else
    {
      return 0;
    }




}








//echo brows_img();
function brows_img()
{

$i=0;
define ("DIR", "../UserFiles/");

     $imgdir=opendir(DIR);

      $text= '<br><br> Путь к Картинкам  /UserFiles/"Имя_Рисунка" <center><h1>Список файлов</h1><table border=0 width="80%"><tr><td colspan=3><b>Имя файла</b></td></tr>';
        while ($file=readdir($imgdir))
	       {
	          if (!is_dir($file)&&$file!="banner")
	            {
                  $i++;
                   ($i%2)? $color="#CFCFCF" : $color='#F9F9F9';
        $insert="<a href=# onclick=\"window.opener.document.forms.f1('address').value='/UserFiles/$file';window.self.close();\">[выбрать]</a>";
                  $text.= "<tr bgcolor=$color align='center'><td align='left'>$file</td><td><a href=".DIR.$file."> Просмотр  </a> </td><td>$insert</td></tr>";
	            }
            }
        $text.= "</table>";

  return $text;
}

?>



