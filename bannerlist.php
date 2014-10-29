<?php
include('header.php');

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?

?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '0' AND `active` = '0' AND (`points` > '1') )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'2', `points`=`points`-'2' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?



?> <div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '1' AND `active` = '0' AND (`clx` > '0') )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `adsb` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`isclicks` = '1' AND `active` = '0' AND (`clx` > '0') )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?

?>
<? include('footer.php');?>
