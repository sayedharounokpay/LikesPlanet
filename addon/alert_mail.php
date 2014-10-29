<?php
include('../header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$uid = $get['uid'];
$ipp = $get['ipp'];

// To email address

$email = "yazancash@gmail.com";

$email_name = "yazancash@gmail.com";


// From email address

$from = "yazan@yazanmarkabi.com";

$from_name = "yazan@yazanmarkabi.com";



// The message

$subject = "Test Alert";

$message_html = "<html><body><p>

Hello <b> (" . $uid . ") </b> !</p>
</br> </ br> <br />

" . $ipp . "

</body></html>";


$message = $message_html;

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

//$headers .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n";
$headers .= "Content-Type: text/html; boundary=\"PHP-alt-" . $random_hash . "\"\r\n";

$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . $_SERVER["SERVER_NAME"] . ">\r\n";



// Send the mail
mail($email, $subject, $message_html, $headers);


echo "Done.";

?>