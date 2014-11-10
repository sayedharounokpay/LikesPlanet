<?php
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

$xdata = explode('---', $_GET['sitename1']);

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `followed` WHERE (`user_id`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }

$sitelist = mysql_query("SELECT * FROM `follow` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($sitelist);

if ($ext < 1) {
echo '0';
} else {
$site = mysql_fetch_object($sitelist);



$finalpagepoints = $site->points - $site->cpc;
if ($finalpagepoints <= $site->cpc) {
$pagehigh = 'followpages.php?high=' . $site->id;
$notemsg = 'Ran Out: Your Twitter Profile (' . $site->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/followpages.php?high=' . $site->id;
$notemsg2 = 'Your Twitter Profile (' . $site->follow . ') Ran out of points! <br /><br /> Click on link below to add more points and get more followers.';
$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");

mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your Twitter Profile Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}



$likesnumnum = 0;
 
 $url = "https://twitter.com/intent/user?screen_name=" . $site->follow;
 $mystring0 = file_get_contents($url);
 $x1104 = explode('/followers" class="alternate-context">', $mystring0);
 $x11104 = explode('</a>', $x1104[1]);
 $x11104[0] = str_replace(",","",$x11104[0]);
 $fnum = 32;
 $fnum = $x11104[0];
 $fnummin = $fnum - 20;
 $mystring0 = '';
 
 $errornum = '0';

if($site->id == $xdata[0]){
if ($fnum > $data->pagelikesnow && $fnummin < $data->pagelikesnow ) {

$coinsadded = -1 + $site->cpc;
mysql_query("INSERT INTO `followed` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `pagelikesnow`='1', `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,twitter,log,page) VALUES ({$data->id},NOW(),{$coinsadded},1,'Coins Added From Refference To Stumble Follow | Page ID: {$site->id}','stumbleconf.php')");

mysql_query("UPDATE `follow` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
$errornum = $coinsadded;

if ($site->top > 1) {
if ($fnum > $site->top) {
if ($fnum != 32) {
mysql_query("UPDATE `follow` SET `active`='1' WHERE `id`='{$site->id}'");
}
}
}

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,twitter,log,page) VALUES ({$data->ref2},NOW(),{$refaddnoww},1,'Coins Added From Refference To Stumble Follow | Page ID: {$site->id}','stumbleconf.php')");

}}

}}}

echo $errornum;

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'tw', '{$mmillesecc}' )");

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='12' or `id`='15')");



?>