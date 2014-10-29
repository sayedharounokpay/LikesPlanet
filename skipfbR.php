<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$x[0]}'"));
if($site->id != ""){
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$x[1]}', '{$site->id}')");
mysql_query("UPDATE `facebook` SET `skipped`=`skipped`+'1', `points`=`points`-'1' WHERE `id`='{$x[0]}'");

if($data->likes_quality <= 1) {
mysql_query("UPDATE `users` SET `likes_quality`=`likes_quality`+1  WHERE `id`='{$data->id}'");
}

if ($site->keep == '0') {
if ($site->likes <= 7){
if ($site->skipped >= 7){
mysql_query("UPDATE `facebook` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};
if ($site->likes >= 7){
if ($site->skipped >= $site->likes){
mysql_query("UPDATE `facebook` SET `active`='1' WHERE `id`='{$x[0]}'");
};
};
} else {
mysql_query("UPDATE `facebook` SET `points`=`points`-'1', `likes`=`likes`+'1' WHERE `id`='{$x[0]}'");
}


}}

?>