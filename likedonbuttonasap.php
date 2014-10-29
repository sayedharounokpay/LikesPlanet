<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

$name000 = $_GET['userid'];
$siteid = $_GET['siteid'];
$ownerid = $_GET['ownerid'];

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `likedbtn` WHERE (`user_id`='{$name000}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }
$siteliked200 = mysql_query("SELECT * FROM `liked` WHERE (`user_id`='{$name000}') ");
for($j=0; $siteliked00 = mysql_fetch_object($siteliked200); $j++)
	{ $siteliked4[] = $siteliked00->site_id; }

$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`id`='{$siteid}' AND `user`='{$ownerid}') AND `id` NOT IN  (".implode(',', $siteliked4).")  "));

if(!isset($site->id)){
mysql_query("UPDATE `users` SET `unlikes`=`unlikes`+1, `notliked`=`notliked`+1, `coins`=`coins`-'5'  WHERE (`id`='{$data->id}')");
echo "<center><font color='red' size='3'><b>Error!</b></font></center>";
} else {
if ($site->user == $ownerid) {
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$name000}','{$siteid}')");
mysql_query("UPDATE `facebook` SET `points`=`points`-'{$site->cpc}', `likes`=`likes`+1 WHERE (`id`='{$site->id}')");

if(preg_match("/\bpages\b/i", $site->facebook)){
$x110 = explode('/', $site->facebook);
$name0 = $x110[5];}
else {
$x110 = explode('/', $site->facebook);
$name0 = $x110[3];
}
if(preg_match("/\bref\b/i", $name0)){
$x1100090 = explode('?', $name0);
$name0 = $x1100090[0];
}
if ($site->pageid != '') {
$url0   = 'https://graph.facebook.com/'. urlencode($name0) . '?a=' .rand(0,100); 
$mystring0 = file_get_contents($url0);
$x1103 = explode('likes"', $mystring0);
$x11103 = explode(':', $x1103[1]);
$x111033 = explode(',', $x11103[1]);
$likesnumnum = $x111033[0];
}

if ($likesnumnum > 2) {
if ($site->top > 1) {
if ($likesnumnum > $site->top) {
mysql_query("UPDATE `facebook` SET `active`='1' WHERE `id`='{$site->id}'");
}
}

$maxrange = $likesnumnum + 10;
$addpointstotal = ($LevelNumBon*0.1) - 2 + $site->cpc;
$addpointstotal2 = ($LevelNumBon*0.1) + 1;

mysql_query("UPDATE `facebook` SET `lastreallikes`='{$likesnumnum}' WHERE (`id`='{$site->id}')");
if ($likesnumnum > $site->lastreallikes) {
mysql_query("UPDATE `users` SET `likes`=`likes`+'1', `notliked`='0', `hitstoday`=`hitstoday`+'1', `coins`=`coins`+'{$addpointstotal}'  WHERE (`id`='{$name000}')");

$myuser = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `id`='{$data->id}'"));
if( 1 < $myuser->ref2 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+2 WHERE `id`='{$data->id}'");
if( 30 < $myuser->refgive ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-30, `refgot`=`refgot`+1 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+1 WHERE `id`='{$myuser->ref2}'");
}}

echo "<center><font color='green' size='3'><b>Liked! +" . $addpointstotal . " Points Added.</br></font></center>";
}
else if ($maxrange > $site->lastreallikes) {
	if ($likesnumnum > 2) {mysql_query("UPDATE `users` SET `notliked`=`notliked`+'1'  WHERE (`id`='{$name000}')");}
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$addpointstotal}'  WHERE (`id`='{$name000}')");
echo "<center><font color='green' size='3'><b>Ok, +" . $addpointstotal . " Points Added.</br></font></center>";
} else {
	if ($likesnumnum > 2) {mysql_query("UPDATE `users` SET `notliked`=`notliked`+'1', `unlikes`=`unlikes`+'1'  WHERE (`id`='{$name000}')");}
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$addpointstotal2}'  WHERE (`id`='{$name000}')");
echo "<center><font color='green' size='3'><b>Ok, +" . $addpointstotal2 . " Points Added.</br></font></center>";
}

} else {
$addpointstotal = ($LevelNumBon*0.1) - 2 + $site->cpc;
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$addpointstotal}', `notliked`='0'  WHERE (`id`='{$name000}')");
echo "<center><font color='green' size='3'><b>Ok, Points Added.</br></font></center>";
}

}
}
?>