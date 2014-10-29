<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

$name0 = $_GET['userid'];
$siteid = $_GET['siteid'];
$ownerid = $_GET['ownerid'];

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `likedbtn` WHERE (`user_id`='{$name0}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }

$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`id`='{$siteid}' AND `user`='{$ownerid}') AND `id` NOT IN  (".implode(',', $siteliked4).")  "));

if(!isset($site->id)){
echo "<center><font color='red' size='3'><b>Error!</b></font></center>";
mysql_query("UPDATE `users` SET `unliked`=`unliked`+1 WHERE (`id`='{$name0}')");
} else {
if ($site->user == $ownerid) {
mysql_query("INSERT INTO `likedbtn` (user_id, site_id) VALUES('{$name0}','{$siteid}')");
mysql_query("UPDATE `users` SET `coins`=`coins`+1 WHERE (`id`='{$name0}')");

echo "<center><font color='green' size='3'><b>+1 Points Added.</br>Confirm to get all points.</font></center>";
}
}
?>