<?
include('config.php');
if(isset($_REQUEST['data'])){
$x = $_REQUEST['data'];
$site = mysql_fetch_object(mysql_query("SELECT * FROM `directlink` WHERE `id`='{$x}'"));
if($site->id != ""){
mysql_query("INSERT INTO `directlinked` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')");
echo "INSERT INTO `directlinked` (user_id, site_id) VALUES('{$data->id}', '{$site->id}')";
mysql_query("UPDATE `directlink` SET `reports`=`reports`+'1', `points`=`points`-`cpc` WHERE `id`='{$x}'");
}

if ($site->reports >= 4){
if ($site->reports > $site->likes){
mysql_query("UPDATE `directlink` SET `active`='1' WHERE `id`='{$x}'");
}
}

}

?>