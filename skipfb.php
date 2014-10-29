<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$x[1]}', '{$site->id}')");
mysql_query("UPDATE `facebook` SET `jump`=`jump`+'1', `points`=`points`-'1' WHERE `id`='{$x[0]}'");

if($data->likes_quality <= 1) {
mysql_query("UPDATE `users` SET `likes_quality`=`likes_quality`+1  WHERE `id`='{$data->id}'");
}

}}

?>