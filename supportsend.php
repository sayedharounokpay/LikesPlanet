<?php
include('header.php');

$usernamehere = mysql_query("SELECT * FROM `users` WHERE (`email` = '{$_POST["title2"]}' OR `login` = '{$_POST["title1"]}') ");
$extb = mysql_num_rows($usernamehere);

// if ($solvemedia_response->is_valid) {
if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {

if ($_POST["title1"] != "") {
if($extb > 0){

$site2 = mysql_query("SELECT * FROM `testmail` ");

for($j=1; $x = mysql_fetch_object($site2); $j++)
{

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < 15; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
$verificare1 = mysql_query("SELECT * FROM `support` WHERE `code`='{$str}'");
$verificareB = mysql_num_rows($verificare1);
if($verificareB > 0) {
$message = "Error: Please try again!"; $message2 = 1;
}  else {

mysql_query("INSERT INTO `support` (user_id, username, title, code, email) VALUES('{$data->id}', '{$_POST['title1']}', '{$_POST['title3']}', '{$str}' , '{$_POST['title2']}' ) ");

$displayname = ucfirst($_POST["title1"]);
mysql_query("INSERT INTO `supportmsg` (ticket, msg, name, level) VALUES('{$str}', '{$_POST['htmlmsg']}', '{$displayname}', '1' ) ");



$emailtemp1 = file_get_contents("email_temp0.php");
$emailtemp2 = file_get_contents("email_temp2.php");

// Send another email to confirm support.
// To email address
$email = "".$_POST["title2"]."";
$email_name = "LikesPlanet Support";

// From email address
$from = 'yazancash@gmail.com';
$from_name = 'LikesPlanet network.';

// The message
$subject = "LikesPlanet Support | " . $_POST['title3'];

$message = "Hello ".$_POST["title1"]." !

We received your message, We will solve and reply your problem as soon as possible.

Please follow this link to see Status of Your Support Ticket:

http://likesplanet.com/support.php?ticket=" . $str . "
";


$message_html = $emailtemp1 . "Hello " . ucfirst($_POST["title1"]) . "
<br /><br />
<font color='blue' size=3><b>
We received your message,<br />
We will solve and reply your problem as soon as possible.
</b></font>
<br /><br /><br /><br />
Please follow this link to see Status of Your Support Ticket:
<br /><br />http://likesplanet.com/support.php?ticket=" . $str . "
<br /><br /><br />" . $emailtemp2;

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

}
}

?>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<font color='green' size='4'><b>Thank you!</b></font>
<div class="clearer">&nbsp;</div>
<font color='green' size='3'>We will reply your message soon, Usually we reply within 24 hours.</br></br></br> You should receive Automatic Message from us rightnow,</br>Check your Email Inbox, and it may goes to (Spam) or (Junk) folder.
</br></br></br></br>Please follow this link to see Status of Your Support Ticket:</br></br>
<a href="support.php?ticket=<? echo $str;?>"> http://likesplanet.com/support.php?ticket=<? echo $str;?> </a>
</font>
</br></br>


<?

} else {
?>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<font color='red' size='4'><b>Opps!</b></font>
<div class="clearer">&nbsp;</div>
<font color='red' size='3'>We could not find your account info registered on LikesPlanet network!.</font>
<div class="clearer">&nbsp;</div>
<font color='green' size='3'>Please try again and enter correct information!.</font>
</br></br>



<?
}

}

} else {
?>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<font color='red' size='4'><b>Opps!</b></font>
<div class="clearer">&nbsp;</div>
<font color='red' size='3'>Captcha Code is NOT Correct!.</font>
<div class="clearer">&nbsp;</div>
<font color='green' size='3'>Please try again and enter the correct number!.</font>
<?
}
?>

</br>
<img src="captcha.php" width="0px" height="0px" />

<? include('footer.php'); ?>