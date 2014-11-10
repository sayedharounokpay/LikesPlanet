<?php
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

function get_plusones($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  $curl_results = curl_exec ($curl);
  curl_close ($curl);
  $json = json_decode($curl_results, true);
  return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

$xdata = explode('---', $_GET['sitename1']);

$siteliked4[] = "'none'";
$siteliked2 = mysql_query("SELECT * FROM `plused` WHERE (`user_id`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'"; }

$site = mysql_query("SELECT * FROM `google` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}' AND `points` > `cpc`) AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($site);

if ($ext < 1) {
echo '-1';
} else {
$site = mysql_fetch_object($site);

$likesnumnum = 0;

$likesnumnum = get_plusones($site->google);

	if ($likesnumnum < 1) {$likesnumnum = 33;}

if($likesnumnum > $data->pagelikesnow) {
$finalpagepoints = $site->points - $site->cpc;
if ($finalpagepoints <= $site->cpc) {
$pagehigh = 'googlepages.php?high=' . $site->id;
$notemsg = 'Ran Out: Your Google-Votes Website (' . $site->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/googlepages.php?high=' . $site->id;
$notemsg2 = 'Your Google-Votes Website (' . $site->google . ') Ran out of points! <br /><br /> Click on link below to add more points and get more votes.';
$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");

mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'likesplanet.com - Your Google-Votes Website Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}

if($site->id == $xdata[0]){

$coinsadded = -1 + $site->cpc;
mysql_query("INSERT INTO `plused` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");
mysql_query("UPDATE `google` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$data->id}'");
echo $coinsadded;
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,google,log,page) VALUES ({$data->id},NOW(),{$coinsadded},1,'Coins Added From Google Like | Page ID: {$site->id}','googleconf.php')");



if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,twitter,log,page) VALUES ({$data->id},NOW(),{$coinsadded},1,'Coins Added From Refference To Google Like | Page ID: {$site->id}','googleconf.php')");

}}

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='23' or `id`='15')");

}

} else { echo '0'; }


}

?>