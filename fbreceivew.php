<?
include('config.php');
if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `fbw` WHERE (`fbw`='{$x[0]}') AND `id` NOT IN (SELECT `site_id` FROM `wliked` WHERE `user_id`='{$x[1]}')  "));

if($site->id == $x[2]){
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site->cpc}'-1+($LevelNumBon*0.1), `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$x[1]}'");
mysql_query("UPDATE `fbw` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `fbw`='{$x[0]}'");
mysql_query("INSERT INTO `wliked` (user_id, site_id) VALUES('{$x[1]}','{$site->id}')");

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
}}

}
}

mysql_query("UPDATE `sitestat` SET `likes`=`likes`+1 WHERE `id`='3'");

?>