<?php
$page_title = "Re-send Activation Email - LikesPlanet.com";

include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

if(isset($_POST['add'])){
	$userr2 = mysql_query("SELECT * FROM `users` WHERE (`email`='{$_POST['email']}')");
	$verificare30 = mysql_num_rows($userr2);
	
	$userr2 = mysql_query("SELECT * FROM `users` WHERE (`email`='{$_POST['email']}' AND `conf`='0')");
	$verificare3 = mysql_num_rows($userr2);
if ($verificare3 > 0) {

if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {
$message = "Email have sent with Activation Code!"; $message2 = 2;

$userr221 = mysql_fetch_object($userr2);

	// To email address
$email = $_POST['email'];
$email_name = $userr221->login;
$str = $userr221->code;

// From email address
$from = "zaidmarkabi@yahoo.com";
$from_name = "Admin of LikesPlanet network";

// The message
$subject = "LikesPlanet - Confirm your Account";


$message11 = "Hello ".$email_name."

Please follow this link to confirm your account in LikesPlanet network

http://www.likesplanet.com/conf.php?code=".$str."


Admin of LikesPlanet network
";

$emailtemp1 = file_get_contents("email_temp0.php");
$emailtemp2 = file_get_contents("email_temp2.php");

$message_html = $emailtemp1 . "Hello, You requested to Conform your LikesPlanet Account.<br /><br />
<br /> Follow link below to confirm your account:
<br />
<br /> http://www.likesplanet.com/conf.php?code=" . $str . "<br />" . $emailtemp2;

$emailtemp1 = "";
$emailtemp2 = "";

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
$message11
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

} else {
$message = "Captcha code is NOT correct!"; $message2 = 1;
}
}


else{
if ($verificare30 == 0){
$message = "Email is NOT Registered At All! Please register a new account."; $message2 = 1;
} else { $message = "Account is Already Confirmed!"; $message2 = 2; }
}
}
?>
<body id="tab1"> 

<center><img src="img/planet_reconfirm.jpg" border="0" title="LikesPlanet.com - Resend Activation code"></center>

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

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 4px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="email">Email:</label></td><td width="20"></td><td><input type="text" name="email" id="email" size="40" maxlength="50" /></td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td><label for="email">Enter Image Text:</label></td><td width="20"></td><td align="center"><input name="captcha" size="7" maxlength="5"  type="text"></br><img src="captcha.php" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><center><input type="submit" name="add" value="Re-Send" class="submit" /></center></td></tr>
</table></center>
</form>
<? include('footer.php');?>