<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

$name0 = $_GET['userid'];
mysql_query("UPDATE `users` SET `unlikes`=`unlikes`+1, `coins`=`coins`-20 WHERE (`id`='{$name0}')");

?>

<b><font color='red' size='3'> Unliked! </font></b>