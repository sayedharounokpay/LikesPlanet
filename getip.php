<?php
include('header.php');


$site2 = mysql_query("SELECT * FROM `users` WHERE `country`=''");
for($j=1; $site = mysql_fetch_object($site2); $j++) {

$code = $site->IP;
$urlc = 'http://www.infobyip.com/ip-' . urlencode($code) . '.html';
$mystring = file_get_contents($urlc); 
$x1102 = explode('Country</td><td align=', $mystring);
$x11102 = explode('>', $x1102[1]);
$x111022 = explode('<', $x11102[1]);

mysql_query("UPDATE `users` SET `country`='{$x111022[0]}'  WHERE (`id` = '{$site->id}') ");
}

?>



