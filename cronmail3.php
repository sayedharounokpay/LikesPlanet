<?php
include('config.php');
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];

if('planet2013' == $pwd) {

mysql_query("DELETE FROM `notebyemail` WHERE `sent`='1'");

$site2 = mysql_query("SELECT * FROM `notebyemail` WHERE (`sent`='0') LIMIT 0, 30");
$ext = mysql_num_rows($site2);

$emailtemp1 = file_get_contents("email_temp1.php");
$emailtemp2 = file_get_contents("email_temp2.php");

for($j=1; $x = mysql_fetch_object($site2); $j++)
{

mysql_query("UPDATE `notebyemail` SET `sent`='1' WHERE `id`='{$x->id}'");

// To email address
$email = $x->email;
$email_name = $x->username;

// From email address
$from = "likesplanet.com@gmail.com";
$from_name = "LikesPlanet network";

// The message
$subject = $x->title;

$message = "Hello $x->username!

" . $x->msg . "

Thanks for using LikesPlanet.com

Kind Regards,
Admin of LikesPlanet network.
";

$message_html = $emailtemp1 . "Hello <b> " . ucfirst($x->username) . " </b> <br /><br />
<br /> " . $x->msg . "
<br />
<br /> " . $x->link . "<br />" . $emailtemp2;

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

$emailtemp1 = "";
$emailtemp2 = "";

echo $ext;
}
else {
echo "Invaild Access.";
}


?>