<?php
include('config.php');


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];
if('planet2013' == $pwd) {

$adders = mysql_query("SELECT * FROM `out_adder` WHERE `enabled`='1' LIMIT 0, 5;");
for($j=1; $siteadder = mysql_fetch_object($adders); $j++)
{

$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`oid` = '{$siteadder->page_id}')"));

	if(preg_match("/\bpages\b/i", $site->facebook)){
	$x110 = explode('/', $site->facebook);
	$name0 = $x110[5];}
	else { $x110 = explode('/', $site->facebook);
	$name0 = $x110[3]; }
	if(preg_match("/\bfref\b/i", $name0)){
	$x110009 = explode('?', $name0);
	$name0 = $x110009[0];
	}
	if(preg_match("/\bref\b/i", $name0)){
	$x110009 = explode('?', $name0);
	$name0 = $x110009[0];
	}
	$likesnumnum = 0;

	$url0   = 'https://graph.facebook.com/'. urlencode($name0); 
	$mystring0 = file_get_contents($url0);
	$x1103 = explode('likes"', $mystring0);
	$x11103 = explode(':', $x1103[1]);
	$x111033 = explode(',', $x11103[1]);
	$x111033e = explode(')))))))))))))))))))))', $x111033[0]);
	$likesnumnum = $x111033e[0];
	
	if($likesnumnum > 40) {
	$on_LPn = $site->likes + $site->jump + $site->skipped + $site->minilikes;
	
	$fb_added = $likesnumnum - $siteadder->on_fb;
	$lp_added = $on_LPn - $siteadder->on_lp;
	$out_added = $fb_added - $lp_added;
	
		if($out_added > 0) {
		echo "Likes Added: " . $out_added . " for Page (" . $site->title . ") </br>";
		$new_page_points = $site->cpc * $out_added;
		$new_page_points = $site->points - $new_page_points;
			if($new_page_points < 0){ $new_page_points = 0; }
		mysql_query("UPDATE `facebook` SET `points` = '{$new_page_points}', `likes` = `likes`+'{$out_added}' WHERE `oid`='{$site->oid}' ");
		mysql_query("UPDATE `out_adder` SET `on_fb` = '{$likesnumnum}', `on_lp` = '{$on_LPn}', `added`=`added`+'{$out_added}', `remain` = '{$new_page_points}' WHERE `page_id`='{$site->oid}' ");
		
			if($new_page_points < 10) {
			mysql_query("UPDATE `out_adder` SET `enabled` = '0' WHERE `page_id`='{$site->oid}' ");
			
			$pagehigh = 'fbpages.php?high=' . $site->id;
			$notemsg = 'Ran Out: Your Facebook Page (' . $site->title . ') Ran out of points! Click here to Add.';
			$pagehigh2 = 'http://likesplanet.com/fbpages.php?high=' . $site->id;
			$notemsg2 = 'Your Facebook Page (' . $site->facebook . ') Ran out of points! <br /><br /> Click on link below to add more points and get more likes.';
			$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user}' ) "));
			$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
			$noteslistext = mysql_num_rows($noteslist);
			if ($noteslistext == 0) {
			mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");
			mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your Facebook Page Ran Out of Points!', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
			}
			
			
			// To email address
$email = "yazancash@gmail.com";
$email_name = "LikesPlanet network";

// From email address
$from = "support@likesplanet.com";
$from_name = "LikesPlanet network";

// The message
$subject = "Auto Liker | Ran Out of Points!  PAUSE Now..";

$message = "Hello Admin!

" . $site->oid . "

Kind Regards,
";

$message_html = "<html><body><p><font size=4>
Hello!</p>

<p><font size=4>
<br />
<br />
<br /> " . $site->oid . "
<br />
</p></font>
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
		}
	
	}
}


echo "done"; 
exit;
}
else{
	echo "Invalid Access To Cron!";
}
?>



