<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(isset($_POST['add'])){

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `twadded` WHERE (`twitter`='{$_POST['coins']}' AND `user`!='{$data->id}') ");
$verificare = mysql_num_rows($verificare1);
if($verificare > 0) {$msg = "
<div class=\"msg_error\">ERROR: This Username is used by Other member!</div>
<div class=\"msg_success\" >If You Are Account Owner Contact us to add.</div>
";}
else if (strlen($_POST['coins']) < 4) {$msg = "
<div class=\"msg_error\">ERROR: Twitter Username is Too Short !</div>
<div class=\"msg_error\" >Twitter Username should be 4 Letters at least.</div>
";}
else{
mysql_query("UPDATE `users` SET `twitter`='{$protect['coins']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO `twadded` (twitter, user) VALUES('{$_POST['coins']}', '{$data->id}' ) ");
$msg = "<div class=\"msg_success\">Your Twitter account Added with success!</div>";
}
}
?>
<body id="tab5"> 
<p>&nbsp;</p>

<h1>Twitter Username</h1>
Enter your Twitter Username you will use to Follow Profiles.

<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="coins">Twitter Username:</label></td><td width="20"></td><td><input type="text" name="coins" id="coins" size="30" maxlength="30" value="<? echo $data->twitter; ?>" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Set Account" class="submit" /></td></tr>
</table>

<h1>Add your Username code from Twitter. (Pickup from Profile URL)</h1>

</center>
</form>
<? include('footer.php');?>