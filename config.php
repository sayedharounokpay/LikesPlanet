<?php
session_start();
  include("settings.php");
error_reporting(0);
  if(!(@mysql_connect("$host","$user","$pass") && @mysql_select_db("$tablename"))) {
?>
MySQL Error
<?php
    exit;
  }
  include("functions.php");
  
if(isset($_SESSION['login'])){
	$loggedin = mysql_real_escape_string($_SESSION['login']);
    $dbres= mysql_query("SELECT *,UNIX_TIMESTAMP(`online`) AS `online` FROM `users` WHERE `login`='{$loggedin}'");
    $data= mysql_fetch_object($dbres);
  }

$siteme = mysql_fetch_object(mysql_query("SELECT * FROM settings"));
$sitesta = mysql_fetch_object(mysql_query("SELECT * FROM `sitestat` WHERE `id` = '4' "));

$coinsdollar=5000;
$referralrate=2;

?>

