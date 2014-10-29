<?
include('config.php');

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


if(isset($_POST['id'])){

$site = mysql_fetch_object(mysql_query("SELECT * FROM `retw` WHERE (`retw`='{$_POST['id']}') AND `id` NOT IN (SELECT `site_id` FROM `retwed` WHERE `user_id`='{$data->id}')  "));

if($site->user == $_POST['owner']){
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site->cpc}'-1  WHERE `id`='{$data->id}'");
mysql_query("UPDATE `retw` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `retw`='{$_POST['id']}'");
mysql_query("INSERT INTO `retwed` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
if( $data->refgive >= 20 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-20 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+1 WHERE `id`='{$data->ref2}'");
}}

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE `id`='13'");


}
}

mysql_query("UPDATE `sitestat` SET `hits`=`hits`+1 WHERE `id`='3'");

?>