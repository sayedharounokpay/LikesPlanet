<?php
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `instedb` WHERE (`user_id`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }

$site = mysql_query("SELECT * FROM `instb` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($site);

if ($ext < 1) {
echo '-1';
} else {
$site = mysql_fetch_object($site);

$likesnumnum = 0;

$url0   = $site->instb; 
$mystring0 = file_get_contents($url0);
$x1103 = explode('likes":{"count":', $mystring0);
$x111033 = explode(',', $x1103[1]);
$likesnumnum = $x111033[0];

	if ($likesnumnum < 1) {$likesnumnum = 33;}

if ($likesnumnum < $data->pagelikesnow + 60) {

if ($likesnumnum > $data->pagelikesnow) {

if($site->id == $xdata[0]){

$coinsadded = ($LevelNumBon*0.1) -1 + $site->cpc;
mysql_query("INSERT INTO `instedb` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");
mysql_query("UPDATE `instb` SET `likes`=`likes`+'1', `lastreallikes`='{$likesnumnum}', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics(user_id,date,coins_gained,inst_like) VALUES ({$data->id},now(),{$coinsadded},1)");

echo $coinsadded;

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'ins', '{$mmillesecc}' )");

mysql_query("UPDATE `sitestat` SET `google`=`google`+1 WHERE `id`='4'");
} else { echo '-1'; }

}
else {
echo '0';
}

} else { echo '0'; }

}

?>