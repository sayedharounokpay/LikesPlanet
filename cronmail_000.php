<?php
include('header.php');
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];

if('clear32' == $pwd) {


$site2 = mysql_query("SELECT * FROM `users` WHERE `ml`='0' LIMIT 0, 500");
$ext = mysql_num_rows($site2);
if($ext>400){
$testing = "no";
} else {
$testing = "yes";
}


if ($testing == "yes") {
$site2 = mysql_query("SELECT * FROM `testmail` ");
}
else{
$site2 = mysql_query("SELECT * FROM `users` WHERE `ml`='0' LIMIT 0, 40");
}

for($j=1; $x = mysql_fetch_object($site2); $j++)
{

if ($testing != "yes") {
mysql_query("UPDATE `users` SET `ml`='1' WHERE `id`='{$x->id}'");
}

// To email address
$email = $x->email;
$email_name = $x->login;

// From email address
$from = "zaidmarkabi@yahoo.com";
$from_name = "Admin of LikesASAP network";

// The message
$subject = "LikesASAP.com |Updates| Get Likes/Fans for your Business.";


$message = "Hello $x->login !

Buy FANs / Likes / Views /..etc  in One Click:
http://likesasap.com/addcomp.php
Click to Buy FANs for Your Business.

Need Points for Near Future?
http://likesasap.com/buy.php
Clickto Buy Points BEFORE Prices Rise up!

http://www.likesasap.com/
Visit us again and Check up Newest Updates to Increase your fans ASAP.

Thanks for using LikesASAP.com

Zaid,
Admin of LikesASAP network.
";

$message_html = "<html><body><p>
Hello <b> $x->login </b> !</p>

<p><font size=4>
<br />
<br />Now, You can become a Popstar, LikesASAP is #1 Massive network on planet to Promote Your Social Media, including FREE Facebook Likes, YouTube Likes/Dislikes,...etc
<br />
<br />LikesASAP now hosted on New UK Private Server. x10 Faster!
<br />
<br />
<br />
<br />
<br />
<b><b>Buy FANs / Likes / Views /..etc  <font color='green' size=5> by One Click</font></b>:</b>
<br />
</p>
<br /><a href='http://www.likesasap.com/addcomp.php'>Click here to Buy FANs for Your Business.</a>
<br />
<br />http://likesasap.com/addcomp.php
<br />
<br />
<br />
<br />
<br /><b><font color='darkgreen'>Need Points for Near Future?</font></b>
<br />
<br /><a href='http://www.likesasap.com/buy.php'>Click here to Buy Points <b><font size=5>BEFORE Prices RISE UP!</font></b></a>
<br />
<br />http://likesasap.com/buy.php
<br />
<br />
<br />
<br />
<br /><b>Updates :</b>
<br />
<br />Facebook and YouTube <b>Systems Improved</b>.
<br />
<br /><b>New Traffic Promotion</b> system Added. (Unique visit costs 0.75 point, Non-unique visitors are Free!)
<br />
<br />LikesASAP now More SAFE and Active on New UK Private Server.
<br />
<br />
<br /><b>New Promotion System :</b>
<br />Now you can Earn Unlimited Points/Money by our New Promote system!
<br />Some members earn <b>100</b> points daily by this New <b>Paid-To-Promote</b> system.
<br />
<br />
<br /><a href='http://www.likesasap.com/'> <b> Visit us again and Check up Newest Updates.  </b> </a>
<br />
<br /> 
<br /> Thanks for using LikesASAP.com
<br /> 
<br />
<br /></font>
</p>

<p>Zaid,
<br />Admin of <a href='http://www.likesasap.com/'> <b> LikesASAP.com </b> </a> </p>
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
}

echo "Done.";
}
else {
echo "Invaild Access.";
}


?>