<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `google` WHERE `google`='{$x[0]}'"));
if($site->id > 0){
mysql_query("UPDATE `google` SET `reports`=`reports`+'1' WHERE `google`='{$x[0]}'");
mysql_query("UPDATE `users` SET `unlikes`=`unlikes`+1, `coins`=`coins`-'{$site->cpc}'  WHERE `id`='{$x[1]}'");
}

}

?>