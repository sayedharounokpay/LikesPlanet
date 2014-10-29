<?
include('config.php');

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `directlink` WHERE (`id`='{$x[0]}' AND `user`='{$x[1]}' AND `points`>`cpc`)  AND `id` NOT IN (SELECT `site_id` FROM `directlinked` WHERE `user_id`='{$data->id}')"));

$rest1 = $site->directlink;
$rest2 = $x[2];

$rest1 = strtoupper($rest1);
$rest2 = strtoupper($rest2);

$rest1 = str_replace("WWW.", "", $rest1); 
$rest1 = str_replace("HTTPS://", "", $rest1); 
$rest1 = str_replace("HTTP://", "", $rest1); 

$rest2 = str_replace("WWW.", "", $rest2 ); 
$rest2 = str_replace("HTTPS://", "", $rest2 ); 
$rest2 = str_replace("HTTP://", "", $rest2 ); 

$rest1 = substr($rest1, 0, 1);
$rest2 = substr($rest2, 0, 1);

$resultjj = -5;

mysql_query("INSERT INTO `directlinked` (user_id, site_id) VALUES('{$data->id}','{$x[0]}')");
mysql_query("UPDATE `directlink` SET `points`=`points`-'{$site->cpc}', `likes`=`likes`+1  WHERE `id`='{$x[0]}'");

if($rest1 == $rest2){
if($site->cpc > 0){
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='17' or `id`='15')");

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'w', '{$mmillesecc}' )");


}
$resultjj = 5;
}
}

echo $resultjj;
?>