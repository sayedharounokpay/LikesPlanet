<?php
include("../config.php");
$mailTo = $site->site_email;
$mailFrom = htmlspecialchars($_POST['email']);
$subject = 'Subscription';

$message =  'New Email: '.$mailFrom;

mail($mailTo, $subject, $message);
?>