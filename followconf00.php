<?
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

$site = mysql_query("SELECT * FROM `follow` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($site);

if ($ext < 1) {
echo '-1';
} else {
$site = mysql_fetch_object($site);

$likesnumnum = 0;

 $url = "https://mobile.twitter.com/" . $site->follow;
 $mystring0 = file_get_contents($url);
 $x1104 = explode('mobile_profile_follow_prompt_', $mystring0);
 $x11104 = explode('"', $x1104[1]);
 $x11104[0] = str_replace(',', '', $x11104[0] );
 $likesnumnum = $x11104[0];
 $mystring0 = '';

	if ($likesnumnum < 1) {$likesnumnum = 33;}

if ($likesnumnum < $data->pagelikesnow + 20) {

if ($likesnumnum > $data->pagelikesnow) {

if($site->id == $xdata[0]){

$coinsadded = -1 + $site->cpc;
mysql_query("INSERT INTO `followed` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");
mysql_query("UPDATE `follow` SET `likes`=`likes`+'1', `lastreallikes`='{$likesnumnum}', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$data->id}'");
echo $coinsadded;

if ($site->top > 1) {
if ($likesnumnum > $site->top) {
mysql_query("UPDATE `follow` SET `active`='1' WHERE `id`='{$site->id}'");
}
}

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
if( $data->refgive >= 20 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-20 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+1 WHERE `id`='{$data->ref2}'");
}}

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='12' or `id`='15')");


} else { echo '-1'; }

}
else {
echo '0';
}

} else { echo '0'; }

}

?>