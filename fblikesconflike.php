<?php
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}
error_reporting(0);

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

if($data->likes_quality < -3) {
echo '-99';
exit;
}

$xdata = explode('---', $_GET['sitename1']);

$siteliked4[] = "'none'";
$siteliked2 = mysql_query("SELECT * FROM `liked` WHERE (`user_id`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'"; }

$site = mysql_query("SELECT * FROM `facebook` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($site);

if ($ext < 1) {
echo '-1';
} else {
$site = mysql_fetch_object($site);

if(preg_match("/\bpages\b/i", $site->facebook)){
$x110 = explode('/', $site->facebook);
$name0 = $x110[5];}
else { $x110 = explode('/', $site->facebook);
$name0 = $x110[3]; }
if(preg_match("/\bfref\b/i", $name0)){
$x110009 = explode('?', $name0);
$name0 = $x110009[0];
}
if(preg_match("/\bref\b/i", $name0)){
$x110009 = explode('?', $name0);
$name0 = $x110009[0];
}

$likesnumnum = 0;

$url0   = 'https://graph.facebook.com/'. urlencode($name0); 
$mystring0 = file_get_contents($url0);
$x1103 = explode('likes"', $mystring0);
$x11103 = explode(':', $x1103[1]);
$x111033 = explode(',', $x11103[1]);
$x111033e = explode('}', $x111033[0]);
$likesnumnum = $x111033e[0];

//if ($likesnumnum < -1) {
//$sitemobile = explode('book', $site->facebook);
//$sitemobile0 = 'https://m.facebook' . $sitemobile[1];
//$mystring0 = file_get_contents($sitemobile0);
//$x1103 = explode('actionList mfss fcg', $mystring0);
//$x11103 = explode('>', $x1103[1]);
//$x111033 = explode(' likes', $x11103[1]);
//$x111033[0] = str_replace(',', '', $x111033[0]);
//$likesnumnum = $x111033[0];
//}

// if ($likesnumnum < 1) {
// $url0   = 'http://socialmediaexplode.com/plugins/fb2/getcount.php?url='. $site->facebook; 
// $likesnumnum = file_get_contents($url0);
// }

if ($likesnumnum < 1) {
$url0   = 'http://shareyt.com/plugins/fb/getcount.php?url='. $site->facebook; 
$likesnumnum = file_get_contents($url0);
}
if ($likesnumnum < 1) {
$url0   = 'http://likeflow.net/plugins/fb/getcount.php?url='. $site->facebook; 
$likesnumnum = file_get_contents($url0);
}

	if ($likesnumnum < 1) {$likesnumnum = 33;}

	
$finalpagepoints = $site->points - $site->cpc;
if ($finalpagepoints <= $site->cpc) {
$pagehigh = 'fbpages.php?high=' . $site->id;
$notemsg = 'Ran Out: Your Facebook Page (' . $site->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/fbpages.php?high=' . $site->id;
$notemsg2 = 'Your Facebook Page (' . $site->facebook . ') Ran out of points! <br /><br /> Click on link below to add more points and get more likes.';
$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");

mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your Facebook Page Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}


if ($likesnumnum < $data->pagelikesnow + 20) {

if ($likesnumnum > $data->pagelikesnow) {

if($site->id == $xdata[0]){

$coinsadded = -1 + $site->cpc;
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");
mysql_query("UPDATE `facebook` SET `likes`=`likes`+'1', `lastreallikes`='{$likesnumnum}', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `hitstoday`=`hitstoday`+1, `likes`=`likes`+1, `likes_quality`=`likes_quality`+1  WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,fb_like,log,page) VALUES ({$data->id},NOW(),{$coinsadded},1,'Coins Added From Facebook Like | Page ID: {$site->id}','fbconflike.php')");

if($data->likes_quality <= 0) {
mysql_query("UPDATE `users` SET `likes_quality`=`likes_quality`+1  WHERE (`id`='{$data->id}') ;");
}

echo $coinsadded;

if ($site->top > 1) {
if ($likesnumnum > $site->top) {
mysql_query("UPDATE `facebook` SET `active`='1' WHERE `id`='{$site->id}'");
}
}

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,fb_like,log,page) VALUES ({$data->ref2},NOW(),{$refaddnoww},1,'Coins Added From REFERENCE Facebook Like | Page ID: {$site->id} | User ID: {$data->id}','fbconflike.php')");
}}

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='3' or `id`='15')");
$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'fb', '{$mmillesecc}' )");


} else { echo '0'; }

}
else if ($likesnumnum+1 == $data->pagelikesnow) {
$coinsadded = -1 + $site->cpc;
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$coinsadded}', `hitstoday`=`hitstoday`-1, `unlikes`=`unlikes`+'1'  WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,fb_like,log,page) VALUES ({$data->id},NOW(),{$coinsadded},1,'Coins Deducted From Bad Facebook Like | Page ID: {$site->id}','fbconflike.php')");
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `facebook` SET `jump`=`jump`+'1' WHERE `id`='{$site->id}'");
echo '-1';
}
else {
echo '0';
mysql_query("UPDATE `users` SET `likes`=`likes`-1, `unlikes`=`unlikes`+1, `refgive`=`refgive`-5  WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `facebook` SET `jump`=`jump`+'1' WHERE `id`='{$site->id}'");
}

} else { echo '0'; }

}

?>