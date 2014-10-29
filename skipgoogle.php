<?
include('config.php');
if(isset($_POST['data'])){
$x = $_POST['data'];
mysql_query("INSERT INTO `plused` (user_id, site_id) VALUES('{$data->id}', '{$x}')");
mysql_query("UPDATE `google` SET `reports`=`reports`+'1' WHERE `id`='{$x}'");
}

?>