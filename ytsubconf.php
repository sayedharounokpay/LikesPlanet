<?php
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}
error_reporting(0);

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `ytsubed` WHERE (`user_id`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }

$site00 = mysql_query("SELECT * FROM `ytsub` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}' AND `ytsub`='{$xdata[2]}') AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($site00);

if ($ext < 1) {
echo '-1';
} else {
$site = mysql_fetch_object($site00);


$finalpagepoints = $site->points - $site->cpc;
if ($finalpagepoints <= $site->cpc) {
$pagehigh = 'ytsubpages.php?high=' . $site->id;
$notemsg = 'Ran Out: Your YouTube Channel (' . $site->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/ytsubpages.php?high=' . $site->id;
$notemsg2 = 'Your YouTube Profile (' . $site->ytsub . ') Ran out of points! <br /><br /> Click on link below to add more points and get more subscribers.';
$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");

mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your YouTube Profile Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}


$likesnumnum = 0;

// $nameP = $site->ytsub;
// $url   = 'http://www.youtube.com/user/'. urlencode($nameP); 
// $mystring0 = file_get_contents($url); 
// $x1103 = explode(' subscribed" >', $mystring0);
// $x111033 = explode('</span', $x1103[1]);
// $likesnumnum = $x111033[0];

$url0   = 'http://socialmediaexplode.com/exchange/youtube-subscribers/getdata.php?url='. $site->ytsub; 
$likesnumnum = file_get_contents($url0);

	if ($likesnumnum < 1) {$likesnumnum = 33;}

if ($likesnumnum < $data->pagelikesnow + 20) {

if ($likesnumnum > $data->pagelikesnow) {

if($site->id == $xdata[0]){

$coinsadded = -1 + $site->cpc;
mysql_query("INSERT INTO `ytsubed` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");
mysql_query("UPDATE `ytsub` SET `likes`=`likes`+'1', `lastreallikes`='{$likesnumnum}', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics(user_id,date,coins_gained,fb_like) VALUES ({$data->id},now(),{$coinsadded},1)");

echo $coinsadded;

if ($site->top > 1) {
if ($likesnumnum > $site->top) {
mysql_query("UPDATE `ytsub` SET `active`='1' WHERE `id`='{$site->id}'");
}
}

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
mysql_query("INSERT INTO statistics(user_id,date,coins_gained,fb_like) VALUES ({$data->ref2},now(),{$refaddnoww},1)");

}}

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'ytd', '{$mmillesecc}' )");

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='11' or `id`='15')");

} else { echo '-1'; }

}
else {
echo '0';
}

} else { echo '0'; }

}

?>