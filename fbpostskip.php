<?
include('config.php');
if(isset($_POST['id'])){

$site = mysql_fetch_object(mysql_query("SELECT * FROM `post` WHERE `id`='{$_POST['id']}'"));

mysql_query("INSERT INTO `postdone` (user_id, site_id) VALUES('{$data->id}', '{$_POST['id']}'  ) ");

mysql_query("UPDATE `post` SET `reports`=`reports`+1, `points`=`points`-3  WHERE `id`='{$_POST['id']}'");

if ($site->keep == 0){
if ($site->likes <= 6){
if ($site->reports >= 6){
mysql_query("UPDATE `post` SET `active`='1' WHERE `id`='{$_POST['id']}'");
};
};

if ($site->likes >= 5){
if ($site->reports >= $site->likes){
mysql_query("UPDATE `post` SET `active`='1' WHERE `id`='{$_POST['id']}'");
};
};

}
}

?>