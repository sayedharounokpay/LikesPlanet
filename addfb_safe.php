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

if(!preg_match("/http/i", $_POST['url'])){$msg = "<div class=\"msg_error\">ERROR: HTTP is Not included in your URL! Please try again.</div>";}
else if(preg_match("/\bphoto.php\b/i", $_POST['url'])){$msg = "<div class=\"msg_error\">ERROR: This is FB Photo! Please add it in PHOTOS section.</div>";}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['addpoints'] < 20) {$message = "You should add 20 Points at least for your new page!"; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Page title can Not be empty!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add page now!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `facebook` (user, facebook, title, cpc, target, keep, id) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}' , '{$protectie['setcountry11']}' , '1', '{$str}'  ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`facebook`='{$protectie['url']}' AND `user_id`='{$data->id}') "));
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
if ($site->id >= 1){
mysql_query("UPDATE `facebook` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,fb_like,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Added Coins to Facebook (Likes) Site ID: {$site->id}','addfb_safe.php')");
}}
$message = "Page Added with success!"; $message2 = 2;
}}
?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbstdlikes.php">Earn Coins</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">My Pages</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab4"><a href="addfb_safe.php">Add Facebook Page (Safe Mode)</a></li>
</ul>
</div>
<h1>Facebook Fan-Page Likes - Add New Page (Safe Mode)</h1>
<p>You can add your facebook fan pages here.</p>
<p>Choosing the best CPC is very important. The higher the CPC chosen the higher you will show up on the list and the more Credits the person liking your pages will recieve, however you will lose more points.</p>
<p><font color='red'>Do NOT use Symbols or Strange language in your page title, or it will be closed and stop receiving likes.</font></p>

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

<tr><td><label for="title">Page Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Page URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="http://" /></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="points">Points per Like (CPC):</label></td><td width="20"></td><td><select name="cpc" id="points" onchange="RefBefore(this.value);">
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
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>50 cpc</b>, get likes even faster!</font></a><p>
<? } ?>


<tr><td></td><td></td><td>
<center><iframe id='pagesbeforeii' name="pagesbeforeii" src="getpagesbefore.php?type=fb&cpc=10"
        scrolling="no" frameborder="0"
        style="border:none; width:400px; height:28px"></iframe></center>
</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add now:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="7" maxlength="7" /> (min = 20)</td></tr>
<tr><td colspan="2"></td><td>Remember to add points from balance to your Pages to get likes.</td></tr>


<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Page" class="submit" style="width: 270px; height: 38px;"  /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td>If you want to set Target fans, Select country below</td></tr>
<tr><td colspan="2"></td><td>and click 'Add Country' before you add page.</td></tr>
</table></center>

<center>
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
</center>

</form>

<script language=javascript>
TINY.box.show({html:'<font color=darkblue>You are using <font size=3><b>Safe mode</b>!</font></br></br><font color=darkblue>This mode allows you to add FB Pages even if link is broken.</br></br>You can try it, If you do not gain likes,</br>then Pause page and Retract coins to use for another.</br></br>If you need any help, Feel free to <a href="contact.php"><b><font color=white>Contact</font></b></a> us.</font>',animate:true,close:true,mask:false,boxid:'error',left:4});

function RefBefore(CPCset) { 
var aaa = "getpagesbefore.php?type=fb&cpc=" + CPCset;
document.getElementById("pagesbeforeii").src = aaa;
}
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

<center>
<p> <input type="submit" name="insert" value="Add Country" class="submit" onclick="AddCountry();" /> </p>
</center>

</br>

        
</script>

<? include('footer.php');?>