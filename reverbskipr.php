<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `reverb` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `reverbed` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `reverb` SET `skipped`=`skipped`+'1', `points`=`points`-`cpc` WHERE `id`='{$site->id}'");
}}

?>