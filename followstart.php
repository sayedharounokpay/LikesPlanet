<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

$xdata = explode('---', $_GET['ucode']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `follow` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$fnum = 0;

 $url = "https://twitter.com/intent/user?screen_name=" . $site->follow;
 $mystring0 = file_get_contents($url);
 $x1104 = explode('/followers" class="alternate-context">', $mystring0);
 $x11104 = explode('</a>', $x1104[1]);
 $x11104[0] = str_replace(",","",$x11104[0]);
 $fnum = $x11104[0];
 
 if ($fnum < 1) {$fnum = 32;}
 
 mysql_query("UPDATE `users` SET `pagelikesnow`='{$fnum}'  WHERE `id`='{$data->id}'");

 echo $fnum;
?>