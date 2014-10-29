<?
include('config.php');
if(isset($_POST['id'])){

mysql_query("INSERT INTO `photosdone2` (user_id, site_id, ok, wait, cpc, title, user_owner) VALUES('{$data->id}', '{$_POST['id']}', '3', '0', '0', '{$_POST['title']}', '{$_POST['owner']}'  ) ");

}

?>