<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `ytdislike` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;

if(preg_match("/&/i", $site->ytdislike)){
$x110 = explode('&', $site->ytdislike);
$nameP = $x110[0];
}
else {
$nameP = $site->ytdislike;
}

$url   = 'http://www.youtube.com/watch?v='. urlencode($nameP); 
$mystring0 = file_get_contents($url); 
$x1103 = explode('watch-dislike yt-sprite"></span><span class="yt-uix-button-content">', $mystring0);
$x111033 = explode(' </span>', $x1103[1]);
$likesnumnum = $x111033[0];


if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>