<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `cash2hits` (user_id, site_id) VALUES('{$x[1]}', '{$site->id}')");
mysql_query("UPDATE `facebook` SET `skipped`=`skipped`+'1'  WHERE `id`='{$x[0]}'");

if ($site->likes <= 10){
if ($site->skipped >= 10){
mysql_query("UPDATE `facebook` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};

}}

?>