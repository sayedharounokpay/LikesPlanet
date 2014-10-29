<?
include('config.php');

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");


if(isset($_REQUEST['id'])){


$site = mysql_fetch_object(mysql_query("SELECT * FROM `tweet` WHERE (`id`='{$_POST['id']}' AND `owner`='{$_POST['owner']}' AND `points` > `cpc`) AND `id` NOT IN (SELECT `site_id` FROM `tweeted` WHERE `user_id`='{$data->id}')  "));


mysql_query("INSERT INTO tweeted  VALUES(0,'".$_REQUEST['owner']."','".$_REQUEST['id']."')");

//echo "INSERT INTO tweeted  VALUES(0,'".$_REQUEST['owner']."','".$_REQUEST['id']."')";
if($site->user > 0) {

$finalpagepoints = $site->points - $site->cpc;
if ($finalpagepoints <= $site->cpc) {
$pagehigh = 'tweetpages.php?high=' . $site->id;
$notemsg = 'Ran Out: Your Twitter Tweet (' . $site->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/tweetpages.php?high=' . $site->id;
$notemsg2 = 'Your Twitter Tweet (' . $site->tweet . ') Ran out of points! <br /><br /> Click on link below to add more points and get more tweets.';
$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");

mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your Twitter Tweet Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}


if($site->user == $_POST['owner']){
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site->cpc}'-1, `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$data->id}'");
mysql_query("UPDATE `tweet` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `title`='{$_POST['id']}'");
mysql_query("INSERT INTO `tweeted` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");


if( $data->ref2 >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1, `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$data->id}'");
$refaddnoww = $data->refgive / $referralrate;
if( $refaddnoww >= 1 ){
mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$data->refgive}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$data->ref2}'");
}}

$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'rt', '{$mmillesecc}' )");


mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='13' or `id`='15')");

}

}
}

?>