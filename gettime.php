<?
include('config.php');

$ff = time();
echo time();

mysql_query("UPDATE `users` SET `pagelikesnow`='{$ff}'  WHERE `id`='{$data->id}'");

?>