<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(isset($_GET['sitename1'])){
$x = explode('---', $_GET['sitename1']);

$sitestoday = mysql_query("SELECT * FROM `likesplanetaddonlikedtoday` WHERE (`site_id`='{$x[0]}' AND `user_id`='{$x[3]}') ");
$ext = mysql_num_rows($sitestoday);

if ($ext <= 60) {

$pagestarteddata = mysql_fetch_object(mysql_query("SELECT * FROM `likesplanetaddon_start` WHERE (`site_id` = '{$x[0]}' AND `page_id` = '{$x[1]}' AND `user_id` = '{$x[3]}') ;"));

if ($pagestarteddata->start >= 1) {

mysql_query("DELETE FROM `likesplanetaddon_start` WHERE (`site_id`='{$x[0]}' AND `page_id`='{$x[1]}' AND `user_id`='{$x[3]}')");

$pagelikedbeforenum = mysql_num_rows(mysql_query("SELECT * FROM `likesplanetaddonliked` WHERE (`site_id`='{$x[0]}' AND `page_id`='{$x[1]}' AND `user_id`='{$x[3]}') "));

if ($pagelikedbeforenum == 0) {

$site99 = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$x[1]}' AND `user`='{$x[2]}' ;"));

if(preg_match("/\bpages\b/i", $site99->facebook)){
$x110 = explode('/', $site99->facebook);
$name0 = $x110[5];}
else { $x110 = explode('/', $site99->facebook);
$name0 = $x110[3]; }
if(preg_match("/\bfref\b/i", $name0)){
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

	if ($likesnumnum < 1) {$likesnumnum = 33;}

$islikedpagee = "NOT32";

if($site99->id == $x[1]){
mysql_query("INSERT INTO `likesplanetaddonliked` (site_id, user_id, page_id) VALUES('{$x[0]}', '{$x[3]}', '{$x[1]}' )");
mysql_query("INSERT INTO `likesplanetaddonlikedtoday` (site_id, user_id, page_id) VALUES('{$x[0]}', '{$x[3]}', '{$x[1]}' )");

if($likesnumnum > $pagestarteddata->start) { // Liked
mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='22' OR `id`='15')");
mysql_query("UPDATE `facebook` SET `likes`=`likes`+'1', `lastreallikes`='{$likesnumnum}', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site99->id}'");
$coinsadded = -1 + $site99->cpc;
mysql_query("UPDATE `likesplanetaddon` SET `hits`=`hits`+'{$coinsadded}', `likes`=`likes`+1  WHERE `id`='{$x[0]}'");

$sitebasic = mysql_fetch_object(mysql_query("SELECT * FROM `likesplanetaddon` WHERE (`id`='{$x[0]}') "));
$islikedpagee = $sitebasic->url . "likesplanet_liked&userid=" . $x[3] . "&pageid=" . $x[1] ."&cpc=" . $coinsadded;
}

if($likesnumnum < $pagestarteddata->start) { // Unliked
$coinsadded = $site99->cpc;
mysql_query("UPDATE `likesplanetaddon` SET `hits`=`hits`-'{$coinsadded}', `likes`=`likes`-1  WHERE `id`='{$x[0]}'");
$sitebasic = mysql_fetch_object(mysql_query("SELECT * FROM `likesplanetaddon` WHERE (`id`='{$x[0]}') "));
$islikedpagee = $sitebasic->url . "likesplanet_liked&userid=" . $x[3] . "&pageid=" . $x[1] ."&cpc=-" . $coinsadded;
}

}

}
}
}
}

echo $islikedpagee;

?>