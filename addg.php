<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
foreach($_POST as $key => $value) {
	$_POST[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `google` WHERE `google`='{$_POST['url']}'");
$verificare = mysql_num_rows($verificare1);
 
$verificare1 = mysql_query("SELECT * FROM `google` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

if($verificare > 0) {$msg = "
<div class=\"msg_error\">ERROR: Site Added by other user!</div>
<div class=\"msg_success\" >If you're Site Owner Contact us to add.</div>
";}

else if($verificareC > 200) {
$message = "Error: You can add 200 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if($_POST['cpc'] < 2) {$msg = "<div class=\"msg_error\">ERROR: CPC Problem!</div>";}
else if($_POST['cpc'] > 60) {$msg = "<div class=\"msg_error\">ERROR: CPC Problem!</div>";}
else if($_POST['title'] == "") {$msg = "<div class=\"msg_error\">ERROR: Title can't be empty!</div>";}


else{
mysql_query("INSERT INTO `google` (user, google, title, cpc) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}' ) ");

// Add my site to Plused
$site = mysql_fetch_object(mysql_query("SELECT * FROM `google` WHERE `google`='{$protectie['url']}'"));
mysql_query("INSERT INTO `plused` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `google` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
$msg = "<div class=\"msg_success\">Site added with success!</div>
<div class=\"msg_success\">Remember to ADD Coins to your Site!</div>
";}
else{$msg = "<div class=\"msg_success\">Site added with success!</div>
<div class=\"msg_error\">You don't have enough coins to add for your site!</div>
<div class=\"msg_success\">Remember to ADD Coins to your Site!</div>";}

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="google.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addg.php">Add Website</a></li> 
	<li class="tab3"><a href="gpages.php">Your Websites</a></li> 
</ul>
</div>
<h1>Add Website URL</h1>
<p>You can add websites here to get Google Plus.</p>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Site Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Site URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="http://" /></td></tr>
<tr><td><label for="points">Points to Give:</label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<? if ($data->pr >0){ ?>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="20">20</option>
	<option value="25">25</option>
	<option value="30">30</option>
	<option value="35">35</option>
	<option value="40">40</option>
	<option value="45">45</option>
	<option value="50">50</option>
	<?}?>
</select></td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>50 cpc</b>, get likes even faster!</font></a><p>

<tr><td><label for="addpoints">Points to Add:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="40" maxlength="30" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>