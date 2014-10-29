<?php
include('header.php');


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$code = mysql_real_escape_string($get['code']);


$site12 = mysql_query("SELECT * FROM `users` WHERE (`conf` = '0' AND `code` = '{$code}') LIMIT 0, 1");
$ext = mysql_num_rows($site12);
if($ext > 0){

$site11 = mysql_fetch_object($site12);

mysql_query("UPDATE `users` SET `conf`='1', `code`='' WHERE `id`='{$site11->id}'");

if ($site11->ref2 > 0) {
mysql_query("UPDATE `users` SET `coins`=`coins`, `beforeref`=`coins` WHERE `id`='{$site11->ref2}'");
mysql_query("INSERT INTO `pendingrefers` (user, ref2) VALUES( '{$site11->id}', '{$site11->ref2}' ) ");
}

	echo "<script>alert('Your account confirmed with successful!'); document.location.href='login.php'</script>"; 
exit;
}
else{
	echo "<script>alert('Your account already confirmed!'); document.location.href='login.php'</script>";
}
?>



