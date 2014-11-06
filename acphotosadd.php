<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `photos2` WHERE `details`='{$_POST['url2']}'");
$verificare = mysql_num_rows($verificare1);

$name0 = $_POST['url2'];
$x110 = explode('fbid=', $name0);
$x1110 = explode('&set=', $x110[1]);
$url0   = 'https://graph.facebook.com/'. urlencode($x1110[0]). '/likes'; 
$mystring0 = file_get_contents($url0);

if($verificare > 0) {$msg = "
<div class=\"msg_error\">Photo You are trying to add Already Added by another user!</div>
<div class=\"msg_success\">If you are Photo Owner, Contact us to add it.</div>
";}

else if(!preg_match("/\bid\b/i", $mystring0)){$msg = "
<div class=\"msg_error\">Photo Cover should have One Like (at least), Like your photo cover and Try again!</div>
";}

else if(!preg_match("/\bphoto\b/i", $_POST['url2'])){$msg = "
<div class=\"msg_error\">ERROR: Photo URL is Not correct!</div>
";}

else if($_POST['title'] == "") {$msg = "<div class=\"msg_error\">ERROR: Title can't be empty!</div>";}

else{
mysql_query("INSERT INTO `photos2` (user, photo, title, cpc, details) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}', '{$_POST['url2']}' ) ");

$site1 = mysql_fetch_object(mysql_query("SELECT * FROM `photos2` WHERE `details`='{$_POST['url2']}'"));

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `photos2` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site1->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,ac_photo,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Added Points to Photo','acphotosadd.php')");
$msg = "<div class=\"msg_success\">Photo added with success!</div>
<div class=\"msg_success\">Remember to ADD Coins to your Photos!</div>
";}
else{$msg = "<div class=\"msg_success\">Photo added with success!</div>
<div class=\"msg_error\">You don't have enough coins to add for your Photo now!</div>
<div class=\"msg_success\">Remember to ADD Coins to your Photos!</div>";}

}}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="acphotos.php">Like Covers to Earn</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="acphotosadd.php">Add New Cover</a></li> 
	<li class="tab4"><a href="acphotosmy.php">My Covers</a></li> 
</ul>
</div>
<tr><td>&nbsp;</td></tr>
<h1>Add Your Photo Cover</h1>

<? echo $msg;?>
<form method="post">
<center>

<div><img src="img/FBCV2.jpg" border="0" title="Add Your Cover"></div>

<table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="60" maxlength="30" /></td></tr>

<tr><td><label for="url000">URL:</label></td><td width="20"></td><td>
<p><li>Click on your Photo and copy its URL.</li></p>
</td></tr>

<tr><td><label for="url2"></label></td><td width="20"></td><td> 
<input type="text" name="url2" id="url2" value="https://www.facebook.com/photo.php?fbid=" size="60" /></td></tr>
&nbsp;

<tr><td><label for="url000">Details:</label></td><td width="20"></td><td>
<p><li>Inform user more details, Ask him to leave a comment if you like.</li></p>
</td></tr>

<tr><td><label for="url"></label></td><td width="20"></td><td><textarea name="url" style="width:500px;height:150px;">Please Like Photo.
</textarea></td></tr>

<tr><td><label for="url000">Points:</label></td><td width="20"></td><td>
<p><li>How many points you will pay for each like?</li></p>
</td></tr>

<tr><td><label for="points"></label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="13">13</option>
	<option value="15">15</option>
	<option value="18">18</option>
	<option value="20">20</option>
	<option value="25">25</option>
	<option value="30">30</option>
</select></td></tr>

<tr><td><label for="url000">Add:</label></td><td width="20"></td><td>
<p><li>How many points you like to Add Now for this photo?</li></p>
</td></tr>

<tr><td><label for="addpoints"></label></td><td width="20"></td><td>
You can Add/Retract Coins next time.
<input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="40" maxlength="30" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Photo" class="submit2" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>