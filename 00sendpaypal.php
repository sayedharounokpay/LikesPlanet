<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if($data->id != 1 && $data->id != 245425){echo "<script>document.location.href='index.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$retract20 = $get['retract20'];
$paid = $get['paid'];
$refund = $get['refund'];

if ($refund > 0) {
$allcashout00 = mysql_fetch_object(mysql_query("SELECT * FROM `cashout` WHERE (`i`='{$refund}') "));
if ($allcashout00->pending == '0') {
mysql_query("UPDATE `cashout` SET `pending`='2' WHERE ( `i`='{$refund}' ) ");

$cashoutdata0 = mysql_query("SELECT * FROM `cashout` WHERE ( `i` = '{$refund}' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);

$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->id}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

$ppmsg = "We could not send your PayPal payment, PayPal says error: </br><font style='BACKGROUND-COLOR: red' size=4 color='white'>We are sorry. We are not able to complete personal payments to account holder at this time.</font>";
mysql_query("INSERT INTO `notes` (user_id, title, msg, url, alert) VALUES('{$cashoutdata->id}', 'PayPal', '{$ppmsg}', 'cashoutmy.php', '0' ) ");

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$cashoutdata->cash}'*$coinsdollar WHERE ( `id`='{$cashoutdata->id}' ) ");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE ( `id`='{$cashoutdata->id}' ) ");

// Send another email to confirm support.
// To email address
$email = $usernamehere->email;
$email_name = 'LikesPlanet.com network';

// From email address
$from = 'likesplanet.com@gmail.com';
$from_name = 'LikesPlanet.com';

// The message
$subject = 'LikesPlanet | Sorry, PayPal Payment Could Not Be Paid.';

$message = "Hello ".$usernamehere->login." !

Sorry, Our PayPal Agent informed us that Your PayPal Account does not approve our payment at this time.

Reason: We're sorry. We're not able to complete personal payments to account holder at this time.
Please try to use Another Payout method, or another PayPal account.

http://www.likesplanet.com/cashoutmy.php

";

$message_html = "<html><body><p>
</p>
Hello ".$usernamehere->login." !
<br /><br /><br /><br />
<font color='blue' size=3><b>
Sorry, Our PayPal Agent now Informed us that Your PayPal Payment Could NOT be sent.
</b></font>
<br /><br />
<br /><font color='black' size=3>
PayPal gives us this message :
<br /><font style='BACKGROUND-COLOR: red' size=4 color='white'><b>
We're sorry. We're not able to complete personal payments to account holder at this time.
</b></font>
<br /><br />
Usually this happens if your PayPal account refer to 'India' or 'Brazil' or 'Egypt' or 'Argentina', or it is Limited for a reason.
<br /><br /><br /><br />
<font color='blue' size=3><b>
We restored back your points on LikesPlanet balance, Please try another Payout method (example OKPay) or use another PayPal account.
</b></font>
<br /><br /><br /><br />
http://likesplanet.com/cashoutmy.php
<br /><br /><br /><br />
<br />
Thanks for using LikesPlanet network.
<br />
</body></html>";

/***********************************************/
/* No need to modify anything down here */
/* Note that these are needed to send the mail */
/***********************************************/
// Generate text + html version
$random_hash = md5(date_default_timezone_set("r"));

$mailmessage = "
--PHP-alt-".$random_hash."
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message

--PHP-alt-".$random_hash."
Content-Type: text/html; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message_html

--PHP-alt-".$random_hash."--
";

// Headers
// To send HTML mail, the Content-type header must be set
$headers = "From: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Reply-To: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Date: ".date_default_timezone_set("r") . "\r\n";

// Additional headers
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n";
$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . $_SERVER["SERVER_NAME"] . ">\r\n";

// Send the mail
mail($email, $subject, $mailmessage, $headers);

}}






if ($paid > 0) {
$allcashout00 = mysql_fetch_object(mysql_query("SELECT * FROM `cashout` WHERE (`i`='{$paid}') "));
if ($allcashout00->pending == '0') {
mysql_query("UPDATE `cashout` SET `pending`='1' WHERE ( `i`='{$paid}' ) ");

$cashoutdata0 = mysql_query("SELECT * FROM `cashout` WHERE ( `i` = '{$paid}' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);

$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->id}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

// Send another email to confirm support.
// To email address
$email = $usernamehere->email;
$email_name = 'LikesPlanet network';

// From email address
$from = 'likesplanet.com@gmail.com';
$from_name = 'LikesPlanet.com';

// The message
$subject = 'LikesPlanet | PayPal Payment already Paid.';

$message = "Hello ".$usernamehere->login." !

Your PayPal Payment Paid.

http://www.likesplanet.com/cashoutmy.php

";

$message_html = "<html><body><p>
</p>
Hello ".$usernamehere->login." !
<br /><br /><br /><br />
<font color='blue' size=3><b>
Your PayPal Payment Paid. Our PayPal agent now confirmed us Your PayPal Payment PAID.
</b></font>
<br /><br /><br /><br />
http://likesplanet.com/cashoutmy.php
<br /><br /><br /><br />
<br />
Thanks for using LikesPlanet network.
<br />
</body></html>";

/***********************************************/
/* No need to modify anything down here */
/* Note that these are needed to send the mail */
/***********************************************/
// Generate text + html version
$random_hash = md5(date_default_timezone_set("r"));

$mailmessage = "
--PHP-alt-".$random_hash."
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message

--PHP-alt-".$random_hash."
Content-Type: text/html; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message_html

--PHP-alt-".$random_hash."--
";

// Headers
// To send HTML mail, the Content-type header must be set
$headers = "From: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Reply-To: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Date: ".date_default_timezone_set("r") . "\r\n";

// Additional headers
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n";
$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . $_SERVER["SERVER_NAME"] . ">\r\n";

// Send the maildate_default_timezone_set
mail($email, $subject, $mailmessage, $headers);

}
}


$payoutsmade = mysql_fetch_object(mysql_query("SELECT * FROM `instant_okpay` WHERE (`id`='3') "));

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE (`pending`='0' AND `method`='pp' AND `skip`='0') ");
$totalnotpaid = 0;
$totalnum = 0;

$mytotalearns = 0;

for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->cash;
$totalnum = $totalnum + 1;

if ($j == 1) {
$cashoutid = $cashout->i;
$sendto = $cashout->adr;
$amount = $cashout->cash;
$date = $cashout->date;
$userid = $cashout->id;
$useroo = mysql_query("SELECT * FROM `users` WHERE (`id`='{$userid}'  ) ");  //  AND `ban`='0' AND `banned`='0'
$user5 = mysql_fetch_object($useroo);
}

}

?>

<h1>PayPal Payouts : $<?echo $totalnotpaid;?> / <?echo $totalnum;?></h1>

<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="title">Address:</label></td><td width="20"></td><td> <? if($user5->ban >= 1 OR $user5->banned == 1 OR $user5->bought ==1) { ?> <font color='red'> <? } else { ?> <font color='green'> <? } ?> <?echo $sendto;?> </font> </td></tr>
<tr><td><label for="title">Amount:</label></td><td width="20"></td><td> <font color='green'> $<b><?echo $amount;?></b> </font> </td></tr>

<tr><td><label for="title"> </label></td><td width="20"></td><td> Payout from LikesPlanet.com </td></tr>

</table></center>

<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>


<font color='blue' size='4'><b> 1- Send Payment on PayPal. </b></font> </br></br>
<font color='blue' size='4'><b> 2- </b></font>

<a href='00sendpaypal.php?paid=<? echo $cashoutid;?>'><font color='darkgreen' size='4'><b> PAID. </b></font></a>
</br></br>
 &nbsp; &nbsp; &nbsp; &nbsp;<a href='00sendpaypal.php?refund=<? echo $cashoutid;?>'><font color='red' size='4'> NOT Paid ?  (Refund Points to User)</font></a>


<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>

<div class="clearer">&nbsp;</div>


</script>

<div class="clearer">&nbsp;</div>

<? include('footer.php');?>