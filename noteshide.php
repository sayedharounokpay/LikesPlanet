<?
include('config.php');
if(isset($_POST['id'])){
$x = mysql_fetch_object(mysql_query("SELECT * FROM `notes` WHERE `id`='{$_POST['id']}' "));
if($x->active == "0"){
mysql_query("UPDATE `notes` SET `active`=1 WHERE `id`='{$_POST['id']}'");
mysql_query("DELETE FROM `notes` WHERE `id`='{$_POST['id']}'");

echo 'Done';
}
else{ echo 'Already Done';}
}

?>