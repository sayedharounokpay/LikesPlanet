<?php
include('config.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$id = $get['cpc'];
$type = $get['type'];
if ($type == 'fb') {$page = mysql_query("SELECT * FROM `facebook` WHERE (`cpc`>='{$id}' AND `points`>15 AND `active`='0' AND `target`='') ");}

$ext = mysql_num_rows($page);
?>

<font color='darkgreen'>New user should like <b><? echo $ext;?></b> Pages before liking your page.</font>
