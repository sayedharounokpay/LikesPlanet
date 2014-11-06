<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){
 
$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `surf` WHERE `surf`='{$_POST['url']}'");
$verificare = mysql_num_rows($verificare1);
if($verificare > 0) {$message = "Error: Profile Added by another user!</br>If you are Profile Owner, please Contact us to add."; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Profile title can Not be empty!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `surf` (user, surf, title, perhour) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['perhour']}' ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `surf` WHERE `surf`='{$protectie['url']}'"));

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>0){
mysql_query("UPDATE `surf` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,website,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Points Added To Website (Visits): {$site->id}','addsurf.php')");
$message = "Website Added with success!"; $message2 = 2;
}
}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="surf.php">Earn Points to Promote</a></li> 
	<li class="tab2"><a href="addsurf.php">Add Website to Promote</a></li> 
	<li class="tab3"><a href="surfpages.php">My Websites</a></li> 
</ul>
</div>
<h1>Add Website URL</h1>
<p>You can add Websites here, another users will promote your site.</p>

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

<tr><td><label for="title">Website Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Website URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="200" value="http://" /></td></tr>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="7" maxlength="7" /></td></tr>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>You have to add Some of your points on that site, You can add/retract points later.</td></tr>
<tr><td><label for="aaa"></label></td><td width="20"></td><td>Unique Visit costs 0.25 Point only.</td></tr>
<tr><td><label for="aaa"></label></td><td width="20"></td><td>When site have no points it will have No hits, Even if you have points in balance.</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="perhour">Visits per Hour:</label></td><td width="20"></td><td><input type="text" name="perhour" id="perhour" value="0"  size="7" maxlength="7" /> (0 = Unlimited)</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Website" class="submit" /></td></tr>
</table></center>
</form>
<center>
<h1>Do you want FREE traffic?</h1>

Likesplanet shows you an EASY and FREE way to get over 5k daily visitors to your website/blog!</br></br>

<a target="_blank" href="https://hitleap.com/by/scriptsic"><img alt="Free Traffic Exchange" src="http://hitleap.com/assets/banner.png" style="border: 0px"></a></br></br>

step 1: click the banner above and register</br></br>

step 2: install the autosurf software provided after registration</br></br>

step 3: run the software to earn points automatically</br></br>

step 4: add your websites/pages</br></br>

Congratulations! You are now getting FREE traffic!</br></br>
</center>

<? include('footer.php');?>
