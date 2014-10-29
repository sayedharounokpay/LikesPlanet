<?php
include('config.php');


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];


if('planet2013' == $pwd) {

mysql_query("UPDATE `users` SET `reg_h`=`reg_h`-1 WHERE `reg_h`>'0'");
mysql_query("UPDATE `users` SET `log_h`=`log_h`-1 WHERE `log_h`>'0'");

mysql_query("UPDATE `surf` SET `hits_this_hour`='0'");


$site2 = mysql_query("SELECT * FROM `users` WHERE `reg_h` > '1'");
$ext = mysql_num_rows($site2);
$ext = $ext + 100;
mysql_query("UPDATE `stat` SET `stat`='{$ext}' WHERE (`id`='20') ");

$site2 = mysql_query("SELECT * FROM `users` WHERE `log_h` > '1'");
$ext = mysql_num_rows($site2);
$ext = $ext + 100;
mysql_query("UPDATE `stat` SET `stat`='{$ext}' WHERE (`id`='25') ");



$site2 = mysql_query("SELECT * FROM `pendingrefers`");
for($j=1; $site = mysql_fetch_object($site2); $j++)
{
$realuser = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));
if ($realuser->likes >= 6) {
mysql_query("UPDATE `users` SET `coins`=`coins`+10, `beforeref`=`coins`, `refrally`=`refrally`+'1', `ref`=`ref`+'1' WHERE `id`='{$realuser->ref2}'");
mysql_query("DELETE FROM `pendingrefers` WHERE `user`='{$site->user}'");
}
}

mysql_query("UPDATE `alexagoogle` SET `life`=`life`-'1' WHERE (`life` > '0') ");



$site2 = mysql_fetch_object(mysql_query("SELECT * FROM last_hits ORDER BY `id` DESC LIMIT 1"));
$killbeforethis = -20 + $site2->id;
mysql_query("DELETE FROM `last_hits` WHERE `id`<'{$killbeforethis}'");


mysql_query("UPDATE `fast_surf` SET `age`=`age`+1");
mysql_query("DELETE FROM `fast_surf` WHERE `age`>'14'");

mysql_query("UPDATE `pendingrefers` SET `age`=`age`+1");
mysql_query("DELETE FROM `pendingrefers` WHERE `age`>'1'");

mysql_query("DELETE FROM `ref_ip`");

echo "done"; 
exit;
}
else{
	echo "Invalid Access To Cron!";
}
?>



