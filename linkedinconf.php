<?
include('config.php');
foreach($_GET as $key => $value) {
	$_GET[$key] = filter($value);
}

if(isset($_GET['user'])){
$x = mysql_fetch_object(mysql_query("SELECT * FROM `linkedin` WHERE (`id`='{$_GET['id']}')   AND `id` NOT IN (SELECT `site_id` FROM `linked` WHERE `user_id`='{$data->id}')  "));
if ($x->linkedin == $_GET['siteurl'] ){
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$x->cpc}', `hitstoday`=`hitstoday`+1, `liked`=`liked`+1 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `linkedin` SET `likes`=`likes`+'1', `points`=`points`-'{$x->cpc}' WHERE `id`='{$_GET['id']}'");
mysql_query("INSERT INTO `linked` (user_id, site_id) VALUES('{$data->id}','{$_GET['id']}')");

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
}}

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'li', '{$mmillesecc}' )");


mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='14' or `id`='15')");


echo "<font color='green'><b>Plused with success!</b></font>";
}
}

mysql_query("UPDATE `users` SET `coins`=`coins`-1 WHERE `id`='{$data->id}'");

?>