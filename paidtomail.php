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
mysql_query("UPDATE `users` SET `ptm`='{$protect['cpc']}' WHERE `id`='{$data->id}'");
$msg = "<div class=\"msg_success\">Setting updated with success!</div>";
}
?>
<body id="tab1"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="paidtomail.php">Earn from Paid Emails</a></li> 
	<li class="tab2"><a href="paidtomailsend.php">Send Paid Emails</a></li> 
</ul>
</div>
<p>&nbsp;</p>

<h1>Earn Coins from Paid Emails</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="points">Setting :</label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="0" <?if($data->ptm == 0){?>selected<?}?>>Do NOT receive Any Paid emails</option>
	<option value="1" <?if($data->ptm == 1){?>selected<?}?>>Yes I like to receive Paid emails</option>
</select></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Update" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>