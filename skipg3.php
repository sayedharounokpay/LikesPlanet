<?
include('config.php');
foreach($_GET as $key => $value) {
	$_GET[$key] = filter($value);
}

if(isset($_GET['site'])){

$site = mysql_fetch_object(mysql_query("SELECT * FROM `google` WHERE `google`='{$_GET['site']}'"));
if($site->id > 0){
mysql_query("UPDATE `google` SET `reports`=`reports`+'1' WHERE `google`='{$_GET['site']}'");
mysql_query("UPDATE `users` SET `unlikes`=`unlikes`+1, `coins`=`coins`-'{$site->cpc}'-1  WHERE `id`='{$data->id}'");

echo "<font color='red'><b>Un-Plused !</b></font>";
}

}

?>