<?
  include "lib_mainpage.php" ;
  $cid=(!empty($_GET['cid']) && is_numeric($_GET['cid']) && $_GET['cid']>0 )?$_GET['cid']:0;
  switch(TRUE)
  {
   default:
     $content=viewpage($cid);
   break;
   case ($action=='addpage'):
      $content=addpage();
   break;
   case ($action=='delpage'):
      $content=delpage($cid);
   break;
   case ($action=='editpage'):
      $content=addcatalog();
   break;
   }


?>