<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `google` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `plused` (user_id, site_id) VALUES('{$x[1]}', '{$site->id}')");
mysql_query("UPDATE `google` SET `reports`=`reports`+'1', `points`=`points`-'2'  WHERE `google`='{$x[0]}'");
}}

?>