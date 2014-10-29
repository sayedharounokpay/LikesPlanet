<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}
error_reporting(0);

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `ytsub` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;

// $nameP = $site->ytsub;
// $url   = 'http://www.youtube.com/user/'. urlencode($nameP); 
// $mystring0 = file_get_contents($url); 
// $x1103 = explode(' subscribed" >', $mystring0);
// $x111033 = explode('</span', $x1103[1]);
// $likesnumnum = $x111033[0];

$url0   = 'http://socialmediaexplode.com/exchange/youtube-subscribers/getdata.php?url='. $site->ytsub; 
$likesnumnum = file_get_contents($url0);

if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>