<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

function blockedsites($text) {
    $bannedWords = array('script', 'getElementById') ;
    foreach ($bannedWords as $bannedWord) {
        if (strpos($text, $bannedWord) !== false) {
            return false ;}}
    return true;
   }
   
$replacedText = blockedsites($protectie['url']);
$replacedText2 = blockedsites($protectie['url2']);


if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `post` WHERE `details`='{$protectie['url2']}'");
$verificare = mysql_num_rows($verificare1);


$mobilelink = str_replace('www.', '', $_POST['url2']);
$mobilelink = str_replace('facebook.', 'm.facebook.', $mobilelink );
$mobilelink = str_replace('m.m.facebook', 'm.facebook', $mobilelink );
$mystring01 = file_get_contents($mobilelink); 
$pos00 = strpos($mystring01, "unavailable");
$contentnotav = 0;
if ($pos00 >= 1) {
	$contentnotav = 1;
}

$name0 = $_POST['url2'];
$x110 = explode('fbid=', $name0);
$x1110 = explode('&set=', $x110[1]);
$url0   = 'https://graph.facebook.com/'. urlencode($x1110[0]); 
$mystring01 = file_get_contents($url0);
$pos = strpos($mystring01, 'ak.fbcdn.net');
if ($pos != false) {
$x1102 = explode('ak.fbcdn.net', $mystring01);
$x11102 = explode('.jpg', $x1102[1]);
$myimgurl = preg_replace('/\\\/', '' , 'http://photos-f.ak.fbcdn.net' . $x11102[0] . '.jpg');
} else {
$myimgurl = '';
}

if($verificare > 0) {$message = "Error: Photo you are trying to add is Added by someone else!</br>If you are Post Owner, please Contact us to add."; $message2 = 1;}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `post` (user, post, title, cpc, details, image, target, keep) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}', '{$_POST['url2']}', '{$myimgurl}', '{$protectie['setcountry11']}', '1' ) ");


$message = "Your Photo/Post Added with success!</br>Go to My Photos and Add Points on your photo to get likes!"; $message2 = 2;
}}
?>

<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbpost.php">Like Photos to Earn</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab0"><a href="fbpostadd.php">Add New Photo/Post</a></li> 
	<li class="tab4"><a href="fbpostmy.php">My Photos</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="fbpostadd_safe.php">Add New Photo/Post (Safe Mode)</a></li> 
</ul>
</div>
<div>&nbsp;</div>
<h1>Add Your Facebook Photo/Video/Album/Post</h1>
<div>&nbsp;</div>

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


<p>Here you can Add your Facebook Photos, Videos, Profile Covers and Photos, Posts...etc</p>
</br>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 4px dotted #ccc; padding: 20px; text-align: left;">


<tr><td><label for="title">Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="30" maxlength="30" /></td></tr>

<tr><td><label for="url000"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="url2">URL:</label></td><td width="20"></td><td> 
<input type="text" name="url2" id="url2" value="" size="50" maxlength="200"  />
<a onclick="TINY.box.show({html:'<b>URL = Your Photo Address.</b> </br>Example:</br>https://www.facebook.com/photo.php?fbid=xxxxxxxxx</br>or</br>https://www.facebook.com/my.profile/posts/xxxxxxx</br></br>Open your Photo/Post in a new window, and copy its URL.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>

<tr><td><label for="url000"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="url000">Details:</label></td><td width="20"></td><td>
<p><li>Inform Liker more details, Ask him to leave a comment if you like.</li></p>
</td></tr>

<tr><td><label for="url00"></label></td><td width="20"></td><td><input type="text" name="url" id="url" size="50" maxlength="80" value="Please Like It." /></td></tr>


<tr><td><label for="url000"></label></td><td width="20"></td><td>&nbsp;</td></tr>

<tr><td><label for="url000">Points:</label></td><td width="20"></td><td>
<p><li>How many points you will pay for each like?</li></p>
</td></tr>

<tr><td><label for="points"></label></td><td width="20"></td><td><select name="cpc" id="points">
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
</select>
<a onclick="TINY.box.show({html:'<b>CPC = How many Points you will pay per Like?</b> </br>Setting Higher CPC = Get likes More Faster,</br>But you pay more points to get likes.</br>Setting Lower CPC save your points, but You get likes Slower,</br>Because Likers start liking posts with High CPC first.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>15 cpc</b>, get likes even faster!</font></a><p>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><center><input type="submit" name="add" value="Add  Photo/Post" class="submit" style="width: 270px; height: 38px;"  /></canter></td></tr>
</table></center>

</br>
</br>

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
</select>
<a onclick="TINY.box.show({html:'<b>Target Likes = Filter Likes by Country.</b> </br>We do not recommend to use this, because it Reduces the number of likes x900%.</br> It is better to Add Photo/Post Now and Keep Target Box = Empty = All World.</br> Anyway if you need Likes from USA only, or German only, You can choose from list and Set.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></a>
</p>

<p><input type="text" name="setcountry11" id="setcountry11" value="" size="40" maxlength="70" /></p>
<p>Leave target box Empty to get likes from ALL World.</p>
</center>

</form>


<center>
<p> <input type="submit" name="insert" value="Add Country" class="submit" onclick="AddCountry();" /> </p>
</center>

</br>

<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>

<h1>Want to add your Profile Picture?</h1>
<p>After you make your account Public (<a href="http://www.facebook.com/settings/?tab=privacy&ref=mb" target="_blank">Click here to do</a>)</p>
<p>Open your Profile Picture in New window by using [Ctrl]+Click, and Copy Window URL, It can be copied from your internet browser URL Address.</p>
<p>Try to Open Photo when You are NOT logged in Facebook, It should open if it set Public correctly.</p>
<p>Remember No Firends should be tagged in your Photo/Post.</p>


<script language=javascript>
TINY.box.show({html:'<font color=darkblue>You are using <font size=3><b>Safe mode</b>!</font></br></br><font color=darkblue>This mode allows you to add FB Photos/Albums even if link is broken.</br></br>You can try it, If you do not gain likes,</br>then Pause Photo and Retract coins to use for another.</br></br>If you need any help, Feel free to <a href="contact.php"><b><font color=white>Contact</font></b></a> us.</font>',animate:true,close:true,mask:false,boxid:'error',left:4});

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

<? include('footer.php');?>