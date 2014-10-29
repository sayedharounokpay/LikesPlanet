<?php
include('config.php');


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];


if('planet2013' == $pwd) {

mysql_query('TRUNCATE TABLE likesplanetaddonlikedtoday;');
mysql_query('TRUNCATE TABLE likesplanetaddon_start;');
mysql_query("DELETE FROM `likesplanetaddon` WHERE `likes`='0'");

mysql_query("UPDATE `sitestat` SET `online`='17' WHERE `id`='2'");
mysql_query("UPDATE `sitestat` SET `online`='0', `join`='0'  WHERE `id`='3'");
mysql_query("UPDATE `sitestat` SET `youtube`='0'  WHERE `id`=4");

mysql_query("UPDATE `users` SET `age`=`age`+1, `reg_ip`=''");

mysql_query("UPDATE `users` SET `reason`='', `lastip`=''  WHERE `ban`='1'");
mysql_query("UPDATE `users` SET `ban`=`ban`-1 WHERE `ban`>'0'");

mysql_query("UPDATE `adsb` SET `days`=`days`-1 WHERE `days`>'0'");

mysql_query("DELETE FROM `notebyemail` WHERE `sent`='1'");

mysql_query("UPDATE `notes` SET `age`=`age`+1");
mysql_query("DELETE FROM `notes` WHERE `age`>'3'");

mysql_query("UPDATE `user_view` SET `age`=`age`+1");
mysql_query("DELETE FROM `user_view` WHERE `age`>'4'");



$site2 = mysql_query("SELECT * FROM `users` WHERE (`pr` = '1' ) ");
for($j=1; $x = mysql_fetch_object($site2); $j++)
{
mysql_query("UPDATE `facebook` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `fbshare` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `fbsub` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `fbw` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `follow` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `inst` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `linkedin` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `post` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `reverb` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `stumble` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `tweet` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `website` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `youtube` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `ytlike` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
mysql_query("UPDATE `ytdislike` SET `cpc`='10' WHERE (`user`='{$data->id}' AND `cpc` > 10) ");
}


echo "done"; 
exit;
}
else{
	echo "Invalid Access To Cron!";
}
?>



