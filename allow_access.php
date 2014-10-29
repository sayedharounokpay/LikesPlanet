<?php
include('header.php');


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$idd = $get['id'];
$code = $get['code'];
$ipp = $get['IP'];

$site12 = mysql_query("SELECT * FROM `users` WHERE (`id` = '{$idd}' AND `code` = '{$code}') LIMIT 0, 1");
$ext = mysql_num_rows($site12);
if($ext > 0){

$site11 = mysql_fetch_object($site12);

mysql_query("UPDATE `users` SET `code`='{$ipp}' WHERE `id`='{$site11->id}'");

	echo "<script>alert('Your account activated again! Please try to login now.'); document.location.href='login.php'</script>"; 
exit;
}
else{
	echo "<script>document.location.href='login.php'</script>";
}
?>



