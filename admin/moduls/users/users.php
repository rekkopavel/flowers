<?
    include "lib_users.php";
    $action=(empty($_GET['action']))?'':$_GET['action'];


    switch(TRUE)
    {

      default:
        $content=load_tpl_var('cms_admin/users/mainmenu.tpl');
      break;
      ////////// Управление группми ////////////////////////////////
      case ($action=='viewgroup'):
       $content=viewgroup();
      break;
      case ($action=='g2u'):
       $content=viewg2u($_GET['gid']);
      break;
      case ($action=="addgroup"):
       $content=addgroup();
      break;
      case ($action=="addusertogroup"):
       $content=addusertogroup($_GET['gid']);
      break;
      case ($action=="delgroup"):
       $content=delgroup($_GET['gid']);
      break;
      case ($action=="delusertogroup"):
       $content=delusertogroup($_GET['id'], $_GET['gid']);
      break;
     /* case ($action=="accesstogroup"):
       $content=accesstogroup($_GET['gid']) ;
      break;
      */
      case ($action=="editgroup"):
       $content=editgroup($_GET['gid']) ;
      break;

      /////////////// Блок управления пользователями /////////////////

      case ($action=="adduser"):
       $content=adduser();
      break;
      case ($action=="viewuser"):
       $content=viewuser();
      break;
      break;
      case ($action=="deluser"):
       $content=deluser($_GET['id']);
      break;
      case ($action=="edituser"):
       $content=edituser($_GET['id']);
      break;



    }



?>