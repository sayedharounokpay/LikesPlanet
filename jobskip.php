<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `jobs` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `jobsdone` (job_id, owner, worker, status) VALUES('{$x[0]}', '-1', '{$data->id}', '-1' )");
}}
?>