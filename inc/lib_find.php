<?php


function _get_search($search){
 		  $search = substr($search, 0, 64);
          $search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);
  	      $good = trim(preg_replace("/\s(\S{1,2})\s/", " ", ereg_replace(" +", "  "," $search ")));
 		  $good = ereg_replace(" +", " ", $good);

 		  $query=sql_placeholder('select count(*) as cnt from ?#CATALOG as c left join ?#CONTENT as t on (c.id=t.id)
   			   	where  	 content	 like  \'%'. str_replace(" ", "%' and content like  '%", $good). '%\'');

           $cnt=select_row($query);

          $query=sql_placeholder('select c.name, c.id from ?#CATALOG as c left join ?#CONTENT as t on (c.id=t.id)
   			   	where  content	 like  \'%'. str_replace(" ", "%' and content like  '%", $good). '%\' limit  ?,? ' ,
	  				 ($_GET['page']-1)*LIMIT_PAGE, LIMIT_PAGE);
         $result=mysql_query($query) or (db_error($query."\n\n".mysql_error().'\n\n'.__LINE__.' '.__FILE__));
         while($row=mysql_fetch_assoc($result)){
         }

   return array($r, $cnt);
}



function  print_search($search){
     	'name'=>'', 'content'=>'',
     	'search'=>$search,
     	);

     $list_page='';
     $arr=_get_search($search);

 	$r['title']='�� ������� '.$search.' ������� '.$arr[1].' �������';

    if ($arr[1]==0){
      return $r;
    }


    if ($arr[1]>LIMIT_PAGE){
     for($i=1;$i<=ceil($arr[1]/LIMIT_PAGE);$i++){
      }
    }


     foreach($arr[0] as $row){
     }
      $r['content']= $list_page.$r['content']. $list_page;


    return $r;
}


?>