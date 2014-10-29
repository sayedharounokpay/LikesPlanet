<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$msg1 = "<div class=\"msg_success\" >Thank You for choosing LikesASAP to make your future sales!</div>";
$msg2 = "<div class=\"msg_success\" >We will contact you within 3 days to sort files based on your needs, Feel free to contact us as well.</div>";

?>

<h1>Thank You</h1>

<? echo $msg1;?>
<? echo $msg2;?>

<? include('footer.php');?>