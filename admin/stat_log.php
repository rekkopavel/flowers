<?


       $tpl=file_get_contents('log_visit.tpl');
chdir('../');
include "../libsmi/lib_fnc.php";
//include "_auth.php";


/*
$query='delete from log_visit where ut<"'.(mktime()-60*60*24*7).'"';
$result=mysql_query($query)
        or die (mysql_error()."<hr> line ".__LINE__.' file ' .__FILE__.'<hr> '. $query.'<hr>');
 */

if (empty($_POST['query']))
$query='select *, ut as t , from_unixtime(ut, "%H:%i:%s  %d-%m-%Y") as ut from log_visit order by t desc limit 20';
else
$query=stripslashes($_POST['query']);


$result=mysql_query($query)
        or die (mysql_error()."<hr> line ".__LINE__.' file ' .__FILE__.'<hr> '. $query.'<hr>');


$tpltr=pars_reg($tpl, 'TR');
$text='';
$i=0;

  while($row=mysql_fetch_assoc($result))
  {
    $i++;
    $row['color']=($i%2)?'ffffff':'f0f0f0';

    $row['query_string']= sub_td($row['query_string']);
    $row['request_uri']= sub_td($row['request_uri']);
    /*
    echo "<pre>";
    print_r($row);
    echo "</pre>";
    */
    $text.=pars($row,$tpltr);

  }

 $text=str_replace($tpltr, $text, $tpl);
 $text=str_replace('{QUERY}', $query, $text);

 echo $text;

function  sub_td($str)
{
    $str_bak=$str;

    $len=strlen($str);
    $lenstr=30;
    $n=floor($len/$lenstr);
    if ($n!=0)
    {
        $str='';
    for ($i=0;$i<$n;$i++)
    {
       $start=$i*$lenstr;
       $end=$i*$lenstr+$lenstr;
       $str.="<br>".substr($str_bak,$start, $lenstr );
    }
      $str.="<br>".substr($str_bak,$start+$lenstr);
    }
   $str="<a href=$str_bak target=_blank>$str</a>";
   return $str;

}

?>