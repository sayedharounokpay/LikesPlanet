<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$splitarray = explode('?v=', $_POST['url']);
$videoname = $splitarray[1];

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `ytlike` WHERE `ytlike`='{$videoname}'");
$verificare = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `ytlike` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

if($verificare > 0) {
$message = "Error: Video Added by another user!</br>If you are Video Owner, please Contact us to add."; $message2 = 1;
}

else if($verificareC > 200) {
$message = "Error: You can add 200 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if(!preg_match("/http/i", $_POST['url'])){
$message = "Error: HTTP:// is Not included in your URL! Please try again."; $message2 = 1;
}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['addpoints'] < 30) {$message = "You should add 30 Points at least for your new video!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Video title can Not be empty!"; $message2 = 1;}

else if(preg_match("/feature/i", $_POST['url'])){$message = "ERROR: Do NOT include &feature= in your URL!"; $message2 = 1;}
else if(preg_match("/sns/i", $_POST['url'])){$message = "<div class=\"msg_error\">ERROR: Do NOT include &sns= in your URL!"; $message2 = 1;}
else if(preg_match("/autoplay/i", $_POST['url'])){$message = "<div class=\"msg_error\">ERROR: Do NOT include &autoplay= in your URL!"; $message2 = 1;}
else if(preg_match("/list/i", $_POST['url'])){$message = "<div class=\"msg_error\">ERROR: Do NOT include &list= in your URL!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add video now!"; $message2 = 1;}

else if($videoname == ""){$message = "Video URL Address is NOT correct!"; $message2 = 1;}

else{

$splitarray = explode('?v=', $_POST['url']);
$videoname = $splitarray[1];

if ($videoname != "") {
mysql_query("INSERT INTO `ytlike` (user, ytlike, title, cpc, target, top) VALUES('{$data->id}', '{$videoname}', '{$protectie['title']}', '{$protectie['cpc']}' , '{$protectie['setcountry11']}' , '{$protectie['smartstop']}'  ) ");
}

// Add my page to Liked

$site = mysql_fetch_object(mysql_query("SELECT * FROM `ytlike` WHERE (`ytlike`='{$videoname}' AND `user`='{$data->id}')"));
mysql_query("INSERT INTO `ytliked` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
if ($site->id > 0) {
mysql_query("UPDATE `ytlike` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,yt_like,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Points Added To Youtube (Likes): {$site->id}','addytlike.php')");
}}
$message = "Video Added with success!"; $message2 = 2;

}}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="ytlike.php">Earn Points</a></li> 
	<li class="tab3"><a href="addytlike.php">Add Video</a></li> 
	<li class="tab4"><a href="ytlikepages.php">My Videos</a></li> 
</ul>
</div>
<h1>Add YouTube Video</h1>
<p>You can add your YouTube Videos for Likes here.</p>

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

<tr><td><label for="title">Video Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="25" /></td></tr>
<tr><td><label for="url">Video URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="43" value="https://www.youtube.com/watch?v=" /></td></tr>



<tr><td><label for="points">Points per Like (CPC):</label></td><td width="20"></td><td><select name="cpc" id="points" >
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

<? if ($data->pr == 0){ ?>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership"</b> and unlock <b>15 cpc</b>, get likes even faster!</font></a><p>
<? } ?>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add now:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="7" maxlength="7" /> (min = 30)</td></tr>
<tr><td colspan="2"></td><td>Remember to add points from balance to your Videos to get likes.</td></tr>


<tr><td><label for="smartstop">Smart Stop:</label></td><td width="20"></td><td><input type="text" name="smartstop" id="smartstop" value="0"  size="40" maxlength="8" /></td></tr>
<tr><td colspan="2"></td><td>(0) means Do Not Stop automatically.</td></tr>
<tr><td colspan="2"></td><td>(100) means Stop when video reach 100 real likes on YouTube.</td></tr>
<tr><td colspan="2"></td><td>* TOTAL Likes, NOT LikesPlanet likes only.</td></tr>




<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Video" class="submit" /></td></tr>

<tr><td colspan="2"></td><td>If you want to set Target fans, Select country below</td></tr>
<tr><td colspan="2"></td><td>and click 'Add Country' before you add page.</td></tr>
</table>


<p>Target Likes :  <select name="target" id="target">
	<? 
	$targetlist1 = mysql_query("SELECT * FROM `target` ORDER BY `num` DESC");
	echo "<option value=WWW>All World</option>";
	for($jt=1; $targetlist = mysql_fetch_object($targetlist1); $jt++)
	{
	echo "<option value=" . $targetlist->country . ">" . $targetlist->title . "</option>";
	}
	 ?>
</select></p>
<p><input type="text" name="setcountry11" id="setcountry11" value="" size="40" maxlength="70" /></p>
<p>Leave target box Empty to get likes from ALL World.</p>


</form>

<script language=javascript>
function AddCountry() {
var myindex = document.getElementById("target").selectedIndex;
var SelValue = document.getElementById("target").options[myindex].value;
if (SelValue != 'WWW') {
document.getElementById("setcountry11").value = document.getElementById("setcountry11").value + SelValue ;
} else {
document.getElementById("setcountry11").value = '' ;
}
}
</script>


<p> <input type="submit" name="insert" value="Add Country" class="submit" onclick="AddCountry();" /> </p>


</br>

        
</script>

<? include('footer.php');?>
