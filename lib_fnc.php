<?
  ob_start();
  ob_start("ob_gzhandler", 7);
  include "inc/_config.php";
  require_once  "inc/Placeholder.php";
  require_once  "inc/lib_base.php";
  require_once  "inc/_auth.php";
  require_once  "inc/core.php";
  require_once  "inc/lib_find.php";


?>