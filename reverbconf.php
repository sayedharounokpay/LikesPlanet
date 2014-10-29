<?
include('config.php');

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

$site21 = mysql_query("SELECT * FROM `reverb` WHERE `id`='{$_POST['id']}'");
$site11 = mysql_fetch_object($site21);

$sitemobile0 = "http://www.reverbnation.com/page_object/page_object_fans/" . $site11->reverb . "?fans_filter=Fan";
$mystring = file_get_contents($sitemobile0); 

$mssssg = '';

$pos = strpos($mystring, $data->reverb);
if ($pos > 1) {
$mssssg = 'yes';

$site21f = mysql_query("SELECT * FROM `reverbed` WHERE (`site_id`='{$_POST['id']}' AND `user_id`='{$data->id}')");
$extf = mysql_num_rows($site21f);
if($extf == 0){

mysql_query("INSERT INTO `reverbed` (user_id, site_id) VALUES('{$data->id}', '{$_POST['id']}' ) ");

mysql_query("UPDATE `reverb` SET `points`=`points`-'{$site11->cpc}', `likes`=`likes`+1   WHERE `id`='{$_POST['id']}'");

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site11->cpc}'-1, `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1' WHERE `id`='{$data->id}'");

if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
}}

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'rn', '{$mmillesecc}' )");


mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='16' or `id`='15')");

}
}
else { $mssssg = 'no';}

echo $mssssg;
?>