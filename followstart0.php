<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

$xdata = explode('---', $_GET['sitename1']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `follow` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;

 $url = "https://mobile.twitter.com/" . $site->follow;
 $mystring0 = file_get_contents($url);
 $x1104 = explode('false,"followers_count":', $mystring0);
 $x11104 = explode(',', $x1104[1]);
 $x11104[0] = str_replace(',', '', $x11104[0] );
 $likesnumnum = $x11104[0];

if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $mystring0;
?>