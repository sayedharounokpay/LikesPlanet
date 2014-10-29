<?php
include('config.php');


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];


if('planet2013' == $pwd) {

// ref rally ----------------------
mysql_query("UPDATE `refrally` SET `time`=`time`-1 WHERE (`id` = '1' AND `time` > 0) ");
$siterefrally = mysql_fetch_object( mysql_query("SELECT * FROM `refrally` WHERE `id` = '1' ") );
if( $siterefrally->time == 0) {
	$site2 = mysql_query("SELECT * FROM users ORDER BY `refrally` DESC LIMIT 0, 6");
	for($j=1; $siteme = mysql_fetch_object( $site2 ); $j++) {
		mysql_query("INSERT INTO `refrally` (name, time) VALUES('{$siteme->login}', '{$siteme->refrally}' )");
	}
	mysql_query("UPDATE `users` SET `refrally`='0' ");
	mysql_query("UPDATE `refrally` SET `time`='2016' WHERE (`id` = '1') ");
}
// ----------------------

$promotekeygnn = rand(1000, 9000);
mysql_query("UPDATE `stat` SET `stat`='{$promotekeygnn}' WHERE `id` = '26' ");


$topusernow = mysql_fetch_object(mysql_query("SELECT * FROM `users` ORDER BY `hitstoday` DESC LIMIT 0, 1"));
$siterally = mysql_fetch_object( mysql_query("SELECT * FROM `rally` WHERE `id` = '1' ") );

if( $siterally->time > 1) {
mysql_query("UPDATE `rally` SET `time`=`time`-1 WHERE `id` = '1' ");
}

// New Rally
if( $siterally->time == 1) {
$nextwinner = mysql_fetch_object(mysql_query("SELECT * FROM `users_buy` ORDER BY RAND() LIMIT 0, 1"));
mysql_query("UPDATE `rally` SET `time`='288', `name`='{$nextwinner->login}' WHERE `id` = '1' ");

$userwinners = mysql_query("SELECT * FROM users ORDER BY `hitstoday` DESC LIMIT 0, 5");
for($j=1; $userwin = mysql_fetch_object( $userwinners ); $j++)
  {
  $willearn = 0;
  switch ($j) {
    case '1':
        $willearn = '600';
        break;
    case '2':
        $willearn = '300';
        break;
    case '3':
        $willearn = '150';
        break;
    case '4':
        $willearn = '75';
        break;
    case '5':
        $willearn = '40';
        break;
  }
  mysql_query("UPDATE `users` SET `coins`=`coins`+'{$willearn}' WHERE `id` = '{$userwin->id}' ");
  mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id` = '{$userwin->id}' ");
  $jid = $j + 1;
  $rallywinnername = $userwin->login;
  	if($userwin->id == 32) {$rallywinnername = $siterally->name;}
  mysql_query("UPDATE `rally` SET `name`='{$rallywinnername}', `time`='{$willearn}' WHERE `id` = '{$jid}' ");
  
  $msgrally = "Congratulations! You won " . $willearn . " Points from LikesPlanet Daily Contest!";
  mysql_query("INSERT INTO `notes` (user_id, title, msg, url, alert) VALUES('{$userwin->id}', 'Rally', '{$msgrally}', 'rally.php', '0' ) ");
  }
  
  mysql_query("UPDATE `users` SET `hitstoday`='0' ");
  
mysql_query('TRUNCATE TABLE surfed;');
mysql_query('TRUNCATE TABLE daily;');
mysql_query('TRUNCATE TABLE daily2;');
mysql_query('TRUNCATE TABLE played;');
mysql_query('TRUNCATE TABLE login;');
mysql_query('TRUNCATE TABLE visited;');
mysql_query('TRUNCATE TABLE directlinked;');

}


echo "done"; 
exit;
}
else{
	echo "Invalid Access To Cron!";
}
?>



