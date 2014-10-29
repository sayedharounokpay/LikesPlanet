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
$verificare1 = mysql_query("SELECT * FROM `reverbadded` WHERE (`reverb`='{$_POST['coins']}' AND `user`!='{$data->id}') ");
$verificare = mysql_num_rows($verificare1);
if($verificare > 0) {$msg = "
<div class=\"msg_error\">ERROR: This Username is used by Other member!</div>
<div class=\"msg_success\" >If You Are Account Owner Contact us to add.</div>
";}
else if (strlen($_POST['coins']) < 4) {$msg = "
<div class=\"msg_error\">ERROR: ReverbNation Username ID is Too Short !</div>
<div class=\"msg_error\" >ReverbNation Username should be 4 Letters at least!</div>
";}
else{
mysql_query("UPDATE `users` SET `reverb`='{$protect['coins']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO `reverbadded` (reverb, user) VALUES('{$_POST['coins']}', '{$data->id}' ) ");
$msg = "<div class=\"msg_success\">Your ReverbNation account Added with success!</div>
<div class=\"msg_success\">Now you can Follow Fans and Earn Points!</div>";
}
}
?>
<body id="tab5"> 
<p>&nbsp;</p>

<h1>ReverbNation Username ID</h1>
Enter your ReverbNation Username ID you will use to follow fans.

<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="coins">ReverbNation Display Name</label></td><td width="20"></td><td><input type="text" name="coins" id="coins" size="30" maxlength="30" value="<? echo $data->reverb; ?>" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Link Account" class="submit" /></td></tr>
</table>

<h1>Add your Username Display on ReverbNation.</h1>
<h1>Go to your Profile and read Username Display.</h1>

</center>
</form>
<? include('footer.php');?>