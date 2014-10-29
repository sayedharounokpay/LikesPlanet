<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$siteliked2 = mysql_query("SELECT * FROM `users` WHERE (`ptm`='1') ");
$ext = mysql_num_rows($siteliked2);

if(isset($_POST['add'])){
if ($_POST['cpc']*100 < $data->coins) {

$htmlmsg1 = preg_replace('/\r\n/', 'oo', $protect['msg1']);

mysql_query("UPDATE `users` SET `coins`=`coins`-'{$protect['cpc']}'*100 WHERE `id`='{$data->id}'");

$userspack = mysql_query("SELECT * FROM `users` WHERE (`ptm` = '1' AND `id` != '{$data->id}')  ORDER BY RAND() LIMIT 0, 10");

for($j=1; $userr221 = mysql_fetch_object($userspack); $j++)
{

	// To email address
$email = $userr221->email;
$email_name = $userr221->login;
// From email address
$from = "zaidmarkabi@yahoo.com";
$from_name = "LikesASAP.com - Paid Email";

// The message
$subject = $protect['title'] . "   - LikesASAP Paid Email";
$message = "Hello ".$email_name."

".$htmlmsg1."

http://www.likesasap.com/conf.php?code=";

$message_html = "<html><body><p> Hello ! </p>

" . $htmlmsg1 . "

<br />
<br />http://www.likesasap.com/conf.php?code=".$str."

</body></html>";
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



$msg = "<div class=\"msg_success\">Paid Emails will be sent within 5 minutes!</div>";
} else {
$msg = "<div class=\"msg_error\">You do NOT have enough points to pay! Reduce number of emails.</div>";
}
}

?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="paidtomail.php">Earn from Paid Emails</a></li> 
	<li class="tab2"><a href="paidtomailsend.php">Send Paid Emails</a></li> 
</ul>
</div>
<p>&nbsp;</p>

<h1>Send Paid Emails (Advertise)</h1>
<? echo $msg;?>
<p>&nbsp;</p>
<center>
<p><font color='green'><font size='4'>There are <b>'<? echo $ext;?>'</b> users will be GLAD to receive your Paid Email !</font></font></p>
<p>We do Not send emails to Any user, Only users glad to receive emails will pickup your ads.</p>
<p><font color='green'><font size='4'>So It is only High Quality Advertising.</font></font></p>
</center>
<p>&nbsp;</p>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="points">Send :</label></td><td width="20"></td><td><input type="text" name="cpc" id="cpc" size="3" maxlength="5" value="10" /> Paid Emails.</td></tr>

<tr><td><label for="points">Title :</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="30" maxlength="30" value="" /> </td></tr>

<tr><td><label for="points">Advertisement (Email Content):</label></td><td width="20"></td><td><textarea name="msg1" style="width:400px;height:260px;"></textarea></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Send Emails" class="submit" /></td></tr>
</table></center>
</form>

<center>
<p>You will pay 100 Points per email.</p>
<p>70% for readed, 30% for LikesASAP.</p>
</center>
<p>&nbsp;</p>

<? include('footer.php');?>