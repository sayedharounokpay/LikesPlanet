<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `fbshare` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `fbshared` (user_id, site_id) VALUES('{$x[1]}', '{$site->id}')");
mysql_query("UPDATE `fbshare` SET `jump`=`jump`+'1', `points`=`points`-'1' WHERE `id`='{$x[0]}'");
}}

?>