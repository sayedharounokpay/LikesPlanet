<?
include('config.php');
if(isset($_REQUEST['data'])){
$x = explode('---', $_REQUEST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `tweet` WHERE `id`='{$x[0]}'"));

mysql_query("INSERT INTO `tweeted` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
mysql_query("UPDATE `tweet` SET `skipped`=`skipped`+'1', `points`=`points`-'1' WHERE `id`='{$x[0]}'");

if ($site->likes <= 7){
if ($site->skipped >= 7){
mysql_query("UPDATE `tweet` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};

if ($site->likes >= 7){
if ($site->skipped >= $site->likes){
mysql_query("UPDATE `tweet` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};

}

?>