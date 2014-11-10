<?php
include('config.php');

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `youtube` WHERE (`id`='{$x[0]}' AND `user`='{$x[2]}')  AND `id` NOT IN (SELECT `site_id` FROM `played` WHERE `user_id`='{$data->id}')"));

mysql_query("UPDATE `users` SET `coins`=`coins`-1 WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,yt_like,log,page) VALUES ({$data->id},NOW(),1,1,'Coins Deducted From Bad Youtube View | Page ID: {$site->id}','ytreceive.php')");

if($site->cpc > 0){
if($site->points > $site->cpc){

$finalpagepoints = $site->points - $site->cpc;
if ($finalpagepoints <= $site->cpc) {
$pagehigh = 'ytpages.php?high=' . $site->id;
$notemsg = 'Ran Out: Your YouTube Video-Plays (' . $site->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/ytpages.php?high=' . $site->id;
$notemsg2 = 'Your YouTube Video-Plays (' . $site->youtube . ') Ran out of points! <br /><br /> Click on link below to add more points and get more plays/views.';
$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");

mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your YouTube Video-Plays Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}

mysql_query("INSERT INTO `played` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site->cpc}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,yt_like,log,page) VALUES ({$data->id},NOW(),{$site->cpc},1,'Coins Added From Youtube View | Page ID: {$site->id}','ytreceive.php')");

mysql_query("UPDATE `youtube` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");

}}}

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'yt', '{$mmillesecc}' )");

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='19' or `id`='15')");

?>