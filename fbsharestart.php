<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `fbshare` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;

$sitemobile = str_replace('facebook', 'm.facebook', $site->fbshare);
$sitemobile = str_replace('www.', '', $sitemobile);

$sitemobile = $site->fbshare;

$mystring0 = file_get_contents('https://www.facebook.com/ajax/pagelet/generic.php/PhotoViewerInitPagelet?data={"fbid"%3A"642782785733389"}&__a=0');
$x1103 = explode('sharecount":', $mystring0);
$x111033 = explode(',', $x1103[1]);
$likesnumnum = $x111033[0];

if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $mystring0;

?>