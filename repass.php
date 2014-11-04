<?php
$page_title = "I forgot password - LikesPlanet.com";

include('header.php');

foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(isset($_POST['add'])){
	$userr2 = mysql_query("SELECT * FROM `users` WHERE (`email`='{$_POST['email']}' OR `login`='{$_POST['email']}')");
	$verificare3 = mysql_num_rows($userr2);
if ($verificare3 > 0) {
$userrdata = mysql_fetch_object($userr2);

if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {
$message = "Email have sent with Account Details!</br>Check both (Inbox) and (Spam) folders."; $message2 = 2;

	// To email address
$email = $userrdata->email;
$email_name = $userrdata->login;
$strppp = $userrdata->pass;

// From email address
$from = "likesplanet.com@gmail.com";
$from_name = "Admin of LikesPlanet.com";

// The message
$subject = "LikesPlanet.com - Forgot Password";
 
$message00 = "Hello ".$email_name."

Username : ".$email_name."

Password : ".$strppp."

Admin of LikesPlanet.com
";

$emailtemp1 = file_get_contents("email_temp0.php");
$emailtemp2 = file_get_contents("email_temp2.php");

$message_html = $emailtemp1 . "Your Login Information:<br /><br />
<br /> Username: " . $email_name . "
<br />
<br /> Password: " . $strppp . "<br />" . $emailtemp2;

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
$message00
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
$message = "Email/Username is NOT Registered in our database!"; $message2 = 1;
}
}
?>
<body id="tab1"> 

<center><img src="img/planet_forgot.jpg" border="0" title="LikesPlanet.com - Forgot Password"></center>

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

<tr><td><label for="email">Email or Username:</label></td><td width="20"></td><td><input type="text" name="email" id="email" size="40" maxlength="50" /></td></tr>
<tr><td><label for="Password">Password</label></td><td width="20"></td><td><input type="text" name="pass" id="pass" size="40" maxlength="50" /></td></tr>
<tr><td><label for="Password Confirm">Password</label></td><td width="20"></td><td><input type="text" name="pass" id="pass" size="40" maxlength="50" /></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="email">Enter Image Text:</label></td><td width="20"></td><td align="center"><input name="captcha" size="7" maxlength="5"  type="text"></br><img src="captcha.php" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><center><input type="submit" class="submit" style="width: 300px;" name="add" value="Send Account Info to my Email" class="submit" /></center></td></tr>
</table></center>

</form>
<? include('footer.php');?>