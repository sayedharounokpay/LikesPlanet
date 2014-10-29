<?php
include('config.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$cntr = $get['country'];

$x110 = explode(')(', $cntr);

foreach($x110 as $word){
$page = mysql_query("SELECT `id` FROM `users` WHERE (`log_h`>'0' AND `country` LIKE '%{$word}%') ");
$ext = $ext + mysql_num_rows($page);
}

?>

<font color='darkgreen'> ~ <b><? echo number_format($ext * 0.8);?></b> Likes within 24 hours. (or less)</font>
