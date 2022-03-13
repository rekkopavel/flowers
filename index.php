<?
 include "lib_fnc.php";
echo "test";
 // ��������� ����� ������
 session_start();
 session_register("secret_number");

if (intval($_SESSION["secret_number"])<1000) {
    srand(time());
    $_SESSION["secret_number"]=rand(1000,9999);
}
 // ������ � ����������� �������
 
 // ������� ������������ ������
 $time=mktime();
 $query=sql_placeholder('delete from  `'.TEMP.'`  where `delet_time`<?', $time);
 mysql_query($query) or  die (mysql_error(). " � ������  ". __LINE__ . " ���� ". __FILE__. "<BR>");
 $time=mktime()+STIME;
  $nid=(empty($_GET['nid']))?1:(int)$_GET['nid'];
  $cook=(empty($_COOKIE["nid"]))?0:(int)$_COOKIE["nid"];
$_SESSION['username'] = session_id();

if (($nid==$cook)&&empty($_GET['flag'])){
  $query=sql_placeholder('
  	select parent_id   from ?#CATALOG  where id=? ', $nid);
	 //echo $query;
	$result=mysql_query($query) or  die (mysql_error(). " � ������  ". __LINE__ . " ���� ". __FILE__. "<BR>");
	$nid=mysql_result($result,0);
};
setcookie("nid",$nid);

if(!empty($_GET['poz_id'])&&($_GET['add']==1)){
$query=sql_placeholder('
  	select count(*) as cnt  from ?#TEMP  where poz_id=? and user_id=?', $poz_id, $_SESSION['username']);
    $result=select_row($query);
	
	if(!$result)
	{
	$query=sql_placeholder('insert into ?#TEMP (`user_id`, `poz_id`,`delet_time`)
             values(?,?,?)', $_SESSION['username'], $_GET['poz_id'],$time);
			   mysql_query($query) or  die (mysql_error(). " � ������  ". __LINE__ . " ���� ". __FILE__. "<BR>");
			   if(!empty($_GET['type'])){header('Location: ?action=magaz&type='.$_GET['type'].'&page='.$_GET['page']);}else
			   {header('Location: ?action=magaz&mod=full&poz_id='.$_GET['poz_id']);};
			  
             	 	exit;
	}

};


 //������������ ����������
 $posted = (empty($_POST['posted']))?'':(int)$_POST['posted'];
 $register = (empty($_POST['register']))?'':(int)$_POST['register'];
 $login = (empty($_POST['log_posted']))?'':(int)$_POST['log_posted'];

 
 $sid=(empty($_GET['sid']))?0:(int)$_GET['sid'];
 $id=(empty($_GET['id']))?1:(int)$_GET['id'];
 $rand=(empty($_GET['rand']))?0:(int)$_GET['rand'];
 $onas=(empty($_GET['onas']))?0:(int)$_GET['onas'];
 $mod=(empty($_GET['mod']))?'':$_GET['mod'];
 $mader=(empty($_GET['mader']))?0:(int)$_GET['mader'];
 $type=(empty($_GET['type']))?0:(int)$_GET['type'];
 
 $checkSum = (empty($_GET['checkSum']))?'':$_GET['checkSum'];
 $_GET['search']=(empty($_GET['search']))?'':$_GET['search'];
 $err = '';
 $content='';
 $row=array();
 $arr_tpl=array('search'=>'');
 
$parent_menu= array_reverse (_list_parent_id($id));
   $parent_menu  =array_merge( (array)$parent_menu, (array)$id);
 //��������� ���������
 //$tpl=($id==1 && $action!='magaz')?load_tpl_var('index.tpl'):load_tpl_var('maket.tpl');
   $tpl=($action!='magaz')?load_tpl_var('index.tpl'):load_tpl_var('maket.tpl');
   if($onas==1) {$tpl=load_tpl_var('maket.tpl');};
   if(in_array(238,$parent_menu)) {$tpl=load_tpl_var('maket.tpl');};
   $tpl_top_menu=pars_reg($tpl, "TOP_MENU");
   $tpl_buttom_menu=pars_reg($tpl, "BUTTOM_MENU");
   $tpl_main=pars_reg($tpl, "MAIN");
   $tpl_content_menu=pars_reg($tpl, "CONTENT_MENU");
   $tpl_path=pars_reg($tpl, "PATH");
   $tpl_sub_menu=pars_reg($tpl, "SUB_MENU");
   $tpl_page_menu=pars_reg($tpl, "PAGE_MENU");
   $tpl_pozition=pars_reg($tpl, "POZITION");
   $tpl_full=pars_reg($tpl, "FULL");
   $tpl_full_img2=pars_reg($tpl, "FULL_IMG2");
   $tpl_big=pars_reg($tpl, "BIG");
   $tpl_basket=load_tpl_var('basket.tpl');
   $tpl_basket_p=load_tpl_var('basket_p.tpl');
   $tpl_cat_menu1=pars_reg($tpl, "CAT_MENU1");
   $tpl_cat_menu2=pars_reg($tpl, "CAT_MENU2");
   
   $tpl_news_short=pars_reg($tpl, 'NEWS');
   $tpl_news_full=pars_reg($tpl, 'NEWS2');
   $tpl_news_last=pars_reg($tpl, 'NEWS_LAST');
   
   $tpl_otz=pars_reg($tpl, 'OTZ');
   $tpl_reg=pars_reg($tpl, 'REG');
   $tpl_log_on=pars_reg($tpl, 'LOG_ON');
   $tpl_log_off=pars_reg($tpl, 'LOG_OFF');
   $mail=pars_reg($tpl, 'MAIL');
   
   $arr_tpl['PATH']='';
  
  // ���������� �������� �����������
  // ������� ������������ ������
 $time=mktime();
 $query=sql_placeholder('delete from  `'.USER_SESSION.'`  where `delet_time`<?', $time);
 mysql_query($query) or  die (mysql_error(). " � ������  ". __LINE__ . " ���� ". __FILE__. "<BR>");
// ��������� �������� �� ����

 if (empty($_COOKIE['id_user']))
 {
 $arr_tpl['REG_STATUS']=$tpl_log_off;
 }else{
 $temp=array('login'=>$_COOKIE['login']);
 $tpl_log_on=pars($temp, $tpl_log_on);
 
 $arr_tpl['REG_STATUS']=$tpl_log_on;
 }
  
  
  
  
//�������� �� ��������

   switch(TRUE){
   	 default:
 	    $row=_view_page($id);
		if ($type==0){$type=$row['type'];};
		if ($row['mag']==1)
		{$row['content']=$row['content']."<div align='right'><a href='?action=magaz&type=".$type."' style='font-size:15px;'>������� &raquo;</a></div>";}
		
   	 break;
	 case($action=='page' && isset($posted) && $posted!=''):
	 
        	$row=_view_page($id);
			if ((intval($_POST['code'] != intval($_SESSION['secret_number']))) || (intval($_POST["code"]) == 0)) {
             $res = '<br><font color=red>������: �������� ��� �� ��������</font><br>';
             $_SESSION["secret_number"]=rand(1000,9999);
			 $row['content']=$res.$row['content'].$mail;
        }else{
			$res=mail_send();
			$row['content']=$res.$row['content'].$mail;
			
			 }
   	 break;
	  case($action=='page' && $id==1):
	 
        	$row=_view_page($id);
			
   	 break;
	   case($action=='page' && $id==220):
	 
        	$row=_view_page($id);
			
		
			$row['content']=$row['content'].$mail;
			
			
   	 break;
	  case($action=='otz'):
	        $row=list_otz($tpl_otz);
			$row['name'] = '���� ��������';
	        $arr_tpl['title']=$row['name'];
			 $arr_tpl['action']='otz';
			 $arr_tpl['id']=$id;
			
   	 break;
     case($action=='gallery'):
       $photo=(empty($_GET['photo']))?0:(int)$_GET['photo'];

      if ($photo){
       	 echo pars( _view_photo($photo), load_tpl_var('view_photo.tpl'));
		 
       	 exit;
       }

       $row=print_gallery($id, 0);
       if (!$row) {
  	     header('HTTP/1.1 404 Not Found');
  	     exit;
  	    }
		$arr_tpl['title']=$row['name'];
  	break;
	case($action=='subgallery'):
       $photo=(empty($_GET['photo']))?0:(int)$_GET['photo'];

      if ($photo){
       	 echo pars( _view_photo($photo), load_tpl_var('view_photo.tpl'));
		 
       	 exit;
       }

       $row=print_subgallery($sid, 0);
       if (!$row) {
  	     header('HTTP/1.1 404 Not Found');
  	     exit;
  	    }
		$arr_tpl['title']=$row['name'];
  	break;
	case($_GET['search']):
        $row=print_search($_GET['search']);

   	 break;
	 
   	 case($action=='news' && !empty($_GET['nid']) &&  ((int)$_GET['nid'])>0):
            $row=view_news($tpl_news_full,(int)$_GET['nid']);
	        $arr_tpl['title']=$row['name'] . '- ������� ';
            $row['name']=' ������� ';
			 $arr_tpl['action']='news';
			 $arr_tpl['id']=$id;
			
	 break;
   	 case($action=='news'):
	        $row=list_news($tpl_news_short,$id);
	        $arr_tpl['title']=$row['name'];
			 $arr_tpl['action']='news';
			 $arr_tpl['id']=$id;
			
   	 break;
	 case($action=='magaz'&& $mod=='basket'&& (!empty($del))):
	          del_basket($del);
	        $row['content']=view_basket($tpl_basket,$_SESSION['username']);
	        $arr_tpl['title']='�������';
			
   	 break;
	 case($action=='magaz'&& $mod=='basket'&& $act=='print'):
	  $tpl_main='<div align="center"><h3>�����</h3></div> <br>{content}<br><br><SCRIPT Language="Javascript"> 
function printit(){ 
window.print() ; 
} 
</script> 
... 
<div align="center"><form> 
<input TYPE="button" CLASS="for" VALUE="����������� ��������" onClick="printit()"> 
</form></div>';
	        $row['content']=view_basket($tpl_basket_p,$_SESSION['username']);
	        $arr_tpl['title']='������� - ������ ��� ������';
			
   	 break;
	 case($action=='magaz'&& $mod=='basket'):
	        $row['content']=view_basket($tpl_basket,$_SESSION['username']);
	        $arr_tpl['title']='�������';
			
   	 break;
	 case($action=='magaz' && $mod=='full'):
	        $row=view_full_poz($tpl_full,$tpl_full_img2,$poz_id,$type);
	    
			$arr_tpl['PATH']=view_path();
   	 break;
	 case($action=='magaz'&& $mod=='big'):
	        $row['content']=view_big($tpl_big,$poz_id,$_GET['photo']);
			$tpl_main='{content}';
	        $arr_tpl['title']=$row['name'];
			
   	 break;
	 case($action=='magaz'&& $rand==1):
	     $query=sql_placeholder('select * from ?#CATALOG where type=? ', $type);
         $row1=select_row($query);
		 $row=_view_page($row1['id']);
		 $rand_content=rand_photo($tpl_pozition,$type,$mader);
		 $row['content']=$rand_content.$row['content'];
		 
   	 break;
	 case($action=='magaz'):
	        $row=list_poz($tpl_pozition,$type,$mader,$sid);
			
	        $arr_tpl['title']='�������';
			 $arr_tpl['PATH']=view_path();
   	 break;
	 case($action=='map'):
		  $tpl_map="<div style='padding-left:20px'><a href='?action={action}&id={id}'>{name}</a>{sub}</div>";
	       $row['name']='����� �����';
		   $arr_tpl['title']='����� �����';
	       $row['content']=print_tree($tpl_map, 0); // id 
		   $arr_tpl['action']='map';
			 $arr_tpl['id']='null';
			 $arr_tpl['nid']='null';
			 $arr_tpl['search']='null';
   	 break;
	 case($action=='reg' && isset($register)&& $register!=''):
		  $row=_view_page($id);
		  $err=reg_user();
		   $row['content']=$err;
		   
	 break;
	  case($action=='reg' && isset($checkSum)&& $checkSum!=''):
	      $err=appruv_user();
		  $row=_view_page($id);
		  $row['content']=$err; 
   	      
	 break;
     case($action=='reg'):
	 
		  $row=_view_page($id);
		   $row['content']=$tpl_reg; 
   	 break;
	  case($action=='logout'):
	      $err=logout();
		 // $row=_view_page($id);
		   //$row['content']='���� ��� �����!'; 
		    header ('Location: index.php');
   	 break;
	 
	}
    
   //������� ������ ��� joomla
   
   $arr_tpl['TOP_MENU']=print_menu($tpl_top_menu);
  
   $arr_tpl=array_merge($arr_tpl, $row);
   $arr_tpl=array_merge($arr_tpl,  _list_banners($id));
  // $parent_menu= array_reverse (_list_parent_id($id));
 //  $parent_menu  =array_merge( (array)$parent_menu, (array)$id);
   $rid=array_shift($parent_menu);
   $root_menu=_list_menu(0);
   $rid=1;
   foreach($root_menu as $row){
   	 if ($row['id']!=1){
   	 	 $rid=$row['id'];
   	 	 break;
   	 }
   }
   
   if($onas==1){$arr_tpl['CAT_MENU']=print_menu($tpl_page_menu,208);};
   if(in_array(238,$parent_menu)){$arr_tpl['CAT_MENU']=print_menu($tpl_page_menu,238);};
   if ($arr_tpl['CAT_MENU']==''){$arr_tpl['CAT_MENU']=cat_menu($tpl_cat_menu1,$tpl_cat_menu2,$tpl_sub_menu,$type);};
   

 
   
   if ($login==1){
  $text_reg=logging();
  $arr_tpl['content']=$text_reg;
  };
   
  //�������� ������� � ��������
  $query=sql_placeholder('select * from ?#MADER where id=? ', $mader);
  $row=select_row($query);
  $reg=$row['reg'];
  if ($reg==1){
      if (empty($_COOKIE['id_user'])){
	  $arr_tpl['content']='���� ������ �������� ������ ��� ������������������ �������������<br><br>'.$tpl_reg;
	    if ($sid==0){
		             $query=sql_placeholder('select * from ?#MADER where id=?', $mader);
   $row=select_row($query);    
		
		$arr_tpl['content']=$row['description'].$arr_tpl['content'];}
	  
	  }else{ if ($sid==0){
		             $query=sql_placeholder('select * from ?#MADER where id=?', $mader);
   $row=select_row($query);    
		
		$arr_tpl['content']=$row['description'];} }
  };
 
  
   //�����
   $tpl_page=pars($arr_tpl, $tpl_main);
   echo $tpl_page;
   


?>
