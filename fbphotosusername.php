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
$verificare1 = mysql_query("SELECT * FROM `fbadded` WHERE (`fbn`='{$_POST['coins']}' AND `user`!='{$data->id}') ");
$verificare = mysql_num_rows($verificare1);
if($verificare > 0) {$msg = "
<div class=\"msg_error\">ERROR: This Username is used by Other member!</div>
<div class=\"msg_success\" >If You Are Account Owner Contact us to add.</div>
";}
else if (strlen($_POST['coins']) < 4) {$msg = "
<div class=\"msg_error\">ERROR: Facebook Display Name is Too Short !</div>
<div class=\"msg_error\" >Facebook Display Name should be 4 Letters at least.</div>
";}
else{
mysql_query("UPDATE `users` SET `fbn`='{$protect['coins']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO `fbadded` (fbn, user) VALUES('{$_POST['coins']}', '{$data->id}' ) ");
$msg = "<div class=\"msg_success\">Your Facebook account Added with success!</div>";
}
}
?>
<body id="tab5"> 
<p>&nbsp;</p>

<h1>Add Your Facebook Account</h1>
Enter your FaceBook Account Name you will use to Like Photos.

<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="coins">FaceBook Account Name</label></td><td width="20"></td><td><input type="text" name="coins" id="coins" size="30" maxlength="30" value="<? echo $data->fbn; ?>" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Set Account" class="submit" /></td></tr>
</table>

<h1><font size='5'>How to Get Facebook Account-Name?<font></h1>
</br></br>

<h1><font size='4' color='green'> Method #1<font></h1>
<h1>Add your Display Name on Facebook.</h1>
<h1>Make sure your Display name is ENGLISH.</h1>
<h1>Type your display name Exaclty, like   "Betty M. Moorer"   Not  "betty m. moorer"</h1>
<h1>Otherwise, You will not earn points/money !</h1>
<img src="img/FBName.jpg" border="0" title="Example">

</br></br></br></br>

<h1> or </h1>
<h1><font size='4' color='green'> Method #2<font></h1>
<h1>Open Your Facebook Profile Page.</h1>
<h1>Pickup Username code from URL.</h1>
<h1>Type your Username Exaclty, example "betty.moorer.82"</h1>
<h1>Otherwise, You will not earn points/money !</h1>
<img src="img/FBName2.png" border="0" title="Example">


</center>
</form>
<? include('footer.php');?>