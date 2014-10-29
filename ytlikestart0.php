<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `ytlike` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;

if(preg_match("/&/i", $site->ytlike)){
$x110 = explode('&', $site->ytlike);
$name = $x110[0];
}
else {
$name = $site->ytlike;
}
$url   = 'http://gdata.youtube.com/feeds/api/videos/'. urlencode($name).'?alt=json&aaap1'; 
$json  = file_get_contents($url); 
$data0  = json_decode($json, TRUE); 
if(isset($data0)) {
$likesnumnum = (int) $data0['entry']['gd$rating']['numRaters'];
} else {
$likesnumnum = 0;
}

if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>