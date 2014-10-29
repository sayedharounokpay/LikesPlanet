<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`id`='{$x[0]}' AND `user`='{$x[2]}')  AND `id` NOT IN (SELECT `site_id` FROM `cash2hits` WHERE `user_id`='{$x[1]}')  "));

if($site->id != ""){
mysql_query("UPDATE `facebook` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `id`='{$x[0]}'");
mysql_query("INSERT INTO `cash2hits` (user_id, site_id) VALUES('{$x[1]}','{$site->id}')");
}

}
?>