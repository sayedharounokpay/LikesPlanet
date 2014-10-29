<?
include('config.php');
  if(isset($_SESSION['login'])){
    $dbres				= mysql_query("SELECT *,UNIX_TIMESTAMP(`online`) AS `online` FROM `users` WHERE `login`='{$_SESSION['login']}'");
    $data				= mysql_fetch_object($dbres);
if($data->ip  == ''){
$IP = $_SERVER['REMOTE_ADDR'];    
mysql_query("UPDATE `users` SET `IP`='$IP' WHERE `login`='$data->login'");
}
mysql_query("DELETE FROM `twitter` WHERE `user`='{$data->id}'");
  }
header("Location: twitterconfig.php");
?>