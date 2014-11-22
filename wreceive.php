<?PHP
include('config.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){exit;}
mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$data->id}'");

if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);

$site = mysql_fetch_object(mysql_query("SELECT * FROM `website` WHERE (`id`='{$x[0]}' AND `user`='{$x[3]}' AND `points` >= `cpc`)  AND `id` NOT IN (SELECT `site_id` FROM `visited` WHERE `user_id`='{$data->id}')"));

 mysql_query("INSERT INTO visited  VALUES(0,{$x[1]},'{$x[0]}')");
 
// echo "INSERT INTO visited  VALUES(0,{$x[1]},'{$x[0]}')";
mysql_query("UPDATE `users` SET `coins`=`coins`-1 WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,website,log,page) VALUES ('.$data->id.',now(),1,1,'Points Deducted From Bad Website View','wreceive.php')");
$ff = time();  // get_file_content(wcalc_time.php);
// $ff2 = 35 + $data->pagelikesnow;
// $ff3 = -15 + $ff;
//if($ff >= $data->pagelikesnow){

if($site->points >= 2){
$finalpagepoints = $site->points - $site->cpc;
if ($finalpagepoints <= $site->cpc) {
$pagehigh = 'wpages.php?high=' . $site->id;
$notemsg = 'Ran Out: Your Website (' . $site->title . ') Ran out of points! Click here to Add.';
$pagehigh2 = 'http://likesplanet.com/wpages.php?high=' . $site->id;
$notemsg2 = 'Your Website (' . $site->website . ') Ran out of points! <br /><br /> Click on link below to add more points and get more traffic.';
$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));

$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");

mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your Website Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
}}

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site->cpc}', `hitstoday`=`hitstoday`+1 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `website` SET `points`=`points`-'{$site->cpc}', `likes`=`likes`+1 WHERE `id`='{$x[0]}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,website,log,page) VALUES ('.$data->id.',now(),{$site->cpc},1,'Points Added From Website View','wreceive.php')");
$mmillesecc = microtime(true);
mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$data->login}', '{$site->title}', 'w', '{$mmillesecc}' )");

mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='17' or `id`='15')");

}

//}

}
?>