<?php
$page_title = "LikesPlanet.com | Claim Daily Bonus Points";
$meta_description = "Free Facebook Likes - Get Photo Likes - YouTube Dislikes - Website Traffic - Twitter Followers - Facebook Followers";
$meta_keywords = "Facebook Likes, Free Photo Likes, Votes, Followers, YouTube Dislikes, Exchange, Plays, Views, Traffic, Social Media Exchanger";

include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `daily` WHERE `userid`='{$data->id}'");
$verificare = mysql_num_rows($verificare1);
if($verificare > 0) {$message = "ERROR: You already claimed bonus points today!</br>You can visit this page everyday to get more points."; $message2 = 1;}

else if ($data->hitstoday >= 15){
mysql_query("UPDATE `users` SET `coins`= `coins` + 50 WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO `daily` (userid) VALUES( '{$data->id}' ) ");
$message = "Points added to your balance!"; $message2 = 2;
}
else{
$message = "ERROR: You have to do 15 Hits at least to earn daily bonus points!</br>Please do more likes/hits and try again."; $message2 = 1;
}

}

if(isset($_POST['add2'])){
$mysql_num_rows = 0;
$verificare12 = mysql_query("SELECT * FROM `daily2` WHERE `userid`='{$data->id}'");
$verificare2 = mysql_num_rows($verificare12);
if($verificare2 > 0) {$message = "ERROR: You already claimed bonus points today!</br>You can visit this page everyday to get more points."; $message2 = 1;}
else if ($data->hitstoday >= 100){
mysql_query("UPDATE `users` SET `coins`= `coins` + 150 WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `beforeref`= `coins`  WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO `daily2` (userid) VALUES( '{$data->id}' ) ");
$message = "Points added to your balance!"; $message2 = 2;
}
else{
$message = "ERROR: You have to do 100 Hits at least to earn daily bonus points!</br>Please do more likes/hits and try again."; $message2 = 1;
}}

?>
<body id="tab2"> 
<div>
</div>
<h1>Claim Daily Bonus Points</h1>
<div class="clearer">&nbsp;</div>



<p>Login Daily, Do 15 likes/hits, click button below to earn Bonus Points!</p>
<p>You made <b> <? echo $data->hitstoday; ?> </b> Hits today.</p>


<? echo $msg; ?>
<? if ($message2 == 1) {?>

<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>

<? } ?>
<? if ($message2 == 2) {?>

<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>

<? } ?>

<form method="post">

<table cellpadding="0" cellspacing="0" border="0" class="form" style="padding: 20px; text-align: left;">
<tr><td><input type="submit" name="add" value="Get 50 Daily Points" class="submit" style="width: 250px;" /></td></tr>
</table>

</form>


</center>
<h1>Bigger Daily Bonus:</h1>

<p>Do 100 Hits to win +150 Extra Points!</p>
<form method="post">
<table cellpadding="0" cellspacing="0" border="0" class="form" style="padding: 20px; text-align: left;">
<tr><td><input type="submit" name="add2" value="Get 150 Daily Points" class="submit" style="width: 250px;" /></td></tr>
</table>

</form>


<h1>Please Vote for LikesPlanet Daily:</h1>

<p><a href="http://www.emoneyspace.com/site_list.php?word=likesplanet" target="_blank"> Click here to Vote for LikesPlanet. </a></p>



<? include('footer.php');?>
