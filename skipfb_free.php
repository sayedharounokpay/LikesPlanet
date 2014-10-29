<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `facebook` SET `jump`=`jump`+'1' WHERE `id`='{$x[0]}'");
}}

?>