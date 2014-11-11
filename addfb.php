<?php
$page_title = "LikesPlanet.com | Add Your Facebook Page to Get Likes";

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

if(preg_match("/\bpages\b/i", $_POST['url'])){
$x110 = explode('/', $_POST['url']);
$name0 = $x110[5];}
else {
$x110 = explode('/', $_POST['url']);
$name0 = $x110[3];
}
if(preg_match("/\bfref\b/i", $name0)){
$x1100090 = explode('?', $name0);
$name0 = $x1100090[0];
}
if(preg_match("/\bref\b/i", $name0)){
$x1100090 = explode('?', $name0);
$name0 = $x1100090[0];
}
$url0   = 'https://graph.facebook.com/'. urlencode($name0); 
$mystring0 = file_get_contents($url0);
$x1103 = explode('likes"', $mystring0);
$x11103 = explode(':', $x1103[1]);
$x111033 = explode(',', $x11103[1]);
$likesnumnum = $x111033[0];

$x1104 = explode('id"', $mystring0);
$x11104 = explode('"', $x1104[1]);
$x111044 = explode('"', $x11104[1]);
$pageid = $x111044[0];

if ($likesnumnum < 1) {
$url0   = 'http://shareyt.com/plugins/fb/getcount.php?url='. $_POST['url']; 
$likesnumnum = file_get_contents($url0);
}
//if ($likesnumnum < 1) {
//$url0   = 'http://socialmediaexplode.com/plugins/fb2/getcount.php?url='. $name0; 
//$likesnumnum = file_get_contents($url0);
//}

function facebook_count($url){
 
    $ch = curl_init("http://graph.facebook.com/daily.developer.online2");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $raw = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($raw);
    return $data;
 
}
$fb_data = facebook_count($_POST['url']);
$likesnumnum = $fb_data->likes;
$verificare = 0;
$verificare1 = mysql_query("SELECT * FROM `facebook` WHERE `facebook`='{$_POST['url']}'");
$verificareA = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `facebook` WHERE `id`='{$str}'");
$verificareB = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `facebook` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

if($verificareA > 0) {
$message = "Error: Page Added before by You or someone else!</br>Click on (My Pages) to see if you added before,</br>Add Points on your page to get more likes.</br>If page not added before by you, Contact us to add."; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Do you want to Add Page Anyway?</br></br>You can try <a href=addfb_safe.php><b><font color=white>Safe Mode</font></b></a> to add page.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if page is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else if($verificareB > 0) {
$message = "Error: Please try again!"; $message2 = 1;
}

else if($verificareC > 500) {
$message = "Error: You can add 500 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if(!preg_match("/http/i", $_POST['url'])){
$message = "Error: HTTP:// is Not included in your URL! Please try again."; $message2 = 1;
}
else if(preg_match("/\bphoto.php\b/i", $_POST['url'])){
$message = "Error: This is FB Photo! Please add it in PHOTOs section."; $message2 = 1;
}
else if(preg_match("/\bposts\b/i", $_POST['url'])){
$message = "Error: This is FB Photo! Please add it in PHOTOs section."; $message2 = 1;
}

else if($likesnumnum < 1) {
$message = "Error: Page should has +1 likes at least.</br>-or- Page URL is NOT Correct? Remove ?ref= ?sk= codes in URL!"; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Are you sure Page URL is Correct ?</br></br>You can try <a href=addfb_safe.php><b><font color=white>Safe Mode</font></b></a> to add page.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if page is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['addpoints'] < 20) {$message = "You should add 20 Points at least for your new page!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Page title can Not be empty!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add page now!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `facebook` (user, facebook, title, cpc, target, top, pageid, id) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}' , '{$protectie['setcountry11']}' , '{$protectie['smartstop']}', '{$pageid}', '{$str}'  ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `facebook`='{$protectie['url']}'"));
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `facebook` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,fb_like,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Added Coins to Facebook page (Likes) Site ID: {$site->id}','addfb.php')");
}
$message = "Page Added with success!"; $message2 = 2;
echo "<script>document.location.href='fbpages.php'</script>"; exit;

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbstdlikes.php">Earn Points</a></li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">My Pages</a></li> 
</ul>
</div>
<h1>Facebook Fan-Page Likes - Add New Page</h1>
<p>Here, You can add your facebook fan pages.</p>
<p>Choosing the best CPC is very important. The higher the CPC chosen the higher you will show up on the list and the more Credits the person liking your pages will recieve, however you will lose more points.</p>


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

<tr><td><label for="title">Page Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="25" /></td></tr>
<tr><td><label for="url">Page URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="" />
<a onclick="TINY.box.show({html:'<b>URL = Your Page Address.</b> </br>Example:</br>http://www.facebook.com/nokia',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>

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
</select>
<a onclick="TINY.box.show({html:'<b>CPC = How many Points you will pay per Like?</b> </br>Setting Higher CPC = Get likes More Faster,</br>But you pay more points to get likes.</br>Setting Lower CPC save your points, but You get likes Slower,</br>Because Likers start liking pages with High CPC first.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>

<? if ($data->pr == 0){ ?>
<p><a href="prem.php"><h1>Upgrade to a "Premium Membership" and unlock 15 cpc, get likes even faster!</h1></a><p>
<? } ?>

<tr><td></td><td></td><td>
<center><iframe id='pagesbeforeii' name="pagesbeforeii" src="getpagesbefore.php?type=fb&cpc=5"
        scrolling="no" frameborder="0"
        style="border:none; width:400px; height:28px"></iframe></center>
</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add now:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<?echo (int) ($data->coins -0.49); ?>"  size="7" maxlength="7" /> <font color='red'>(min = 20)</font>
<a onclick="TINY.box.show({html:'<b>Add Points to Page.</b> </br>You have to Add some Points on your Page to get likes,</br>You can add more points later.</br>You can Retract Points Back from Page to Account Balance later.</br>Page should always have Points to get more likes.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>
<tr><td colspan="2"></td><td>Remember to add points from balance to your Pages to get likes.</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="smartstop">Smart Stop:</label></td><td width="20"></td><td><input type="text" name="smartstop" id="smartstop" value="0"  size="4" maxlength="8" /> (Default = 0)
<a onclick="TINY.box.show({html:'<b>Auto PAUSE Page when Likes = xxx</b> </br>You You can inform system to Pause Page automatically when</br>Actual Likes on Facebook reaches to Chosen number.</br></br>(0) = Do NOT Pause Page automatically.</br>(100) = Page will Auto Pause when it reached to 100 Likes on Facebook.</br>You can Edit this later, and Run page again.</br>* System count Total Likes on Facebook, not only proven by our network.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>


<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Page" class="submit" /></td></tr>


<tr><td colspan="2"></td><td>If you want to set Target fans, Select country below</td></tr>
<tr><td colspan="2"></td><td>and click 'Add Country' before you add page.
<a onclick="TINY.box.show({html:'<b>Target Likes = Filter Likes by Country.</b> </br>We do not recommend to use this, because it Reduces the number of likes x900%.</br> It is better to Add Page now and Keep Target Box = Empty = All World.</br> Anyway if you need Likes from USA only, or German only, You can choose from list and Set.',animate:true,close:true,mask:false,boxid:'success',autohide:0,left:4});" > &nbsp; &nbsp; &nbsp; <img src="img/hlp.png" width="20" height="20" title="Help"></>
</td></tr>
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
<p><input type="text" name="setcountry11" id="setcountry11" value="" size="40" maxlength="70" oninput="RefBefore2(this.value);" /></p>
<p>Leave target box Empty to get likes from ALL World. (x20 Faster)</p>
</center>

</form>

<script language=javascript>
function RefBefore(CPCset) { 
var aaa = "getpagesbefore.php?type=fb&cpc=" + CPCset;
document.getElementById("pagesbeforeii").src = aaa;
}
function RefBefore2(CountryT) { 
var aaa = "getpagesbefore2.php?country=" + CountryT;
document.getElementById("pagesbeforeii2").src = aaa;
}
function AddCountry() {
var myindex = document.getElementById("target").selectedIndex;
var SelValue = document.getElementById("target").options[myindex].value;
if (SelValue != 'WWW') {
document.getElementById("setcountry11").value = document.getElementById("setcountry11").value + SelValue ;
} else {
document.getElementById("setcountry11").value = '' ;
}
RefBefore2(document.getElementById("setcountry11").value);
}
</script>

<center>
<p> <input type="submit" name="insert" value="Add Country" class="submit" onclick="AddCountry();" /> </p>

<iframe id='pagesbeforeii2' name="pagesbeforeii2" src="getpagesbefore2.php?"
        scrolling="no" frameborder="0"
        style="border:none; width:400px; height:28px"></iframe>

</center>

</br>

        
</script>

<? include('footer.php');?>
