<?
include('config.php');

if(!isset($data->login)){exit;}

$resultss = "<font color='red'> Error </font>";

foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){exit;}

if(isset($_POST['data11'])){

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < 10; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

$userAdata0 = mysql_query("SELECT * FROM `fast_surf` WHERE (`user_id`='{$data->id}') ");
$verificareNum = mysql_num_rows($userAdata0);

if ($verificareNum == 0) {
mysql_query("INSERT INTO `fast_surf` (user_id, code) VALUES('{$data->id}', '{$str}' )");
$codeconfirmm = "LIKESPLANET";
$alexahitstoday = 0;
} else {
$userAdata = mysql_fetch_object($userAdata0);
$codeconfirmm = $userAdata->code;
$alexahitstoday = $userAdata->hitstoday;
}

$bonus = 1;
if( $alexahitstoday >= 100 ) { $bonus = 1.1; }
if( $alexahitstoday >= 200 ) { $bonus = 1.2;}
if( $alexahitstoday >= 400 ) { $bonus = 1.3;}

mysql_query("UPDATE `fast_surf` SET `code`='{$str}' WHERE `user_id`='{$data->id}'");

if( $_POST['data11'] == $codeconfirmm) {
if (strpos($_SERVER['HTTP_USER_AGENT'],'AlexaToolbar') !== false) {
$addcoins = 0.03 * $bonus;
$addmana = 0.9 * $bonus;
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$addcoins}', `mana`=`mana`+'{$addmana}', `beforeref`=`coins` WHERE `id`='{$data->id}'");
$resultss = "<font color='green' size=4> +" . $addmana . " Mana +" . $addcoins . " Points Added! </font>";
} else {
$addcoins = 0.01 * $bonus;
$addmana = 0.3 * $bonus;
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$addcoins}', `mana`=`mana`+'{$addmana}', `beforeref`=`coins` WHERE `id`='{$data->id}'");
$resultss = "<font color='green' size=4> +" . $addmana . " Mana +" . $addcoins . " Points Added! </font>";
}
mysql_query("UPDATE `fast_surf` SET `hitstoday`=`hitstoday`+1 WHERE `user_id`='{$data->id}'");

}

}

echo $resultss;
?>