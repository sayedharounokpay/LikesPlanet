<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `fbsub` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = 0;
$url0  = 'http://shareyt.com/plugins/fbsub/getcount.php?url='. urlencode($site->fbsub);
// $url0 = 'http://socialmediaexplode.com/exchange/facebook-followers/getdata.php?url=http://www.facebook.com/'. urlencode($site->fbsub); 
$likesnumnum = file_get_contents($url0);

// if ($likesnumnum < 1) {
// $url0 = 'http://socialmediaexplode.com/plugins/fbs/getcount.php?id='. urlencode($site->fbsub); 
// $likesnumnum = file_get_contents($url0);
// }

if ($likesnumnum < 1) {$likesnumnum = 32;}

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>