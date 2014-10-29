<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}
error_reporting(0);

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `fbw` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;

$url0   = 'https://graph.facebook.com/?id='. urlencode($site->fbw); 
$mystring0 = file_get_contents($url0);
$x1103 = explode('shares"', $mystring0);
$x11103 = explode(':', $x1103[1]);

if (strpos($x11103[1], ',') != false) {
$x111033 = explode(',', $x11103[1]);
$likesnumnum = $x111033[0];
} else {
$x111033 = explode('}', $x11103[1]);
$likesnumnum = $x111033[0];
}

if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>