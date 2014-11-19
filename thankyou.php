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

if($userdata = mysql_query("SELECT * FROM users WHERE id={$uid}")) {
    if($user = mysql_fetch_object($userdata)) {
        mysql_query("INSERT INTO testdb (userid,price,points,date) VALUES ($uid,$price,$pnt,now())");
    }
}

$msg = "<div class=\"msg_success\" >Thank You! Points will be added to your account.</div>
<div class=\"msg_success\" >Note: some payments might take longer to process</div>";

?>

<h1>Thank You</h1>
<? echo $msg;?>

<? include('footer.php');?>