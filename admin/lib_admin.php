<?
chdir('../');
include "lib_fnc.php";

function menu_modules()
{
   $text="<ul class=\"nav\"><li><a href=index.php>Управление </a><ul>";

   $query=sql_placeholder('
     select m.* from ?#MODUL as m,  ?#GROUP2USER as g2u, ?#CMS_ACCESS as a
     where m.name=a.name
     and a.gid=g2u.group_id
     and g2u.user_id=?  group by m.name
     ', USER_ID);

   $result=mysql_query($query);

   if (mysql_num_rows($result)!=0)
   {

        while($row=mysql_fetch_array($result))
        {
        $text.="<li><a href=?mod=".$row['name'].">".$row['name_menu']."</a></li>";
    }

   }
   $text.="</ul></li></ul>";

   return $text;

}


// функция проверяет уровень пользователя если он равен уровню администратора то возвращает истену


?>