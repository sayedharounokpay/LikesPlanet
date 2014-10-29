<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `linkedin` WHERE `id`='{$x[0]}'"));
if($site->id >0){
mysql_query("INSERT INTO `linked` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `linkedin` SET `skipped`=`skipped`+'1', `points`=`points`-'1' WHERE `id`='{$x[0]}'");

if ($site->likes <= 7){
if ($site->skipped >= 7){
mysql_query("UPDATE `linkedin` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};

if ($site->likes >= 7){
if ($site->skipped >= $site->likes){
mysql_query("UPDATE `linkedin` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};

}}

?>