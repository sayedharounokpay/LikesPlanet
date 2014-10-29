<?php
include('config.php');


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];


if('planet2013' == $pwd) {


// Ref Rally ------------------
//$site2 = mysql_query("SELECT * FROM `refrally` ORDER BY id");
//$xr = mysql_fetch_object($site2);
//$randdd3 = rand(1,100);
//$randdddd = 1;
//if ($randdd3 >= 0) {
//mysql_query("UPDATE `users` SET `refrally`=`refrally`+'{$randdddd}' WHERE `login`='{$xr->name}'");
//}

//$xr = mysql_fetch_object($site2);
//$randdd3 = rand(1,100);
//if ($randdd3 >= 0) {
//mysql_query("UPDATE `users` SET `refrally`=`refrally`+'{$randdddd}' WHERE `login`='{$xr->name}'");
//}

//$xr = mysql_fetch_object($site2);
//$randdd3 = rand(1,100);
//if ($randdd3 >= 50) {
//mysql_query("UPDATE `users` SET `refrally`=`refrally`+'{$randdddd}' WHERE `login`='{$xr->name}'");
//}
// ------------------



mysql_query('TRUNCATE TABLE rallydaily;');

mysql_query('TRUNCATE TABLE log_ip;');

mysql_query("UPDATE `users` SET `coins`=`coins`-5, `refgive`=`refgive`-20 WHERE `likes_quality` <= -1 ");
mysql_query("UPDATE `users` SET `likes_quality`=`likes_quality`+3 WHERE `likes_quality` <= -1 ");

echo "done"; 
exit;
}
else{
	echo "Invalid Access To Cron!";
}
?>



