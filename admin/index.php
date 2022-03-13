<?

include "_configcms.php";
include "lib_admin.php";
// устанавливает константу для определения головного скрипта
define("MOD","ok");
// инициализируем переменные
$page_tpl=load_tpl_var('cms_admin/index.tpl');
$main_menu='';
$user_menu='<h2> Добро пожаловать MME admin</h2><br>';
$content='';
$context_menu='';
$title='';


if (isset($_POST['login_cms']) and isset($_POST['password_cms']))
{
   login_in_mme();
}

// проверка авторизованности пользователя и его уровни привелегий

 $query=sql_placeholder('
      select count(*) as cnt from ?#CMS_ACCESS as a, ?#GROUP2USER as g2u
       where g2u.user_id=?
       and g2u.group_id=a.gid
       and a.name="cms"
 	' , USER_ID);

 $count=select_row($query);
if ($count)
{
   $log_on=1;
   $user_menu='';
}
else
{
   $log_on=0;
   $content=pars(array('LOGIN'=>''),load_tpl_var('cms_admin/form_login.tpl'));

}
//
if ($log_on===1)
{
        $main_menu=menu_modules();
                // определяем модуль и подключаем его
                if (!empty($_GET['mod']))
                {

                        $query=sql_placeholder('select * from ?#MODUL where name=?' , $_GET['mod']);
                        $result=mysql_query($query);

                        if (mysql_num_rows($result)===1)
                        {
                         $row=mysql_fetch_array($result);
                         $path="admin/moduls".$row['path'];
                         if (file_exists($path))
                            include_once $path ;
                         else
                           $content="<font color=red><b>Модуль не установлен</b></font>";

                        }
                }

}


$time_end=array_sum(explode(" " , microtime()));
$run_time=round($time_end-$time_start, 6);

$page_tpl=pars(
           array(
              "MENU" =>$main_menu,
              "CONTENT" =>$content,
              "USER_MENU"=>$user_menu,
              "ADMIN_MENU"=>$context_menu,
              "TITLE"=>$title,
              "RUN_TIME"=>$run_time,
           ),$page_tpl);


echo $page_tpl;








?>