<?
$time_start=array_sum(explode(' ', microtime()));
//error_reporting (7);

$sql_host='localhost';
  $sql_user='allrealtor';
  $sql_password='qqqqqq';
  $sql_db='allrealtor';


// ����������� ������� ������


define("SESSIONS", "smi_session"); // ������ �������������
define("GROUP", "smi_group");      // ������ ������������
define("GROUP2USER", "smi_group2user");      // ��������� ������������ � ����� � ����� �����
define("USER", "smi_user");      // ������������
define('CATALOG', 'smi_catalog'); // �������
define('CONTENT', 'smi_content'); // ���������� ��������
define('BANNERS', 'smi_banners'); // ������
define('LIMIT_PAGE', 20); // ��������� ������� �� �������� ������
define('LIMIT_POZ', 9); // ��������� ������� �� �������� ��������
define('GALLERY', 'smi_gallery');
define('GPHOTO', 'smi_photo');
define('GPSUBHOTO', 'smi_subphoto');
define('NEWS','smi_news') ;
define('INFO','smi_info') ;
define('SERV','smi_serv') ;
define('OTZ','smi_otz') ;
define('POZ','items') ;
define('MADER','maders') ;
define('TEMP','user_temp') ;
define('REGUS','users') ;
define('USER_SESSION','user_session') ;
define('VALID','validate_temp') ;
define('DIR_GALLERY','UserFiles/gallery/');
define('DIR_CATALOG','catalog');
define('STIME', 60*60*12);
define("GUEST", "guest_message"); 
define("FAQ", "faq"); 
define('RANDOM','smi_random') ;
define('2IP','ip2country') ;
define('SUB','sub_cat') ;
define('DIR_RANDOM','UserFiles/random/');
define('RTIME', 60*60*24*7);


$link = mysql_connect($sql_host, $sql_user, $sql_password)
  or die ("mysql_connect() failed!");
mysql_selectdb($sql_db)
  or die ("mysql_selectdb() failed!");

  $action=(empty($_GET['action']))?'':$_GET['action'];
  $id=(!empty($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>0 )?$_GET['id']:0;

?>
