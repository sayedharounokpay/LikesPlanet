<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$msg = "<div class=\"msg_success\" >Thank You!</div>";

echo "<script>document.location.href='index.php'</script>";
?>

<h1>Thank You</h1>
<? echo $msg;?>

<? include('footer.php');?>