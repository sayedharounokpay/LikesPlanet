<?php
$page_title = "Join LikesPlanet.com | Ready to Get 10,000 Likes/Followers for your Facebook/YouTube/Twitter ? | Want to Earn Money by doing Likes/Follow/Hits ?";

include('header.php');
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

	$code = VisitorIP();
	$codeARR = explode(',', $code);
	$code = $codeARR[0];
	
	$refname = $get["ref"];

	if ($refname == "") {
$surffed1 = mysql_query("SELECT * FROM `ref_ip` WHERE (`IP` = '{$code}') LIMIT 0, 1");
$extb = mysql_num_rows($surffed1);
if($extb == 0){
mysql_query("INSERT INTO `ref_ip` (ref2, IP) VALUES('{$refname}', '{$code}' )");
} else {
$userreff = mysql_fetch_object($surffed1);
$refname = $userreff->ref2;
}
	}
	
	//$mystring = file_get_contents('http://ipinfodb.com/ip_locator.php?ip=' . $code); 
	//$x1102 = explode("Country : ", $mystring);
	//$x11102 = explode(" <img src=", $x1102[1]);
	
	//$x1102w = explode("City : ", $mystring);
	//$x11102w = explode("</li>", $x1102w[1]);
	
	//$x111022 = $x11102w[0] . ' (' . $x11102[0] . ')';
	
	
	
	//$mystring = file_get_contents('http://www.infobyip.com/ip-' . $code . '.html'); 
	//$x1102 = explode(")</td></tr>", $mystring);
	//$x11102 = explode(" flag'> ", $x1102[0]);
	//$x111022 = $x11102[1] . ')';
	//$x11102oo = explode('(', $x111022);
	//$x111022oo = explode(')', $x11102oo[1]);
	
	
	$mystring = file_get_contents('http://freegeoip.net/json/' . $code); 
	$x1102 = explode('country_code":"', $mystring);
	$x11102 = explode('",' , $x1102[1]);
	$x1102h = explode('country_name":"', $mystring);
	$x11102h = explode('",' , $x1102h[1]);
	
	$x111022 = $x11102h[0] . ' (' . $x11102[0] . ')';
	
	$x111022oo[0] = $x11102[0];
	// $x111022oo[0] = "US";
	
	// $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$code));    
	// $x111022 = $ip_data->geoplugin_countryName . ' (' . $ip_data->geoplugin_countryCode . ')';
	// $x111022oo[0] = $ip_data->geoplugin_countryCode;
	
	
if ($x111022oo[0] == '' ) $x111022oo[0] = 'US';
if ($x111022oo[0] == 'DE' ) $x111022oo[0] = 'GM';
if ($x111022oo[0] == 'TR' ) $x111022oo[0] = 'TU';
if ($x111022oo[0] == 'PH' ) $x111022oo[0] = 'RP';
if ($x111022oo[0] == 'DZ' ) $x111022oo[0] = 'AG';
if ($x111022oo[0] == 'BW' ) $x111022oo[0] = 'BC';
if ($x111022oo[0] == 'PT' ) $x111022oo[0] = 'PO';
if ($x111022oo[0] == 'VN' ) $x111022oo[0] = 'VM';
if ($x111022oo[0] == 'RU' ) $x111022oo[0] = 'RS';
if ($x111022oo[0] == 'OM' ) $x111022oo[0] = 'MU';
if ($x111022oo[0] == 'GB' ) $x111022oo[0] = 'UK';
if ($x111022oo[0] == 'GE' ) $x111022oo[0] = 'GG';
if ($x111022oo[0] == 'LB' ) $x111022oo[0] = 'LE';
if ($x111022oo[0] == 'AZ' ) $x111022oo[0] = 'AJ';
if ($x111022oo[0] == 'LV' ) $x111022oo[0] = 'LG';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CO';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';

?> 
<div>&nbsp;</div> <center> <?
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`active` = '0' AND (`points` > '0' OR `clx` > '0') )  ORDER BY RAND() DESC LIMIT 0, 2");
$extb = mysql_num_rows($ads2b);
if($extb > 1){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?




if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {
if(isset($_POST['register'])){

$verificareA = mysql_query("SELECT * FROM `users` WHERE (`login`='{$_POST['user']}') ");
$verificare1 = mysql_num_rows($verificareA);

$verificareB = mysql_query("SELECT * FROM `users` WHERE (`email`='{$_POST['email']}') ");
$verificare2 = mysql_num_rows($verificareB);

if ($verificare1 > 0 ) {
$message = "This Username Already used by someone else!</br>Please Try to choose Another Username."; $message2 = 1;
}else if ($verificare2 > 0 ) {
$message = "This Email is Already Registered! Please Try to Login."; $message2 = 1;
}else if (!isUserID($_POST['user'])) {
$message = "Username format is incorrect!</br>Do not add Spaces in your Username.</br>Example: (ZaidMarkabi) Not (Zaid Markabi)."; $message2 = 1;
}else if(!isEmail($_POST['email'])) {
$message = "Email format is incorrect!"; $message2 = 1;
}else if($_POST['email'] != $_POST['email2']) {
$message = "Email addresses do Not match!"; $message2 = 1;
}else if (!checkPwd($_POST['password'],$_POST['password2'])) {
$message = "Passwords do not match!"; $message2 = 1;
}else{
$final = VisitorIP();

$verificare2 = mysql_query("SELECT * FROM `users` WHERE (`reg_ip`='{$final}')");
$verificare3 = mysql_num_rows($verificare2);
if ($verificare3 > 0) {
$message = "Multiply Accounts is NOT Allowed!"; $message2 = 1;
}

else{
$pass = $_POST['password'];
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	for( $i = 0; $i < 10; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

$referrrlla = $_POST['referralll'];
if ($referrrlla == "") {
mysql_query("INSERT INTO `users`(email,login,IP,pass,signup,code,country,reg_ip) values('{$_POST['email']}','{$_POST['user']}','$final','$pass',NOW(),'$str', '$x111022', '$final' )");
}else{
$userreff = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `login` = '{$referrrlla}' "));
mysql_query("INSERT INTO `users`(email,login,IP,pass,signup,ref2,code,country,reg_ip) values('{$_POST['email']}','{$_POST['user']}','$final','$pass',NOW(),'{$userreff->id}', '$str', '$x111022', '$final' )");
$total9 = mysql_query("SELECT * FROM `users` WHERE `login`='{$_POST['user']}'");
mysql_query("INSERT INTO `referrals` (user_id, ref_id) VALUES('{$total9[0]}','{$userreff->id}')");
mysql_query("UPDATE `users` SET `ref`=`ref`+1, `refrally`=`refrally`+1  WHERE `login`='{$referrrlla}'");
mysql_query("UPDATE `stat` SET `stat`=`stat`+'1'  WHERE `id`='2'");
}
mysql_query("UPDATE `stat` SET `stat`=`stat`+'1'  WHERE `id`='1'");
mysql_query("UPDATE `stat` SET `stat`=`stat`+'1'  WHERE `id`='20'");

$dbres = mysql_query("SELECT * FROM `users` WHERE (`login`='{$_POST['user']}' OR `email`='{$_POST['email']}') AND `pass`='{$pass}' AND `IP`='{$final}'");
$numLG = mysql_num_rows($dbres);
$data2 = mysql_fetch_object($dbres);
if ($numLG > 0) {
mysql_query("UPDATE `users` SET `online`=NOW(), `lastip`='{$final}', `log_h`='24'  WHERE (`login`='{$_POST['user']}' OR `email`='{$_POST['email']}' )");
	$sitelogin = mysql_query("SELECT * FROM `login` WHERE (`user_id` = '{$_POST['user']}')");
	$extlog = mysql_num_rows($sitelogin);
	if($extlog == 0){
	  mysql_query("INSERT INTO `login` (user_id) VALUES('{$_POST['user']}')");
	  mysql_query("UPDATE `sitestat` SET `online`=`online`+'1'  WHERE `id`='3'");
	}
	$_SESSION['login'] = $data2->login;
	echo "<script>document.location.href='help.php'</script>";
}

// To email address
$email = $_POST['email'];
$email_name = $_POST['user'];

// From email address
$from = "likesplanet.com@gmail.com";
$from_name = "Admin of LikesPlanet.com";

// The message
$subject = "LikesPlanet.com - Confirm your Account";


$message = "Hello ".$email_name."

Please follow this link below to confirm your account:

http://likesplanet.com/conf.php?code=".$str."


Admin of LikesPlanet.com
";

$emailtemp1 = file_get_contents("email_temp0.php");
$emailtemp2 = file_get_contents("email_temp2.php");

$message_html = $emailtemp1 . "Welcome to LikesPlanet network,<br /><br />
<br /> Please confirm your account by following this link:
<br />
<br /> http://likesplanet.com/conf.php?code=" . $str . "<br />" . $emailtemp2;

$emailtemp1 = "";
$emailtemp2 = "";

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




mysql_query("UPDATE `sitestat` SET `join`=`join`+'1', `members`=`members`+'1'  WHERE `id`='1'");

$message = "You have registered succesfully! Please Check your email to Confirm account.</br></br>You can <a href='login.php'>Login</a> Now."; $message2 = 2;
}}
}
}

$code00=rand(1000,9999);
$_SESSION["code"]=$code00;

?>
<div class="center" style="margin-bottom: 50px;">


<? if ($message2 == 0) {?>
<div class="msg_success" >
<p>Note:  Use your Real Email Address.</p>

<p>Do NOT Register more than 1 Account.</p>

<p>Use Letters and Numbers ONLY for both Username and Password.</p>

</div>
<? } ?>
			

<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>


<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

<div class="login-title">Register Account</div>

<div class="login-box">

<form method="post" action="">
<table cellpadding="0" cellspacing="0" border="0" class="form">
<tr><td><label for="username">Username:</label></td><td width="20"></td><td><input type="text" name="user" id="username" size="20" maxlength="25" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="email"><b>Email:</b></label></td><td width="20"></td><td><input type="text" name="email" id="email" size="20" maxlength="120" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="email2"><b>Repeat Email:</b></label></td><td width="20"></td><td><input type="text" name="email2" id="email2" size="20" maxlength="120" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="password">Password:</label></td><td width="20"></td><td><input type="password" name="password" id="password" size="20" maxlength="25" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="password2">Repeat password:</label></td><td width="20"></td><td><input type="password" name="password2" id="password2" size="20" maxlength="25"/></td></tr>
<tr><td>&nbsp;</td></tr>


<tr><td><label for="country">Location:</label></td><td width="20"></td><td> <img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oo[0]); ?>-lgflag.gif" border="0" title="My Country : <? echo $data->country; ?>" height="16" width="24" > <? echo $x111022; ?> </td></tr>
<tr><td><label for="referralll">Referral:</label></td><td width="20"></td><td><input type="referralll" name="referralll" id="referralll" size="20" maxlength="25" value="<? echo $refname; ?>" /></td></tr>
<tr><td><label for="referralll"> </label></td><td width="20"></td><td> <font color='grey'> You can leave Empty.</font> </td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td><label for="captcha">Captcha Number:</label></td><td width="20"></td><td><input name="captcha" size="7" maxlength="5" type="text"> <img src="captcha.php" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="register" value="Register!" class="submit" style="width: 200px; height: 48px; font-size: 24" /></td></tr>
</table>
</form>

<p><i>Activation email Not sent? <a href="reconfirm.php"><b>Re-Send Activation Code</b></a></i></p>

</div>


</div>

<script language=javascript>
var referrllaa = "<? echo $refname; ?>";
function DisplayDefReff(){
	if (referrllaa != "") {
	document.getElementById("referralll").disabled = "true";
	}
}
</script>


<? include('footer.php');?>
