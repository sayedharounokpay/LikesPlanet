<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `follow` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `followed` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `follow` SET `jump`=`jump`+'1', `points`=`points`-'1' WHERE `id`='{$site->id}'");
}}

?>