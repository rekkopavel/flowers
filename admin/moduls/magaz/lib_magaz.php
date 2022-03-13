<?


//Функции для каталогов
function viewcatalog($id)
{
   $urledit="?mod=magaz&action=edit{type}&pid=$id&type=";
   $delete="<a href=# onclick=\"if (confirm('Вы желаете удалить: \\n {DNAME}')) location.href='?mod=magaz&action=delcatalog&pid=$id&type={TP}&id={ID}' ;else return false;\">Удалить</a>";
   $tpl=load_tpl_var('/cms_admin/magaz/view_catalog.tpl');
   $tpltr=pars_reg($tpl,"TR");

   $tpl=pars_reg($tpl,"MAIN");
   $text='';
   $i=0;

  $query=sql_placeholder('select * from ?#CATALOG where parent_id=? AND mag=1 order by num ',  $id);
  $result=mysql_query($query);
  while($row=mysql_fetch_assoc($result))
   {

   //      $urledit= pars(array(),$urledit);

           if ($row['action']=='gallery'){
                    $row['TYPE']=pars(array('name'=>'Галлерея','id'=>$row['id']), $tpl_photo )   ;
           }elseif($row['action']=='news'){

                    $row['TYPE']=pars(array('name'=>'Новости','id'=>$row['id']), $tpl_news )   ;
           }else{
             $row['TYPE']='Каталог';
           }

           $row=stripslashes_array($row);
           $row['bgcolor']=($i++%2)?'fffff':'f0f0f0';
        // при замене шаблонов важен порядок вхождения пример {CID} используется 2 раза
        $text.=pars($row, $tpltr);


  
       }


    $query=sql_placeholder('select parent_id from ?#CATALOG where id=?',  $id);
    $pid=select_row($query);
    $pid=($pid)?$pid:0;
    $text=str_replace(array($tpltr,'{PID}','{ID}'), array($text,$pid, $id), $tpl);


    return  $text;


}
function addcateg()
{
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/magaz/categ_form.tpl');
     $row=array('name'=>'', 'content'=>'', 'num'=>'', );
     $text=pars($row,$tpl);
  }
  else
  {
     $catalog=array(
              'name'=>$_POST['name'],
			  
              'num'=>$_POST['num'],
              'parent_id'=>$_GET['cid'],
              'action'=>'page',  
			  'mag'=>1,             );
     $query=sql_placeholder('insert into ?#CATALOG (`name`,`num`,`parent_id`, `action`, `mag`) values(?@)', $catalog );
                 // echo $query."<hr>";
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
     if (isset($_POST['textcontent']))
     {
        $id=mysql_insert_id();
		$query=sql_placeholder('update ?#CATALOG set type=? where id=?', $id, $id);
		 $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        $query=sql_placeholder('insert into ?#CONTENT (`id`, `content`) values(?,?)', $id, $_POST['textcontent']);
        $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
     }
           $text.="<a href=?mod=magaz&cid=".$_GET['cid'].">Назад</a>";
  }


   return $text;
}

function editcateg($id)
{
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/magaz/categ_form.tpl');
     $query=sql_placeholder('
     select c.name, c.num, c.id, c.parent_id as pid, p.content from ?#CATALOG as c left join ?#CONTENT as p on (c.id=p.id)
     where c.id=?
     ', $id);
    //     echo $query."<hr>";
     $text=pars(htmlspecialchars_array(select_row($query)),$tpl);

  }
  else
  {
     $catalog=array('name'=>$_POST['name'], 'num'=>$_POST['num'], );
     $query=sql_placeholder('update ?#CATALOG set ?% where id=?', $catalog, $id);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        $query=sql_placeholder('select count(*) as cnt from ?#CONTENT where id=?', $id);
     if (select_row($query))
       $query=sql_placeholder('update ?#CONTENT set content=? where id=?', $_POST['textcontent'], $id);
     else
       $query=sql_placeholder('insert into ?#CONTENT(`id`,`content`) values(?,?) ', $id, $_POST['textcontent']) ;

     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
     

     $text="<a href=?mod=magaz&cid=".$_GET['pid'].">Назад</a>";
  }

  return $text;
}






function  delcatalog($id){

       $list_pid=showTreeDel(CATALOG , $_GET['id']);
       delete_to_bases(CATALOG, $list_pid, array('parent_id')) ;
       delete_to_bases(CONTENT, $list_pid, array('id') ) ;
       delete_to_bases(CATALOG, $list_pid, array('id')) ;
       delete_to_bases(GALLERY, $list_pid, array('id')) ;
       delete_to_bases(NEWS, $list_pid, array('pid')) ;


       header ('Location: index.php?mod=magaz&cid='.$_GET['pid']);
       exit;
}

//ФУнкции для категорий!!!!

function viewmader($id)
{  

   
   
   $tpl=load_tpl_var('/cms_admin/magaz/view_mader.tpl');
   $tpltr=pars_reg($tpl,"TR");

   $tpl=pars_reg($tpl,"MAIN");
   $text='';
   $i=0;

  $query=sql_placeholder('select * from ?#MADER where list_parent like \'%'.$id.'%\'   order by num ');
  $result=mysql_query($query);
  
  while($row=mysql_fetch_assoc($result))
   {

   

           $row=stripslashes_array($row);
           $row['bgcolor']=($i++%2)?'fffff':'f0f0f0';
        // при замене шаблонов важен порядок вхождения пример {CID} используется 2 раза
		$row['num']=$row['num'];
		$row['action']='page';
		$row['parent_id']=$_GET['cid'];
		$row['type']=$_GET['type'];
        $text.=pars($row, $tpltr);


  
       }


    $query=sql_placeholder('select parent_id from ?#CATALOG where id=?',  $id);
    $pid=select_row($query);
    $pid=($pid)?$pid:0;
    $text=str_replace(array($tpltr,'{PID}','{ID}','{type}'), array($text,$pid, $id,$_GET['type']), $tpl);


    return  $text;


}

function addmader()
{
  $text='';
  $random=(empty($_POST['rand']))?0:(int)$_POST['rand'];
  $regis=(empty($_POST['reg']))?0:(int)$_POST['reg'];
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/magaz/mader_form.tpl');
     $row=array('name'=>'', 'description'=>'' ,'num'=>'','reg'=>'','rand'=>'checked' ,'pid'=>$_GET['cid'], 'type'=>$_GET['type']);
     $text=pars($row,$tpl);
  }
  else
  {
     $catalog=array(
              'name'=>$_POST['name'],
			  'list_parent'=>$_GET['cid'].';',
              'description'=>$_POST['description'],
			  'num'=>$_POST['num'],
			  'reg'=>$regis,
			  'rand'=>$random,
              );
			  
   
     
          $query=sql_placeholder('insert into ?#MADER (`name`,`list_parent`,`description`,`num`,`reg`,`rand`) values(?@)', $catalog );
                 
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        
     $id=mysql_insert_id();
	 $logo='logo-'.$id.'.jpg';
	  $query=sql_placeholder('update ?#MADER set logo=? where id=?', $logo, $id);
                 
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
	 
	 
	 if (!empty($_FILES['banner'])){
               $dir="photos/";
               $res=upload_jpg('banner', $logo, $dir);
			   //echo 'test'.$res;
			 
         }
           $text.="<a href=?mod=magaz&cid=".$_GET['cid']."&type=".$_GET['type'].">Назад</a>";
  }


   return $text;
}
function editmader($id)
{
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/magaz/mader_form.tpl');
     $query=sql_placeholder('select  name, description, num, reg, rand from ?#MADER where id=?', $id);
     $row=select_row($query);
     $row['reg']=($row['reg']==0)?'':'checked';
     $row['rand']=($row['rand']==0)?'':'checked';
	 $row['type']=$_GET['type'];
	 $row['pid']=$_GET['pid'];
     $text=pars(htmlspecialchars_array($row),$tpl);
 
  }
  else
  {

	$random=(empty($_POST['rand']))?0:(int)$_POST['rand'];
  $regis=(empty($_POST['reg']))?0:(int)$_POST['reg'];
     $query=sql_placeholder('update ?#MADER set name=?, description=? , num=? , reg=?, rand=? where id=?', $_POST['name'],$_POST['description'],$_POST['num'],$regis,$random, $id);

	 $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
    
	 $query=sql_placeholder('select  * from ?#MADER where id=?', $id);
	 $row=select_row($query);
	 $logo=$row['logo'];
if (!empty($_FILES['banner'])){
               $dir="photos/";
               $res=upload_jpg('banner', $logo, $dir);
			   //echo 'test'.$res;
			 
         }
     $text="<a href=?mod=magaz&cid=".$_GET['pid']."&type=".$_GET['type'].">Назад</a>";
  }

  return $text;
}
function  delmader($id){
$sql=sql_placeholder('delete from ?#MADER where id=?', $id);
          $err=mysql_query($sql);
$sql=sql_placeholder('delete from ?#POZ where mader=?', $id);
          $err=mysql_query($sql);


       header ('Location: index.php?mod=magaz');
       exit;
}

//Функции для суб категорий!!!!!!!!!
function viewsub($cid)
{  

   
   
   $tpl=load_tpl_var('/cms_admin/magaz/view_sub.tpl');
   $tpltr=pars_reg($tpl,"TR");

   $tpl=pars_reg($tpl,"MAIN");
   $text='';
   $i=0;

  $query=sql_placeholder('select * from ?#SUB where pid=?   order by num ',$cid);
  $result=mysql_query($query);
  
  while($row=mysql_fetch_assoc($result))
   {
         $row=stripslashes_array($row);
           $row['bgcolor']=($i++%2)?'fffff':'f0f0f0';
        // при замене шаблонов важен порядок вхождения пример {CID} используется 2 раза
		$row['num']=$row['num'];
		$row['action']='page';
		$row['сid']=$row['pid'];
		$row['type']=$_GET['type'];
		$row['sid']=$row['sid'];
        $text.=pars($row, $tpltr);


  
       }


   
  
    $pid=$cid;
    $text=str_replace(array($tpltr,'{cid}','{type}'), array($text, $pid, $_GET['type']), $tpl);


    return  $text;


}

function addsub($cid)
{
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/magaz/sub_form.tpl');
     $row=array('name'=>'', 'description'=>'' ,'num'=>'','pid'=>$cid, 'type'=>$_GET['type']);
     $text=pars($row,$tpl);
  }
  else
  {
     $catalog=array(
	           'pid'=>$cid,
              'name'=>$_POST['name'],
			  'type'=>$_POST['type'],
              'description'=>$_POST['description'],
			  'num'=>$_POST['num'],
              );
			  
   
     
          $query=sql_placeholder('insert into ?#SUB (`pid`,`name`,`type`,`description`,`num`) values(?@)', $catalog );
                 
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
        
     $id=mysql_insert_id();
	 $logo='sublogo-'.$id.'.jpg';
	  $query=sql_placeholder('update ?#SUB set logo=? where sid=?', $logo, $id);
                 
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
	 
	 
	 if (!empty($_FILES['banner'])){
               $dir="photos/";
               $res=upload_jpg('banner', $logo, $dir);
			   //echo 'test'.$res;
			 
         }
           $text.="<a href=?mod=magaz&action=sub&cid=".$cid."&type=".$_GET['type'].">Назад</a>";
  }


   return $text;
}
function editsub($sid)
{
  $text='';
  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/magaz/sub_form.tpl');
     $query=sql_placeholder('select  name, description, num from ?#SUB where sid=?', $sid);
    $row=select_row($query);
	$row['type']=$_GET['type'];
	$row['pid']=$_GET['pid'];
	$row['sid']=$_GET['sid'];
     $text=pars(htmlspecialchars_array($row),$tpl);
 
  }
  else
  {

	
     $query=sql_placeholder('update ?#SUB set name=?, description=?, num=? where sid=?', $_POST['name'],$_POST['description'],$_POST['num'], $sid);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
    
	 $query=sql_placeholder('select  * from ?#SUB where sid=?', $sid);
	 $row=select_row($query);
	 $logo=$row['logo'];
if (!empty($_FILES['banner'])){
               $dir="photos/";
               $res=upload_jpg('banner', $logo, $dir);
			   //echo 'test'.$res;
			 
         }
     $text="<a href=?mod=magaz&action=sub&cid=".$_GET['pid']."&type=".$_GET['type'].">Назад</a>";
  }

  return $text;
}
function  delsub($sid,$cid){
$sql=sql_placeholder('delete from ?#SUB where sid=?', $sid);
          $err=mysql_query($sql);
$sql=sql_placeholder('delete from ?#POZ where sid=?', $sid);
          $err=mysql_query($sql);

       header ('Location: ?mod=magaz&action=sub&cid='.$cid.'&type='.$_GET["type"]);
       exit;
}


// ФУнкции для позиций!!!

 function poz_list($cnt, $limit , $url, $page)
{

   $page_list='';
  
   $page_cnt=ceil ($cnt/$limit);
  // постраничный вывод
 if  ($page_cnt<11)
  {
       for($i=1;$i<=$page_cnt;$i++)
       {
          if (($i)==(($page/$limit)-1)) $page_list.=''.$i.' ';
          else $page_list.='<a href='.$url.'&mader='.$_GET['mader'].'&type='.$_GET['type'].'&sid='.$_GET['sid'].'&page='.$i.'>'.$i.'</a> ';
       }
   }
   else
   {
    $page_num=$page;///$limit;
      switch(TRUE)
      {
       case (!$page_num||($page_num)<5):

          for($i=1;$i<=6;$i++)
         {
            if (($i)==($page_num)) $page_list.=''.$i.' ';
            else $page_list.='<a href='.$url.'&cid='.$_GET['cid'].'&type='.$_GET['type'].'&page='.$i.'>'.$i.'</a> ';
         }
        $page_list.='...<a href='.$url.'&cid='.$_GET['cid'].'&type='.$_GET['type'].'&page='.$page_cnt.'>'.$page_cnt.'</a>';
       break;
       case ($page_num==($page_cnt-1)||$page_num>$page_cnt-5):
            $page_list.='<a href='.$url.'&cid='.$_GET['cid'].'&type='.$_GET['type'].'&page=1>1</a>...';
            for($i=($page_cnt-5);$i<=$page_cnt;$i++)
           {
             if (($i)==($page_num)) $page_list.=''.$i.' ';
             else $page_list.='<a  href='.$url.'&cid='.$_GET['cid'].'&type='.$_GET['type'].'&page='.$i.'>'.$i.'</a>';
           }
       break;
       default:
          $page_list.='<a href='.$url.'&cid='.$_GET['cid'].'&type='.$_GET['type'].'&page=1>1</a>...';

             for($i=($page_num-3);$i<=($page_num+4);$i++)
           {
             if (($i)==($page_num)) $page_list.=''.$i.' ';
             else $page_list.='<a href='.$url.'&cid='.$_GET['cid'].'&type='.$_GET['type'].'&page='.$i.'>'.$i.'</a> ';
           }
          $page_list.='...<a href='.$url.'&cid='.$_GET['cid'].'&type='.$_GET['type'].'&page='.$i.'>'.$page_cnt.'</a>';
       break;
      }

   }
   // конец постраничной навигации
 return  $page_list;

}
function viewpoz($type,$mader,$sid)
{
   $urledit="?mod=magaz&action=editpoz&poz_id=$id";
   $delete="<a href=# onclick=\"if (confirm('Вы желаете удалить: \\n {DNAME}')) location.href='?mod=magaz&action=delpoz&poz_id=$id' ;else return false;\">Удалить</a>";
   $tpl=load_tpl_var('/cms_admin/magaz/view_poz.tpl');
   $tpltr=pars_reg($tpl,"TR");
   $url='?mod=magaz&action=poz';
   $tpl=pars_reg($tpl,"MAIN");
   $text='';
   $i=0;
$query=sql_placeholder('select count(*)  from ?#POZ where type=? and mader=? and sid=?',$type,$mader,$sid);
$cnt=select_row($query);

$query=sql_placeholder('select * from ?#POZ where type=? and mader=? and sid=? order by num desc limit  ?,? ', $type,$mader,$sid,($_GET['page']-1)*LIMIT_PAGE, LIMIT_PAGE);
 //echo $query;
  $result=mysql_query($query);
   while($row=mysql_fetch_assoc($result))
   {


         

           $row=stripslashes_array($row);
		   $row['name']=strtr($row['name'], '"', ' ');
		   $row['name']=strtr($row['name'], "'", " ");
           $row['bgcolor']=($i++%2)?'fffff':'f0f0f0';
		  $row1=$row;
        // при замене шаблонов важен порядок вхождения пример {CID} используется 2 раза
        $text.=pars($row, $tpltr);


  
       }


    
    $text=str_replace(array($tpltr,'{sub_id}','{mader}','{type}'), array($text,$sid,$mader,$type), $tpl);
	
	//echo $row['type'].'rrrr';
	$row1['page']=$_GET['page'];
$text=pars($row1, $text);

if ($cnt>LIMIT_PAGE){
	
	$text.='<br><div style="clear: both;">&nbsp;</div>';
	
				
$text.=poz_list($cnt, LIMIT_PAGE, $url,$_GET['page']);
	$text='<div align="center">'.$text.'</div>';
	}

    return  $text;


}

function editpoz($poz_id)
{
  $text='';
   $query=sql_placeholder('
     select  * from ?#POZ   
     where poz_id=?
     ', $poz_id);
	  $row=select_row($query);

    
	 if (empty($row['photo1'])){$row['name1']="Фото не загружено";}else {$row['name1']=$row['name'];};



$query=sql_placeholder('select * from ?#MADER where id=? ', $row['mader']);

	  

	  $row2=select_row($query);
	   
	  $row['maderp']=$row2['name'];
	$query=sql_placeholder('select * from ?#CATALOG where type=? ', $_GET['type']); 
	$row3=select_row($query);
	$row['typep']=$row3['name'];
	  $logo=$row2['logo'];
	    if($row2['logo']!=''){$row['maderp'].='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../photos/'.$logo.'"  width="100" border="0">';}; 

  if (empty($_POST['name']))
  {
     $tpl=load_tpl_var('/cms_admin/magaz/poz_form.tpl');
     
     $text=pars($row,$tpl);
	 
  }
  else
  {
  $str=$_FILES['photo']['name'];
  $str = str_replace(array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ъ', 'ы', 'э', 'ю', 'я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
  $str = str_replace(array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ъ', 'Ы', 'Э', 'Ю', 'Я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
  $_FILES['photo']['name']=$str;
  $str=$_FILES['photo1']['name'];
  $str = str_replace(array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ъ', 'ы', 'э', 'ю', 'я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
  $str = str_replace(array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ъ', 'Ы', 'Э', 'Ю', 'Я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
  $_FILES['photo1']['name']=$str;
  $catalog=array(
              'name'=>$_POST['name'],
			  'year'=>$_POST['year'],
			  'color'=>$_POST['color'],
              'artikul'=>$_POST['artikul'],
			   'price'=>$_POST['price'],
			  'description'=>$_POST['description'],
			  'num'=>$_POST['num'],
			  'photo'=>(empty($_FILES['photo']['name']))?$_POST['photo']:$_FILES['photo']['name'],
			  'photo1'=>(empty($_FILES['photo1']['name']))?$_POST['photo1']:$_FILES['photo1']['name'],
                       );
	
    $query=sql_placeholder('update ?#POZ set ?% where poz_id=?', $catalog, $poz_id);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
           

   $dir='photos/'.$_POST["type"].'/'.$_POST["mader"].'/'.$_POST["sid"].'/';
		
		   if (!file_exists('photos/'.$_POST["type"])) {
               mkdir('photos/'.$_POST["type"], 0700);
              };
	       if (!file_exists('photos/'.$_POST["type"].'/'.$_POST["mader"])) {
               mkdir('photos/'.$_POST["type"].'/'.$_POST["mader"], 0700);
              };
          if (!file_exists($dir)) {
              mkdir($dir, 0700);
             };
	
	  if(!empty($_FILES['photo']['name']))
         {
   
   
    $filename=$_FILES['photo']['name'];
	
	$err=upload_jpg('photo', $filename, $dir);
	
	//$err2=upload_jpg('bigphoto', $filename, $dir2);
	
	if ($err==-1){
	  
          $text.='Файл не *.jpg <br> <a href=# onclick="history.back();">Назад</a> ';
		  
		  
          return $text;
      };
	  if ($err==-2){
	   
          $text.='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      };

       
	    };
	 

if(!empty($_FILES['photo1']['name'])){
$filename=$_FILES['photo1']['name'];
echo $filename;
echo $dir;
$err2=upload_jpg('photo1', $filename, $dir);
if ($err==-1){
	  
          $text.='2 файл не *.jpg <br> <a href=# onclick="history.back();">Назад</a> ';
		  
		  
          return $text;
      };
	  if ($err==-2){
	   
          $text.='Возникла ошибка сервера при добавлении 2 картинки <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
      };

       
	    

};
	 
	 
	 
	 
     $text.="Изменения сохранены <br><a href=?mod=magaz&action=poz&mader=".$_POST['mader']."&type=".$_POST['type']."&sid=".$_POST['sid'].">Вернутся к списку позиций</a><br><a href=?mod=magaz&action=editpoz&mader=".$_POST['mader']."&type=".$_POST['type']."&poz_id=".$poz_id.">Вернутся к редактированию</a>";
           
  }


   return $text;
    

  }
  


function addpoz($type,$mader,$sid)
{
  if (empty($_POST['name']))
  {
    $row=array('name'=>'' ,'artikul'=>'', 'price'=>'','description'=>'','num'=>'','mader'=>$mader,'type'=>$type,'sid'=>$sid );
    $text='';
    $cat='';  
    $query=sql_placeholder('select * from ?#MADER where id=? ', $mader);
    $row2=select_row($query);
	$row['maderp']=$row2['name'];
	$query=sql_placeholder('select * from ?#CATALOG where type=? ', $_GET['type']); 
	$row3=select_row($query);
	$row['typep']=$row3['name'];
	$logo=$row2['logo'];
	if($row2['logo']!=''){$row['maderp'].='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../photos/'.$logo.'"  width="100" border="0">';}; 
   
    $tpl=load_tpl_var('/cms_admin/magaz/add_poz_form.tpl');
    $text=pars($row,$tpl);
  }
  else
  {
    $str=$_FILES['photo']['name'];
    $str = str_replace(array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ъ', 'ы', 'э', 'ю', 'я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
    $str = str_replace(array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ъ', 'Ы', 'Э', 'Ю', 'Я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
    $_FILES['photo']['name']=$str;
    $str=$_FILES['photo1']['name'];
    $str = str_replace(array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ъ', 'ы', 'э', 'ю', 'я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
    $str = str_replace(array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ъ', 'Ы', 'Э', 'Ю', 'Я'), array('a', 'b', 'v', 'g', 'd', 'e', 'jo', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'c', 'ch', 'sh', 'sch', 'j', 'j', 'y', 'e', 'y', 'ja'), $str);
    $_FILES['photo1']['name']=$str;
	
    $catalog=array(
              'name'=>$_POST['name'],
              'artikul'=>$_POST['artikul'],
			  'price'=>$_POST['price'],
			  'type'=>$_POST['type'],
			  'mader'=>$_POST['mader'],
			  'sid'=>$_POST['sid'],
			  'description'=>$_POST['description'],
			  'num'=>$_POST['num'],
			  'photo'=>$_FILES['photo']['name'],
			  'photo1'=>$_FILES['photo1']['name'],
                       );
					  
     $query=sql_placeholder('insert into ?#POZ (`name`,`artikul`, `price`,`type`,`mader`,`sid`,`description`,`num`,`photo`,`photo1`) values(?@)', $catalog );
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");
	 $fid=mysql_insert_id();
	     $dir='photos/'.$_POST["type"].'/'.$_POST["mader"].'/'.$_POST["sid"].'/';
		
		   if (!file_exists('photos/'.$_POST["type"])) {
               mkdir('photos/'.$_POST["type"], 0700);
              };
	       if (!file_exists('photos/'.$_POST["type"].'/'.$_POST["mader"])) {
               mkdir('photos/'.$_POST["type"].'/'.$_POST["mader"], 0700);
              };
          if (!file_exists($dir)) {
              mkdir($dir, 0700);
             };
	  
	      if(empty($_FILES['photo']['name'])){
            $text.='Вы не выбрали фото <br> <a href=# onclick="history.back();">Назад</a> ';
		    $sql=sql_placeholder('delete from ?#POZ where poz_id=?', $fid);
            $err=mysql_query($sql);
            } else{
            $filename=$_FILES['photo']['name'];
	        $err=upload_jpg('photo', $filename, $dir);
            if ($err==-1){
	           $sql=sql_placeholder('delete from ?#POZ where poz_id=?', $fid);
               $err=mysql_query($sql);
               $text.='Файл не *.jpg <br> <a href=# onclick="history.back();">Назад</a> ';
		       return $text;
            }elseif ($err==-2){
	           $sql=sql_placeholder('delete from ?#POZ where poz_id=?', $fid);
               $err=mysql_query($sql);
               $text.='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';
               return $text;
            }
	     }
	 
        if(!empty($_FILES['photo1']['name'])){
          $filename=$_FILES['photo1']['name'];
          $err2=upload_jpg('photo1', $filename, $dir);
          if ($err==-1){
	      $text.='2 файл не *.jpg <br> <a href=# onclick="history.back();">Назад</a> ';
		  return $text;
          };
	      if ($err==-2){
	      $text.='Возникла ошибка сервера при добавлении 2 картинки <br> <a href=# onclick="history.back();">Назад</a> ';
          return $text;
          }
       }
	   
	   $text.="Запись добавлена<br><br><a href=?mod=magaz&action=poz&mader=".$_POST['mader']."&type=".$_POST['type']."&sid=".$_POST['sid'].">Вернутся к списку позиций</a>";
   }
   return $text;
}

function delpoz($id,$mader,$type,$sid){




	$query=sql_placeholder('
     select  * from ?#POZ   
     where poz_id=?
     ', $id);
	  $row=select_row($query);
	  $name1=$row['photo'];
	$name2=$row['photo1'];
	
	$year=$row['year'];
	  $dir='photos/'.$mader.'/'.$type.'/'.$year.'/';
  $filename=$dir.$name1;
  
 
 unlink($filename);
$filename=$dir.$name2;
 unlink($filename);
 echo $filename;
  
     



		
          $sql=sql_placeholder('delete from ?#POZ where poz_id=?', $id);
         $err=mysql_query($sql);
          if ($err==1){
		 
		  header ('Location: index.php?mod=magaz&action=poz&mader='.$mader.'&type='.$type.'&sid='.$sid);
       exit;
		  
		  
		  
		  }else {return'Неудачно';};

		

	



  }
  
 //Дополнитьельные функции
 
 $list_id=array();
  function showTreeDel($table , $id)
  {
      global $list_id ;
      array_push ($list_id ,$id);
      $query=sql_placeholder('select id  from `'.$table.'` where parent_id=?' , $id);

      $result=mysql_query($query) or  die (mysql_error(). " T ёЄЁюъх  ". __LINE__ . " Lрщы ". __FILE__. "<br>");
      while ($row=mysql_fetch_assoc($result))  {
        showTreeDel($table,$row['id']);
     }
      return $list_id;

  } 
  
  
  function viewimport($type,$mader)
{

 
  
 $text='';
  if (empty($_FILES['csv']['name']))
  {
       $tpl=load_tpl_var('/cms_admin/magaz/import.tpl');
   $row=array(
              'type'=>$type,
			  'mader'=>$mader,
			 );
	
     $text=pars($row,$tpl);
  }
  else
  {
  $myfile = $_FILES["csv"]["tmp_name"];
  $myfile_size = $_FILES["csv"]["size"];
  $myfile_type = $_FILES["csv"]["type"];
  $error_flag = $_FILES["csv"]["error"];
  if($error_flag == 0)
        {
		$fl = 0;
           
          $res = move_uploaded_file($_FILES["csv"]["tmp_name"],"UserFiles/import/1.csv");
		 
		  if($res==1 &&$myfile_type=="text/comma-separated-values" ){
		 //$text.=$res.$myfile_type;
			$handle = fopen("UserFiles/import/1.csv", "r");
			while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) {
    $num = count($data);
   
    $fl++;
    
	$catalog=array(
              'name'=>$data[0],
              'artikul'=>$data[1],
			   'price'=>$data[3],
			   'type'=>$_POST['type'],
			  'mader'=>$_POST['mader'],
			  'description'=>$data[2],
			  );
			 
       if($fl > 1) {$query=sql_placeholder('insert into ?#POZ (`name`,`artikul`, `price`,`type`,`mader`,`description`) values(?@)', $catalog );
               
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");}
    
}
fclose($handle);
			
			       $text.="Файл импортирован <br><a href=?mod=magaz&action=poz&cid=".$_POST['mader']."&type=".$_POST['type'].">Категория</a>"; 
				                               }else{ $text='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';};
            
			
		
		}else {  $text='Возникла ошибка сервера <br> <a href=# onclick="history.back();">Назад</a> ';};

    

  
 
  
  };
  


         


    return  $text;


}
function editgroup($type,$mader,$page){
ob_start();
$query=sql_placeholder('select * from ?#POZ where type=? and mader=? order by poz_id desc limit  ?,?', $type,$mader,($_GET['page']-1)*LIMIT_PAGE, LIMIT_PAGE);
$query=sql_placeholder('select * from ?#POZ where type=? and mader=? order by poz_id desc limit  ?,?', $type,$mader,($_GET['page']-1)*LIMIT_PAGE, LIMIT_PAGE);
  $result=mysql_query($query);
   while($row=mysql_fetch_assoc($result)){
    $r[$row['poz_id']]=$row;
  }

$_TPL['POZ']=$r;
$_TPL['MADER']=$_GET['mader'];
$_TPL['TYPE']=$_GET['type'];

 if (empty($_POST['name'])){

	 include "group.tpl";
	 
  }else{
 $mader1=$_GET['mader'];
 $type1=$_GET['type'];
 
  if($_POST['name']){ foreach($_POST['name'] as $pid=>$name){
	  
	  $sql=sql_placeholder('update ?#POZ set name=? where poz_id=?', $name, $pid);
	   mysql_query($sql) or die($sql);
	  };};
 if($_POST['desc']){ foreach($_POST['desc'] as $pid=>$desc){
	  
	  $sql=sql_placeholder('update ?#POZ set description=? where poz_id=?', $desc, $pid);
	   mysql_query($sql) or die($sql);
	  };};
  if($_POST['price']){ foreach($_POST['price'] as $pid=>$price){
	  
	  $sql=sql_placeholder('update ?#POZ set price=? where poz_id=?', $price, $pid);
	   mysql_query($sql) or die($sql);
	  };};
  
   echo "<font color='red'>Записи отредактированы</font><br>";
    echo "<a href='index.php?mod=magaz&action=poz&cid=$mader1&type=$type1'> Перейти в категорию</a>";
    
  };
 
 
 $text=ob_get_contents();
  ob_clean();
return $text;
};

function poz_delete_photo($poz_id,$photo,$mader,$type,$year){
$dir='photos/'.$mader.'/'.$type.'/'.$year.'/';




     
	$query=sql_placeholder('
     select  * from ?#POZ   
     where poz_id=?
     ', $poz_id);
	  $row=select_row($query);
	  $name=$row[$photo];
	$row[$photo]=''; 
	  
$query=sql_placeholder('update ?#POZ set ?% where poz_id=?', $row, $poz_id);
     $result=mysql_query($query) or  die (mysql_error(). " В строке  ". __LINE__ . " Файл ". __FILE__. "<br>");

    	$name = str_replace('%20', ' ', $name);

    	 $filename=$dir.$name;
		 
  unlink($filename);
    	
       header ('Location: index.php?mod=magaz&action=editpoz&poz_id='.$poz_id.'&mader='.$mader.'&type='.$type);
    
       exit;

}

?>
