<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `instb` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `instedb` (user_id, site_id) VALUES('{$x[1]}', '{$site->id}')");
mysql_query("UPDATE `instb` SET `skipped`=`skipped`+'1', `points`=`points`-'cpc' WHERE `id`='{$x[0]}'");

if ($site->likes <= 7){
if ($site->skipped >= 7){
mysql_query("UPDATE `instb` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};

if ($site->likes >= 7){
if ($site->skipped >= $site->likes){
mysql_query("UPDATE `instb` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};

}}

?>