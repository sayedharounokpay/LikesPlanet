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

else if(!preg_match("/\bfacebook\b/i", $_POST['url2'])){
$message = "Error: Post shoule be located on FaceBook Page or Public human account!"; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Do you want to Add Photo/Post/Album ANYWAY?</br></br>You can try <a href=fbpostadd_safe.php><b><font color=white>Safe Mode</font></b></a> to add any link.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if photo is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else if(strpos($_POST['url2'], "facebook.com/lists") > 1){
$message = "Please do Not add Lists-Follow here!"; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Do you want to Add Photo/Post/Album ANYWAY?</br></br>You can try <a href=fbpostadd_safe.php><b><font color=white>Safe Mode</font></b></a> to add any link.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if photo is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else if($_POST['title'] == "") {$message = "Page title can Not be empty!"; $message2 = 1;}

else if ($replacedText === false) {
$message = 'Sorry, Something wrong, Contact us!'; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Do you want to Add Photo/Post/Album ANYWAY?</br></br>You can try <a href=fbpostadd_safe.php><b><font color=white>Safe Mode</font></b></a> to add any link.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if photo is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}
else if ($replacedText2 === false) {
$message = 'Sorry, Something wrong, Contact us!'; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Do you want to Add Photo/Post/Album ANYWAY?</br></br>You can try <a href=fbpostadd_safe.php><b><font color=white>Safe Mode</font></b></a> to add any link.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if photo is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['addpoints'] < 30) {$message = "You should add 30 Points at least for your new page!"; $message2 = 1;}
else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add page now!"; $message2 = 1;}

else if($contentnotav == 1) {
$message = "ERROR: Your Post/Photo is currently NOT Public!</br><a href='disabled.php'>Click here to solve</a>, or Contact us.</br><a href='fbpostadd_safe.php'>Click here</a> to Add in Safe Mode."; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Do you want to Add Photo/Post/Album ANYWAY?</br></br>You can try <a href=fbpostadd_safe.php><b><font color=white>Safe Mode</font></b></a> to add any link.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if photo is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else{
mysql_query("INSERT INTO `post` (user, post, title, cpc, details, image, target) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}', '{$_POST['url2']}', '{$myimgurl}', '{$protectie['setcountry11']}' ) ");

$site1 = mysql_fetch_object(mysql_query("SELECT * FROM `post` WHERE `details`='{$_POST['url2']}'"));

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1  and  $site1->id >= 1){
mysql_query("UPDATE `post` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site1->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
$message = "Your Photo/Post Added with success!"; $message2 = 2;
} else {
$message = "Sorry, Something wrong happenned!"; $message2 = 1;
}

}}
?>

<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbpost.php">Like Photos to Earn</a></li> 
	<li class="tab3"><a href="fbpostadd.php">Add New Photo/Post</a></li> 
	<li class="tab4"><a href="fbpostmy.php">My Photos</a></li> 
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
<p><b>Just MAKE SURE YOUR POST is PUBLIC.</b> so people no need to add you as a friend to Like your post.</p>
<p>This system is working for Human accounts also, so you CAN add your personal photos to get likes.</p>
<div class="clearer">&nbsp;</div>
<p>First, Before you add any Post/Photo/Video, <b>You should <b>'Turn On Follow'</b>.</b></p>
<p><font color='grey'>Why This is Important? Allow non-friend people to LIKE your personal Photo/Video/Post...etc</font></p>
<p> <a href="https://www.facebook.com/settings?tab=privacy" target="_blank">Click here to Set Profile Public/Anyone.</a> (You have to do this for Once, then add your Photos/Videos in form below.) </p>
<p> <a href="https://www.facebook.com/settings?tab=followers" target="_blank">Set Follow privacy to 'Everyone'</a>, to allow Non-Friends see and like your post.</p>
<p><font color='grey'>After you get All likes, you can restore privacy setting later if you lile.</font></p>
<p><b>MAKE SURE No Friends are Tagged in your Photo/Album/Post.</b> <font color='darkred'>If one of your friends is Tagged with your Photo </font> Then it may be Private to friends tagged on. (You can Tag Friends in your photos/post AFTER you get likes here.)</p>
</br>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="padding: 20px; text-align: left;">


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

<tr><td><label for="url000"></label></td><td width="20"></td><td>&nbsp;</td></tr>


<tr><td><label for="url000">Add:</label></td><td width="20"></td><td>
<p><li>How many points you like to Add Now for this photo/post?</li></p>
</td></tr>

<tr><td><label for="addpoints"></label></td><td width="20"></td><td>
<input type="text" name="addpoints" id="addpoints" value="<?echo (int) ($data->coins -0.49); ?>"  size="8" maxlength="5" /> Points. (min=30)
<a onclick="TINY.box.show({html:'<b>Add Points to Photo/Post.</b> </br>You have to Add some Points on your Photo/Post to get likes,</br>You can add more points later.</br>You can Retract Points Back from Photo to Account Balance later.</br>Photo/Post should always have Points to get more likes.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>

<tr><td><label for="aaa"></label></td><td width="20"></td><td>You have to add Some of your points on that post, You can add/retract points later.</td></tr>
<tr><td><label for="aaa"></label></td><td width="20"></td><td>When post has no points it will has No Likes, Even if you have points in balance.</td></tr>

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
