<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < 10; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
 
function blockedsites($text) {
    $bannedWords = array('socialbirth', 'addmefast', 'youlikehits', 'shareyt', 'likerr', 'netlikes', 'get2gathers', 'freefblike', 'anhits', 'gimmehits', 'clicksocialexchange', 'growsociallikes', 'socialskive', 'hitger', 'wanafans', 'yaa1', 'likesniper', 'like-ex', 'fbtwister', 'seoclerks', 'fanslave', 'addm', 'googleglassessupplier', 'fan-likes', 'socialworld', 'youlikefan', 'atodoweb', 'todagalicia', 'youlikefans', 'likeyou', 'exchanger', 'fiverr', 'shorthit', 'followerslikehits', 'follow', 'socialpromo', 'ewsaly', 'likesasap', 'hitserr', 'advertcash', 'addm.cc') ;
    foreach ($bannedWords as $bannedWord) {
        if (strpos($text, $bannedWord) !== false) {
            return false ;}}
    return true;
   }

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `google` WHERE `google`='{$_POST['url']}'");
$verificare = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `google` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `google` WHERE `id`='{$str}'");
$verificareB = mysql_num_rows($verificare1);

$replacedText = blockedsites($protectie['url']);
$replacedText2 = blockedsites($protectie['title']);

if($verificare > 0) {$message = "Error: Page Added by another user!</br>If you are Page Owner, please Contact us to add."; $message2 = 1;}

else if($verificareC > 100) {
$message = "Error: You can add 100 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if($verificareB > 0) {
$message = "Error: Please try again!"; $message2 = 1;
}

else if ($replacedText === false AND $data->agent == 0) {
$message = 'Sorry, This site is not allowed to be added on this network!'; $message2 = 1;
}

else if ($replacedText2 === false AND $data->agent == 0) {
$message = 'Sorry, This site is not allowed to be added on this network!'; $message2 = 1;
}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['addpoints'] < 25) {$message = "You should add 25 Points at least for your new page!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Page title can Not be empty!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add page now!"; $message2 = 1;}


else{
mysql_query("INSERT INTO `google` (user, google, title, cpc, id) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}', '{$str}' ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `google` WHERE `google`='{$protectie['url']}'"));
mysql_query("INSERT INTO `plused` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `google` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,twitter,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Added Coins to Google Plus (Shares) | Page ID: {$site->id}','addgoogle.php')");
}
$message = "Website Added with success!"; $message2 = 2;

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="googleplus.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addgoogle.php">Add Website</a></li> 
	<li class="tab3"><a href="googlepages.php">My Websites</a></li> 
</ul>
</div>
<h1>Add Website URL</h1>
<p>You can add Websites here to get Google Plus Votes/Shares.</p>
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
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Done"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style=" padding: 20px; text-align: left;">

<tr><td><label for="title">Website Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Website URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="http://" /></td></tr>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="points">Points per Vote (CPC):</label></td><td width="20"></td><td><select name="cpc" id="points">
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
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>15 cpc</b>, get votes/shares even faster!</font></a><p>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="10" maxlength="7" /> (min = 30)</td></tr>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>You have to add only Some of your points on that site.</td></tr>
<tr><td><label for="aaa"></label></td><td width="20"></td><td>You can add/retract points later.</td></tr>
<tr><td><label for="aaa"></label></td><td width="20"></td><td>When site have no points it will have No votes, Even if you have points in balance.</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Website" class="submit"  /> </td></tr>
</table></center>
</form>
<? include('footer.php');?>
