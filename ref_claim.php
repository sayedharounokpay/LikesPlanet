<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$id = $get['ref'];

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `refclaimed` WHERE (`user`='{$data->id}') ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->ref; }

$page = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `id`='{$id}' AND `ref2`='{$data->id}' AND NOT `id`='{$data->id}' AND `id` NOT IN  (".implode(',', $siteliked4).")  ") );

$message = "Points Already Added to your balance!"; $message2 = 1;

if($page->likes > 99) {
mysql_query("INSERT INTO `refclaimed` (user, ref) VALUES('{$data->id}','{$id}')");

mysql_query("UPDATE `users` SET `coins`=`coins`+100 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$data->id}'");

$message = "+100 Points added to your earning balance!"; $message2 = 2;
}

?>
<body> 
<p>&nbsp;</p>



<h1>Claim Points for Active Referral</h1>

<? echo $msg; ?>
<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>


<? include('footer.php');?>