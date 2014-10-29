<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `facebook`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$x[1]}','{$site->id}')");
}}


mysql_query("UPDATE `sitestat` SET `hits`=`hits`+1, `likes`=`likes`+'1'  WHERE `id`='1'");

?>