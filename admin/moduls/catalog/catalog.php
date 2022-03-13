<?

  include "lib_catalog.php" ;

  $cid=(!empty($_GET['cid']) && is_numeric($_GET['cid']) && $_GET['cid']>0 )?$_GET['cid']:0;
  $sid=(!empty($_GET['sid']) && is_numeric($_GET['sid']) && $_GET['sid']>0 )?$_GET['sid']:0;
  switch(TRUE)
  {
   default:
     $content=viewcatalog($cid);
   break;
   case ($action=='addcatalog'):
      $content=addcatalog();
   break;
   case ($action=='addgaller'):
      $content=addgallery();
   break;
   case ($action=="editgallery"):
      $content=editgallery($_GET['id']);
   break;
   case ($action=="editpage"):
      $content=editcatalog($_GET['id']);
   break;
   case ($action=="delcatalog"):
      $content=delcatalog($_GET['id']);
   break;
   case ($action=="listphoto"):
      $content=listphoto($cid);
   break;
   case ($action=="addphoto"):
      $content=addphoto($cid);
   break;
   case ($action=='editphoto'):
      $content=editphoto($_GET['id']);
   break;
   case ($action=='delphoto'):
      $content=delphoto($_GET['id']);
   break;
   // субгалерея
   case ($action=="listsubphoto"):
      $content=listsubphoto($sid);
   break;
   case ($action=="addsubphoto"):
      $content=addsubphoto($cid,$sid);
   break;
   case ($action=='editsubphoto'):
      $content=editsubphoto($_GET['pid'],$_GET['sid'],$_GET['id']);
   break;
   case ($action=='delsubphoto'):
      $content=delsubphoto($_GET['pid'],$_GET['sid'],$_GET['id']);
   break;
   ////////////////////////////////////////////////////////
   //              Новости
   ///////////////////////////////////////////////////////
   case ($action=='addnews_rasdel'):
      $content=addnews_rasdel($cid);
   break;
   case ($action=='addnews'):
      $content=addnews($cid);
   break;
   case ($action=='listnews'):
      $content=list_news_ad($cid);
   break;
   case ($action=='editnews'):
      $content=editnews_rasdel($_GET['id']);
   break;
   case ($action=='edit_news'):
      $content=editnews($_GET['id']);
   break;
   case ($action=='delnews'):
      $content=delnews($_GET['id']);
   break;
   ////////////////////////////////////////////////////////
   //             Отзывы
   ///////////////////////////////////////////////////////
    case ($action=='editotz'):
      $content=editotz_razdel($_GET['id']);
   break;
   case ($action=='addotz'):
      $content=addotz($cid);
   break;
   case ($action=='listotz'):
      $content=list_otz_ad($cid);
   break;
  
   case ($action=='edit_otz'):
      $content=editotz($_GET['id']);
   break;
   case ($action=='delotz'):
      $content=delotz($_GET['id']);
   break;







   }


?>