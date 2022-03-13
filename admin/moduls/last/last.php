<?

  include "lib_last.php" ;



  switch(TRUE)
  { default:
   
      $content=listphoto();
   break;
   case ($action=="addphoto"):
      $content=addphoto();
   break;
 
   //case ($action=='delphoto'):
   //   $content=delphoto($_GET['pid']);
   //break;







   }


?>