<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$pnt = $get['pnt'];
$uid = $get['uid'];
$price = $get['price'];

$msg = "<div class=\"msg_success\" >Thank You! Points will be added to your account in 5 hours.</div>
<div class=\"msg_success\" >If points not added within 8 hours, Please contact us.</div>";

?>

<h1>Thank You</h1>
<? echo $msg;?>

<? include('footer.php');?>