<?php
include('headerB.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

if(isset($_POST['add'])){
if($_POST['cpc']=='1'){
	$userr2 = mysql_query("SELECT * FROM `users`");
	for($j=1; $userr = mysql_fetch_object($userr2); $j++){
	mysql_query("INSERT INTO `notes` (user_id, title, msg, url, alert) VALUES('{$userr->id}', '{$protectie['title']}', '{$protectie['note']}', '{$protectie['url']}', '{$protectie['alert']}' ) ");
	}
	$msg = "<div class=\"msg_success\">Note Sent to ALL Members!</div>";
}
else{
mysql_query("INSERT INTO `notes` (user_id, title, msg, url, alert) VALUES('{$protectie['member']}', '{$protectie['title']}', '{$protectie['note']}', '{$protectie['url']}', '{$protectie['alert']}' ) ");
$msg = "<div class=\"msg_success\">Note Sent!</div>";
}
}
?>
<body id="tab1"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="notes.php">Send Notes</a></li> 
</ul>
</div>
<h1>Send Notes</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Note Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="note">Note:</label></td><td width="20"></td><td><input type="text" name="note" id="note" size="40" value="" /></td></tr>
<tr><td><label for="url">URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="" /></td></tr>
<tr><td><label for="cpc">Send To:</label></td><td width="20"></td><td><select name="cpc" id="cpc">
	<option value="0">Specific Member</option>
	<option value="1">All Members</option>
</select></td></tr>
<tr><td><label for="member">Member ID:</label></td><td width="20"></td><td><input type="text" name="member" id="member" size="40" maxlength="150" value="1" /></td></tr>

<tr><td><label for="alert">Note Type:</label></td><td width="20"></td><td><select name="alert" id="alert">
	<option value="0">Normal</option>
	<option value="1">Alert (Cannot Hide)</option>
</select></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Send" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>