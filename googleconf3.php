<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}
if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

$xdata = explode('---', $_GET['sitename1']);

$siteliked4[] = "'none'";
$siteliked2 = mysql_query("SELECT * FROM `plused` WHERE (`user_id`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'"; }

$site = mysql_query("SELECT * FROM `google` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}' AND `points` >= `cpc`) AND `id` NOT IN  (".implode(',', $siteliked4).")  ");

$ext = mysql_num_rows($site);

if ($ext < 1) {
echo '-1';
} else {
$site = mysql_fetch_object($site);

$likesnumnum = 33;

if($site->id == $xdata[0]){

$coinsadded = $site->cpc;
mysql_query("INSERT INTO `plused` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$coinsadded}', `hitstoday`=`hitstoday`-1, `likes`=`likes`-'1'  WHERE `id`='{$data->id}'");
echo $coinsadded;

}


}

?>