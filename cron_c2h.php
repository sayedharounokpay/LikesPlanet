<?php
session_start();

$host		=	"localhost"; // your mysql server address  localhost
$user		=	"likespla_planet"; // your mysql username
$pass		=	"planet2013planet"; // your mysql password
$tablename	=	"likespla_c2h"; // your database name

  if(!(@mysql_connect("$host","$user","$pass") && @mysql_select_db("$tablename"))) {
?>
MySQL Error
<?
    exit;
  }
  include("functions.php");
  
if(isset($_SESSION['login'])){
    $dbres= mysql_query("SELECT *,UNIX_TIMESTAMP(`online`) AS `online` FROM `users` WHERE `login`='{$_SESSION['login']}'");
    $data= mysql_fetch_object($dbres);
  }

$coinsdollar=5000;
$referralrate=2;


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];


if('planet2013' == $pwd) {

$site2 = mysql_query("SELECT * FROM `user` WHERE `mailed`='0' AND `moptin`='1' LIMIT 0, 25");
$ext = mysql_num_rows($site2);

$testing = "no";

for($j=1; $x = mysql_fetch_object($site2); $j++)
{

if ($testing != "yes") {
mysql_query("UPDATE `user` SET `mailed`='1' WHERE `userid`='{$x->userid}'");
}

// To email address
$email = $x->email;
$email_name = $x->name;

if ($testing == "yes") { $email = 'yazancash@gmail.com'; }

// From email address
$from = "noreply@cash2hits.com";
$from_name = "Cash2Hits.com";

// The message
$subject = "Cash2Hits : Earn from Your Site or Advertise to Publishers sites";


$message = "
Hello $x->username

We have new earning way for webmasters to earn from your site, all you need is login to your account, Activate Publisher Account, and copy banner code to insert on your site.

You'll earn :
Per Banner View : $0.000003 to $0.0000002
Per Banner Click : $0.008 to $0.0002

You can easily earn $0.05 extra from small space on your site.

=============================

This is Paid Email from Cash2Hits.com :

I Will Teach You How To Earn Money With AdSense In Minutes.
100% Clicking your own ads.


To earn $0.001 for this email, Please click the following URL :

http://cash2hits.com/gptc.php?v=entry&type=ptre&user=$x->username&id=31

--------------------------------------------------------------
Cash2Hits.com Paid Email
You are receiving this email because you are a member of
Cash2Hits.com and have opted in to receiving paid emails. If
you want to stop receiving emails, please login to your account turn
off paid emails in your profile page.
--------------------------------------------------------------
";

$message_html = "<html><body><p><font size=4></p>

<p>Hello $x->username
<br />
<br />We have new earning way for webmasters to earn from your site, all you need is login to your account, Activate Publisher Account, and copy banner code to insert on your site.
<br />
<br />You'll Earn :
<br />Per Banner View : $0.000003 to $0.0000002
<br />Per Banner Click : $0.008 to $0.0002
<br />
<br />You can easily earn $0.05 extra from small space on your site.
<br />
<br />You can also advertise your Banner to Publishers sites for only $2 per 100K views.
<br />
<br />Click here to place your order :
<br /><a href='http://cash2hits.com/index.php?view=prices'> http://cash2hits.com/index.php?view=prices </a>
<br />
<br />================================
<br />
<br />This is Paid Email from Cash2Hits.com :
<br />
<br />I Will Teach You How To Earn Money With AdSense In Minutes.
<br />100% Clicking your own ads.
<br />
<br />
<br />To earn $0.001 for this email, Please click the following URL :
<br /><a href='http://cash2hits.com/gptc.php?v=entry&type=ptre&user=$x->username&id=31'> http://cash2hits.com/gptc.php?v=entry&type=ptre&user=$x->username&id=31 </a>
<br />
<br />--------------------------------------------------------------
<br />Cash2Hits.com Paid Email
<br />You are receiving this email because you are a member of
<br />Cash2Hits.com and have opted in to receiving paid emails. If
<br />you want to stop receiving emails, please login to your account turn
<br />off paid emails and admin emails in your profile page.
<br />--------------------------------------------------------------
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

echo $ext;

exit;
}
else{
	echo "Invalid Access To Cron!";
}
?>



