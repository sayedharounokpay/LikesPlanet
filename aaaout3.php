<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if($data->id != 1){echo "<script>document.location.href='index.php'</script>"; exit;}

if ($_REQUEST["skip"] > 0) {
mysql_query("UPDATE `cashout` SET `skip`='1' WHERE ( `i`='{$_REQUEST['skip']}' ) ");
}
if ($_REQUEST["paid"] > 0) {
mysql_query("UPDATE `cashout` SET `pending`='1' WHERE ( `i`='{$_REQUEST['paid']}' ) ");

$cashoutdata0 = mysql_query("SELECT * FROM `cashout` WHERE ( `i` = '{$_REQUEST["paid"]}' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);

$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->id}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

// Send another email to confirm support.
// To email address
$email = $usernamehere->email;
$email_name = 'LikesPlanet.com network';

// From email address
$from = 'support@likesplanet.com';
$from_name = 'LikesPlanet.com';

// The message
$subject = 'LikesPlanet | Payza Payment Sent.';

$message = "Hello ".$usernamehere->login." !

Your Payza Payment already Paid.

http://www.likesplanet.com/cashoutmy.php

";

$message_html = "<html><body><p>
</p>
Hello ".$usernamehere->login." !
<br /><br /><br /><br />
<font color='blue' size=3><b>
Your Payza Payment Already Paid.
</b></font>
<br /><br /><br /><br /><br /><br />
Do you want to Duplicate Your Earnings?
<br /><br />
Post your payment proof on 5 blogs, to get Payment Amount x1000 Points.
<br /><br />
http://www.likesplanet.com/prompay.php
<br /><br />
or Post here to get points = Payment amount x500.
http://blog.likesplanet.com/payments-proofs-post-your-payment-proof-and-earn-extra-pointsmoney/
<br /><br /><br /><br />
You like to earn 600 or 1,000 Points ?
<br /><br />
Make a blog write about LikesPlanet, Use this application to get paid:
<br /><br />
http://www.likesplanet.com/extrapoints.php
<br /><br />
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
$random_hash = md5(date("r", time()));

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
$headers .= "Date: ".date("r") . "\r\n";

// Additional headers
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n";
$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . $_SERVER["SERVER_NAME"] . ">\r\n";

// Send the mail
mail($email, $subject, $mailmessage, $headers);

}
if ($_REQUEST["cancel"] > 0) {
mysql_query("UPDATE `cashout` SET `pending`='2' WHERE ( `i`='{$_REQUEST['cancel']}' ) ");
}
if ($_REQUEST["skipp"] > 0) {
mysql_query("UPDATE `cashout` SET `skip`='2' WHERE ( `i`='{$_REQUEST['skipp']}' ) ");
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE (`pending`='0' AND `method`='ap' AND `skip`='0') ");
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
$useroo = mysql_query("SELECT * FROM `users` WHERE (`id`='{$userid}'  ) ");  // AND `ban`='0' AND `banned`='0'
$user5 = mysql_fetch_object($useroo);
}

}

?>

<h1>Payouts : <?echo $totalnotpaid;?> / <?echo $totalnum;?></h1>

<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="title">Address:</label></td><td width="20"></td><td> <? if($user5->ban >= 1 OR $user5->banned == 1 OR $user5->bought ==1 OR $user5->ptp >= 7500) { ?> <font color='red'> <? } else { ?> <font color='green'> <? } ?> |<?echo $sendto;?>| </font> </td></tr>
<tr><td><label for="title">Amount:</label></td><td width="20"></td><td> <font color='green'> $<b><?echo $amount;?></b> </font> </td></tr>

<tr><td><label for="title"> </label></td><td width="20"></td><td>  </td></tr>

<tr><td><label for="title"> </label></td><td width="20"></td><td> Payout from LikesPlanet.com </td></tr>

<tr><td><label for="title"> </label></td><td width="20"></td><td>  </td></tr>

<tr><td><label for="title">User ID:</label></td><td width="20"></td><td> <?echo $userid;?> </td></tr>
<tr><td><label for="title">Username:</label></td><td width="20"></td><td> <?echo $user5->login;?> </td></tr>

<tr><td><label for="title">Date:</label></td><td width="20"></td><td> <font color='green'> <?echo $date;?> </font> </td></tr>

<tr><td><label for="title">Likes:</label></td><td width="20"></td><td> <?echo $user5->likes;?> </td></tr>
<tr><td><label for="title">UnLikes:</label></td><td width="20"></td><td> <?echo $user5->unlikes;?> </td></tr>
<tr><td><label for="title">Hits Today:</label></td><td width="20"></td><td> <?echo $user5->hitstoday;?> </td></tr>
<tr><td><label for="title">Points:</label></td><td width="20"></td><td> <b><?echo $user5->coins;?></b> / <?echo $user5->lastpoints;?> </td></tr>
<tr><td><label for="title">Country:</label></td><td width="20"></td><td> <?echo $user5->country;?> </td></tr>

<tr><td><label for="title"> </label></td><td width="20"></td><td>  </td></tr>

<tr><td><label for="title">Ref:</label></td><td width="20"></td><td> <?echo $user5->ref;?> / <?echo $user5->ref2;?> </td></tr>
<tr><td><label for="title">Vote:</label></td><td width="20"></td><td> <?echo $user5->rate;?>% / <?echo $user5->votes;?> </td></tr>
<tr><td><label for="title">Ban:</label></td><td width="20"></td><td> <b><?echo $user5->ban;?></b> / <?echo $user5->banned;?> </td></tr>
<tr><td><label for="title">Signup/Login:</label></td><td width="20"></td><td> <?echo $user5->signup;?> / <?echo $user5->online;?> </td></tr>
<tr><td><label for="title">PTP:</label></td><td width="20"></td><td> <?echo $user5->ptp;?> </td></tr>

<?
$allearns = mysql_query("SELECT * FROM `cashout` WHERE (`pending`='1' AND `id`='{$user5->id}') ");
for($j=1; $totalearning = mysql_fetch_object($allearns); $j++)
{
$mytotalearns = $mytotalearns + $totalearning->cash;
}
?>

<tr><td><label for="title">Total Earned:</label></td><td width="20"></td><td> <?echo $mytotalearns;?> </td></tr>

</table></center>

<div class="clearer">&nbsp;</div>

<a href="aaaout3.php?skip=<?echo $cashoutid;?>">Skip Request</a>
<div class="clearer">&nbsp;</div>
<a href="aaaout3.php?paid=<?echo $cashoutid;?>"><b><font color='green' size='5'>PAID</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout3.php?cancel=<?echo $cashoutid;?>"><b>Cancel Payment</b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout3.php?skipp=<?echo $cashoutid;?>">Skip forever</a>


<div class="clearer">&nbsp;</div>

<? include('footer.php');?>