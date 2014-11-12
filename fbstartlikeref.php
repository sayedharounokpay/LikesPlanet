<?php
include('config.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

error_reporting(E_ALL);

if(!isset($data->login)){exit;}


if($data->likes_quality < -3) {
	mysql_query("UPDATE `users` SET `refgive`=`refgive`-15, `coins`=`coins`-5, `beforeref`=`coins` WHERE `id`='{$data->id}'");
    mysql_query("INSERT INTO statistics (user_id,date,deducted,fb_like,log,page) VALUES ({$data->id},NOW(),5,1,'Coins Deducted From Bad Facebook Like | Page ID: {$site->id}','fbconflike.php')");

    echo '-99';
	session_destroy();
	exit;
}

mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1, `likes_quality`=`likes_quality`-1  WHERE `id`='{$data->id}'");

if($data->likes_quality < -99) {
	mysql_query("UPDATE `users` SET `multi`=1, `coins`=`coins`-25, `beforeref`=`coins` WHERE (`id`='{$data->id}') ;");
    mysql_query("INSERT INTO statistics (user_id,date,deducted,fb_like,log,page) VALUES ({$data->id},NOW(),25,1,'Coins Deducted From Bad Facebook Like | Page ID: {$site->id}','fbconflike.php')");
    
	mysql_query("UPDATE `users` SET `multi`=1, `coins`=`coins`-10, `beforeref`=`coins` WHERE (`lastip`='{$data->lastip}') ;");
    $list_result = mysql_query("SELECT * FROM users WHERE lastip - '{$data->lastip}'");
    while($row = mysql_fetch_object($list_result)) {
           mysql_query("INSERT INTO statistics (user_id,date,deducted,fb_like,log,page) VALUES ({$row->id},NOW(),5,1,'Coins Deducted From Bad Facebook Like | Page ID: {$site->id}','fbconflike.php')");
    }
	if( $data->ref2 >= 1 ){
	mysql_query("UPDATE `users` SET `refgive`=`refgive`-1000 WHERE `id`='{$data->id}'");
	mysql_query("UPDATE `users` SET `coins`=`coins`-25, `beforeref`=`coins` WHERE `id`='{$data->ref2}'");
    mysql_query("INSERT INTO statistics(user_id,date,coins_deducted,fb_like) VALUES ({$data->ref2},now(),25,1)");
	mysql_query("INSERT INTO `refclaimed` (user, ref) VALUES('{$data->ref2}','{$data->id}')");
	mysql_query("INSERT INTO `daily` (userid, ban) VALUES('{$data->id}', '1')");
	mysql_query("INSERT INTO `daily2` (userid) VALUES('{$data->id}')");
	}
echo '-99';
session_destroy();
exit;
}


$xdata = explode("---", $get["sitename1"]);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

if (strpos($site->facebook, '?') != false) {
$mobilelinksO = explode('?', $site->facebook);
$mobilelink = $mobilelinksO[0];
} else {
$mobilelink = $site->facebook;
}

if (strpos($mobilelink, 'facebook.com/pages/') != false) {
$mobilelinksO = explode('facebook.com/pages/', $mobilelink);
$mobilelinksO = explode('/', $mobilelinksO[1]);
$mobilelink = "http://facebook.com/" . $mobilelinksO[1];
}
echo $mobilelink;
$name0 = $mobilelink;
echo $name0;
$mobilelink = str_replace('www.', '', $mobilelink );
$mobilelink = str_replace('facebook.', 'm.facebook.', $mobilelink );
$mobilelink = str_replace('m.m.facebook', 'm.facebook', $mobilelink );

//if(preg_match("/\bpages\b/i", $site->facebook)){
//$x110 = explode('/', $site->facebook);
//$name0 = $x110[5];}
//else { $x110 = explode('/', $site->facebook);
//$name0 = $x110[3]; }
//if(preg_match("/\bfref\b/i", $name0)){
//$x110009 = explode('?', $name0);
//$name0 = $x110009[0];
//}
//if(preg_match("/\bref\b/i", $name0)){
//$x110009 = explode('?', $name0);
//$name0 = $x110009[0];
//}

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

if ($mobilelink != "") {
$reloggURL = "<script>document.location.href='" . $mobilelink . "'</script>";
echo $reloggURL; exit;
}

?>
