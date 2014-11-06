<?php
include('config.php');

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

$site21 = mysql_query("SELECT * FROM `post` WHERE `id`='{$_POST['id']}'");
$site11 = mysql_fetch_object($site21);

$finalpagepoints = $site11->points - $site11->cpc -2;
if ($finalpagepoints < $site11->cpc) {
$pagehigh = 'fbpostmy.php?high=' . $site11->id;
$notemsg = 'Ran Out: Your Facebook Photo (' . $site11->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/fbpostmy.php?high=' . $site11->id;
$notemsg2 = 'Your Facebook Photo (' . $site11->title . ' | ' . $site11->details . ') Ran out of points! <br /><br /> Click on link below to add more points and get more likes.';

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {

$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site11->user}' ) "));
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");
mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your Facebook Photo Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}


if ($site11->keep == 0) {
$sitemobile = explode('facebook.com', $site11->details);
$sitemobile0 = 'http://m.facebook.com' . $sitemobile[1];
$mystring = file_get_contents($sitemobile0); 
$mssssg = '';
$pos = strpos($mystring, $data->fbn);
} else {
$pos = 32;
}


if ($pos > 1) {
$mssssg = 'yes';

$site21f = mysql_query("SELECT * FROM `postdone` WHERE (`site_id`='{$_POST['id']}' AND `user_id`='{$data->id}')");
$extf = mysql_num_rows($site21f);
if($extf == 0){

mysql_query("INSERT INTO `postdone` (user_id, site_id) VALUES('{$data->id}', '{$_POST['id']}' ) ");

mysql_query("UPDATE `post` SET `points`=`points`-'{$site11->cpc}', `likes`=`likes`+1   WHERE `id`='{$_POST['id']}'");

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site11->cpc}'-1, `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1' WHERE `id`='{$data->id}'");
$updatecpc = $site11->cpc-1;
mysql_query("INSERT INTO statistics(user_id,date,coins_gained,fb_like) VALUES ({$data->id},now(),{$updatecpc},1)");

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site11->cpc}'-1, `totalgive`=`totalgive`+'{$site11->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
mysql_query("INSERT INTO statistics(user_id,date,coins_gained,fb_like) VALUES ({$data->id},now(),{$refaddnoww},1)");

}}

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site11->title}', 'fb', '{$mmillesecc}' )");

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='4' or `id`='15')");

}
}
else { $mssssg = 'no';}

echo $mssssg;
?>