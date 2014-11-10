<?php
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `stumbled` WHERE (`user_id`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }

$site = mysql_query("SELECT * FROM `stumble` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($site);

if ($ext < 1) {
echo '-1';
} else {
$site = mysql_fetch_object($site);

$likesnumnum = 0;

$url0   = 'http://www.stumbleupon.com/stumbler/'. $site->stumble; 
$url00 = file_get_contents($url0);
$x11000909 = explode('>Following<', $url00);
$x1100090 = explode('nav-tertiary-count">', $x11000909[1]);
$x11000901 = explode('</mark', $x1100090[1]);
$likesnumnum = $x11000901[0];

	if ($likesnumnum < 1) {$likesnumnum = 33;}

if ($likesnumnum < $data->pagelikesnow + 20) {

if ($likesnumnum > $data->pagelikesnow) {

if($site->id == $xdata[0]){

$coinsadded = -1 + $site->cpc;
mysql_query("INSERT INTO `stumbled` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");
mysql_query("UPDATE `stumble` SET `likes`=`likes`+'1', `lastreallikes`='{$likesnumnum}', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,yt_like,log,page) VALUES ({$data->id},NOW(),{$coinsadded},1,'Coins Added From Stumble Follow | Page ID: {$site->id}','stumbleconf.php')");


echo $coinsadded;

if ($site->top > 1) {
if ($likesnumnum > $site->top) {
mysql_query("UPDATE `stumble` SET `active`='1' WHERE `id`='{$site->id}'");
}
}

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,stumble,log,page) VALUES ({$data->ref2},NOW(),{$refaddnoww},1,'Coins Added From Refference To Stumble Follow | Page ID: {$site->id}','stumbleconf.php')");


}}

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'su', '{$mmillesecc}' )");

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='8' or `id`='15')");

} else { echo '-1'; }

}
else {
echo '0';
}

} else { echo '0'; }

}

?>