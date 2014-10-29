<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){



function blockedsites($text) {
    $bannedWords = array('socialbirth', 'socialexchangelab') ;
    foreach ($bannedWords as $bannedWord) {
        if (strpos($text, $bannedWord) !== false) {
            return false ;}}
    return true;
   }


$replacedText = blockedsites($protectie['adr']);

$cashoutadrs = mysql_query("SELECT * FROM `cashout` WHERE (`adr`='{$protectie['adr']}' AND `id` != '{$data->id}') ");
$cashoutadrsnum = mysql_num_rows($cashoutadrs);

$cashoutadrsB = mysql_query("SELECT * FROM `cashout` WHERE (`adr`='{$protectie['adr']}' AND `id` = '{$data->id}') ");
$cashoutadrsnumB = mysql_num_rows($cashoutadrsB);

if($data->bought=="1")
{
$message = "ERROR: you are not allowed to withdraw because you have bought points."; $message2 = 1;

}else if($cashoutadrsnum > 0 AND $cashoutadrsnumB == 0) {$message = "ERROR: Sorry, This Payout Address is used by Another user! </br> If you think this is not correct, Feel free to contact us."; $message2 = 1;}

else if ($replacedText === false) {
$message = 'Sorry, Problem happened in making your request, Please contact us!'; $message2 = 1;
}

else if($protectie['adr'] == '') {$message = "ERROR: Enter Payment Address."; $message2 = 1;}

else if($data->conf == 99) {$message = "ERROR: Your Email Address is Not confirmed!</br>Try to send Activation Code again, or <a href='contact.php'>Contact us</a> to activate your account.</br><a href='reconfirm.php'>Click here to Re-Send confirmation code to your email.</a>"; $message2 = 1;}

else if($data->age < 0) {$message = "ERROR: Your account age is less than 2 days!</br>Please try again next days."; $message2 = 1;}

else if($data->pass == "asteroidsA@1") {$message = "ERROR: You are using Multi Accounts! Sorry."; $message2 = 1;}
else if($data->multi > 0) {$message = "ERROR: Your account reported as Hacker/Unliker, Sorry.</br>-OR-</br>You are using Multi Accounts.</br>If you see this is not fair, contact us."; $message2 = 1;}

else if($data->hitstoday < 8) {$message = "ERROR: You should do 8 Likes/Hits today before being able to cashout!"; $message2 = 1;}

else if($data->likes < 40) {$message = "ERROR: You should do 40 Likes before being able to cashout!"; $message2 = 1;}

else if($protectie['cash']*$coinsdollar> $data->coins) {$message = "ERROR: You do not have enough money in your account balance."; $message2 = 1;}



else {

if($_POST['meth']=='ap') {
if($protectie['cash']>=2) {
$visitoripad = VisitorIP();
$urlip   = 'http://api.hostip.info/get_html.php?ip='. urlencode($visitoripad); 
$dataip  = file_get_contents($urlip); 

mysql_query("INSERT INTO `cashout` (id, adr, cash, method, date, country) VALUES('{$data->id}', '{$protectie['adr']}', '{$protectie['cash']}', '{$protectie['meth']}' , NOW(), '{$dataip}' ) ");
mysql_query("UPDATE `users` SET `coins`= '{$data->coins}' - '{$protectie['cash']}' *$coinsdollar WHERE `id`='{$data->id}'");
$message = "Payout request done with success!</br>Please allow 5 days to send your money.</br>You can Review your Cashout History."; $message2 = 2;
}

else {$message = "ERROR: Minimum payout for Payza is $2 !"; $message2 = 1;}
}


if($_POST['meth']=='pp') {
if($protectie['cash']>=2) {
$visitoripad = VisitorIP();
mysql_query("INSERT INTO `cashout` (id, adr, cash, method, date) VALUES('{$data->id}', '{$protectie['adr']}', '{$protectie['cash']}', '{$protectie['meth']}' , NOW() ) ");
mysql_query("UPDATE `users` SET `coins`=`coins` - '{$protectie['cash']}' *$coinsdollar WHERE `id`='{$data->id}'");

$message = "Payout request done with success!</br>Please allow 10 days to send your money.</br>You can Review your Cashout History."; $message2 = 2;
}
else {$message = "ERROR: Minimum payout for PayPal is $2 !"; $message2 = 1;}
}

if($_POST['meth']=='ok') {
if($protectie['cash']>=2) {
$visitoripad = VisitorIP();
mysql_query("INSERT INTO `cashout` (id, adr, cash, method, date) VALUES('{$data->id}', '{$protectie['adr']}', '{$protectie['cash']}', '{$protectie['meth']}' , NOW() ) ");
mysql_query("UPDATE `users` SET `coins`=`coins` - '{$protectie['cash']}' *$coinsdollar WHERE `id`='{$data->id}'");

$message = "Payout request done with success!</br>Please allow 4 days to send your money.</br>You can Review your Cashout History."; $message2 = 2;
}
else {$message = "ERROR: Minimum payout for OKPay is $2 !"; $message2 = 1;}
}

if($_POST['meth']=='pz') {
if($protectie['cash']>=2) {
$visitoripad = VisitorIP();
mysql_query("INSERT INTO `cashout` (id, adr, cash, method, date) VALUES('{$data->id}', '{$protectie['adr']}', '{$protectie['cash']}', '{$protectie['meth']}' , NOW() ) ");
mysql_query("UPDATE `users` SET `coins`=`coins` - '{$protectie['cash']}' *$coinsdollar WHERE `id`='{$data->id}'");

$message = "Payout request done with success!</br>Please allow 10 days to send your money.</br>You can Review your Cashout History."; $message2 = 2;
}
else {$message = "ERROR: Minimum payout for Payza is $2.0 !"; $message2 = 1;}
}

}
}
?>

<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="cashout.php">Cashout Money</a></li> 
	<li class="tab2"><a href="cashoutmy.php">Cashout History</a></li> 
</ul>
</div>

<h1>Request Payout Money</h1>
<div class="clearer">&nbsp;</div>

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

<center>
<p><img src="img/mConvert.jpg?a" border="0" title="Points to Money"></p>

</center>

<h3>Minimum Payout System :</h3>
<p>You can request a payout payment when you have:</p>
<p>$2.00 for PayPal.</p>
<p>$2.00 for Payza.</p>


<div class="clearer">&nbsp;</div>

<h3>When you collect money ?</h3>
<p>After you request a payout, We will transfer money <b>within 8 days.</b> (OKPay takes some hours only)</p>
<p>You can cancel your payment request to change Payment Address or Method.</p>
</br></br>
<div class="balance"> Your balance : $<?echo number_format($data->coins/$coinsdollar,3);?> </div>
</br></br>

</br>
<p>Users from <b>(India, Brazil, Yemen, Argentina and Egypt)</b>: Sorry, PayPal does not allow us to send payments to these countries. Use OKPay instead or use PayPal Account which is Not related to these countries. (PayPal of your friend in another country)</p>
</br></br>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="padding: 20px; text-align: left;">

<tr><td><label for="cash">Amount ($):</label></td><td width="20"></td><td><input type="text" name="cash" id="cash" size="40" maxlength="4" value=<? echo number_format(($data->coins/$coinsdollar)-0.01,2) ?>  /></td></tr>

<tr><td><label for="adr">Payment Address/Account:</label></td><td width="20"></td><td><input type="text" name="adr" id="adr" size="40" maxlength="150" value="" /></td></tr>
<tr><td><label for="meth">Method:</label></td><td width="20"></td><td><select name="meth" id="meth">








	<option value="pp">PayPal (minimum $2 / 1-10 days)</option>
	<option value="pz">Payza (minimum $2 / 1-10 days)</option>











</select></td></tr>
<tr><td>&nbsp</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Request Cashout" class="submit" style="width: 200px;" /></td></tr>
</table></center>
</form>



<? include('footer.php');?>
