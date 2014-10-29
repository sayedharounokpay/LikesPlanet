<?
include('config.php');

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `linkedin` WHERE (`id`='{$x[0]}' AND `user`='{$x[1]}' AND `points` > `cpc`) AND `id` NOT IN (SELECT `site_id` FROM `linked` WHERE `user_id`='{$data->id}')  "));

if($site->id == $x[0]){
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site->cpc}'-1  WHERE `id`='{$data->id}'");
mysql_query("UPDATE `linkedin` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `id`='{$x[0]}'");
mysql_query("INSERT INTO `linked` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

$myuser = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `id`='{$data->id}'"));
if( 0 < $myuser->ref2 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
if( 25 < $myuser->refgive ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-25, `refgot`=`refgot`+1 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+1 WHERE `id`='{$myuser->ref2}'");
}}

}
}

mysql_query("UPDATE `sitestat` SET `likes`=`likes`+1 WHERE `id`='3'");

?>