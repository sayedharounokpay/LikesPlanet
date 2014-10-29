<?php
include('header.php');

foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if($data->id != 1){echo "<script>document.location.href='index.php'</script>"; exit;}

if ($_REQUEST["skip"] > 0) {

$cashoutdata0 = mysql_query("SELECT * FROM `ppv` WHERE ( `id` = '{$_REQUEST["skip"]}'  AND `paid`='0' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);

$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->user}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

mysql_query("UPDATE `ppv` SET `paid`='2' WHERE ( `id`='{$_REQUEST['skip']}' ) ");

// Send another email to confirm support.
// To email address
$email = $usernamehere->email;
$email_name = 'LikesPlanet | Your Promotion-Video Rejected.';

// From email address
$from = $siteme->site_email;
$from_name = 'Admin of LikesPlanet.com';

// The message
$subject = 'LikesPlanet | Your Promotion-Video Rejected.';

$message = "Hello ".$usernamehere->login." !

Sorry, Your paid link (video/blog) Rejected.

http://likesplanet.com/extrapoints.php

";

$message_html = "<html><body><p>
</p>
Hello ".$usernamehere->login." !
<br /><br /><br /><br />
<font color='blue' size=3><b>
Sorry, Your promotion link (Video) Rejected. Make sure video is published. it seems removed or link broken, or your Referral Link not posted on that video!
</b></font>
<br /><br /><br /><br />
http://likesplanet.com/extrapoints.php
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


if ($_REQUEST["paid"] > 0) {
$cashoutdata0 = mysql_query("SELECT * FROM `ppv` WHERE ( `id` = '{$_REQUEST["paid"]}' AND `paid`='0' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);

$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->user}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

if($usernamehere->id > 0) {

mysql_query("UPDATE `ppv` SET `paid`='1', `points`='{$_REQUEST['points']}'  WHERE ( `id`='{$_REQUEST['paid']}' ) ");

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$_REQUEST['points']}' WHERE ( `id`='{$cashoutdata->user}' ) ");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$cashoutdata->user}'");

// Send another email to confirm support.
// To email address
$email = $usernamehere->email;
$email_name = 'LikesPlanet | Your Promotion-Link Approved.';

// From email address
$from = $siteme->site_email;
$from_name = 'Admin of LikesPlanet.com';

// The message
$subject = 'LikesPlanet | Your Promotion-Video Approved.';

$message = "Hello ".$usernamehere->login." !

Your (Video) Promotion Link Approved. Points added to your balance on LikesPlanet.

http://likesplanet.com/extrapoints.php

";

$message_html = "<html><body><p>
</p>
Hello ".$usernamehere->login." !
<br /><br /><br /><br />
<font color='blue' size=4><b>
Your (Video) Promotion Link Approved. Points added to your balance on LikesPlanet.
</b></font>
<br /><br /><br /><br />
http://likesplanet.com/extrapoints.php
<br /><br /><br /><br />
<br />
Thanks for supporting LikesPlanet network.
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
}

$allcashout = mysql_query("SELECT * FROM `ppv` WHERE (`paid`='0') ");
$totalnum = 0;

$mytotalearns = 0;
$videoname = "";

for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnum = $totalnum + 1;

if ($j == 1) {
$cashoutid = $cashout->id;
$link = $cashout->link;
$userid = $cashout->user;
$useroo = mysql_query("SELECT * FROM `users` WHERE (`id`='{$userid}') ");
$user5 = mysql_fetch_object($useroo);

	if(preg_match("/\byoutube.com\b/i", $link)){
		$splitarrayii = explode('&', $link);
		$link = $splitarrayii[0];
		$splitarray = explode('?v=', $link);
		$videoname = $splitarray[1];
		$videoname = substr($videoname,0,11);
		$videoaddedbefore = mysql_query("SELECT * FROM `ppv` WHERE (`link` LIKE '%" . $videoname . "%' AND NOT `paid` = '0') ");
		$verificare = mysql_num_rows($videoaddedbefore);
	}
	if(preg_match("/\byoutu.be\b/i", $link)){
		$splitarrayii = explode('&', $link);
		$link = $splitarrayii[0];
		$splitarray = explode('be/', $link);
		$videoname = $splitarray[1];
		$videoname = substr($videoname,0,11);
		$videoaddedbefore = mysql_query("SELECT * FROM `ppv` WHERE (`link` LIKE '%" . $videoname . "%' AND NOT `paid` = '0') ");
		$verificare = mysql_num_rows($videoaddedbefore);
	}

}

}

?>

<h1>Links: <?echo $totalnum;?></h1>

<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="title">Username:</label></td><td width="20"></td><td> <? if($user5->ban >= 1 OR $user5->banned == 1 OR $user5->bought ==1) { ?> <font color='red'> <? } else { ?> <font color='green'> <? } ?> |<?echo $user5->login;?>| </font> </td></tr>
<tr><td><label for="title">Link:</label></td><td width="20"></td><td> <font color='green'> <a href="<?echo $link;?>" target="_blank">  <b><?echo $link;?></b> </a> </font> </td></tr>

<? if( $videoname != "") { ?>
<tr><td><label for="title"> </label></td><td width="20"></td><td> <font color='green'> <? echo $verificare; ?> </font> </td></tr>
<? } ?>

<tr><td><label for="title"> </label></td><td width="20"></td><td>  </td></tr>

<tr><td><label for="title">User ID:</label></td><td width="20"></td><td> <?echo $userid;?> </td></tr>

<tr><td><label for="title">Likes:</label></td><td width="20"></td><td> <?echo $user5->likes;?> / <?echo $user5->unlikes;?> </td></tr>
<tr><td><label for="title">Hits Today:</label></td><td width="20"></td><td> <?echo $user5->hitstoday;?> </td></tr>
<tr><td><label for="title">Points:</label></td><td width="20"></td><td> <b><?echo $user5->coins;?></b> / <?echo $user5->lastpoints;?> </td></tr>
<tr><td><label for="title">Country:</label></td><td width="20"></td><td> <?echo $user5->country;?> </td></tr>

<tr><td><label for="title"> </label></td><td width="20"></td><td>  </td></tr>

<tr><td><label for="title">Ref:</label></td><td width="20"></td><td> <?echo $user5->ref;?> / <?echo $user5->ref2;?> </td></tr>
<tr><td><label for="title">Ban:</label></td><td width="20"></td><td> <?echo $user5->ban;?> / <?echo $user5->banned;?> </td></tr>
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

<a href="http://www.likesplanet.com/aaaout_ppv.php?skip=<?echo $cashoutid;?>">Reject Request</a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=60"><b><font color='green' size='5'>Pay 60</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=100"><b><font color='green' size='5'>Pay 100</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=150"><b><font color='green' size='5'>Pay 150</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=200"><b><font color='green' size='5'>Pay 200</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=250"><b><font color='green' size='5'>Pay 250</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=300"><b><font color='green' size='5'>Pay 300</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=400"><b><font color='green' size='5'>Pay 400</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=500"><b><font color='green' size='5'>Pay 500</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=600"><b><font color='green' size='5'>Pay 600</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=750"><b><font color='green' size='5'>Pay 750</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=1000"><b><font color='green' size='5'>Pay 1000</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="http://www.likesplanet.com/aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=1500"><b><font color='green' size='5'>Pay 1500</font></b></a>
<div class="clearer">&nbsp;</div>


<? include('footer.php');?>