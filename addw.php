<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

    function blockedsites($text) {
    $bannedWords = array('socialbirth', 'likesguru',  'megatraffic', 'addmefast', 'like-hits', 'like-ex', 'likesfast', 'lajkovibalkan', 'addmefast', 'admf', 'youlikehits', 'shareyt', 'likerr', 'netlikes', 'get2gathers', 'freefblike', 'anhits', 'gimmehits', 'clicksocialexchange', 'growsociallikes', 'socialskive', 'hitger', 'wanafans', 'yaa1', 'likesniper', 'like-ex', 'fbtwister', 'seoclerks', 'fanslave', 'addm', 'googleglassessupplier', 'fan-likes', 'socialworld', 'youlikefan', 'atodoweb', 'todagalicia', 'youlikefans', 'likeyou', 'exchanger', 'fiverr', 'shorthit', 'followerslikehits', 'socialpromo', 'bit.ly', 'ewsaly', 'hitserr', 'advertcash', 'addm.cc', 'any.gs', 'wantmorelikes', 'likescowboy', 'socialtrade', 'goo.gl', 'followerslikehits', 'fanporfan', 'follow', 'want2like', 'exchange', 'addme', 'fiverr', 'tiny', 'fans', 'likestwist', 'bringlikes', 'lajkovi', 'global', 'drlikes', 'hypesplanet') ;
	        foreach ($bannedWords as $bannedWord) {
            if (strpos($text, $bannedWord) !== false) {
                return false;
            }
        }
        return true;
    }

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < 10; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	$replacedText = blockedsites($protectie['url']);
    	$replacedText2 = blockedsites($protectie['title']);
    
$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `website` WHERE `website`='{$_POST['url']}'");
$verificare = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `website` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `website` WHERE `id`='{$str}'");
$verificareB = mysql_num_rows($verificare1);

if($verificare > 0) {$message = "Error: Page Added by another user!</br>If you are Page Owner, please Contact us to add."; $message2 = 1;}

else if($verificareC > 200) {
$message = "Error: You can add 200 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if($verificareB > 0) {
$message = "Error: Please try again!"; $message2 = 1;
}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 11 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['addpoints'] < 100) {$message = "You should add 100 Points at least for your new page!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else if ($replacedText === false) {
        $msg = "<div class=\"msg_error\">ERROR: This Site is Blocked! Do NOT add similar sites here.</div>";} 
else if ($replacedText2 === false) {
        $msg = "<div class=\"msg_error\">ERROR: This Site is Blocked! Do NOT add similar sites here.</div>";}

else if($_POST['title'] == "") {$message = "Page title can Not be empty!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add page now!"; $message2 = 1;}


else{
mysql_query("INSERT INTO `website` (user, website, title, cpc, id, target) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}', '{$str}',  '{$protectie['setcountry11']}' ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `website` WHERE `website`='{$protectie['url']}'"));
mysql_query("INSERT INTO `visited` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `website` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,website,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Points Added To Website (Traffic): {$site->id}','addw.php')");
}
$message = "Website Added with success!"; $message2 = 2;

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="website.php">Earn Coins</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addw.php">Add Website</a></li> 
	<li class="tab3"><a href="wpages.php">My Websites</a></li> 
</ul>
</div>
<h1>Add Website URL</h1>
<p>You can add Websites here.</p>
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

<tr><td><label for="title">Website Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Website URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="http://" /></td></tr>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="points">Points per Visit (CPC):</label></td><td width="20"></td><td><select name="cpc" id="points">
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
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>15 cpc</b>, get visitors even faster!</font></a><p>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="10" maxlength="7" /> <font color='red'>(min = 100)</font></td></tr>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>You have to add only Some of your points on that site.</td></tr>
<tr><td><label for="aaa"></label></td><td width="20"></td><td>You can add/retract points later.</td></tr>
<tr><td><label for="aaa"></label></td><td width="20"></td><td>When site have no points it will have No hits, Even if you have points in balance.</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Website" class="submit" style="width: 270px; height: 38px;"  /> </td></tr>
</table></center>

<center>
<p>Target Traffic :  <select name="target" id="target">
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
<p>Leave target box Empty to get traffic from ALL World.</p>
</center>

</form>

<script language=javascript>
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