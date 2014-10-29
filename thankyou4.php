<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$msg = "<div class=\"msg_success\" >Thank You!</div>
<div class=\"msg_success\" >Please allow 8 hours to start getting fans.</div>
<div class=\"msg_success\" >If your likes/fans not start, Please send email to (zaidmarkabi@yahoo.com) to confirm.</div>";

$ads2b = mysql_query("SELECT * FROM `aaafans` ORDER BY `id` DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);

mysql_query("UPDATE `aaafans` SET `paid`='1' WHERE `id`='{$adsb->id}'");

// To email address
$email = $site->site_email;
$email_name = 'fans/likes';

// From email address
$from = "zaidmarkabi@yahoo.com";
$from_name = "Admin of LikesASAP.com";

// The message
$subject = "LikesASAP.com - Someone paid for likes";


$message = "Hello Admin

". $adsb->type ."

". $adsb->url ."


Zaid,
Admin of LikesASAP.com
";

$message_html = "<html><body><p> Hello ! </p>

". $adsb->type ."

". $adsb->url ."

<p>
<br />Admin of <a href='http://www.likesasap.com/'> <b> LikesASAP network</b> </a> </p>
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



?>

<h1>Thank You</h1>
<? echo $msg;?>

<? include('footer.php');?>