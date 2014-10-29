<?php
include('header.php');

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '150' )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `ads` SET `views`=`views`+'149', `points`=`points`-'149' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
</br></br>
<?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '150' )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'149', `points`=`points`-'149' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
<?}
}
?> </center> </br></br> <?


?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `ads` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
</br></br>
<?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
<?}
}
?> </center> </br></br> <?

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `ads` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
</br></br>
<?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
<?}
}
?> </center> </br></br> <?

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `ads` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
</br></br>
<?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
<?}
}
?> </center> </br></br> <?

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `ads` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
</br></br>
<?
$ads2b = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '50' )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'49', `points`=`points`-'49' WHERE `id`='{$adsb->id}'");
?>
<a href="<? echo $adsb->url;?>" target="_blank" >
<? echo $adsb->title;?>
</a>
<?}
}
?> </center> </br></br> <?




?>
<? include('footer.php');?>
