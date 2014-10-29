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

// To email address
$email = $siteme->site_email;
$email_name = $x->login;

// From email address
$from = "".$_POST["title2"]."";
$from_name = "".$_POST["title1"]."";

// The message
$subject = "## LikesPlanet Support ##: ".$_POST["title1"]."";

$message = "Hello $x->login !

".$_POST["htmlmsg"]." 

";

$emailtemp1 = file_get_contents("email_temp0.php");
$emailtemp2 = file_get_contents("email_temp2.php");

$message_html = "<html><body><p>
</p>" . $_POST["htmlmsg"] . "
<br />
<br />
<br />
<p> Username : 
".$data->login."
</p>
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


}


// Send another email to confirm support.
// To email address
$tickedidd = rand(52310,64365);
$email = "".$_POST["title2"]."";
$email_name = 'LikesPlanet | Support Ticket ' . $tickedidd;

// From email address
$from = $siteme->site_email;
$from_name = 'Admin of LikesPlanet network.';

// The message
$subject = 'LikesPlanet | Support Ticket ' . $tickedidd;

$message = "Hello ".$_POST["title1"]." !

We received your message, We will solve and reply your problem as soon as possible.

If you do not receive any reply within 72 hours, contact us at " . $siteme->site_email . ",

";

$message_html = $emailtemp1 . "Hello " . ucfirst($_POST["title1"]) . "
<br /><br />
<font color='blue' size=3><b>
We received your message, We will solve and reply your problem as soon as possible.
</b></font>
<br /><br /><br /><br />
If you do not receive a reply within 48 hours, contact us at " . $siteme->site_email . ",
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


?>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<font color='green' size='4'><b>Thank you!</b></font>
<div class="clearer">&nbsp;</div>
<font color='green' size='3'>We will reply your message soon, Usually we reply within 24 hours.</br></br></br> You should receive an automatic message from us right now,</br>Check your Email Inbox, and (Spam) or (Junk) folder.</font>
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