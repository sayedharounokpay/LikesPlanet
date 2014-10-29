<?php
include('header.php');

$totaltax = 0;
$totaltax1 = 0;
$totaltax2 = 0;

$site2 = mysql_query("SELECT * FROM `website` WHERE (`active` = '0' AND `points` > `cpc`)");
for($j=1; $site = mysql_fetch_object($site2); $j++){
$totaltax1 = $totaltax1 + ($site->cpc * 2);
}

$site2 = mysql_query("SELECT * FROM `youtube` WHERE (`active` = '0' AND `points` > `cpc`)");
for($j=1; $site = mysql_fetch_object($site2); $j++){
$totaltax2 = $totaltax2 + ($site->cpc * 2);
}

$totaltax = $totaltax1 + $totaltax2;

echo $totaltax1; echo '</br>';
echo $totaltax2; echo '</br>';
echo $totaltax;

?>