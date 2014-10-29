<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `youtube` WHERE `youtube`='{$_POST['url']}'");
$verificare = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `youtube` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

if($verificare > 1) {$message = "Error: Video Added by another user!</br>If you are Video Owner, please Contact us to add."; $message2 = 1;}

else if($verificareC > 200) {
$message = "Error: You can add 200 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else if(!preg_match("/\byoutube.com\b/i", $_POST['url'])){$message = "Error: HTTP:// is Not included in your URL! Please try again."; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Video title can Not be empty!"; $message2 = 1;}

else if(preg_match("/feature/i", $_POST['url'])){$message = "ERROR: Do NOT include &feature= in your URL!"; $message2 = 1;}
else if(preg_match("/sns/i", $_POST['url'])){$message = "<div class=\"msg_error\">ERROR: Do NOT include &sns= in your URL!"; $message2 = 1;}
else if(preg_match("/autoplay/i", $_POST['url'])){$message = "<div class=\"msg_error\">ERROR: Do NOT include &autoplay= in your URL!"; $message2 = 1;}
else if(preg_match("/list/i", $_POST['url'])){$message = "<div class=\"msg_error\">ERROR: Do NOT include &list= in your URL!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add video now!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `youtube` (user, youtube, title, cpc) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}' ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `youtube` WHERE (`youtube`='{$protectie['url']}' AND `user`='{$data->id}')"));
mysql_query("INSERT INTO `played` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
if ($site->id > 0) {
mysql_query("UPDATE `youtube` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
}
}
$message = "Video Added with success!"; $message2 = 2;

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="youtube.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addyt.php">Add Video</a></li> 
	<li class="tab3"><a href="ytpages.php">My Videos</a></li> 
</ul>
</div>
<h1>Add YouTube Video URL</h1>
<p>You can only add YouTube vidoes here.</p>

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

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="padding: 20px; text-align: left;">

<tr><td><label for="title">Video Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><label for="url">Video URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="https://" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><label for="points">Points per Play:</label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="2" style="background-color: #FF9999;">2</option>
	<option value="3" style="background-color: #FF9999;">3</option>
	<option value="4" style="background-color: #FF9999;">4</option>
	<option value="5" style="background-color: #9999FF;" selected>5</option>
	<option value="6" style="background-color: #9999FF;">6</option>
	<option value="7" style="background-color: #9999FF;">7</option>
	<option value="8" style="background-color: #99FF99;">8</option>
	<option value="9" style="background-color: #99FF99;">9</option>
	<option value="10" style="background-color: #99FF99;">10</option>
	<? if ($data->pr >0){ ?>
	<option value="11" style="background-color: #FFFF00;">11 [VIP]</option>
	<option value="12" style="background-color: #FFFF00;">12 [VIP]</option>
	<option value="13" style="background-color: #FFFF00;">13 [VIP]</option>
	<option value="14" style="background-color: #FFFF00;">14 [VIP]</option>
	<option value="15" style="background-color: #FFFF00;">15 [VIP]</option>
	<?}?>
</select></td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>15 cpc</b>, get likes even faster!</font></a><p>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add now:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="7" maxlength="7" /> (min = 30)</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Video" class="submit" style="width: 270px; height: 38px;"  /></td></tr>
</table></center>
</form>
<? include('footer.php');?>
