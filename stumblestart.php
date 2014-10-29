<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `stumble` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;

$url0   = 'http://www.stumbleupon.com/stumbler/'. $site->stumble .'/channels/all'; 
$url00 = file_get_contents($url0);
$x11000909 = explode('>Following<', $url00);
$x1100090 = explode('nav-tertiary-count">', $x11000909[1]);
$x11000901 = explode('</mark', $x1100090[1]);
$likesnumnum = $x11000901[0];

if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>