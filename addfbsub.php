<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

 
$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `fbsub` WHERE `fbsub`='{$_POST['url']}'");
$verificare = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `fbsub` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

$url0  = 'http://socialmediaexplode.com/exchange/facebook-followers/getdata.php?url=http://www.facebook.com/'. urlencode($_POST['url']);
$likesnumnum0 = file_get_contents($url0);

if($verificare > 0) {$message = "Error: Profile Added by another user!</br>If you are Page Owner, please Contact us to add."; $message2 = 1;}

else if($verificareC > 200) {
$message = "Error: You can add 200 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if($likesnumnum0 < 0){$message = "Error: Profile should has 1 Follower at least.</br>Please contact us for help."; $message2 = 1;}
else if(preg_match("/ref/", $_POST['url'])){$message = "Error: URL-CODE includes '?ref=' ! Please enter Username CODE alone."; $message2 = 1;}
else if(preg_match("/http/i", $_POST['url'])){$message = "Error: Do NOT Enter FULL URL, Just your Username URL Code."; $message2 = 1;}
else if(preg_match("/\bphoto.php\b/i", $_POST['url'])){$message = "Error: This is FB Photo! Please add it in PHOTOS section."; $message2 = 1;}
else if(preg_match("/#/i", $_POST['url'])){$message = "Error: Site URL is including '#!' , Please correct URL and try again."; $message2 = 1;}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Page title can Not be empty!"; $message2 = 1;}

else if($_POST['addpoints'] < 50) {$message = "You should add 50 Points at least for your new page!"; $message2 = 1;}
else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add page now!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `fbsub` (user, fbsub, title, cpc, target) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}' , '{$protectie['setcountry11']}' ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `fbsub` WHERE `fbsub`='{$protectie['url']}'"));
mysql_query("INSERT INTO `subliked` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `fbsub` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
}
$message = "Profile Added with success!"; $message2 = 2;

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbsubs.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li>
	<li class="tab2"><a href="addfbsub.php">Add Profile</a></li> 
	<li class="tab3"><a href="fbsubpages.php">My Profiles</a></li>  
</ul>
</div>
<h1>Facebook Subscribers - Add New Profile</h1>
<p>You can add your profiles here to get Subscribers.</p>
<p>Choosing the best CPC is very important. The higher the CPC chosen the higher you will show up on the list and the more Credits the person liking your profiles will recieve, however you will lose more points.</p>


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
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 4px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Profile Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="20" maxlength="30" /></td></tr>

<td>&nbsp;</td>

<tr><td><label for="url">Profile Username CODE:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="25" value="" /></td></tr>

<td>&nbsp;</td>
<tr><td> example</td><td width="20"></td><td> <img src="img/AddFBSub.png?a" border="0" title="Example"> </td></tr>

<td>&nbsp;</td>


<tr><td><label for="points">Points per Follow (CPC):</label></td><td width="20"></td><td><select name="cpc" id="points">
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

<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership"</b> and unlock <b>15 cpc</b>, get fans even faster!</font></a><p>

<td>&nbsp;</td>

<tr><td><label for="addpoints">Points to Add:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="4" maxlength="5" /> Points. (min = 50)</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Profile" class="submit" style="width: 270px; height: 38px;"  /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td>If you want to set Target fans, Select country below</td></tr>
<tr><td colspan="2"></td><td>and click 'Add Country' before you add profile.</td></tr>
</table></center>

<center>
<p>Target Likes :  <select name="target" id="target">
	<? 
	$targetlist1 = mysql_query("SELECT * FROM `target` ORDER BY `num` DESC");
	for($jt=1; $targetlist = mysql_fetch_object($targetlist1); $jt++)
	{
	echo "<option value=" . $targetlist->country . ">" . $targetlist->title . "</option>";
	}
	 ?>
</select></p>
<p><input type="text" name="setcountry11" id="setcountry11" value="" size="40" maxlength="70" /></p>
<p>Leave target box Empty to get likes from ALL World.</p>
</center>

</form>

<script language=javascript>
function AddCountry() {
var myindex = document.getElementById("target").selectedIndex;
var SelValue = document.getElementById("target").options[myindex].value;
document.getElementById("setcountry11").value = document.getElementById("setcountry11").value + SelValue ;
}
</script>

<center>
<p><input type="submit" name="insert" value="Add Country" class="submit" onclick="AddCountry();" /></p>
</center>
</script>

<? include('footer.php');?>