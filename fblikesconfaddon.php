<?
include('config.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$siteid = $get['siteid'];
$userid = $get['userid'];
$pageid = $get['pageid'];
$pageowner = $get['pageowner'];

$sitestoday = mysql_query("SELECT * FROM `likesplanetaddonlikedtoday` WHERE (`user_id`='{$userid}' AND `site_id`='{$siteid}') ");
$ext = mysql_num_rows($sitestoday);
if ($ext < 40) {

$siteliked4[] = "'none'";
$siteliked2 = mysql_query("SELECT * FROM `likesplanetaddonliked` WHERE (`user_id`='{$userid}' AND `site_id`='{$siteid}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->page_id . "'"; }

$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`id`='{$get['pageid']}' AND `user`='{$get['pageowner']}') AND `id` NOT IN  (".implode(',', $siteliked4).")  "));

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

$url0   = 'http://shareyt.com/plugins/fb/getcount.php?url='. $site->pageid; 
$likesnumnum = file_get_contents($url0);

if ($likesnumnum < 1) {
$url0   = 'http://socialmediaexplode.com/plugins/fb2/getcount.php?url='. $site->facebook; 
$likesnumnum = file_get_contents($url0);
}

$sitebasic = mysql_fetch_object(mysql_query("SELECT * FROM `likesplanetaddon` WHERE (`id`='{$get['siteid']}') "));

mysql_query("INSERT INTO `likesplanetaddonliked` (site_id, user_id, page_id) VALUES('{$siteid}', '{$userid}', '{$pageid}' )");

if($site->id == $get['pageid']){
if ($site->top > 1) {
if ($likesnumnum > $site->top) {
mysql_query("UPDATE `facebook` SET `active`='1' WHERE `id`='{$site->id}'");
}
}
mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='22' OR `id`='15')");

mysql_query("INSERT INTO `likesplanetaddonlikedtoday` (site_id, user_id, page_id) VALUES('{$siteid}', '{$userid}', '{$pageid}' )");

mysql_query("UPDATE `facebook` SET `likes`=`likes`+'1', `lastreallikes`='{$likesnumnum}', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
$coinsadded = -1 + $site->cpc;

mysql_query("UPDATE `likesplanetaddon` SET `hits`=`hits`+'{$coinsadded}', `likes`=`likes`+1  WHERE `id`='{$get['siteid']}'");

$newdirect = "<script>document.location.href='" . $sitebasic->url . "likesplanet_liked&userid=" . $userid . "&pageid=" . $pageid ."&cpc=" . $coinsadded . "'</script>";
echo $newdirect;

} else {
$newdirect = "<script>document.location.href='fblikesconfaddonunliked.php'</script>";
echo $newdirect;
}

} else {
$newdirect = "<script>document.location.href='fblikesconfaddonunliked.php'</script>";
echo $newdirect;
}

?>