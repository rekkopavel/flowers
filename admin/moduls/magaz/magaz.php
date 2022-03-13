<?

  include "lib_magaz.php" ;

  $cid=(!empty($_GET['cid']) && is_numeric($_GET['cid']) && $_GET['cid']>0 )?$_GET['cid']:0;

  switch(TRUE)
  {
   default:
     $content=viewcatalog($cid);
   break;
   //------------------------------------
  
   case ($action=='addcatalog' && $_GET['cid']==0):
      $content=addcateg();
   break;
   case ($action=="editpage" && $_GET['pid']==0):
      $content=editcateg($_GET['id']);
   break;
   case ($action=="delcatalog"  && $_GET['pid']==0):
      $content=delcatalog($_GET['id']);
   break;
   //------------------------------------------------
   case ($action=='' && $_GET['cid']!=0 ):
  $content=viewmader($cid);
  break;
  case ($action=='addcatalog'):
      $content=addmader();
   break;
   case ($action=="editpage"):
      $content=editmader($_GET['id']);
   break;
   case ($action=="delmader"):
      $content=delmader($_GET['id']);
   break;
   
 //-------------------------------------------------------------
    case ($action=='sub' ):
  $content=viewsub($cid);
  break;
  case ($action=='addsub'):
      $content=addsub($mader);
   break;
   case ($action=="editsub"):
      $content=editsub($sid);
   break;
   case ($action=="delsub"):
      $content=delsub($_GET['sid'],$cid);
   break;
   
 //-------------------------------------------------------------
   case ($action=="poz"):
      $content=viewpoz($_GET['type'],$_GET['mader'],$_GET['sid']);
	   break;
  case ($action=='addpoz'):
      $content=addpoz($_GET['type'],$_GET['mader'],$_GET['sid']);
   break;
   case ($action=="editpoz"):
      $content=editpoz($_GET['poz_id']);
   break;
   case ($action=="delpoz"):
      $content=delpoz($_GET['poz_id'],$_GET['cid'],$_GET['type'],$_GET['sid']);
   break;
   case ($action=="delpozphoto"):
      $content=poz_delete_photo($_GET['poz_id'],$_GET['photo'],$_GET['mader'],$_GET['type'],$_GET['year']);
   break;
	  
//----------------------------------------------------------------
 
   case ($action=="import"):
      $content=viewimport($_GET['type'],$_GET['mader']);
  break;
   case ($action=="editgroup"):
      $content=editgroup($_GET['type'],$_GET['mader'],$_GET['page']);
   break;
	   }


?>