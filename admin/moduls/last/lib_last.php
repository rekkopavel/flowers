<?




function listphoto(){
        $text='';
        $tpl=load_tpl_var('/cms_admin/last/listphoto.tpl');
    $tpl_main=pars_reg($tpl, "MAIN");
    $tpl_tr=pars_reg($tpl, "TR");
        $query=sql_placeholder('select * from ?#RANDOM');
    $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
    while($row=mysql_fetch_assoc($result)){
      $row=stripslashes_array($row);
	   $type=$row['type'];
   if ($type=="image/gif"){ $imgtype="gif";}else{ $imgtype="jpg";};
   $row['type']=$imgtype;
      $text.=pars($row,$tpl_tr);

    }


     $row=array('TR'=>$text, 'pid'=>$row['id']);
     $text=pars($row, $tpl_main);
     return $text;
}


function addphoto(){
   $dir=''.DIR_LAST;
   $text='';
   if (empty($_POST)){
           $text=pars(array( 'alt'=>''),load_tpl_var('cms_admin/random/from_photo.tpl'));

   }
   elseif(empty($_FILES['photo']['name'])){
         $text.='Вы не выбрали фото <br> <a href=# onclick="history.back();">Назад</a> ';
   } else{
       
    $type =$_FILES['photo']['type'];
       $query=sql_placeholder('insert into ?#RANDOM( `alt`, `type`)
                               values(?,?)
                               ', $_POST['alt'],$type);

      
	  
     
      mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);
     
      $fid=mysql_insert_id();
	  
	  if ($type=="image/gif"){ $filename=$fid.".gif";}else{$filename=$fid.".jpg";};
      
      $err=upload_jpg('photo', $filename, $dir);
      if ($err==-1){
          $text.='Файл имеет неверный формат <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }elseif ($err<1){
          $text.='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      }

      // resize_image(450, 320,  $dir.$filename, $dir."_".$filename );
       //resize_image(150, 100,  $dir.$filename, $dir."__".$filename );

    $text='<a href="?mod=random">Назад</a>';
   }

   return $text;
}




function delphoto($pid){
  $text='';
  $query=sql_placeholder('select * from ?#RANDOM where pid=?', $pid);
  $row=select_row($query);
  $type=$row['type'];
   if ($type=="image/gif"){ $imgtype=".gif";}else{ $imgtype=".jpg";};
  if (!$row) {
          header('Location: index.php');
          exit;
  }
   $dir=''.DIR_GALLERY.$row['pid']."/";
   @   unlink($dir.$pid.$imgtype);
   @   unlink($dir."_".$pid.$imgtype);
  

   $query=sql_placeholder('delete from ?#RANDOM where pid=?', $pid);
  mysql_query($query) or die (mysql_error().' '.__FILE__ . ' '.__LINE__);

  $text='<A href=?mod=random&action=listphoto>Назад</a>';
  return $text;

}
?>