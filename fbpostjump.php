<?
include('config.php');
if(isset($_POST['id'])){

$site = mysql_fetch_object(mysql_query("SELECT * FROM `post` WHERE `id`='{$_POST['id']}'"));

mysql_query("INSERT INTO `postdone` (user_id, site_id) VALUES('{$data->id}', '{$_POST['id']}'  ) ");

mysql_query("UPDATE `post` SET `jump`=`jump`+1, `points`=`points`-1  WHERE `id`='{$_POST['id']}'");

}

?>