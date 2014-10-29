<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}
error_reporting(0);

if(!isset($data->login)){exit;}

if($data->likes_quality < -3) {
	mysql_query("UPDATE `users` SET `refgive`=`refgive`-15, `coins`=`coins`-10, `beforeref`=`coins` WHERE `id`='{$data->id}'");
	echo '-99';
	session_destroy();
	exit;
}

mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1, `likes_quality`=`likes_quality`-1  WHERE `id`='{$data->id}'");

if($data->likes_quality < -99) {
	mysql_query("UPDATE `users` SET `multi`=1, `coins`=`coins`-25, `beforeref`=`coins` WHERE (`id`='{$data->id}') ;");
	mysql_query("UPDATE `users` SET `multi`=1, `coins`=`coins`-10, `beforeref`=`coins` WHERE (`lastip`='{$data->lastip}') ;");
	if( $data->ref2 >= 1 ){
	mysql_query("UPDATE `users` SET `refgive`=`refgive`-1000 WHERE `id`='{$data->id}'");
	mysql_query("UPDATE `users` SET `coins`=`coins`-25, `beforeref`=`coins` WHERE `id`='{$data->ref2}'");
	mysql_query("INSERT INTO `refclaimed` (user, ref) VALUES('{$data->ref2}','{$data->id}')");
	mysql_query("INSERT INTO `daily` (userid, ban) VALUES('{$data->id}', '1')");
	mysql_query("INSERT INTO `daily2` (userid) VALUES('{$data->id}')");
	}
echo '-99';
session_destroy();
exit;
}


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

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
//$x111033e[0] = str_replace(',', '', $x111033e[0]);
//$likesnumnum = $x111033e[0];
//}

if ($likesnumnum < 1) {
$url0   = 'http://shareyt.com/plugins/fb/getcount.php?url='. $site->facebook; 
$likesnumnum = file_get_contents($url0);
}
if ($likesnumnum < 1) {
$url0   = 'http://likeflow.net/plugins/fb/getcount.php?url='. $site->facebook; 
$likesnumnum = file_get_contents($url0);
}


if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>